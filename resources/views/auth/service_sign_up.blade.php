<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('https://pseudoteam.com/PseudoTeam2024/public/favicon/favicon.svg') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('css/web/service_auth.css') }}">

    <title>PseudoTeam</title>

    <style>
        .bg-gif3 {
            background: url('{{ asset('images/partner-sign-bg.png') }}') no-repeat center center;
            background-size: cover;
            position: relative;
            min-height: 100vh;
            z-index: 0;
        }

        .fixed-width-card {
            width: 100%;
            max-width: 450px;
            background: rgba(255, 255, 255, 0.95);
        }

        .center-link {
            text-align: center;
        }
    </style>
</head>

<body class="align-items-center bg-dark bg-gif3">

    <br><br>

    <!-- Home Button -->
    <div class="center-link">
        <a class="btn btn-sm px-4 mt-4 btn-outline-primary"
            href="{{ route('partner') }}">
            <i class="fa fa-home"></i> Home
        </a>
    </div>

    <!-- Signup Card -->
    <div class="d-flex justify-content-center align-items-center mt-4">

        <div class="card fixed-width-card p-4 rounded-3 border-primary shadow">

            <main class="form-signin w-100 m-auto">

                <form action="{{ route('auth.sp.sign_up.post') }}" method="POST">

                    @csrf

                    <!-- Logo -->
                    <div class="text-center">
                        <img src="{{ asset('images/logo_pt.png') }}"
                            class="rounded-3 mb-3"
                            style="width: 180px;">
                    </div>

                    <h1 class="h5 mb-3 text-center text-muted">
                        Service Partner Sign Up
                    </h1>

                    <hr>

                    <!-- Success Message -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        {{ session('success') }}

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>
                    </div>
                    @endif

                    <!-- Error Message -->
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        {{ session('error') }}

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>
                    </div>
                    @endif

                    <!-- Validation Errors -->
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">

                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>
                    </div>
                    @endif

                    <!-- Full Name -->
                    <div class="form-floating mb-3 mt-3">
                        <input type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Full Name"
                            required>

                        <label for="name">Full Name</label>
                    </div>

                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="name@example.com"
                            required>

                        <label for="email">Email Address</label>
                    </div>

                    <!-- Contact -->
                    <div class="form-floating mb-3">
                        <input type="text"
                            class="form-control"
                            id="contact"
                            name="contact"
                            value="{{ old('contact') }}"
                            placeholder="Contact Number"
                            required>

                        <label for="contact">Contact</label>
                    </div>

                    <!-- Promo Code Toggle -->
                    <div class="mt-2">
                        <a href="javascript:void(0);"
                            onclick="togglePromoCode()"
                            class="text-primary text-decoration-none">

                            <i class="fa fa-gift"></i>
                            Have a promo code?
                        </a>
                    </div>

                    <!-- Promo Code -->
                    <div id="promoCodeField"
                        class="form-floating mt-3"
                        style="{{ old('promo_code') ? 'display:block;' : 'display:none;' }}">

                        <input type="text"
                            class="form-control"
                            id="promoCode"
                            name="promo_code"
                            value="{{ old('promo_code') }}"
                            placeholder="Enter Promo Code">

                        <label for="promoCode">Promo Code</label>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mt-4">
                        <button class="btn btn-primary py-2 px-4 rounded-pill"
                            type="submit">

                            Sign Up
                        </button>
                    </div>

                    <!-- Sign In -->
                    <p class="mt-4 text-center">
                        Already a user?

                        <a href="{{ url('/authentication/service-partner/sign-in') }}"
                            class="text-decoration-none">

                            Sign In
                        </a>
                    </p>

                </form>

            </main>

        </div>

    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Promo Toggle -->
    <script>
        function togglePromoCode() {

            const promoField = document.getElementById("promoCodeField");

            if (promoField.style.display === "none") {
                promoField.style.display = "block";
            } else {
                promoField.style.display = "none";
            }
        }
    </script>

</body>

</html>