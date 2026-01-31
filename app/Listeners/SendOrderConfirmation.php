<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmation implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    public function handle(OrderPlaced $event): void
    {
        try {
            // Send actual email
            Mail::to($event->order->user->email)->send(new \App\Mail\OrderInvoice($event->order));
            
            Log::info("Order confirmation email sent to user ID: " . $event->order->user_id . " for Order ID: " . $event->order->id);
        } catch (\Exception $e) {
            Log::error("Failed to send order confirmation email: " . $e->getMessage());
        }
    }
}
