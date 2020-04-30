<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  public function districts() {
    return $this->belongsTo('App\District','district_id','id');
  }

  public function country() {
    return $this->districts->country;
  }

  public function addresses() {
    return $this->hasMany('App\Address');
  }

  // public function itineraries() {
  //   return $this->hasMany('App\Itinerary');
  // }
}
