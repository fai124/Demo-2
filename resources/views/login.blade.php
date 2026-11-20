<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корочки.есть — Авторизация</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-header">
            <h1>Корочки.есть</h1>
            <p>Портал дополнительного профессионального образования</p>
        </div>

        <div class="form-container">
            <h2>Авторизация</h2>

            <form action="{{ Route('login') }}" method="POST">
                @csrf

                <label for="login">Логин</label>
                <input type="text" name="login" id="login" placeholder="Введите логин" value="{{ old('login') }}" autocomplete="username">
                @error('login')
                <div class="error-message">{{ $message }}</div>
                @enderror

                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" placeholder="Введите пароль" autocomplete="current-password">
                @error('password')
                <div class="error-message">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn-primary">Войти</button>
            </form>

            <p class="link">Ещё не зарегистрированы? <a href="{{ Route('register') }}">Регистрация</a></p>
        </div>
    </div>
</body>
</html>
