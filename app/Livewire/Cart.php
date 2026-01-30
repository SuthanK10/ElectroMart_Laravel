<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Cart extends Component
{
    public $cart = [];
    public $total = 0;
    public $shipping_address = '';


    protected $listeners = ['cart-updated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = Session::get('cart', []);
        $this->calculateTotal();
    }

    public $couponCode = '';
    public $discountAmount = 0;
    public $appliedCoupon = null;

    public function applyCoupon()
    {
        $this->couponCode = strtoupper($this->couponCode);
        $coupon = \App\Models\Coupon::where('code', $this->couponCode)->first();

        if (!$coupon || !$coupon->isValid()) {
            $this->addError('couponCode', 'Invalid or expired coupon code.');
            return;
        }

        $this->appliedCoupon = $coupon;
        $this->calculateTotal();
        session()->flash('success_coupon', 'Coupon applied successfully!');
    }

    public function removeCoupon()
    {
        $this->appliedCoupon = null;
        $this->couponCode = '';
        $this->discountAmount = 0;
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $subtotal = 0;
        foreach ($this->cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        if ($this->appliedCoupon) {
            if ($this->appliedCoupon->type === 'fixed') {
                $this->discountAmount = $this->appliedCoupon->value;
            } else {
                $this->discountAmount = $subtotal * ($this->appliedCoupon->value / 100);
            }
        } else {
            $this->discountAmount = 0;
        }

        $this->total = max(0, $subtotal - $this->discountAmount);
    }

    public function removeItem($productId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            $this->loadCart();
            $this->dispatch('cart-updated');
        }
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->isAdmin()) {
            session()->flash('error', 'Admins are restricted from placing orders.');
            return;
        }

        if (empty($this->cart)) {
            session()->flash('error', 'Your cart is empty.');
            return;
        }

        $this->validate([
            'shipping_address' => 'required|string|max:500',

        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $this->total,
            'discount_amount' => $this->discountAmount,
            'coupon_code' => $this->appliedCoupon ? $this->appliedCoupon->code : null,
            'status' => 'pending',
            'shipping_address' => $this->shipping_address,

        ]);

        foreach ($this->cart as $itemKey => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'] ?? $itemKey, // Handle composite keys by using stored real ID
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        Session::forget('cart');
        $this->cart = [];
        $this->total = 0;
        $this->dispatch('cart-updated');

        \App\Events\OrderPlaced::dispatch($order);

        return redirect()->route('stripe.session', ['order_id' => $order->id]);
    }

    public function render()
    {
        return view('livewire.cart')->layout('layouts.app');
    }
}
