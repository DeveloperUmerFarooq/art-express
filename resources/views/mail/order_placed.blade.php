<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f6f6f6; margin: 0; padding: 20px; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 6px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <tr>
            <td style="padding: 30px;">
                <h2 style="color: #28a745; margin-top: 0;">Order Placed Successfully</h2>

                <p style="font-size: 16px;">Hello <strong>{{ $name }}</strong>,</p>

                <p style="font-size: 15px;">
                    This is to inform you that a new order has been successfully placed through <strong>Art-Express</strong>.
                </p>

                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 20px; font-size: 15px;">
                    <tr>
                        <td style="padding: 8px 0;"><strong>Order ID:</strong></td>
                        <td style="padding: 8px 0;">#{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Customer Name:</strong></td>
                        <td style="padding: 8px 0;">{{ $order->customer->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Total Amount:</strong></td>
                        <td style="padding: 8px 0;">Rs {{ number_format($order->items->sum('total_price')) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Payment Method:</strong></td>
                        <td style="padding: 8px 0;">{{ $order->payment_status=="Payed"?"Card":"Cash on Delivery"}}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Shipping Address:</strong></td>
                        <td style="padding: 8px 0;">{{ $order->user_address }}</td>
                    </tr>
                </table>
                <hr style="margin: 30px 0; border: none; border-top: 1px solid #eee;">

                <p style="font-size: 14px; color: #777;">
                    If you have any questions or need support, feel free to contact us.
                </p>

                <p style="font-size: 14px; margin-top: 30px;">Best regards,<br>
                <strong>Art-Express Team</strong></p>
            </td>
        </tr>
    </table>
</body>
</html>
