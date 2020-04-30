<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\District;

class DistrictController extends Controller
{
  //get cities in the district
  public function getCities($district){
    $cities = District::where('name', $district)->get();
    $cities->load(['cities']);
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
