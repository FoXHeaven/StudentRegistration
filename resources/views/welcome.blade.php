<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration System</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-5 text-center" style="max-width: 400px;">
        <h1 class="mb-4">Student Registration</h1>
        <p class="mb-4">Welcome! Please login or register to continue.</p>

        <div class="d-grid gap-3">
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="btn btn-dark btn-lg">Login</a>
            @endif
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg">Register</a>
            @endif
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
