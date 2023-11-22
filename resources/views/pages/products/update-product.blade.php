@extends('layout.admin')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        {{ $title }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.product.index')}}">Barang</a></li>
                        <li class="breadcrumb-item active">
                            {{ $title }}
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-right">
                                <a href="/barang" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-rotate-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <form class="needs-validation" novalidate action="{{ route('admin.product.update', ['product' => $product])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Tambahkan method PUT untuk menandakan bahwa ini adalah formulir edit -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama Barang" value="{{ old('nama', $product->nama) }}" required>
                                            @error('nama')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                                                <option value="">Pilih Kategori</option>
                                                <option value="T-Shirt" {{ old('kategori', $product->kategori) == 'T-Shirt' ? 'selected' : '' }}>T-Shirt</option>
                                                <option value="Shirt" {{ old('kategori', $product->kategori) == 'Shirt' ? 'selected' : '' }}>Shirt</option>
                                                <option value="Sweather" {{ old('kategori', $product->kategori) == 'Sweather' ? 'selected' : '' }}>Sweather</option>
                                                <option value="Jacket" {{ old('kategori', $product->kategori) == 'Jacket' ? 'selected' : '' }}>Jacket</option>
                                                <option value="Pants" {{ old('kategori', $product->kategori) == 'Pants' ? 'selected' : '' }}>Pants</option>
                                                <option value="Accesories" {{ old('kategori', $product->kategori) == 'Accesories' ? 'selected' : '' }}>Accesories</option>
                                                <!-- Tambahkan opsi kategori sesuai dengan kebutuhan Anda -->
                                            </select>
                                            @error('kategori')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" name="warna" class="form-control @error('warna') is-invalid @enderror" id="warna" placeholder="Warna" value="{{ old('warna', $product->warna) }}" required>
                                            @error('warna')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="harga">Harga</label>
                                            <input type="text" name="harga" class="form-control @error('harga') is-invalid @enderror" id="harga" placeholder="Harga" value="{{ old('harga', $product->harga) }}" required>
                                            @error('harga')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" cols="10" rows="5" placeholder="Note">{{ old('note', $product->note) }}</textarea>
                                            @error('note')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="link_shop">Link Shopee</label>
                                            <input type="text" name="link_shop" class="form-control @error('link_shop') is-invalid @enderror" id="link_shop" placeholder="Link Shopee" value="{{ old('link_shop', $product->link_shop) }}" required>
                                            @error('link_shop')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label><br>
                                            <input type="checkbox" name="ukuran[]" value="S" {{ in_array('S', old('ukuran', explode(',', $product->ukuran))) ? 'checked' : '' }}>
                                            S
                                            <input type="checkbox" name="ukuran[]" value="M" {{ in_array('M', old('ukuran', explode(',', $product->ukuran))) ? 'checked' : '' }}>
                                            M
                                            <input type="checkbox" name="ukuran[]" value="L" {{ in_array('L', old('ukuran', explode(',', $product->ukuran))) ? 'checked' : '' }}>
                                            L
                                            <input type="checkbox" name="ukuran[]" value="XL" {{ in_array('XL', old('ukuran', explode(',', $product->ukuran))) ? 'checked' : '' }}>
                                            XL
                                            <input type="checkbox" name="ukuran[]" value="XXL" {{ in_array('XXL', old('ukuran', explode(',', $product->ukuran))) ? 'checked' : '' }}>
                                            XXL
                                            @error('ukuran')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="fotobaju_satu">Foto Depan</label>
                                            <input type="file" name="fotobaju_satu" accept="image/*" class="form-control" id="fotobaju_satu">
                                            @error('fotobaju_satu')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                            @if($product->fotobaju_satu)
                                            <img src="{{ asset('storage/foto_barang/' . $product->fotobaju_satu) }}" alt="Foto Depan" width="150">
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="fotobaju_dua">Foto Belakang</label>
                                            <input type="file" name="fotobaju_dua" accept="image/*" class="form-control" id="fotobaju_dua">
                                            @error('fotobaju_dua')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                            @if($product->fotobaju_dua)
                                            <img src="{{ asset('storage/foto_barang/' . $product->fotobaju_dua) }}" alt="Foto Belakang" width="150">
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="fotobaju_tiga">Foto Chart Ukuran</label>
                                            <input type="file" name="fotobaju_tiga" accept="image/*" class="form-control" id="fotobaju_tiga">
                                            @error('fotobaju_tiga')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                            @if($product->fotobaju_tiga)
                                            <img src="{{ asset('storage/foto_barang/' . $product->fotobaju_tiga) }}" alt="Foto Chart Ukuran" width="150">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-dark mr-1" type="reset"><i class="fa-solid fa-arrows-rotate"></i> Reset</button>
                                <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.content -->
            </div>
        </div>
    </div>
</div>

@endsection
