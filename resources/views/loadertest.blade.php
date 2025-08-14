<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Loader</title>
    <style>
        /* HTML: <div class="loader"></div> */
        .loader {
            --w: 10ch;
            font-weight: bold;
            font-family: monospace;
            font-size: 30px;
            letter-spacing: var(--w);
            width: var(--w);
            overflow: hidden;
            white-space: nowrap;
            color: blue;
            animation: l40 2s infinite;
        }

        .loader:before {
            content: "PseudoTeam...";
        }

        @keyframes l40 {

            0%,
            100% {
                text-shadow:
                    calc(0*var(--w)) 0 white, 
                    calc(-1*var(--w)) 0 white, 
                    calc(-2*var(--w)) 0 white, 
                    calc(-3*var(--w)) 0 white, 
                    calc(-4*var(--w)) 0 white,
                    calc(-5*var(--w)) 0 white, 
                    calc(-6*var(--w)) 0 white, 
                    calc(-7*var(--w)) 0 white, 
                    calc(-8*var(--w)) 0 white, 
                    calc(-9*var(--w)) 0 white;
            }

            9% {
                text-shadow:
                    calc(0*var(--w)) 0 white, 
                    calc(-1*var(--w)) 0 white, 
                    calc(-2*var(--w)) -20px white 
                    calc(-3*var(--w)) 0 white, 
                    calc(-4*var(--w)) 0 white,
                    calc(-5*var(--w)) 0 white, 
                    calc(-6*var(--w)) 0 white, 
                    calc(-7*var(--w)) 0 white, 
                    calc(-8*var(--w)) 0 white, 
                    calc(-9*var(--w)) 0 white;
            }

            18% {
                text-shadow:
                    calc(0*var(--w)) 0 white, 
                    calc(-1*var(--w)) 0 white, 
                    calc(-2*var(--w)) -20px white 
                    calc(-3*var(--w)) 0 white, 
                    calc(-4*var(--w)) 0 white,
                    calc(-5*var(--w)) 0 white, 
                    calc(-6*var(--w)) -20px white
                    calc(-7*var(--w)) 0 white, 
                    calc(-8*var(--w)) 0 white, 
                    calc(-9*var(--w)) 0 white;
            }

            27% {
                text-shadow:
                    calc(0*var(--w)) -20px white calc(-1*var(--w)) 0 white, calc(-2*var(--w)) -20px white calc(-3*var(--w)) 0 white, calc(-4*var(--w)) 0 white,
                    calc(-5*var(--w)) 0 white, calc(-6*var(--w)) -20px white calc(-7*var(--w)) 0 white, calc(-8*var(--w)) 0 white, calc(-9*var(--w)) 0 white;
            }

            36% {
                text-shadow:
                    calc(0*var(--w)) -20px white calc(-1*var(--w)) 0 white, calc(-2*var(--w)) -20px white calc(-3*var(--w)) 0 white, calc(-4*var(--w)) 0 white,
                    calc(-5*var(--w)) -20px white calc(-6*var(--w)) -20px white calc(-7*var(--w)) 0 white, calc(-8*var(--w)) 0 white, calc(-9*var(--w)) 0 white;
            }

            45% {
                text-shadow:
                    calc(0*var(--w)) -20px white calc(-1*var(--w)) 0 white, calc(-2*var(--w)) -20px white calc(-3*var(--w)) 0 white, calc(-4*var(--w)) 0 white,
                    calc(-5*var(--w)) -20px white calc(-6*var(--w)) -20px white calc(-7*var(--w)) 0 white, calc(-8*var(--w)) -20px white calc(-9*var(--w)) 0 white;
            }

            54% {
                text-shadow:
                    calc(0*var(--w)) -20px white calc(-1*var(--w)) 0 white, calc(-2*var(--w)) -20px white calc(-3*var(--w)) 0 white, calc(-4*var(--w)) -20px white
                    calc(-5*var(--w)) -20px white calc(-6*var(--w)) -20px white calc(-7*var(--w)) 0 white, calc(-8*var(--w)) -20px white calc(-9*var(--w)) 0 white;
            }

            63% {
                text-shadow:
                    calc(0*var(--w)) -20px white calc(-1*var(--w)) 0 white, calc(-2*var(--w)) -20px white, calc(-3*var(--w)) 0 white, calc(-4*var(--w)) -20px white,
                    calc(-5*var(--w)) -20px white, calc(-6*var(--w)) -20px white, calc(-7*var(--w)) 0 white, calc(-8*var(--w)) -20px white, calc(-9*var(--w)) -20px white;
            }

            72% {
                text-shadow:
                    calc(0*var(--w)) -20px white, calc(-1*var(--w)) -20px white, calc(-2*var(--w)) -20px white, calc(-3*var(--w)) 0 white, calc(-4*var(--w)) -20px white,
                    calc(-5*var(--w)) -20px white, calc(-6*var(--w)) -20px white, calc(-7*var(--w)) 0 white, calc(-8*var(--w)) -20px white, calc(-9*var(--w)) -20px white;
            }

            81% {
                text-shadow:
                    calc(0*var(--w)) -20px white, calc(-1*var(--w)) -20px white, calc(-2*var(--w)) -20px white, calc(-3*var(--w)) 0 white, calc(-4*var(--w)) -20px white,
                    calc(-5*var(--w)) -20px white, calc(-6*var(--w)) -20px white, calc(-7*var(--w)) -20px white, calc(-8*var(--w)) -20px white, calc(-9*var(--w)) -20px white;
            }

            90% {
                text-shadow:
                    calc(0*var(--w)) -20px white, calc(-1*var(--w)) -20px white, calc(-2*var(--w)) -20px white, calc(-3*var(--w)) -20px white, calc(-4*var(--w)) -20px white,
                    calc(-5*var(--w)) -20px white, calc(-6*var(--w)) -20px white, calc(-7*var(--w)) -20px white, calc(-8*var(--w)) -20px white, calc(-9*var(--w)) -20px white;
            }
        }
    </style>
</head>

<body
    style="background: #222; color: white; display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="loader"></div>
</body>

</html>