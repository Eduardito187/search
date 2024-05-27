@extends('frontend.account.components.body-login')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="login-form">
            <div class="avatar">
                <img src="avatar.png" alt="Avatar">
            </div>
            <h2>WELCOME</h2>
            <form action="login.php" method="post" id="loginForm">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit">LOGIN</button>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </form>
        </div>
    </div>
@endsection
