<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\District;
use App\City;
use Storage;

class CityController extends Controller
{
    public function __construct()
    {
        // Makes sure that before the user can access the functions below, they'll need to be authorised
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::orderBy('name', 'asc')->paginate(15);

        return view('admin.cities.index')->with([
            'cities' => $cities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // List of districts in the DB
        $districts = District::orderBy('name', 'asc')->get();

        return view('admin.cities.create')->with([
            'districts' => $districts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'district_id' => 'required',
            'image' => 'nullable|image|max:1999'
        ]);

        $city = new City();
        $city->name = $request->input('name');
        $city->description = $request->input('description');
        $city->district_id = $request->input('district_id');

        if($request->hasFile('image')){
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->storeAs('public/images', $filename);
            Storage::delete("public/images/{$city->image}");
            $city->image = $filename;
        }

        // Insert this city into the cities table
        $city->save();
        $request->session()->flash('success', 'City added successfully.');

        return redirect()->route('admin.cities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::findOrFail($id);

        return view('admin.cities.show')->with([
           'city' => $city
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // List of countries in the DB
        $districts = District::orderBy('name', 'asc')->get();
        $city = City::findOrFail($id);
        return view('admin.cities.edit')->with([
           'districts' => $districts,
           'city' => $city
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // dd($request->hasFile('image'));
      $request->validate([
                  'name' => 'required|string|max:255',
                  'description' => 'required|string',
                  'district_id' => 'required',
                  'image' => 'nullable|image|max:1999',

              ]);

        $city = City::findOrFail($id);
        $city->name = $request->input('name');
        $city->description = $request->input('description');
        $city->district_id = $request->input('district_id');

        if($request->hasFile('image')){
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->storeAs('public/images', $filename);
            Storage::delete("public/images/{$city->image}");
            $city->image = $filename;
        }

        // update this district in the districts table
        $city->save();
        $request->session()->flash('info', 'City updated successfully.');

        return redirect()->route('admin.cities.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $city = City::findOrFail($id);

        $city->delete();
        $request->session()->flash('danger', 'City deleted from the database.');


        return redirect()->route('admin.cities.index');
    }
}
