
<nav class="navbar navbar-expand-lg navhide" style="background-color: rgba(21, 21, 21, 0.812); backdrop-filter: blur(30px);">
  <div class="container-fluid px-4">
    <!-- Logo -->
    {{-- <a class="navbar-brand" href="#">
      <img src="https://upload.wikimedia.org/wikipedia/commons/3/3e/OYO_Rooms_logo.svg" alt="OYO Logo" />
    </a> --}}
{{-- 
    <img src="{{asset ('images/logopt.png')}}" class="me-2" style="width: 120px;" /> --}}

    <!-- Toggler for Mobile -->
    {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> --}}

    <!-- Menu Items -->
    <div class="collapse navbar-collapse" id="oyo">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 d-flex align-items-center">
        <li class="nav-item text-center">
          <div class="nav-icon"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
          <div class="title">Authorised Service Partner</div>
          <div class="subtitle">Backed by 1000+ Partners</div>
        </li>
        <div class="nav-divider d-none d-lg-block"></div>
        <li class="nav-item text-center">
          <div class="nav-icon"><i class="fa-solid fa-briefcase"></i></div>
          <div class="title">PseduoTeam for Business</div>
          <div class="subtitle">Trusted by 500+ Corporates</div>
        </li>
         <div class="nav-divider d-none d-lg-block"></div>
        <li class="nav-item text-center">
          <div class="nav-icon"><i class="fa-solid fa-map"></i></div>
          <div class="title">Location Agnostic</div>
          <div class="subtitle">Partners available Globally</div>
        </li>
        <div class="nav-divider d-none d-lg-block"></div>
        <li class="nav-item text-center">
          <div class="nav-icon"><i class="fa-solid fa-building"></i></div>
          <div class="title">Get Critical Hardwares</div>
          <div class="subtitle">Get critical hardwares on a click</div>
        </li>
        <div class="nav-divider d-none d-lg-block"></div>
        <li class="nav-item text-center">
          <div class="nav-icon"><i class="fa-solid fa-gear"></i></div>
          <div class="title">Get IT Services Anywhere</div>
          <div class="subtitle">Delivering IT Services Globally</div>
        </li>
        <div class="nav-divider d-none d-lg-block"></div>
        <li class="nav-item text-center">
          <div class="nav-icon"><i class="fa-solid fa-phone"></i></div>
          <div class="title">+91 98101 44659</div>
          <div class="subtitle">We are a Call Away</div>
        </li>
        <div class="nav-divider d-none d-lg-block"></div>
        <li class="nav-item text-center">
          <div class="nav-icon"><i class="fa-solid fa-desktop"></i></div>
          <div class="title">Stack Applications</div>
          <div class="subtitle">Get our app solutions</div>
        </li>
      </ul>

      <!-- Right side -->
      <div class="d-flex align-items-center gap-3">
        {{-- <div class="d-flex align-items-center">
          <i class="fa-solid fa-globe me-1"></i>
          <select class="form-select form-select-sm border-0">
            <option selected>English</option>
            <option>Hindi</option>
          </select>
        </div> --}}
        <div class="d-flex align-items-center">
          {{-- <i class="fa-solid fa-user-circle me-1"></i>
          <a href="#" class="text-decoration-none fw-semibold">Login / Signup</a> --}}
        </div>
      </div>
    </div>
  </div>
</nav>


<nav class="navbar navbar-expand-lg navbar-dark px-2 sticky-top px-4"
        style="background-color: rgba(21, 21, 21, 0.812); backdrop-filter: blur(30px);">
        <div class="container-fluid">
            <img src="{{asset ('images/logopt.png')}}" class="me-2" style="width: 120px;" /> 
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
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
                    {{-- <a href="" style="text-decoration: none"><li class="nav-item">
                        <form class="d-flex nav-link nav-text" role="search">
                            <div class="input-group">
  <input type="text" class="form-control form-control-sm" placeholder="Search a service here" aria-label="Search a service here" aria-describedby="button-addon2">
  <button class="btn btn-sm btn-outline-secondary" type="button" id="button-addon2">&#128269;</button>
</div>
                        </form>
                    </li></a> --}}

                </ul>

                <span class="navbar-text">
                    <a class="nav-link nav-text px-4 glow-text" href="#" {{--data-bs-toggle="modal" data-bs-target="#exampleModal"--}}>Get Critical Spares & IT Services</a>
                </span>
                <span class="navbar-text">
                    <a class="btn btn-outline-light px-4" onmouseover="this.style.color='black';"
                        onmouseout="this.style.color='white';" href="{{ url('/authentication/customer/sign-in') }}">Manage Project</a>
                </span>
            </div>
        </div>
    </nav>