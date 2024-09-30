<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">
        <img src="{{ asset('images/logo_pt3.png') }}" class="rounded-3" style="width: 120px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contactus">Contact Us</a>
          </li>
        </ul>
        <form class="d-flex">
            <a href="{{ url('/authentication/service-partner/sign-in') }}" class="btn btn-outline-light me-2" style="width: 180px" type="submit">Find Work <i class="material-icons" style="font-size:14px">work</i></a>  
            <a href="{{ url('/authentication/customer/sign-in') }}" class="btn btn-light" style="width: 180px" type="submit">Sign In <i class="material-icons" style="font-size:14px">login</i></a>
        </form>
      </div>
    </div>
  </nav>


  {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="#">Home</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> --}}



