<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function session(Request $request)
    {
        $orderId = $request->get('order_id');
        $order = Order::with('items.product')->findOrFail($orderId);

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        foreach ($order->items as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => $item->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('stripe.success', ['order_id' => $order->id]),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect()->away($session->url);
    }

    public function success(Request $request)
    {
        $orderId = $request->get('order_id');
        $order = Order::findOrFail($orderId);

        if ($order->status !== 'completed') {
            $order->update(['status' => 'completed']);
        }

        return redirect()->route('order.success', $order->id);
    }

    public function cancel()
    {
        return redirect()->route('cart')->with('error', 'Payment was cancelled.');
    }
}
