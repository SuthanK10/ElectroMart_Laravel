<?php

namespace App\Livewire\User;

use App\Models\Order;
use App\Mail\OrderInvoice;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class OrderSuccess extends Component
{
    public $order;
    public $mailSent = false;

    public function mount($order_id)
    {
        $this->order = Order::with(['items.product', 'user'])->findOrFail($order_id);
        
        if ($this->order->user_id !== auth()->id()) {
            abort(403);
        }
    }

    public function sendInvoice()
    {
        Mail::to($this->order->user->email)->send(new OrderInvoice($this->order));
        $this->mailSent = true;
        session()->flash('success', 'Professional invoice has been dispatched to your email.');
    }

    public function render()
    {
        return view('livewire.user.order-success')->layout('layouts.app');
    }
}
