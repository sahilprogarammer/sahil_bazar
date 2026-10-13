@extends('frontend.layouts.app')

@section('title', 'My Profile - Nonveg Bazar')

@section('content')

<style>
    .profile-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);

        display: flex;
        align-items: flex-end;
        justify-content: center;

        opacity: 0;
        visibility: hidden;

        transition:
            opacity .25s ease,
            visibility .25s ease;

        z-index: 9999;
    }

    .profile-modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .profile-modal {
        width: 100%;
        max-width: 430px;

        max-height: 92vh;
        overflow-y: auto;

        background: #fff;

        border-radius: 24px 24px 0 0;

        padding: 20px 18px 28px;

        transform: translateY(100%);

        transition: transform .3s cubic-bezier(.22, 1, .36, 1);
    }

    .profile-modal-overlay.active .profile-modal {
        transform: translateY(0);
    }


    /* Header */

    .profile-modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;

        margin-bottom: 24px;
    }

    .profile-modal-header h3 {
        margin: 0;

        font-size: 21px;
        font-weight: 700;

        color: #172018;
    }

    .profile-modal-header p {
        margin: 5px 0 0;

        font-size: 13px;
        color: #7a817a;
    }

    .profile-modal-close {
        width: 38px;
        height: 38px;

        border: 0;
        border-radius: 50%;

        background: #f2f4f0;

        color: #172018;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 17px;

        cursor: pointer;
    }


    /* Profile image */

    .profile-image-edit {
        display: flex;
        flex-direction: column;
        align-items: center;

        margin-bottom: 25px;
    }

    .profile-image-wrapper {
        position: relative;

        width: 92px;
        height: 92px;
    }

    .profile-image-wrapper img {
        width: 92px;
        height: 92px;

        object-fit: cover;

        border-radius: 50%;

        border: 4px solid #f0f3ed;
    }

    .profile-image-camera {
        position: absolute;

        right: 0;
        bottom: 0;

        width: 32px;
        height: 32px;

        border-radius: 50%;

        background: #f47b20;
        color: #fff;

        border: 3px solid #fff;

        display: flex;
        align-items: center;
        justify-content: center;

        cursor: pointer;

        font-size: 12px;
    }

    .profile-image-edit span {
        margin-top: 9px;

        font-size: 12px;
        color: #7a817a;
    }


    /* Form */

    .profile-form-group {
        margin-bottom: 18px;
    }

    .profile-form-group label {
        display: block;

        margin-bottom: 7px;

        font-size: 13px;
        font-weight: 600;

        color: #172018;
    }

    .profile-input-box {
        height: 52px;

        display: flex;
        align-items: center;

        gap: 11px;

        padding: 0 14px;

        background: #f7f8f5;

        border: 1px solid #e4e8e1;

        border-radius: 14px;

        transition: .2s;
    }

    .profile-input-box:focus-within {
        border-color: #0b632f;
        background: #fff;
    }

    .profile-input-box>i:first-child {
        width: 18px;

        color: #6f786f;

        font-size: 15px;
    }

    .profile-input-box input {
        flex: 1;

        min-width: 0;

        border: 0;
        outline: 0;

        background: transparent;

        font-family: inherit;

        font-size: 14px;

        color: #172018;
    }

    .profile-input-box input::placeholder {
        color: #a0a6a0;
    }


    /* Disabled mobile */

    .profile-input-box.disabled {
        background: #eeeeec;

        border-color: #e1e2df;

        opacity: .85;
    }

    .profile-input-box.disabled input {
        color: #777d77;

        cursor: not-allowed;
    }

    .mobile-lock {
        font-size: 12px !important;

        color: #9a9f9a !important;
    }

    .profile-form-group small {
        display: block;

        margin-top: 6px;

        font-size: 11px;

        color: #929792;
    }


    /* Save */

    .save-profile-btn {
        width: 100%;

        height: 54px;

        border: 0;

        border-radius: 15px;

        background: #0b632f;

        color: #fff;

        font-family: inherit;

        font-size: 15px;
        font-weight: 700;

        cursor: pointer;

        display: flex;
        align-items: center;
        justify-content: center;

        transition: .2s;
    }

    .save-profile-btn:active {
        transform: scale(.98);
    }

    .save-profile-btn i {
        margin-right: 7px;
    }


    /* Desktop */

    @media (min-width: 600px) {

        .profile-modal {
            margin-bottom: 20px;

            border-radius: 24px;

            padding: 25px;

            transform: translateY(30px);
        }

        .profile-modal-overlay.active .profile-modal {
            transform: translateY(0);
        }

    }

    .profile-avatar {
    position: relative;
    width: 82px;
    height: 82px;

    border-radius: 50%;
    overflow: visible;

    background: #0b632f;

    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-avatar-image {
    width: 82px;
    height: 82px;

    object-fit: cover;

    border-radius: 50%;

    display: block;
}

.profile-avatar > span {
    width: 82px;
    height: 82px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #0b632f;
    color: #fff;

    font-size: 30px;
    font-weight: 700;
}

.avatar-edit {
    position: absolute;

    right: -2px;
    bottom: -2px;

    width: 30px;
    height: 30px;

    border: 3px solid #fff;
    border-radius: 50%;

    background: #f47b20;
    color: #fff;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 14px;

    cursor: pointer;

    z-index: 2;
}
</style>

{{-- =========================
         PROFILE HEADER
    ========================== --}}
<header class="profile-header">

    <div class="profile-header-top">

        <a href="{{ route('home') }}" class="profile-back-btn">
            ←
        </a>

        <h1>
            My Profile
        </h1>

        <button type="button" class="profile-settings-btn">
            ⚙
        </button>

    </div>


    {{-- =========================
             PROFILE USER
        ========================== --}}
    <div class="profile-user">

        <div class="profile-avatar">

            @if(Auth::user()->profile_image)
            <img
                src="{{ asset('profiles/' . Auth::user()->profile_image) }}"
                alt="{{ Auth::user()->name }}"
                class="profile-avatar-image"
                id="profileAvatarImage">
            @else
            <span id="profileAvatarInitial">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
            </span>
            @endif

            <button
                type="button"
                class="avatar-edit"
                onclick="openEditProfileModal()">
                ✎
            </button>

        </div>



        <!-- <div class="profile-user-info">

            <h2>
                Sahil
            </h2>

            <p>
                sahil@example.com
            </p>

            <span>
                +91 98765 43210
            </span>

        </div> -->

        <div class="profile-user-info">

            <h2>
                {{ $user->name }}
            </h2>

            <p>
                {{ $user->email }}
            </p>

            <span>
                +91 {{ $user->mobile }}
            </span>

        </div>


        <!-- <a
            href="#"
            class="edit-profile-btn">

            Edit

        </a> -->

    </div>

</header>


{{-- =========================
         PROFILE CONTENT
    ========================== --}}
<main class="profile-page">


    {{-- =========================
             QUICK STATS
        ========================== --}}
    <section class="profile-stats">

        <a href="#" class="profile-stat">

            <strong>
                {{ $orderCount }}
            </strong>

            <span>
                Orders
            </span>

        </a>


        <div class="profile-stat-divider"></div>


        <a href="#" class="profile-stat">

            <strong>
                4
            </strong>

            <span>
                Wishlist
            </span>

        </a>


        <div class="profile-stat-divider"></div>


        <a href="#" class="profile-stat">

            <strong>
                {{ $addressCount }}
            </strong>

            <span>
                Addresses
            </span>

        </a>

    </section>


    {{-- =========================
             MY ORDERS
        ========================== --}}
    <section class="profile-section">

        <div class="profile-section-heading">

            <h3>
                My Orders
            </h3>

            <a href="#">
                View All
            </a>

        </div>


        <div class="profile-menu-card">

            <a href="{{ route('my-orders') }}" class="profile-menu-item">

                <div class="profile-menu-icon order-icon">
                    📦
                </div>

                <div class="profile-menu-info">

                    <strong>
                        My Orders
                    </strong>

                    <span>
                        Track and manage your orders
                    </span>

                </div>

                <span class="profile-menu-arrow">
                    →
                </span>

            </a>


            <a href="#" class="profile-menu-item">

                <div class="profile-menu-icon delivery-icon-profile">
                    🚴
                </div>

                <div class="profile-menu-info">

                    <strong>
                        Track Order
                    </strong>

                    <span>
                        Check your active deliveries
                    </span>

                </div>

                <span class="profile-menu-arrow">
                    →
                </span>

            </a>

        </div>

    </section>


    {{-- =========================
             SAVED INFORMATION
        ========================== --}}
    <section class="profile-section">

        <div class="profile-section-heading">

            <h3>
                Saved Information
            </h3>

        </div>


        <div class="profile-menu-card">

            <a class="profile-menu-item" onclick="openAddressSelector()">

                <div class="profile-menu-icon address-icon-profile">
                    📍
                </div>

                <div class="profile-menu-info">

                    <strong>
                        Saved Addresses
                    </strong>

                    <span>
                        Manage your delivery addresses
                    </span>

                </div>

                <span class="profile-menu-arrow">
                    →
                </span>

            </a>


            <!-- <a href="#" class="profile-menu-item">

                <div class="profile-menu-icon wishlist-icon">
                    ♡
                </div>

                <div class="profile-menu-info">

                    <strong>
                        Wishlist
                    </strong>

                    <span>
                        Your favourite products
                    </span>

                </div>

                <span class="profile-menu-arrow">
                    →
                </span>

            </a>


            <a href="#" class="profile-menu-item">

                <div class="profile-menu-icon coupon-icon-profile">
                    %
                </div>

                <div class="profile-menu-info">

                    <strong>
                        Coupons & Offers
                    </strong>

                    <span>
                        Save more on your orders
                    </span>

                </div>

                <span class="profile-menu-arrow">
                    →
                </span>

            </a> -->

        </div>

    </section>


    {{-- =========================
             SUPPORT
        ========================== --}}
    <section class="profile-section">

        <div class="profile-section-heading">

            <h3>
                Support
            </h3>

        </div>


        <div class="profile-menu-card">

            <a href="#" class="profile-menu-item">

                <div class="profile-menu-icon help-icon">
                    ?
                </div>

                <div class="profile-menu-info">

                    <strong>
                        Help & Support
                    </strong>

                    <span>
                        Get help with your orders
                    </span>

                </div>

                <span class="profile-menu-arrow">
                    →
                </span>

            </a>


            <a href="#" class="profile-menu-item">

                <div class="profile-menu-icon settings-icon">
                    ⚙
                </div>

                <div class="profile-menu-info">

                    <strong>
                        Settings
                    </strong>

                    <span>
                        Notifications and preferences
                    </span>

                </div>

                <span class="profile-menu-arrow">
                    →
                </span>

            </a>

        </div>

    </section>


    {{-- =========================
             LOGOUT
        ========================== --}}
    @if(Auth::check())
    <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf

        <button type="submit" class="logout-btn">
            <span>↪</span>
            Logout
        </button>
    </form>
    @endif


    <div class="profile-version">
        Nonveg Bazar • Version 1.0.0
    </div>


    <div class="profile-modal-overlay" id="editProfileModal">

        <div class="profile-modal">

            <!-- Header -->
            <div class="profile-modal-header">

                <div>
                    <h3>Edit Profile</h3>
                    <p>Update your profile information</p>
                </div>

                <button
                    type="button"
                    class="profile-modal-close"
                    onclick="closeEditProfileModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </div>

            <!-- Form -->
            <form
                id="editProfileForm"
                method="POST"
                action="{{ route('profile.update') }}"
                enctype="multipart/form-data">

                @csrf

                <!-- Profile Image -->
                <div class="profile-image-edit">

                    <div class="profile-image-wrapper">

                        <img
                            src="{{ Auth::user()->profile_image
                            ? asset('profiles/' . Auth::user()->profile_image)
                            : asset('images/default-user.png') }}"
                            id="profileImagePreview"
                            alt="Profile">

                        <label
                            for="profileImageInput"
                            class="profile-image-camera">

                            <i class="fa-solid fa-camera"></i>

                        </label>

                    </div>

                    <input
                        type="file"
                        name="profile_image"
                        id="profileImageInput"
                        accept="image/*"
                        hidden>

                    <span>Change profile photo</span>

                </div>


                <!-- Name -->
                <div class="profile-form-group">

                    <label for="profileName">
                        Name
                    </label>

                    <div class="profile-input-box">

                        <i class="fa-regular fa-user"></i>

                        <input
                            type="text"
                            name="name"
                            id="profileName"
                            value="{{ Auth::user()->name }}"
                            placeholder="Enter your name"
                            required>

                    </div>

                </div>


                <!-- Email -->
                <div class="profile-form-group">

                    <label for="profileEmail">
                        Email
                    </label>

                    <div class="profile-input-box">

                        <i class="fa-regular fa-envelope"></i>

                        <input
                            type="email"
                            name="email"
                            id="profileEmail"
                            value="{{ Auth::user()->email }}"
                            placeholder="Enter your email">

                    </div>

                </div>


                <!-- Mobile -->
                <div class="profile-form-group">

                    <label for="profileMobile">
                        Mobile Number
                    </label>

                    <div class="profile-input-box disabled">

                        <i class="fa-solid fa-mobile-screen-button"></i>

                        <input
                            type="text"
                            id="profileMobile"
                            value="{{ Auth::user()->mobile }}"
                            disabled>

                        <i class="fa-solid fa-lock mobile-lock"></i>

                    </div>

                    <small>
                        Mobile number cannot be changed.
                    </small>

                </div>


                <!-- Submit -->
                <button
                    type="submit"
                    class="save-profile-btn"
                    id="saveProfileBtn">

                    <span class="save-profile-text">
                        <i class="fa-solid fa-check"></i>
                        Save Changes
                    </span>

                    <span
                        class="save-profile-loading"
                        style="display:none;">

                        <i class="fa-solid fa-spinner fa-spin"></i>
                        Saving...

                    </span>

                </button>

            </form>

        </div>

    </div>


</main>

<script>
    function openEditProfileModal() {

        const modal =
            document.getElementById('editProfileModal');

        if (!modal) return;

        modal.classList.add('active');

        document.body.style.overflow = 'hidden';
    }


    function closeEditProfileModal() {

        const modal =
            document.getElementById('editProfileModal');

        if (!modal) return;

        modal.classList.remove('active');

        document.body.style.overflow = '';
    }


    /*
    |--------------------------------------------------------------------------
    | Close when clicking outside
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', function(event) {

        const modal =
            document.getElementById('editProfileModal');

        if (!modal) return;

        if (event.target === modal) {
            closeEditProfileModal();
        }

    });


    /*
    |--------------------------------------------------------------------------
    | Profile image preview
    |--------------------------------------------------------------------------
    */

    const profileImageInput =
        document.getElementById('profileImageInput');

    if (profileImageInput) {

        profileImageInput.addEventListener('change', function() {

            const file = this.files[0];

            if (!file) return;

            if (!file.type.startsWith('image/')) {

                alert('Please select an image.');

                this.value = '';

                return;
            }

            const reader =
                new FileReader();

            reader.onload = function(e) {

                document.getElementById(
                    'profileImagePreview'
                ).src = e.target.result;

            };

            reader.readAsDataURL(file);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Submit profile
    |--------------------------------------------------------------------------
    */

    const editProfileForm =
        document.getElementById('editProfileForm');

    if (editProfileForm) {

        editProfileForm.addEventListener('submit', async function(event) {

            event.preventDefault();

            const button =
                document.getElementById('saveProfileBtn');

            const normalText =
                button.querySelector('.save-profile-text');

            const loadingText =
                button.querySelector('.save-profile-loading');

            normalText.style.display = 'none';
            loadingText.style.display = 'inline';

            button.disabled = true;

            try {

                const formData =
                    new FormData(this);

                const response =
                    await fetch(this.action, {

                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]'
                            ).getAttribute('content'),

                            'Accept': 'application/json'
                        },

                        body: formData

                    });

                const data =
                    await response.json();

                if (!response.ok || !data.success) {

                    throw new Error(
                        data.message ||
                        'Unable to update profile.'
                    );

                }

                closeEditProfileModal();

                /*
                 * Update profile information on page
                 */

                const nameElement =
                    document.getElementById('profileDisplayName');

                const emailElement =
                    document.getElementById('profileDisplayEmail');

                if (nameElement && data.user?.name) {
                    nameElement.textContent =
                        data.user.name;
                }

                if (emailElement && data.user?.email) {
                    emailElement.textContent =
                        data.user.email;
                }
                /*
                 * Optional page refresh
                 */
                setTimeout(function() {
                    window.location.reload();
                }, 300);

            } catch (error) {

                alert(
                    error.message ||
                    'Something went wrong.'
                );

            } finally {

                normalText.style.display = 'inline';
                loadingText.style.display = 'none';

                button.disabled = false;

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Escape key
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {
            closeEditProfileModal();
        }

    });
</script>


@include('frontend.components.bottom-nav')

@endsection