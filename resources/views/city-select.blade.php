@extends('layouts.frontend')

@section('title', 'İl Seçin - DrDrink')

@section('content')
<section class="min-h-screen pt-32 pb-24 px-6 lg:px-12">
    <div class="max-w-7xl mx-auto">
        <div class="mb-16 lg:mb-24">
            <span class="text-amber-600 text-sm font-medium tracking-widest">Sipariş</span>
            <h1 class="font-display text-5xl lg:text-7xl font-light mt-2 mb-6 text-gray-900">
                Hizmet verdiğimiz<br>iller
            </h1>
            <p class="text-lg text-gray-600 max-w-xl">
                Sipariş vermek için bulunduğunuz ili seçin. Seçtiğiniz ildeki ürünler listelenecektir.
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach($cities as $city)
                <a href="{{ route('city.set', $city) }}" class="reveal group block p-8 lg:p-10 border border-gray-200 hover:border-amber-400 bg-white hover:bg-amber-50/50 rounded-xl transition-all duration-300 text-center">
                    <span class="font-display text-2xl lg:text-3xl font-light text-gray-900 group-hover:text-amber-600 transition">{{ $city->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
