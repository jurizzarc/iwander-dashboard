@extends('layouts.app')

@section('content')
@include('inc.sidebar')

<div class="container">
    <div class="row">

        <div class="col-12 col-lg-6 offset-lg-4 col-md-9 offset-md-3">
            <div class="row">

                <div class="col-12" style="margin-top: 50px;">
                    @include('inc.flash-messages')
                </div>

                <div class="col-12 item-title">
                    <h4>{{ $attraction->name }}</h4>
                </div>

                <div class="col-12 item-image">
                    <img src="{{ asset('../images/'.$attraction->details->image) }}">
                </div>

                <div class="col-12 item-info">
                    <div class="row">

                        <div class="col-lg-6 col-sm-12 info-col">
                            <h6 class="column-name">Categories</h6>
                            <p class="column-data">
                                <ul class="list-inline">
                                    @foreach($categories as $category)
                                        <li class="list-inline-item">{{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>

                        <div class="col-lg-6 col-sm-12 info-col">
                            <h6 class="column-name">Keywords</h6>
                            <p class="column-data">
                                <ul class="list-inline">
                                    @foreach($keywords as $keyword)
                                        <li class="list-inline-item">{{ $keyword->name }}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>

                        <div class="col-lg-6 col-sm-12 info-col">
                            <h6 class="column-name">Admission</h6>
                            <p class="column-data">
                                @if ( empty($attraction->details->min_price) && empty($attraction->details->max_price) )
                                    Free
                                @else
                                    &euro;{{ $attraction->details->min_price }} &dash; {{ $attraction->details->max_price }}
                                @endif
                            </p>
                        </div>

                        <div class="col-lg-6 col-sm-12 info-col">
                            <h6 class="column-name">Recommended Duration</h6>
                            <p class="column-data">{{ $attraction->rec_duration }}</p>
                        </div>

                        <div class="col-12 info-col">
                            <h6 class="column-name">Description</h6>
                            <p class="column-data">{{ $attraction->details->description }}</p>
                        </div>

                        <div class="col-12 info-col">
                            <h6 class="column-name">Location</h6>
                            <p class="column-data">
                                {{ $attraction->addresses->address1 }}

                                @unless ( empty($attraction->addresses->address2) )
                                    <br/>{{ $attraction->addresses->address2 }}
                                @endunless

                                @unless ( empty($attraction->addresses->address3) )
                                    <br/>{{ $attraction->addresses->address3 }}
                                @endunless

                                <br/>{{ $attraction->addresses->city->name }}

                                @unless ( empty($attraction->addresses->district_id) )
                                    <br/>{{ $attraction->addresses->district->name }}
                                @endunless

                                @unless ( empty($attraction->addresses->postal_code) )
                                    <br/>{{ $attraction->addresses->postal_code }}
                                @endunless

                                <br/>{{ $attraction->addresses->country->name }}
                            </p>
                        </div>

                        <div class="col-12 info-col">
                            <h6 class="column-name">Contact</h6>
                            <p class="column-data">
                                @unless ( empty($attraction->details->phone) )
                                    {{ $attraction->details->phone }}
                                @endunless

                                @unless ( empty($attraction->details->website) )
                                    <br/><a href="{{ $attraction->details->website }}">{{ $attraction->details->website }}</a>
                                @endunless

                                @unless ( empty($attraction->details->email) )
                                    <br/><a href="mailto:{{ $attraction->details->email }}">{{ $attraction->details->email }}</a>
                                @endunless
                            </p>
                        </div>

                        <div class="col-lg-6 col-sm-12 info-col">
                            <h6 class="column-name">Hours</h6>
                            <div class="column-data">
                                <table class="hours-table">
                                    @for ($i = 0; $i < 7; $i++)
                                        <tr>
                                            <td class="day">
                                                @if ($i == 0) 
                                                    Sunday
                                                @elseif ($i == 1) 
                                                    Monday
                                                @elseif ($i == 2) 
                                                    Tuesday
                                                @elseif ($i == 3) 
                                                    Wednesday
                                                @elseif ($i == 4) 
                                                    Thursday
                                                @elseif ($i == 5) 
                                                    Friday
                                                @else 
                                                    Saturday
                                                @endif
                                            </td>

                                            <td>
                                                @if ( !empty($attraction->businessHours[$i]->open_time) && !empty($attraction->businessHours[$i]->close_time) )
                                                    {{ \Carbon\Carbon::parse($attraction->businessHours[$i]->open_time)->format('H:i') }} &dash; {{ \Carbon\Carbon::parse($attraction->businessHours[$i]->close_time)->format('H:i') }} <br/>
                                                @else
                                                    Closed
                                                @endif
                                            </td>
                                        </tr>
                                    @endfor
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="row buttons-row">
                        <div class="col-lg-3 col-6">
                            <a class="btn btn-primary" href="{{ route('admin.attractions.edit', $attraction->id) }}" role="button">Edit</a>
                        </div>

                        <div class="col-lg-3 col-6">
                            <form method="POST" action="{{ route('admin.attractions.destroy', $attraction->id) }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-secondary">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
