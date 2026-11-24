<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корочки.есть — Мои заявки</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-left">
            <h1 class="logo">Корочки.есть</h1>
        </div>
        <div class="header-right">
            <span class="user-name">{{ Auth::user()->FIO }}</span>
            <form action="{{ Route('logout') }}" method="POST" class="form-inline">
                @csrf
                <button type="submit" class="btn-logout">Выйти</button>
            </form>
        </div>
    </header>

    <main class="container">
        <div class="page-title">
            <h2>Мои заявки</h2>
        </div>

        @forelse ($applications as $application)
        <div class="application-card">
            <div class="application-info">
                <h4>{{ $application->course_name }}</h4>
                <p><strong>Дата начала:</strong> {{ $application->date->format('d.m.Y') }}</p>
                <p><strong>Оплата:</strong> {{ $application->payment }}</p>
                <p><strong>Статус:</strong> {{ $application->status }}</p>
            </div>

            @if ($application->status == 'completed' && !$application->comment)
            <form action="{{ Route('application_review', $application) }}" method="POST">
                @csrf
                <textarea name="comment" rows="2" placeholder="Отзыв..."></textarea>
                <button type="submit" class="btn-submit">Отправить</button>
            </form>
            @endif

            @if ($application->comment)
            <div class="review">
                <strong>Ваш отзыв:</strong>
                <p>{{ $application->comment }}</p>
            </div>
            @endif
        </div>
        <p class="link"><a href="{{ Route('dashboard') }}">На главную</a></p>
    </main>
</body>
</html>
