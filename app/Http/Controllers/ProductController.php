<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
            TODO :
            Check status login.
                Jika ya, return table list product untuk admin
                Jika tidak, return katalog untuk user
        */
        $products = Product::orderBy('nama', 'asc')->get();

        return view('pages.products.list-product', [
            'products' => $products,
            'title' => 'Products'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.products.create-product', [
            'title' => 'Create Product'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\Product\StoreRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $ukuranArray = $request->input('ukuran', []);
            $ukuranString = implode(',', $ukuranArray);
            $validated['ukuran']= $ukuranString;

             // Simpan foto baju1 jika ada
             if ($request->hasFile('fotobaju_satu')) {
                $fotoBajuSatu = $request->file('fotobaju_satu');
                $namaFotoBajuSatu = uniqid() . '_' . $fotoBajuSatu->getClientOriginalName();
                $validated['fotobaju_satu'] = $namaFotoBajuSatu;
            }

            // Simpan foto baju2 jika ada
            if ($request->hasFile('fotobaju_dua')) {
                $fotoBajuDua = $request->file('fotobaju_dua');
                $namaFotoBajuDua = uniqid() . '_' . $fotoBajuDua->getClientOriginalName();
                $validated['fotobaju_dua'] = $namaFotoBajuDua;
            }

            // Simpan foto baju3 jika ada
            if ($request->hasFile('fotobaju_tiga')) {
                $fotoBajuTiga = $request->file('fotobaju_tiga');
                $namaFotoBajuTiga = uniqid() . '_' . $fotoBajuTiga->getClientOriginalName();
                $validated['fotobaju_tiga'] = $namaFotoBajuTiga;
            }

            Product::create($validated);

            $fotoBajuSatu->storeAs('foto_barang', $namaFotoBajuSatu, 'public');
            $fotoBajuDua->storeAs('foto_barang', $namaFotoBajuDua, 'public');
            $fotoBajuTiga->storeAs('foto_barang', $namaFotoBajuTiga, 'public');

            DB::commit();

            Alert::success('Success', 'Product has been added');
            return to_route('admin.product.index');
        } catch (\Throwable $th) {
            Log::error("Throwable\t: " . $th->getMessage());
            DB::rollBack();

            Alert::error('Ups!', 'Something\'s wrong');
            return to_route('admin.product.index');
        } catch (QueryException $ex) {
            Log::error("Query Exception\t: " . $ex->getMessage());
            DB::rollBack();

            Alert::error('Ups!', 'Something\'s wrong');
            return to_route('admin.product.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('pages.products.show-product', [
            'product' => $product,
            'title' => $product->nama
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('pages.products.update-product', [
            'product' => $product,
            'title' => $product->nama
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\App\Http\Requests\Product\UpdateRequest $request, Product $product)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $ukuranArray = $request->input('ukuran', []);
            $ukuranString = implode(',', $ukuranArray);
            $validated['ukuran']= $ukuranString;

             // Simpan foto baju1 jika ada
             if ($request->hasFile('fotobaju_satu')) {
                $fotoBajuSatu = $request->file('fotobaju_satu');
                $namaFotoBajuSatu = uniqid() . '_' . $fotoBajuSatu->getClientOriginalName();
                $validated['fotobaju_satu'] = $namaFotoBajuSatu;
            }

            // Simpan foto baju2 jika ada
            if ($request->hasFile('fotobaju_dua')) {
                $fotoBajuDua = $request->file('fotobaju_dua');
                $namaFotoBajuDua = uniqid() . '_' . $fotoBajuDua->getClientOriginalName();
                $validated['fotobaju_dua'] = $namaFotoBajuDua;
            }

            // Simpan foto baju3 jika ada
            if ($request->hasFile('fotobaju_tiga')) {
                $fotoBajuTiga = $request->file('fotobaju_tiga');
                $namaFotoBajuTiga = uniqid() . '_' . $fotoBajuTiga->getClientOriginalName();
                $validated['fotobaju_tiga'] = $namaFotoBajuTiga;
            }

            $product->update($validated);

            $fotoBajuSatu->storeAs('foto_barang', $namaFotoBajuSatu, 'public');
            $fotoBajuDua->storeAs('foto_barang', $namaFotoBajuDua, 'public');
            $fotoBajuTiga->storeAs('foto_barang', $namaFotoBajuTiga, 'public');

            // TODO Hapus gambar sebelumnya
            // if (Storage::exists('/foto_barang/' . $product->fotobaju_satu)) {
            //     Storage::delete('/foto_barang/' . $product->fotobaju_satu);
            // } else {
            //     return $product->fotobaju_satu;
            // }
            // if (Storage::exists('/foto_barang/' . $product->fotobaju_dua)) {
            //     Storage::delete('/foto_barang/' . $product->fotobaju_dua);
            // }else {
            //     return $product->fotobaju_dua;
            // }

            // if (Storage::exists('/foto_barang/' . $product->fotobaju_tiga)) {
            //     Storage::delete('/foto_barang/' . $product->fotobaju_tiga);
            // }else {
            //     return $product->fotobaju_tiga;
            // }

            DB::commit();

            Alert::success('Success', 'Product has been added');
            return to_route('admin.product.index');
        } catch (\Throwable $th) {
            Log::error("Throwable\t: " . $th->getMessage());
            DB::rollBack();

            Alert::error('Ups!', 'Something\'s wrong');
            return to_route('admin.product.index');
        } catch (QueryException $ex) {
            Log::error("Query Exception\t: " . $ex->getMessage());
            DB::rollBack();

            Alert::error('Ups!', 'Something\'s wrong');
            return to_route('admin.product.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            $product->delete();
            // TODO Hapus gambar sebelumnya
            Storage::delete('foto_barang/' . $product->fotobaju_satu);
            Storage::delete('foto_barang/' . $product->fotobaju_dua);
            Storage::delete('foto_barang/' . $product->fotobaju_tiga);
            DB::commit();

            Alert::success('Success', 'Barang has been deleted');
            return to_route('admin.product.index');
        } catch (\Throwable $th) {
            Log::error("Throwable\t: " . $th->getMessage());
            DB::rollBack();

            Alert::error('Ups!', 'Something\'s wrong');
            return to_route('admin.product.index');
        } catch (QueryException $ex) {
            Log::error("Query Exception\t: " . $ex->getMessage());
            DB::rollBack();

            Alert::error('Ups!', 'Something\'s wrong');
            return to_route('admin.product.index');
        }
    }
}
