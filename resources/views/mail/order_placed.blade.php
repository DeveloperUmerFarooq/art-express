<h2>Order Confirmation</h2>
<p>Dear {{ $order->user->name }},</p>
<p>Your order (#{{ $order->id }}) has been successfully placed.</p>
<p>Total Amount: Rs {{ $order->items->sum('total_price') }}</p>
