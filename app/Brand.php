<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{



    protected $hidden=['pivot'];

     // adding the appends value will call the accessor in the JSON response
     protected $appends = ['supplier_ids','products_count','suppliers_count'];

    public function products(){
        return $this->hasMany(Product::class);
    }


    public function suppliers(){
        return $this->belongsToMany(Supplier::class);
    }


    public function getSupplierIdsAttribute()
    {
        return $this->suppliers()->pluck('id');
    }

    public function getProductsCountAttribute()
    {
        return $this->products()->count();
    }
    public function getSuppliersCountAttribute()
    {
        return $this->suppliers()->count();
    }
}
