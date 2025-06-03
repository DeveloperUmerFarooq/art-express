<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Cancelled</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f6f6f6; padding: 30px; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #fff; border-radius: 6px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <tr>
            <td style="padding: 20px 30px;">
                <h2 style="color: #dc3545; margin-top: 0;">Order Cancelled</h2>

                <h3 style="margin: 10px 0;">Order #{{ $order->id }} has been cancelled.</h3>

                <p>We regret to inform you that your order has been cancelled.</p>

                <p>If you believe this was a mistake or if you have any questions, please feel free to contact our support team.</p>

                <p style="margin-top: 30px;">We apologize for the inconvenience.</p>

                <p style="margin-top: 30px;">Best regards,<br>
                <strong>Art-Express</strong></p>
            </td>
        </tr>
    </table>
</body>
</html>
