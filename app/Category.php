<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

  public function attractions() {
    return $this->belongsToMany('App\Attraction','attraction_category');
  }
}
