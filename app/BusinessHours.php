<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHours extends Model
{
    public function attraction()
    {
        return $this->belongsTo('App\Attraction');
    }
}
