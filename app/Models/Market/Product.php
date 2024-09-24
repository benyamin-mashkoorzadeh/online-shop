<?php

namespace App\Models\Market;

use App\Models\Content\Comment;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = ['name', 'introduction', 'slug', 'image', 'status', 'tags',
        'weight', 'length', 'width', 'height', 'price', 'marketable', 'sold_number', 'frozen_number',
        'marketable_number', 'brand_id', 'category_id', 'published_at'];

    protected $casts = ['image' => 'array'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function metas()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function images()
    {
        return $this->hasMany(Gallery::class);
    }

    public function guarantees()
    {
        return $this->hasMany(Guarantee::class);
    }

    public function amazingSales()
    {
        return $this->hasMany(AmazingSale::class);
    }

    public function activeAmazingSales()
    {
        return $this->amazingSales()
            ->where('status', 1)
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>', Carbon::now())
            ->first();
    }

    public function values()
    {
        return $this->hasMany(CategoryValue::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Content\Comment', 'commentable');
    }

    public function activeComments() {
        return $this->comments()->where('approved', 1)->where('parent_id')->get();
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}