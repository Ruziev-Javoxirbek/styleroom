<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Показывает страницу входа
    public function showLoginForm()
    {
        return view('login');
    }

    // Обрабатывает вход пользователя
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/products');
        }

        return back()->withErrors(['email' => 'Неверный email или пароль']);
    }

    // Показывает страницу регистрации
    public function showRegisterForm()
    {
        return view('register');
    }

    // Обрабатывает регистрацию
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name, // Было 'full_name'
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
        ]);

        return redirect('/login')->with('success', 'Аккаунт создан. Войдите в систему.');
    }

    // Выход из системы
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Вы вышли из системы.');
    }
}
