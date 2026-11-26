
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page login-page">

    <h1>Login to Your Account</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="auth-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Login Form -->
    <form class="auth-card" action="{{ route('login') }}" method="POST">

        @csrf

        <div>
            <label>Email:</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
            >
        </div>

        <br>

        <div>
            <label>Password:</label>
            <input
                type="password"
                name="password"
            >
        </div>

        <br>

        <button type="submit">Login</button>

    </form>

    <p>
        Don't have an account?
        <a href="{{ route('register') }}">Register</a>
    </p>

</body>
</html>
