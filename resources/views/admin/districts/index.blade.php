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
                    <h2>Districts</h2>
                </div>

                <div class="col-lg-8 button-col d-none d-lg-block d-md-block">
                    <a class="btn btn-primary" href="{{ route('admin.districts.create') }}" role="button">
                        <span data-jam="plus" data-fill="#fff" data-width="20" data-height="20"></span> Add District
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="table-responsive">
                    <table class="table" id="table-districts">

                        @if(count($districts) === 0)
                            <p>There are no districts stored in the database.</p>
                        @else
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($districts as $district)
                                    <tr data-id="{{ $district->id }}">
                                        <td>{{ $district->name }}</td>
                                        <td>{{ $district->country->name }}</td>
                                        <td class="actions">
                                            <a href="{{ route('admin.districts.edit', $district->id) }}">Edit</a>  
                                            <form style="display:inline-block" method="POST" action="{{ route('admin.districts.destroy', $district->id) }}">
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
                    {{ $districts->links() }}
                </div>
            </div>

        </div>

    </div>
</div>
@endsection