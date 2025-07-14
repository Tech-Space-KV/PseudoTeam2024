<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Inquiry Received</title>
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
            <img src="https://pseudoteam.com/homepage/home/logo.png" alt="Pseudoteam Logo">
        </div>

        <!-- Content -->
        <div class="content">
            <h1>📩 New Inquiry Received</h1>
            <p>We’ve received a new inquiry through the Pseudoteam website. Here are the details:</p>

            <table class="info-table">
                <tr>
                    <td><strong>Name:</strong></td>
                    <td>{{ $data['name'] }}</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td>{{ $data['email'] }}</td>
                </tr>
                <tr>
                    <td><strong>Contact:</strong></td>
                    <td>{{ $data['contact'] }}</td>
                </tr>
                <tr>
                    <td><strong>Message:</strong></td>
                    <td>{{ $data['message'] }}</td>
                </tr>
                <tr>
                    <td><strong>Date:</strong></td>
                    <td>{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</td>
                </tr>
            </table>

            <p>Please follow up with the user at your earliest convenience.</p>

            <p>Regards,<br><strong>Pseudoteam System</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            © 2025 Pseudoteam. All rights reserved. <br>
            This email was generated automatically from a customer inquiry.
        </div>
    </div>
</body>

</html>