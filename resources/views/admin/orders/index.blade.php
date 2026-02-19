@extends('admin.layouts.app')

@section('title', 'Siparişler')
@section('header', 'Siparişler')

@section('content')
<div class="-mx-4 sm:-mx-6 lg:-mx-8" data-orders-poll data-last-order-id="{{ $orders->isNotEmpty() ? $orders->first()->id : 0 }}" data-last-order-at="{{ $orders->isNotEmpty() ? $orders->first()->created_at->toIso8601String() : now()->toIso8601String() }}">
    <div class="px-4 sm:px-6 lg:px-8 mb-6 flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Siparişler</h1>
        <form action="{{ route('admin.orders.index') }}" method="GET" class="flex gap-2">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <input type="hidden" name="city" value="{{ request('city') }}">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="İsim, soyisim veya sipariş no ara..." class="w-48 sm:w-64 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
            <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white px-4 py-2 rounded-lg font-medium text-sm">Ara</button>
        </form>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 sm:px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Sipariş No</th>
                    <th class="px-4 sm:px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Müşteri</th>
                    <th class="px-4 sm:px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden sm:table-cell">İl</th>
                    <th class="px-4 sm:px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Toplam</th>
                    <th class="px-4 sm:px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Durum</th>
                    <th class="px-4 sm:px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ödeme</th>
                    <th class="px-4 sm:px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden lg:table-cell">Tarih</th>
                    <th class="px-4 sm:px-6 py-3.5 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider w-24">İşlem</th>
                </tr>
            </thead>
            <tbody id="orders-tbody" class="divide-y divide-gray-200">
                @include('admin.orders._table')
            </tbody>
        </table>
    </div>
        <div id="orders-pagination" class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50/50">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
