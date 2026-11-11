<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: #fff;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 10px;
            outline: none;
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 5px rgba(79, 70, 229, 0.3);
        }

        .remember {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            gap: 8px;
            color: #555;
            font-size: 14px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #4f46e5;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #4338ca;
        }

        .footer-text {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
            color: #666;
        }

        .footer-text a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: bold;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .alert {
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Login</h2>

    @if(session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Enter your email"
                required
            >
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                required
            >
            @error('password')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="remember">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn-login">Login</button>
    </form>

    <div class="footer-text">
        Don't have an account? <a href="#">Register</a>
    </div>
</div>
</body>
</html>
