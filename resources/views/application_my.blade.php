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
            <span class="subtitle">Портал дополнительного профессионального образования</span>
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
                <p><strong>Оплата:</strong> {{ $application->payment === 'cash' ? 'Наличными' : 'Перевод по номеру телефона' }}</p>
                <p><strong>Статус:</strong>
                    @if ($application->status == 'new')
                    <span class="status-badge status-new">Новая</span>
                    @elseif ($application->status == 'studying')
                    <span class="status-badge status-studying">Идет обучение</span>
                    @elseif ($application->status == 'completed')
                    <span class="status-badge status-completed">Обучение завершено</span>
                    @endif
                </p>
            </div>

            @if ($application->status == 'completed' && !$application->comment)
            <form action="{{ Route('application.review', $application) }}" method="POST" class="review-form">
                @csrf
                <textarea name="comment" placeholder="Оставьте отзыв о качестве образовательных услуг..." rows="3"></textarea>
                <button type="submit" class="btn-submit">Отправить отзыв</button>
            </form>
            @endif

            @if ($application->comment)
            <div class="review">
                <strong>Ваш отзыв:</strong>
                <p>{{ $application->comment }}</p>
            </div>
            @endif
        </div>
        @empty
        <div class="empty-state">
            <p>У вас пока нет заявок. <a href="{{ Route('application.create') }}">Подать заявку</a></p>
        </div>
        @endforelse

        <p class="link"><a href="{{ Route('dashboard') }}">На главную</a></p>
    </main>
</body>
</html>
