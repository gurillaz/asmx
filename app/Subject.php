<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{


    public function price_level()
    {
        return $this->belongsTo(PriceLevel::class);
    }
}
