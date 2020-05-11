@extends('layouts.app')

@section('content')
@include('inc.sidebar')

<div class="container">
    <div class="row">

        <div class="col-12 col-lg-6 offset-lg-4">

            <div class="row lg-form-heading">
                <div class="col-12">
                    <h3>Edit Attraction</h3>
                    <p>
                        <span>&ast;</span> &mdash; Required fields
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.attractions.update', $attraction->id) }}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-row">

                    <div class="form-group col-12">
                        <label class="required" for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $attraction->name) }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="categories">Categories</label><br/>
                        @foreach ($categories as $category)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="categories" name="categories[]" value="{{ $category->id }}">
                                <label class="form-check-label" for="categories">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group col-12">
                        <label for="keywords">Keywords</label><br/>
                        @foreach ($keywords as $keyword)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="keywords" name="keywords[]" value="{{ $keyword->id }}">
                                <label class="form-check-label" for="keywords">{{ $keyword->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group col-lg-6 col-sm-12">
                        <label for="min_price">Minimum Admission Fee</label>
                        <input type="text" class="form-control" id="min_price" name="min_price" value="{{ old('min_price', $attraction->details->min_price) }}">
                    </div>

                    <div class="form-group col-lg-6 col-sm-12">
                        <label for="max_price">Maximum Admission Fee</label>
                        <input type="text" class="form-control" id="max_price" name="max_price" value="{{ old('max_price', $attraction->details->max_price) }}">
                    </div>

                    <div class="form-group col-lg-6 col-sm-12">
                        <label class="required" for="rec_duration">Recommended Duration</label>
                        <input type="text" class="form-control" id="rec_duration" name="rec_duration" value="{{ old('rec_duration', $attraction->rec_duration) }}">

                        @error('rec_duration')
                            <span class="invalid-feedback" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6 col-sm-12">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $attraction->details->phone) }}">
                    </div>

                    <div class="form-group col-12">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" id="website" name="website" value="{{ old('website', $attraction->details->website) }}">
                    </div>

                    <div class="form-group col-12">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $attraction->details->email) }}">
                    </div>

                    <div class="form-group col-12">
                        <label class="required" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description', $attraction->details->description) }}</textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="image">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image" value="{{ old('image', $attraction->details->image) }}">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <label class="required" for="address1">Address Line 1</label>
                        <input type="text" class="form-control" id="address1" name="address1" value="{{ old('address1', $attraction->addresses->address1) }}">

                        @error('address1')
                            <span class="invalid-feedback" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="address2">Address Line 2</label>
                        <input type="text" class="form-control" id="address2" name="address2" value="{{ old('address2', $attraction->addresses->address2) }}">
                    </div>

                    <div class="form-group col-12">
                        <label for="address3">Address Line 3</label>
                        <input type="text" class="form-control" id="address3" name="address3" value="{{ old('address3', $attraction->addresses->address3) }}">
                    </div>

                    <div class="form-group col-lg-6 col-sm-12">
                        <label class="required" for="city_id">City</label>
                        <select class="custom-select" id="city_id" name="city_id">
                            <option></option>
                            @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ (old('city_id', $attraction->addresses->city->id) == $city->id) ? "selected" : "" }}>
                                {{ $city->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('city_id')
                            <span class="invalid-feedback" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6 col-sm-12">
                        <label for="district_id">District</label>
                        <select class="custom-select" id="district_id" name="district_id">
                            <option></option>
                            @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ (old('district_id', $attraction->addresses->district->id) == $district->id) ? "selected" : "" }}>
                                {{ $district->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-6 col-sm-12">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code', $attraction->addresses->postal_code) }}">
                    </div>

                    <div class="form-group col-lg-6 col-sm-12">
                        <label class="required" for="country_id">Country</label>
                        <select class="custom-select" id="country_id" name="country_id">
                            <option></option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ (old('country_id', $attraction->addresses->country->id) == $country->id) ? "selected" : "" }}>
                                {{ $country->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="lg-form-button">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>

                </div>
            </form>

        </div>

    </div>
</div>
@endsection
