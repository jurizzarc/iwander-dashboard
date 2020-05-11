@extends('layouts.app')

@section('content')
@include('inc.sidebar')

<div class="container">
    <div class="row">

        <div class="col-12 col-lg-8 offset-lg-3">

            <div class="row top-row">
                <div class="col-12">
                    <h2>{{ Auth::user()->name }}</h2>
                    <p>{{ Auth::user()->email }}</p>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
