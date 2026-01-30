<x-mail::message>
# Order Confirmation

Hello {{ $order->user->name }},

Thank you for choosing **ElectroMart**. Your order has been successfully processed and finalized. Below is a summary of your premium gear acquisition.

<x-mail::table>
| Item | Qty | Price | Subtotal |
| :--- | :---: | :---: | :--- |
@foreach($order->items as $item)
| {{ $item->product->name }} | {{ $item->quantity }} | ${{ number_format($item->price, 2) }} | ${{ number_format($item->price * $item->quantity, 2) }} |
@endforeach
| **Total** | | | **${{ number_format($order->total_amount, 2) }}** |
</x-mail::table>

**Shipping Address:**  
{{ $order->shipping_address }}

**Contact Number:**  
{{ $order->contact_number }}

If you have any questions regarding your order, please do not hesitate to contact our support team.

Stay ahead with the latest tech,  
**The ElectroMart Team**

<x-mail::button :url="config('app.url') . '/orders'">
View Order History
</x-mail::button>

</x-mail::message>
