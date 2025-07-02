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
            <h1>📨 Your Support Ticket Has Been Raised</h1>
            <p>Hello {{ $name }},</p>
            <p>
                We’ve received your request and created a support ticket with the following details:
            </p>
            <p>
                <strong>Ticket ID:</strong> {{ $ticketId }}<br>
                <strong>Submitted On:</strong> {{ date('Y-m-d H:i:s') }}
            </p>
            <p>
                Our support team is reviewing your query and will get back to you within 24 hours. Rest assured, we’re
                on it!
            </p>
            <!-- <p>
                You can track the status, add more information, or communicate with our team anytime using the button
                below:
            </p>
            <a href="[TICKET_LINK]" class="button">View My Ticket</a> -->
            <p style="margin-top: 20px;">
                Thank you for reaching out to <strong>Pseudoteam</strong>. We’re committed to resolving your issue as
                quickly as possible.
            </p>
            <p>Best regards,<br><strong>Pseudoteam</strong></p>
        </div>


        <!-- Footer -->
        <div class="footer">
            © 2025 Pseudoteam. All rights reserved. <br>
            You are receiving this email because you are a valued customer.
        </div>
    </div>
</body>

</html>