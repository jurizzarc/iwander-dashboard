<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
  public function details() {
    return $this->belongsTo('App\Detail','detail_id');
  }

  public function addresses() {
    return $this->belongsTo('App\Address','address_id','id');
  }

  // public function category() {
  //   return $this->belongsTo('App\Category','category_id','id');
  // }

  public function categories() {
    return $this->belongsToMany('App\Category','attraction_category');
  }

  public function events() {
    return $this->hasMany('App\Event');
  }

  public function keywords() {
    return $this->belongsToMany('App\Keyword','attraction_keyword');
  }

  public function businessHours()
    {
        return $this->hasMany('App\BusinessHours');
    }
}
