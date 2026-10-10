<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('details.product')
                       ->where('id_user', auth()->user()->id_user)
                       ->orderByDesc('tanggal_order')
                       ->get();

        return view('order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('details.product')
                      ->where('id_user', auth()->user()->id_user)
                      ->findOrFail($id);

        return view('order.show', compact('order'));
    }
}