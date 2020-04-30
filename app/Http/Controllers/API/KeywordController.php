<?php

namespace App\Http\Controllers\API;
use App\Keyword;
use App\Attraction;
use App\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function getAllKeywords(){
      $keywords = Keyword::all();
      return response()->json(['message' => 'Keywords Successfully Collected', 'data' => $keywords], 200);
    }

    public function getAttractionsByKeywords($keywords, $city){
      //if no keywords selected

      if($keywords == 0){
        //return null
        $attractionsData = null;
        return response()->json(['message'=> 'No data', 'data' => $attractionsData]);
      }
      else {
        // breaks the string into an array
        $ids = explode(",", $keywords);

        //get the keywords of the ids
        $keyword = Keyword::whereIn('id', $ids)->get();

        // make variable as an array
        $attractionsData = array();
        //loop through keyword
        foreach($keyword as $key){
          //get attractions with the keyword
          $attractions = $key->attractions()->with('details','addresses','addresses.city','addresses.city.districts')->get();
          //store each attraction into the array
          foreach($attractions as $att){
            // dd($attractions);
            if($att["addresses"]["city"]["name"] === $city){
              $attractionsData[] = $att;
            }
          }
        }

        return response()->json(['message'=> 'Success', 'data' => $attractionsData], 200);
      }

    }
}
