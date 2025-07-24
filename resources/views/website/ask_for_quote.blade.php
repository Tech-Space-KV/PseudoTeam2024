=<!doctype html>
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

    

</body>

</html>