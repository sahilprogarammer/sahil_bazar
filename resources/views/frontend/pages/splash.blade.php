<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    >

    <title>Nonveg Bazar</title>


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }


        body {

            background: #111;

            font-family:
                "Poppins",
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

        }


        /* =========================================
           MOBILE CONTAINER
        ========================================= */

        .splash {

            position: relative;

            width: 100%;
            max-width: 390px;

            height: 100vh;
            height: 100dvh;

            margin: 0 auto;

            overflow: hidden;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                radial-gradient(
                    circle at 50% 42%,
                    rgba(31, 137, 77, 0.42),
                    transparent 32%
                ),
                linear-gradient(
                    145deg,
                    #032719 0%,
                    #07502f 52%,
                    #032b1a 100%
                );

        }


        /* =========================================
           BACKGROUND
        ========================================= */

        .glow-one {

            position: absolute;

            width: 260px;
            height: 260px;

            top: -110px;
            right: -110px;

            border-radius: 50%;

            background: rgba(245, 166, 35, 0.08);

            filter: blur(10px);

        }


        .glow-two {

            position: absolute;

            width: 250px;
            height: 250px;

            bottom: -130px;
            left: -110px;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.05);

            filter: blur(10px);

        }


        .circle {

            position: absolute;

            border-radius: 50%;

            border: 1px solid rgba(255,255,255,0.06);

        }


        .circle-one {

            width: 300px;
            height: 300px;

            top: -160px;
            right: -150px;

        }


        .circle-two {

            width: 270px;
            height: 270px;

            bottom: -160px;
            left: -150px;

        }


        .circle-three {

            width: 480px;
            height: 480px;

            left: 50%;
            top: 50%;

            transform: translate(-50%, -50%);

            border-color: rgba(255,255,255,0.025);

        }


        /* =========================================
           CONTENT
        ========================================= */

        .content {

            position: relative;

            z-index: 5;

            width: 100%;

            display: flex;

            flex-direction: column;

            align-items: center;

            text-align: center;

            padding: 30px;

            animation: contentEnter 1s ease forwards;

        }


        /* =========================================
           LOGO
        ========================================= */

        .logo-wrapper {

            position: relative;

            width: 150px;
            height: 150px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin-bottom: 25px;

        }


        .logo-glow {

            position: absolute;

            width: 145px;
            height: 145px;

            border-radius: 50%;

            background: rgba(255,255,255,0.13);

            filter: blur(25px);

            animation: logoGlow 2.5s ease-in-out infinite;

        }


        .logo-ring {

            position: absolute;

            width: 145px;
            height: 145px;

            border-radius: 50%;

            border: 1px solid rgba(255,255,255,0.20);

        }


        .logo-ring::before {

            content: "";

            position: absolute;

            inset: 9px;

            border-radius: 50%;

            border: 1px solid rgba(255,255,255,0.08);

        }


        .logo {

            position: relative;

            z-index: 2;

            width: 105px;
            height: 105px;

            padding: 13px;

            border-radius: 50%;

            background: #fff;

            box-shadow:
                0 15px 40px rgba(0,0,0,0.30),
                0 0 35px rgba(255,255,255,0.12);

            animation:
                logoEnter 1s cubic-bezier(.2,.8,.2,1);

        }


        /* =========================================
           BRAND
        ========================================= */

        .brand {

            color: #fff;

            font-size: 30px;

            line-height: 1.1;

            font-weight: 800;

            letter-spacing: -1px;

            animation:
                textEnter 1s ease 0.2s both;

        }


        .brand span {

            color: #f5a623;

        }


        .tagline {

            margin-top: 10px;

            color: rgba(255,255,255,0.68);

            font-size: 11px;

            font-weight: 500;

            letter-spacing: 2px;

            text-transform: uppercase;

            animation:
                textEnter 1s ease 0.35s both;

        }


        /* =========================================
           LOADER
        ========================================= */

        .loader {

            width: 85px;
            height: 3px;

            margin-top: 40px;

            overflow: hidden;

            border-radius: 20px;

            background: rgba(255,255,255,0.12);

            animation:
                textEnter 1s ease 0.5s both;

        }


        .loader-bar {

            width: 0%;

            height: 100%;

            border-radius: 20px;

            background: #f5a623;

            animation:
                loading 2.5s linear forwards;

        }


        /* =========================================
           BOTTOM TEXT
        ========================================= */

        .bottom-text {

            position: absolute;

            z-index: 5;

            left: 0;
            right: 0;

            bottom: 25px;

            text-align: center;

            color: rgba(255,255,255,0.35);

            font-size: 9px;

            font-weight: 500;

            letter-spacing: 1.5px;

            text-transform: uppercase;

        }


        /* =========================================
           ANIMATIONS
        ========================================= */

        @keyframes contentEnter {

            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        @keyframes logoEnter {

            0% {

                opacity: 0;

                transform:
                    scale(0.55)
                    rotate(-10deg);

            }

            70% {

                transform:
                    scale(1.06)
                    rotate(1deg);

            }

            100% {

                opacity: 1;

                transform:
                    scale(1)
                    rotate(0deg);

            }

        }


        @keyframes logoGlow {

            0%,
            100% {

                opacity: 0.45;

                transform: scale(0.90);

            }

            50% {

                opacity: 0.85;

                transform: scale(1.08);

            }

        }


        @keyframes textEnter {

            from {

                opacity: 0;

                transform: translateY(10px);

            }

            to {

                opacity: 1;

                transform: translateY(0);

            }

        }


        @keyframes loading {

            from {
                width: 0%;
            }

            to {
                width: 100%;
            }

        }


        /* =========================================
           SMALL MOBILE
        ========================================= */

        @media (max-width: 360px) {

            .logo-wrapper {

                width: 135px;
                height: 135px;

            }

            .logo-ring,
            .logo-glow {

                width: 135px;
                height: 135px;

            }

            .logo {

                width: 98px;
                height: 98px;

            }

            .brand {

                font-size: 27px;

            }

        }

    </style>

</head>


<body>


<div class="splash">


    <!-- Background -->

    <div class="glow-one"></div>

    <div class="glow-two"></div>

    <div class="circle circle-one"></div>

    <div class="circle circle-two"></div>

    <div class="circle circle-three"></div>


    <!-- Content -->

    <div class="content">


        <!-- Logo -->

        <div class="logo-wrapper">

            <div class="logo-glow"></div>

            <div class="logo-ring"></div>


            <div class="logo">


                <!-- STATIC SVG LOGO -->

                <svg
                    viewBox="0 0 100 100"
                    width="100%"
                    height="100%"
                    xmlns="http://www.w3.org/2000/svg"
                >

                    <!-- Main Logo Circle -->

                    <circle
                        cx="50"
                        cy="50"
                        r="48"
                        fill="#087A42"
                    />


                    <!-- Shopping Bag -->

                    <path
                        d="
                            M27 39
                            H73
                            L69 77
                            H31
                            Z
                        "
                        fill="#ffffff"
                    />


                    <!-- Bag Handle -->

                    <path
                        d="
                            M39 40
                            C39 25 61 25 61 40
                        "
                        fill="none"
                        stroke="#ffffff"
                        stroke-width="5"
                        stroke-linecap="round"
                    />


                    <!-- Food Leaf -->

                    <path
                        d="
                            M41 54
                            C47 47 58 47 63 53
                            C58 61 47 63 41 54
                            Z
                        "
                        fill="#F5A623"
                    />


                    <!-- Leaf Stem -->

                    <path
                        d="
                            M52 53
                            C53 57 55 61 58 64
                        "
                        fill="none"
                        stroke="#087A42"
                        stroke-width="2"
                        stroke-linecap="round"
                    />


                    <!-- Small Details -->

                    <circle
                        cx="39"
                        cy="68"
                        r="2"
                        fill="#087A42"
                    />

                    <circle
                        cx="62"
                        cy="68"
                        r="2"
                        fill="#087A42"
                    />

                </svg>


            </div>

        </div>


        <!-- Brand Name -->

        <h1 class="brand">
            Nonveg <span>Bazar</span>
        </h1>


        <!-- Tagline -->

        <p class="tagline">
            Fresh • Quality • Delivered
        </p>


        <!-- Loading -->

        <div class="loader">

            <div class="loader-bar"></div>

        </div>


    </div>


    <!-- Bottom -->

    <div class="bottom-text">
        Your Fresh Food Marketplace
    </div>


</div>


<script>

    /*
    |--------------------------------------------------------------------------
    | SPLASH → HOME
    |--------------------------------------------------------------------------
    |
    | After 2.5 seconds, call /home again.
    | The controller will see the session flag and return home.blade.php.
    |
    */

    setTimeout(function () {

        window.location.href = "{{ route('home') }}";

    }, 2500);

</script>


</body>

</html>