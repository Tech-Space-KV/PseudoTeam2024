<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>PseudoTeam</title>
  
    <style>
        .bg-gif {
          background: url('images/bg_pt_final.gif') no-repeat center center;
          background-size: cover;
          position: relative;
          z-index: 0;
        }

        .bg-gif2 {
          /* background: url('images/background_pt4.jpg') no-repeat center center; */
          background-color: #000000;
          background-size: cover;
          position: relative;
          z-index: 0;
        }

        .bg-gif3 {
           background: url('images/bg_pt4.png') no-repeat center center; 
          background-size:cover;
          position: relative;
          z-index: 0;
        }
    
        .content {
          background: linear-gradient(to bottom, 
              rgb(0, 0, 0) 0%, 
              rgb(0, 0, 0) 7%,   /* Top vignette color */
              rgba(0, 0, 0, 0) 15%,    /* Start of transparent area */
              rgba(0, 0, 0, 0) 85%,
              rgb(0, 0, 0) 98%,     /* End of transparent area */
              rgb(0, 0, 0) 100%  /* Bottom vignette color */
              );
        }

        .neon-yellow-border-text {
                -webkit-text-stroke: 0.5px black; /* Black border around text */
                }

      </style>

<style>
    .card {
      position: relative;
      overflow: hidden;
      border: none;
      height: 450px;
      width: 300px;
    }

    .card-img-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      background-position: center;
      transition: opacity 0.5s ease;
      z-index: 1;
    }

    .card-body {
      position: relative;
      z-index: 2;
      background-color: rgba(0, 0, 0, 0.5);
      color: rgb(239, 234, 234);
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 20px;
    }

    .card-title {
      transition: transform 0.5s ease;
    }

    .card-text {
      opacity: 0;
      transition: opacity 0.5s ease;
    }

    .card:hover .card-img-bg {
      opacity: 0.7;
    }

    .card:hover .card-title {
      transform: scale(1.2);
    }

    .card:hover .card-text {
      opacity: 1;
    }
  </style>

</head>

  <body class="bg-dark" onload="typeWriter()">


<div class="bg-gif">
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
          <h1 class="fw-bold text-light display-1 neon-yellow-border-text" id="demo"></h1>
          <h5 class="col-md-4 text-light neon-yellow-border-text">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</h5>
          <button class="btn btn-outline-light btn-lg mt-2" style="width: 260px" type="button">Start Project <i class="material-icons" style="font-size:14px">arrow_forward</i></button>
        <br>
        </div>
      </div>  
    </div>
</div>


<div class="bg-gif3">
  <div class="content px-2 " >
    <nav class="navbar navbar-expand-lg navbar-dark px-5">
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
    </nav>

    <div class="p-5 bg-body-tertiary">
      <div class="container-fluid py-5">
        <p class="display-3 text-center text-secondary">Offering a diverse range of IT services, tailored to meet the needs of various industries</p>
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-4">
              <!-- Card 1 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt4.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Card Title 1</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
              <!-- Card 2 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt3.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Card Title 2</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
              <!-- Card 3 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt2.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Card Title 3</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
              <!-- Card 4 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Card Title 4</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
              <!-- Card 5 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Card Title 5</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
              <!-- Card 6 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt2.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Card Title 6</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
              <!-- Card 7 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt3.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Card Title 7</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
              <!-- Card 8 -->
              <div class="col">
                <div class="card">
                  <div class="card-img-bg" style="background-image: url('./images/card_pt4.jpg');"></div>
                  <div class="card-body">
                    <h5 class="card-title">Card Title 8</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>

      <div class="row mx-auto mt-4">
        <a href="services" class="btn btn-outline-light btn-lg mt-2 mx-auto" style="width: 260px" type="button">View More <i class="material-icons" style="font-size:14px">arrow_forward</i></a>
      </button>
    </div>

      </div>
    </div>   

  </div>
</div>

<div class="bg-gif2">
  <div class="content px-2 " >
    <div class="px-5 bg-body-tertiary">
      <div class="container-fluid py-2">
        <p class="display-3 text-center text-secondary">PseudoTeam's Essence</p>
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
                <h4 class="fw-bold mb-0 text-light"><i class="material-icons">supervisor_account</i> Dedicated Intermediaries</h4>
                <p class="text-light">We act as dedicated intermediaries, ensuring that every project is meticulously managed and delivered to perfection.</p>
              </div>
    
              <div class="col d-flex flex-column gap-2 m-2" style="width:280px; background-color:#80bb00;">
                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
                </div>
                <h4 class="fw-bold mb-0 text-light"><i class="material-icons">view_module</i> Structured Process</h4>
                <p class="text-light">We offer a structured and reliable process, overcoming common freelancing issues like communication breakdowns, inconsistent quality, and missed deadlines.</p>
              </div>
    
              <div class="col d-flex flex-column gap-2 m-2" style="width:280px; background-color:#00a5ef;">
                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
                </div>
                <h4 class="fw-bold mb-0 text-light"><i class="material-icons">perm_data_setting</i> Comprehensive Services</h4>
                <p class="text-light">Our services include detailed project scoping, regular progress updates, quality assurance, and timely delivery to ensure project success.</p>
              </div>
    
              <div class="col d-flex flex-column gap-2  m-2" style="width:280px; background-color:#ffba00;">
                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
                </div>
                <h4 class="fw-bold mb-0 text-light"><i class="material-icons">star</i> Commitment to Excellence</h4>
                <p class="text-light">PseudoTeam’s commitment to excellence and customer satisfaction makes us the ideal choice for a hassle-free and professional project management experience.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
  </br>    
        <div class="row align-items-md-stretch">
          <div class="col-md-6 mt-1">
            <div class="h-100 p-5 text-dark bg-light border rounded-3">
              <h2>Project Owners</h2>
              <p>Elevate your project experience with PseudoTeam. We ensure flawless execution and timely delivery, eliminating common freelancing pitfalls. Trust us to handle your project with precision and professionalism.</p>
              <button class="btn btn-outline-dark" type="button">Get Onboard <i class="material-icons" style="font-size:14px">login</i></button>
            </div>
          </div>
          <div class="col-md-6 mt-1">
            <div class="h-100 p-5 text-light bg-secondary border rounded-3">
              <h2>Service Providers</h2>
              <p>Boost your freelancing career with Pseudoteam. Focus on what you do best while we handle client interactions and project management. Join us to work efficiently and get paid promptly!</p>
              <button class="btn btn-outline-light" type="button">Find Work <i class="material-icons" style="font-size:14px">work</i></button>
            </div>
          </div>
        </div>

      </div>
    </div>   

  </div>
</div>
   

<script>
    var i = 0;
    var txt = 'Something Title';
    var speed = 40;
    
    function typeWriter() {
      if (i < txt.length) {
        document.getElementById("demo").innerHTML += txt.charAt(i);
        i++;
        setTimeout(typeWriter, speed);
      }

    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>