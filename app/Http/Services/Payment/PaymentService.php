<?php

namespace App\Http\Services\Payment;

use App\Models\Market\OnlinePayment;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Config;
use Zarinpal\Clients\GuzzleClient;
use Zarinpal\Zarinpal;

class PaymentService
{
    public function zarinpal($amount, $order, $onlinePayment)
    {
        $marchentID = Config::get('payment.zarinpal_api_key');
        $sanbox = false;
        $zarinpalGate = false;
        $client = new GuzzleClient($sanbox);
        $zarinpalGatePSP = '';
        $lang = 'fa';
        $zarinpal = new Zarinpal($marchentID, $client, $lang, $sanbox, $zarinpalGate, $zarinpalGatePSP);
        $payment = [
            'callback_url' => route('customer.sales-process.payment-callback', [$order, $onlinePayment]),
            'amount' => (int) $amount * 10,
            'description' => 'an Order'
        ];

        try {
            $response = $zarinpal->request($payment);
            $code = $response['data']['code'];
            $message = $zarinpal->getCodeMessage($code);
            if ($code === 100) {
                $onlinePayment->update(['bank_first_response' => $response]);
                $authority = $response['data']['authority'];
                return $zarinpal->redirect($authority);
            }
        } catch (RequestException $exception) {
            return false;
        }
    }

    public function zarinpalVerify($amount, $onlinePayment)
    {
        $authority = $_GET['authority'];
        $data = ['merchant_id', Config::get('payment.zarinpal_api_key'), 'authority' => $authority, 'amount' => (int)$amount];
        $jsonData = json_encode($data);
        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Zarinpal Rest Api V4');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        $onlinePayment->update(['bank_second_response' => $result]);

        if (count($result['errors']) === 0) {
            if ($result['data']['code'] == 100) {
                return ['success' => true];
            }
            else {
                return ['success' => false];
            }
        }
        else {
            return ['success' => false];
        }
    }
}
