
<div
    class="address-modal-overlay"
    id="addressSelectorModal"
>

    <div class="address-modal">

        {{-- =========================
             HEADER
        ========================== --}}

        <div class="address-modal-header">

            <div>
                <h3>Select Delivery Address</h3>

                <p>
                    Choose where you want your order delivered
                </p>
            </div>

            <button
                type="button"
                class="address-modal-close"
                onclick="closeAddressSelector()"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>


        {{-- =================================================
             LOGIN CHECK
        ================================================== --}}

        @guest

            <div class="address-login-box">

                <div class="address-login-icon">

                    <i class="fa-solid fa-location-dot"></i>

                </div>

                <h4>
                    Login to select an address
                </h4>

                <p>
                    Please login to your account to view
                    and manage your delivery addresses.
                </p>

                <button
                    type="button"
                    class="address-login-btn"
                    onclick="closeAddressSelector(); openLoginPopup();"
                >

                    <i class="fa-solid fa-right-to-bracket"></i>

                    Login Now

                </button>

            </div>

        @else

            {{-- =========================
                 ADDRESS LIST
            ========================== --}}

            <div
                class="address-list"
                id="addressList"
            >

                {{-- Addresses will be loaded dynamically --}}

                <div class="address-loading">

                    <i class="fa-solid fa-spinner fa-spin"></i>

                    <span>
                        Loading addresses...
                    </span>

                </div>

            </div>


            {{-- =========================
                 ADD NEW ADDRESS
            ========================== --}}

            <button
                type="button"
                class="add-address-btn"
                onclick="openAddressForm()"
            >

                <span class="add-address-icon">

                    <i class="fa-solid fa-plus"></i>

                </span>

                <span class="add-address-text">

                    <strong>
                        Add New Address
                    </strong>

                    <small>
                        Add a new delivery location
                    </small>

                </span>

                <i class="fa-solid fa-chevron-right"></i>

            </button>


            {{-- =========================
                 USE SELECTED
            ========================== --}}

            <button
                type="button"
                class="use-address-btn"
                id="useSelectedAddressBtn"
                disabled
            >

                Use Selected Address

            </button>

        @endguest

    </div>

</div>

