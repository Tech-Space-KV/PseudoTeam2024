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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        .navbar {
            /* background-color: white; */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            color: #ffffff
        }

        .navbar-brand img {
            height: 40px;
            width: 160px;
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

    <!-- Custom CSS -->
    <style>
        /* SECTION 1: HERO with video background */
        .hero-section {
            position: relative;
            height: 75vh;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            overflow: hidden;
        }

        @media (max-width: 1425px) {
            .hero-section {
                margin-top: 15%;
                height: 50vh;
            }
        }

        @media (max-width: 480px) {
            .hero-section {
                margin-top: 15%;
                height: 30vh;
            }
        }


        .bg-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .nav-masthead .nav-link {
            color: rgba(255, 255, 255, 0.75);
            border-bottom: 0.25rem solid transparent;
            transition: all 0.3s ease;
        }

        .nav-masthead .nav-link:hover {
            color: #fff;
            border-bottom-color: rgba(255, 255, 255, 0.5);
        }

        /* SECTION 2: scrollable content */
        .content-section {
            padding: 4rem 1rem;
            background-color: #f8f9fa;
            color: #333;
        }

        .nav-masthead img {
            width: 150px;
        }
    </style>

    <style>
        .card-glass {
            color: #fff;
            background-color: rgba(188, 205, 255, 0.149);
            backdrop-filter: blur(50px);
        }
    </style>


    <style>
        .marquee-container {
            overflow: hidden;
            white-space: nowrap;
            background: #000000;
            border-top: 2px solid #000000;
            border-bottom: 2px solid #000000;
            position: relative;
        }

        .marquee-track {
            display: flex;
            animation: scroll-left 20s linear infinite;
            width: fit-content;
        }

        .feature-item {
            margin: 0 1.5rem;
            font-weight: bold;
            color: #5c5c5c;
            background-color: #dbdbdb;
            padding: 5px 15px;
            border-radius: 20px;
            white-space: nowrap;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-50%);
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
        /* Card Heading - Blue Background */
        .card-modern h3 {
            background: linear-gradient(to right, #007bff, #0056b3);
            color: white;
            padding: 12px 20px;
            font-size: 1.2rem;
            border-radius: 10px 10px 0 0;
            margin: -30px -30px 20px -30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Icon style inside heading */
        .card-modern h3 button {
            background-color: rgba(255, 255, 255, 0.15);
            color: #fff;
            border: none;
        }

        /* Add more attractive card body */
        .card-modern {
            background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.6), rgba(0, 51, 102, 0.6));
            border-radius: 16px;
            border: 1px solid rgba(0, 123, 255, 0.2);
            color: white;
            box-shadow: 0 8px 24px rgba(0, 123, 255, 0.15);
        }

        /* Scrollbar styling inside card */
        .scrollable-content::-webkit-scrollbar {
            width: 6px;
        }

        .scrollable-content::-webkit-scrollbar-thumb {
            background-color: rgba(0, 123, 255, 0.5);
            border-radius: 3px;
        }

        /* Form Heading */
        /* .form-modern h2 {
            background: linear-gradient(to right, #007bff, #0056b3);
            padding: 15px 25px;
            border-radius: 8px;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 25px;
            box-shadow: 0 4px 20px rgba(0, 123, 255, 0.3);
            text-align: center;
        } */
    </style>


    <style>
        .fixed-card {
            height: 500px;
            /* You can adjust this as needed */
            display: flex;
            flex-direction: column;
        }

        .scrollable-content {
            flex-grow: 1;
            overflow-y: auto;
            margin-top: 10px;
            padding-right: 5px;
        }

        .scrollable-content table {
            width: 100%;
            border-collapse: collapse;
        }

        .scrollable-content thead {
            position: sticky;
            top: 0;
            background: rgba(0, 0, 0, 0.5);
            /* Keeps header visible on scroll */
            backdrop-filter: blur(10px);
        }
    </style>

    <style>
        .card-modern {
            padding: 20px;
        }

        /* .form-modern input,
        .form-modern textarea {
            background-color: #f8f9fa;
            color: #000;
        }

        .form-modern .form-control:focus {
            box-shadow: 0 0 5px #007bff;
            border-color: #007bff;
        } */

        @media (max-width: 767px) {
            .fixed-card {
                height: auto;
            }

            .scrollable-content {
                max-height: 300px;
            }
        }

        .card-modern table {
            background-color: transparent !important;
            color: #fff;
        }

        .card-modern thead,
        .card-modern tbody,
        .card-modern th,
        .card-modern td {
            background-color: transparent !important;
            color: #fff;
            border-color: rgba(255, 255, 255, 0.2);
        }

        .form-modern input,
        .form-modern textarea {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            backdrop-filter: blur(10px);
            border-radius: 6px;
        }

        .form-modern input::placeholder,
        .form-modern textarea::placeholder {
            color: #ccc;
        }

        .form-modern input:focus,
        .form-modern textarea:focus {
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.4);
            border-color: #007bff;
            color: #fff;
            outline: none;
        }

        .form-modern label {
            color: #ccc;
            font-weight: 500;
        }
    </style>



</head>


<body style="background-color: black;">

    <nav class="navbar navbar-expand-lg navbar-dark px-2 sticky-top px-4"
        style="background-color: rgba(21, 21, 21, 0.812); backdrop-filter: blur(30px);">
        <div class="container-fluid">
            <a href="{{ route('home') }}"><img src="{{asset('images/logo_pt3.png')}}" class="me-2"
                    style="width: 160px;" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">

                </ul>
                <!-- <span class="navbar-text d-flex flex-column align-items-center me-3">
                    <span style="color: #fff; font-size: 0.9rem;">📞Contact us: +91-9876543210</span>
                    <a class="nav-link nav-text px-4 glow-text" href="{{ route('ask_for_quote') }}">
                        Get Critical Spares & IT Services
                    </a>
                </span> -->

                <span class="navbar-text">
                    <a class="btn btn-outline-light px-4" onmouseover="this.style.color='black';"
                        onmouseout="this.style.color='white';"
                        href="{{ url('/authentication/customer/sign-in') }}">Manage Project</a>
                </span>
            </div>
        </div>
    </nav>

    <br>
    <center>
        <h3 class="text-secondary display-5">Ask For a Quote</h3>
        <p class="text-secondary">Get IT Services and Critical Spares</p>
    </center>
    <div class="px-5 mt-5">

        <div class="row g-5 mb-5">
            <!-- Services Card -->
            <div class="col-md-6">
                <div class="card-modern fixed-card p-4">
                    <h3 class="mb-3">
                        <i class="fas fa-tools me-2"></i> Select Services
                        <button class="search-icon btn btn-sm btn-outline-light"
                            onclick="openModal('client')">🔍</button>
                    </h3>

                    <div class="scrollable-content">

                        <input type="text" class="w-100 px-2 rounded-pill mx-auto mb-4" id="tableSearch1"
                            placeholder="Search..." onkeyup="searchTable1()" />

                        <table class="table table-bordered table-hover table-sm text-white" id="dataTable1">
                            <thead>
                                <tr>
                                    <th>SKU No.</th>
                                    <th>Description</th>
                                    <th>Mark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $service['no'] }}</td>
                                        <td>{{ $service['description'] }}</td>
                                        <td><input type="checkbox" name="services[]" value="{{ $service['no'] }}"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Spares Card -->
            <div class="col-md-6">
                <div class="card-modern fixed-card p-4">
                    <h3 class="mb-3">
                        <i class="fas fa-microchip me-2"></i> Select Critical Spares
                        <button class="search-icon btn btn-sm btn-outline-light"
                            onclick="openModal('supplier')">🔍</button>
                    </h3>

                    <div class="scrollable-content">

                        <input type="text" class="w-100 px-2 rounded-pill mx-auto mb-4" id="tableSearch2"
                            placeholder="Search..." onkeyup="searchTable2()" />

                        <table class="table table-bordered table-hover table-sm text-white" id="dataTable2">
                            <thead>
                                <tr>
                                    <th>SKU No.</th>
                                    <th>Spare Name</th>
                                    <th>Mark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hardwares as $hardware)
                                    <tr>
                                        <td>{{ $hardware['hw_identifier'] }}</td>
                                        <td>{{ $hardware['model_description'] }}</td>
                                        <td><input type="checkbox" name="spares[]" value="{{ $hardware['hw_identifier'] }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <!-- <div class="form-modern p-4">
            <h2 class="mb-4">Complete Your Request</h2>
            <form action="{{ route('post.ask_for_quote') }}" method="post">
                @csrf

                <input type="hidden" name="selected_services" id="selected_services">
                <input type="hidden" name="selected_spares" id="selected_spares">

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label text-white">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label text-white">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="contact" class="form-label text-white">Contact</label>
                        <input type="text" name="contact" id="contact" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="company" class="form-label text-white">Company</label>
                        <input type="text" name="company" id="company" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label fo r="query" class="form-label text-white">Your Query</label>
                    <textarea name="query" id="query" rows="5" class="form-control" required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5">Get a Quote & Callback</button>
                </div>
            </form>
        </div> -->

        <!-- <div class="form-modern mt-5">
            <h2 class="mb-4">Complete Your Request</h2>
            <form action="{{ route('post.ask_for_quote') }}" method="post">
                @csrf

                <input type="hidden" name="selected_services" id="selected_services">
                <input type="hidden" name="selected_spares" id="selected_spares">

                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="contact">Contact</label>
                        <input type="text" name="contact" id="contact" required>
                    </div>
                    <div class="col-md-6">
                        <label for="company">Company</label>
                        <input type="text" name="company" id="company">
                    </div>
                </div>

                <div class="mt-3">
                    <label for="query">Your Query</label>
                    <textarea name="query" id="query" rows="5" required></textarea>
                </div>

                <button type="submit" class="mt-3">Get a Quote & Callback</button>
            </form>
        </div> -->

        <!-- 
        <div class="d-flex justify-content-center mt-5">
            <div class="form-modern p-4 shadow-lg rounded"
                style="background: rgba(255,255,255,0.05); width: 100%; max-width: 600px;">
                <h2 class="mb-4 text-center glow-text">Request a Quote</h2>
                <form action="{{ route('post.ask_for_quote') }}" method="post">
                    @csrf

                    <input type="hidden" name="selected_services" id="selected_services">
                    <input type="hidden" name="selected_spares" id="selected_spares">

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label text-white">Name</label>
                            <input type="text" class="form-control form-control-sm" name="name" id="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label text-white">Email</label>
                            <input type="email" class="form-control form-control-sm" name="email" id="email" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="contact" class="form-label text-white">Contact</label>
                            <input type="text" class="form-control form-control-sm" name="contact" id="contact"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="company" class="form-label text-white">Company</label>
                            <input type="text" class="form-control form-control-sm" name="company" id="company">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="query" class="form-label text-white">Your Query</label>
                        <textarea class="form-control form-control-sm" name="query" id="query" rows="4"
                            required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill mt-2">
                            <i class="fas fa-paper-plane me-2"></i>Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div> -->

        <div class="d-flex justify-content-center mt-5">
            <div class="form-modern card-modern shadow-lg p-4 rounded" style="width: 100%; max-width: 650px;">
                <h2 class="mb-5 text-center">Your Details Here...</h2>
                <form action="{{ route('post.ask_for_quote') }}" method="post">
                    @csrf

                    <input type="hidden" name="selected_services" id="selected_services">
                    <input type="hidden" name="selected_spares" id="selected_spares">

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label text-white">Name</label>
                            <input type="text" class="form-control form-control-sm" name="name" id="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label text-white">Email</label>
                            <input type="email" class="form-control form-control-sm" name="email" id="email" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="contact" class="form-label text-white">Contact</label>
                            <!-- <input type="text" class="form-control form-control-sm" name="contact" id="contact"
                                required> -->

                            <input type="text" class="form-control form-control-sm" name="contact" id="contact" required
                                pattern="[0-9]{10}" title="Please enter a 10-digit phone number">
                        </div>
                        <div class="col-md-6">
                            <label for="company" class="form-label text-white">Company</label>
                            <input type="text" class="form-control form-control-sm" name="company" id="company">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="query" class="form-label text-white">Your Query</label>
                        <textarea class="form-control form-control-sm" name="query" id="query" rows="4"
                            required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill mt-2">
                            <i class="fas fa-paper-plane me-2"></i>Request For Quote
                        </button>
                    </div>
                </form>
            </div>
        </div>



    </div>

    </div>
    <br>

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

    <script>
        function searchTable1() {
            let input = document.getElementById("tableSearch1").value.toLowerCase();
            let table = document.getElementById("dataTable1");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header row
                let cells = rows[i].getElementsByTagName("td");
                let rowContainsSearchTerm = false;

                for (let cell of cells) {
                    if (cell.innerText.toLowerCase().includes(input)) {
                        rowContainsSearchTerm = true;
                        break;
                    }
                }

                rows[i].style.display = rowContainsSearchTerm ? "" : "none";
            }
        }

        function searchTable2() {
            let input = document.getElementById("tableSearch2").value.toLowerCase();
            let table = document.getElementById("dataTable2");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header row
                let cells = rows[i].getElementsByTagName("td");
                let rowContainsSearchTerm = false;

                for (let cell of cells) {
                    if (cell.innerText.toLowerCase().includes(input)) {
                        rowContainsSearchTerm = true;
                        break;
                    }
                }

                rows[i].style.display = rowContainsSearchTerm ? "" : "none";
            }
        }
    </script>

    <script>

        const urlParams = new URLSearchParams(window.location.search);
        const searchQuery = urlParams.get('search');


        if (searchQuery) {
            document.getElementById('tableSearch1').value = searchQuery;

            searchTable1();
        }


        if (searchQuery) {
            document.getElementById('tableSearch2').value = searchQuery;

            searchTable2();
        }

    </script>



</body>


</html>