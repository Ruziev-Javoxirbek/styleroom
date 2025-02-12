<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
</head>
<body>

@extends('layout')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Личный кабинет</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card p-4">
            <form action="{{ url('/profile/update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Имя:</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Новый пароль (необязательно):</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Подтвердите пароль:</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
            </form>
        </div>

        <h2 class="mt-5">Ваши товары</h2>
        <table class="table table-bordered mt-3">
            <thead class="table-light">
            <tr>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'Без категории' }}</td>
                    <td>{{ $product->price }} ₽</td>
                    <td>
                        <a href="{{ url('/product/edit/'.$product->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <a href="{{ url('/product/destroy/'.$product->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Удалить товар?')">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="{{ url('/products') }}" class="btn btn-secondary mt-3">Назад к товарам</a>
    </div>
@endsection

</body>
</html>
