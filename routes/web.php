<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// CRUD functionality for admin
Route::get('/admin/home', 'Admin\HomeController@index')->name('admin.home');

Route::get('/admin/countries', 'Admin\CountryController@index')->name('admin.countries.index');
Route::post('/admin/countries/store', 'Admin\CountryController@store')->name('admin.countries.store');
Route::get('/admin/countries/{id}/edit', 'Admin\CountryController@edit')->name('admin.countries.edit');
Route::put('/admin/countries/{id}', 'Admin\CountryController@update')->name('admin.countries.update');
Route::delete('/admin/countries/{id}', 'Admin\CountryController@destroy')->name('admin.countries.destroy');

Route::get('/admin/districts', 'Admin\DistrictController@index')->name('admin.districts.index');
Route::get('/admin/districts/create', 'Admin\DistrictController@create')->name('admin.districts.create');
Route::post('/admin/districts/store', 'Admin\DistrictController@store')->name('admin.districts.store');
Route::get('/admin/districts/{id}/edit', 'Admin\DistrictController@edit')->name('admin.districts.edit');
Route::put('/admin/districts/{id}', 'Admin\DistrictController@update')->name('admin.districts.update');
Route::delete('/admin/districts/{id}', 'Admin\DistrictController@destroy')->name('admin.districts.destroy');

Route::get('/admin/cities', 'Admin\CityController@index')->name('admin.cities.index');
Route::get('/admin/cities/create', 'Admin\CityController@create')->name('admin.cities.create');
Route::get('/admin/cities/{id}', 'Admin\CityController@show')->name('admin.cities.show');
Route::post('/admin/cities/store', 'Admin\CityController@store')->name('admin.cities.store');
Route::get('/admin/cities/{id}/edit', 'Admin\CityController@edit')->name('admin.cities.edit');
Route::put('/admin/cities/{id}', 'Admin\CityController@update')->name('admin.cities.update');
Route::delete('/admin/cities/{id}', 'Admin\CityController@destroy')->name('admin.cities.destroy');

Route::get('/admin/attractions', 'Admin\AttractionController@index')->name('admin.attractions.index');
Route::get('/admin/attractions/create', 'Admin\AttractionController@create')->name('admin.attractions.create');
Route::get('/admin/attractions/{id}', 'Admin\AttractionController@show')->name('admin.attractions.show');
Route::post('/admin/attractions/store', 'Admin\AttractionController@store')->name('admin.attractions.store');
Route::get('/admin/attractions/{id}/edit', 'Admin\AttractionController@edit')->name('admin.attractions.edit');
Route::put('/admin/attractions/{id}', 'Admin\AttractionController@update')->name('admin.attractions.update');
Route::delete('/admin/attractions/{id}', 'Admin\AttractionController@destroy')->name('admin.attractions.destroy');

Route::get('/admin/businessHours', 'Admin\BusinessHoursController@index')->name('admin.businessHours.index');
Route::get('/admin/businessHours/create', 'Admin\BusinessHoursController@create')->name('admin.businessHours.create');
Route::post('/admin/businessHours/store', 'Admin\BusinessHoursController@store')->name('admin.businessHours.store');
Route::get('/admin/businessHours/{id}/edit', 'Admin\BusinessHoursController@edit')->name('admin.businessHours.edit');
Route::put('/admin/businessHours/{id}', 'Admin\BusinessHoursController@update')->name('admin.businessHours.update');
Route::delete('/admin/businessHours/{id}', 'Admin\BusinessHoursController@destroy')->name('admin.businessHours.destroy');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
