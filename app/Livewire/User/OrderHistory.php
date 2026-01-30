<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderHistory extends Component
{
    use WithPagination;

    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->to('/login');
        }
    }

    public function render()
    {
        $orders = Order::ofUser(auth()->id())
            ->with(['items.product'])
            ->latest()
            ->paginate(5);

        return view('livewire.user.order-history', [
            'orders' => $orders,
        ])->layout('layouts.app');
    }
}
