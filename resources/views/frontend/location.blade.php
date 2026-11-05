<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Google Places - Location Search</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background: #f7f8fa;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .autocomplete-container {
            width: 100%;
        }

        gmp-place-autocomplete {
            width: 100%;
        }

        .location-result {
            margin-top: 12px;
            padding: 12px;
            background: #f1f8f3;
            border-radius: 8px;
            font-size: 13px;
            line-height: 1.8;
            display: none;
            overflow-wrap: anywhere;
        }

        .location-result strong {
            font-size: 15px;
        }

        button {
            padding: 12px 25px;
            background: #176b3a;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background: #10542c;
        }

        .output {
            margin-top: 20px;
            padding: 15px;
            background: #f4f4f4;
            border-radius: 8px;
            display: none;
        }

        pre {
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Search Location</h2>

        <form id="locationForm">

            <!-- FROM LOCATION -->

            <div class="form-group">

                <label>From Location</label>

                <div
                    id="fromAutocomplete"
                    class="autocomplete-container">
                </div>

                <input type="hidden" id="from" name="from">
                <input type="hidden" id="from_lat" name="from_lat">
                <input type="hidden" id="from_lng" name="from_lng">
                <input type="hidden" id="from_place_id" name="from_place_id">

                <div class="location-result" id="fromResult"></div>

            </div>


            <!-- TO LOCATION -->

            <div class="form-group">

                <label>To Location</label>

                <div
                    id="toAutocomplete"
                    class="autocomplete-container">
                </div>

                <input type="hidden" id="to" name="to">
                <input type="hidden" id="to_lat" name="to_lat">
                <input type="hidden" id="to_lng" name="to_lng">
                <input type="hidden" id="to_place_id" name="to_place_id">

                <div class="location-result" id="toResult"></div>

            </div>


            <button type="submit">
                Search Locations
            </button>

        </form>


        <!-- FINAL OUTPUT -->

        <div class="output" id="finalOutput">

            <h3>Selected Location Details</h3>

            <pre id="finalData"></pre>

        </div>

    </div>


    <script>
        async function initLocationSearch() {

            try {

                // Load Places API

                const {
                    PlaceAutocompleteElement
                } = await google.maps.importLibrary("places");


                console.log("New Places API Loaded");


                // Create autocomplete element

                function createAutocomplete(containerId, placeholder, prefix) {

                    const autocomplete = new PlaceAutocompleteElement({

                        includedRegionCodes: ["in"],

                        locationRestriction: {
                            north: 20.40,
                            south: 20.18,
                            east: 85.95,
                            west: 85.75
                        }

                    });

                    autocomplete.placeholder = placeholder;


                    document.getElementById(containerId)
                        .appendChild(autocomplete);


                    // Clear old selection when user changes the input

                    autocomplete.addEventListener("input", function() {

                        clearSelection(prefix);

                    });


                    // Handle selected place

                    autocomplete.addEventListener("gmp-select", async function(event) {

                        await handlePlaceSelect(event, prefix);

                    });


                    return autocomplete;

                }


                // Create FROM and TO fields

                const fromAutocomplete = createAutocomplete(
                    "fromAutocomplete",
                    "Enter from location",
                    "from"
                );


                const toAutocomplete = createAutocomplete(
                    "toAutocomplete",
                    "Enter destination location",
                    "to"
                );


                // Clear selected values

                function clearSelection(prefix) {

                    document.getElementById(prefix).value = "";

                    document.getElementById(prefix + "_lat").value = "";

                    document.getElementById(prefix + "_lng").value = "";

                    document.getElementById(prefix + "_place_id").value = "";

                    const result = document.getElementById(prefix + "Result");

                    result.textContent = "";

                    result.style.display = "none";

                }


                // Handle location selection

                async function handlePlaceSelect(event, prefix) {

                    try {

                        const place = event.placePrediction.toPlace();


                        // Fetch required fields

                        await place.fetchFields({

                            fields: [
                                "id",
                                "displayName",
                                "formattedAddress",
                                "location"
                            ]

                        });


                        if (!place.location) {

                            alert("Location coordinates not available.");

                            clearSelection(prefix);

                            return;

                        }


                        const latitude = place.location.lat();

                        const longitude = place.location.lng();

                        const placeId = place.id || "";

                        const name = place.displayName || "";

                        const address = place.formattedAddress || "";


                        // Save hidden input values

                        document.getElementById(prefix).value = address;

                        document.getElementById(prefix + "_lat").value = latitude;

                        document.getElementById(prefix + "_lng").value = longitude;

                        document.getElementById(prefix + "_place_id").value = placeId;


                        // Display selected location

                        const result = document.getElementById(prefix + "Result");

                        result.textContent = "";


                        const title = document.createElement("strong");

                        title.textContent = name;


                        const details = document.createElement("div");

                        details.textContent =
                            address +
                            " | Latitude: " + latitude +
                            " | Longitude: " + longitude;


                        const id = document.createElement("div");

                        id.textContent = "Place ID: " + placeId;


                        result.appendChild(title);

                        result.appendChild(details);

                        result.appendChild(id);

                        result.style.display = "block";


                        // Console output

                        console.log(prefix + " Location:", {

                            name: name,

                            address: address,

                            latitude: latitude,

                            longitude: longitude,

                            place_id: placeId

                        });


                    } catch (error) {

                        console.error("Place selection error:", error);

                        clearSelection(prefix);

                        alert("Unable to fetch location details.");

                    }

                }


            } catch (error) {

                console.error("Google Places initialization error:", error);

                alert("Google Places API failed to load. Check API key and permissions.");

            }

        }


        // Form submit

        document.getElementById("locationForm")
            .addEventListener("submit", function(e) {

                e.preventDefault();


                const fromLat = document.getElementById("from_lat").value;

                const toLat = document.getElementById("to_lat").value;


                // Validate selection

                if (!fromLat || !toLat) {

                    alert("Please select both locations from Google suggestions.");

                    return;

                }


                // Final location data

                const data = {

                    from: document.getElementById("from").value,

                    from_lat: fromLat,

                    from_lng: document.getElementById("from_lng").value,

                    from_place_id: document.getElementById("from_place_id").value,

                    to: document.getElementById("to").value,

                    to_lat: toLat,

                    to_lng: document.getElementById("to_lng").value,

                    to_place_id: document.getElementById("to_place_id").value

                };


                console.log("Final Location Data:", data);


                // Display final data

                document.getElementById("finalData").textContent =
                    JSON.stringify(data, null, 4);

                document.getElementById("finalOutput").style.display = "block";


            });


        // Expose callback

        window.initLocationSearch = initLocationSearch;
    </script>


    <!-- Google Maps JavaScript API -->

    <script
        async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCawZlJCcDM27uHGBeoNcXcPxMfJVP1bIE&loading=async&callback=initLocationSearch&v=weekly">
    </script>

</body>

</html>
x