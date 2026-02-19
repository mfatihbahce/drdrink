<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = auth()->user()->orders()->with('city')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order): View|Response
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        $order->load(['items', 'city', 'statusLogs']);
        return view('orders.show', compact('order'));
    }
}
