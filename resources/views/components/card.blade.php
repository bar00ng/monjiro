<div class="card card-compact max-w-fit bg-base-100 rounded-none">
    <figure><img src="{{ Storage::url('foto_barang/' . $cardImage) }}" alt="Shoes"
            /></figure>
    <div class="card-body">
        <p class="font-bold text-lg text-center">
            {{ $cardTitle }}
        </p>
        <p class="font-light text-center">
            {{ 'Rp ' . number_format($cardSubTitle) }}
        </p>
    </div>
</div>
