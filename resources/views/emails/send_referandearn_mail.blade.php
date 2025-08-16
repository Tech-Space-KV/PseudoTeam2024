<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>You’ve Been Invited to Pseudoteam</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .header {
            background-color: #ffffffff;
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
        <!-- Header -->
        <div class="header">
            <img src="https://pseudoteam.com/homepage/home/logo.png" alt="Pseudoteam Logo">
        </div>

        <!-- Content -->
        <div class="content">
            <h1>👋 You’ve Been Invited!</h1>
            <p>Hello,</p>
            <p>
                Your friend <strong>{{ $referrerName }}</strong> thinks you'll love working with
                <strong>Pseudoteam</strong> — a platform where clients and service providers collaborate on real
                projects seamlessly.
            </p>
            <p>
                Use this referral code while signing up: <strong>{{ $referralCode }}</strong>
            </p>
            <a href="{{ $link }}" class="button">Join Pseudoteam Now</a>
            <p style="margin-top: 20px;">
                We’re excited to have you on board. Start your first project or explore services today!
            </p>
            <p>Warm regards,<br><strong>Pseudoteam Team</strong></p>
        </div>


        <!-- Footer -->
        <div class="footer">
            © 2025 Pseudoteam. All rights reserved. <br>
            You’re receiving this because your friend referred you.
        </div>
    </div>
</body>

</html>