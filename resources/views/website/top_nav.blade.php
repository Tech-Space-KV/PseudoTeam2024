<nav class="navbar navbar-expand-lg navbar-dark px-2 sticky-top px-4"
  style="background-color: rgba(21, 21, 21, 0.812); backdrop-filter: blur(30px);">
  <div class="container-fluid">
    <a href="{{ route('home') }}"><img src="{{asset('images/logo_pt3.png')}}" class="me-2" style="width: 120px;" /></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
        <li class="nav-item">
          <a class="nav-link nav-text" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-text" href="#services">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-text" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-text" href="#contactus">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-text" href="#contactus">Our Products</a>
        </li>
      </ul>
      <span class="navbar-text d-flex flex-column align-items-center me-3">
  <span style="color: #fff; font-size: 0.9rem;">📞Contact us: +91-9876543210</span>
  <a class="nav-link nav-text px-4 glow-text" href="{{ route('ask_for_quote') }}">
    Get Critical Spares & IT Services
  </a>
</span>

      <span class="navbar-text">
        <a class="btn btn-outline-light px-4" onmouseover="this.style.color='black';"
          onmouseout="this.style.color='white';" href="{{ url('/authentication/customer/sign-in') }}">Manage Project</a>
      </span>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark px-2 px-4 xs-hide"
  style="background-color: rgba(21, 21, 21, 0.812); backdrop-filter: blur(30px);">
  <div class="container-fluid">
    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3 mx-auto w-50">
                            <a href="{{ route('ask_for_quote') }}" class="w-100" style="text-decoration:none;"><div class="input-group mb-3"><input id="searchInput" type="text" autocomplete="off" class="form-control border border-primary border-2 fw-bold" placeholder="Search critical spares here..." aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn  border border-primary border-2 btn-outline-primary" type="button" id="button-addon2">Search</button>
                          </div></a>
</div>
</div>
</nav>