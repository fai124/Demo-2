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
<div style="display: flex; align-items: center; gap: 10px;">
    <input type="text" id="file-name" value="" readonly placeholder="Нет файла" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; flex: 1; color: #999;">
    <input type="file" name="image" id="image" onchange="document.getElementById('file-name').value = this.files.length ? this.files[0].name : ''; document.getElementById('file-name').style.color = this.files.length ? '#333' : '#999';" style="display: none;">
    <label for="image" style="padding: 8px 15px; background: #4a90d9; color: #fff; border-radius: 4px; cursor: pointer; font-size: 13px;">Выбрать файл</label>
</div>
@error('image')
<div class="error-message">{{ $message }}</div>
@enderror

<button type="submit">Создать зал</button>
</form>

<p class="link"><a href="{{ Route('dashboard') }}">На главную</a></p>
</div>
</body>
</html>
