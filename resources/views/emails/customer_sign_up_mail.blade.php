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
            <h1>🎉 Welcome to Pseudoteam!</h1>
            <p>Hello {{ $name }},</p>
            <p>
                We're thrilled to have you on board! Your account has been successfully created, and you're now part of
                a growing community that believes in getting projects done the right way.
            </p>
            <p>
                Here’s what you can do next:
            <ul>
                <li>🚀 Start a new project</li>
                <li>📊 Track your ongoing projects</li>
                <li>💬 Connect directly with our team</li>
            </ul>
            </p>
            <a href="{{ $verificationLink }}" class="button" style="color: white; text-decoration: none;">Complete Verification</a>
            <p style="margin-top: 20px;">
                If you have any questions or need help getting started, feel free to reach out—we're always here to
                help.
            </p>
            <p>Cheers,<br><strong>Pseudoteam</strong></p>
        </div>


        <!-- Footer -->
        <div class="footer">
            © 2025 Pseudoteam. All rights reserved. <br>
            You are receiving this email because you are a valued customer.
        </div>
    </div>
</body>

</html>