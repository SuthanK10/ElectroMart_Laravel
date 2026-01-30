<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductList extends Component
{
    public $limit = null;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $category_id = null;

    public function selectCategory($categoryId = null)
    {
        $this->category_id = $categoryId;
    }

    public function addToCart($productId)
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            session()->flash('error', 'Admins cannot make purchases. This area is for testing UI only.');
            return;
        }

        $cart = Session::get('cart', []);
        
        $product = Product::find($productId);
        if (!$product || $product->stock <= 0) {
            session()->flash('error', 'Product not available.');
            return;
        }

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image_path
            ];
        }

        Session::put('cart', $cart);
        $this->dispatch('cart-updated');
        session()->flash('success', 'Product added to cart!');
    }

    public function render()
    {
        $query = Product::active();
        
        if ($this->search) {
            $query->search($this->search);
        }

        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        if ($this->limit) {
            $query->take($this->limit);
        }

        return view('livewire.product-list', [
            'products' => $query->orderBy('name', 'asc')->get()
        ]);
    }
}
