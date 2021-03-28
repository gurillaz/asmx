<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profacture extends Model
{

    protected $appends = ['created_by','profacture_sum'];



    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
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

    public function getProfactureSumAttribute()
    {



        return round($this->products()->sum('product_profacture.price'),2);


    }
}
