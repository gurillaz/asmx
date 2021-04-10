<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\AccessTypeScope;

class Product extends Model
{
    //TODO set fillable column names that can be mass assigned
    // protected $fillable = ['*'];
    protected $guarded = ['id'];

    protected $hidden = ['pivot'];

    protected $appends = ['created_by','brand_name','category_name'];

    public function places()
    {
        return $this->hasMany(ProductPlace::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Subject::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedByAttribute()
    {
        return $this->user()->first('name')->name;
    }


    public function getBrandNameAttribute()
    {
        return $this->brand()->first('name')->name;
    }

    public function getCategoryNameAttribute()
    {
        return $this->category()->first('name')->name;
    }



    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new AccessTypeScope);
    }
}
