<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #000;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        /* Card */
        .card {
            background-color: #111;
            color: #fff;
            padding: 2rem 1.5rem;
            border-radius: 16px;
            width: 100%;
            max-width: 320px;
            box-shadow: 0 10px 25px rgba(255, 255, 255, 0.05);
            text-align: center;
        }

        .brand {
            font-size: 1.5rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 0.8rem;
        }

        h2 {
            font-size: 1.2rem;
            color: #f1f1f1;
            margin-bottom: 1.5rem;
        }

        input {
            width: 100%;
            padding: 10px 14px;
            margin-bottom: 1rem;
            border: 1px solid #333;
            border-radius: 30px;
            font-size: 0.95rem;
            background-color: #1a1a1a;
            color: #fff;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #fff;
            outline: none;
        }

        input::placeholder {
            color: #aaa;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 30px;
            font-size: 0.95rem;
            font-weight: bold;
            background: #fff;
            color: #000;
            cursor: pointer;
            margin-top: 0.8rem;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background: #ddd;
        }

        .error {
            color: #ff4d4d;
            font-size: 0.8rem;
            text-align: left;
            margin-top: -0.5rem;
            margin-bottom: 0.5rem;
        }

        .success {
            color: #4CAF50;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }

        @media (max-width: 400px) {
            .card {
                padding: 1.5rem;
            }

            .brand {
                font-size: 1.3rem;
            }

            h2 {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>

<div class="card">
    <!-- Brand Name -->
    <div class="brand">Money Flow</div>

    <h2>Login</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.perform') }}">
        @csrf

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">LOG IN</button>
    </form>
</div>

</body>
</html>
