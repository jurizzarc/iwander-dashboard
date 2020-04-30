<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'API\PassportController@login');
Route::post('register', 'API\PassportController@register');

Route::post('createitinerary', 'API\ItineraryController@create');
Route::post('addtoitinerary', 'API\EventController@create');
Route::post('update-event/{id}', 'API\EventController@update');

Route::get('getAttractions/{city}', 'API\AttractionController@getAttractions');
Route::get('getAttraction/{id}', 'API\AttractionController@getAttraction');
Route::get('getItineraryByID/{id}', 'API\ItineraryController@getItineraryByID');
Route::get('getAllItineraries', 'API\ItineraryController@getAllItineraries');


Route::get('get-city/{city}', 'API\CityController@viewCity');
// Route::get('get-cities/{district}', 'API\DistrictController@getCities');
Route::get('get-cities/{country}', 'API\CountryController@getCitiesofCountry');




Route::get('getCategories', 'API\CategoryController@getCategories');
Route::get('getCategoriesOfAttraction/{id}', 'API\CategoryController@getCategoriesOfAttraction');
Route::get('getAttractionsByCategories/{categories}/{city}', 'API\CategoryController@getAttractionsByCategories');

Route::get('getAllKeywords', 'API\KeywordController@getAllKeywords');
Route::get('getAttractionsByKeywords/{keywords}/{city}', 'API\KeywordController@getAttractionsByKeywords');
Route::get('getAttractionsByEvent/{iId}', 'API\AttractionController@getAttractionsByEvent');
Route::get('getBusinessHours', 'API\AttractionController@getBusinessHours');

//autocomplete
Route::get('autocomplete', 'API\SearchController@autocomplete');
Route::get('search', 'API\SearchController@search');


Route::middleware('auth:api')->group(function () {
  //allow send back user information that is currently logged in
  Route::get('user', 'API\PassportController@user');
  Route::get('logout', 'API\PassportController@logout');
  Route::get('viewbookmarks', 'API\BookmarkController@viewBookmarks');
  Route::get('viewItineraries', 'API\ItineraryController@view');

  Route::get('viewEvents/{id}', 'API\EventController@view');
  Route::get('edit/event/{id}','API\EventController@edit');
  Route::get('getItinerary', 'API\ItineraryController@getItinerary');


  Route::delete('deleteItinerary/{id}', 'API\ItineraryController@destroy');
  Route::delete('deleteEvent/{id}', 'API\EventController@destroy');
  Route::delete('deleteBookmark/{id}', 'API\BookmarkController@destroy');

  Route::post('/profile','API\ProfileController@update');
  Route::post('/updateDetails','API\ProfileController@updateDetails');

  Route::post('createBookmarks', 'API\BookmarkController@createBookmarks');
  Route::post('createitinerary', 'API\ItineraryController@create');

});
