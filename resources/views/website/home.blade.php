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
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="images/logo_pt3.png" class="rounded-3" style="width: 120px">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
              </li>
            </ul>
            <form class="d-flex">
                <button class="btn btn-outline-light me-2" style="width: 180px" type="submit">Find Work <i class="material-icons" style="font-size:14px">work</i></button>  
                <button class="btn btn-light" style="width: 180px" type="submit">Sign In <i class="material-icons" style="font-size:14px">login</i></button>
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

<div class="bg-gif2">
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

        <div class="row mx-auto mt-2">
          <button class="btn btn-outline-light btn-lg mt-2 mx-auto" style="width: 260px" type="button">View More <i class="material-icons" style="font-size:14px">arrow_forward</i></button>
        </button>
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