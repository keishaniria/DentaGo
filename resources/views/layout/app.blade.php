<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    {{-- Vite untuk memuat CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <main class="content">
        @yield('content')
    </main>
</body>
</html>
