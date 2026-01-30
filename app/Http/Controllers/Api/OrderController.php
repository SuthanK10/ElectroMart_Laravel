<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::ofUser(Auth::id())->with('items.product')->get();
        return OrderResource::collection($orders);
    }

    public function show($id)
    {
        $order = Order::with('items.product')->find($id);
        
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($order->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return new OrderResource($order);
    }
}
