<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Kite</title>
</head>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center text-center min-vw-100 min-vh-100">
        <h1 class="m-5">Welcome to Stock-Neetwork</h1>
        @if($error)
            {{ $error }}
            <br>
            <a href="{{ route('home') }}" class="btn btn-danger btn-2x">Return to Login</a>
        @else
            <a href="https://kite.zerodha.com/connect/login?v=3&api_key={{ $api_key }}" class="btn btn-danger btn-2x">Login with zerodha</a>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>