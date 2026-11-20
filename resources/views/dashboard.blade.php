<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корочки.есть</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-left">
            <h1 class="logo">Корочки.есть</h1>
            <span class="subtitle">Портал дополнительного профессионального образования</span>
        </div>
        <div class="header-right">
            @auth
            <span class="user-name">{{ Auth::user()->FIO }}</span>
            <form action="{{ Route('logout') }}" method="POST" class="form-inline">
                @csrf
                <button type="submit" class="btn-logout">Выйти</button>
            </form>
            @else
            <a href="{{ Route('login') }}" class="btn-login">Войти</a>
            <a href="{{ Route('register') }}" class="btn-register">Регистрация</a>
            @endauth
        </div>
    </header>

    <main class="container">
        <!-- Slider -->
        <div class="slider-container">
            <div class="slider-wrapper">
                <div class="slider-track">
                    <div class="slider-slide">
                        <img src="{{ asset('storage/slider/slide1.svg') }}" alt="Слайд 1">
                        <div class="slide-content" style="display:none; width:100%; height:100%;">
                            <h2>Получите новую профессию</h2>
                            <p>Программы дополнительного профессионального образования</p>
                        </div>
                    </div>
                    <div class="slider-slide">
                        <img src="{{ asset('storage/slider/slide2.svg') }}" alt="Слайд 2">
                        <div class="slide-content" style="display:none; width:100%; height:100%;">
                            <h2>Квалифицированные преподаватели</h2>
                            <p>Обучение от практикующих специалистов</p>
                        </div>
                    </div>
                    <div class="slider-slide">
                        <img src="{{ asset('storage/slider/slide3.svg') }}" alt="Слайд 3">
                        <div class="slide-content" style="display:none; width:100%; height:100%;">
                            <h2>Удобный формат обучения</h2>
                            <p>Выберите удобное время начала курса</p>
                        </div>
                    </div>
                    <div class="slider-slide">
                        <img src="{{ asset('storage/slider/slide4.svg') }}" alt="Слайд 4">
                        <div class="slide-content" style="display:none; width:100%; height:100%;">
                            <h2>Диплом государственного образца</h2>
                            <p>После завершения обучения</p>
                        </div>
                    </div>
                </div>
                <button class="slider-btn prev" onclick="changeSlide(-1)">&#10094;</button>
                <button class="slider-btn next" onclick="changeSlide(1)">&#10095;</button>
                <div class="slider-dots">
                    <span class="dot active" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                    <span class="dot" onclick="currentSlide(4)"></span>
                </div>
            </div>
        </div>

        <div class="welcome">
            @auth
            <h2>Добро пожаловать, {{ Auth::user()->FIO }}!</h2>
            <p>Добро пожаловать в портал «Корочки.есть» — ваш путь к новым знаниям!</p>

            @if (Auth::user()->role !== 'admin')
            <div class="action-buttons">
                <a href="{{ Route('application.my') }}" class="btn-action">Мои заявки</a>
            </div>
            @endif

            @if (Auth::user()->role == 'admin')
            <div class="action-buttons">
                <a href="{{ Route('course.create') }}" class="btn-action">Создать курс</a>
                <a href="{{ Route('application.admin') }}" class="btn-action">Панель администратора</a>
            </div>
            @endif
            @endauth
        </div>

        <div class="courses">
            <h3>Доступные курсы</h3>
            @foreach ($courses as $course)
            <div class="course-card">
                <div class="course-info">
                    <h4>{{ $course->name }}</h4>
                    <p>{{ Str::limit($course->description, 100) }}</p>
                    @if (Auth::check() && Auth::user()->role == 'admin')
                    <a href="{{ Route('course.edit', $course->id) }}" class="btn-edit">Редактировать</a>
                    @endif
                </div>
                @auth
                @if (Auth::user()->role == 'admin')
                <form action="{{ Route('course.delete', $course) }}" method="POST" class="form-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Удалить</button>
                </form>
                @else
                <a href="{{ Route('application.create', $course->id) }}" class="btn-action">Записаться</a>
                @endif
                @endauth
            </div>
            @endforeach
        </div>
    </main>

    <script>
        let slideIndex = 0;
        let slideInterval;
        const track = document.querySelector('.slider-track');
        const dots = document.querySelectorAll('.dot');
        const totalSlides = 4;

        function showSlide(n) {
            if (n >= totalSlides) slideIndex = 0;
            if (n < 0) slideIndex = totalSlides - 1;
            track.style.transform = 'translateX(-' + (slideIndex * 100) + '%)';
            dots.forEach(d => d.classList.remove('active'));
            dots[slideIndex].classList.add('active');
        }

        function changeSlide(n) {
            showSlide(slideIndex += n);
            resetInterval();
        }

        function currentSlide(n) {
            showSlide(n - 1);
            resetInterval();
        }

        function startInterval() {
            slideInterval = setInterval(() => {
                showSlide(slideIndex + 1);
            }, 3000);
        }

        function resetInterval() {
            clearInterval(slideInterval);
            startInterval();
        }

        startInterval();
    </script>
</body>
</html>
