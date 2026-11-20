<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корочки.есть — Панель администратора</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-left">
            <h1 class="logo">Корочки.есть</h1>
            <span class="subtitle">Панель администратора</span>
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
            <h2>Управление заявками</h2>
        </div>

        <!-- Filter -->
        <div class="admin-filters">
            <select id="filterStatus" onchange="filterApplications()">
                <option value="all">Все статусы</option>
                <option value="new">Новые</option>
                <option value="studying">Идет обучение</option>
                <option value="completed">Обучение завершено</option>
            </select>
        </div>

        @forelse ($applications as $application)
        <div class="application-card admin-card" data-status="{{ $application->status }}">
            <div class="application-info">
                <p><strong>Пользователь:</strong> {{ $application->user->FIO }}</p>
                <p><strong>Логин:</strong> {{ $application->user->login }}</p>
                <p><strong>Курс:</strong> {{ $application->course_name }}</p>
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

            <form action="{{ Route('application.update_status', $application) }}" method="POST" class="form-inline">
                @csrf
                <select name="status" class="status-select">
                    <option value="new" @if ($application->status == 'new') selected @endif>Новая</option>
                    <option value="studying" @if ($application->status == 'studying') selected @endif>Идет обучение</option>
                    <option value="completed" @if ($application->status == 'completed') selected @endif>Обучение завершено</option>
                </select>
                <button type="submit" class="btn-submit">Изменить статус</button>
            </form>
        </div>
        @empty
        <div class="empty-state">
            <p>Заявок пока нет.</p>
        </div>
        @endforelse

        <!-- Pagination -->
        @if ($applications->hasPages())
        <div class="pagination">
            {{ $applications->links() }}
        </div>
        @endif

        <p class="link"><a href="{{ Route('dashboard') }}">На главную</a></p>
    </main>

    <script>
        function filterApplications() {
            const filter = document.getElementById('filterStatus').value;
            const cards = document.querySelectorAll('.admin-card');
            cards.forEach(card => {
                if (filter === 'all' || card.dataset.status === filter) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Show notification on status change
        @if (session('status_changed'))
        alert('Статус заявки успешно изменен!');
        @endif
    </script>
</body>
</html>
