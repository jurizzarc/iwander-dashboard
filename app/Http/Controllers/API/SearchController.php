<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\City;
use App\Country;
use App\District;

class SearchController extends Controller
{
  public function autocomplete()
  {
      return view('autocomplete');
  }
  public function search(Request $request)
  {
      $search = $request->search;

        $city = City::where('name','LIKE', $search.'%')
                 ->with('districts', 'districts.country')
                 ->get();

      return response()->json($city);
  }
}


// $district = District::where('name','LIKE', $search.'%')
//             ->with('country')
//             ->get();
//
// $country = Country::where('name','LIKE',$search.'%')
//             ->get();

// $results1 = $country->merge($district);
// $results2 = $results1->merge($city);
// dd($results2->toArray());
