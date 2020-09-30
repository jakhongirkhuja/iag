<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public function estates()
    {
        return $this->belongsToMany('App\Models\Estate');
    }
}
