<header class="header">

    <div class="header-top">

        <div class="location">

            <div class="location-icon">
                📍
            </div>

            <div class="location-text" onclick="openAddressSelector()">
                <!-- <span class="location-label"> Deliver to </span> -->
                <strong id="headerAddress"> @if($defaultAddress) {{ $defaultAddress->address_type ? ucfirst($defaultAddress->address_type) : 'Home' }}
                    <span class="location-arrow">▾</span>
                    <p class="location-label">{{ $defaultAddress->full_address }}</p>
                    @else
                    Add Address
                    <span class="location-arrow">▾</span> @endif 
                </strong>
            </div>

        </div>


        <div class="header-actions">

            <button type="button" class="header-btn">
                🔔
                <span class="notification-dot"></span>
            </button>

            <!-- <button type="button" class="header-btn">
                👤
            </button> -->

        </div>

    </div>


    <!-- <div class="search-box">

        <span class="search-icon">
            ⌕
        </span>

        <input
            type="search"
            placeholder="Search chicken, fish, mutton..."
            autocomplete="off">

    </div> -->

</header>