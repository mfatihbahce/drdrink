@php
    $payLabels = \App\Models\Order::getPaymentStatusLabels();
    $statusLabels = \App\Models\Order::getStatusLabels();
@endphp
@foreach($orders as $order)
    @php
        $payStatus = $order->payment_status ?? 'pending';
        $isPaid = in_array($payStatus, ['paid', 'SUCCESS', 1], true);
    @endphp
    <tr class="hover:bg-gray-50/50 transition-colors">
        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $order->order_number }}</td>
        <td class="px-6 py-4 whitespace-nowrap">{{ $order->customer_name }}</td>
        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ number_format($order->total, 2) }} ₺</td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 py-1 text-xs rounded
                @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                @elseif($order->status === 'delivered') bg-green-100 text-green-800
                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                @else bg-gray-100 text-gray-800
                @endif">
                {{ $statusLabels[$order->status] ?? $order->status }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 py-1 text-xs font-medium rounded
                @if($isPaid) bg-green-100 text-green-800
                @elseif($payStatus === 'failed') bg-red-100 text-red-800
                @elseif($payStatus === 'refunded') bg-orange-100 text-orange-800
                @else bg-yellow-100 text-yellow-800
                @endif">
                {{ $payLabels[$payStatus] ?? ($isPaid ? 'Ödeme Alındı' : ($payLabels['pending'] ?? 'Beklemede')) }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('d.m.Y H:i') }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-right">
            <a href="{{ route('store.orders.show', $order) }}" class="text-amber-600 hover:text-amber-700 font-medium">Detay</a>
        </td>
    </tr>
@endforeach
