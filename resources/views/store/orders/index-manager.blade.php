@extends('store.layouts.app')

@section('title', 'Paket Sipariş')
@section('header', 'Paket Sipariş')

@section('content')
<div data-orders-poll data-last-order-id="{{ $orders->isNotEmpty() ? $orders->first()->id : 0 }}" data-last-order-at="{{ $orders->isNotEmpty() ? $orders->first()->created_at->toIso8601String() : now()->toIso8601String() }}">
    <div id="new-order-alert-banner" class="hidden mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg text-sm">Yeni paket sipariş geldi! Liste güncellendi.</div>
</div>
<div class="mb-6 flex flex-wrap items-center justify-between gap-4">
    <h1 class="text-2xl font-bold text-gray-800">Paket Sipariş</h1>
    <form action="{{ route('store.orders.index') }}" method="GET" class="flex gap-2">
        <input type="hidden" name="status" value="{{ request('status') }}">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="İsim, soyisim veya sipariş no ara..." class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
        <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white px-4 py-2 rounded-lg font-medium text-sm">Ara</button>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sipariş No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Müşteri</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Toplam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ödeme</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlem</th>
            </tr>
        </thead>
        <tbody id="orders-tbody" class="divide-y divide-gray-200">
            @include('store.orders._table-manager')
        </tbody>
    </table>
    <div id="orders-pagination" class="px-6 py-4">{{ $orders->links() }}</div>
</div>
@endsection
