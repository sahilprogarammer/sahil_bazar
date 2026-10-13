<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Location Search</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        input {
            width: 400px;
            max-width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .location-result {
            margin-top: 10px;
            font-size: 14px;
        }

    </style>

</head>

<body>

    <h2>Search Location</h2>

    <form id="locationForm">

        <!-- FROM -->

        <div class="form-group">

            <label>
                From
            </label>

            <input
                type="text"
                id="from"
                placeholder="Enter from location"
                autocomplete="off"
            >

            <input
                type="hidden"
                id="from_lat"
                name="from_lat"
            >

            <input
                type="hidden"
                id="from_lng"
                name="from_lng"
            >

            <input
                type="hidden"
                id="from_place_id"
                name="from_place_id"
            >

            <div
                class="location-result"
                id="fromResult"
            ></div>

        </div>


        <!-- TO -->

        <div class="form-group">

            <label>
                To
            </label>

            <input
                type="text"
                id="to"
                placeholder="Enter to location"
                autocomplete="off"
            >

            <input
                type="hidden"
                id="to_lat"
                name="to_lat"
            >

            <input
                type="hidden"
                id="to_lng"
                name="to_lng"
            >

            <input
                type="hidden"
                id="to_place_id"
                name="to_place_id"
            >

            <div
                class="location-result"
                id="toResult"
            ></div>

        </div>


        <button type="submit">
            Search
        </button>

    </form>


    <!--
        Google Maps JavaScript API
        Replace YOUR_API_KEY with your API key
    -->

    <script
        async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu_srJXFDBsmYv4E09OWCrVbj5q5qgBgI&libraries=places&loading=async&v=weekly"
    ></script>


    <script>

        let fromAutocomplete;
        let toAutocomplete;


        async function initLocationSearch() {

            /*
             * Load Places library
             */

            const places =
                await google.maps.importLibrary("places");


            console.log("Places library:", places);


            /*
             * Create FROM autocomplete
             */

            fromAutocomplete =
                new places.Autocomplete(
                    document.getElementById("from"),
                    {
                        fields: [
                            "place_id",
                            "geometry",
                            "formatted_address",
                            "name"
                        ]
                    }
                );


            /*
             * FROM selected
             */

            fromAutocomplete.addListener(
                "place_changed",
                function () {

                    const place =
                        fromAutocomplete.getPlace();


                    if (
                        !place.geometry ||
                        !place.geometry.location
                    ) {

                        alert(
                            "Please select a location from the suggestions."
                        );

                        return;

                    }


                    const lat =
                        place.geometry.location.lat();

                    const lng =
                        place.geometry.location.lng();


                    document.getElementById(
                        "from_lat"
                    ).value = lat;


                    document.getElementById(
                        "from_lng"
                    ).value = lng;


                    document.getElementById(
                        "from_place_id"
                    ).value =
                        place.place_id || "";


                    document.getElementById(
                        "fromResult"
                    ).innerHTML = `

                        <strong>
                            ${place.name || ""}
                        </strong>

                        <br>

                        ${place.formatted_address || ""}

                        <br>

                        Latitude:
                        ${lat}

                        <br>

                        Longitude:
                        ${lng}

                    `;

                }
            );


            /*
             * Create TO autocomplete
             */

            toAutocomplete =
                new places.Autocomplete(
                    document.getElementById("to"),
                    {
                        fields: [
                            "place_id",
                            "geometry",
                            "formatted_address",
                            "name"
                        ]
                    }
                );


            /*
             * TO selected
             */

            toAutocomplete.addListener(
                "place_changed",
                function () {

                    const place =
                        toAutocomplete.getPlace();


                    if (
                        !place.geometry ||
                        !place.geometry.location
                    ) {

                        alert(
                            "Please select a location from the suggestions."
                        );

                        return;

                    }


                    const lat =
                        place.geometry.location.lat();

                    const lng =
                        place.geometry.location.lng();


                    document.getElementById(
                        "to_lat"
                    ).value = lat;


                    document.getElementById(
                        "to_lng"
                    ).value = lng;


                    document.getElementById(
                        "to_place_id"
                    ).value =
                        place.place_id || "";


                    document.getElementById(
                        "toResult"
                    ).innerHTML = `

                        <strong>
                            ${place.name || ""}
                        </strong>

                        <br>

                        ${place.formatted_address || ""}

                        <br>

                        Latitude:
                        ${lat}

                        <br>

                        Longitude:
                        ${lng}

                    `;

                }
            );

        }


        /*
         * Wait until Google Maps has loaded
         */

        window.addEventListener(
            "load",
            function () {

                initLocationSearch();

            }
        );


        /*
         * Form submit
         */

        document
            .getElementById("locationForm")
            .addEventListener(
                "submit",
                function (e) {

                    e.preventDefault();


                    console.log({

                        from:
                            document.getElementById(
                                "from"
                            ).value,

                        from_lat:
                            document.getElementById(
                                "from_lat"
                            ).value,

                        from_lng:
                            document.getElementById(
                                "from_lng"
                            ).value,

                        to:
                            document.getElementById(
                                "to"
                            ).value,

                        to_lat:
                            document.getElementById(
                                "to_lat"
                            ).value,

                        to_lng:
                            document.getElementById(
                                "to_lng"
                            ).value

                    });

                }
            );

    </script>

</body>

</html>