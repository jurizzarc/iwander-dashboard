@extends('layouts.app')

@section('content')
@include('inc.sidebar')

<div class="container">
    <div class="row">

        <div class="col-12 col-lg-8 offset-lg-3 col-md-9 offset-md-3">

            <div class="row top-row">
                <div class="col-lg-12">
                    @include('inc.flash-messages')
                </div>

                <div class="col-lg-4 col-sm-12">
                    <h2>Attractions</h2>
                </div>

                <div class="col-lg-8 button-col d-none d-lg-block d-md-block">
                    <a class="btn btn-primary" href="{{ route('admin.attractions.create') }}" role="button">
                        <span data-jam="plus" data-fill="#fff" data-width="20" data-height="20"></span> Add Attraction
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="table-responsive">
                    <table class="table" id="table-attractions">

                        @if(count($attractions) === 0)
                            <p>There are no attractions stored in the database.</p>
                        @else
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>City</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($attractions as $attraction)
                                    <tr data-id="{{ $attraction->id }}">
                                        <td>
                                            <a href="{{ route('admin.attractions.show', $attraction->id) }}">{{ $attraction->name }}</a>
                                        </td>
                                        <td>{{ $attraction->addresses->city->name }}</td>
                                        <td class="actions">
                                            <a href="{{ route('admin.attractions.edit', $attraction->id) }}">Edit</a>  
                                            <form style="display:inline-block" method="POST" action="{{ route('admin.attractions.destroy', $attraction->id) }}">
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
                    {{ $attractions->links() }}
                </div>
            </div>

        </div>

    </div>
</div>
@endsection