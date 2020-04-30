@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Edit Country
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

                    <form method="POST" action="{{ route('admin.countries.update', $country->id) }}"  enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $country->name) }}" />
                        </div>
                        <div class="form-group">
                            <label for="continent">Continent</label>
                            <input type="text" class="form-control" id="continent" name="continent" value="{{ old('continent', $country->continent) }}" />
                        </div>

                        <a href="{{ route('admin.countries.index') }}" class="btn btn-link">Cancel</a>

                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
