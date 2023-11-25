<a href="{{ route('guest.product.show', ['product' => $product]) }}" class="group block overflow-hidden">
    <div class="relative h-[350px] sm:h-[450px]">
        {{-- <img src="{{ Storage::url('foto_baju/' . $product->fotobaju_satu) }}" alt="{{ $product->fotobaju_satu }}"
            class="absolute inset-0 h-full w-full transition duration-500 object-cover opacity-100 group-hover:opacity-0" /> --}}
        <img src="{{ $product->fotobaju_satu }}" alt="{{ $product->fotobaju_satu }}"
            class="absolute inset-0 h-full w-full transition duration-500 object-cover opacity-100 group-hover:opacity-0" />

        {{-- <img src="{{ Storage::url('foto_baju/' . $product->fotobaju_dua) }}" alt="{{ $product->fotobaju_dua }}"
            class="absolute inset-0 h-full w-full object-cover transition duration-500 opacity-0 group-hover:opacity-100" /> --}}
        <img src="{{ $product->fotobaju_dua }}" alt="{{ $product->fotobaju_dua }}"
            class="absolute inset-0 h-full w-full object-cover transition duration-500 opacity-0 group-hover:opacity-100" />
    </div>

    <div class="mt-3 flex justify-between text-sm">
        <div>
            <h3 class="text-gray-900 group-hover:underline group-hover:underline-offset-4">
                {{ $product->nama }}
            </h3>

            <p class="mt-1.5 max-w-[45ch] text-xs text-gray-500">
                {{ $product->kategori }}
            </p>
        </div>

        <p class="text-gray-900">
            {{ 'Rp ' . number_format($product->harga) }}
        </p>

    </div>
</a>
