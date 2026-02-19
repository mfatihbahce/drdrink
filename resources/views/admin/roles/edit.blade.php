@extends('admin.layouts.app')

@section('title', 'Rol Düzenle')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.roles.index') }}" class="text-amber-600 hover:text-amber-700 font-medium">← Rollere Dön</a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
        <h1 class="text-xl font-bold text-gray-900">Rol Düzenle: {{ $role->name }}</h1>
        <p class="text-sm text-gray-500 mt-1">Rol adını ve yetkileri güncelleyin.</p>
    </div>
    <form action="{{ route('admin.roles.update', $role) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        <div class="mb-8">
            <label class="block font-medium text-gray-700 mb-2">Rol Adı</label>
            <input type="text" name="name" value="{{ old('name', $role->name) }}" required
                class="w-full max-w-md border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
            @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block font-medium text-gray-700 mb-4">Yetkiler</label>
            <p class="text-sm text-gray-500 mb-6">Bu role verilecek yetkileri işaretleyin.</p>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($permissions as $group => $perms)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                        <h3 class="font-semibold text-gray-900 mb-3 pb-2 border-b border-gray-200">
                            {{ \App\Helpers\PermissionLabels::groupLabel($group) }}
                        </h3>
                        <div class="space-y-2">
                            @foreach($perms as $perm)
                                <label class="flex items-center gap-2 cursor-pointer hover:bg-white/50 rounded px-2 py-1.5 -mx-2 -my-1.5 transition">
                                    <input type="checkbox" name="permissions[]" value="{{ $perm->name }}"
                                        {{ $role->hasPermissionTo($perm->name) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
                                    <span class="text-sm text-gray-700">{{ \App\Helpers\PermissionLabels::label($perm->name) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-8 pt-6 border-t border-gray-200">
            <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white px-6 py-2.5 rounded-lg font-medium transition">
                Değişiklikleri Kaydet
            </button>
        </div>
    </form>
</div>
@endsection
