@extends('store.layouts.app')

@section('title', 'Kasiyerler')
@section('header', 'Kasiyerler')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Mağaza Kullanıcıları</h1>
    <a href="{{ route('store.users.create') }}" class="bg-amber-600 hover:bg-amber-500 text-white px-4 py-2 rounded-lg font-medium">Yeni Kasiyer Ekle</a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ad Soyad</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">E-posta</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telefon</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($users as $u)
                <tr>
                    <td class="px-6 py-4 font-medium">{{ $u->name }}</td>
                    <td class="px-6 py-4">{{ $u->email }}</td>
                    <td class="px-6 py-4">{{ $u->phone ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded {{ $u->pivot->role === 'manager' ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-700' }}">
                            {{ $u->pivot->role === 'manager' ? 'Yönetici' : 'Kasiyer' }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if($users->isEmpty())
        <div class="px-6 py-12 text-center text-gray-500">Henüz kullanıcı yok. Yeni kasiyer ekleyebilirsiniz.</div>
    @endif
</div>
@endsection
