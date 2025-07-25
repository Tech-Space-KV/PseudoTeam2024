<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>PseudoTeam</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/cover/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/web/website_home2.css') }}">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --dark-bg: #111;
            --panel-bg: #1c1c1c;
            --card-bg: #fff;
            --text-dark: #111;
            --text-light: #fff;
            --border-light: #444;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
        }

        .navbar {
            /* background-color: white; */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            color: #ffffff
        }

        .navbar-brand img {
            height: 40px;
        }

        .nav-item {
            padding: 0 15px;
            text-align: center;
        }

        .nav-item .title {
            font-weight: 600;
            /* font-size: 14px; */
        }

        .nav-item .subtitle {
            font-size: 12px;
            color: gray;
        }

        .nav-icon {
            font-size: 20px;
            margin-bottom: 3px;
        }

        .nav-divider {
            border-left: 1px solid #ddd;
            height: 40px;
            margin: 0 10px;
        }

        @media (max-width: 991.98px) {
            .nav-item {
                padding: 10px 0;
                text-align: left;
            }
        }
    </style>

    <style>
        .glow-text {
            color: #fff;
            animation: glowPulse 2s infinite ease-in-out;
        }

        @keyframes glowPulse {
            0% {
                text-shadow: 0 0 0px #00f7ff;
                color: #ccc;
            }

            50% {
                text-shadow: 0 0 10px #00f7ff, 0 0 20px #00f7ff, 0 0 30px #00f7ff;
                color: #fff;
            }

            100% {
                text-shadow: 0 0 0px #00f7ff;
                color: #ccc;
            }
        }
    </style>


    <style>
        .glow-line {
            position: fixed;
            top: 0;
            left: 0;
            width: 4px;
            height: 100vh;
            background: linear-gradient(to bottom, #ffffff, rgb(177, 177, 177), #ffffff);
            box-shadow: 0 0 20px #ffffff, 0 0 40px #ffffff;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            z-index: 1000;
        }

        .glow-line.active {
            opacity: 1;
        }

        .glow-line {
            transition: background 0.5s ease, box-shadow 0.5s ease;
        }


        @media (max-width: 1000px) {
            .navhide {
                display: none;
            }
        }
    </style>

    <style>
        .card h3 {
            margin-bottom: 15px;
            font-size: 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


        .flex-cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .flex-cards .card {
            flex: 1 1 48%;
        }

        .card {
            background: var(--card-bg);
            color: var(--text-dark);
            border-radius: 10px;
            padding: 25px 30px;
            margin-bottom: 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .15);
            position: relative;
            overflow: hidden;
            max-height: 300px;
            /* Optional: Limit total card height */
            display: flex;
            flex-direction: column;
        }

        .table-container {
            overflow-y: auto;
            margin-top: 15px;
            flex: 1;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container thead {
            position: sticky;
            top: 0;
            background: var(--card-bg);
        }

        .table-container th,
        .table-container td {
            padding: 8px 10px;
            text-align: left;
        }

        label {
            color: var(--text-light);
        }
    </style>

</head>


<body style="background-color: black; font-family: Arial, sans-serif;">

    @include('website.top_nav')

    <br>

    <div class="flex-cards">
        <!-- Clients Card -->
        <div class="card">
            <h3>
                Services
                <button class="search-icon" onclick="openModal('client')">🔍</button>
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Sku No.</th>
                            <th>Name</th>
                            <th>Mark</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $service['no'] }}</td>
                                <td>{{ $service['description'] }}</td>
                                <td><input type="checkbox" name="spares[]" value="{{ $service['no'] }}"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Suppliers Card -->
        <div class="card">
            <h3>
                Critical spares & IT Services
                <button class="search-icon" onclick="openModal('supplier')">🔍</button>
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Sku No.</th>
                            <th>Spare Name</th>
                            <th>Mark</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hardwares as $hardware)
                            <tr>
                                <td>{{ $hardware['hw_identifier'] }}</td>
                                <td>{{ $hardware['model_description'] }}</td>
                                <td><input type="checkbox" name="spares[]" value="{{ $hardware['hw_identifier'] }}"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Contact Form -->
    <!-- <div style="margin: 40px auto; max-width: 600px; padding: 20px; background-color: #1c1c1c; border-radius: 8px;">
        <h2 style="color: #fff;">Contact Us</h2>
        <form action="/submit-query" method="post">
            <div style="margin-bottom: 15px;">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required style="width: 100%; padding: 8px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 8px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="company">Company:</label><br>
                <input type="text" id="company" name="company" style="width: 100%; padding: 8px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="query">Your Query:</label><br>
                <textarea id="query" name="query" rows="5" required style="width: 100%; padding: 8px;"></textarea>
            </div>
            <button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">Submit</button>
        </form>
    </div> -->

    <div
        style="margin: 40px auto; width: 80%; padding: 20px; background-color: #1c1c1c; border-radius: 8px; box-sizing: border-box;">
        <h2 style="color: #fff;">Ask for a Quote</h2>
        <form action="{{ route('post.ask_for_quote') }}" method="post" style="width: 100%;">
            @csrf

            <input type="hidden" name="selected_services" id="selected_services">
            <input type="hidden" name="selected_spares" id="selected_spares">

            <!-- Row 1: Name & Email -->
            <div style="display: flex; gap: 20px; margin-bottom: 15px;">
                <div style="flex: 1;">
                    <label for="name">Name:</label><br>
                    <input type="text" id="name" name="name" required style="width: 100%; padding: 8px;">
                </div>
                <div style="flex: 1;">
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" required style="width: 100%; padding: 8px;">
                </div>
            </div>

            <!-- Row 2: Contact & Company -->
            <div style="display: flex; gap: 20px; margin-bottom: 15px;">
                <div style="flex: 1;">
                    <label for="contact">Contact:</label><br>
                    <input type="text" id="contact" name="contact" required style="width: 100%; padding: 8px;">
                </div>
                <div style="flex: 1;">
                    <label for="company">Company:</label><br>
                    <input type="text" id="company" name="company" style="width: 100%; padding: 8px;">
                </div>
            </div>

            <!-- Row 3: Full-width Query Box -->
            <div style="margin-bottom: 15px;">
                <label for="query">Your Query:</label><br>
                <textarea id="query" name="query" rows="5" required style="width: 100%; padding: 8px;"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
                Submit
            </button>
        </form>
    </div>

    <!-- JavaScript to collect selected checkboxes -->
    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            const selectedServices = [];
            const selectedSpares = [];

            // Collect checked services
            document.querySelectorAll('input[name="services[]"]:checked').forEach(cb => {
                selectedServices.push(cb.value);
            });

            // Collect checked spares
            document.querySelectorAll('input[name="spares[]"]:checked').forEach(cb => {
                selectedSpares.push(cb.value);
            });

            // Set to hidden inputs
            document.getElementById('selected_services').value = selectedServices.join(',');
            document.getElementById('selected_spares').value = selectedSpares.join(',');
        });
    </script>

</body>


</html>