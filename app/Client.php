<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $appends = ['subject_name'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function price_level()
    {
        return $this->belongsTo(PriceLevel::class);
    }

    protected function getSubjectNameAttribute()
    {
        return $this->subject()->first('name')->name;

    }


}
