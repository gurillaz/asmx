<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $appends = ['created_by','products_count'];


    public function price_level()
    {
        return $this->belongsTo(PriceLevel::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id');
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
}
