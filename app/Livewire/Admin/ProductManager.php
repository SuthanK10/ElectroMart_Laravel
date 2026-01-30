<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ProductManager extends Component
{
    use WithFileUploads;

    public $products;
    public $categories;
    
    public $name, $slug, $description, $price, $stock, $category_id, $image, $product_id;
    public $manual_image_url; 

    public $isEdit = false;
    public $showModal = false;

    public $variants = [];

    public function mount()
    {
        $this->categories = Category::all();
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $this->products = Product::with('category')->latest()->get();
    }

    public function resetFields()
    {
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->price = '';
        $this->stock = '';
        $this->category_id = '';
        $this->image = null;
        $this->manual_image_url = ''; 
        $this->product_id = null;
        $this->isEdit = false;
        $this->variants = [];
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function addVariant()
    {
        $this->variants[] = [
            'id' => null,
            'type' => 'Color',
            'value' => '',
            'price_modifier' => 0,
            'stock' => 10,
            'image_path' => null,
            'manual_image_url' => null, // Add manual URL support
            'new_image' => null,
        ];
    }

    public function removeVariant($index)
    {
        $variant = $this->variants[$index];
        if (!empty($variant['id'])) {
            \App\Models\ProductVariant::destroy($variant['id']);
        }
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
    }

    public function edit($id)
    {
        $product = Product::with('variants')->findOrFail($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
        $this->manual_image_url = $product->image_path; 
        
        $this->variants = $product->variants->map(function($v) {
            return [
                'id' => $v->id,
                'type' => $v->type,
                'value' => $v->value,
                'price_modifier' => $v->price_modifier,
                'stock' => $v->stock,
                'image_path' => $v->image_path,
                'manual_image_url' => $v->image_path, // Pre-fill
                'new_image' => null,
            ];
        })->toArray();
        
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => $this->isEdit ? 'nullable|image|max:10240' : ($this->manual_image_url ? 'nullable' : 'required|image|max:10240'),
            'manual_image_url' => 'nullable|url',
            'variants.*.type' => 'required|string',
            'variants.*.value' => 'required|string',
            'variants.*.stock' => 'required|integer',
            'variants.*.manual_image_url' => 'nullable|url', // Validate variant URL
        ]);

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
        ];

        if ($this->image) {
            $data['image_path'] = $this->image->store('products');
        } elseif ($this->manual_image_url) {
            $data['image_path'] = $this->manual_image_url;
        }

        $product = null;
        if ($this->isEdit) {
            $product = Product::find($this->product_id);
            $product->update($data);
            session()->flash('message', 'Product updated successfully.');
        } else {
            $product = Product::create($data);
            session()->flash('message', 'Product created successfully.');
        }

        // Process Variants
        foreach ($this->variants as $index => $variantData) {
            $variantAttributes = [
                'product_id' => $product->id,
                'type' => $variantData['type'],
                'value' => $variantData['value'],
                'price_modifier' => $variantData['price_modifier'] ?? 0,
                'stock' => $variantData['stock'] ?? 0,
            ];

            // Handle Image Upload
            if (isset($variantData['new_image']) && $variantData['new_image']) {
                $variantAttributes['image_path'] = $variantData['new_image']->store('variants');
            } elseif (isset($variantData['manual_image_url']) && !empty($variantData['manual_image_url'])) { // Check manual URL
                $variantAttributes['image_path'] = $variantData['manual_image_url'];
            } elseif (isset($variantData['image_path'])) {
                 $variantAttributes['image_path'] = $variantData['image_path'];
            }

            if (!empty($variantData['id'])) {
                \App\Models\ProductVariant::where('id', $variantData['id'])->update($variantAttributes);
            } else {
                \App\Models\ProductVariant::create($variantAttributes);
            }
        }

        $this->loadProducts();
        $this->closeModal();
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        $this->loadProducts();
        session()->flash('message', 'Product deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.product-manager')->layout('layouts.app');
    }
}
