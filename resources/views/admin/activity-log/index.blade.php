@extends('admin.layouts.app')

@section('title', 'İşlem Geçmişi')
@section('header', 'İşlem Geçmişi')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">İşlem Geçmişi</h1>
    <p class="text-gray-500 mt-1">Kullanıcı işlemleri ve değişiklik kayıtları</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kullanıcı</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">İşlem</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Konu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Mağaza</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Değişiklikler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($logs as $log)
                    <tr class="hover:bg-gray-50/50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $log->created_at->format('d.m.Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $log->causer?->name ?? 'Sistem' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $actionClass = match($log->description) {
                                    'created' => 'bg-emerald-100 text-emerald-800',
                                    'updated' => 'bg-amber-100 text-amber-800',
                                    'deleted' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded {{ $actionClass }}">
                                {{ \App\Helpers\ActivityLogHelper::actionLabel($log->description) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            @if($log->subject_type)
                                {{ \App\Helpers\ActivityLogHelper::subjectLabel($log->subject_type) }} #{{ $log->subject_id ?? '-' }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            @php $storeTag = \App\Helpers\ActivityLogHelper::storeTag($log); @endphp
                            @if($storeTag)
                                <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded bg-amber-100 text-amber-800">{{ $storeTag }}</span>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="max-w-md whitespace-pre-wrap font-mono text-xs bg-gray-50 rounded-lg px-3 py-2 border border-gray-100">
                                {{ \App\Helpers\ActivityLogHelper::formatProperties($log) }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-100">{{ $logs->links() }}</div>
</div>
@endsection
