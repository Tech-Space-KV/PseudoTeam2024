
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer - PseudoTeam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/customer/layout.css') }}">
    
</head>
<body>

    @include('customer.sidebar')
    <!-- Content section where page content will be loaded -->
<div class="main-content">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
