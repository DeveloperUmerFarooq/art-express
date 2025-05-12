<h2>Order Confirmation</h2>
<p>Dear {{ $name }},</p>
<p>An order (#{{ $order->id }}) for {{$order->customer->name}} has been successfully placed.</p>
<p>Total Amount: Rs {{ $order->items->sum('total_price') }}</p>
