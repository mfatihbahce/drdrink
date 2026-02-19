<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(): View
    {
        $logs = Activity::with(['causer', 'subject'])
            ->latest()
            ->paginate(50);

        // Mağaza bilgisi için store ilişkilerini toplu yükle (N+1 önleme)
        $orderIds = $logs->filter(fn($l) => $l->subject_type && str_contains($l->subject_type, 'Order'))
            ->pluck('subject_id')->unique()->filter();
        $userIds = $logs->filter(fn($l) => $l->subject_type && str_contains($l->subject_type, 'User'))
            ->pluck('subject_id')->unique()->filter();

        $ordersWithStore = $orderIds->isNotEmpty()
            ? \App\Models\Order::with('store.city')->whereIn('id', $orderIds)->get()->keyBy('id')
            : collect();
        $usersWithStores = $userIds->isNotEmpty()
            ? \App\Models\User::with('stores.city')->whereIn('id', $userIds)->get()->keyBy('id')
            : collect();

        $logs->each(function ($log) use ($ordersWithStore, $usersWithStores) {
            if ($log->subject_type && str_contains($log->subject_type, 'Order') && isset($ordersWithStore[$log->subject_id])) {
                $log->subject = $ordersWithStore[$log->subject_id];
            } elseif ($log->subject_type && str_contains($log->subject_type, 'User') && isset($usersWithStores[$log->subject_id])) {
                $log->subject = $usersWithStores[$log->subject_id];
            }
        });

        return view('admin.activity-log.index', compact('logs'));
    }
}
