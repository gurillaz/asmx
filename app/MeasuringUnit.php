<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasuringUnit extends Model
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
        return $this->user()->select("name")->get()->pluck('name');
    }

    public function getProductCountAttribute()
    {
        return $this->products()->count();
    }
}
