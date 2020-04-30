<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Validator;
use App\Bookmark;
use App\User;

use Hash;
use Storage;
use Auth;

use Illuminate\Http\Request;
class ProfileController extends Controller
{

  public function update(Request $request){
    $rules = [
      'name' => 'required|string|min:3|max:191',
      'email' => 'required|email|min:3|max:191',
      'password' => 'nullable|min:6|max:191',
      'image' => 'nullable|image|max:1999'
    ];

    $request->validate($rules);

    $user = auth()->user();
    $user->name = $request->name;
    $user->email = $request->email;

    if($request->hasFile('image')){
      $image = $request->image;
      $ext = $image->getClientOriginalExtension();
      $filename = uniqid().'.'.$ext;
      $image->storeAs('public/images', $filename);
      Storage::delete("public/images/{$user->image}");
      $user->image = $filename;
    }

    if($request->password){
      $user->password = Hash::make($request->password);
    }

    $user->save();
    return response()->json(['user' => auth()->user()], 200);
  }

  public function updateDetails(Request $request){

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:3|max:191',
      'email' => 'required|email|min:3|max:191',
      'password' => 'required|confirmed',
      'password_confirmation' => 'required',
      'image' => 'nullable|image|max:1999'
    ]);

    //if log in attempt fail
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = auth()->user();
    $user->name = $request->name;
    $user->email = $request->email;

    if($request->hasFile('image')){
      $image = $request->image;
      $ext = $image->getClientOriginalExtension();
      $filename = uniqid().'.'.$ext;
      $image->storeAs('public/images', $filename);
      Storage::delete("public/images/{$user->image}");
      $user->image = $filename;
    }

    if($request->password){
      $user->password = Hash::make($request->password);
    }

    $user->save();
    return response()->json(['user' => auth()->user()], 200);
  }


}
