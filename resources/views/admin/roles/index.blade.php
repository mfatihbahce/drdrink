@extends('admin.layouts.app')

@section('title', 'Roller')
@section('header', 'Roller')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Roller</h1>
    <a href="{{ route('admin.roles.create') }}" class="bg-amber-600 hover:bg-amber-500 text-white px-4 py-2 rounded font-medium">Yeni Rol</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Yetki Sayısı</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($roles as $role)
                <tr>
                    <td class="px-6 py-4 font-medium">{{ $role->name }}</td>
                    <td class="px-6 py-4">{{ $role->permissions_count }}</td>
                    <td class="px-6 py-4 text-right">
                        @if($role->name !== 'Super Admin')
                            <a href="{{ route('admin.roles.edit', $role) }}" class="text-amber-600 hover:text-amber-700 mr-2">Düzenle</a>
                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700">Sil</button>
                            </form>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
