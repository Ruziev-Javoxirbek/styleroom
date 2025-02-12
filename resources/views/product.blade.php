<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Товар: {{ $product->name }}</title>
</head>
<body>
<h1>Товар: {{ $product->name }}</h1>

<p><strong>Категория:</strong> {{ $product->category->name ?? 'Без категории' }}</p>
<p><strong>Описание:</strong> {{ $product->description }}</p>
<p><strong>Цена:</strong> {{ $product->price }} ₽</p>
<p><strong>Вес:</strong> {{ $product->weight }} гр</p>
<p><strong>Количество на складе:</strong> {{ $product->stock_quantity }}</p>

<br>
<a href="{{ url('/products') }}">Вернуться к списку товаров</a>
</body>
</html>
