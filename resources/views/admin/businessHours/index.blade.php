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

                <div class="col-lg-6 col-sm-12">
                    <h2>Business Hours</h2>
                </div>

                <div class="col-lg-6 button-col d-none d-lg-block d-md-block">
                    <a class="btn btn-primary" href="{{ route('admin.businessHours.create') }}" role="button">
                        <span data-jam="plus" data-fill="#fff" data-width="20" data-height="20"></span> Add Hours
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="table-responsive">
                    <table class="table" id="table-cities">

                        @if(count($business_hours) === 0)
                            <p>There are no business hours stored in the database.</p>
                        @else
                            <thead>
                                <tr>
                                    <th>Attraction</th>
                                    <th>Day</th>
                                    <th>Opening</th>
                                    <th>Closing</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($business_hours as $business_hour)
                                    <tr data-id="{{ $business_hour->id }}">
                                        <td style="width:40%;">
                                            <a href="{{ route('admin.attractions.show', $business_hour->attraction->id) }}">
                                                {{ $business_hour->attraction->name }}
                                            </a>
                                        </td>
                                        <td>
                                            @if ($business_hour->day == 1) Sunday
                                            @elseif ($business_hour->day == 2) Monday
                                            @elseif ($business_hour->day == 3) Tuesday
                                            @elseif ($business_hour->day == 4) Wednesday
                                            @elseif ($business_hour->day == 5) Thursday
                                            @elseif ($business_hour->day == 6) Friday
                                            @elseif ($business_hour->day == 7) Saturday
                                            @endif
                                        </td>
                                        <td>
                                            @if (empty ($business_hour->open_time)) Closed
                                            @else {{ \Carbon\Carbon::parse($business_hour->open_time)->format('H:i') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (empty ($business_hour->close_time)) Closed
                                            @else {{ \Carbon\Carbon::parse($business_hour->close_time)->format('H:i') }}
                                            @endif
                                        </td>
                                        <td class="actions">
                                            <a href="{{ route('admin.businessHours.edit', $business_hour->id) }}">Edit</a>  
                                            <form style="display:inline-block" method="POST" action="{{ route('admin.businessHours.destroy', $business_hour->id) }}">
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
                    {{ $business_hours->links() }}
                </div>
            </div>

        </div>

    </div>
</div>
@endsection