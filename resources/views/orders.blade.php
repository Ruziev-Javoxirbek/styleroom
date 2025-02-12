<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список заказов</title>
</head>
<body>
<h1>Список заказов</h1>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Пользователь</th>
        <th>Статус</th>
        <th>Дата</th>
        <th>Действие</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->full_name ?? 'Гость' }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->created_at }}</td>
            <td><a href="{{ url('/order/' . $order->id) }}">Посмотреть</a></td>
        </tr>
    @endforeach
    </tbody>
</table>

<br>
<a href="{{ url('/') }}">На главную</a>
</body>
</html>
