<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  public function districts() {
    return $this->hasMany('App\District');
  }

  public function cities() {
    return $this->hasManyThrough('App\City','App\District', 'country_id','district_id','id','id');
  }
}
