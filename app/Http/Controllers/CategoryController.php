<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories', [
            'categories' => Category::all()
        ]);
    }

    public function show($id)
    {
        $category = Category::with('products')->findOrFail($id);

        return view('category', [
            'category' => Category::all()->where('id', $id)->first()
        ]);
    }

    public function products($id)
    {
        $category = Category::with('products')->findOrFail($id);

        return view('products', [
            'products' => $category->products,
            'category' => $category
        ]);
    }
}
