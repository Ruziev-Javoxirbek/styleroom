<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
</head>
<body>
<h1>Ошибка доступа</h1>
<p style="color: red;">{{ session('error') }}</p>
<a href="{{ url('/products') }}">Вернуться к товарам</a>
</body>
</html>
