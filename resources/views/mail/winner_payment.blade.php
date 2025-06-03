<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>You Won the Auction!</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0;">
    <table align="center" width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-top: 40px;">
        <tr>
            <td style="padding: 30px 40px; text-align: center;">
                <h2 style="color: #333333; margin-bottom: 10px;">🎉 Congratulations!</h2>
                <p style="font-size: 16px; color: #555555; line-height: 1.6;">
                    You have won the item: <strong>{{ $item->name }}</strong><br>
                    in the auction: <strong>{{ $auction->title }}</strong>.
                </p>

                <p style="font-size: 16px; color: #555555; margin-top: 20px;">
                    To proceed with your order, please complete the payment using the button below.
                </p>

                <a href="{{ route('checkout.payment', $item->id) }}"
                   style="display: inline-block; margin-top: 25px; padding: 12px 24px; background-color: #007BFF; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: bold;">
                    Complete Payment
                </a>

                <p style="font-size: 14px; color: #999999; margin-top: 30px;">
                    If you have any questions, feel free to contact our support team.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
