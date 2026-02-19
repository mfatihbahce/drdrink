@extends('admin.layouts.app')

@section('title', 'Kullanıcılar')
@section('header', 'Kullanıcılar')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
    <div class="flex items-center gap-3">
        <h1 class="text-2xl font-bold text-gray-800">Kullanıcılar</h1>
        <a href="{{ route('admin.users.create') }}" class="bg-amber-600 hover:bg-amber-500 text-white px-4 py-2 rounded-lg font-medium text-sm whitespace-nowrap">Yeni Kullanıcı</a>
    </div>
    <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-2 w-full sm:w-auto">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Ad, e-posta veya telefon ara..." class="flex-1 sm:w-64 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
        <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white px-4 py-2 rounded-lg font-medium text-sm">Ara</button>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kullanıcı</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden sm:table-cell">E-posta</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">Telefon</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Rol</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">Mağaza</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden lg:table-cell">Kayıt</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">İşlem</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50/50">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">{{ $user->name }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 hidden sm:table-cell">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 hidden md:table-cell">{{ $user->phone ?? '-' }}</td>
                    <td class="px-6 py-4">
                        @if($user->roles->isNotEmpty())
                            @foreach($user->roles as $role)
                                <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded bg-amber-100 text-amber-800">{{ $role->name }}</span>
                            @endforeach
                        @else
                            <span class="text-gray-400 text-sm">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 hidden md:table-cell">
                        @if($user->stores->isNotEmpty())
                            @foreach($user->stores as $store)
                                <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded bg-amber-100 text-amber-800 mr-1">{{ $store->name ?? '' }}{{ $store->city ? ' (' . $store->city->name . ')' : '' }}</span>
                            @endforeach
                        @else
                            <span class="text-gray-400 text-sm">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 hidden lg:table-cell">{{ $user->created_at->format('d.m.Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-amber-600 hover:text-amber-700 text-sm font-medium">Düzenle</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">Kullanıcı bulunamadı.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50/50">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
