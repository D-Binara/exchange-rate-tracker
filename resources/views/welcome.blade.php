<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Exchange Rate Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="welcome-container">
    <div class="overlay"></div>
    <div class="content text-center">
        <h1 class="display-2 fw-bold">Exchange Rate Tracker</h1>
        <p class="lead">Track real-time exchange rates with precision and clarity.</p>
        <a href="{{ route('exchange') }}" class="btn btn-lg btn-custom mt-3">Get Started</a>
    </div>
</div>

</body>
</html>
