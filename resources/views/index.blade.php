@extends('layout.app')

@section('content')
<x-hero />

<div class="p-5 md:p-20">
    <h1 class="text-2xl font-bold text-center mb-10">
        NEWW
    </h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-10">
        @foreach ($products as $product)
            <a href="{{ url('/produk/' . $barang->id . '/detail') }}">
                <x-card :cardImage="$barang->fotobaju_satu" :cardTitle="$barang->nama" :cardSubTitle="$barang->harga" />
            </a>
        @endforeach
    </div>

    <div class="text-center mb-10">
        <button class="bg-black uppercase text-white px-5 py-2 mt-6">See More</button>
    </div>

    <!-- TODO About Us Section -->
</div>
@endsection
