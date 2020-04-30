<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    // public function country() {
    //   return $this->belongsTo('App\Country','country_id','id');
    // }

    public function country() {
      return $this->belongsTo('App\Country');
    }

    public function cities() {
      return $this->hasMany('App\City');
    }

}
