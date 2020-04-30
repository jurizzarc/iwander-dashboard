<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
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
        $countries = Country::orderBy('name', 'asc')->paginate(15);

        return view('admin.countries.index')->with([
            'countries' => $countries
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
        $country = Country::findOrFail($id);

        return view('admin.countries.edit')->with([
           'country' => $country
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
            'continent' => 'required|string|max:20',
        ]);

        $country = Country::findOrFail($id);
        $country->name = $request->input('name');
        $country->continent = $request->input('continent');

        // update this country in the countries table
        $country->save();

        $request->session()->flash('info', 'Country updated successfully.');

        return redirect()->route('admin.countries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $country->delete();

        $request->session()->flash('danger', 'Country deleted from the database.');

        return redirect()->route('admin.countries.index');
    }
}
