<?php

namespace App\Livewire\Product;

use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('All Products')]
class ListProduct extends Component
{
    use WithPagination;

    public $search;

    public $category;

    public $sortBy;

    public function mount($category = null)
    {
        $this->category = $category;
    }

    public function render()
    {
        $productsQuery = \App\Models\Product::query();

        if ($this->category) {
            $productsQuery->where('kategori', $this->category);
        }

        if ($this->sortBy) {
            [$column, $direction] = explode(', ', $this->sortBy);
            $productsQuery->orderBy($column, $direction);
        }

        $products = $productsQuery->where('nama', 'like', '%' . $this->search . '%')->paginate(8);

        return view('livewire.product.list-product', [
            'products' => $products
        ])
            ->extends('layout.app')
            ->section('content');
    }
}
