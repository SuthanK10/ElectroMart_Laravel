<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'discount_amount',
        'coupon_code',
        'status',
        'shipping_address',

    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    // --- Accessors ---
    public function getFormattedAmountAttribute(): string
    {
        return '$' . number_format($this->total_amount, 2);
    }

    public function getStatusLabelAttribute(): string
    {
        return ucfirst($this->status);
    }

    // --- Scopes ---
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeOfUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // --- Relationships ---
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
