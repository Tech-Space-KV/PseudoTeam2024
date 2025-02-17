
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache,  no-store, must-validate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Customer - PseudoTeam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/customer/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customer/reports.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customer/project_upload.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customer/project_timeline.css') }}">
    
</head>
<body>

    @include('customer.sidebar')
    <!-- Content section where page content will be loaded -->
<div class="main-content" id="maincontent">
    <div id="content-section">
        @include('customer.topnav')
        <!-- Initial page content goes here -->
        @yield('content')
    </div>
</div>

@include('customer.rightbar')

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
        // var isleftbaropen='close';
        var isleftbaropen = false;

    function showleftbar() {
            // Check if screen width is 768px or less (mobile/tablet)
            
                let width = window.innerWidth

                if(width<768)
                {

                    if(isleftbaropen)
                    {
                        document.getElementById('maincontent').style.marginLeft = '0%';
                        document.getElementById('sidebar').style.display = 'none';  
                        document.getElementById('sidebar').style.width = '0%';   
                        isleftbaropen = false;
                    }else 
                    {
                        document.getElementById('maincontent').style.marginLeft = '250px';
                        document.getElementById('sidebar').style.display = 'flex'; 
                        document.getElementById('sidebar').style.width = '250px'; 
                        isleftbaropen = true;
                    }
                }

                // if (isleftbaropen == 'close') {
                //     // Open the sidebar
                //     document.getElementById('maincontent').style.marginLeft = '250px';
                //     document.getElementById('sidebar').style.display = 'block';  // Show sidebar  //getting alignment issue by using this
                //     document.getElementById('sidebar').style.width = '250px';     // Set sidebar width
                //     isleftbaropen = 'open';  // Update state to 'open'
                // } else if (isleftbaropen == 'open') {
                //     if (window.innerWidth <= 768) {
                //     // Close the sidebar
                //     document.getElementById('maincontent').style.marginLeft = '0%';
                //     document.getElementById('sidebar').style.display = 'none';  // Hide sidebar
                //     document.getElementById('sidebar').style.width = '0%';      // Reset sidebar width
                //     isleftbaropen = 'close';  // Update state to 'close'
                //     }
                // }
            
        }

            // Orientation detection and popup
            function checkOrientation() {

            var popup = document.getElementById('landscape-popup');
            var mainContent = document.getElementById('maincontent');
            var leftbar = document.getElementById('sidebar');
            var rightbar = document.getElementById('rightbar');

            if (window.innerWidth < window.innerHeight) {
                popup.style.display = 'block';  
                mainContent.style.display = 'none'; 
                leftbar.style.display = 'none';  
                rightbar.style.display = 'none';

            } else {
                popup.style.display = 'none'; 
                mainContent.style.display = 'block';  
                leftbar.style.display = 'block';  
                rightbar.style.display = 'block'; 
            }
        }

        // Listen for orientation change or resize
        window.addEventListener('resize', checkOrientation);
        window.addEventListener('orientationchange', checkOrientation);

        // Initial check when the page loads
        checkOrientation();
    
    </script>
    <script>
    // if (performance.navigation.type === performance.navigation.TYPE_BACK_FORWARD) {
    //     window.location.href = "{{ route('login') }}";
    // }
</script>

    <div id="landscape-popup" class="landscape-popup" style="display: none;">
        <p>Please rotate your device to landscape mode for a better experience!</p>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
