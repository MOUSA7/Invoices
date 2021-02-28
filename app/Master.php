<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    protected $guarded = [];
    //
    public function items(){
        return $this->hasMany(Item::class);
    }
}
