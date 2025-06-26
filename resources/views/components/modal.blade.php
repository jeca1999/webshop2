<div
    x-show="show"
    class="mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all w-full {{ $maxWidth }} sm:mx-auto"
    style="max-height: 90vh;"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
>
    <div class="overflow-y-auto p-4" style="max-height: 90vh;">
        @isset($product)
            <div class="w-full flex justify-center mb-4">
                <img 
                    src="{{ asset('storage/product/images/' . basename($product->image)) }}" 
                    alt="{{ $product->name }}"
                    class="max-h-[60vh] w-auto object-contain rounded"
                />
            </div>
        @endisset

        {{ $slot }}
    </div>
</div>
