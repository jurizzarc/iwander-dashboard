<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
  protected $fillable = [
      'destination', 'start_date', 'end_date', 'user_id'
  ];

  public function city() {
    return $this->belongsTo('App\Cities', 'city_id');
  }

  public function user() {
    return $this->belongsTo('App\User','user_id');
  }

  public function events() {
    return $this->belongsToMany('App\Event','events_itineraries');
  }


}
