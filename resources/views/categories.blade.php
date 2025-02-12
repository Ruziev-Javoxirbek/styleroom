<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Категории</title>
</head>
<body>
    <h2>Список категорий:</h2>
    <table border="1">
        <thead>
        <tr>
            <th>id</th>
            <th>Наименование</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>
                    <a href="{{ url('/category/' . $category->id . '/products') }}">
                        {{ $category->name }}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
