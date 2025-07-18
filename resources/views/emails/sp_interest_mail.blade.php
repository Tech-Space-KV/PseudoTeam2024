<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Service Provider Interest Notification</title>
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
        <!-- Header -->
        <div class="header">
            <img src="https://pseudoteam.com/homepage/home/logo.png" alt="Pseudoteam Logo">
        </div>

        <!-- Content Section -->
        <div class="content">
            <h1>Service Provider Interest Notification</h1>
            <p>Hello,</p>
            <p>
                A service provider has shown interest in your project. Please find the details below:
            </p>

            <h3>Project Details</h3>
            <div class="details-box">
                <strong>Title:</strong> {{ $project->plist_title }}<br>
                <strong>Description:</strong> {{ $project->plist_description }}<br>
                <strong>Location:</strong> {{ $project->plist_location }}<br>
                <strong>Budget:</strong> {{ $project->plist_budget }}<br>
                <strong>Deadline:</strong> {{ $project->plist_enddate }}
            </div>

            <h3 style="margin-top: 25px;">Service Provider Details</h3>
            <div class="details-box">
                <strong>Name:</strong> {{ $serviceProvider->sprov_name }}<br>
                <strong>Email:</strong> {{ $serviceProvider->sprov_email }}<br>
                <strong>Phone:</strong> {{ $serviceProvider->sprov_phone }}<br>
                <strong>Experience:</strong> {{ $serviceProvider->sprov_total_experience }} years<br>
            </div>

            <h3 style="margin-top: 25px;">Reason for Interest</h3>
            <div class="details-box">
                {{ $reason }}
            </div>

            <p style="margin-top: 20px;">
                Please reach out to the service provider or proceed with the assignment process.
            </p>

            <p>Thanks,<br><strong>Pseudoteam System</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            © 2025 Pseudoteam. Internal Notification Only.<br>
            This is an automated message from the system.
        </div>
    </div>
</body>

</html>