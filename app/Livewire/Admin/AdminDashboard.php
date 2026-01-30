<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminDashboard extends Component
{
    use WithPagination;

    public $activeTab = 'stats';
    public $confirmingUserDeletion = false;
    public $userToDeleteId = null;
    public $userToDeleteName = '';

    public function mount()
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->to('/');
        }
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function confirmUserDeletion($userId, $userName)
    {
        $this->userToDeleteId = $userId;
        $this->userToDeleteName = $userName;
        $this->confirmingUserDeletion = true;
    }

    public function cancelUserDeletion()
    {
        $this->confirmingUserDeletion = false;
        $this->userToDeleteId = null;
        $this->userToDeleteName = '';
    }

    public function deleteUser()
    {
        if (!$this->userToDeleteId) return;

        $user = User::findOrFail($this->userToDeleteId);
        
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            session()->flash('error', 'You cannot delete your own admin account.');
            $this->cancelUserDeletion();
            return;
        }

        $user->delete();
        $this->cancelUserDeletion();
        session()->flash('message', 'User and all associated order history have been purged from the system.');
    }

    public function updateOrderStatus($orderId, $status)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => $status]);
        session()->flash('message', "Order #{$orderId} status has been updated to " . strtoupper($status) . ".");
    }

    public function render()
    {
        $stats = [
            'total_sales' => Order::where('status', '!=', 'cancelled')->sum('total_amount'),
            'confirmed_sales' => Order::where('status', 'completed')->sum('total_amount'),
            'total_orders' => Order::count(),
            'total_users' => User::count(),
            'total_products' => Product::count(),
        ];

        $recent_users = User::latest()->take(10)->get();
        $recent_orders = Order::with('user')->latest()->take(10)->get();
        
        // Paginated users for the Users tab
        $users_list = User::latest()->paginate(10);
        
        // Paginated orders for the Transactions tab
        $orders_list = Order::with('user')->latest()->paginate(10);

        return view('livewire.admin.admin-dashboard', [
            'stats' => $stats,
            'recent_users' => $recent_users,
            'recent_orders' => $recent_orders,
            'users_list' => $users_list,
            'orders_list' => $orders_list,
        ])->layout('layouts.app');
    }
}
