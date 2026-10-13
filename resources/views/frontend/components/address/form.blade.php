<div class="address-modal-overlay" id="addressFormModal">

    <div class="address-modal address-form-modal">

        {{-- =====================================================
             FIXED HEADER
        ====================================================== --}}

        <div class="address-modal-header">

            <div>
                <h3>
                    <i class="fa-solid fa-location-dot"></i>
                    Add New Address
                </h3>

                <p>
                    Add your delivery location
                </p>
            </div>

            <button
                type="button"
                class="address-modal-close"
                onclick="closeAddressForm()"
                aria-label="Close">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>


        {{-- =====================================================
             SCROLLABLE FORM CONTENT
        ====================================================== --}}

        <div class="address-form-scroll">

            <form
                id="commonAddressForm"
                method="POST"
                action="{{ route('address-store') }}">

                @csrf


                {{-- =================================================
                     CURRENT LOCATION
                ================================================== --}}

                <div class="address-form-section">

                    <div class="address-form-section-title">
                        Delivery Location
                    </div>


                    <div class="address-location-card">

                        <div class="address-location-icon">

                            <i class="fa-solid fa-location-crosshairs"></i>

                        </div>


                        <div class="address-location-content">

                            <strong>
                                Use my current location
                            </strong>

                            <span>
                                Automatically detect your location
                            </span>

                        </div>


                        <button
                            type="button"
                            class="address-detect-btn"
                            id="addressDetectLocationBtn">

                            Detect

                        </button>

                    </div>


                    <div
                        class="address-location-status"
                        id="addressLocationStatus">
                    </div>


                    {{-- Hidden GPS values --}}

                    <input
                        type="hidden"
                        name="latitude"
                        id="addressLatitude">

                    <input
                        type="hidden"
                        name="longitude"
                        id="addressLongitude">

                </div>


                {{-- =================================================
                     ADDRESS TYPE
                ================================================== --}}

                <div class="address-form-section">

                    <div class="address-form-section-title">
                        Address Type
                    </div>


                    <div class="address-type-grid">

                        <button
                            type="button"
                            class="address-type-option active"
                            data-address-type="home">

                            <i class="fa-solid fa-house"></i>

                            <span>
                                Home
                            </span>

                        </button>


                        <button
                            type="button"
                            class="address-type-option"
                            data-address-type="work">

                            <i class="fa-solid fa-briefcase"></i>

                            <span>
                                Work
                            </span>

                        </button>


                        <button
                            type="button"
                            class="address-type-option"
                            data-address-type="other">

                            <i class="fa-solid fa-location-dot"></i>

                            <span>
                                Other
                            </span>

                        </button>

                    </div>


                    <input
                        type="hidden"
                        name="address_type"
                        id="addressTypeInput"
                        value="home">

                </div>


                {{-- =================================================
                     CONTACT INFORMATION
                ================================================== --}}

                <div class="address-form-section">

                    <div class="address-form-section-title">
                        Contact Details
                    </div>


                    {{-- Full Name --}}

                    <div class="address-input-group">

                        <label for="addressName">
                            Full Name
                        </label>

                        <div class="address-input-wrapper">

                            <i class="fa-regular fa-user"></i>

                            <input
                                type="text"
                                name="name"
                                id="addressName"
                                placeholder="Enter your full name"
                                autocomplete="name"
                                required>

                        </div>

                    </div>


                    {{-- Mobile --}}

                    <div class="address-input-group">

                        <label for="addressMobile">
                            Mobile Number
                        </label>

                        <div class="address-input-wrapper">

                            <i class="fa-solid fa-phone"></i>

                            <input
                                type="tel"
                                name="mobile"
                                id="addressMobile"
                                placeholder="Enter 10 digit mobile number"
                                maxlength="10"
                                inputmode="numeric"
                                autocomplete="tel"
                                required>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     ADDRESS INFORMATION
                ================================================== --}}

                <div class="address-form-section">

                    <div class="address-form-section-title">
                        Address Details
                    </div>


                    {{-- House / Flat --}}

                    <div class="address-input-group">

                        <label for="addressHouse">
                            House / Flat / Building
                        </label>

                        <div class="address-input-wrapper">

                            <i class="fa-solid fa-building"></i>

                            <input
                                type="text"
                                name="house_no"
                                id="addressHouse"
                                placeholder="House no, flat no, building"
                                required>

                        </div>

                    </div>


                    {{-- Area / Street --}}

                    <div class="address-input-group">

                        <label for="addressStreet">
                            Area / Street
                        </label>

                        <div class="address-input-wrapper">

                            <i class="fa-solid fa-road"></i>

                            <input
                                type="text"
                                name="street"
                                id="addressStreet"
                                placeholder="Area, street or locality"
                                required>

                        </div>

                    </div>


                    {{-- Landmark --}}

                    <div class="address-input-group">

                        <label for="addressLandmark">

                            Landmark

                            <small>
                                (Optional)
                            </small>

                        </label>

                        <div class="address-input-wrapper">

                            <i class="fa-solid fa-landmark"></i>

                            <input
                                type="text"
                                name="landmark"
                                id="addressLandmark"
                                placeholder="Nearby landmark">

                        </div>

                    </div>


                    {{-- City + Pincode --}}

                    <div class="address-input-row">

                        <div class="address-input-group">

                            <label for="addressCity">
                                City
                            </label>

                            <div class="address-input-wrapper">

                                <i class="fa-solid fa-city"></i>

                                <input
                                    type="text"
                                    name="city"
                                    id="addressCity"
                                    placeholder="City"
                                    required>

                            </div>

                        </div>


                        <div class="address-input-group">

                            <label for="addressPincode">
                                Pincode
                            </label>

                            <div class="address-input-wrapper">

                                <i class="fa-solid fa-location-dot"></i>

                                <input
                                    type="text"
                                    name="pincode"
                                    id="addressPincode"
                                    placeholder="Pincode"
                                    maxlength="6"
                                    inputmode="numeric"
                                    required>

                            </div>

                        </div>

                    </div>


                    {{-- State --}}

                    <div class="address-input-group">

                        <label for="addressState">
                            State
                        </label>

                        <div class="address-input-wrapper">

                            <i class="fa-solid fa-map"></i>

                            <input
                                type="text"
                                name="state"
                                id="addressState"
                                placeholder="State"
                                required>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     GPS INFORMATION
                ================================================== --}}

                <div
                    class="address-gps-info"
                    id="addressGpsInfo">

                    <div class="address-gps-header">

                        <div class="address-gps-icon">

                            <i class="fa-solid fa-satellite-dish"></i>

                        </div>

                        <div>

                            <strong>
                                GPS Location
                            </strong>

                            <span>
                                Used for delivery availability
                            </span>

                        </div>

                    </div>


                    <div class="address-gps-values">

                        <div>

                            <small>
                                Latitude
                            </small>

                            <strong id="addressLatitudeDisplay">
                                Not detected
                            </strong>

                        </div>


                        <div>

                            <small>
                                Longitude
                            </small>

                            <strong id="addressLongitudeDisplay">
                                Not detected
                            </strong>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     DEFAULT ADDRESS
                ================================================== --}}

                <label class="address-default-option">

                    <input
                        type="checkbox"
                        name="is_default"
                        value="1"
                        id="addressIsDefault">

                    <span class="address-default-check">

                        <i class="fa-solid fa-check"></i>

                    </span>


                    <span class="address-default-content">

                        <strong>
                            Make this my default address
                        </strong>

                        <small>
                            Use this address automatically for future orders
                        </small>

                    </span>

                </label>


                {{-- =================================================
                     FORM ERROR
                ================================================== --}}

                <div
                    class="address-form-error"
                    id="addressFormError">
                </div>


                {{-- =================================================
                     SAVE BUTTON
                ================================================== --}}

                <button
                    type="submit"
                    class="address-save-btn"
                    id="saveAddressBtn">

                    <i class="fa-solid fa-check"></i>

                    Save Address

                </button>


            </form>

        </div>

    </div>

</div>


<style>

/* =========================================================
   ADDRESS FORM MODAL
========================================================= */

.address-form-modal {

    width: 100%;
    max-width: 430px;

    height: 88vh;
    max-height: 88vh;

    padding: 0 !important;

    display: flex;
    flex-direction: column;

    overflow: hidden;

}


/* =========================================================
   FIXED HEADER
========================================================= */

.address-form-modal .address-modal-header {

    flex: 0 0 auto;

    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 15px;

    padding: 17px 18px 15px;

    margin: 0 !important;

    background: #FFFFFF;

    border-bottom: 1px solid #EEEEEE;

    position: relative;

    z-index: 20;

}


/* Header title */

.address-form-modal .address-modal-header h3 {

    display: flex;

    align-items: center;

    gap: 7px;

    margin: 0;

    color: #172018;

    font-size: 18px;

    font-weight: 800;

}


.address-form-modal .address-modal-header h3 i {

    color: #176B3A;

    font-size: 16px;

}


/* Header subtitle */

.address-form-modal .address-modal-header p {

    margin: 4px 0 0;

    color: #747B75;

    font-size: 10px;

}


/* =========================================================
   CLOSE BUTTON
========================================================= */

.address-form-modal .address-modal-close {

    width: 36px;
    height: 36px;

    flex: 0 0 36px;

    display: flex;

    align-items: center;

    justify-content: center;

    padding: 0;

    border: 0;

    border-radius: 50%;

    background: #F1F3F0;

    color: #172018;

    font-size: 16px;

    cursor: pointer;

    transition: all 0.2s ease;

}


.address-form-modal .address-modal-close:hover {

    background: #E6EAE6;

}


.address-form-modal .address-modal-close:active {

    transform: scale(0.92);

}


/* =========================================================
   SCROLLABLE FORM
========================================================= */

.address-form-scroll {

    flex: 1 1 auto;

    min-height: 0;

    overflow-y: auto;

    overflow-x: hidden;

    padding: 18px;

    -webkit-overflow-scrolling: touch;

    overscroll-behavior: contain;

}


/* Scrollbar */

.address-form-scroll::-webkit-scrollbar {

    width: 4px;

}


.address-form-scroll::-webkit-scrollbar-track {

    background: transparent;

}


.address-form-scroll::-webkit-scrollbar-thumb {

    background: #D4DAD5;

    border-radius: 10px;

}


/* Firefox */

.address-form-scroll {

    scrollbar-width: thin;

    scrollbar-color: #D4DAD5 transparent;

}


/* =========================================================
   FORM SECTION
========================================================= */

.address-form-section {

    margin-bottom: 20px;

}


.address-form-section-title {

    margin-bottom: 9px;

    color: #747B75;

    font-size: 10px;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: 0.7px;

}


/* =========================================================
   LOCATION CARD
========================================================= */

.address-location-card {

    display: flex;

    align-items: center;

    gap: 10px;

    padding: 12px;

    border: 1px solid #E4E9E3;

    border-radius: 14px;

    background: #F7FAF7;

}


.address-location-icon {

    width: 39px;
    height: 39px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    background: #E7F3EA;

    color: #176B3A;

}


.address-location-content {

    flex: 1;

    min-width: 0;

}


.address-location-content strong {

    display: block;

    color: #172018;

    font-size: 11px;

}


.address-location-content span {

    display: block;

    margin-top: 2px;

    color: #747B75;

    font-size: 9px;

}


.address-detect-btn {

    border: 0;

    border-radius: 10px;

    padding: 9px 11px;

    background: #176B3A;

    color: #FFFFFF;

    font-family: inherit;

    font-size: 10px;

    font-weight: 800;

    cursor: pointer;

    white-space: nowrap;

}


.address-detect-btn.loading {

    opacity: 0.7;

    pointer-events: none;

}


/* =========================================================
   LOCATION STATUS
========================================================= */

.address-location-status {

    display: none;

    margin-top: 7px;

    padding: 9px 11px;

    border-radius: 10px;

    font-size: 9px;

    line-height: 1.5;

}


.address-location-status.show {

    display: block;

}


.address-location-status.loading {

    background: #FFF7E5;

    color: #946200;

}


.address-location-status.success {

    background: #EAF7EE;

    color: #23864A;

}


.address-location-status.error {

    background: #FFF0EF;

    color: #D94A45;

}


/* =========================================================
   ADDRESS TYPE
========================================================= */

.address-type-grid {

    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 8px;

}


.address-type-option {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 6px;

    padding: 11px 5px;

    border: 1px solid #E4E9E3;

    border-radius: 12px;

    background: #FFFFFF;

    color: #747B75;

    font-family: inherit;

    font-size: 10px;

    font-weight: 700;

    cursor: pointer;

    transition: all 0.2s ease;

}


.address-type-option.active {

    border-color: #176B3A;

    background: #EAF5ED;

    color: #176B3A;

}


.address-type-option i {

    font-size: 11px;

}


/* =========================================================
   INPUT
========================================================= */

.address-input-group {

    margin-bottom: 11px;

}


.address-input-group label {

    display: block;

    margin: 0 0 5px 2px;

    color: #3D453F;

    font-size: 9px;

    font-weight: 800;

}


.address-input-group label small {

    color: #999999;

    font-weight: 500;

}


.address-input-wrapper {

    position: relative;

}


.address-input-wrapper > i {

    position: absolute;

    left: 13px;

    top: 50%;

    transform: translateY(-50%);

    color: #9AA19B;

    font-size: 12px;

    pointer-events: none;

}


.address-input-wrapper input {

    width: 100%;

    height: 43px;

    padding: 0 12px 0 37px;

    border: 1px solid #E4E9E3;

    border-radius: 12px;

    outline: none;

    background: #FFFFFF;

    color: #172018;

    font-family: inherit;

    font-size: 11px;

    box-sizing: border-box;

}


.address-input-wrapper input::placeholder {

    color: #A2A8A3;

}


.address-input-wrapper input:focus {

    border-color: #176B3A;

    box-shadow: 0 0 0 3px rgba(23, 107, 58, 0.07);

}


/* =========================================================
   TWO COLUMNS
========================================================= */

.address-input-row {

    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 8px;

}


/* =========================================================
   GPS INFO
========================================================= */

.address-gps-info {

    margin-bottom: 15px;

    padding: 11px;

    border: 1px dashed #B8CBBE;

    border-radius: 13px;

    background: #F2F8F3;

}


.address-gps-header {

    display: flex;

    align-items: center;

    gap: 9px;

}


.address-gps-icon {

    width: 32px;
    height: 32px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    background: #FFFFFF;

    color: #176B3A;

}


.address-gps-header strong {

    display: block;

    font-size: 10px;

}


.address-gps-header span {

    display: block;

    margin-top: 2px;

    color: #747B75;

    font-size: 8px;

}


.address-gps-values {

    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 7px;

    margin-top: 9px;

}


.address-gps-values > div {

    padding: 7px;

    background: #FFFFFF;

    border-radius: 8px;

}


.address-gps-values small {

    display: block;

    color: #8A928C;

    font-size: 8px;

}


.address-gps-values strong {

    display: block;

    margin-top: 2px;

    color: #172018;

    font-size: 9px;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;

}


/* =========================================================
   DEFAULT ADDRESS
========================================================= */

.address-default-option {

    display: flex;

    align-items: center;

    gap: 9px;

    padding: 11px;

    margin-bottom: 13px;

    border: 1px solid #E4E9E3;

    border-radius: 12px;

    background: #FFFFFF;

    cursor: pointer;

}


.address-default-option input {

    display: none;

}


.address-default-check {

    width: 19px;
    height: 19px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border: 1.5px solid #C8CEC9;

    border-radius: 6px;

    color: #FFFFFF;

    font-size: 9px;

}


.address-default-option input:checked + .address-default-check {

    border-color: #176B3A;

    background: #176B3A;

}


.address-default-content {

    flex: 1;

}


.address-default-content strong {

    display: block;

    color: #172018;

    font-size: 10px;

}


.address-default-content small {

    display: block;

    margin-top: 2px;

    color: #747B75;

    font-size: 8px;

}


/* =========================================================
   FORM ERROR
========================================================= */

.address-form-error {

    display: none;

    margin-bottom: 10px;

    padding: 9px 11px;

    border-radius: 9px;

    background: #FFF0EF;

    color: #D94A45;

    font-size: 9px;

}


.address-form-error.show {

    display: block;

}


/* =========================================================
   SAVE BUTTON
========================================================= */

.address-save-btn {

    width: 100%;

    height: 47px;

    margin-bottom: 5px;

    border: 0;

    border-radius: 13px;

    background: #176B3A;

    color: #FFFFFF;

    font-family: inherit;

    font-size: 12px;

    font-weight: 800;

    cursor: pointer;

    box-shadow: 0 6px 18px rgba(23, 107, 58, 0.16);

}


.address-save-btn:active {

    transform: scale(0.98);

}


.address-save-btn.loading {

    opacity: 0.7;

    pointer-events: none;

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 360px) {

    .address-input-row {

        grid-template-columns: 1fr;

        gap: 0;

    }

}


/* =========================================================
   VERY SMALL SCREEN
========================================================= */

@media (max-height: 650px) {

    .address-form-modal {

        height: 94vh;

        max-height: 94vh;

    }

}

</style>