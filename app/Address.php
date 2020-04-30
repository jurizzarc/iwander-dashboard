<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  public function country() {
    return $this->belongsTo('App\Country','country_id','id');
  }

  public function district() {
    return $this->belongsTo('App\District','district_id','id');
  }

  public function city() {
    return $this->belongsTo('App\City','city_id','id');
  }

}
