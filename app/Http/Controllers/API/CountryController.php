<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use App\District;
use App\City;



class CountryController extends Controller
{
  //get cities in the district
  public function getCitiesofCountry($country){
    $country_name = Country::where('name', $country)->get();
    $cities = $country_name->load(['cities']);
    // $cities = $districts->load(['cities']);
    // dd($cities);
    if ($cities === null) {
      $statusMsg = 'Cities not found!';
      $statusCode = 404;
    }
    else {
      return response()->json(
        [
            'data' => $cities
        ],
        200);
    }
  }
}
