<?php

namespace App\Http\Controllers\Store;

use App\Models\Order;

class DashboardController extends StoreBaseController
{
    public function index()
    {
        $store = $this->getStore();
        $base = Order::where('store_id', $store->id);
        $todayBase = (clone $base)->whereDate('created_at', today());
        $monthlyBase = (clone $base)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
        $paidBase = (clone $base)->where('payment_status', Order::PAYMENT_PAID)->where('status', '!=', Order::STATUS_CANCELLED);

        $todayOrders = (clone $todayBase)->count();
        $todayPending = (clone $todayBase)->where('status', Order::STATUS_PENDING)->count();
        $todayDelivered = (clone $todayBase)->where('status', Order::STATUS_DELIVERED)->count();
        $todayCancelled = (clone $todayBase)->where('status', Order::STATUS_CANCELLED)->count();

        $monthlyOrders = (clone $monthlyBase)->count();
        $monthlyCancellations = (clone $monthlyBase)->where('status', Order::STATUS_CANCELLED)->count();
        $monthlyDelivered = (clone $monthlyBase)->where('status', Order::STATUS_DELIVERED)->count();

        $todayEarnings = (clone $paidBase)->whereDate('created_at', today())->sum('total');
        $weeklyEarnings = (clone $paidBase)->where('created_at', '>=', now()->startOfWeek())->sum('total');
        $monthlyEarnings = (clone $paidBase)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('total');

        $chartLabels = [];
        $chartOrders = [];
        $chartEarnings = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $chartLabels[] = $date->locale('tr')->dayName . ' ' . $date->format('d.m');
            $chartOrders[] = (clone $base)->whereDate('created_at', $date)->count();
            $chartEarnings[] = (float) (clone $paidBase)->whereDate('created_at', $date)->sum('total');
        }

        $recentOrders = (clone $base)->with('city')->latest()->take(10)->get();

        return view('store.dashboard', compact(
            'store', 'todayOrders', 'todayPending', 'todayDelivered', 'todayCancelled',
            'monthlyOrders', 'monthlyCancellations', 'monthlyDelivered',
            'todayEarnings', 'weeklyEarnings', 'monthlyEarnings',
            'chartLabels', 'chartOrders', 'chartEarnings', 'recentOrders'
        ));
    }
}
