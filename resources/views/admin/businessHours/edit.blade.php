@extends('layouts.app')

@section('content')
@include('inc.sidebar')

<div class="container">
    <div class="row">

        <div class="col-12 col-lg-6 offset-lg-4">

            <div class="row lg-form-heading">
                <div class="col-12">
                    <h3>Edit Business Hours</h3>
                    <p>
                        <span>&ast;</span> &mdash; Required fields
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.businessHours.update', $business_hour->id) }}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-row">

                    <div class="form-group col-12">
                        <label class="required" for="attraction_id">Attraction</label>
                        <select class="custom-select" id="attraction_id" name="attraction_id">
                            <option></option>
                            @foreach ($attractions as $attraction)
                            <option value="{{ $attraction->id }}" {{ (old('attraction_id', $business_hour->attraction->id) == $attraction->id) ? "selected" : "" }}>
                                {{ $attraction->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('attraction_id')
                            <span class="invalid-feedback" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-4 col-sm-12">
                        <label class="required" for="day">Day</label>
                        <select class="custom-select" id="day" name="day">
                            <option></option>
                                <option value="1" {{ (old('day', $business_hour->day) == 1) ? 'selected' : '' }}>Sunday</option>
                                <option value="2" {{ (old('day', $business_hour->day) == 2) ? 'selected' : '' }}>Monday</option>
                                <option value="3" {{ (old('day', $business_hour->day) == 3) ? 'selected' : '' }}>Tuesday</option>
                                <option value="4" {{ (old('day', $business_hour->day) == 4) ? 'selected' : '' }}>Wednesday</option>
                                <option value="5" {{ (old('day', $business_hour->day) == 5) ? 'selected' : '' }}>Thursday</option>
                                <option value="6" {{ (old('day', $business_hour->day) == 6) ? 'selected' : '' }}>Friday</option>
                                <option value="7" {{ (old('day', $business_hour->day) == 7) ? 'selected' : '' }}>Saturday</option>
                        </select>

                        @error('day')
                            <span class="invalid-feedback" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="open_time">Opening Time</label>
                        <input type="time" class="form-control" id="open_time" name="open_time" value="{{ old('open_time', $business_hour->open_time) }}">
                    </div>

                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="close_time">Closing Time</label>
                        <input type="time" class="form-control" id="close_time" name="close_time" value="{{ old('close_time', $business_hour->close_time) }}">
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
