@extends('layouts.app')

@section('content')
@include('inc.sidebar')

<div class="container">
    <div class="row">

        <div class="col-12 col-lg-8 offset-lg-3 col-md-9 offset-md-3">

            <div class="row top-row">
                <div class="col-lg-12">
                    @include('inc.flash-messages')
                    
                    <h2>Countries</h2>
                </div>
            </div>

            <div class="row">
                <div class="table-responsive">
                    <table class="table" id="table-countries">

                        @if(count($countries) === 0)
                            <p>There are no countries stored in the database.</p>
                        @else
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Continent</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($countries as $country)
                                    <tr data-id="{{ $country->id }}">
                                        <td>{{ $country->name }}</td>
                                        <td>{{ $country->continent }}</td>
                                        <td class="actions">
                                            <a href="{{ route('admin.countries.edit', $country->id) }}">Edit</a>  
                                            <form style="display:inline-block" method="POST" action="{{ route('admin.countries.destroy', $country->id) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-link">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>

            <div class="row pagination-row">
                <div class="pagination-links">
                    {{ $countries->links() }}
                </div>
            </div>

        </div>

    </div>
</div>
@endsection