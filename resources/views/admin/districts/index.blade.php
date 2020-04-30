@extends('layouts.app')

@section('content')
<div class="container">
  @include('inc.flash-messages')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Districts
                    <a href="{{ route('admin.districts.create') }}" class="btn btn-primary float-right">Add</a>
                </div>

                <div class="card-body">
                    @if(count($districts) === 0)
                        <p>There are no districts stored in the database.</p>
                    @else

                    <table id="table-books" class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach($districts as $district)
                                <tr data-id="{{ $district->id }}">
                                    <td>{{ $district->name }}</td>
                                    <td>{{ $district->country->name }}</td>
                                    <td>
                                        
                                        <a href="{{ route('admin.districts.edit', $district->id) }}" class="btn btn-warning">Edit</a>

                                        <form style="display:inline-block" method="POST" action="{{ route('admin.districts.destroy', $district->id) }}">
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
            {{ $districts->links() }}
        </div>
    </div>
</div>
@endsection
