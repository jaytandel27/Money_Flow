<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Money Flow</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            @import url('https://fonts.bunny.net/css?family=instrument-sans:400,500,600');

            :root {
                --text-color: #1b1b18;
                --bg-color: #FDFDFC;
                --primary: #3B82F6;
                --border: rgba(25, 20, 0, 0.15);
                --hover-border: rgba(25, 21, 1, 0.29);
            }

            @media (prefers-color-scheme: dark) {
                :root {
                    --text-color: #EDEDEC;
                    --bg-color: #0a0a0a;
                    --border: #3E3E3A;
                    --hover-border: #62605b;
                }
            }

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                background-color: var(--bg-color);
                color: var(--text-color);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                padding: 2rem;
                text-align: center;
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            h1 {
                font-size: 2.5rem;
                font-weight: 600;
                margin-bottom: 1rem;
            }

            p {
                font-size: 1.125rem;
                color: #666;
                margin-bottom: 2rem;
                max-width: 500px;
            }

            .auth-buttons {
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .btn {
                padding: 0.75rem 1.75rem;
                border-radius: 8px;
                font-size: 0.95rem;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.25s ease;
                cursor: pointer;
            }

            .btn-login {
                background-color: transparent;
                color: var(--text-color);
                border: 1px solid var(--border);
            }

            .btn-login:hover {
                border-color: var(--border);
                background-color: rgba(0, 0, 0, 0.03);
            }

            .btn-register {
                border: 1px solid var(--border);
                color: var(--text-color);
                background-color: transparent;
            }

            .btn-register:hover {
                border-color: var(--hover-border);
                background-color: rgba(0, 0, 0, 0.03);
            }
        </style>
    @endif
</head>
<body>
    <main>
        <h1>Welcome to Money Flow</h1>
        <p>Track your expenses easily and stay financially organized with our simple and intuitive platform.</p>

        @if (Route::has('login'))
            <div class="auth-buttons">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-register">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-login">Log in</a>
                    <a href="{{ route('auth.custom') }}" class="btn btn-register">Register</a>

                @endauth
            </div>
        @endif
    </main>
</body>
</html>
