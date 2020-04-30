<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Attraction;
use App\BusinessHours;

class BusinessHoursController extends Controller
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
        $business_hours = BusinessHours::paginate(15);

        return view('admin.businessHours.index')->with([
            'business_hours' => $business_hours
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // List of attractions in the DB
        $attractions = Attraction::orderBy('name', 'asc')->get();

        return view('admin.businessHours.create')->with([
            'attractions' => $attractions
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
            'attraction_id' => 'required',
            'day' => 'required|integer'
        ]);

        $business_hour = new BusinessHours();
        $business_hour->attraction_id = $request->input('attraction_id');
        $business_hour->day = $request->input('day');
        $business_hour->open_time = $request->input('open_time');
        $business_hour->close_time = $request->input('close_time');
        $business_hour->save();

        $request->session()->flash('success', 'Business Hours added successfully.');

        return redirect()->route('admin.businessHours.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // List of attractions in the DB
        $attractions = Attraction::orderBy('name', 'asc')->get();

        $business_hour = BusinessHours::findOrFail($id);

        return view('admin.businessHours.edit')->with([
            'attractions' => $attractions,
            'business_hour' => $business_hour
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
            'attraction_id' => 'required',
            'day' => 'required|integer'
        ]);

        $business_hour = BusinessHours::findOrFail($id);
        $business_hour->attraction_id = $request->input('attraction_id');
        $business_hour->day = $request->input('day');
        $business_hour->open_time = $request->input('open_time');
        $business_hour->close_time = $request->input('close_time');
        $business_hour->save();

        $request->session()->flash('info', 'Business Hours updated successfully.');

        return redirect()->route('admin.businessHours.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $business_hour = BusinessHours::findOrFail($id);

        $business_hour->delete();

        $request->session()->flash('danger', 'Business Hours deleted from the database.');

        return redirect()->route('admin.businessHours.index');
    }
}
