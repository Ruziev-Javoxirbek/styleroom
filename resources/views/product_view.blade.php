<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }}</title>
</head>
<body>

<h1>{{ $product->name }}</h1>

@if(auth()->check() && auth()->user()->id === $product->user_id)
    <a href="{{ url('/product/edit/'.$product->id) }}">Редактировать</a>
    <a href="{{ url('/product/destroy/'.$product->id) }}" onclick="return confirm('Удалить товар?')">Удалить</a>
@endif

<p><strong>Категория:</strong> {{ $product->category->name }}</p>
<p><strong>Описание:</strong> {{ $product->description }}</p>
<p><strong>Цена:</strong> {{ $product->price }} ₽</p>
<p><strong>Вес:</strong> {{ $product->weight ?? 'Не указан' }} гр</p>
<p><strong>Количество в наличии:</strong> {{ $product->stock_quantity }}</p>
<p><strong>Продавец:</strong> {{ $product->user->name ?? 'Неизвестно' }}</p>

<a href="{{ url('/category/'.$product->category_id.'/products') }}">Назад к категории</a>

</body>
</html>

