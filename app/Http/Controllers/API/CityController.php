<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\Country;
use App\District;



class CityController extends Controller
{
  public function viewCity($city){
    $city = City::where('name', $city)
            ->with('districts', 'districts.country')
            ->get();

    return response()->json(['message' => 'City Successfully Collected', 'data' => $city], 200);
  }

}
