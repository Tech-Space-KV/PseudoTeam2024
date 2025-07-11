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
            <h1>🛠️ We're Here to Help!</h1>
            <p>Hello {{ $name }},</p>
            <p>
                Thank you for contacting <strong>Pseudoteam Support</strong>. We've received your request and our team
                is already working on it.
            </p>
            <!-- <p>
                <strong>Support Ticket ID:</strong> [TICKET_ID]<br>
                <strong>Submitted On:</strong> [DATE_TIME]
            </p> -->
            <p>
                One of our support agents will get back to you within the next 24 hours. We aim to resolve your issue as
                quickly and efficiently as possible.
            </p>
            <p>
                In the meantime, you can check the status of your request or provide additional details using the link
                below:
            </p>
            <a href="[TICKET_LINK]" class="button">View My Support Ticket</a>
            <p style="margin-top: 20px;">
                If your issue is urgent, feel free to reply directly to this email for priority handling.
            </p>
            <p>Warm regards,<br><strong>The Pseudoteam Support Team</strong></p>
        </div>


        <!-- Footer -->
        <div class="footer">
            © 2025 Pseudoteam. All rights reserved. <br>
            You are receiving this email because you are a valued customer.
        </div>
    </div>
</body>

</html>