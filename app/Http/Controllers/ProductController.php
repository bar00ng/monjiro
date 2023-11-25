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
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $relatedProducts = \App\Models\Product::where('kategori', $product->kategori)
            ->where('id', '<>', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('pages.products.show-product', [
            'product' => $product,
            'title' => $product->nama,
            'relatedProducts' => $relatedProducts
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
