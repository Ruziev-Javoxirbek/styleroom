<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders', [
            'orders' => Order::all()
        ]);
    }

    public function show($id)
    {
        $order = Order::with('products')->findOrFail($id);

        // Подсчёт общей суммы заказа
        $total = DB::table('order_items')
            ->where('order_id', $id)
            ->selectRaw('SUM(quantity * price) as total')
            ->first();

        return view('order', [
            'order' => $order,
            'total' => $total->total
        ]);
    }
}
