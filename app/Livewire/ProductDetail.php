<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class ProductDetail extends Component
{
    public \App\Models\Product $product;

    public $isWishlisted = false;

    public $selectedVariants = [];
    public $variantPrice = 0;
    public $availableVariants = [];

    public $currentImage;

    public function mount($slug)
    {
        $this->product = Product::with('variants')->where('slug', $slug)->firstOrFail();
        $this->currentImage = $this->product->image_path; // Default image
        $this->checkWishlist();
        
        // Group variants by type for the UI
        $this->availableVariants = $this->product->variants->groupBy('type')->toArray();
        
        // Auto-select first options if available to simplify UX
         foreach ($this->availableVariants as $type => $variants) {
            if (count($variants) > 0) {
                $this->selectVariant($type, $variants[0]['id']);
            }
        }
    }

    public function selectVariant($type, $variantId)
    {
        $variant = $this->product->variants->find($variantId);
        if ($variant) {
            $this->selectedVariants[$type] = [
                'id' => $variant->id,
                'value' => $variant->value,
                'price_modifier' => $variant->price_modifier
            ];
            $this->calculateVariantPrice();

            // Feature: Switch Image on Variant Change
            if ($variant->image_path) {
                $this->currentImage = $variant->image_path;
            }
        }
    }

    public function calculateVariantPrice()
    {
        $this->variantPrice = 0;
        foreach ($this->selectedVariants as $variant) {
            $this->variantPrice += $variant['price_modifier'];
        }
    }

    public function getTotalPriceProperty()
    {
        return $this->product->price + $this->variantPrice;
    }

    public function checkWishlist()
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            $this->isWishlisted = \App\Models\Wishlist::where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->where('product_id', $this->product->id)
                ->exists();
        }
    }

    public function toggleWishlist()
    {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('login');
        }

        $user = \Illuminate\Support\Facades\Auth::user();

        if ($this->isWishlisted) {
            \App\Models\Wishlist::where('user_id', $user->id)
                ->where('product_id', $this->product->id)
                ->delete();
            $this->isWishlisted = false;
        } else {
            \App\Models\Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $this->product->id
            ]);
            $this->isWishlisted = true;
        }
    }

    public function addToCart()
    {
        if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->isAdmin()) {
            session()->flash('error', 'Admins cannot make purchases. This area is for testing UI only.');
            return;
        }

        // Validate that all types are selected
        foreach ($this->availableVariants as $type => $variants) {
            if (!isset($this->selectedVariants[$type])) {
                session()->flash('error', "Please select a $type.");
                return;
            }
        }

        $cart = Session::get('cart', []);
        
        // Generate a unique ID for this specific combination
        $cartKey = $this->product->id;
        if (!empty($this->selectedVariants)) {
            $variantIds = array_column($this->selectedVariants, 'id');
            sort($variantIds);
            $cartKey .= '-' . implode('-', $variantIds);
        }

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                "product_id" => $this->product->id, // Store real ID for DB
                "name" => $this->product->name,
                "quantity" => 1,
                "price" => $this->getTotalPriceProperty(),
                "image" => $this->product->image_path,
                "variants" => $this->selectedVariants
            ];
        }

        Session::put('cart', $cart);
        $this->dispatch('cart-updated');
        session()->flash('success', 'Added to cart!');
    }

    public function render()
    {
        return view('livewire.product-detail')->layout('layouts.app');
    }
}
