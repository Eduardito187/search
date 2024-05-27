@extends('frontend.account.components.body-login')

@section('title', 'reset password')

@section('content')
    <div class="container">
        <div class="reset-password-form">
            <div class="form-header">
                <h1>Reset Password</h1>
            </div>
            <form id="reset-password-form" action="/send-reset-link" method="POST">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <button type="submit">Send Reset Link</button>
            </form>
        </div>
    </div>
@endsection