<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    protected $hidden=['pivot'];


    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
