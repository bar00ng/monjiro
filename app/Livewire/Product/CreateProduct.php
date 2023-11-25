<?php

namespace App\Livewire\Product;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CreateProduct extends Component
{
    use WithFileUploads;

    #[Validate('required|unique:products,nama')]
    public $nama_barang;

    #[Validate('required')]
    public $kategori;

    #[Validate('required')]
    public $warna = ['#000000'];

    #[Validate('required')]
    public $harga;

    #[Validate('required')]
    public $note;

    #[Validate('required|url')]
    public $link_shop;

    public $ukuran = [];

    #[Validate('required|image|max:1024')]
    public $fotobaju_satu;

    #[Validate('required|image|max:1024')]
    public $fotobaju_dua;

    #[Validate('required|image|max:1024')]
    public $fotobaju_tiga;

    public function addColor()
    {
        $this->warna[] = '#000000';
    }

    public function removeColor($index)
    {
        unset($this->warna[$index]);
        $this->warna = array_values($this->warna);
    }

    public function onSubmit()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $product = \App\Models\Product::create([
                'nama' => $this->nama_barang,
                'ukuran' => $this->ukuran,
                'warna' => $this->warna,
                'link_shop' => $this->link_shop,
                'note' => $this->note,
                'harga' => $this->harga,
                'kategori' => $this->kategori,
            ]);

            $productID = $product->id;

            // Generate Unique name for foto baju satu
            $fotobaju_satu_file = $this->fotobaju_satu;
            $fotobaju_satu_ext = $fotobaju_satu_file->getClientOriginalExtension();
            $fotobaju_satu_unique_name = Str::uuid()->toString() . '.' . $fotobaju_satu_ext;

            // Generate Unique name for foto baju dua
            $fotobaju_dua_file = $this->fotobaju_dua;
            $fotobaju_dua_ext = $fotobaju_dua_file->getClientOriginalExtension();
            $fotobaju_dua_unique_name = Str::uuid()->toString() . '.' . $fotobaju_dua_ext;

            // Generate Unique name for foto baju tiga
            $fotobaju_tiga_file = $this->fotobaju_tiga;
            $fotobaju_tiga_ext = $fotobaju_tiga_file->getClientOriginalExtension();
            $fotobaju_tiga_unique_name = Str::uuid()->toString() . '.' . $fotobaju_tiga_ext;

            $product->update([
                'fotobaju_satu' => $fotobaju_satu_unique_name,
                'fotobaju_dua' => $fotobaju_dua_unique_name,
                'fotobaju_tiga' => $fotobaju_tiga_unique_name,
            ]);

            DB::commit();

            // Upload files after committing the transaction
            $fotobaju_satu_file->storeAs('foto_baju', $fotobaju_satu_unique_name, 'public');
            $fotobaju_dua_file->storeAs('foto_baju', $fotobaju_dua_unique_name, 'public');
            $fotobaju_tiga_file->storeAs('foto_baju', $fotobaju_tiga_unique_name, 'public');

            $this->reset();
            Log::success('Product data has been added');

            // Redirect to list product
        } catch (QueryException $ex) {
            DB::rollBack();
            Log::error("Query Exception\t: " . $ex->getMessage());
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Throwable\t: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.product.create-product');
    }
}
