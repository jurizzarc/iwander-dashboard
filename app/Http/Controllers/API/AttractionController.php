<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\Attraction;
use App\Event;
use App\Itinerary;
use App\BusinessHours;

class AttractionController extends Controller
{
    //get attractions in the city
    public function getAttractions($city){
    $attractions = Attraction::with('details','addresses','addresses.city','addresses.city.districts')->get();
    $city_attractions = $attractions->where('addresses.city.name', ucfirst($city));

    return response()->json(['message' => 'Attraction from City Successfully Collected', 'data' => $city_attractions], 200);
    }

    //get attractions in the itinerary
    public function getAttractionsByEvent($itineraryId){
      //get itinerary
      $itinerary = Itinerary::where('id', $itineraryId)->first();
      //get events with attraction
      $events = $itinerary->events()->with('attraction','attraction.details','attraction.addresses','attraction.addresses.city','attraction.addresses.city.districts','attraction.addresses.city.districts.country')->get();
      // $e = $events->sortBy('start_time');

      if ($events === null) {
        $statusMsg = 'No events found!';
        $statusCode = 404;
      }
      else {
        return response()->json(
          [
              'message' => 'Attraction from event Successfully Collected',
              'data' => $events
          ],
          200);
      }
    }

    //get attraction by id
    public function getAttraction($id){
      $attraction = Attraction::where('id', $id)->first();
      $attraction->load('details','addresses','addresses.city','addresses.city.districts','addresses.city.districts.country');

      //get business hours
      $business_hours =  BusinessHours::where('attraction_id', $id)->get();

      return response()->json(['message' => 'Attraction by id Successfully Collected', 'data' => $attraction, 'hours' => $business_hours], 200);
    }



}
