<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use App\District;

class DistrictController extends Controller
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
        $districts = District::orderBy('name', 'asc')->paginate(15);

        return view('admin.districts.index')->with([
            'districts' => $districts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // List of countries in the DB
        $countries = Country::orderBy('name', 'asc')->get();

        return view('admin.districts.create')->with([
            'countries' => $countries
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
            'country_id' => 'required'
        ]);

        $district = new District();
        $district->name = $request->input('name');
        $district->country_id = $request->input('country_id');

        // Insert this district into the districts table
        $district->save();

        $request->session()->flash('success', 'District added successfully.');

        return redirect()->route('admin.districts.index');
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
        $countries = Country::orderBy('name', 'asc')->get();
        $district = District::findOrFail($id);

        return view('admin.districts.edit')->with([
           'countries' => $countries,
           'district' => $district
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
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required'
        ]);

        $district = District::findOrFail($id);
        $district->name = $request->input('name');
        $district->country_id = $request->input('country_id');

        // update this district in the districts table
        $district->save();

        $request->session()->flash('info', 'District updated successfully.');

        return redirect()->route('admin.districts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $district = District::findOrFail($id);

        $district->delete();

        $request->session()->flash('danger', 'District deleted from the database.');

        return redirect()->route('admin.districts.index');
    }
}
