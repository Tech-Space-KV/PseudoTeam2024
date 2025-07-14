<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PSEUDOTEAM • Upwork-inspired Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --up-green: #0088CC;
            --up-gray: #f8f9fa;
            --up-text: #001e00;
        }

        body {
            padding-top: 72px;
            color: var(--up-text);
        }

        .navbar-up {
            font-weight: 600;
        }

        .navbar-up .navbar-brand span:first-child {
            color: var(--up-green);
        }

        .navbar-up .btn-signup {
            background: var(--up-green);
            color: #fff;
            font-weight: 600;
        }

        .hero {
            padding: 4rem 0;
            background: var(--up-gray);
        }

        .hero h1 {
            font-size: 2.8rem;
            font-weight: bold;
        }

        .search-bar {
            margin: 2rem 0;
        }

        .features .card {
            border: none;
            transition: transform 0.2s;
        }

        .features .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .testimonial {
            background: #fff;
            padding: 3rem 0;
        }

        .cta-banner {
            background: var(--up-green);
            color: #fff;
            text-align: center;
            padding: 3rem 1rem;
        }

        .footer {
            background: #f1f3f5;
            padding: 2rem 0;
        }

        .footer a {
            color: var(--up-text);
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .contact-us input,
        .contact-us textarea {
            border-radius: 0.5rem;
            box-shadow: none;
        }

        .contact-us .btn {
            background-color: var(--up-green);
            border: none;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top navbar-up shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#"><span>Pseudo</span>Team</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navCollapse" >
               <!-- <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
                </ul> -->
                <div class="d-flex">
                    <a href="{{ route('auth.sp.sign_in') }}" class="nav-link me-3">Sign in</a>
                    <a href="{{ route('auth.sp.sign_up') }}" class="btn btn-signup">Sign up</a>
                </div>
            </div>
        </div>
    </nav>


    <section class="hero text-center bg-primary text-light">
        <div class="container">
            <h1>Work smart, not hard. Join PseudoTeam</h1>
            <p class="lead mt-3">and turn your skills into consistent income—minus the freelancing chaos.</p>
            <a href="{{ route('auth.sp.sign_up') }}" class="btn btn-outline-light btn-lg mt-3">Become a Service Partner</a>


            <form class="search-bar mx-auto" style="max-width:600px;">
                <div class="input-group shadow-sm">
                    <input type="text" class="form-control form-control-lg" placeholder="Search for projects">
                    <button class="btn btn-light px-4" type="submit">Search</button>
                </div>
            </form>
        </div>
    </section>


    <section class="features py-5">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5>End-to-End Project Management</h5>
                        <p>Pseudo-managers handle the full project lifecycle.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5>Milestone-Focused Freelancing</h5>
                        <p>Freelancers only focus on delivering their assigned milestones or tasks.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5>Clear Communication Process</h5>
                        <p>No direct back-and-forth with clients = no miscommunication.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="contact-us py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Contact Us</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control" id="message" rows="5"
                                placeholder="Type your message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg px-5">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>



    <section class="testimonial">
        <div class="container">
            <h2 class="text-center mb-4">Why Us?</h2>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner text-center">
                    <div class="carousel-item active">
                        <blockquote class="blockquote">
                            <p>"Guaranteed Project Ownership and Clarity"</p>
                            <footer class="blockquote-footer">Freelancers (called Authorized Service Partners - ASPs)
                                <br> don’t have to chase vague project briefs or unclear clients.
                            </footer>
                        </blockquote>
                    </div>
                    <div class="carousel-item">
                        <blockquote class="blockquote">
                            <p>"No Direct Client Hassles"</p>
                            <footer class="blockquote-footer">ASPs focus purely on delivery—no need to pitch to clients,
                                <br> send countless proposals, or deal with scope creep.
                            </footer>
                        </blockquote>
                    </div>
                    <div class="carousel-item">
                        <blockquote class="blockquote">
                            <p>"Timely and Verified Payments"</p>
                            <footer class="blockquote-footer">Payments are milestone-based and released only <br> after
                                manager approval—ensuring transparent and fair payments.</footer>
                        </blockquote>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>


    <section class="cta-banner">
        <div class="container">
            <h2>Work in a Safe, Protected Environment</h2>
            <button class="btn btn-light btn-lg mt-3">Join Today</button>
        </div>
    </section>


    <!-- <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col mb-3">

                    <p class="text-body-secondary"><img src="{{ asset('images/logopt.png') }}" class="rounded-3"
                            style="width: 120px"></p>
                    <p class="text-body-secondary">&copy; 2024 PseudoTeam</p>
                </div>

                <div class="col-md-4">
                    <h6>Company</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6>Social</h6>
       
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="bi bi-instagram"></i> Instagram</a></li>
                        <li><a href="#"><i class="bi bi-facebook"></i> Facebook</a></li>
                        <li><a href="#"><i class="bi bi-twitter-x"></i> Twitter</a></li>
                        <li><a href="#"><i class="bi bi-linkedin"></i> LinkedIn</a></li>
                    </ul>

                </div>
                <div class="col-md-4">
                    <h6>Terms</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms and conditions</a></li>
                        <li><a href="#">Copyright Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer> -->

    <footer class="footer bg-light py-4">
        <div class="container">
            <div class="row">
                <!-- Logo and copyright -->
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('images/logopt.png') }}" class="rounded-3 mb-2" style="width: 120px" alt="Logo">
                    <p class="text-body-secondary mb-0">&copy; 2024 PseudoTeam</p>
                </div>

                <!-- Company Links -->
                <div class="col-md-2 mb-3">
                    <h6 class="fw-bold">Company</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-secondary">Home</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary">Services</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary">About</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary">Contact Us</a></li>
                        <li><a href="{{ url('/') }}" class="text-decoration-none text-secondary">Customer</a></li>
                    </ul>
                </div>

                <!-- Social Links -->
                <div class="col-md-3 mb-3">
                    <h6 class="fw-bold">Social</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-secondary"><i
                                    class="bi bi-instagram me-2"></i>Instagram</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary"><i
                                    class="bi bi-facebook me-2"></i>Facebook</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary"><i
                                    class="bi bi-twitter-x me-2"></i>Twitter</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary"><i
                                    class="bi bi-linkedin me-2"></i>LinkedIn</a></li>
                    </ul>
                </div>

                <!-- Terms Links -->
                <div class="col-md-3 mb-3">
                    <h6 class="fw-bold">Terms</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-secondary">Privacy Policy</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary">Terms and Conditions</a></li>
                        <li><a href="#" class="text-decoration-none text-secondary">Copyright Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>