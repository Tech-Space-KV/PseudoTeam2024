<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/customer_auth.css') }}">
    <title>PseudoTeam</title>

</head>

<body class="align-items-center bg-dark bg-gif3">

    <!-- Home link, centered horizontally -->
    <div class="center-link">
        <a class="btn btn-sm px-4 mt-4 btn-outline-primary" aria-current="page" href="/"><i class="fa fa-home"></i>
            Home</a>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-4">
        <div class="card fixed-width-card p-4 rounded-3 border-primary">
            <main class="form-signin w-100 m-auto">
                <!-- <form method="POST" action="{{ route('login.post') }}">
          @csrf
          <img src="/images/logo_pt.png" class="rounded-3" style="width: 180px;">
          <h1 class="h5 mb-3 ms-1 text-muted">Customer Sign In</h1>
          <hr>
          <div class="form-floating mb-3 mt-3">
            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com"
              required>
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password"
              required>
            <label for="floatingPassword">Password</label>
          </div>

          <div class="d-flex justify-content-between my-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                Remember me
              </label>
            </div>

            <a href="{{ route('customer.forgot-password') }}" class="text-decoration-none">Forgot Password?</a>
          </div>
          <button class="btn btn-primary w-100 py-2" type="submit">Sign In</button>

          <p class="mt-3 text-center">New user? <a href="{{ url('/authentication/customer/sign-up') }}"
              class="text-decoration-none">Sign Up</a></p>
        </form> -->

                <div class="container">
                    <h2>Reset Password</h2>

                    @if ($errors->any())
                        <div style="color: red;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('status'))
                        <div style="color: green;">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ Route('customer.reset-password.post') }}">
                        @csrf

                        {{-- Hidden token and email from the URL --}}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div>
                            <label for="password">New Password:</label><br>
                            <input type="password" name="password" id="password" required>
                        </div>

                        <div>
                            <label for="password_confirmation">Confirm New Password:</label><br>
                            <input type="password" name="password_confirmation" id="password_confirmation" required>
                        </div>

                        <div style="margin-top: 10px;">
                            <button type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>

            </main>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>



    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>