<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Конференции.РФ — Создание зала</title>
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<div class="form-container">
<h2>Создание зала</h2>

<form action="{{ Route('room.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<label for="name">Название зала</label>
<input type="text" name="name" id="name" placeholder="Введите название зала" value="{{ old('name') }}">
@error('name')
<div class="error-message">{{ $message }}</div>
@enderror

<label for="description">Описание</label>
<textarea name="description" id="description" rows="4" placeholder="Введите описание зала">{{ old('description') }}</textarea>
@error('description')
<div class="error-message">{{ $message }}</div>
@enderror

<label for="image">Картинка</label>
<input type="file" name="image" id="image">
@error('image')
<div class="error-message">{{ $message }}</div>
@enderror

<button type="submit">Создать зал</button>
</form>

<p class="link"><a href="{{ Route('dashboard') }}">На главную</a></p>
</div>
</body>
</html>
