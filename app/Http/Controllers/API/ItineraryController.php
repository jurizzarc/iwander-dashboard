<?php

namespace App\Http\Controllers\API;
use Validator;
use App\Itinerary;
use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function create(Request $request){
      $validator = Validator::make($request->all(), [
          'destination' => 'required|regex:/^[a-zA-Z ]+$/',
          'start_date' => 'required|date',
          'end_date' => 'required|date',
          'user_id' => 'required|integer'
      ]);

      if ($validator->fails()) {
          return response()->json(['errors' => $validator->errors()], 422);
      }

      $itinerary = Itinerary::create([
          'destination' => $request->destination,
          'start_date' => $request->start_date,
          'end_date' => $request->end_date,
          'user_id' => $request->user_id
      ]);

      return response()->json(['message' => 'Created an itinerary', 'data' => $itinerary], 200);
    }

    //view All Itineraries of the user
    public function view(){
      $itineraries = Itinerary::where('user_id', auth()->user()->id)->get();

      if ($itineraries === null) {
        $statusMsg = 'Itineraries not found!';
        $statusCode = 404;
      }
      else {
        return response()->json(
          [
              'data' => $itineraries
          ],
          200);
      }
    }

    //get last entry itinerary
    public function getItinerary(){
      $itinerary = Itinerary::where('user_id', auth()->user()->id)->latest('created_at')->first();

      if ($itinerary === null) {
        $statusMsg = 'Itinerary not found!';
        $statusCode = 404;
      }
      else {
        return response()->json(
          [
              'data' => $itinerary
          ],
          200);
      }
    }

    public function getItineraryByID($id){
      $itinerary = Itinerary::where('id', $id)->first();
      $itinerary = $itinerary->load('user');

      if ($itinerary === null) {
        $statusMsg = 'Itinerary not found!';
        $statusCode = 404;
      }
      else {
        return response()->json(
          [
              'data' => $itinerary
          ],
          200);
      }
    }

    public function getAllItineraries(){
      $itinerary = Itinerary::all();
      $itinerary = $itinerary->load('user');

      if ($itinerary === null) {
        $statusMsg = 'Itinerary not found!';
        $statusCode = 404;
      }
      else {
        return response()->json(
          [
              'data' => $itinerary
          ],
          200);
      }

    }

    public function destroy($id){
      $itinerary = Itinerary::findOrFail($id);
      $itinerary->delete();

      return response()->json(['message' => 'Itinerary deleted!'], 200);
    }
}
