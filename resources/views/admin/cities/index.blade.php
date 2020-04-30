@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Cities
                    <a href="{{ route('admin.cities.create') }}" class="btn btn-primary float-right">Add</a>
                </div>

                <div class="card-body">
                    @if(count($cities) === 0)
                        <p>There are no districts stored in the database.</p>
                    @else

                    <table id="table-books" class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>District</th>
                            <th>Country</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach($cities as $city)
                                <tr data-id="{{ $city->id }}">
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->districts->name }}</td>
                                    <td>{{ $city->districts->country->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.cities.show', $city->id) }}" class="btn btn-default">View</a>

                                        <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-warning">Edit</a>

                                        <form style="display:inline-block" method="POST" action="{{ route('admin.cities.destroy', $city->id) }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="form-control btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center" style="margin-top:60px;">
            {{ $cities->links() }}
        </div>
    </div>
</div>
@endsection
