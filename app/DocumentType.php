<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{

    // protected $hidden = ['public'];
    // adding the appends value will call the accessor in the JSON response
    protected $appends = ['document_count','created_by'];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDocumentCountAttribute()
    {
        return $this->documents()->count();
    }

    public function getCreatedByAttribute()
    {
        return $this->user->name;
    }
}
