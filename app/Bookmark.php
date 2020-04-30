<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
  protected $fillable = [
      'user_id', 'restaurant_id', 'attraction_id', 'itinerary_id'
  ];

  public function user() {
    return $this->belongsTo('App\User','user_id');
  }

  public function attraction() {
    return $this->belongsTo('App\Attraction','attraction_id');
  }

  public function itinerary() {
    return $this->belongsTo('App\Itinerary','itinerary_id');
  }
}
