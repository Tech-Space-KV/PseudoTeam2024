<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Customer Signup - Notification</title>
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

        .details-box {
            background-color: #f9f9f9;
            padding: 15px;
            margin-top: 15px;
            border-left: 4px solid #006EC4;
            font-size: 15px;
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
            <h1>📬 New Customer Registration</h1>
            <p>Hello Team,</p>
            <p>
                A new customer has just signed up on Pseudoteam. Here are the details:
            </p>
            <div class="details-box">
                <strong>Name:</strong> {{ $name }}<br>
                <strong>Email:</strong> {{ $email }}<br>
                <strong>Signup Date:</strong> {{ $date }}
            </div>
            <p style="margin-top: 20px;">
                Please review the account if any verification is required, or simply welcome them onboard.
            </p>
            <p>Best regards,<br><strong>Pseudoteam System</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            © 2025 Pseudoteam. Admin Notification Service.
        </div>
    </div>
</body>

</html>