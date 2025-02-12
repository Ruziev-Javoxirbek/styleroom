<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Заказ #{{ $order->id }}</title>
</head>
<body>
<h1>Заказ #{{ $order->id }}</h1>
<p><strong>Пользователь:</strong> {{ $order->user->full_name ?? 'Гость' }}</p>
<p><strong>Статус:</strong> {{ $order->status }}</p>
<p><strong>Дата заказа:</strong> {{ $order->created_at }}</p>

<h2>Список товаров</h2>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Количество</th>
        <th>Цена за единицу</th>
        <th>Итого</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->pivot->quantity }}</td>
            <td>{{ $product->pivot->price }} ₽</td>
            <td>{{ $product->pivot->quantity * $product->pivot->price }} ₽</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h2>Итого: {{ $total }} ₽</h2>

<br>
<a href="{{ url('/orders') }}">Вернуться к списку заказов</a>
</body>
</html>
