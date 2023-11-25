@extends('layout.app')

@section('content')
    <x-hero />

    <section>
        <div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8">
            <header class="text-center">
                <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">
                    New Products
                </h2>
                @if ($products->isEmpty())
                    <p class="max-w-full mt-4 text-gray-500">
                        Nothing to show yet
                    </p>
                @endif
            </header>

            <ul class="grid gap-4 mt-8 grid-cols-2 lg:grid-cols-4">
                @foreach ($products as $product)
                    <li>
                        <x-card :product="$product" />
                    </li>
                @endforeach
            </ul>

            <div class="mt-8 text-center ">
                <a class="group relative inline-block text-sm font-medium text-black focus:outline-none focus:ring active:text-black"
                    href="{{ route('guest.product.index') }}">
                    <span
                        class="absolute inset-0 translate-x-0 translate-y-0 bg-black transition-transform group-hover:translate-y-0.5 group-hover:translate-x-0.5"></span>

                    <span class="relative block border border-current bg-white px-8 py-3">
                        See More
                    </span>
                </a>
            </div>
        </div>
    </section>

    <x-guest.about-us />
@endsection
