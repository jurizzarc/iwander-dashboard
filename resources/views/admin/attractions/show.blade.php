@extends('layouts.app')

@section('content')
<div class="container">
  @include('inc.flash-messages')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Attraction: {{ $attraction->name }}
                </div>

                <div class="card-body">
                    <table id="table-doctors" class="table table-hover">
                        <tbody>
                            <tr>
                                <td>Description</td>
                                <td>{{ $attraction->name }}</td>
                            </tr>

                            <tr>
                                <td>Category</td>
                                <td>
                                  @foreach($categories as $category)
                                  {{ $category->name }},
                                  @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Keywords</td>
                                <td>
                                  @foreach($keywords as $keyword)
                                  {{ $keyword->name }},
                                  @endforeach
                                </td>
                            </tr>

                            <tr>
                                <td>Recommended Duration</td>
                                <td>{{ $attraction->rec_duration }}</td>
                            </tr>

                            <tr>
                                <td>About</td>
                                <td>{{ $attraction->details->description }}</td>
                            </tr>

                            <tr>
                                <td>More Info</td>
                                <td>
                                    @unless ( empty($attraction->details->min_price) && empty($attraction->details->max_price) )
                                        <strong>Price</strong><br/>
                                        {{ $attraction->details->min_price }} - {{ $attraction->details->max_price }}<br/><br/>
                                    @endunless

                                    @unless ( empty($attraction->details->website) )
                                        <strong>Website</strong><br/>
                                        {{ $attraction->details->website }}
                                    @endunless

                                    @unless ( empty($attraction->details->email) )
                                        <br/><br/>
                                        <strong>Email Address</strong><br/>
                                        {{ $attraction->details->email }}
                                    @endunless

                                    @unless ( empty($attraction->details->phone) )
                                        <br/><br/>
                                        <strong>Phone</strong><br/>
                                        {{ $attraction->details->phone }}
                                    @endunless
                                </td>
                            </tr>

                            <tr>
                                <td>Location</td>
                                <td>
                                    {{ $attraction->addresses->address1 }}<br/>

                                    @unless ( empty($attraction->addresses->address2) )
                                        {{ $attraction->addresses->address2 }}<br/>
                                    @endunless

                                    @unless ( empty($attraction->addresses->address3) )
                                        {{ $attraction->addresses->address3 }}<br/>
                                    @endunless

                                    {{ $attraction->addresses->city->name }}<br/>

                                    @unless ( empty($attraction->addresses->district_id) )
                                        {{ $attraction->addresses->district->name }}<br/>
                                    @endunless

                                    @unless ( empty($attraction->addresses->postal_code) )
                                        {{ $attraction->addresses->postal_code }}<br/>
                                    @endunless

                                    {{ $attraction->addresses->country->name }}
                                </td>
                            </tr>

                            <tr>
                                <td>Business Hours</td>
                                <td>
                                    <strong>Sunday:&nbsp;</strong>
                                    @if ( !empty($attraction->businessHours[0]->open_time) && !empty($attraction->businessHours[0]->close_time) )
                                        {{ \Carbon\Carbon::parse($attraction->businessHours[0]->open_time)->format('H:i') }} &dash; {{ \Carbon\Carbon::parse($attraction->businessHours[0]->close_time)->format('H:i') }} <br/>
                                    @else
                                        Closed
                                    @endif

                                    <strong>Monday:&nbsp;</strong>
                                    @if ( !empty($attraction->businessHours[1]->open_time) && !empty($attraction->businessHours[1]->close_time) )
                                        {{ \Carbon\Carbon::parse($attraction->businessHours[1]->open_time)->format('H:i') }} &dash; {{ \Carbon\Carbon::parse($attraction->businessHours[1]->close_time)->format('H:i') }} <br/>
                                    @else
                                        Closed
                                    @endif

                                    <strong>Tuesday:&nbsp;</strong>
                                    @if ( !empty($attraction->businessHours[2]->open_time) && !empty($attraction->businessHours[2]->close_time) )
                                        {{ \Carbon\Carbon::parse($attraction->businessHours[2]->open_time)->format('H:i') }} &dash; {{ \Carbon\Carbon::parse($attraction->businessHours[2]->close_time)->format('H:i') }} <br/>
                                    @else
                                        Closed
                                    @endif

                                    <strong>Wednesday:&nbsp;</strong>
                                    @if ( !empty($attraction->businessHours[3]->open_time) && !empty($attraction->businessHours[3]->close_time) )
                                        {{ \Carbon\Carbon::parse($attraction->businessHours[3]->open_time)->format('H:i') }} &dash; {{ \Carbon\Carbon::parse($attraction->businessHours[3]->close_time)->format('H:i') }} <br/>
                                    @else
                                        Closed
                                    @endif

                                    <strong>Thursday:&nbsp;</strong>
                                    @if ( !empty($attraction->businessHours[4]->open_time) && !empty($attraction->businessHours[4]->close_time) )
                                        {{ \Carbon\Carbon::parse($attraction->businessHours[4]->open_time)->format('H:i') }} &dash; {{ \Carbon\Carbon::parse($attraction->businessHours[4]->close_time)->format('H:i') }} <br/>
                                    @else
                                        Closed
                                    @endif

                                    <strong>Friday:&nbsp;</strong>
                                    @if ( !empty($attraction->businessHours[5]->open_time) && !empty($attraction->businessHours[5]->close_time) )
                                        {{ \Carbon\Carbon::parse($attraction->businessHours[5]->open_time)->format('H:i') }} &dash; {{ \Carbon\Carbon::parse($attraction->businessHours[5]->close_time)->format('H:i') }} <br/>
                                    @else
                                        Closed
                                    @endif

                                    <strong>Saturday:&nbsp;</strong>
                                    @if ( !empty($attraction->businessHours[6]->open_time) && !empty($attraction->businessHours[6]->close_time) )
                                        {{ \Carbon\Carbon::parse($attraction->businessHours[6]->open_time)->format('H:i') }} &dash; {{ \Carbon\Carbon::parse($attraction->businessHours[6]->close_time)->format('H:i') }} <br/>
                                    @else
                                        Closed
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>image</td>
                                <td>
                                  <img src="{{asset('storage/images/'.$attraction->details->image)}}" style="width: 300px; height:300px;" />
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="{{ route('admin.attractions.index') }}" class="btn btn-default">Back</a>

                    <a href="{{ route('admin.attractions.edit', $attraction->id) }}" class="btn btn-warning">Edit</a>

                    <form style="display:inline-block" method="POST" action="{{ route('admin.attractions.destroy', $attraction->id) }}">
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
