<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
  public function attractions() {
    return $this->belongsToMany('App\Attraction', 'attraction_keyword');
  }
}
