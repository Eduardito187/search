<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UI/UX Design Landing Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .container-header {
            width: 100%;
            display: contents;
        }
        header {
            background: white;
            padding: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        header .logo {
            font-size: 1.5em;
            color: #333;
            font-weight: bold;
            padding-left: 20px;
        }
        header .nav {
            padding-right: 20px;
        }
        header .logo img {
            width: 100px;
            border-radius: 10px;
        }
        nav {
            display: flex;
            gap: 30px;
        }
        nav a {
            color: #333;
            text-decoration: none;
            font-size: 1em;
        }
        .hero {
            background: #e7f3ff;
            padding: 100px 20px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .hero-content {
            max-width: 600px;
        }
        .hero h1 {
            font-size: 3em;
            color: #333;
            margin: 0 0 20px;
        }
        .hero p {
            font-size: 1.2em;
            color: #555;
            margin: 0 0 30px;
        }
        .hero .cta {
            background: #ff5e6c;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2em;
        }
        .illustration {
            max-width: 600px;
            margin-left: 50px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container-header">
            <div class="logo">
                <img src="{{ asset('img/logo-small.png') }}" alt="Avatar">
            </div>
            <nav>
                <a href="#">Home</a>
                <a href="#">About</a>
                <a href="#">Services</a>
                <a href="#">Contact</a>
                <a href="#" class="cta">Sign Up</a>
            </nav>
        </div>
    </header>
    <div class="hero">
        <div class="container hero-content">
            <h1>UI/UX DESIGN</h1>
            <p>Landing Page</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a href="#" class="cta">REGISTER</a>
        </div>
        <img src="https://via.placeholder.com/600x400" alt="Illustration" class="illustration">
    </div>
</body>
</html>