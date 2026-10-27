<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>

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
            background-color: #ffffff;
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
            color: #ffffff !important;
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

        <div class="header">

            <img
                src="https://pseudoteam.com/PseudoTeam2024/public/images/logopt.png"
                alt="Pseudoteam Logo"
            >

        </div>

        <div class="content">

            <h1>🔒 Password Reset Request</h1>

            <p>
                Hello {{ $name }},
            </p>

            <p>
                We received a request to reset the password for your
                <strong>Service Partner</strong> account with
                <strong>Pseudoteam</strong>.
            </p>

            <p>
                If you made this request, please click the button below
                to reset your password.
            </p>

            <p>
                If you did not request a password reset, you can safely
                ignore this email. Your account will remain secure.
            </p>

            <p>
                <a href="{{ $resetLink }}" class="button">
                    Reset Your Password
                </a>
            </p>

            <p style="margin-top: 20px; word-break: break-all;">

                If the button does not work, copy and paste the following
                link into your browser:

                <br><br>

                {{ $resetLink }}

            </p>

            <p style="margin-top: 20px;">
                For security reasons, this link will expire in 24 hours.
                If you need further assistance, please contact our support team.
            </p>

            <p>
                Best regards,<br>
                <strong>Pseudoteam</strong>
            </p>

        </div>

        <div class="footer">

            © 2026 Pseudoteam. All rights reserved.

            <br>

            You are receiving this email because you have a registered
            Service Partner account.

        </div>

    </div>

</body>

</html>