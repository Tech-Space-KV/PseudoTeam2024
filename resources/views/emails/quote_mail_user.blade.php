<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Your Quote Request Received</title>
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
            <!-- <img  src="{{asset('images/logo_pt3.png')}}" alt="Pseudoteam Logo"> -->
            <img src="https://pseudoteam.com/PseudoTeam2024/public/images/logopt.png" alt="Pseudoteam Logo">
        </div>

        <!-- Content -->
        <div class="content">
            <h1>Thank you, {{ $formData['name'] }}!</h1>
            <p>We’ve received your quote request. Our team will review your query and get back to you shortly.</p>

            <p><strong>Here’s a summary of your request:</strong></p>

            <p><strong>Email:</strong> {{ $formData['email'] }}</p>
            <p><strong>Contact:</strong> {{ $formData['contact'] }}</p>
            <p><strong>Company:</strong> {{ $formData['company'] ?? 'N/A' }}</p>
            <p><strong>Your Message:</strong><br>{{ $formData['query'] }}</p>

            <h3>Selected Services:</h3>
            <ul>
                @forelse($selectedServices as $service)
                    <li>{{ $service }}</li>
                @empty
                    <li>No services selected</li>
                @endforelse
            </ul>

            <h3>Selected Spares:</h3>
            <ul>
                @forelse($selectedSpares as $spare)
                    <li>{{ $spare }}</li>
                @empty
                    <li>No spares selected</li>
                @endforelse
            </ul>

            <p>We appreciate your interest in Pseudoteam.</p>

            <p>Best regards,<br><strong>Pseudoteam</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            © 2025 Pseudoteam. This email confirms we’ve received your request.
        </div>
    </div>
</body>

</html>