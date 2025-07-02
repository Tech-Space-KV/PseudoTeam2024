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
            <h1>📩 We've Received Your Query</h1>
            <p>Hello {{ $data['firstName'] }},</p>
            <p>
                Thank you for reaching out to <strong>Pseudoteam</strong>. We’ve received your query and our support
                team is already looking into it.
            </p>
            <p>
                <strong>Query Reference ID:</strong> {{ $data['queryRefId'] }}<br>
                <strong>Submitted On:</strong> {{ date('Y-m-d H:i:s') }}
            </p>
            <p>
                One of our team members will get back to you within 24 hours. In the meantime, feel free to check your
                dashboard for updates or reply to this email if you have more details to share.
            </p>
            <a href="https://pseudoteam.com/" class="button">Go to My Dashboard</a>
            <p style="margin-top: 20px;">
                We appreciate your patience and will do our best to resolve your query as quickly as possible.
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