<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/web/service_auth.css') }}">
    <title>PseudoTeam</title>

   <style>
        .bg-gif3 {
            background: url('{{ asset('images/bg_pt5.png') }}') no-repeat center center;
            background-size: cover;
            position: relative;
            min-height: 100vh;
            z-index: 0;
        }
    </style>

  </head>
  <body class="align-items-center bg-dark bg-gif3">

    <!-- Home link, centered horizontally -->
    <div class="center-link">
      <a class="btn btn-sm px-4 mt-4 btn-outline-primary" aria-current="page" href="/"><i class="fa fa-home"></i> Home</a>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-4">
      <div class="card fixed-width-card p-4 rounded-3 border-primary">    
        <main class="form-signin w-100 m-auto">
          <form action="{{ route('auth.sp.sign_up.post') }}" method="POST"> 
            @csrf
            <img src="/images/logo_pt.png" class="rounded-3" style="width: 180px;">
            <h1 class="h5 mb-3 ms-1 text-muted">Service Partner Sign Up</h1>
            <hr>
            <div class="form-floating mb-3 mt-3">
              <input type="text" class="form-control" id="floatingInput" name="name" placeholder="name@example.com">
              <label for="floatingInput">Full Name</label>
            </div>
            <div class="form-floating mb-3 mt-3">
              <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
              <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
              <input type="phone" class="form-control" id="floatingPassword" name="contact" placeholder="Contact">
              <label for="floatingPassword">Contact</label>
            </div>
            <button class="btn btn-primary mt-3 w-100 py-2" type="submit">Sign Up</button>
            
            <p class="mt-3 text-center">Already a user? <a href="{{ url('/authentication/service-partner/sign-in') }}" class="text-decoration-none">Sign In</a></p>
          </form>
        </main>
      </div>
    </div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
