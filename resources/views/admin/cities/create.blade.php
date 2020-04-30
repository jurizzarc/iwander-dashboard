@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Add new city
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

                    <form method="POST" action="{{ route('admin.cities.store') }}"  enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="district_id">District</label>
                            <select class="form-control" id="district_id" name="district_id">
                                <option></option>
                                @foreach ($districts as $district)
                                <option value="{{ $district->id }}" {{ (old('district_id') == $district->id) ? "selected" : "" }}>
                                    {{ $district->name }}, {{ $district->country->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                          <div class="custom-file">
                              <input type="file" name="image" id="image" class="custom-file-input">
                              <label class="custom-file-label" for="image">Upload Image</label>
                              @if($errors->has('image'))
                                  <span class="invalid-feedback">
                                      {{$errors->first('image')}}
                                  </span>
                              @endif
                          </div>
                        </div>

                        <a href="{{ route('admin.cities.index') }}" class="btn btn-link">Cancel</a>

                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
