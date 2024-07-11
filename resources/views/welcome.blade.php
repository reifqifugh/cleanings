<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleaning Service - Welcome</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
      <!-- Favicon -->
      <link rel="icon" href="{{ asset('Cleaner.png') }}" type="image/png">
      <link rel="shortcut icon" href="{{ asset('Cleaner.png') }}" type="image/png">
    <style>
        body {
            background-color: #1a237e; 
            color: #ffffff; 
            font-family: Arial, sans-serif;
        }
        .container {
            padding-top: 100px;
            text-align: center;
        }
        .jumbotron {
            background-color: #283593; 
            padding: 2rem;
            border-radius: 15px;
        }
        h1, h3 {
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            line-height: 1.6;
        }
        .btn-primary {
            background-color: #ff5722; 
            border-color: #ff5722;
            padding: 10px 30px;
            font-size: 18px;
            margin-top: 20px;
        }
        .btn-primary:hover {
            background-color: #e64a19; 
            border-color: #e64a19;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/home') }}" class="nav-link">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-light">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="btn btn-warning ml-3">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="jumbotron">
            <h1>Selamat Datang Di Cleanings!</h1>
            <p>Mitra terpercaya Anda untuk layanan pembersihan yang cepat dan efisien.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Get Started</a>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3>Mengapa Memilih Kami?</h3>
                <p>Kami menawarkan pemesanan online yang nyaman, petugas kebersihan profesional, dan harga yang kompetitif. Baik itu rumah atau kantor Anda, kami menjamin kebersihan dan kepuasan.</p>
            </div>
        </div>
    </div>
</body>
</html>
