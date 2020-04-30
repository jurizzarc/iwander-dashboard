<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $fillable = [
      'restaurant_id', 'start_time', 'end_time', 'date', 'notes', 'attraction_id'
  ];

  public function itinerary() {
    return $this->belongsToMany('App\Itinerary','events_itineraries');
  }

  public function attraction() {
    return $this->belongsTo('App\Attraction','attraction_id','id');
  }
}
