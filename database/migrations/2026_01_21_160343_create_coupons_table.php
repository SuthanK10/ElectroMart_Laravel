<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Check if table exists to avoid errors on re-runs during dev
        if (!Schema::hasTable('coupons')) {
            Schema::create('coupons', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('type'); // 'fixed' or 'percent'
                $table->decimal('value', 10, 2);
                $table->boolean('is_active')->default(true);
                $table->boolean('is_featured')->default(false); // New field for Home Page visibility
                $table->timestamp('expiry_date')->nullable();
                $table->timestamps();
            });
        }
        
        // Ensure orders table has coupon columns (idempotent check)
        if (Schema::hasTable('orders') && !Schema::hasColumn('orders', 'discount_amount')) {
             Schema::table('orders', function (Blueprint $table) {
                $table->decimal('discount_amount', 10, 2)->default(0)->after('total_amount');
                $table->string('coupon_code')->nullable()->after('discount_amount');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
        if (Schema::hasColumn('orders', 'discount_amount')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn(['discount_amount', 'coupon_code']);
            });
        }
    }
};
