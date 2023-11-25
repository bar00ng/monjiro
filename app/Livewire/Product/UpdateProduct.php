<?php

namespace App\Livewire\Product;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class UpdateProduct extends Component
{
    use WithFileUploads;

    #[Validate('required')]
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

    #[Validate('sometimes|max:1024')]
    public $fotobaju_satu;

    #[Validate('sometimes|max:1024')]
    public $fotobaju_dua;

    #[Validate('sometimes|max:1024')]
    public $fotobaju_tiga;

    public $product;

    #[On('success')]
    public function successAlert(){
        Alert::success('Success!', 'Data has been updated successfully');
    }

    #[On('error')]
    public function errorAlert(){
        Alert::error('Ups!', 'Something\'s wrong.');
    }

    public function mount($product)
    {
        $this->product = $product;
        $this->nama_barang = $product->nama;
        $this->kategori = $product->kategori;
        $this->warna = $product->warna;
        $this->harga = $product->harga;
        $this->note = $product->note;
        $this->link_shop = $product->link_shop;
        $this->ukuran = $product->ukuran;
    }

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
            $product = \App\Models\Product::find($this->product->id);

            $product->update([
                'nama' => $this->nama_barang,
                'ukuran' => $this->ukuran,
                'warna' => $this->warna,
                'link_shop' => $this->link_shop,
                'note' => $this->note,
                'harga' => $this->harga,
                'kategori' => $this->kategori,
            ]);

            // Rest of your code...
            $productID = $product->id;

            // Generate Unique name for foto baju satu
            if($this->fotobaju_satu){
                $fotobaju_satu_file = $this->fotobaju_satu;
                $fotobaju_satu_ext = $fotobaju_satu_file->getClientOriginalExtension();
                $fotobaju_satu_unique_name = Str::uuid()->toString() . '.' . $fotobaju_satu_ext;
                $product->update([
                    'fotobaju_satu' => $fotobaju_satu_unique_name,
                ]);

                // Delete previous picture
                $this->deletePictureIfExists($product->fotobaju_satu);

                // Upload file after committing the transaction
                $fotobaju_satu_file->storeAs('foto_baju', $fotobaju_satu_unique_name, 'public');
            }

            if ($this->fotobaju_dua) {
                $fotobaju_dua_file = $this->fotobaju_dua;
                $fotobaju_dua_ext = $fotobaju_dua_file->getClientOriginalExtension();
                $fotobaju_dua_unique_name = Str::uuid()->toString() . '.' . $fotobaju_dua_ext;

                $product->update([
                    'fotobaju_dua' => $fotobaju_dua_unique_name,
                ]);

                // Delete previous picture
                $this->deletePictureIfExists($product->fotobaju_dua);

                // Upload file after committing the transaction
                $fotobaju_dua_file->storeAs('foto_baju', $fotobaju_dua_unique_name, 'public');
            }

            // Handle foto baju tiga
            if ($this->fotobaju_tiga) {
                $fotobaju_tiga_file = $this->fotobaju_tiga;
                $fotobaju_tiga_ext = $fotobaju_tiga_file->getClientOriginalExtension();
                $fotobaju_tiga_unique_name = Str::uuid()->toString() . '.' . $fotobaju_tiga_ext;

                $product->update([
                    'fotobaju_tiga' => $fotobaju_tiga_unique_name,
                ]);

                // Delete previous picture
                $this->deletePictureIfExists($product->fotobaju_tiga);

                // Upload file after committing the transaction
                $fotobaju_tiga_file->storeAs('foto_baju', $fotobaju_tiga_unique_name, 'public');
            }

            DB::commit();

            $this->reset();
            Log::success('Product data has been added');

            $this->dispatch('success')->self();
        } catch (QueryException $ex) {
            DB::rollBack();
            $this->dispatch('error')->self();
            Log::error("Query Exception\t: " . $ex->getMessage());
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('error')->self();
            Log::error("Throwable\t: " . $th->getMessage());
        }
        $this->redirectRoute('admin.product.index');
    }

    public function render()
    {
        return view('livewire.product.update-product');
    }

    private function deletePictureIfExists($fileName)
    {
        if ($fileName) {
            Storage::disk('public')->delete('foto_baju/' . $fileName);
        }
    }
}
