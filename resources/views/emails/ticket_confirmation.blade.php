<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        .content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
        }
        .details {
            margin: 20px 0;
        }
        .details p {
            font-size: 16px;
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            font-size: 14px;
            color: #868e96;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="header">
                <h1>Ticket Purchase Confirmation</h1>
            </div>
            <div class="details">
                <p>Thank you for purchasing tickets for the event: <strong>{{ $ticket['title'] }}</strong>.</p>
                <p><strong>Ticket Type:</strong> {{ $ticket['name'] }}</p>
                <p><strong>Quantity:</strong> {{ $ticket['quantity'] }}</p>
            </div>
            <div class="footer">
                <p>We look forward to seeing you there!</p>
                <p>Thanks,<br>{{ config('app.name') }}</p>
            </div>
        </div>
    </div>
</body>
</html>
