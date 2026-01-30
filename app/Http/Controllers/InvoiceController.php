<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show($orderId)
    {
        $order = \App\Models\Order::with('items.product', 'user')->findOrFail($orderId);

        if ($order->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoices.order', compact('order'));
        return $pdf->stream('invoice-'.$order->id.'.pdf');
    }
}
