@extends('frontend.account.components.body-login')

@section('title', 'Reset Password|EduardSearch')

@section('custom-header')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div id="container-reset" class="container">
        <div class="login-form">
            <div class="avatar">
                <img src="{{ asset('img/picture-logo.png') }}" alt="Avatar">
            </div>
            <h2 v-html="appName"></h2>
            <div id="loginForm">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                        <div class="input-group">
                            <i class="fa fa-user"></i>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        <div class="input-group">
                            <i class="fa fa-secret"></i>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <div class="input-group">
                            <i class="fa fa-secret"></i>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <small><strong v-html="versionApp"></strong></small>
            </div>
        </div>
    </div>
@endsection

@section('custom-footer')
    <script src="{{ asset('js/login/form-restore.js') }}"></script>
@endsection