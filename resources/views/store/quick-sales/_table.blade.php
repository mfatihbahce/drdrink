@php
    $payLabels = \App\Models\Order::getPaymentStatusLabels();
    $statusLabels = \App\Models\Order::getStatusLabels();
@endphp
@foreach($orders as $order)
    @php
        $payStatus = $order->payment_status ?? 'pending';
        $isPaid = in_array($payStatus, ['paid', 'SUCCESS', 1], true);
    @endphp
    <tr class="pos-orders-row">
        <td class="font-medium">{{ $order->order_number }}</td>
        <td>{{ $order->customer_name }}</td>
        <td>{{ $order->user?->name ?? '-' }}</td>
        <td class="font-medium" style="color: var(--pos-accent);">{{ number_format($order->total, 2) }} ₺</td>
        <td>
            <span class="pos-badge
                @if($order->status === 'pending') pos-badge-pending
                @elseif($order->status === 'delivered') pos-badge-delivered
                @elseif($order->status === 'cancelled') pos-badge-cancelled
                @else pos-badge-default
                @endif">
                {{ $statusLabels[$order->status] ?? $order->status }}
            </span>
        </td>
        <td>
            <span class="pos-badge
                @if($isPaid) pos-badge-paid
                @elseif($payStatus === 'failed') pos-badge-cancelled
                @elseif($payStatus === 'refunded') pos-badge-refunded
                @else pos-badge-pending
                @endif">
                {{ $payLabels[$payStatus] ?? ($isPaid ? 'Ödeme Alındı' : ($payLabels['pending'] ?? 'Beklemede')) }}
            </span>
        </td>
        <td class="pos-date-cell">{{ $order->created_at->format('d.m.Y H:i') }}</td>
        <td style="text-align: right;">
            <a href="{{ route('store.quick-sales.show', $order) }}" class="pos-link" style="display: inline-flex; padding: 6px 12px; border-radius: 8px; font-size: 0.875rem;">Detay</a>
        </td>
    </tr>
@endforeach
