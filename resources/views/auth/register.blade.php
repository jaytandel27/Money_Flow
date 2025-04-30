<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
/* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    background-color: #000;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Card Styling */
.card {
    background-color: #111;
    border-radius: 16px;
    padding: 2rem 2.5rem;
    box-shadow: 0 8px 25px rgba(255, 255, 255, 0.05);
    width: 100%;
    max-width: 400px;
    text-align: center;
    color: #fff;
}

/* Brand/Header */
.brand {
    font-size: 24px;
    font-weight: bold;
    background-color: #000;
    color: #fff;
    padding: 1rem;
    border-radius: 12px 12px 0 0;
    margin: -2rem -2.5rem 1.5rem -2.5rem;
}

/* Title */
h2 {
    color: #f1f1f1;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
}

/* Input Fields */
input {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 1rem;
    border-radius: 50px;
    border: 1px solid #444;
    font-size: 1rem;
    background-color: #1a1a1a;
    color: #fff;
    transition: 0.3s;
}

input:focus {
    border-color: #fff;
    outline: none;
}

/* Placeholder Styling */
input::placeholder {
    color: #999;
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    border: none;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: bold;
    background: #fff;
    color: #000;
    cursor: pointer;
    transition: 0.3s ease;
}

button:hover {
    background: #ddd;
    color: #000;
}

/* Error Message */
.error {
    color: #ff4d4d;
    font-size: 0.85rem;
    text-align: left;
    margin-top: -8px;
    margin-bottom: 8px;
}

/* Success Message */
.success {
    color: #4CAF50;
    font-size: 0.9rem;
    margin-bottom: 10px;
}

/* Responsive */
@media (max-width: 480px) {
    .card {
        padding: 1.5rem;
    }

    .brand {
        font-size: 1.25rem;
    }
}


    </style>
</head>
<body>
    <div class="card">
        <div class="brand">Money Flow</div>
        <h2>Register</h2>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('register.perform') }}">
            @csrf

            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <input type="password" name="password" placeholder="Password">
            @error('password') <div class="error">{{ $message }}</div> @enderror

            <input type="password" name="password_confirmation" placeholder="Confirm Password">

            <button type="submit">REGISTER</button>
        </form>
    </div>
</body>
</html>
