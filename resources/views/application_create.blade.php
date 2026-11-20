<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корочки.есть — Создание заявки</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-header">
            <h1>Корочки.есть</h1>
        </div>

        <div class="form-container">
            <h2>Создание заявки</h2>

            <form action="{{ Route('application.store') }}" method="POST">
                @csrf

                <input type="hidden" name="course_name" value="{{ $course_name }}">
                <p class="room-name">{{ $course_name ?? 'Курс не выбран' }}</p>

                <label for="date">Дата начала обучения</label>
                <input type="date" name="date" id="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}">
                @error('date')
                <div class="error-message">{{ $message }}</div>
                @enderror

                <label for="payment">Способ оплаты</label>
                <select name="payment" id="payment">
                    <option value="">Выберите способ оплаты</option>
                    <option value="cash" {{ old('payment') == 'cash' ? 'selected' : '' }}>Наличными</option>
                    <option value="phone" {{ old('payment') == 'phone' ? 'selected' : '' }}>Перевод по номеру телефона</option>
                </select>
                @error('payment')
                <div class="error-message">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn-primary">Отправить</button>
            </form>

            <p class="link"><a href="{{ Route('dashboard') }}">На главную</a></p>
        </div>
    </div>
</body>
</html>
