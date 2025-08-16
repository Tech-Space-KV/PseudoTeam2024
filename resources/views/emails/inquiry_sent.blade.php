<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inquiry</title>
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
            font-size: 22px;
            margin-bottom: 10px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .info-table td {
            padding: 8px 10px;
            border: 1px solid #e0e0e0;
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
            <!-- <img src="https://pseudoteam.com/homepage/home/logo.png" alt="Pseudoteam Logo"> -->
        </div>

        <!-- Content -->
        <div class="content">
            <h1>✅ Your Inquiry Has Been Successfully Submitted!</h1>
            <p>Thank you for reaching out to <strong>PseudoTeam</strong>. We've received your inquiry and our team will
                review it shortly.</p>

            <p>Here’s a summary of what you submitted:</p>

            <table class="info-table">
                <tr>
                    <td><strong>Name:</strong></td>
                    <td>{{ $user['pown_name'] }}</td>
                </tr>
                <!-- <tr>
                    <td><strong>Email:</strong></td>
                    <td>{{ $user['pown_email'] }}</td>
                </tr>
                <tr>
                    <td><strong>Contact:</strong></td>
                    <td>{{ $user['pown_contact'] }}</td>
                </tr> -->
                <tr>
                    <td><strong>Message:</strong></td>
                    <td>{{ $data['inquiry_summary'] }}</td>
                </tr>
                <tr>
                    <td><strong>Inquiry Description:</strong></td>
                    <td>{{ $user['inquiry_description'] }}</td>
                </tr>
                <tr>
                    <td><strong>Category:</strong></td>
                    <td>{{ $user['category'] }}</td>
                </tr>
                <tr>
                    <td><strong>Submitted On:</strong></td>
                    <td>{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</td>
                </tr>
            </table>

            <p>One of our team members will get back to you as soon as possible. If your inquiry is urgent, feel free to
                contact us directly at <a href="mailto:support@pseudoteam.com">support@pseudoteam.com</a>.</p>

            <p>We’re excited to help you bring your project to life! 🚀</p>

            <p>Warm regards,<br><strong>The PseudoTeam Team</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            © 2025 PseudoTeam. All rights reserved. <br>
            This is a confirmation email from PseudoTeam.
        </div>
    </div>
</body>

</html>