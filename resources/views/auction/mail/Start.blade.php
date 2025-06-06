<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Auction Started</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8fafc;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 30px;
        }
        .header {
            font-size: 20px;
            font-weight: bold;
            color: #1a202c;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #4f46e5;
            color: #ffffff !important;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #718096;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">🎉 Auction Has Started!</div>

        <p>Dear {{ $user->name }},</p>

        <p>We are excited to inform you that the auction titled <strong>"{{ $auction->title }}"</strong> has officially started!</p>

        <p>Click the button below to view and participate in the auction:</p>

        <a href="{{ route('auction.participate',$auction->id) }}" class="button">Enter Auction</a>

        <p class="footer">Thank you for being part of our community.<br>— The Art-Express Team</p>
    </div>
</body>
</html>
