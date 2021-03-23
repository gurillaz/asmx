<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $appends = ['created_by','product_count'];



    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedByAttribute()
    {
        return $this->user()->first('name')->name;
    }

    public function getProductCountAttribute()
    {
        return $this->products()->count();
    }
}
