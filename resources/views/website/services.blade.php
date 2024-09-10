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

</head>

  <body class="bg-light" onload="typeWriter()">


<div class="bg-gif2">
    <div class="content px-2 " >
      
      @include('website.top_nav')

      <nav class="navbar navbar-expand-lg navbar-dark px-5">
        <div class="container-fluid">
          <div class="collapse navbar-collapse" id="">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" id="ACTIVE_ALL" onclick="select_all_service('AP', 'MARC');">All Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" id="ACTIVE_AP" onclick="select_service('AP', 'MARC');">Ative Passive Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" id="ACTIVE_MARC" onclick="select_service('MARC', 'AP');">MARC Services</a>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>

    </div>
</div>

<div class="mt-3 px-4">

  <div class="card my-3" id="MARC">
    <div class="card-header m-0">
      <img src="images/marc.png">
    </div>
    <div class="card-body">
      <h5 class=" card-title text-primary fw-bold">Service No. 5598</h5>
      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="btn btn-sm btn-primary">Get Service</a>
    </div>
  </div>


  <div class="card my-3" id="AP">
    <div class="card-header m-0">
      <img src="images/active-passive.png">
    </div>
    <div class="card-body">
      <h5 class=" card-title text-primary fw-bold">Service No. 5532</h5>
      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="btn btn-sm btn-primary">Get Service</a>
    </div>
  </div>


</div>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
      function select_service(service_name1, service_name2) {
          var service1 = document.getElementById(service_name1);
          var service2 = document.getElementById(service_name2);
          var acserv = 'ACTIVE_'+service_name1;
          var deacserv = 'ACTIVE_'+service_name2;
          
          var active_service = document.getElementById(acserv);
          var deactive_service1 = document.getElementById(deacserv);
          var deactive_service2 = document.getElementById('ACTIVE_ALL');

          service1.style.display = 'block';
          service2.style.display = 'none';
          active_service.classList.add('active');
          deactive_service1.classList.remove('active');
          deactive_service2.classList.remove('active');
      }

      function select_all_service(service_name1, service_name2) {
          var service1 = document.getElementById(service_name1);
          var service2 = document.getElementById(service_name2);

          var deacserv1 = 'ACTIVE_'+service_name1;
          var deacserv2 = 'ACTIVE_'+service_name2;
          
          var active_service = document.getElementById('ACTIVE_ALL');
          var deactive_service1 = document.getElementById(deacserv1);
          var deactive_service2 = document.getElementById(deacserv2);
          
          service1.style.display = 'block';
          service2.style.display = 'block';
          active_service.classList.add('active');
          deactive_service1.classList.remove('active');
          deactive_service2.classList.remove('active');
      }
  </script>
  </body>
</html>