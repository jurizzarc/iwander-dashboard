<?php

namespace App\Http\Controllers\API;
use App\Category;
use App\Attraction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //get all categories
    public function getCategories(){
      $categories = Category::all();
      return response()->json(['message' => 'Categories Successfully Collected', 'data' => $categories], 200);
    }

    //get categories of attractions
    public function getCategoriesOfAttraction($id){
      // $id = 1;
      $attraction = Attraction::where('id', $id)->first();
      $categories = $attraction->categories()->get();
      return response()->json(['message' => 'Categories of Attraction Successfully Collected', 'data' => $categories], 200);
    }

    //get attractions by category
    public function getAttractionsByCategories($categories, $city){
      if($categories == 0){
        //return null
        $attractionsData = null;
        return response()->json(['message'=> 'No data', 'data' => $attractionsData]);
      }
      else {
        // breaks the string into an array
      $ids = explode(",", $categories);
      $category = Category::whereIn('id', $ids)->get();
      $categoriesData = array();
      foreach($category as $key){
        $attractions = $key->attractions()->with('details','addresses','addresses.city','addresses.city.districts')->get();
        foreach($attractions as $att){
            if($att["addresses"]["city"]["name"] == $city){
              $categoriesData[] = $att;
            }
        }
      }
    }
      return response()->json(['data' => $categoriesData], 200);
    }




}
