<?php

namespace App\Http\Controllers\API;
use Validator;
use DB;
use App\Event;
use App\Itinerary;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
  //create an event
  public function create(Request $request){
    $validator = Validator::make($request->all(), [
        'itinerary_id' => 'required|integer',
        'restaurant_id' => 'integer',
        'attraction_id' => 'integer',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i',
        'date' => 'required|date',
        'notes' => 'nullable|string'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $event = Event::create([
        'restaurant_id' => $request->restaurant_id,
        'attraction_id' => $request->attraction_id,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'date' => $request->date,
        'notes' => $request->notes
    ]);

    //attach event to itinerary
    $event->itinerary()->attach(Itinerary::where('id', $request->itinerary_id)->first());
    return $event;

    return response()->json(['message' => 'Event added to itinerary', 'data' => $event], 200);
  }

  public function edit($id){
    // dd($request);
    $event = Event::find($id);
    return response()->json($event);
  }

  public function update($id, Request $request){
    $event = Event::find($id);
    $event->update($request->all());
    return response()->json('Successfully updated.');
  }



  public function view($id){
    //get itinerary
    $itinerary = Itinerary::where('id', $id)->first();

    //get the events of the itinerary
    $events = $itinerary->events()->orderBy('start_time','desc')->get();

    if ($events === null) {
      $statusMsg = 'Events not found!';
      $statusCode = 404;
    }
    else {
      return response()->json(
        [
            'data' => $events
        ],
        200);
    }
  }

  //delete an event
  public function destroy($id){
    $event = Event::where('id', $id)->first();
    $event->delete();

    return response()->json(['message' => 'Event deleted!'], 200);
  }

}
