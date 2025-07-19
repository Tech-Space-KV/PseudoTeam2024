<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PSEUDOTEAM • Upwork-inspired Landing Page</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <style>
        :root {
            --up-green: #0088CC;
            --up-dark: #005bb5;
            --up-gray: #f8f9fa;
            --up-text: #001e00;
            --font-primary: 'Poppins', sans-serif;
        }

        body {
            font-family: var(--font-primary);
            color: var(--up-text);
            padding-top: 72px;
            background-color: #fff;
        }

        h1, h2, h5 {
            font-weight: 700;
        }

        .btn-signup {
            background-color: var(--up-green);
            color: #fff;
            font-weight: 600;
            border-radius: 30px;
            padding: 0.6rem 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 136, 204, 0.3);
            transition: all 0.3s ease;
        }

        .btn-signup:hover {
            background-color: var(--up-dark);
            box-shadow: 0 6px 16px rgba(0, 91, 181, 0.4);
            transform: translateY(-2px);
        }

        .hero {
            background: linear-gradient(to right, #0088cc, #006ec4);
            color: white;
            padding: 5rem 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            line-height: 1.3;
        }

        .search-bar .form-control {
            border-radius: 50px 0 0 50px;
            padding-left: 1.5rem;
            height: 56px;
            border: none;
        }

        .search-bar .btn {
            border-radius: 0 50px 50px 0;
            height: 56px;
        }

        .features .card {
            border: none;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
            background-color: #ffffff;
        }

        .features .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
        }

        .features .card i {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--up-green);
        }

        .testimonial blockquote {
            font-size: 1.2rem;
            font-style: italic;
            margin: 0 auto;
            max-width: 600px;
        }

        .testimonial .blockquote-footer {
            margin-top: 0.8rem;
            font-size: 0.95rem;
            color: #555;
        }

        .cta-banner {
            background: linear-gradient(to right, #006ec4, #005bb5);
            color: #fff;
            padding: 4rem 1rem;
            text-align: center;
        }

        .footer {
            background: #f8f9fa;
            padding-top: 2rem;
        }

        .footer a {
            color: var(--up-text);
            transition: color 0.3s ease;
            text-decoration: none;
        }

        .footer a:hover {
            color: var(--up-green);
        }

        .contact-us input,
        .contact-us textarea {
            border-radius: 0.5rem;
            box-shadow: none;
            border: 1px solid #ced4da;
        }

        .contact-us .btn {
            background-color: var(--up-green);
            border: none;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 30px;
            transition: background 0.3s ease;
        }

        .contact-us .btn:hover {
            background-color: var(--up-dark);
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><span class="text-primary">Pseudo</span>Team</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navCollapse">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('auth.sp.sign_in') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                        Log In
                    </a>
                    <a href="{{ route('auth.sp.sign_up') }}" class="btn btn-primary btn-sm rounded-pill">
                        Sign Up
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero" data-aos="fade-up">
        <div class="container">
            <h1>Work smart, not hard. Join PseudoTeam</h1>
            <p class="lead mt-3">Turn your skills into consistent income—minus the freelancing chaos.</p>
            <a href="{{ route('auth.sp.sign_up') }}" class="btn btn-signup btn-lg mt-3">Become a Service Partner</a>

            <form class="search-bar mx-auto mt-4" style="max-width:600px;">
                <div class="input-group shadow-sm">
                    <input type="text" class="form-control form-control-lg" placeholder="Search for projects">
                    <button class="btn btn-light px-4" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="features py-5" data-aos="fade-up">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="card p-4">
                        <i class="bi bi-kanban"></i>
                        <h5>End-to-End Project Management</h5>
                        <p>Pseudo-managers handle the full project lifecycle.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <i class="bi bi-puzzle"></i>
                        <h5>Milestone-Focused Freelancing</h5>
                        <p>Focus only on tasks you're assigned. No scope creep.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <i class="bi bi-chat-dots"></i>
                        <h5>Clear Communication</h5>
                        <p>No direct back-and-forth with clients = no miscommunication.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIAL -->
    <section class="testimonial py-5 bg-white" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center mb-4">Why Us?</h2>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner text-center">
                    <div class="carousel-item active">
                        <blockquote class="blockquote">
                            <p>"Guaranteed Project Ownership and Clarity"</p>
                            <footer class="blockquote-footer">No vague briefs or chasing clients.</footer>
                        </blockquote>
                    </div>
                    <div class="carousel-item">
                        <blockquote class="blockquote">
                            <p>"No Direct Client Hassles"</p>
                            <footer class="blockquote-footer">Just deliver—no pitching or proposal spam.</footer>
                        </blockquote>
                    </div>
                    <div class="carousel-item">
                        <blockquote class="blockquote">
                            <p>"Timely and Verified Payments"</p>
                            <footer class="blockquote-footer">Milestone-based, manager-approved payouts.</footer>
                        </blockquote>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-banner" data-aos="fade-up">
        <div class="container">
            <h2>Work in a Safe, Protected Environment</h2>
            <a href="{{ route('auth.sp.sign_up') }}" class="btn btn-light btn-lg mt-3">Join Today</a>
        </div>
    </section>

    <!-- CONTACT FORM -->
    <section class="contact-us py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center mb-4">Contact Us</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="{{ route('sp.contact.us') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Type your message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg px-5">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer bg-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('images/logopt.png') }}" class="rounded-3 mb-2" style="width: 120px" alt="Logo">
                    <p class="text-body-secondary mb-0">&copy; 2024 PseudoTeam</p>
                </div>
                <div class="col-md-2 mb-3">
                    <h6 class="fw-bold">Company</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="{{ url('/') }}">Customer</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-3">
                    <h6 class="fw-bold">Social</h6>
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="bi bi-instagram me-2"></i>Instagram</a></li>
                        <li><a href="#"><i class="bi bi-facebook me-2"></i>Facebook</a></li>
                        <li><a href="#"><i class="bi bi-twitter-x me-2"></i>Twitter</a></li>
                        <li><a href="#"><i class="bi bi-linkedin me-2"></i>LinkedIn</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-3">
                    <h6 class="fw-bold">Terms</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms and Conditions</a></li>
                        <li><a href="#">Copyright Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap + AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>