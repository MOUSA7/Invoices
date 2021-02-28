<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    protected $guarded=[];

    public function item(){
        return $this->hasOne(Item::class);
    }
    //
}
