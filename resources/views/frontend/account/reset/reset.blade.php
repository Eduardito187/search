@extends('frontend.account.components.body-login')

@section('title', 'reset password')

@section('custom-header')
    <link rel="stylesheet" href="{{ asset('css/reset-password.css') }}">
@endsection

@section('content')
    <div id="container-reset" class="container">
        <div class="reset-password-form">
            <div class="avatar">
                <img src="{{ asset('img/picture-logo.png') }}" alt="Avatar">
            </div>
            <div class="form-header">
                <h1>Reset Password</h1>
            </div>
            <div id="reset-password-form">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" v-model="mail" required>
                </div>
                <button type="button" :disabled="mail.length == 0 ? true : false" @click="validateData">Send Reset Link</button>
            </div>
        </div>
    </div>
@endsection

@section('custom-footer')
    <script src="{{ asset('js/login/form-restore.js') }}"></script>
@endsection