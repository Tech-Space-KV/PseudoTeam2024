<nav class="navbar navbar-expand-lg navbar-dark px-2 sticky-top px-4"
  style="background-color: rgba(21, 21, 21, 0.812); backdrop-filter: blur(30px);">
  <div class="container-fluid">
    <a href="{{ route('home') }}"><img src="{{asset('images/logo_pt3.png')}}" class="me-2" style="width: 160px;" /></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
        <!-- <li class="nav-item">
          <a class="nav-link nav-text" href="#contactus">Our Products</a>
        </li> -->
      </ul>
      <!-- <span class="navbar-text d-flex flex-column align-items-center me-3">
  <span style="color: #fff; font-size: 0.9rem;">📞Contact us: +91-9876543210</span>
  <a class="nav-link nav-text px-4 glow-text" href="{{ route('ask_for_quote') }}">
    Get Critical Spares & IT Services
  </a>
</span> -->
      <span class="navbar-text contactnumber">
        <a class="px-4" style="text-decoration:none;" href="#">📞 Contact us: +91-9810144659</a>
      </span>

      <span class="navbar-text">
        <a class="btn px-4 rounded-pill  btn-primary "
          onmouseout="this.style.color='white';" href="{{ url('/authentication/customer/sign-in') }}">Manage Project</a>
      </span>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark px-2 px-4"
  style="background-color: rgba(21, 21, 21, 0.812); backdrop-filter: blur(30px);">
  <div class="container-fluid">
    <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3 mx-auto w-50">
      <a href="{{ route('ask_for_quote') }}" class="w-100" style="text-decoration:none;">
        <div class="input-group mb-3"><input id="" type="text" autocomplete="off"
            class="form-control border border-primary border-2 fw-bold rounded-pill" placeholder="Search IT Services & Critical Spares"
            aria-label="Recipient's username" aria-describedby="button-addon2">
          <button class="btn px-4 rounded-pill border border-primary border-2 btn-outline-primary ms-2" type="button"
            id="button-addon2"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
      </a>
    </div> -->

    <div class="d-grid gap-2 mb-4 mb-lg-3 mx-auto col-12 col-lg-7 col-md-12 col-sm-12">
  <form action="{{ route('ask_for_quote') }}" method="GET" class="row g-2 w-100">
    
    <!-- Input -->
    <div class="col-10 col-md-10">
      <input type="text" name="search"
        class="form-control border border-primary border-2 fw-bold rounded-pill w-100"
        placeholder="Search..."
        id="searchInput"
        aria-label="Search"/>
    </div>

    <!-- Button -->
    <div class="col-2 col-md-2 d-grid">
      <button type="submit" 
        class="btn rounded-pill border border-primary border-2 btn-outline-primary w-100">
        <i class="fa fa-search" aria-hidden="true"></i>
      </button>
    </div>

  </form>
</div>


  </div>
</nav>



<script>
  const input = document.getElementById("searchInput");
  const text = "Search IT Services & Critical Spares...";
  let i = 0;

  function typeEffect() {
    if (i < text.length) {
      input.setAttribute("placeholder", text.substring(0, i + 1));
      i++;
      setTimeout(typeEffect, 20); // typing speed (100ms per character)
    } else {
      // Restart effect after a pause
      setTimeout(() => {
        i = 0;
        input.setAttribute("placeholder", "");
        typeEffect();
      }, 2000); // wait 2s before restarting
    }
  }

  typeEffect();
</script>


<script>
  document.addEventListener('click', function (event) {
  const navbarCollapse = document.querySelector('.navbar-collapse');
  const isClickInside = navbarCollapse.contains(event.target) || event.target.closest('.navbar-toggler');

  if (!isClickInside && navbarCollapse.classList.contains('show')) {
    const bsCollapse = new bootstrap.Collapse(navbarCollapse, { toggle: true });
  }
});


</script>