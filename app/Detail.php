<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
  public function attractions() {
    return $this->hasOne('App\Detail');
  }
}
