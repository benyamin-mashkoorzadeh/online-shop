<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_id', 'user_id', 'color_id', 'guarantee_id', 'number'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(Product::class);
    }

    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class);
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class);
    }

    // productPrice + colorPrice + guaranteePrice

    public function cartItemProductPrice()
    {
        $guaranteePriceIncrease = empty($this->guarantee_id) ? 0 : $this->guarantee->price_increase;
        $colorPriceIncrease = empty($this->color_id) ? 0 : $this->color->price_increase;
        $productPrice = $this->product->price;

        return $productPrice + $guaranteePriceIncrease + $colorPriceIncrease;
    }

    // productPrice * (discountPercentage / 100)
    public function cartItemProductDiscount()
    {
        $productPrice = $this->cartItemProductPrice();
        $productDiscount = empty($this->product->activeAmazingSales()) ? 0 :
            $productPrice * ($this->product->activeAmazingSales()->percentage / 100);
        return $productDiscount;
    }

    // number * (productPrice + colorPrice + guaranteePrice - discountPrice)
    public function cartItemFinalPrice()
    {
        $productPrice = $this->cartItemProductPrice();
        $discountPrice = $this->cartItemProductDiscount();

        return $this->number * ($productPrice - $discountPrice);
    }

    public function cartItemFinalDiscount()
    {
        $productDiscount = $this->cartItemProductDiscount();
        return $this->number * $productDiscount;
    }
}
