
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service - PseudoTeam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/service/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service/reports.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service/project_upload.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service/project_timeline.css') }}">
    
</head>
<body>

    @include('service-partner.sidebar')
    <!-- Content section where page content will be loaded -->
<div class="main-content" id="maincontent">
    <div id="content-section">
        @include('service-partner.topnav')
        <!-- Initial page content goes here -->
        @yield('content')
    </div>
</div>

@include('service-partner.rightbar')

    <script>
        $(document).ready(function() {
            $('.load-page').click(function(e) {
                e.preventDefault();
                let url = $(this).data('url');

                // Load page content via AJAX
                $.get(url, function(data) {
                    $('#content-section').html(data);
                });
            });
        });
    </script>

    <script>
        var isleftbaropen='close';

    function showleftbar() {
            // Check if screen width is 768px or less (mobile/tablet)
            
                if (isleftbaropen == 'close') {
                    // Open the sidebar
                    document.getElementById('maincontent').style.marginLeft = '250px';
                    document.getElementById('sidebar').style.display = 'block';  // Show sidebar
                    document.getElementById('sidebar').style.width = '250px';     // Set sidebar width
                    isleftbaropen = 'open';  // Update state to 'open'
                } else if (isleftbaropen == 'open') {
                    if (window.innerWidth <= 768) {
                    // Close the sidebar
                    document.getElementById('maincontent').style.marginLeft = '0%';
                    document.getElementById('sidebar').style.display = 'none';  // Hide sidebar
                    document.getElementById('sidebar').style.width = '0%';      // Reset sidebar width
                    isleftbaropen = 'close';  // Update state to 'close'
                    }
                }
            
        }


       
       
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
