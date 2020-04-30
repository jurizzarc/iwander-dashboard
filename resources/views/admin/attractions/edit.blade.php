@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Edit attraction
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.attractions.update', $attraction->id) }}"  enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $attraction->name) }}" />
                        </div>
                        <div class="form-group">
                            <label for="category_id">Categories</label><br/>
                            @foreach ($categories as $category)
                              <input type="checkbox" name="categories[]" id="categories" value="{{$category->id}}"/>
                              {{ $category->name}}
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="category_id">Keywords</label><br/>
                            @foreach ($keywords as $keyword)
                              <input type="checkbox" name="keywords[]" id="keywords" value="{{$keyword->id}}"/>
                              {{ $keyword->name}}
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="rec_duration">Recommended Duration</label>
                            <input type="text" class="form-control" id="rec_duration" name="rec_duration" value="{{ old('rec_duration', $attraction->rec_duration) }}" />
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $attraction->details->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website" value="{{ old('website', $attraction->details->website) }}" />
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $attraction->details->email) }}" />
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $attraction->details->phone) }}" />
                        </div>

                        <div class="form-group">
                            <label for="min_price">Minimum Price</label>
                            <input type="text" class="form-control" id="min_price" name="min_price" value="{{ old('min_price', $attraction->details->min_price) }}" />
                        </div>

                        <div class="form-group">
                            <label for="max_price">Maximum Price</label>
                            <input type="text" class="form-control" id="max_price" name="max_price" value="{{ old('max_price', $attraction->details->max_price) }}" />
                        </div>

                        <div class="form-group">
                            <label for="address1">Address Line 1</label>
                            <input type="text" class="form-control" id="address1" name="address1" value="{{ old('address1', $attraction->addresses->address1) }}" />
                        </div>

                        <div class="form-group">
                            <label for="address2">Address Line 2</label>
                            <input type="text" class="form-control" id="address2" name="address2" value="{{ old('address2', $attraction->addresses->address2) }}" />
                        </div>

                        <div class="form-group">
                            <label for="address3">Address Line 3</label>
                            <input type="text" class="form-control" id="address3" name="address3" value="{{ old('address3', $attraction->addresses->address3) }}" />
                        </div>

                        <div class="form-group">
                            <label for="city_id">City</label>
                            <select class="form-control" id="city_id" name="city_id">
                                <option></option>
                                @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ (old('city_id', $attraction->addresses->city->id) == $city->id) ? "selected" : "" }}>
                                    {{ $city->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="district_id">District</label>
                            <select class="form-control" id="district_id" name="district_id">
                                <option></option>
                                @unless ( empty($attraction->addresses->district->name) )
                                    @foreach ($districts as $district)
                                    <option value="{{ $district->id }}" {{ (old('district_id', $attraction->addresses->district->id) == $district->id) ? "selected" : "" }}>
                                        {{ $district->name }}
                                    </option>
                                    @endforeach
                                @endunless
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code', $attraction->addresses->postal_code) }}" />
                        </div>

                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select class="form-control" id="country_id" name="country_id">
                                <option></option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ (old('country_id', $attraction->addresses->country->id) == $country->id) ? "selected" : "" }}>
                                    {{ $country->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                          <div class="custom-file">
                              <input type="file" name="image" id="image" class="custom-file-input">
                              <label class="custom-file-label" for="image">Upload image</label>
                              @if($errors->has('image'))
                                  <span class="invalid-feedback">
                                      {{$errors->first('image')}}
                                  </span>
                              @endif
                          </div>
                        </div>

                        <a href="{{ route('admin.attractions.show', $attraction->id) }}" class="btn btn-link">Cancel</a>

                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
