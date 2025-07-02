<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Company Newsletter</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .header {
            background-color: #006EC4;
            padding: 20px;
            text-align: center;
        }

        .header img {
            width: 150px;
            height: auto;
        }

        .content {
            padding: 30px 20px;
            color: #333333;
        }

        .content h1 {
            color: #006EC4;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #006EC4;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .footer {
            background-color: #f1f1f1;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header with logo -->
        <div class="header">
            <img src="https://pseudoteam.com/homepage/home/logo.png" alt="Pseudoteam Logo">
        </div>

        <!-- Content Section -->
        <div class="content">
            <h1>✅ Order Confirmed!</h1>
            <p>Hello {{ $name }},</p>
            <p>
                Thank you for placing your order with <strong>Pseudoteam</strong>! We're excited to get started and
                ensure everything goes smoothly for you.
            </p>
            <p>
                Here are your order details:
                <br><strong>Order No:</strong> [ORDER_ID]
                <br><strong>Order Date:</strong> [ORDER_DATE]
            </p>
            <p>
                Our team will begin processing your order shortly.  
            </p>
            <!-- <a href="[TRACKING_LINK]" class="button">Track Your Order</a> -->
            <p style="margin-top: 20px;">
                If you have any questions or need further assistance, just reply to this email or contact our support
                team.
            </p>
            <p>Thanks again,<br><strong>Pseudoteam</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            © 2025 Pseudoteam. All rights reserved. <br>
            You are receiving this email because you are a valued customer.
        </div>
    </div>
</body>

</html>