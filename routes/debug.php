<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/debug-products', function () {
    return Product::where('category_id', 1)->get();
});
