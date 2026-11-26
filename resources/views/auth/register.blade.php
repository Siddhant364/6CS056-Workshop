<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page register-page">

    <h1>Create an Account</h1>

    @if ($errors->any())
        <div class="auth-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="auth-card" action="{{ route('register') }}" method="POST">

        @csrf

        <div>
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>

        <br>

        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <br>

        <div>
            <label>Password:</label>
            <input type="password" name="password">
        </div>

        <br>

        <div>
            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation">
        </div>

        <br>

        <button type="submit">Register</button>

    </form>

    <p>
        Already have an account?
        <a href="{{ route('login') }}">Login</a>
    </p>

</body>
</html>
