<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profacture extends Model
{

    protected $appends = ['created_by','products_count', 'profacture_sum'];




    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function price_level()
    {
        return $this->belongsTo(PriceLevel::class);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('product_order_no', 'custom_product_name', 'quantity', 'price', 'discount');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedByAttribute()
    {
        return $this->user()->first('name')->name;
    }
    public function getProductsCountAttribute()
    {
        return $this->products()->count();
    }
    public function getProfactureSumAttribute()
    {



        return round($this->products()->sum('product_profacture.price'), 2);
    }
}
