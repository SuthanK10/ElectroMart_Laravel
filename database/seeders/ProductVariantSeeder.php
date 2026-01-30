<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        // Add variants to iPhone 15 Pro Max
        // Add variants to iPhone 17 Pro Max
        $iphone = Product::where('name', 'iPhone 17 Pro Max')->first();
        if ($iphone) {
            $colors = [
                'Natural Titanium' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&q=80&w=1000',
                'Deep Red' => 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?auto=format&fit=crop&q=80&w=1000',
                'Void Black' => 'https://images.unsplash.com/photo-1696446701796-da61225697cc?auto=format&fit=crop&q=80&w=1000',
                'Frost White' => 'https://images.unsplash.com/photo-1556656793-02f13a514d1d?auto=format&fit=crop&q=80&w=1000'
            ];
            foreach ($colors as $color => $img) {
                ProductVariant::create([
                    'product_id' => $iphone->id,
                    'type' => 'Color',
                    'value' => $color,
                    'stock' => 50,
                    'image_path' => $img
                ]);
            }
            
            $storages = [
                ['512GB', 0],
                ['1TB', 200],
                ['2TB', 500],
            ];
            foreach ($storages as $storage) {
                 ProductVariant::create([
                    'product_id' => $iphone->id,
                    'type' => 'Storage',
                    'value' => $storage[0],
                    'price_modifier' => $storage[1],
                    'stock' => 50,
                ]);
            }
        }

        // Add variants to MacBook Pro
        $macbook = Product::where('name', 'MacBook Pro M5 Max')->first();
        if ($macbook) {
             ProductVariant::create(['product_id' => $macbook->id, 'type' => 'Color', 'value' => 'Space Black', 'stock' => 20]);
             ProductVariant::create(['product_id' => $macbook->id, 'type' => 'Color', 'value' => 'Platinum Silver', 'stock' => 20]);
             
             ProductVariant::create(['product_id' => $macbook->id, 'type' => 'Unified Memory', 'value' => '48GB', 'stock' => 20]);
             ProductVariant::create(['product_id' => $macbook->id, 'type' => 'Unified Memory', 'value' => '128GB', 'price_modifier' => 1000, 'stock' => 20]);
        }

        // Add variants to Samsung S25 Ultra
        $samsung = Product::where('name', 'Samsung Galaxy S25 Ultra')->first();
        if ($samsung) {
            $colors = ['Titanium Gray', 'Titanium Violet', 'Titanium Yellow', 'Titanium Black'];
            foreach ($colors as $color) {
                ProductVariant::create([
                    'product_id' => $samsung->id,
                    'type' => 'Color',
                    'value' => $color,
                    'stock' => 45,
                ]);
            }
            
             ProductVariant::create(['product_id' => $samsung->id, 'type' => 'Storage', 'value' => '512GB', 'stock' => 45]);
             ProductVariant::create(['product_id' => $samsung->id, 'type' => 'Storage', 'value' => '1TB', 'price_modifier' => 250, 'stock' => 45]);
        }
    }
}
