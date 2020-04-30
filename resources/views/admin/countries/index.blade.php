@extends('layouts.app')

@section('content')
<div class="container">
  @include('inc.flash-messages')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Countries
                </div>

                <div class="card-body">
                    @if(count($countries) === 0)
                        <p>There are no countries stored in the database.</p>
                    @else

                    <table id="table-books" class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Continent</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach($countries as $country)
                                <tr data-id="{{ $country->id }}">
                                    <td>{{ $country->name }}</td>
                                    <td>{{ $country->continent }}</td>
                                    <td>
                                        <a href="{{ route('admin.countries.edit', $country->id) }}" class="btn btn-warning">Edit</a>

                                        <form style="display:inline-block" method="POST" action="{{ route('admin.countries.destroy', $country->id) }}">
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
            {{ $countries->links() }}
        </div>
    </div>
</div>
@endsection
