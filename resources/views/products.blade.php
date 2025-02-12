<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список товаров</title>
</head>
<body>
@extends('layout')

@section('title', 'Список товаров')

@section('content')
    @if(Auth::check())
        <a href="{{ url('/profile') }}" class="btn btn-primary mb-3">Личный кабинет</a>
    @endif
    <h1 class="mb-4">Список товаров</h1>

    @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ url('/product/create') }}" class="btn btn-success mb-3">Добавить товар</a>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>Название</th>
            <th>Категория</th>
            <th>Продавец</th>
            <th>Цена</th>
            <th>Вес</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td><a href="{{ route('product.view', $product->id) }}">{{ $product->name }}</a></td>
                <td>{{ $product->category->name ?? 'Без категории' }}</td>
                <td>{{ $product->user->name ?? 'Неизвестный' }}</td>
                <td>{{ $product->price }} ₽</td>
                <td>{{ $product->weight ?? 'Не указан' }} гр</td>
                <td>
                    @if(auth()->check() && auth()->user()->id === $product->user_id)
                        <a href="{{ url('/product/edit/'.$product->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <a href="{{ url('/product/destroy/'.$product->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Удалить товар?')">Удалить</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <form method="GET" action="{{ request()->url() }}" class="mb-3">
        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
        <label>Элементов на странице:</label>
        <select name="perpage" onchange="this.form.submit()" class="form-select w-auto d-inline">
            <option value="3" {{ request('perpage') == 3 ? 'selected' : '' }}>3</option>
            <option value="10" {{ request('perpage') == 10 ? 'selected' : '' }}>10</option>
            <option value="15" {{ request('perpage') == 15 ? 'selected' : '' }}>15</option>
        </select>
    </form>

    {{ $products->links('pagination::bootstrap-5') }}

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(Auth::check())
        <p>Добро пожаловать, {{ Auth::user()->name }}!</p>
        <form action="{{ url('/logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Выйти</button>
        </form>
    @else
        <form action="{{ url('/login') }}" method="POST" class="mb-3">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Пароль:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Войти</button>
        </form>
        <p class="text-center">Нет аккаунта? <a href="{{ url('/register') }}">Зарегистрируйтесь</a></p>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
    @endif
@endsection

</body>
</html>
