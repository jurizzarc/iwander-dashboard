<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Bookmark;
use App\User;
use Auth;

class BookmarkController extends Controller
{
  //create bookmarks
  public function createBookmarks(Request $request){
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|integer',
        'restaurant_id' => 'nullable|integer',
        'attraction_id' => 'nullable|integer',
        'itinerary_id' => 'nullable|integer'
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $bookmark = Bookmark::create([
        'user_id' => $request->user_id,
        'restaurant_id' => $request->restaurant_id,
        'attraction_id' => $request->attraction_id,
        'itinerary_id' => $request->itinerary_id
    ]);

    return response()->json(['message' => 'Added to bookmarks', 'data' => $bookmark], 200);
  }

  //view bookmarks
  public function viewBookmarks()
  {
    $bookmarks = Bookmark::where('user_id', auth()->user()->id)
                 ->with('attraction','attraction.addresses', 'attraction.addresses.city', 'itinerary', 'itinerary.user')->get();


    if ($bookmarks === null) {
      $statusMsg = 'Bookmark not found!';
      $statusCode = 404;
    }
    else {
      return response()->json(
        [
            'data' => $bookmarks
        ],
        200);
    }
  }

  //delete bookmark
  public function destroy($id){
    $bookmark = Bookmark::findOrFail($id);
    $bookmark->delete();

    return response()->json(['message' => 'Bookmark deleted!'], 200);
  }
}
