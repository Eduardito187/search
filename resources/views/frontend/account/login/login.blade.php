@extends('frontend.account.components.body-login')

@section('title', 'Login')

@section('custom-header')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div id="container-login" class="container">
        <div class="login-form">
            <div class="avatar">
                <img src="{{ asset('img/picture-logo.png') }}" alt="Avatar">
            </div>
            <h2 v-html="appName"></h2>
            <div id="loginForm">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div v-if="messageInfo.length > 0" :class="'alert '+classMessageInfo" role="alert" v-html="messageInfo"></div>
                <div class="input-group">
                    <i class="fa fa-user"></i>
                    <input type="email" name="mail" v-model="mail" placeholder="Mail" required>
                </div>
                <div class="input-group">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" v-model="password" placeholder="Password" required>
                </div>
                <div class="row">
                    <button type="button" class="btn-eduard-search" :disabled="mail.length == 0 || password.length == 0 ? true : false" @click="validateData">
                        <small>Inicio de sesión</small>
                    </button>
                </div>
                <div class="row">
                    <small class="other-login">O Inicia sesión con:</small>
                </div>
                <div class="row">
                    <button type="button" class="btn-github" @click="redirectGitHub">
                        <small>GitHub</small>
                        <i class="fa fa-github"></i>
                    </button>
                </div>
                <a href="/restore-password" class="forgot-password">Forgot Password?</a>
            </div>
            <div>
                <small><strong v-html="versionApp"></strong></small>
            </div>
        </div>
    </div>
@endsection

@section('custom-footer')
    <script src="{{ asset('js/login/form-login.js') }}"></script>
@endsection