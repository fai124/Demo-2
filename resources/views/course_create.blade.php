<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корочки.есть — Создание курса</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-header">
            <h1>Корочки.есть</h1>
        </div>

        <div class="form-container">
            <h2>Создание курса</h2>

            <form action="{{ Route('course_store') }}" method="POST">
                @csrf

                <label for="name">Название курса</label>
                <input type="text" name="name" id="name" placeholder="Введите название курса" value="{{ old('name') }}">
                @error('name')
                <div class="error-message">{{ $message }}</div>
                @enderror

                <label for="description">Описание</label>
                <textarea name="description" id="description" rows="4" placeholder="Введите описание курса">{{ old('description') }}</textarea>
                @error('description')
                <div class="error-message">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn-primary">Создать курс</button>
            </form>

            <p class="link"><a href="{{ Route('dashboard') }}">На главную</a></p>
        </div>
    </div>
</body>
</html>
