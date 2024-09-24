<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Http\Services\Payment\PaymentService;
use App\Models\Market\CartItem;
use App\Models\Market\CashPayment;
use App\Models\Market\Copan;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use App\Models\Market\OrderItem;
use App\Models\Market\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment()
    {
        $user = auth()->user();
        $cartItems = CartItem::where('user_id', $user->id)->get();
        if ($cartItems->count() > 0) {
            $order = Order::where('user_id', auth()->user()->id)->where('order_status', 0)->first();
            return view('customer.sales-process.payment', compact('cartItems', 'order'));
        } else {
            return redirect()->back();
        }
    }

    public function copanDiscount(Request $request)
    {
        $request->validate(
            ['copan' => 'required']
        );

        $copan = Copan::where([['code', $request->copan], ['status', 1], ['end_date', '>', now()], ['start_date', '<', now()]])->first();

        if ($copan != null) {

            if ($copan->user_id != null) {
                $copan = Copan::where([['code', $request->copan], ['status', 1], ['end_date', '>', now()],
                    ['start_date', '<', now()], ['user_id', auth()->user()->id]])->first();

                if ($copan == null) {
                    return redirect()->back();
                }

            }

            $order = Order::where('user_id', auth()->user()->id)->where('order_status', 0)->where('copan_id', null)->first();

            $copanDiscountAmount = 0;

            if ($order) {
                if ($copan->amount_type == 0) {
                    $copanDiscountAmount = $order->order_final_amount * ($copan->amount / 100);
                    if ($copanDiscountAmount > $copan->discount_ceiling) {
                        $copanDiscountAmount = $copan->discount_ceiling;
                    }
                } else {
                    $copanDiscountAmount = $copan->amount;
                }

                $finalAmount = $order->order_final_amount;

                $order->order_copan_discount_amount = $copanDiscountAmount;

                $finalDiscount = $order->order_total_products_discount_amount;

                $order->update(
                    ['copan_id' => $copan->id, 'order_copan_discount_amount' => $copanDiscountAmount,
                        'order_total_products_discount_amount' => ($finalDiscount + $copanDiscountAmount),
                        'order_final_amount' => ($finalAmount - $copanDiscountAmount)]
                );

                return redirect()->back()->with(['copan' => 'کد تخفیف با موفقیت اعمال شد']);
            } else {
                return redirect()->back()->withErrors(['copan' => 'کد تخفیف اشتباه وارد شده است']);
            }
        } else {
            return redirect()->back()->withErrors(['copan' => 'کد تخفیف اشتباه وارد شده است']);
        }

    }

    public function paymentSubmit(Request $request, PaymentService $paymentService)
    {
        $request->validate([
            'payment_type' => 'required'
        ]);

        $order = Order::where('user_id', Auth::user()->id)->where('order_status', 0)->first();
        $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
        $cash_receiver = null;
        switch ($request->payment_type) {
            case '1':
                $targetModel = OnlinePayment::class;
                $type = 0;
                break;
            case '2':
                $targetModel = OfflinePayment::class;
                $type = 1;
                break;
            case '3':
                $targetModel = CashPayment::class;
                $type = 2;
                $cash_receiver = $request->cash_receiver ? $request->cash_receiver : null;
                break;
            default:
                return redirect()->back()->withErrors(['error' => 'خطا اتفاق افتاده است']);
        }

        $paymented = $targetModel::create([
            'amount' => $order->order_final_amount,
            'user_id' => auth()->user()->id,
            'pay_date' => now(),
            'cash_receiver' => $cash_receiver,
            'status' => 1,
        ]);


        $payment = Payment::create([
            'amount' => $order->order_final_amount,
            'user_id' => auth()->user()->id,
            'pay_date' => now(),
            'type' => $type,
            'paymentable_id' => $paymented->id,
            'paymentable_type' => $targetModel,
            'status' => 1
        ]);

        if ($request->payment_type == 1) {

            $paymentService->zarinpal($order->order_final_amount, $order, $paymented);
        }

        $order->update(['order_status' => 3]);

        foreach ($cartItems as $cartItem) {

            OrderItem::create([
                'user_id' => auth()->user()->id,
                'product_id' => $cartItem->product_id,
                'product' => $cartItem->product,
                'amazing_sale_id' => $cartItem->product->activeAmazingSales()->id ?? null,
                'amazing_sale_object' => $cartItem->product->activeAmazingSales() ?? null,
                'amazing_sale_discount_amount' => empty($cartItem->product->activeAmazingSales()) ? 0 :
                    $cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSales()->percentage / 100),
                'number' => $cartItem->number,
                'final_product_price' => empty($cartItem->product->activeAmazingSales()) ? $cartItem->cartItemProductPrice() :
                    ($cartItem->cartItemProductPrice() - $cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSales()->percentage / 100)),
                'final_total_price' => empty($cartItem->product->activeAmazingSales()) ? $cartItem->cartItemProductPrice() * ($cartItem->number) :
                    ($cartItem->cartItemProductPrice() - $cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSales()->percentage / 100)) * ($cartItem->number),
                'color_id' => $cartItem->color_id,
                'guarantee_id' => $cartItem->guarantee_id

            ]);

            $cartItem->delete();
        }

        return redirect()->route('customer.home')->with('success', 'سفارش شما با موفقیت ثبت شد');
    }

    public function PaymentCallback(Order $order, OnlinePayment $onlinePayment, PaymentService $paymentService)
    {
        $amount = $onlinePayment->amount * 10;
        $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
        $result = $paymentService->zarinpalVerify($amount, $onlinePayment);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product' => $cartItem->product,
                'amazing_sale_id' => $cartItem->product->activeAmazingSales()->id ?? null,
                'amazing_sale_object' => $cartItem->product->activeAmazingSales() ?? null,
                'amazing_sale_discount_amount' => empty($cartItem->product->activeAmazingSales()) ? 0 :
                    $cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSales()->percentage / 100),
                'number' => $cartItem->number,
                'final_product_price' => empty($cartItem->product->activeAmazingSales()) ? $cartItem->cartItemProductPrice() :
                    ($cartItem->cartItemProductPrice() - $cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSales()->percentage / 100)),
                'final_total_price' => empty($cartItem->product->activeAmazingSales()) ? $cartItem->cartItemProductPrice() * ($cartItem->number) :
                    ($cartItem->cartItemProductPrice() - $cartItem->cartItemProductPrice() * ($cartItem->product->activeAmazingSales()->percentage / 100)) * ($cartItem->number),
                'color_id' => $cartItem->color_id,
                'guarantee_id' => $cartItem->guarantee_id

            ]);

            $cartItem->delete();
        }

        if ($result['success']) {
            $order->update(['order_status' => 3]);
            return redirect()->route('customer.home')->with('success', 'پرداخت شما با موفقیت انجام شد');
        } else {
            $order->update(['order_status' => 2]);
            return redirect()->route('customer.home')->with('danger', 'پرداخت شما با خطا مواجه شد');
        }
    }
}
