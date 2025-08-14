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

  <style>
    .bg-gif3 {
      background: url('{{ asset('images/customer-sign-bg.png') }}') no-repeat center center;
      background-size: cover;
      position: relative;
      min-height: 100vh;
      z-index: 0;
    }
  </style>

  <!-- <style>
    /* Loader wrapper - fullscreen overlay */
    #loader-wrapper {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #fff;
      /* Background color */
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Simple Git-style loader (spinner) */
    .loader {
      border: 8px solid #f3f3f3;
      border-top: 8px solid #333;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 1s linear infinite;
    }

    /* Spinner animation */
    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }
  </style> -->

  <style>
    /* HTML: <div class="loader"></div> */
    .loader {
      --w: 10ch;
      font-weight: bold;
      font-family: monospace;
      font-size: 30px;
      letter-spacing: var(--w);
      width: var(--w);
      overflow: hidden;
      white-space: nowrap;
      color: #0000;
      animation: l40 2s infinite;
    }

    .loader:before {
      content: "Loading...";
    }

    @keyframes l40 {

      0%,
      100% {
        text-shadow:
          calc(0*var(--w)) 0 #000, calc(-1*var(--w)) 0 #000, calc(-2*var(--w)) 0 #000, calc(-3*var(--w)) 0 #000, calc(-4*var(--w)) 0 #000,
          calc(-5*var(--w)) 0 #000, calc(-6*var(--w)) 0 #000, calc(-7*var(--w)) 0 #000, calc(-8*var(--w)) 0 #000, calc(-9*var(--w)) 0 #000;
      }

      9% {
        text-shadow:
          calc(0*var(--w)) 0 #000, calc(-1*var(--w)) 0 #000, calc(-2*var(--w)) -20px #0000, calc(-3*var(--w)) 0 #000, calc(-4*var(--w)) 0 #000,
          calc(-5*var(--w)) 0 #000, calc(-6*var(--w)) 0 #000, calc(-7*var(--w)) 0 #000, calc(-8*var(--w)) 0 #000, calc(-9*var(--w)) 0 #000;
      }

      18% {
        text-shadow:
          calc(0*var(--w)) 0 #000, calc(-1*var(--w)) 0 #000, calc(-2*var(--w)) -20px #0000, calc(-3*var(--w)) 0 #000, calc(-4*var(--w)) 0 #000,
          calc(-5*var(--w)) 0 #000, calc(-6*var(--w)) -20px #0000, calc(-7*var(--w)) 0 #000, calc(-8*var(--w)) 0 #000, calc(-9*var(--w)) 0 #000;
      }

      27% {
        text-shadow:
          calc(0*var(--w)) -20px #0000, calc(-1*var(--w)) 0 #000, calc(-2*var(--w)) -20px #0000, calc(-3*var(--w)) 0 #000, calc(-4*var(--w)) 0 #000,
          calc(-5*var(--w)) 0 #000, calc(-6*var(--w)) -20px #0000, calc(-7*var(--w)) 0 #000, calc(-8*var(--w)) 0 #000, calc(-9*var(--w)) 0 #000;
      }

      36% {
        text-shadow:
          calc(0*var(--w)) -20px #0000, calc(-1*var(--w)) 0 #000, calc(-2*var(--w)) -20px #0000, calc(-3*var(--w)) 0 #000, calc(-4*var(--w)) 0 #000,
          calc(-5*var(--w)) -20px #0000, calc(-6*var(--w)) -20px #0000, calc(-7*var(--w)) 0 #000, calc(-8*var(--w)) 0 #000, calc(-9*var(--w)) 0 #000;
      }

      45% {
        text-shadow:
          calc(0*var(--w)) -20px #0000, calc(-1*var(--w)) 0 #000, calc(-2*var(--w)) -20px #0000, calc(-3*var(--w)) 0 #000, calc(-4*var(--w)) 0 #000,
          calc(-5*var(--w)) -20px #0000, calc(-6*var(--w)) -20px #0000, calc(-7*var(--w)) 0 #000, calc(-8*var(--w)) -20px #0000, calc(-9*var(--w)) 0 #000;
      }

      54% {
        text-shadow:
          calc(0*var(--w)) -20px #0000, calc(-1*var(--w)) 0 #000, calc(-2*var(--w)) -20px #0000, calc(-3*var(--w)) 0 #000, calc(-4*var(--w)) -20px #0000,
          calc(-5*var(--w)) -20px #0000, calc(-6*var(--w)) -20px #0000, calc(-7*var(--w)) 0 #000, calc(-8*var(--w)) -20px #0000, calc(-9*var(--w)) 0 #000;
      }

      63% {
        text-shadow:
          calc(0*var(--w)) -20px #0000, calc(-1*var(--w)) 0 #000, calc(-2*var(--w)) -20px #0000, calc(-3*var(--w)) 0 #000, calc(-4*var(--w)) -20px #0000,
          calc(-5*var(--w)) -20px #0000, calc(-6*var(--w)) -20px #0000, calc(-7*var(--w)) 0 #000, calc(-8*var(--w)) -20px #0000, calc(-9*var(--w)) -20px #0000;
      }

      72% {
        text-shadow:
          calc(0*var(--w)) -20px #0000, calc(-1*var(--w)) -20px #0000, calc(-2*var(--w)) -20px #0000, calc(-3*var(--w)) 0 #000, calc(-4*var(--w)) -20px #0000,
          calc(-5*var(--w)) -20px #0000, calc(-6*var(--w)) -20px #0000, calc(-7*var(--w)) 0 #000, calc(-8*var(--w)) -20px #0000, calc(-9*var(--w)) -20px #0000;
      }

      81% {
        text-shadow:
          calc(0*var(--w)) -20px #0000, calc(-1*var(--w)) -20px #0000, calc(-2*var(--w)) -20px #0000, calc(-3*var(--w)) 0 #000, calc(-4*var(--w)) -20px #0000,
          calc(-5*var(--w)) -20px #0000, calc(-6*var(--w)) -20px #0000, calc(-7*var(--w)) -20px #0000, calc(-8*var(--w)) -20px #0000, calc(-9*var(--w)) -20px #0000;
      }

      90% {
        text-shadow:
          calc(0*var(--w)) -20px #0000, calc(-1*var(--w)) -20px #0000, calc(-2*var(--w)) -20px #0000, calc(-3*var(--w)) -20px #0000, calc(-4*var(--w)) -20px #0000,
          calc(-5*var(--w)) -20px #0000, calc(-6*var(--w)) -20px #0000, calc(-7*var(--w)) -20px #0000, calc(-8*var(--w)) -20px #0000, calc(-9*var(--w)) -20px #0000;
      }
    }
  </style>

</head>

<body class="align-items-center bg-dark bg-gif3">

  <br><br>

  <!-- Loader Wrapper -->
  <div id="loader-wrapper">
    <div class="loader"></div>
  </div>


  <!-- Home link, centered horizontally -->
  <div class="center-link">
    <a class="btn btn-sm px-4 mt-4 btn-outline-primary" aria-current="page" href="/"><i class="fa fa-home"></i> Home</a>
  </div>

  <div class="d-flex justify-content-center align-items-center mt-4">
    <div class="card fixed-width-card p-4 rounded-3 border-primary">
      <main class="form-signin w-100 m-auto">
        <form method="POST" action="{{ route('login.post') }}">
          @csrf
          <img src="{{asset('images/logo_pt.png')}}" class="rounded-3" style="width: 180px;">
          <h1 class="h5 mb-3 ms-1 text-muted">Customer Sign In</h1>
          <hr>

          <div class="">
            @if(session('success_logout'))
        <div class="alert alert-success" role="alert">
          {{ session('success_logout') }}
        </div>
      @endif

            @if(session('error'))
        <div class="alert alert-danger" role="alert">
          {{ session('error') }}
        </div>
      @endif

          </div>

          @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
        </ul>
        </div>
      @endif

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
          <!-- <button class="btn btn-primary w-100 py-2" type="submit">Sign In</button> -->

          <div class="text-center mt-3">
            <button class="btn btn-primary py-2 px-4 rounded-pill w-120" type="submit">
              Sign In
            </button>
          </div>

          <p class="mt-3 text-center">New user? <a href="{{ url('/authentication/customer/sign-up') }}"
              class="text-decoration-none">Sign Up</a></p>
        </form>

      </main>
      <!-- @if ($errors->any())
      <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
      </div>
    @endif -->
    </div>
  </div>



  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Hide loader when page is fully loaded
    window.addEventListener("load", function () {
      const loaderWrapper = document.getElementById("loader-wrapper");
      if (loaderWrapper) {
        loaderWrapper.style.display = "none";
      }
    });
  </script>


</body>

</html>