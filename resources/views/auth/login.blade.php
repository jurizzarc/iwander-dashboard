@extends('layouts.app')

@section('content')
<div class="vertical-center">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-4 offset-lg-4 col-sm-12">
                <div class="auth-form-heading">
                    <img src="{{ asset('/images/iwander-logo-lg.png') }}" alt="iWander Logo" />
                    <p>Sign in to the dashboard</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="email">E-mail Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" />

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <p class="error-msg">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password" />

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <p class="error-msg">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>

                        <div class="form-button col-12">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
