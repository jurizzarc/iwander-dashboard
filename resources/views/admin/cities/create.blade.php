@extends('layouts.app')

@section('content')
@include ('inc.sidebar')

<div class="container">
    <div class="row">

        <div class="col-12 col-lg-6 offset-lg-4">
            
            <div class="row lg-form-heading">
                <div class="col-12">
                    <h3>Add City</h3>
                    <p>
                        <span>&ast;</span> &mdash; Required fields 
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.cities.store') }}">
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
                        <label class="required" for="district_id">District</label>
                        <select class="custom-select" id="district_id" name="district_id">
                            <option></option>
                            @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ (old('district_id') == $district->id) ? "selected" : "" }}>
                                {{ $district->name }}, {{ $district->country->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('district_id')
                            <span class="invalid-feedback" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label class="required" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description') }} </textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="image">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image" value="{{ old('image') }}" />
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
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
