@extends('layouts.app')

@section('content')
@include('inc.sidebar')

<div class="container">
    <div class="row">

        <div class="col-12 col-lg-6 offset-lg-4">

            <div class="row lg-form-heading">
                <div class="col-12">
                    <h3>Add District</h3>
                    <p>
                        <span>&ast;</span> &mdash; Required fields
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.districts.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-row">

                    <div class="form-group col-lg-6 col-sm-12">
                        <label class="required" for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6 col-sm-12">
                        <label class="required" for="country_id">Country</label>
                        <select class="custom-select" id="country_id" name="country_id">
                            <option></option>
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ (old('country_id') == $country->id) ? "selected" : "" }}>
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
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>

                </div>
            </form>

        </div>

    </div>
</div>
@endsection
