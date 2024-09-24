<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Guarantee;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class GuaranteeController extends Controller
{
    public function index(Product $product)
    {
        return view('admin.market.product.guarantee.index', compact('product'));
    }

    public function create(Product $product)
    {
        return view('admin.market.product.guarantee.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price_increase' => 'required|numeric'
        ]);

        $inputs = $request->all();
        $inputs['product_id'] = $product->id;
        $guarantee = Guarantee::create($inputs);

        return redirect()->route('admin.market.guarantee.index', $product->id)->with('swal-success', 'گارانتی با موفقیت ثبت شد');
    }

    public function destroy(Product $product, Guarantee $guarantee)
    {
        $result = $guarantee->delete();
        return back();
    }
}
