@extends('layout.app')

@section('content')
    <section>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:py-12 sm:px-6 lg:py-16 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-16">
                <div class="h-64 rounded-lg sm:h-80 lg:h-96 carousel">
                    <div class="carousel-item w-full">
                        {{-- <img alt="Party"
                            src="{{ Storage::url('foto_baju/' . $product->fotobaju_satu) }}"
                            class=" w-full" /> --}}
                        <img alt="Party" src="{{ $product->fotobaju_satu }}" class=" w-full" />
                    </div>
                    <div class="carousel-item w-full">
                        {{-- <img alt="Party"
                            src="{{ Storage::url('foto_baju/' . $product->fotobaju_dua) }}"
                            class=" w-full" /> --}}
                        <img alt="Party" src="{{ $product->fotobaju_dua }}" class=" w-full" />
                    </div>
                    <div class="carousel-item w-full">
                        {{-- <img alt="Party"
                            src="{{ Storage::url('foto_baju/' . $product->fotobaju_tiga) }}"
                            class=" w-full" /> --}}
                        <img alt="Party" src="{{ $product->fotobaju_tiga }}"
                            class=" w-full" />
                    </div>
                </div>

                <div>
                    <h2 class="text-3xl font-bold sm:text-4xl">
                        {{ $product->nama }}
                    </h2>

                    <span class="mt-2 text-gray-600">
                        {{ $product->kategori }}
                    </span>

                    <h2 class="text-2xl mt-2">
                        {{ 'Rp ' . number_format($product->harga) }}
                    </h2>


                    <p class="mt-4 text-gray-600">
                        {{ $product->note }}
                    </p>

                    <div class="mt-8">
                        <div class="grid grid-cols-2 gap-4 lg:grid-cols-3 lg:gap-8">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Available Sizes</h3>
                                <div class="mt-4">
                                    <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                                        @foreach ($product->ukuran as $ukuran)
                                            <li class="text-gray-400">
                                                <span class="text-gray-600">
                                                    {{ $ukuran }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">Colors</h3>
                                <div class="mt-4">
                                    <span class="text-gray-600">
                                        <div class="flex items-center space-x-3">
                                            @foreach ($product->warna as $warna)
                                                <label
                                                    class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none ring-gray-400">
                                                    <input type="radio" name="color-choice" value="White" class="sr-only"
                                                        aria-labelledby="color-choice-0-label">
                                                    <span id="color-choice-0-label" class="sr-only">
                                                        {{ $warna }}
                                                    </span>
                                                    <span aria-hidden="true" style="background-color: {{ $warna }};"
                                                        class="h-8 w-8 rounded-full border border-black border-opacity-10"></span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 text-center md:text-start">
                        <a class="group relative inline-block text-sm font-medium text-orange-600 focus:outline-none focus:ring active:text-orange-500"
                            href="{{ $product->link_shop }}">
                            <span
                                class="absolute inset-0 translate-x-0 translate-y-0 bg-orange-600 transition-transform group-hover:translate-y-0.5 group-hover:translate-x-0.5"></span>

                            <span class="relative block border border-current bg-white px-8 py-3">
                                Order Now
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8">
            <header>
                <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">
                    Related Products
                </h2>

                @if ($relatedProducts->isEmpty())
                    <p class="max-w-full mt-4 text-gray-500 text-center">
                        Nothing to show yet
                    </p>
                @endif
            </header>

            <ul class="grid gap-4 mt-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($relatedProducts as $product)
                    <li>
                        <x-card :product="$product" />
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
