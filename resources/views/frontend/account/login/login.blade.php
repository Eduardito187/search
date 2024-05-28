@extends('frontend.account.components.body-login')

@section('title', 'Login')

@section('content')
    <div id="container-login" class="container">
        <div class="login-form">
            <div class="avatar">
                <img src="{{ asset('img/picture-logo.png') }}" alt="Avatar">
            </div>
            <h2>EduardSearch</h2>
            <div id="loginForm">
                <div class="input-group">
                    <i class="fa fa-user"></i>
                    <input type="email" name="username" v-model="mail" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" v-model="password" placeholder="Password" required>
                </div>
                <button type="button" :disabled="mail.length == 0 && password.length == 0">LOGIN</button>
                <a href="/restore-password" class="forgot-password">Forgot Password?</a>
            </div>
        </div>
    </div>
@endsection

@section('custom-footer')
    <script src="{{ asset('js/login/form-login.js') }}"></script>
@endsection