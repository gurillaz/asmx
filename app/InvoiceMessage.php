<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceMessage extends Model
{
    protected $appends = ['created_by'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedByAttribute()
    {
        return $this->user->name;
    }
}
