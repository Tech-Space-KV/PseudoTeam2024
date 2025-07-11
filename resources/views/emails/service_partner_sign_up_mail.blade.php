<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome to Pseudoteam - Service Partner</title>
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
            <h1>👷‍♂️ Welcome to Pseudoteam, Partner!</h1>
            <p>Hello {{ $name }},</p>
            <p>
                We're excited to have you join Pseudoteam as a Service Partner! Your account has been successfully created, and you're now part of a growing network of professionals helping businesses succeed.
            </p>
            <p>As a verified partner, you’ll be able to:</p>
            <ul>
                <li>⚙️ Get matched with client service requests</li>
                <li>📈 Manage your profile and skill set</li>
                <li>📅 Track assigned projects and timelines</li>
                <li>💬 Communicate directly with clients and admins</li>
            </ul>
            <a href="{{ $verificationLink }}" class="button">Verify Your Account</a>
            <p style="margin-top: 20px;">
                If you need help completing your profile or verifying your skills, feel free to reach out. We're always here to assist.
            </p>
            <p>Let’s build something great together!<br><strong>— Pseudoteam Support</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            © 2025 Pseudoteam. All rights reserved. <br>
            You are receiving this email as a registered Service Partner.
        </div>
    </div>
</body>

</html>