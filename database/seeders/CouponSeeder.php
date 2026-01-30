<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::create([
            'code' => 'WELCOME10',
            'type' => 'percent',
            'value' => 10,
            'is_active' => true,
        ]);

        Coupon::create([
            'code' => 'FLAT50',
            'type' => 'fixed',
            'value' => 50,
            'is_active' => true,
        ]);
    }
}
