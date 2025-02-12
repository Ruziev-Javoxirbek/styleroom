<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
</head>
<body>
@extends('layout')

@section('title', 'Вход в систему')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="text-center">Вход</h2>

            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Пароль</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Войти</button>
            </form>

            <p class="text-center mt-3">
                Нет аккаунта? <a href="{{ url('/register') }}">Зарегистрируйтесь</a>
            </p>
        </div>
    </div>
@endsection
</body>
</html>
