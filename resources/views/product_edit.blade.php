<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать товар</title>
</head>
<body>
<h1>Редактировать товар</h1>
<form action="{{ url('/product/update/' . $product->id) }}" method="POST">
    @csrf
    <label>Название:</label>
    <input type="text" name="name" value="{{ $product->name }}" required>
    <br>

    <label>Категория:</label>
    <select name="category_id" required>
        <option value="" style="display:none">Выберите категорию</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <br>

    <label>Описание:</label>
    <textarea name="description">{{ $product->description }}</textarea>
    <br>

    <label>Цена:</label>
    <input type="number" name="price" step="0.01" value="{{ $product->price }}" required>
    <br>

    <label>Вес:</label>
    <input type="number" name="weight" step="0.01" value="{{ $product->weight }}">
    <br>

    <label>Количество на складе:</label>
    <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" required>
    <br>

    <button type="submit">Сохранить изменения</button>
</form>
<br>
<a href="{{ url('/products') }}">Вернуться к списку товаров</a>
</body>
</html>
