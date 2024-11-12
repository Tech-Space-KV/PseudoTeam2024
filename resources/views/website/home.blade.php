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
    <link rel="stylesheet" href="{{ asset('css/web/website_home2.css') }}">
    <title>PseudoTeam</title>
  
    

</head>

  <body class="bg-dark" onload="typeWriter()">


<div class="bg-gif section-animate" id="section-animate1">
    <div class="content px-2" style="height: 100vh">
   

      @include('website.top_nav')


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


      <div class="p-5 bg-body-tertiary">
        <div class="container-fluid py-5">
            <br>
          <h3 class="fw-bold text-light display-1 neon-yellow-border-text"><span id="demo"></span></br><span id="demo2"></span></h3>
          <h5 class="col-md-4 text-light neon-yellow-border-text">Let us handle your projects while you focus on growing your business.</h5>
          <a class="btn btn-outline-light btn-lg mt-2" href="authentication/customer/sign-in" style="width: 260px" type="button">Start Project <i class="material-icons" style="font-size:14px">arrow_forward</i></a>
        <br>
        </div>
      </div>  
    </div>
</div>


<div class="bg-light section-animate" id="section-animate1">
    {{-- <nav class="navbar navbar-expand-lg navbar-dark px-5 bg-dark">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link">As used by:</a>
            </li>
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

    <div class="px-2" >
<section id="services"></section>
    <div class="p-5 bg-body-tertiary">
      <div class="container-fluid py-5">
        <p class="display-3 text-center text-secondary">Offering a diverse range of IT services, tailored to meet the needs of various industries</p>
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-4">
              <!-- Card 1 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt4.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">DevOps & Automation</h5>
                    <p class="card-text">Streamline your operations with DevOps practices and automation tools that improve development speed and reliability.</p>
                  </div>
                </div>
              </div>
              <!-- Card 2 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt3.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Artificial Intelligence & Machine Learning</h5>
                    <p class="card-text">Unlock the potential of AI and ML to automate tasks, predict trends, and enhance customer experiences for your business.</p>
                  </div>
                </div>
              </div>
              <!-- Card 3 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt2.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">IT Consulting & Strategy</h5>
                    <p class="card-text">Our experts provide strategic guidance to align your technology with business objectives, driving digital success.</p>
                  </div>
                </div>
              </div>
              <!-- Card 4 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Network Infrastructure Management</h5>
                    <p class="card-text">We design, implement, and manage secure network infrastructures to keep your business connected and efficient.</p>
                  </div>
                </div>
              </div>
              <!-- Card 5 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Digital Transformation Consulting</h5>
                    <p class="card-text">Optimize your business processes with our digital transformation strategies, tailored to drive innovation and growth.</p>
                  </div>
                </div>
              </div>
              <!-- Card 6 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt2.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Software Development</h5>
                    <p class="card-text">We develop custom software solutions that address specific business needs, enhancing efficiency and productivity.</p>
                  </div>
                </div>
              </div>
              <!-- Card 7 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt3.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Data Analytics & Business Intelligence</h5>
                    <p class="card-text">Leverage data insights to make informed business decisions. We provide end-to-end analytics solutions tailored to your needs.</p>
                  </div>
                </div>
              </div>
              <!-- Card 8 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt4.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Cloud Solutions</h5>
                    <p class="card-text">We offer scalable cloud solutions that enhance accessibility, security, and data management for your business.</p>
                  </div>
                </div>
              </div>
            </div>

      <div class="row mx-auto mt-4">
        <a href="services" class="btn btn-sm  btn-outline-primary btn-lg mt-2 mx-auto" style="width: 260px" type="button">View More <i class="material-icons" style="font-size:14px">arrow_forward</i></a>
      </button>
    </div>

      </div>
    </div>   

  </div>
</div>

<section id="about"></section>
<div class="bg-gif2 section-animate" id="section-animate1">
  <div class="px-2 py-4" >
    <div class="px-5 bg-body-tertiary">
      <div class="container-fluid py-2">
        <p class="display-3 text-center text-light">PseudoTeam's Essence</p>
      </br>
      
      <div class="container px-4 py-5">
        <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
          <div class="col d-flex flex-column align-items-start gap-2">
            <h2 class="fw-bold text-light">PseudoTeam for a Superior Project Experience</h2>
            <a href="#" class="btn btn-sm btn-outline-light btn-lg">Start Now &gt;&gt;</a>
          </div>
    
          <div class="col">
            <div class="row row-cols-1 row-cols-sm-2 g-4">
              <div class="col d-flex flex-column gap-2 m-2" style="width:280px; background-color:#f24f1c; ">
                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
                </div>
                <h5 class="fw-bold mb-0 text-light"><i class="material-icons">supervisor_account</i> Dedicated Intermediaries</h5>
                <p class="text-light">We act as dedicated intermediaries, ensuring that every project is meticulously managed and delivered to perfection.</p>
              </div>
    
              <div class="col d-flex flex-column gap-2 m-2" style="width:280px; background-color:#80bb00;">
                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
                </div>
                <h5 class="fw-bold mb-0 text-light"><i class="material-icons">view_module</i> Structured Process</h5>
                <p class="text-light">We offer a structured and reliable process, overcoming common freelancing issues like communication breakdowns, inconsistent quality, and missed deadlines.</p>
              </div>
    
              <div class="col d-flex flex-column gap-2 m-2" style="width:280px; background-color:#00a5ef;">
                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
                </div>
                <h5 class="fw-bold mb-0 text-light"><i class="material-icons">perm_data_setting</i> Comprehensive Services</h5>
                <p class="text-light">Our services include detailed project scoping, regular progress updates, quality assurance, and timely delivery to ensure project success.</p>
              </div>
    
              <div class="col d-flex flex-column gap-2  m-2" style="width:280px; background-color:#ffba00;">
                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
                </div>
                <h5 class="fw-bold mb-0 text-light"><i class="material-icons">star</i> Commitment to Excellence</h5>
                <p class="text-light">PseudoTeam’s commitment to excellence and customer satisfaction makes us the ideal choice for a hassle-free and professional project management experience.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

  </br>    
        <div class="row align-items-md-stretch">
          <div class="col-md-6 mt-1">
            <div class="h-100 p-5 text-dark bg-light">
              <h2>Project Owners</h2>
              <p>Elevate your project experience with PseudoTeam. We ensure flawless execution and timely delivery, eliminating common freelancing pitfalls. Trust us to handle your project with precision and professionalism.</p>
              <a href="authentication/customer/sign-in" class="btn btn-outline-dark" type="button">Get Onboard <i class="material-icons" style="font-size:14px">login</i></a>
            </div>
          </div>
          <div class="col-md-6 mt-1">
            <div class="h-100 p-5 text-light bg-secondary">
              <h2>Service Providers</h2>
              <p>Boost your freelancing career with Pseudoteam. Focus on what you do best while we handle client interactions and project management. Join us to work efficiently and get paid promptly!</p>
              <a class="btn btn-outline-light" type="button">Find Work <i class="material-icons" style="font-size:14px">work</i></a>
            </div>
          </div>
        </div>
      </br></br>
      </div>
    </div>   

  </div>
</div>

<section id="contactus"></section>
<div class="section-animate" id="section-animate1">
</br></br></br>
  <p class="display-3 text-center text-light">We’re Here to Help</p>
</br></br>
  <div class="">
    <div class="col-md-6 col-lg-6 mx-auto text-light rounded-3">
    </br>
      <h4 class="mb-3 display-4 fw-bold">Contact Us</h4>
      <form class="needs-validation p-3" action="submit-query" method="POST" novalidate>
        @csrf
        <div class="row g-3">
          <div class="col-sm-6">
            <label for="firstName" class="form-label">First name</label>
            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="" required>
          </div>

          <div class="col-sm-6">
            <label for="lastName" class="form-label">Last name</label>
            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="" required>
          </div>

          <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
            <div class="invalid-feedback">
              Please enter a valid email address for shipping updates.
            </div>
          </div>

          <div class="col-12">
            <label for="address" class="form-label">Your query</label>
            <textarea type="text" class="form-control" name="query" id="address" placeholder="Please write your query here." rows="6" required></textarea>
          </div>

          <div class="col-12">
            <label for="address2" class="form-label">Contact no.</label>
            <input type="tel" class="form-control" name="contact" id="address2" placeholder="Please enter your contact number here.">
          </div>
        </div>


        <hr class="my-4">

        <button class="w-100 btn btn-outline-primary btn-lg" type="submit">Submit your query</button>
      </form>
    </div>
  </div>
</br>
</br>
</div>

<div style="background-color:#e6e6e6;">
  <div class=" px-2 ">
    <div class="px-5">
      <div class="container-fluid py-2">
      <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
        <div class="col mb-3">
          
          <p class="text-body-secondary"><img src="{{ asset('images/logopt.png') }}" class="rounded-3" style="width: 120px"></p>
          <p class="text-body-secondary">&copy; 2024 PseudoTeam</p>
        </div>
    
        <div class="col mb-3">
    
        </div>
    
        <div class="col mb-3">
          <h5>PseudoTeam</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary">Home</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary">Services</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary">About</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary">Contact Us</a></li>
          </ul>
        </div>
    
        <div class="col mb-3">
          <h5>Social</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary"><i class="fa fa-instagram"></i> Instagram</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary"><i class="fa fa-facebook"></i> Facebook</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary"><i class="fa fa-twitter"></i> Twitter</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary"><i class="fa fa-linkedin"></i> Linked In</a></li>
          </ul>
        </div>
    
        <div class="col mb-3">
          <h5>Terms</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary">Privacy Policy</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary">Terms and Conditions</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-secondary">Copyright Policy</a></li>
          </ul>
        </div>
      </footer>

      </div>
    </div>   

  </div>
</div>


<script>
    var i = 0;
    var j = 0;
    var txt = 'Your Projects,';
    var txt2 = 'Our Expertise.';
    var speed = 90;
    
    function typeWriter() {
      if (i < txt.length) {
        document.getElementById("demo").innerHTML += txt.charAt(i);
        i++;
        setTimeout(typeWriter, speed);
      }
      if (j < txt2.length) {
        document.getElementById("demo2").innerHTML += txt2.charAt(j);
        j++;
        setTimeout(typeWriter, speed);
      }

    }
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
  const sections = document.querySelectorAll(".section-animate");

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // When the section enters the viewport, add fade-in class
        entry.target.classList.add("section-animate-fade-in");
        entry.target.classList.remove("section-animate-fade-out");
      } else {
        // When the section leaves the viewport, add fade-out class
        entry.target.classList.add("section-animate-fade-out");
        entry.target.classList.remove("section-animate-fade-in");
      }
    });
  }, { threshold: 0.1 }); // Trigger when 10% of the section is in view

  sections.forEach(section => {
    observer.observe(section);
  });
});

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>