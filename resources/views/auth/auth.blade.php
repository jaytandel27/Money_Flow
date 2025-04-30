<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign In / Sign Up</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #f6f5f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
                  0 10px 10px rgba(0,0,0,0.22);
      position: relative;
      overflow: hidden;
      width: 768px;
      max-width: 100%;
      min-height: 480px;
      display: flex;
    }

    .form-container {
      position: absolute;
      top: 0;
      height: 100%;
      transition: all 0.6s ease-in-out;
    }

    .sign-in-container {
      left: 0;
      width: 50%;
      z-index: 2;
    }

    .container.right-panel-active .sign-in-container {
      transform: translateX(100%);
    }

    .sign-up-container {
      left: 0;
      width: 50%;
      opacity: 0;
      z-index: 1;
    }

    .container.right-panel-active .sign-up-container {
      transform: translateX(100%);
      opacity: 1;
      z-index: 5;
      animation: show 0.6s;
    }

    @keyframes show {
      0% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }

    form {
      background: #ffffff;
      display: flex;
      flex-direction: column;
      padding: 0 50px;
      height: 100%;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    input {
      background: #eee;
      border: none;
      padding: 12px 15px;
      margin: 8px 0;
      width: 100%;
      border-radius: 5px;
    }

    button {
      border-radius: 20px;
      background-color: rgb(196, 129, 30);
border: 1px solid rgb(196, 129, 30);

      color: #fff;
      font-size: 14px;
      font-weight: bold;
      padding: 12px 45px;
      letter-spacing: 1px;
      transition: transform 80ms ease-in;
      cursor: pointer;
    }

    button:active {
      transform: scale(0.95);
    }

    .overlay-container {
      position: absolute;
      top: 0;
      left: 50%;
      width: 50%;
      height: 100%;
      overflow: hidden;
      transition: transform 0.6s ease-in-out;
      z-index: 100;
    }

    .container.right-panel-active .overlay-container {
      transform: translateX(-100%);
    }

    .overlay {
      background: linear-gradient(to right,rgb(150, 99, 4),rgb(167, 102, 5));
      color: #ffffff;
      position: relative;
      left: -100%;
      height: 100%;
      width: 200%;
      transform: translateX(0);
      transition: transform 0.6s ease-in-out;
    }

    .container.right-panel-active .overlay {
      transform: translateX(50%);
    }

    .overlay-panel {
      position: absolute;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 0 40px;
      text-align: center;
      top: 0;
      height: 100%;
      width: 50%;
      transform: translateX(0);
      transition: transform 0.6s ease-in-out;
    }

    .overlay-left {
      transform: translateX(-20%);
    }

    .container.right-panel-active .overlay-left {
      transform: translateX(0);
    }

    .overlay-right {
      right: 0;
      transform: translateX(0);
    }

    .container.right-panel-active .overlay-right {
      transform: translateX(20%);
    }
  </style>
</head>
<body>
  <div class="container" id="container">
    <!-- Sign Up Form -->
    <div class="form-container sign-up-container">
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <h2>Create Account</h2>
        <input type="text" name="name" placeholder="Name" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
        <button type="submit">Sign Up</button>
      </form>
    </div>

    <!-- Sign In Form -->
    <div class="form-container sign-in-container">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2>Sign In</h2>
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Sign In</button>
      </form>
    </div>

    <!-- Overlay Panels -->
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h2>Welcome Back!</h2>
          <p>To keep connected with us, please login with your personal info</p>
          <button class="ghost" id="signIn">Sign In</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h2>Hello, Friend!</h2>
          <p>Enter your personal details and start your journey with us</p>
          <button class="ghost" id="signUp">Sign Up</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    const container = document.getElementById('container');
    document.getElementById('signUp').addEventListener('click', () => {
      container.classList.add("right-panel-active");
    });

    document.getElementById('signIn').addEventListener('click', () => {
      container.classList.remove("right-panel-active");
    });
  </script>
</body>
</html>
