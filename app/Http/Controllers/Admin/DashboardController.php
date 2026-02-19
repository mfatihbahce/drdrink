<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Store;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        if (auth()->user()->hasRole('Kasiyer')) {
            return $this->cashierDashboard();
        }

        $base = Order::query();
        $paidBase = (clone $base)->where('payment_status', Order::PAYMENT_PAID)->where('status', '!=', Order::STATUS_CANCELLED);

        $totalStores = Store::count();
        $activeStores = Store::active()->count();
        $todayOrders = (clone $base)->whereDate('created_at', today())->count();
        $pendingOrders = (clone $base)->where('status', Order::STATUS_PENDING)->count();
        $todayRevenue = (clone $paidBase)->whereDate('created_at', today())->sum('total');
        $weeklyRevenue = (clone $paidBase)->where('created_at', '>=', now()->startOfWeek())->sum('total');
        $monthlyRevenue = (clone $paidBase)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('total');
        $lastMonthRevenue = (clone $paidBase)->whereMonth('created_at', now()->subMonth()->month)->whereYear('created_at', now()->subMonth()->year)->sum('total');

        $topStores = Store::with('city')
            ->withCount(['orders as orders_this_month' => function ($q) {
                $q->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
            }])
            ->orderByDesc('orders_this_month')
            ->take(8)
            ->get();

        $topStoresByRevenue = Store::with('city')
            ->withSum(['orders as revenue_this_month' => function ($q) {
                $q->where('payment_status', Order::PAYMENT_PAID)
                    ->where('status', '!=', Order::STATUS_CANCELLED)
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            }], 'total')
            ->orderByDesc('revenue_this_month')
            ->take(8)
            ->get();

        $chartLabels = [];
        $chartOrders = [];
        $chartEarnings = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $chartLabels[] = $date->locale('tr')->dayName . ' ' . $date->format('d.m');
            $chartOrders[] = (clone $base)->whereDate('created_at', $date)->count();
            $chartEarnings[] = (float) (clone $paidBase)->whereDate('created_at', $date)->sum('total');
        }

        $recentOrders = Order::with(['city', 'store'])->latest()->take(8)->get();
        $pendingOrdersList = Order::with('store')->where('status', Order::STATUS_PENDING)->latest()->take(8)->get();

        return view('admin.dashboard', compact(
            'totalStores', 'activeStores', 'todayOrders', 'pendingOrders',
            'todayRevenue', 'weeklyRevenue', 'monthlyRevenue', 'lastMonthRevenue',
            'topStores', 'topStoresByRevenue', 'recentOrders', 'pendingOrdersList',
            'chartLabels', 'chartOrders', 'chartEarnings'
        ));
    }

    private function cashierDashboard(): View
    {
        $base = Order::query();
        $todayOrders = (clone $base)->whereDate('created_at', today())->count();
        $pendingOrders = (clone $base)->where('status', Order::STATUS_PENDING)->count();
        $recentOrders = Order::with(['city', 'store'])->latest()->take(12)->get();
        $pendingOrdersList = Order::with('store')->where('status', Order::STATUS_PENDING)->latest()->take(12)->get();

        return view('admin.cashier-dashboard', compact(
            'todayOrders', 'pendingOrders', 'recentOrders', 'pendingOrdersList'
        ));
    }
}
