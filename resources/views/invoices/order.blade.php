<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; padding: 40px; color: #333; }
        .header { margin-bottom: 40px; border-bottom: 2px solid #eee; padding-bottom: 20px; }
        .logo { font-size: 24px; font-weight: bold; color: #2563eb; text-transform: uppercase; letter-spacing: 2px; }
        .invoice-details { float: right; text-align: right; }
        .invoice-title { font-size: 32px; font-weight: bold; color: #1e293b; margin: 0; }
        .meta { color: #64748b; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin-top: 5px; }
        .addresses { margin-bottom: 40px; display: table; width: 100%; }
        .address-box { display: table-cell; vertical-align: top; width: 50%; }
        .address-title { font-size: 10px; font-weight: bold; text-transform: uppercase; color: #94a3b8; letter-spacing: 1px; margin-bottom: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        .table th { text-align: left; padding: 15px; background: #f8fafc; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: #475569; font-weight: bold; border-bottom: 2px solid #e2e8f0; }
        .table td { padding: 15px; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        .totals { float: right; width: 300px; }
        .total-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; }
        .total-row.final { border-bottom: none; font-size: 18px; font-weight: bold; color: #0f172a; margin-top: 10px; }
        .footer { margin-top: 80px; text-align: center; color: #94a3b8; font-size: 12px; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="invoice-details">
            <h1 class="invoice-title">INVOICE</h1>
            <div class="meta">#{{ $order->id }}</div>
            <div class="meta">{{ $order->created_at->format('F d, Y') }}</div>
        </div>
        <div class="logo">ElectroMart</div>
    </div>

    <div class="addresses">
        <div class="address-box">
            <div class="address-title">Bill To</div>
            <strong>{{ $order->user->name }}</strong><br>
            {{ $order->user->email }}<br>
            {{ $order->contact_number }}
        </div>
        <div class="address-box">
            <div class="address-title">Ship To</div>
            {{ $order->shipping_address }}
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product->name }}</strong>
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td style="text-align: right;">${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <div class="total-row">
            <span>Subtotal:</span>
            <span>${{ number_format($order->total_amount + $order->discount_amount, 2) }}</span>
        </div>
        @if($order->discount_amount > 0)
            <div class="total-row" style="color: #10b981;">
                <span>Discount ({{ $order->coupon_code }}):</span>
                <span>-${{ number_format($order->discount_amount, 2) }}</span>
            </div>
        @endif
        <div class="total-row">
            <span>Shipping:</span>
            <span>Free</span>
        </div>
        <div class="total-row final">
            <span>Total:</span>
            <span>${{ number_format($order->total_amount, 2) }}</span>
        </div>
    </div>

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>ElectroMart Inc. • 123 Tech Avenue, Silicon Valley, CA</p>
    </div>
</body>
</html>
