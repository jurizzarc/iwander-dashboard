@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    City: {{ $city->name }}
                </div>

                <div class="card-body">
                    <table id="table-doctors" class="table table-hover">
                        <tbody>
                            <tr>
                                <td>District</td>
                                <td>{{ $city->districts->name }}</td>
                            </tr>

                            <tr>
                                <td>Country</td>
                                <td>{{ $city->districts->country->name }}</td>
                            </tr>

                            <tr>
                                <td>Description</td>
                                <td>{{ $city->description }}</td>
                            </tr>
                            <tr>
                                <td>image</td>
                                <td>
                                  <img src="{{asset('storage/images/'.$city->image)}}" style="width: 300px; height:auto;" />
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="{{ route('admin.cities.index') }}" class="btn btn-default">Back</a>

                    <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-warning">Edit</a>

                    <form style="display:inline-block" method="POST" action="{{ route('admin.cities.destroy', $city->id) }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="form-control btn btn-danger">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
