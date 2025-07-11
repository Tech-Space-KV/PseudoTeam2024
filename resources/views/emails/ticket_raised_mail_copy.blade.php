<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Support Ticket Alert</title>
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
            <h1>📥 New Support Ticket Submitted</h1>
            <p>Hello Team,</p>
            <p>
                A new support ticket has been raised by a customer. Please review the details below and take appropriate action.
            </p>
            <div class="details-box">
                <strong>Ticket ID:</strong> {{ $ticketId }}<br>
                <strong>Submitted By:</strong> {{ $name }}<br>
                <strong>Email:</strong> {{ $email }}<br>
                <strong>Issue:</strong> {{ $title }}<br>
                <strong>Message:</strong> {{ $description }}<br>
                <strong>Submitted On:</strong> {{ date('Y-m-d H:i:s') }}
            </div>
            <p style="margin-top: 20px;">
                Please assign this ticket to a support representative and initiate a response within 24 hours.
            </p>
            <p>Best,<br><strong>Pseudoteam System</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            © 2025 Pseudoteam. Internal Notification. <br>
            This is an automated email for internal support tracking.
        </div>
    </div>
</body>

</html>
