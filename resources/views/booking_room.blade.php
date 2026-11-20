<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Конференции.РФ — Создание заявки</title>
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<div class="form-container">
<h2>Создание заявки</h2>

<form action="{{ Route('booking.store') }}" method="POST">
@csrf

<input type="hidden" name="room_id" id="room_id" value="{{ $room->id }}">
<p class="room-name">{{ $room->name }}</p>

<label for="date">Дата начала конференции</label>
<input type="date" name="date" id="date" value="{{ old('date') }}">
@error('date')
<div class="error-message">{{ $message }}</div>
@enderror

<label for="payment">Способ оплаты</label>
<select name="payment" id="payment">
<option value="">Выберите способ оплаты</option>
<option value="cash">Очный платёж</option>
<option value="sbp">СБП</option>
</select>
@error('payment')
<div class="error-message">{{ $message }}</div>
@enderror

<button type="submit">Отправить</button>
</form>

<p class="link"><a href="{{ Route('dashboard') }}">На главную</a></p>
</div>
</body>
</html>
