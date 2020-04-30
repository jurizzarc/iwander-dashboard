@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Edit District
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

                    <form method="POST" action="{{ route('admin.districts.update', $district->id) }}"  enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $district->name) }}" />
                        </div>

                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select class="form-control" id="country_id" name="country_id">
                                <option></option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ (old('country_id', $district->country->id) == $country->id) ? "selected" : "" }}>
                                    {{ $country->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <a href="{{ route('admin.districts.index') }}" class="btn btn-link">Cancel</a>

                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
