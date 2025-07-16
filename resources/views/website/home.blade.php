<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>PseudoTeam</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/cover/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/web/website_home2.css') }}">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">



    <!-- Custom CSS -->
    <style>
        /* SECTION 1: HERO with video background */
        .hero-section {
            position: relative;
            height: 100vh;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            overflow: hidden;
        }
@media (max-width: 1425px) {
    .hero-section {
margin-top: 15%;
        height: 50vh;
    }
  }

  @media (max-width: 480px) {
    .hero-section {
      margin-top: 15%;
        height: 30vh;
    }
  }


        .bg-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .nav-masthead .nav-link {
            color: rgba(255, 255, 255, 0.75);
            border-bottom: 0.25rem solid transparent;
            transition: all 0.3s ease;
        }

        .nav-masthead .nav-link:hover {
            color: #fff;
            border-bottom-color: rgba(255, 255, 255, 0.5);
        }

        /* SECTION 2: scrollable content */
        .content-section {
            padding: 4rem 1rem;
            background-color: #f8f9fa;
            color: #333;
        }

        .nav-masthead img {
            width: 150px;
        }
    </style>

    <style>
        .card-glass {
            color: #fff;
            background-color: rgba(188, 205, 255, 0.149);
            backdrop-filter: blur(50px);
        }
    </style>


    <style>
        .marquee-container {
            overflow: hidden;
            white-space: nowrap;
            background: #000000;
            border-top: 2px solid #000000;
            border-bottom: 2px solid #000000;
            position: relative;
        }

        .marquee-track {
            display: flex;
            animation: scroll-left 20s linear infinite;
            width: fit-content;
        }

        .feature-item {
            margin: 0 1.5rem;
            font-weight: bold;
            color: #5c5c5c;
            background-color: #dbdbdb;
            padding: 5px 15px;
            border-radius: 20px;
            white-space: nowrap;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-50%);
            }
        }
    </style>

    <style>
        .glow-text {
            color: #fff;
            animation: glowPulse 2s infinite ease-in-out;
        }

        @keyframes glowPulse {
            0% {
                text-shadow: 0 0 0px #00f7ff;
                color: #ccc;
            }

            50% {
                text-shadow: 0 0 10px #00f7ff, 0 0 20px #00f7ff, 0 0 30px #00f7ff;
                color: #fff;
            }

            100% {
                text-shadow: 0 0 0px #00f7ff;
                color: #ccc;
            }
        }
    </style>


    <style>
        .glow-line {
            position: fixed;
            top: 0;
            left: 0;
            width: 4px;
            height: 100vh;
            background: linear-gradient(to bottom, #ffffff, rgb(177, 177, 177), #ffffff);
            box-shadow: 0 0 20px #ffffff, 0 0 40px #ffffff;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            z-index: 1000;
        }

        .glow-line.active {
            opacity: 1;
        }

        .glow-line {
            transition: background 0.5s ease, box-shadow 0.5s ease;
        }
    </style>


</head>


<body style="background-color: black;">


    @include('website.top_nav')

    <!-- Section 1: Fullscreen Hero with Background Video -->
    <section class="hero-section s0">



        <video autoplay muted loop playsinline class="bg-video">
            <source src="{{ asset('images/bgrd6.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="container">

            <main>

            </main>
        </div>
    </section>


    <br>
    <br>
    <!-- Section 2: Scrollable Content -->
    <div class="glow-line" id="magic-line"></div>


    <!-- Section 2: Scrollable Content -->
    <section class="content-section s2" style="background-color: black;">
        <div class="container px-4 pt-5">
            <center>
                <h2 class="pb-2 border-bottom text-light display-2">JOIN US</h2>
            </center>

            <div class="container my-5">
                <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3  shadow-lg bg-pt">
                    <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                        <h1 class="display-4 fw-bold lh-1 text-light">Your behind-the-scenes power team.</h1>
                        <p class="lead text-light">We manage everything behind the scenes through our expert
                            pseudo-managers, so you don’t have to coordinate with multiple service partners. You get a
                            single, streamlined experience with full visibility into progress, while we handle the
                            complexity.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                            <a type="button" class="btn btn-outline-light btn-lg px-4 me-md-2 fw-bold"
                                href="{{ url('/authentication/service-partner/sign-in') }}">Begin
                                Here<i class="bi bi-caret-right-fill"></i></a>
                            <!-- <button type="button" class="btn btn-outline-secondary btn-lg px-4">Default</button> -->
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                        <img class="rounded-lg-3" src="{{ asset('images/cstmr.jpg') }}" alt="" width="425">
                    </div>
                </div>
            </div>



            <div class="container my-5">
                <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3  shadow-lg bg-yl">
                    <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                        <img class="rounded-lg-3" src="{{ asset('images/puzzle.jpg') }}" alt="" width="425">
                    </div>
                    <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                        <h1 class="display-4 fw-bold lh-1 text-light">The Visionaries Who Trust Us to Deliver.</h1>
                        <p class="lead text-light">Pseudoteam customers are ambitious entrepreneurs, startups, and
                            growing businesses who value quality, accountability, and results. With Pseudoteam, they
                            gain access to a structured execution model where our dedicated project managers handle
                            every detail, coordinate with expert service partners, and ensure timely delivery.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                            <a type="button" class="btn btn-outline-light btn-lg px-4 me-md-2 fw-bold"
                                href="{{ url('/authentication/service-partner/sign-in') }}">Begin
                                Here<i class="bi bi-caret-right-fill"></i></a>
                            <!-- <button type="button" class="btn btn-outline-secondary btn-lg px-4">Default</button> -->
                        </div>
                    </div>

                </div>
            </div>



            <div class="container my-5">
                <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3  shadow-lg bg-or">
                    <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                        <h1 class="display-4 fw-bold lh-1 text-light">The Experts Behind Every Successful Delivery.
                        </h1>
                        <p class="lead text-light">Pseudoteam's service partners are skilled professionals and trusted
                            specialists across diverse domains—handpicked for their expertise, reliability, and
                            commitment to quality. Every project is guided by a dedicated project manager, ensuring that
                            service partners can focus on doing what they do best and together, we form a powerful
                            collaboration.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                            <a type="button" class="btn btn-outline-light btn-lg px-4 me-md-2 fw-bold"
                                href="{{ url('/authentication/service-partner/sign-in') }}">Begin
                                Here<i class="bi bi-caret-right-fill"></i></a>
                            <!-- <button type="button" class="btn btn-outline-secondary btn-lg px-4">Default</button> -->
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                        <img class="rounded-lg-3" src="{{ asset('images/csstmr.jpg') }}" alt="" width="425">
                    </div>
                </div>
            </div>

            <!--
      <main>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
          <div class="col d-flex align-items-start"> <svg class="bi text-body-secondary flex-shrink-0 me-3"
              width="1.75em" height="1.75em" aria-hidden="true">
              <use xlink:href="#bootstrap"></use>
            </svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Featured title</h3>
              <p>Paragraph of text beneath the heading to explain the heading.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start"> <svg class="bi text-body-secondary flex-shrink-0 me-3"
              width="1.75em" height="1.75em" aria-hidden="true">
              <use xlink:href="#cpu-fill"></use>
            </svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Featured title</h3>
              <p>Paragraph of text beneath the heading to explain the heading.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start"> <svg class="bi text-body-secondary flex-shrink-0 me-3"
              width="1.75em" height="1.75em" aria-hidden="true">
              <use xlink:href="#calendar3"></use>
            </svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Featured title</h3>
              <p>Paragraph of text beneath the heading to explain the heading.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start"> <svg class="bi text-body-secondary flex-shrink-0 me-3"
              width="1.75em" height="1.75em" aria-hidden="true">
              <use xlink:href="#home"></use>
            </svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Featured title</h3>
              <p>Paragraph of text beneath the heading to explain the heading.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start"> <svg class="bi text-body-secondary flex-shrink-0 me-3"
              width="1.75em" height="1.75em" aria-hidden="true">
              <use xlink:href="#speedometer2"></use>
            </svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Featured title</h3>
              <p>Paragraph of text beneath the heading to explain the heading.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start"> <svg class="bi text-body-secondary flex-shrink-0 me-3"
              width="1.75em" height="1.75em" aria-hidden="true">
              <use xlink:href="#toggles2"></use>
            </svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Featured title</h3>
              <p>Paragraph of text beneath the heading to explain the heading.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start"> <svg class="bi text-body-secondary flex-shrink-0 me-3"
              width="1.75em" height="1.75em" aria-hidden="true">
              <use xlink:href="#geo-fill"></use>
            </svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Featured title</h3>
              <p>Paragraph of text beneath the heading to explain the heading.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start"> <svg class="bi text-body-secondary flex-shrink-0 me-3"
              width="1.75em" height="1.75em" aria-hidden="true">
              <use xlink:href="#tools"></use>
            </svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Featured title</h3>
              <p>Paragraph of text beneath the heading to explain the heading.</p>
            </div>
          </div>
        </div>

      </main>
     -->
        </div>
        <br>
        <span id="services"></span>
        <div class="marquee-container py-2 mt-5">
            <div class="marquee-track">
                <!-- Repeated content twice to create seamless effect -->
                <div class="d-flex">
                    <span class="feature-item">Dedicated Project Ownership</span>
                    <span class="feature-item">Managers as Intermediaries</span>
                    <span class="feature-item">Transparent Project Tracking</span>
                    <span class="feature-item">Flexibility Without Micromanagement</span>
                    <span class="feature-item">Quality Control & Review</span>
                    <span class="feature-item">Time & Cost Efficiency</span>
                    <span class="feature-item">Centralized Communication</span>
                </div>
                <div class="d-flex">
                    <span class="feature-item">Dedicated Project Ownership</span>
                    <span class="feature-item">Managers as Intermediaries</span>
                    <span class="feature-item">Transparent Project Tracking</span>
                    <span class="feature-item">Flexibility Without Micromanagement</span>
                    <span class="feature-item">Quality Control & Review</span>
                    <span class="feature-item">Time & Cost Efficiency</span>
                    <span class="feature-item">Centralized Communication</span>
                </div>
            </div>
        </div>

    </section>


    <section class="content-section s1" style="background-color: rgb(0, 0, 0);">
        <div class="container px-4 mt-5" id="custom-cards">
            <center>
                <h2 class="pb-2 border-bottom text-light display-2 mt-5">OUR SERVICES</h2>
            </center>
            <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">


                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg card-glass">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                            <i class="bi bi-gear-wide-connected" style="font-size:50px;"></i>
                            <h3 class="pt-5 mb-4 display-6 lh-1 fw-bold">DevOps and Automation</h3>
                            <p>Streamline your operations with DevOps practices and automation tools that improve
                                development speed
                                and reliability.</p>
                            <ul class="d-flex list-unstyled mt-auto">
                                <li class="me-auto">
                                    <small><a href="loginpage" class="btn btn-sm btn-outline-light">Get Service <i
                                                class="bi bi-arrow-right-circle"></i></a></small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg card-glass">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                            <i class="bi bi-laptop" style="font-size:50px;"></i>
                            <h3 class="pt-5 mb-4 display-6 lh-1 fw-bold">IT Consulting & Strategy</h3>
                            <p>Our experts provide strategic guidance to align your technology with business objectives,
                                driving
                                digital success.</p>
                            <ul class="d-flex list-unstyled mt-auto">
                                <li class="me-auto">
                                    <small><a href="loginpage" class="btn btn-sm btn-outline-light">Get Service <i
                                                class="bi bi-arrow-right-circle"></i></a></small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg card-glass">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                            <i class="bi bi-hdd-network" style="font-size:50px;"></i>
                            <h3 class="pt-5 mb-4 display-6 lh-1 fw-bold">Network Infra Management</h3>
                            <p>We design, implement, and manage secure network infrastructures to keep your business
                                connected and
                                efficient.</p>
                            <ul class="d-flex list-unstyled mt-auto">
                                <li class="me-auto">
                                    <small><a href="loginpage" class="btn btn-sm btn-outline-light">Get Service <i
                                                class="bi bi-arrow-right-circle"></i></a></small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg card-glass">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                            <i class="bi bi-code-square" style="font-size:50px;"></i>
                            <h3 class="pt-5 mb-4 display-6 lh-1 fw-bold">Software Development</h3>
                            <p>We develop custom software solutions that address specific business needs, enhancing
                                efficiency and
                                productivity.</p>
                            <ul class="d-flex list-unstyled mt-auto">
                                <li class="me-auto">
                                    <small><a href="loginpage" class="btn btn-sm btn-outline-light">Get Service <i
                                                class="bi bi-arrow-right-circle"></i></a></small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg card-glass">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                            <i class="bi bi-cloud" style="font-size:50px;"></i>
                            <h3 class="pt-5 mb-4 display-6 lh-1 fw-bold">Cloud Solution Services</h3>
                            <p>We offer scalable cloud solutions that enhance accessibility, security, and data
                                management for your
                                business.</p>
                            <ul class="d-flex list-unstyled mt-auto">
                                <li class="me-auto">
                                    <small><a href="loginpage" class="btn btn-sm btn-outline-light">Get Service <i
                                                class="bi bi-arrow-right-circle"></i></a></small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg card-glass">
                        <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                            <i class="bi bi-pie-chart" style="font-size:50px;"></i>
                            <h3 class="pt-5 mb-4 display-6 lh-1 fw-bold">Data Analytics Solution</h3>
                            <p>Leverage data insights to make informed business decisions. We provide end-to-end
                                analytics solutions
                                tailored to your needs.</p>
                            <ul class="d-flex list-unstyled mt-auto">
                                <li class="me-auto">
                                    <small><a href="loginpage" class="btn btn-sm btn-outline-light">Get Service <i
                                                class="bi bi-arrow-right-circle"></i></a></small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>



            </div>
            <center>
                <a class="btn btn-outline-light">View More <i class="bi bi-caret-right-fill"></i> </a>
            </center>
        </div>

        <br>

    </section>

    <section class="content-section s3" style="background-color: black;">
        <div class="container px-4 pt-5">
            <center>
                <h2 class="pb-2 border-bottom text-light display-2">ABOUT US</h2>
            </center>
        </div>

        <div class="my-5">
            <div class="p-5 text-center bg-body-tertiary">
                <div class="container py-5">
                    <p class="col-lg-8 mx-auto lead text-light">
                        At PseudoTeam, we simplify project execution for businesses by taking complete ownership from
                        start to finish. We assign a dedicated pseudo-manager who oversees your entire project—breaking
                        it down into clear milestones, managing vetted service partners, and ensuring timely delivery
                        with verified proof at every stage. Our mission is to remove the stress of freelancer
                        coordination, provide real-time progress tracking, and guarantee quality outcomes so you can
                        focus on growing your business while we handle the execution. With PseudoTeam, your project is
                        always in safe, accountable hands.
                    </p>
                </div>
            </div>
        </div>


    </section>



    <section class="content-section s4" style="background-color: #006EC4;">
        <div class="container px-4 pt-5">
            <center>
                <h2 class="pb-2 border-bottom text-light display-2">Contact Us</h2>
            </center>
        </div>

        <div class="container py-5 mx-5 px-5 mx-auto text-light">
            <form class="row g-3 needs-validation" novalidate>

                <div class="col-md-6">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" required>
                    <div class="invalid-feedback">Please enter your name.</div>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                <!-- <div class="col-md-6">
      <label for="phone" class="form-label">Phone Number</label>
      <input type="tel" class="form-control" id="phone" pattern="[0-9]{10}" required>
      <div class="invalid-feedback">Please enter a valid 10-digit phone number.</div>
    </div>

    <div class="col-md-6">
      <label for="subject" class="form-label">Subject</label>
      <input type="text" class="form-control" id="subject" required>
      <div class="invalid-feedback">Please enter the subject.</div>
    </div> -->

                <div class="col-12">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" rows="4" required></textarea>
                    <div class="invalid-feedback">Please enter your message.</div>
                </div>

                <div class="col-12 text-center">
                    <button class="btn btn-light px-5" type="submit">Submit</button>
                </div>
            </form>
        </div>

    </section>


    <div style="background-color:#e6e6e6;">
        <div class=" px-2 ">
            <div class="px-5">
                <div class="container-fluid py-2">
                    <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
                        <div class="col mb-3">

                            <p class="text-body-secondary"><img src="{{ asset('images/logopt.png') }}"
                                    class="rounded-3" style="width: 120px"></p>
                            <p class="text-body-secondary">&copy; 2024 PseudoTeam</p>
                        </div>

                        <div class="col mb-3">

                        </div>

                        <div class="col mb-3">
                            <h5>PseudoTeam</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-secondary">Home</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-secondary">Services</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-secondary">About</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-secondary">Contact Us</a></li>
                                <li class="nav-item mb-2"><a href="{{ url('/partner') }}"
                                        class="nav-link p-0 text-secondary">Partner</a></li>
                               
                            </ul>
                        </div>

                        <div class="col mb-3">
                            <h5>Social</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary"><i
                                            class="fa fa-instagram"></i> Instagram</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary"><i
                                            class="fa fa-facebook"></i> Facebook</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary"><i
                                            class="fa fa-twitter"></i> Twitter</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary"><i
                                            class="fa fa-linkedin"></i> Linked In</a></li>
                            </ul>
                        </div>

                        <div class="col mb-3">
                            <h5>Terms</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-secondary">Privacy Policy</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary">Terms
                                        and Conditions</a></li>
                                <li class="nav-item mb-2"><a href="#"
                                        class="nav-link p-0 text-secondary">Copyright Policy</a></li>
                            </ul>
                        </div>
                    </footer>

                </div>
            </div>

        </div>
    </div>


    <div class="modal fade my-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-light" id="exampleModalLabel">Inquire Here</h5>
                    <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container text-primary">
                        <form class="row g-3 needs-validation" novalidate>

                            <div class="col-md-6">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control border-primary" id="name" required>
                                <div class="invalid-feedback">Please enter your name.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="tel" class="form-label">Contact No.</label>
                                <input type="tel" class="form-control border-primary" id="tel" required>
                                <div class="invalid-feedback">Please enter a valid contact.</div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email ID</label>
                                <input type="email" class="form-control border-primary" id="email" required>
                                <div class="invalid-feedback">Please enter a valid contact.</div>
                            </div>

                            <div class="col-12">
                                <label for="message" class="form-label">Your Project Query</label>
                                <textarea class="form-control border-primary" id="message" rows="6" required></textarea>
                                <div class="invalid-feedback">Please enter your message.</div>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary px-5" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script>

    <script>
        window.addEventListener('scroll', () => {
            const glowLine = document.querySelector('.glow-line');
            const section1 = document.querySelector('.s1');
            const section2 = document.querySelector('.s2');
            const section3 = document.querySelector('.s3');
            const section0 = document.querySelector('.s0');
            if (section0.getBoundingClientRect().top < window.innerHeight && section0.getBoundingClientRect()
                .bottom > 0) {
                glowLine.style.background = 'transaparent';
                glowLine.style.boxShadow = '';
                glowLine.classList.remove('active');
            } else if (section1.getBoundingClientRect().top < window.innerHeight && section1.getBoundingClientRect()
                .bottom > 0) {
                glowLine.style.background = 'linear-gradient(to bottom, #ffffff, rgb(199, 199, 199), #ffffff)';
                glowLine.style.boxShadow = '0 0 15px #ffffff, 0 0 25px #ffffff';
                glowLine.classList.add('active');
            } else if (section2.getBoundingClientRect().top < window.innerHeight && section2.getBoundingClientRect()
                .bottom > 0) {
                glowLine.style.background = 'linear-gradient(to bottom, #41ccd6, rgb(18, 93, 192), #41ccd6)';
                glowLine.style.boxShadow = '0 0 15px #41ccd6, 0 0 25px #41ccd6';
                glowLine.classList.add('active');
            } else if (section3.getBoundingClientRect().top < window.innerHeight && section3.getBoundingClientRect()
                .bottom > 0) {
                glowLine.style.background = 'linear-gradient(to bottom, #d1f196, rgb(209, 245, 64), #d1f196)';
                glowLine.style.boxShadow = '0 0 20px #d1f196, 0 0 40px #d1f196';
                glowLine.classList.add('active');
            } else {
                glowLine.classList.remove('active');
            }
        });
    </script>

</body>

</html>
