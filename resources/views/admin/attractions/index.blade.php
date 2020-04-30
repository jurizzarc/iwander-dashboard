@extends('layouts.app')

@section('content')
<div class="container">
    @include('inc.flash-messages')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Attractions
                    <a href="{{ route('admin.attractions.create') }}" class="btn btn-primary float-right">Add</a>
                </div>

                <div class="card-body">
                    @if(count($attractions) === 0)
                        <p>There are no attractions stored in the database.</p>
                    @else

                    <table id="table-books" class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach($attractions as $attraction)
                                <tr data-id="{{ $attraction->id }}">
                                    <td>{{ $attraction->name }}</td>
                                    <td>{{ $attraction->addresses->city->name }}</td>
                                    <td>{{ $attraction->addresses->country->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.attractions.show', $attraction->id) }}" class="btn btn-default">View</a>

                                        <a href="{{ route('admin.attractions.edit', $attraction->id) }}" class="btn btn-warning">Edit</a>

                                        <form style="display:inline-block" method="POST" action="{{ route('admin.attractions.destroy', $attraction->id) }}">
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
            {{ $attractions->links() }}
        </div>
    </div>
</div>
@endsection
