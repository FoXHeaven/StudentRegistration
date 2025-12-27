<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <!-- TailwindCSS + Bootstrap for grid -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">

    <header class="bg-white shadow p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="text-xl font-bold">{{ config('app.name') }}</h1>
            <nav class="d-flex align-items-center gap-3">
                @auth
                    <span>{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark btn-sm">Logout</button>
                    </form>
                @endauth
            </nav>
        </div>
    </header>

    <main class="container my-5">
        {{ $slot }}
    </main>

</body>
</html>
