<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить товар</title>
</head>
<body>
<h1>Добавить товар</h1>
<form action="{{ url('/product') }}" method="POST">
    @csrf
    <label>Название:</label>
    <input type="text" name="name" required><br>

    <label>Категория:</label>
    <select name="category_id" required>
        <option value="" style="display:none">Выберите категорию</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select><br>

    <label>Описание:</label>
    <textarea name="description"></textarea><br>

    <label>Цена:</label>
    <input type="number" name="price" step="0.01" required><br>

    <label>Вес:</label>
    <input type="number" name="weight" step="0.01" required><br>

    <label>Количество:</label>
    <input type="number" name="stock_quantity" required><br>

    <button type="submit">Добавить</button>
</form>
<br>
<a href="{{ url('/products') }}">Вернуться к списку товаров</a>
</body>
</html>
