<nav class="navbar navbar-expand-lg navbar-dark fixed-top px-2"
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
                        <a class="nav-link active nav-text" aria-current="page" href="#">Home</a>
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
                        <form class="d-flex nav-link nav-text" role="search">
                            <input class="form-control form-control-sm me-2" type="search"
                                placeholder="Search a service here"; aria-label="Search" />
                            <button class="btn btn-sm btn-outline-light" type="submit">&#128269;</button>
                        </form>
                    </li>

                </ul>

                <span class="navbar-text">
                    <a class="nav-link nav-text px-4 glow-text" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Ask for a Quote</a>
                </span>
                <span class="navbar-text">
                    <a class="btn btn-outline-light px-4" onmouseover="this.style.color='black';"
                        onmouseout="this.style.color='white';" href="{{ url('/authentication/customer/sign-in') }}">Manage Project</a>
                </span>
            </div>
        </div>
    </nav>