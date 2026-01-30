<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'name' => 'Antigravity Admin',
            'email' => 'admin@electromart.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        // Regular User
        User::factory()->create([
            'name' => 'Demo Customer',
            'email' => 'user@electromart.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'customer',
        ]);

        // Categories
        $categories = [
            ['name' => 'Laptops', 'slug' => 'laptops', 'description' => 'Uncompromising power and portability.'],
            ['name' => 'Audio', 'slug' => 'audio', 'description' => 'Immersive sound experiences.'],
            ['name' => 'Smartphones', 'slug' => 'smartphones', 'description' => 'Next-gen connectivity.'],
            ['name' => 'Cameras', 'slug' => 'cameras', 'description' => 'Capture life in high definition.'],
        ];

        $productData = [
            'Laptops' => [
                ['name' => 'MacBook Pro M3 Max', 'price' => 3499, 'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&q=80&w=800'],
                ['name' => 'Razer Blade 16', 'price' => 2999, 'image' => 'https://images.unsplash.com/photo-1593642702821-c8da6771f0c6?auto=format&fit=crop&q=80&w=800'],
                ['name' => 'Dell XPS 15', 'price' => 1899, 'image' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?auto=format&fit=crop&q=80&w=800'],
            ],
            'Audio' => [
                ['name' => 'Sony WH-1000XM5', 'price' => 399, 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&q=80&w=800'],
                ['name' => 'AirPods Max', 'price' => 549, 'image' => 'https://images.unsplash.com/photo-1613040809024-b4ef7ba99bc3?auto=format&fit=crop&q=80&w=800'],
                ['name' => 'Bose QuietComfort', 'price' => 329, 'image' => 'https://images.unsplash.com/photo-1546435770-a3e4265da3ec?auto=format&fit=crop&q=80&w=800'],
            ],
            'Smartphones' => [
                ['name' => 'iPhone 15 Pro', 'price' => 999, 'image' => 'https://images.unsplash.com/photo-1696446701796-da61225697cc?auto=format&fit=crop&q=80&w=800'],
                ['name' => 'Samsung S24 Ultra', 'price' => 1299, 'image' => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?auto=format&fit=crop&q=80&w=800'],
            ],
            'Cameras' => [
                ['name' => 'Sony A7 IV', 'price' => 2499, 'image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&q=80&w=800'],
                ['name' => 'Fujifilm X-T5', 'price' => 1699, 'image' => 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?auto=format&fit=crop&q=80&w=800'],
            ]
        ];

        foreach ($categories as $cat) {
            $category = \App\Models\Category::create($cat);

            foreach ($productData[$cat['name']] as $prod) {
                \App\Models\Product::create([
                    'category_id' => $category->id,
                    'name' => $prod['name'],
                    'slug' => \Illuminate\Support\Str::slug($prod['name']),
                    'description' => 'The ultimate ' . $prod['name'] . ' for professional creators and tech enthusiasts. Featuring industry-leading performance and stunning design.',
                    'price' => $prod['price'],
                    'stock' => rand(5, 20),
                    'image_path' => $prod['image'], // Using external URL for demo
                    'is_active' => true,
                ]);
            }
        }
    }
}
