<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f6f6f6; padding: 30px; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #fff; border-radius: 6px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <tr>
            <td style="padding: 20px 30px;">
                <h2 style="margin-top: 0; color: #28a745;">Order Confirmation</h2>

                <p>Dear <strong>{{ $name }}</strong>,</p>

                <p>Thank you for your order! Your order has been successfully placed.</p>

                <p>
                    <strong>Order ID:</strong> #{{ $order->id }}<br>
                    <strong>Customer Name:</strong> {{ $order->customer->name }}<br>
                    <strong>Total Amount:</strong> Rs {{ number_format($order->items->sum('total_price')) }}
                </p>

                <p>We will notify you once your order is processed and ready for delivery.</p>

                <p style="margin-top: 30px;">Regards,<br>
                <strong>Art-Express</strong></p>
            </td>
        </tr>
    </table>
</body>
</html>
