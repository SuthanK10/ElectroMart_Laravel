<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RealProductSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing products and categories if needed, or just add
        $categories = [
            'Laptops' => 'High-performance computing for professionals.',
            'Smartphones' => 'Next-generation mobile technology.',
            'Audio' => 'Immersive sound experiences.',
            'Wearables' => 'Smart technology on your wrist.',
            'Gaming' => 'Next-level entertainment consoles.',
        ];

        $catModels = [];
        foreach ($categories as $name => $desc) {
            $catModels[$name] = Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => $desc]
            );
        }

        $products = [
            [
                'category' => 'Laptops',
                'name' => 'MacBook Pro M5 Max',
                'description' => 'The absolute pinnacle of portable computing. Powered by the M5 Max chip with 40-core GPU, 128GB Unified Memory, and a stunning 16-inch Liquid Retina XDR Nano-texture display. Designed for pros who push boundaries.',
                'price' => 3999.00,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1531297461136-82lw9f2a031e?auto=format&fit=crop&q=80&w=1000'
            ],
            [
                'category' => 'Laptops',
                'name' => 'Dell XPS 17 Infinity',
                'description' => 'Experience the future with a bezel-less 8K OLED display. Powered by Intel Core Ultra 9 and NVIDIA RTX 6090 Ti. It is not just a laptop; it is a creative studio.',
                'price' => 2899.00,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?auto=format&fit=crop&q=80&w=1000'
            ],
            [
                'category' => 'Smartphones',
                'name' => 'iPhone 17 Ultra',
                'description' => 'Forged in Titanium. Featuring the revolutionary A19 Bionic chip, a quad-lens 108MP camera system, and all-day battery life that actually lasts all day. The best iPhone we have ever created.',
                'price' => 1599.00,
                'stock' => 50,
                'image' => 'https://images.unsplash.com/photo-1696446701796-da61225697cc?auto=format&fit=crop&q=80&w=1000'
            ],
            [
                'category' => 'Smartphones',
                'name' => 'Samsung Galaxy S25 Ultra',
                'description' => 'The AI Phone. Integrated with Gemini Ultra for real-time translation and content creation. Features a 200MP Space Zoom camera and the S-Pen Fold Edition.',
                'price' => 1499.00,
                'stock' => 45,
                'image' => 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?auto=format&fit=crop&q=80&w=1000'
            ],
            [
                'category' => 'Audio',
                'name' => 'Sony WH-1000XM6',
                'description' => 'Silence, perfected. Our new V2 Noise Cancelling Processor blocks out even more mid-high frequency sound. Crystal clear calls, 40-hour battery, and feather-light comfort.',
                'price' => 449.00,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?auto=format&fit=crop&q=80&w=1000'
            ],
            [
                'category' => 'Audio',
                'name' => 'AirPods Max 2',
                'description' => 'High-fidelity audio like never before. Now with USB-C, Lossless Audio support, and a lighter, more breathable mesh headband in 5 stunning new colors.',
                'price' => 549.00,
                'stock' => 80,
                'image' => 'https://images.unsplash.com/photo-1613040996318-97554dc41aef?auto=format&fit=crop&q=80&w=1000'
            ],
            [
                'category' => 'Wearables',
                'name' => 'Apple Watch Ultra 4',
                'description' => 'The ultimate sports watch. Now with micro-LED display, 7-day battery life, and non-invasive blood glucose monitoring. Rugged, capable, and built for the extreme.',
                'price' => 899.00,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1695663738090-e32569e35824?auto=format&fit=crop&q=80&w=1000'
            ],
            [
                'category' => 'Wearables',
                'name' => 'Vision Pro 2',
                'description' => 'Spatial Computing, refined. 30% lighter, 2x faster, and with a wider field of view. Seamlessly blend digital content with your physical space.',
                'price' => 2499.00,
                'stock' => 10,
                'image' => 'https://images.unsplash.com/photo-1629420005479-7c2c9d2c2084?auto=format&fit=crop&q=80&w=1000'
            ]
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(
                ['slug' => Str::slug($p['name'])],
                [
                    'category_id' => $catModels[$p['category']]->id,
                    'name' => $p['name'],
                    'description' => $p['description'],
                    'price' => $p['price'],
                    'stock' => $p['stock'],
                    'image_path' => $p['image'],
                    'is_active' => true,
                ]
            );
        }
    }
}
