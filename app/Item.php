<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function details(){
        return $this->hasOne(Details::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function invoice(){
        return $this->belongsTo(Master::class);
    }

    //
}
