<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/img/monlogo.png" type="image/x-icon" sizes="84x84">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="/assets/css/swiper-bundle.min.css">
    <title> | Monjiro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-guest.navbar />

    <main class="container max-w-full">
        @yield('content')
    </main>

    <x-guest.footer />
    @stack('scripts')
</body>

</html>
