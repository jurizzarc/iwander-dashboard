@extends('layouts.app')

@section('content')
@include ('inc.sidebar')

<div class="container">
    <div class="row">

        <div class="col-12 col-lg-6 offset-lg-4 col-md-9 offset-md-3">
            <div class="row">

                <div class="col-lg-12" style="margin-top: 50px;">
                    @include('inc.flash-messages')
                </div>

                <div class="col-12 item-title">
                    <h4>{{ $city->name }}</h4>
                </div>

                <div class="col-12 item-image">
                    <img src="{{ asset('../images/'.$city->image) }}">
                </div>

                <div class="col-12 item-info">
                    <div class="row">

                        <div class="col-lg-6 col-sm-12 info-col">
                            <h6 class="column-name">District</h6>
                            <p class="column-data">{{ $city->districts->name }}</p>
                        </div>

                        <div class="col-lg-6 col-sm-12 info-col">
                            <h6 class="column-name">Country</h6>
                            <p class="column-data">{{ $city->districts->country->name }}</p>
                        </div>

                        <div class="col-12 info-col">
                            <h6 class="column-name">Description</h6>
                            <p class="column-data">{{ $city->description }}</p>
                        </div>

                    </div>

                    <div class="row buttons-row">
                        <div class="col-lg-3 col-6">
                            <a class="btn btn-primary" href="{{ route('admin.cities.edit', $city->id) }}" role="button">Edit</a>
                        </div>

                        <div class="col-lg-3 col-6">
                            <form method="POST" action="{{ route('admin.cities.destroy', $city->id) }}">
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
