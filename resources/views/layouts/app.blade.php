<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-red-800 text-white min-h-screen p-4">
            @include('layouts.sidebar')
        </aside>
        
        <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-100">
            @yield('content')
        </main>
    </div>

    <!-- Allow additional scripts from child views -->
    @yield('scripts')

</body>
</html>
