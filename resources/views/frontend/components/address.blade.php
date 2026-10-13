<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>Add Address - Nonveg Bazar</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <style>
        /* =========================================================
   NONVEG BAZAR
   ADD ADDRESS
   MOBILE ONLY
========================================================= */

        :root {
            --primary: #176B3A;
            --primary-dark: #10552D;
            --orange: #F59E0B;

            --bg: #F7F8F5;
            --white: #FFFFFF;

            --text: #172018;
            --muted: #747B75;

            --border: #E4E9E3;
            --input-bg: #FFFFFF;

            --danger: #D94A45;
        }


        /* =========================================================
   RESET
========================================================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;

            -webkit-tap-highlight-color: transparent;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
        }

        body {
            background: var(--bg);

            color: var(--text);

            font-family: "Plus Jakarta Sans", sans-serif;

            font-size: 14px;
        }

        button,
        input,
        textarea {
            font-family: inherit;
        }

        button {
            border: none;
        }

        a {
            text-decoration: none;
            color: inherit;
        }


        /* =========================================================
   MOBILE APP
========================================================= */

        .mobile-app {

            width: 100%;

            max-width: 430px;

            min-height: 100vh;

            margin: 0 auto;

            background: var(--bg);

            position: relative;

            overflow-x: hidden;
        }


        /* =========================================================
   HEADER
========================================================= */

        .address-header {

            height: 70px;

            padding: 0 16px;

            display: flex;

            align-items: center;

            gap: 13px;

            background: var(--white);

            border-bottom: 1px solid var(--border);

            position: sticky;

            top: 0;

            z-index: 50;
        }


        .back-btn {

            width: 40px;

            height: 40px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 13px;

            background: #F1F4F0;

            color: var(--text);

            font-size: 15px;
        }


        .header-title {

            flex: 1;
        }


        .header-title h1 {

            font-size: 17px;

            font-weight: 800;

            letter-spacing: -0.3px;
        }


        .header-title p {

            margin-top: 3px;

            color: var(--muted);

            font-size: 10px;

            font-weight: 500;
        }


        /* =========================================================
   CONTENT
========================================================= */

        .form-content {

            padding: 17px 15px 105px;
        }


        /* =========================================================
   LOCATION CARD
========================================================= */

        .location-card {

            width: 100%;

            min-height: 65px;

            padding: 12px 13px;

            display: flex;

            align-items: center;

            gap: 12px;

            background: #ECF7EF;

            border: 1px solid #D6EBDD;

            border-radius: 16px;

            margin-bottom: 22px;
        }


        .location-icon {

            width: 40px;

            height: 40px;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 12px;

            background: var(--primary);

            color: var(--white);

            font-size: 14px;
        }


        .location-text {

            flex: 1;
        }


        .location-text strong {

            display: block;

            color: var(--primary);

            font-size: 11px;

            font-weight: 800;
        }


        .location-text span {

            display: block;

            margin-top: 3px;

            color: #637066;

            font-size: 9px;

            line-height: 1.4;
        }


        .location-arrow {

            color: var(--primary);

            font-size: 11px;
        }


        /* =========================================================
   SECTION TITLE
========================================================= */

        .form-section-title {

            margin-bottom: 12px;

            font-size: 13px;

            font-weight: 800;
        }


        /* =========================================================
   ADDRESS TYPE
========================================================= */

        .address-types {

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 9px;

            margin-bottom: 22px;
        }


        .address-type {

            min-height: 70px;

            background: var(--white);

            border: 1.5px solid var(--border);

            border-radius: 15px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            gap: 7px;

            color: #6E756F;

            cursor: pointer;

            transition: all .15s ease;
        }


        .address-type i {

            font-size: 15px;
        }


        .address-type span {

            font-size: 10px;

            font-weight: 700;
        }


        /* selected */

        .address-type.active {

            background: #ECF7EF;

            border-color: var(--primary);

            color: var(--primary);
        }


        /* =========================================================
   FORM GROUP
========================================================= */

        .form-group {

            margin-bottom: 15px;
        }


        .form-label {

            display: block;

            margin-bottom: 7px;

            color: #353D36;

            font-size: 10px;

            font-weight: 700;
        }


        .required {

            color: var(--danger);

            margin-left: 2px;
        }


        /* =========================================================
   INPUT
========================================================= */

        .form-input {

            width: 100%;

            height: 50px;

            padding: 0 14px;

            background: var(--input-bg);

            border: 1px solid var(--border);

            border-radius: 13px;

            outline: none;

            color: var(--text);

            font-size: 11px;

            font-weight: 500;

            transition: border .15s ease,
                box-shadow .15s ease;
        }


        .form-input::placeholder {

            color: #A1A7A1;

            font-weight: 400;
        }


        .form-input:focus {

            border-color: var(--primary);

            box-shadow: 0 0 0 3px rgba(23, 107, 58, .08);
        }


        /* =========================================================
   TWO COLUMN
========================================================= */

        .form-row {

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 10px;
        }


        /* =========================================================
   TEXTAREA
========================================================= */

        .form-textarea {

            width: 100%;

            min-height: 82px;

            padding: 13px 14px;

            resize: none;

            background: var(--white);

            border: 1px solid var(--border);

            border-radius: 13px;

            outline: none;

            color: var(--text);

            font-size: 11px;

            font-weight: 500;

            line-height: 1.5;
        }


        .form-textarea:focus {

            border-color: var(--primary);

            box-shadow: 0 0 0 3px rgba(23, 107, 58, .08);
        }


        /* =========================================================
   GPS LOCATION
========================================================= */

        .gps-section {

            margin-top: 5px;

            padding: 13px;

            background: var(--white);

            border: 1px solid var(--border);

            border-radius: 15px;
        }


        .gps-header {

            display: flex;

            align-items: center;

            gap: 9px;
        }


        .gps-small-icon {

            width: 31px;

            height: 31px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #FFF6E5;

            color: var(--orange);

            border-radius: 9px;

            font-size: 12px;
        }


        .gps-info {

            flex: 1;
        }


        .gps-info strong {

            display: block;

            font-size: 10px;

            font-weight: 800;
        }


        .gps-info span {

            display: block;

            margin-top: 2px;

            color: var(--muted);

            font-size: 8px;
        }


        .gps-button {

            padding: 8px 10px;

            background: #EEF7F0;

            color: var(--primary);

            border-radius: 8px;

            font-size: 9px;

            font-weight: 800;
        }


        /* =========================================================
   DEFAULT ADDRESS
========================================================= */

        .default-box {

            margin-top: 18px;

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .default-checkbox {

            width: 19px;

            height: 19px;

            accent-color: var(--primary);

            cursor: pointer;
        }


        .default-text {

            font-size: 10px;

            font-weight: 600;

            color: #4E574F;
        }


        .default-text strong {

            display: block;

            color: var(--text);

            font-size: 10px;
        }


        .default-text span {

            display: block;

            margin-top: 2px;

            color: var(--muted);

            font-size: 8px;

            font-weight: 500;
        }


        /* =========================================================
   SAVE BUTTON
========================================================= */

        .save-area {

            margin-top: 24px;
        }


        .save-btn {

            width: 100%;

            height: 54px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            background: var(--primary);

            color: var(--white);

            border-radius: 14px;

            font-size: 12px;

            font-weight: 800;

            box-shadow: 0 8px 20px rgba(23, 107, 58, .18);

            transition: transform .15s ease;
        }


        .save-btn:active {

            transform: scale(.98);
        }


        .save-btn i {

            font-size: 12px;
        }


        /* =========================================================
   SECURITY TEXT
========================================================= */

        .secure-text {

            margin-top: 11px;

            text-align: center;

            color: #929992;

            font-size: 8px;

            font-weight: 500;
        }


        /* =========================================================
   MOBILE SMALL SCREEN
========================================================= */

        @media (max-width: 360px) {

            .form-content {

                padding-left: 12px;

                padding-right: 12px;
            }

            .address-type {

                min-height: 64px;
            }

            .form-input {

                height: 47px;
            }

        }
    </style>

</head>


<body>


    <div class="mobile-app">


        <!-- =====================================================
         HEADER
    ====================================================== -->

        <header class="address-header">

            <a href="#" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div class="header-title">

                <h1>Add New Address</h1>

                <p>
                    Where should we deliver your order?
                </p>

            </div>

        </header>


        <!-- =====================================================
         FORM CONTENT
    ====================================================== -->

        <main class="form-content">


            <!-- =================================================
             USE CURRENT LOCATION
        ================================================== -->

            <button type="button" id="useLocationBtn" class="location-card">

                <span class="location-icon">
                    <i class="fa-solid fa-location-crosshairs"></i>
                </span>

                <span class="location-text">
                    <strong>Use my current location</strong>
                    <span>Automatically detect your delivery address</span>
                </span>

                <span class="location-arrow">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>

            </button>


            <!-- =================================================
             ADDRESS TYPE
        ================================================== -->

            <h2 class="form-section-title">
                Save address as
            </h2>


            <div class="address-types">

                <button type="button"
                    class="address-type active">

                    <i class="fa-solid fa-house"></i>

                    <span>
                        Home
                    </span>

                </button>


                <button type="button"
                    class="address-type">

                    <i class="fa-solid fa-briefcase"></i>

                    <span>
                        Work
                    </span>

                </button>


                <button type="button"
                    class="address-type">

                    <i class="fa-solid fa-location-dot"></i>

                    <span>
                        Other
                    </span>

                </button>

            </div>


            <!-- =================================================
             FULL NAME
        ================================================== -->

            <div class="form-group">

                <label class="form-label">
                    Full Name
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    class="form-input"
                    placeholder="Enter your full name"
                    value="Sahil">

            </div>


            <!-- =================================================
             MOBILE
        ================================================== -->

            <div class="form-group">

                <label class="form-label">
                    Mobile Number
                    <span class="required">*</span>
                </label>

                <input
                    type="tel"
                    class="form-input"
                    placeholder="Enter mobile number"
                    maxlength="10">

            </div>


            <!-- =================================================
             HOUSE / FLAT
        ================================================== -->

            <div class="form-group">

                <label class="form-label">
                    House / Flat / Building
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    class="form-input"
                    placeholder="Flat no, house no, building name">

            </div>


            <!-- =================================================
             AREA / STREET
        ================================================== -->

            <div class="form-group">

                <label class="form-label">
                    Area / Street
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    class="form-input"
                    placeholder="Enter area or street">

            </div>


            <!-- =================================================
             LANDMARK
        ================================================== -->

            <div class="form-group">

                <label class="form-label">
                    Landmark
                </label>

                <input
                    type="text"
                    class="form-input"
                    placeholder="Nearby landmark (optional)">

            </div>


            <!-- =================================================
             CITY + PINCODE
        ================================================== -->

            <div class="form-row">

                <div class="form-group">

                    <label class="form-label">
                        City
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        class="form-input"
                        placeholder="City">

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Pincode
                        <span class="required">*</span>
                    </label>

                    <input
                        type="tel"
                        class="form-input"
                        placeholder="Pincode"
                        maxlength="6">

                </div>

            </div>


            <!-- =================================================
             STATE
        ================================================== -->

            <div class="form-group">

                <label class="form-label">
                    State
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    class="form-input"
                    placeholder="State"
                    value="Odisha">

            </div>


            <!-- =================================================
             GPS INFORMATION
        ================================================== -->

            <div class="gps-section">

                <div class="gps-header">

                    <span class="gps-small-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </span>

                    <div class="gps-info">

                        <strong>
                            Delivery location
                        </strong>

                        <span>
                            Location helps us check delivery availability
                        </span>

                    </div>

                    <button type="button"
                        class="gps-button">

                        Detect

                    </button>

                </div>

            </div>


            <!-- =================================================
             DEFAULT ADDRESS
        ================================================== -->

            <label class="default-box">

                <input
                    type="checkbox"
                    class="default-checkbox"
                    checked>

                <span class="default-text">

                    <strong>
                        Make this my default address
                    </strong>

                    <span>
                        We'll use this address for your next order
                    </span>

                </span>

            </label>


            <!-- =================================================
             SAVE
        ================================================== -->

            <div class="save-area">

                <button type="button"
                    class="save-btn">

                    <i class="fa-solid fa-check"></i>

                    Save Address

                </button>

                <p class="secure-text">
                    Your address is securely saved for delivery
                </p>

            </div>


        </main>

    </div>


    <script>
        /*
|--------------------------------------------------------------------------
| ADDRESS TYPE SELECT
|--------------------------------------------------------------------------
*/

        document.querySelectorAll('.address-type').forEach(button => {

            button.addEventListener('click', function() {

                document
                    .querySelectorAll('.address-type')
                    .forEach(item => {
                        item.classList.remove('active');
                    });

                this.classList.add('active');

            });

        });

        document.getElementById('useLocationBtn').addEventListener('click', function () {

    if (!navigator.geolocation) {
        alert('Location is not supported by your browser.');
        return;
    }

    navigator.geolocation.getCurrentPosition(

        function (position) {

            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            console.log('Latitude:', latitude);
            console.log('Longitude:', longitude);

            // Example:
            // Latitude: 20.2961
            // Longitude: 85.8245

        },

        function (error) {

            if (error.code === error.PERMISSION_DENIED) {
                alert('Please allow location permission.');
            } else {
                alert('Unable to get your location.');
            }

        },

        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }

    );

});
    </script>


</body>

</html>