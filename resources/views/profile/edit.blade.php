@extends('layouts.user-dashboard')

@section('title', 'Profil')

@section('content')
<div class="w-full pb-8">
    <div class="mb-5">
        <h1 class="font-display text-2xl font-semibold text-gray-900">Profil</h1>
        <p class="mt-0.5 text-gray-500 text-sm">Hesap bilgilerinizi ve güvenlik ayarlarınızı yönetin.</p>
    </div>

    <div class="space-y-4">
        {{-- Sol yarı: Profil | Sağ yarı: Şifre --}}
        <div class="flex flex-col gap-4 sm:flex-row">
            {{-- Profil Bilgileri (sol yarı) --}}
            <div class="flex-1 min-w-0 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 bg-amber-50/30">
                    <div class="flex items-center gap-2">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-display text-base font-semibold text-gray-900">Profil Bilgileri</h2>
                            <p class="text-xs text-gray-500">Kişisel bilgilerinizi güncelleyin</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 sm:p-5">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Şifre (sağ yarı) --}}
            <div class="flex-1 min-w-0 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 bg-amber-50/30">
                    <div class="flex items-center gap-2">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-display text-base font-semibold text-gray-900">Şifre</h2>
                            <p class="text-xs text-gray-500">Güvenliğiniz için şifrenizi güncelleyin</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 sm:p-5">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        {{-- Hesap Sil - tam genişlik --}}
        <div class="bg-white rounded-xl border border-red-200 shadow-sm overflow-hidden">
            <div class="px-5 py-3 border-b border-red-100 bg-red-50/50">
                <div class="flex items-center gap-2">
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-display text-base font-semibold text-gray-900">Tehlikeli Bölge</h2>
                        <p class="text-xs text-gray-500">Hesabınızı kalıcı olarak silin</p>
                    </div>
                </div>
            </div>
            <div class="p-4 sm:p-5">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
