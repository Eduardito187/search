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
            margin-left: auto;
            margin-right: auto;
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
            gap: 20px;
        }
        nav a {
            color: #333;
            text-decoration: none;
            font-size: 1em;
            padding: 10px 20px;
            color: #6e8efb;
            font-weight: 600;
            text-decoration: unset !important;
        }
        nav a:hover,
        nav a:active,
        nav a:visited {
            background-color: #6e8efb;
            color: #fff;
            border-radius: 20px;
        }
        .hero {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            transition: top 0.3s ease;
            padding: 100px 20px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .hero-content {
            max-width: 600px;
            text-align: left;
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
        .container-main {
            width: 100%;
            margin-top: 50px;
        }
        .container-mk {
            max-width: 1200px;
            padding: 20px;
            margin-left: auto;
            margin-right: auto;
        }
        .container-mk .title {
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
        .container-mk .subtitle {
            font-size: 1.2em;
            margin-bottom: 30px;
            color: #777777;
            text-align: center;
        }
        .container-mk .stats {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .container-mk .stats .row-stats {
            display: flex;
            gap: 10px;
        }
        .container-mk .stats .row-stats .stat {
            width: 33.3333%;
            height: 150px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5em;
            border-radius: 5px;
        }
        .container-mk .stat-value {
            font-size: 2em;
            font-weight: bold;
            color: #4A90E2;
        }
        .container-mk .stat-description {
            font-size: 1em;
            color: #777777;
        }
        .container-mk .contact-button {
            margin-top: 30px;
            padding: 15px 30px;
            font-size: 1em;
            color: #ffffff;
            background-color: #4A90E2;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .container-merchand {
            max-width: 1200px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            box-sizing: border-box;
            margin-left: auto;
            margin-right: auto;
        }
        .container-merchand .text-content {
            max-width: 50%;
        }
        .container-merchand .title {
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .container-merchand .description {
            font-size: 1em;
            color: #777777;
            margin-bottom: 30px;
        }
        .container-merchand .button {
            padding: 15px 30px;
            font-size: 1em;
            color: #ffffff;
            background-color: #4A90E2;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .container-merchand .image-content {
            max-width: 50%;
        }
        .container-merchand .image-content img {
            max-width: 100%;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container-header">
            <div class="logo">
                <img src="{{ asset('img/logo-small.png') }}" alt="Avatar">
            </div>
            <nav class="nav">
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
    <main class="container-main">
        <div class="container-mk">
            <div class="title">Scaling ahead of your needs</div>
            <div class="subtitle">Customers depend on Eduard Search to handle more queries than any other hosted search engine.</div>
            <div class="stats">
                <div class="row-stats">
                    <div class="stat">
                        <div class="stat-value">1.7+ trillion</div>
                        <div class="stat-description">searches every year</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">99.999%</div>
                        <div class="stat-description">uptime SLA available</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">17,000+</div>
                        <div class="stat-description">customers across 150+ countries</div>
                    </div>
                </div>
                <div class="row-stats">
                    <div class="stat">
                        <div class="stat-value">30+ billion</div>
                        <div class="stat-description">records indexed</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">100%</div>
                        <div class="stat-description">compliant & secure with SAML, SOC3, ISO27001, HIPAA, C5, MACH Alliance</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">382%</div>
                        <div class="stat-description">ROI according to Forrester Research</div>
                    </div>
                </div>
            </div>
            <a href="#" class="contact-button">Contact sales</a>
        </div>
    </main>
    <main class="container-main">
        <div class="container-merchand">
            <div class="text-content">
                <div class="title">Make merchandising effortless</div>
                <div class="description">
                    Combine the art of merchandising with the science of algorithms. Design online journeys that start with audience understanding - and end with better business outcomes.
                </div>
                <a href="#" class="button">Discover the Merchandising Studio</a>
            </div>
            <div class="image-content">
                <img src="image.png" alt="Merchandising Studio">
            </div>
        </div>
    </main>
</body>
</html>