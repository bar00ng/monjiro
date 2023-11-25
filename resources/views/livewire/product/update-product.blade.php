<form wire:submit="onSubmit" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" wire:model="nama_barang"
                        class="form-control @error('nama_barang') is-invalid @enderror" id="nama"
                        placeholder="Nama Barang">
                    @error('nama_barang')
                        <span class="invalid-feedback text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select wire:model="kategori" id="kategori"
                        class="form-control @error('kategori') is-invalid @enderror">
                        <option>Pilih Kategori</option>
                        <option value="T-Shirt">T-Shirt
                        </option>
                        <option value="Shirt">Shirt</option>
                        <option value="Sweather">Swethear
                        </option>
                        <option value="Jacket">Jacket</option>
                        <option value="Pants">Pants</option>
                        <option value="Accesories">Accesories
                        </option>
                        <!-- Tambahkan opsi kategori sesuai dengan kebutuhan Anda -->
                    </select>
                    @error('kategori')
                        <span class="invalid-feedback text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="warna">Warna</label>
                    @foreach ($warna as $index => $color)
                        <div class="input-group mb-2 mr-2">
                            <input type="color" wire:model="warna.{{ $index }}"
                                class="form-control @error('warna.' . $index) is-invalid @enderror" id="warna"
                                placeholder="Warna">
                            @error('warna.' . $index)
                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                            @enderror
                            <div class="input-group-append">
                                <button type="button" wire:click="removeColor({{ $index }})" class="btn btn-outline-danger" type="button" {{ count($warna) < 2 ? 'disabled' : '' }}>
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                    <button class="btn btn-block btn-sm btn-primary" type="button" wire:click="addColor">Add Color</button>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" wire:model="harga" class="form-control @error('harga') is-invalid @enderror"
                        id="harga" placeholder="Harga">
                    @error('harga')
                        <span class="invalid-feedback text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="note">Note</label>
                    <textarea wire:model="note" id="note" class="form-control @error('note') is-invalid @enderror" cols="10"
                        rows="5" placeholder="Note"></textarea>
                    @error('note')
                        <span class="invalid-feedback text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="nama">Link Shopee</label>
                    <input type="text" wire:model="link_shop"
                        class="form-control @error('link_shop') is-invalid @enderror" id="link_shop"
                        placeholder="Link Shopee" value="">
                    @error('link_shop')
                        <span class="invalid-feedback text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ukuran">Ukuran</label><br>
                    <input type="checkbox" wire:model="ukuran" value="S">
                    S
                    <input type="checkbox" wire:model="ukuran" value="M">
                    M
                    <input type="checkbox" wire:model="ukuran" value="L">
                    L
                    <input type="checkbox" wire:model="ukuran" value="XL">
                    XL
                    <input type="checkbox" wire:model="ukuran" value="XXL">
                    XXL
                    @error('ukuran')
                        <span class="invalid-feedback text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fotobaju_satu">Foto Depan</label>
                    <input type="file" wire:model="fotobaju_satu" accept=".png, .jpg, .jpeg" class="form-control @error('fotobaju_satu') is-invalid @enderror"
                        id="fotobaju_satu">
                    @error('fotobaju_satu')
                        <span class="invalid-feedback text-danger">{{ $message }}</span>
                    @enderror
                    @if($product)
                        <img src="{{ Storage::url('foto_baju/' . $product->fotobaju_satu)}}" alt="{{ $product->fotobaju_satu}}" width="150">
                    @endif
                </div>
                <div class="form-group">
                    <label for="fotobaju_dua">Foto Belakang</label>
                    <input type="file" wire:model="fotobaju_dua" accept="image/*" class="form-control @error('fotobaju_dua') is-invalid @enderror"
                        id="fotobaju_dua">
                    @error('fotobaju_dua')
                        <span class="invalid-feedback text-danger">{{ $message }}</span>
                    @enderror
                    @if($product)
                        <img src="{{ Storage::url('foto_baju/' . $product->fotobaju_dua)}}" alt="{{ $product->fotobaju_dua}}" width="150">
                    @endif
                </div>
                <div class="form-group">
                    <label for="fotobaju_tiga">Foto Chart Ukuran</label>
                    <input type="file" wire:model="fotobaju_tiga" accept="image/*" class="form-control @error('fotobaju_tiga') is-invalid @enderror"
                        id="fotobaju_tiga">
                    @error('fotobaju_tiga')
                        <span class="invalid-feedback text-danger">{{ $message }}</span>
                    @enderror
                    @if($product)
                        <img src="{{ Storage::url('foto_baju/' . $product->fotobaju_tiga)}}" alt="{{ $product->fotobaju_tiga}}" width="150">
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-dark mr-1" type="reset"><i class="fa-solid fa-arrows-rotate"></i> Reset</button>
        <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save</button>
    </div>
</form>
