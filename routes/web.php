<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Группа маршрутов для аутентификации (доступна всем)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [LoginController::class, 'showRegisterForm']);
    Route::post('/register', [LoginController::class, 'register']);
});

// Маршрут выхода (доступен только аутентифицированным пользователям)
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Группа маршрутов для категорий (доступна всем)
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::get('/category/{id}/products', [ProductController::class, 'categoryProducts']); // Исправлен маршрут
Route::get('/product/{id}/view', [ProductController::class, 'view'])->name('product.view');

// Группа маршрутов для товаров (только аутентифицированные пользователи)
Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::post('/product', [ProductController::class, 'store']);

    Route::get('/product/{id}', [ProductController::class, 'show']);

    Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/product/update/{id}', [ProductController::class, 'update']);

    Route::get('/product/destroy/{id}', [ProductController::class, 'destroy']);
});

Route::get('/profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');
Route::post('/profile/update', [UserController::class, 'update'])->middleware('auth');

// Группа маршрутов для заказов (только аутентифицированные пользователи)
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/order/{id}', [OrderController::class, 'show']);
});

Route::get('/error', function () {
    return view('error');
});

// Главная страница и тестовые маршруты (доступны всем)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello', ['title' => 'Hello World!']);
});
