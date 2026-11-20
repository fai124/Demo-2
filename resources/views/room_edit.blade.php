<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Конференции.РФ — Редактирование зала</title>
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<div class="form-container">
<h2>Редактирование зала</h2>

<form action="{{ Route('room.update', $room) }}" method="POST" enctype="multipart/form-data">
@csrf

<label for="name">Название зала</label>
<input type="text" name="name" id="name" placeholder="Введите название зала" value="{{ old('name', $room->name) }}">
@error('name')
<div class="error-message">{{ $message }}</div>
@enderror

<label for="description">Описание</label>
<textarea name="description" id="description" rows="4" placeholder="Введите описание зала">{{ old('description', $room->description) }}</textarea>
@error('description')
<div class="error-message">{{ $message }}</div>
@enderror

<label for="image">Картинка</label>
@if ( $room->image )
<img src="{{ asset('storage/rooms/' . $room->image) }}" alt="{{ $room->name }}" style="width: 150px; border-radius: 4px; margin-bottom: 10px;">
<input type="hidden" name="old_image" value="{{ $room->image }}">
@endif
<div style="display: flex; align-items: center; gap: 10px;">
    <input type="text" id="file-name" value="{{ $room->image }}" readonly style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; flex: 1; color: #333;">
    <input type="file" name="image" id="image" onchange="document.getElementById('file-name').value = this.files.length ? this.files[0].name : ''" style="display: none;">
    <label for="image" style="padding: 8px 15px; background: #4a90d9; color: #fff; border-radius: 4px; cursor: pointer; font-size: 13px;">Выбрать файл</label>
</div>
@error('image')
<div class="error-message">{{ $message }}</div>
@enderror

<button type="submit">Сохранить</button>
</form>

<p class="link"><a href="{{ Route('dashboard') }}">На главную</a></p>
</div>
</body>
</html>
