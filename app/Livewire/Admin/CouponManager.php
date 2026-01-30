<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class CouponManager extends Component
{
    public $coupons;
    public $showingModal = false;

    // Form fields
    public $code = '';
    public $type = 'percent';
    public $value = '';
    public $is_active = true;
    public $is_featured = false;

    protected $rules = [
        'code' => 'required|min:3|unique:coupons,code',
        'type' => 'required|in:fixed,percent',
        'value' => 'required|numeric|min:1',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function mount()
    {
        $this->loadCoupons();
    }

    public function loadCoupons()
    {
        $this->coupons = \App\Models\Coupon::latest()->get();
    }

    public function saveCoupon()
    {
        $this->validate();

        \App\Models\Coupon::create([
            'code' => strtoupper($this->code),
            'type' => $this->type,
            'value' => $this->value,
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
        ]);

        $this->showingModal = false;
        $this->resetForm();
        $this->loadCoupons();
    }

    public function toggleStatus($id)
    {
        $coupon = \App\Models\Coupon::find($id);
        if ($coupon) {
            $coupon->update(['is_active' => !$coupon->is_active]);
            $this->loadCoupons();
        }
    }

    public function deleteCoupon($id)
    {
        \App\Models\Coupon::destroy($id);
        $this->loadCoupons();
    }

    private function resetForm()
    {
        $this->reset(['code', 'type', 'value', 'is_active', 'is_featured']);
        $this->type = 'percent';
        $this->is_active = true;
        $this->is_featured = false;
    }

    public function render()
    {
        return view('livewire.admin.coupon-manager')->layout('layouts.app');
    }
}
