<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Категория: {{ $category->name }}</title>
</head>
<body>
<h1>Категория: {{ $category->name }}</h1>

<h2>Список товаров в категории</h2>
@if($category->products->count() > 0)
    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Вес</th>
            <th>Кол-во на складе</th>
            <th>Фото</th>
        </tr>
        </thead>
        <tbody>
        @foreach($category->products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }} ₽</td>
                <td>{{ $product->weight }} гр</td>
                <td>{{ $product->stock_quantity }}</td>
                <td>{{ $product->image }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>Товары в этой категории пока отсутствуют.</p>
@endif

<br>
<a href="{{ url('/category') }}">Вернуться к списку категорий</a>
</body>
</html>
