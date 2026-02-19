<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-amber-500 text-black font-medium rounded-lg hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition']) }}>
    {{ $slot }}
</button>
