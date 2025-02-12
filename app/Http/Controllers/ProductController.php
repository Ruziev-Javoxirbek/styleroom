<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perpage', 3);
        $products = Product::with('category', 'user')->paginate($perPage)->withQueryString();

        return view('products', compact('products', 'perPage'));
    }

    public function categoryProducts(Request $request, $categoryId)
    {
        $perPage = $request->input('perpage', 3);
        $category = Category::findOrFail($categoryId);

        $products = Product::where('category_id', $categoryId)
            ->with('category', 'user')
            ->paginate($perPage)
            ->withQueryString(); // Сохраняет параметры в URL при смене страниц

        return view('products', compact('products', 'category', 'perPage'));
    }

    public function create()
    {
        if (Gate::denies('manage-products')) {
            return redirect('/error')->with('error', 'У вас нет прав для добавления товаров.');
        }

        return view('product_create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0'
        ]);

        // Создание товара
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock_quantity' => $request->stock_quantity,
            'user_id' => auth()->id(), // Записываем владельца товара
        ]);

        // Перенаправляем в категорию, где был создан товар
        return redirect("/category/{$product->category_id}/products")
            ->with('success', 'Товар успешно добавлен!');
    }

    public function view($id)
    {
        $product = Product::with('category', 'user')->findOrFail($id);

        return view('product_view', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('product_edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('manage-products')) {
            return redirect('/error')->with('error', 'У вас нет прав для обновления товаров.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect('/products')->with('success', 'Товар успешно обновлён!');
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $product->delete();

        return redirect('/products')->with('success', 'Товар удалён!');
    }
}
