@extends('layouts.app')

@section('content')
<div class="container">
    @include('inc.flash-messages')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Business Hours
                    <a href="{{ route('admin.businessHours.create') }}" class="btn btn-primary float-right">Add</a>
                </div>

                <div class="card-body">
                    @if(count($business_hours) === 0)
                    <p>There are no business hours stored in the database.</p>
                    @else

                    <table id="table-books" class="table table-hover">
                        <thead>
                            <th>Attraction</th>
                            <th>Day</th>
                            <th>Open Time</th>
                            <th>Close Time</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach($business_hours as $business_hour)
                            <tr data-id="{{ $business_hour->id }}">
                                <td>
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
                                    @else {{ $business_hour->open_time }}
                                    @endif
                                </td>
                                <td>
                                    @if (empty ($business_hour->close_time)) Closed
                                    @else {{ $business_hour->close_time }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.businessHours.edit', $business_hour->id) }}"
                                        class="btn btn-warning">Edit</a>

                                    <form style="display:inline-block" method="POST"
                                        action="{{ route('admin.businessHours.destroy', $business_hour->id) }}">
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
            {{ $business_hours->links() }}
        </div>
    </div>
</div>
@endsection
