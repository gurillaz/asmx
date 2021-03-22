<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\AccessTypeScope;

class Product extends Model
{
    //TODO set fillable column names that can be mass assigned
    // protected $fillable = ['*'];
    protected $guarded = ['id'];

    protected $hidden=['pivot'];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function subject()
    {
        return $this->hasManyThrough(Subject::class,'supplier_id','subject_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new AccessTypeScope);
    }

}
