<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Storage;
use App\Country;
use App\District;
use App\City;
use App\Address;
use App\Detail;
use App\Category;
use App\Attraction;
use App\Keyword;

class AttractionController extends Controller
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
        $attractions = Attraction::orderBy('name', 'asc')->paginate(15);

        return view('admin.attractions.index')->with([
            'attractions' => $attractions,
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
        // List of districts in the DB
        $districts = District::orderBy('name', 'asc')->get();
        // List of cities in the DB
        $cities = City::orderBy('name', 'asc')->get();
        // List of categories in the DB
        $categories = Category::all();

        $keywords = Keyword::all();

        return view('admin.attractions.create')->with([
            'countries' => $countries,
            'districts' => $districts,
            'cities' => $cities,
            'categories' => $categories,
            'keywords' => $keywords
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
         'rec_duration' => 'required|string|max:50',
         'description' => 'required|string',
         'address1' => 'required|string|max:255',
         'city_id' => 'required',
         'country_id' => 'required',
         'image' => 'nullable|image|max:1999'
     ]);

        $detail = new Detail();
        $detail->description = $request->input('description');
        $detail->website = $request->input('website');
        $detail->email = $request->input('email');
        $detail->phone = $request->input('phone');
        $detail->min_price = $request->input('min_price');
        $detail->max_price = $request->input('max_price');
        if($request->hasFile('image')){
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->storeAs('public/images', $filename);
            Storage::delete("public/images/{$detail->image}");
            $detail->image = $filename;
        }
        // Insert this detail object into the details table
        $detail->save();

        $address = new Address();
        $address->address1 = $request->input('address1');
        $address->address2 = $request->input('address2');
        $address->address3 = $request->input('address3');
        $address->city_id = $request->input('city_id');
        $address->district_id = $request->input('district_id');
        $address->postal_code = $request->input('postal_code');
        $address->country_id = $request->input('country_id');

        // Insert this address object into the addresses table
        $address->save();

        $attraction = new Attraction();
        $attraction->name = $request->input('name');
        // $attraction->category_id = $request->input('category_id');
        $attraction->rec_duration = $request->input('rec_duration');
        // Associate the attraction object to the detail object
        $attraction->details()->associate($detail->id);
        // Associate the attraction object to the address object
        $attraction->addresses()->associate($address->id);

        // Insert this attraction object into the attractions table
        $attraction->save();

        $attraction->categories()->attach($request->categories);
        $attraction->keywords()->attach($request->keywords);

        $request->session()->flash('success', 'Attraction added successfully.');

        return redirect()->route('admin.attractions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attraction = Attraction::findOrFail($id);

        $categories = $attraction->categories()->get();
        $keywords = $attraction->keywords()->get();
        return view('admin.attractions.show')->with([
           'attraction' => $attraction,
           'categories' => $categories,
           'keywords' => $keywords
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
        $countries = Country::orderBy('name', 'asc')->get();
        // List of districts in the DB
        $districts = District::orderBy('name', 'asc')->get();
        // List of cities in the DB
        $cities = City::orderBy('name', 'asc')->get();
        // List of categories in the DB
        $categories = Category::all();
        $keywords = Keyword::all();

        $attraction = Attraction::findOrFail($id);
        $category_attraction = $attraction->categories()->get();
        $category_attraction_ids = array();
        foreach ($category_attraction as $key) {
          $category_attraction_ids = $key->id;
        }
        // dd($category_attraction_ids);
        // $keyword_attraction = $attraction->keywords()->get();

        return view('admin.attractions.edit')->with([
            'countries' => $countries,
            'districts' => $districts,
            'cities' => $cities,
            'categories' => $categories,
            'attraction' => $attraction,
            // 'category_attraction' => $category_attraction,
            'keywords' => $keywords
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
          'rec_duration' => 'required|string|max:50',
          'description' => 'required|string',
          'address1' => 'required|string|max:255',
          'city_id' => 'required',
          'country_id' => 'required',
          'image' => 'nullable|image|max:1999'
      ]);

        $attraction = Attraction::findOrFail($id);

        $attraction->details->description = $request->input('description');
        $attraction->details->website = $request->input('website');
        $attraction->details->email = $request->input('email');
        $attraction->details->phone = $request->input('phone');
        $attraction->details->min_price = $request->input('min_price');
        $attraction->details->max_price = $request->input('max_price');

        if($request->hasFile('image')){
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$ext;
            $image->storeAs('public/images', $filename);
            Storage::delete("public/images/{$attraction->details->image}");
            $attraction->details->image = $filename;
        }

        $attraction->addresses->address1 = $request->input('address1');
        $attraction->addresses->address2 = $request->input('address2');
        $attraction->addresses->address3 = $request->input('address3');
        $attraction->addresses->city_id = $request->input('city_id');
        $attraction->addresses->district_id = $request->input('district_id');
        $attraction->addresses->postal_code = $request->input('postal_code');
        $attraction->addresses->country_id = $request->input('country_id');

        $attraction->name = $request->input('name');
        $attraction->rec_duration = $request->input('rec_duration');

        // Update this object in the details table
        $attraction->details->save();
        // Update this object in the addresses table
        $attraction->addresses->save();
        // Update this object in the attractions table
        $attraction->save();

        //delete previous categories and update categories
        $attraction->categories()->sync($request->categories);
        $attraction->keywords()->sync($request->keywords);

        $request->session()->flash('info', 'Attraction updated successfully.');

        return redirect()->route('admin.attractions.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $attraction = Attraction::findOrFail($id);
        $attraction->details()->delete();
        $attraction->addresses()->delete();

        $request->session()->flash('danger', 'Attraction deleted from the database.');

        return redirect()->route('admin.attractions.index');
    }
}
