@extends('layouts.app')

@section('content')
@include('inc.sidebar')

<div class="container">
    <div class="row">

        <div class="col-12 col-lg-6 offset-lg-4">

            <div class="row lg-form-heading">
                <div class="col-12">
                    <h3>Edit Country</h3>
                    <p>
                        <span>&ast;</span> &mdash; Required fields
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.countries.update', $country->id) }}">
                <input type="hidden" name="_method" value="PUT" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-row">

                    <div class="form-group col-lg-6 col-sm-12">
                        <label class="required" for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $country->name) }}" />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6 col-sm-12">
                        <label class="required" for="continent">Continent</label>
                        <input type="text" class="form-control" id="continent" name="continent" value="{{ old('continent', $country->continent) }}" />

                        @error('continent')
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