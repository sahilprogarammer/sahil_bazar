@extends('admin.layouts.app')

@section('title', 'Add Product - Basic Information')

@section('content')

<div class="page-wrapper">

    <div class="product-card">

        <form
            action="{{ route('admin.addDeliveryBoy.save') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            {{-- Delivery Boy ID - only during edit --}}
            @if(isset($deliveryBoy) && $deliveryBoy)
            <input
                type="hidden"
                name="id"
                value="{{ $deliveryBoy->id }}">
            @endif


            {{-- =========================
         DELIVERY BOY INFORMATION
    ========================== --}}
            <div class="form-section">

                <div class="section-title">

                    <div class="section-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>

                    <div>
                        <h3>Delivery Boy Information</h3>
                        <p>
                            Enter delivery boy personal and vehicle details
                        </p>
                    </div>

                </div>


                <div class="row">

                    {{-- =========================
                 NAME
            ========================== --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Full Name <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $deliveryBoy->name ?? '') }}"
                            placeholder="Enter full name"
                            required>

                        @error('name')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>


                    {{-- =========================
                 MOBILE
            ========================== --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Mobile Number <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="mobile"
                            class="form-control"
                            value="{{ old('mobile', $deliveryBoy->mobile ?? '') }}"
                            placeholder="Enter mobile number"
                            maxlength="10"
                            required>

                        @error('mobile')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>


                    {{-- =========================
                 EMAIL
            ========================== --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $deliveryBoy->email ?? '') }}"
                            placeholder="Enter email address">

                        @error('email')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>


                    {{-- =========================
                 PASSWORD
            ========================== --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Password
                            @if(!isset($deliveryBoy))
                            <span>*</span>
                            @endif
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="{{ isset($deliveryBoy) ? 'Leave blank to keep current password' : 'Enter password' }}"
                            {{ !isset($deliveryBoy) ? 'required' : '' }}>

                        @error('password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>


                    {{-- =========================
                 PROFILE IMAGE
            ========================== --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Profile Image
                        </label>

                        <input
                            type="file"
                            name="profile_image"
                            class="form-control"
                            accept="image/*">

                        @if(isset($deliveryBoy) && $deliveryBoy->profile_image)

                        <div class="mt-2">

                            <img
                                src="{{ asset($deliveryBoy->profile_image) }}"
                                width="70"
                                height="70"
                                style="object-fit: cover; border-radius: 10px;">

                        </div>

                        @endif

                        @error('profile_image')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>


                    {{-- =========================
                 ADDRESS
            ========================== --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Address
                        </label>

                        <textarea
                            name="address"
                            class="form-control"
                            rows="3"
                            placeholder="Enter delivery boy address">{{ old('address', $deliveryBoy->address ?? '') }}</textarea>

                        @error('address')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- =========================
         VEHICLE INFORMATION
    ========================== --}}
            <div class="form-section">

                <div class="section-title">

                    <div class="section-icon">
                        <i class="bi bi-bicycle"></i>
                    </div>

                    <div>
                        <h3>Vehicle Information</h3>
                        <p>
                            Enter delivery vehicle details
                        </p>
                    </div>

                </div>


                <div class="row">

                    {{-- VEHICLE TYPE --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Vehicle Type <span>*</span>
                        </label>

                        <select
                            name="vehicle_type"
                            class="form-select"
                            required>

                            <option value="">
                                Select Vehicle Type
                            </option>

                            <option
                                value="bike"
                                {{ old('vehicle_type', $deliveryBoy->vehicle_type ?? '') == 'bike' ? 'selected' : '' }}>
                                Bike
                            </option>

                            <option
                                value="scooter"
                                {{ old('vehicle_type', $deliveryBoy->vehicle_type ?? '') == 'scooter' ? 'selected' : '' }}>
                                Scooter
                            </option>

                            <option
                                value="cycle"
                                {{ old('vehicle_type', $deliveryBoy->vehicle_type ?? '') == 'cycle' ? 'selected' : '' }}>
                                Cycle
                            </option>

                            <option
                                value="auto"
                                {{ old('vehicle_type', $deliveryBoy->vehicle_type ?? '') == 'auto' ? 'selected' : '' }}>
                                Auto
                            </option>

                            <option
                                value="other"
                                {{ old('vehicle_type', $deliveryBoy->vehicle_type ?? '') == 'other' ? 'selected' : '' }}>
                                Other
                            </option>

                        </select>

                        @error('vehicle_type')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>


                    {{-- VEHICLE NUMBER --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Vehicle Number
                        </label>

                        <input
                            type="text"
                            name="vehicle_number"
                            class="form-control"
                            value="{{ old('vehicle_number', $deliveryBoy->vehicle_number ?? '') }}"
                            placeholder="e.g. OD 02 AB 1234"
                            style="text-transform: uppercase;">

                        @error('vehicle_number')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- =========================
         ACCOUNT STATUS
    ========================== --}}
            <div class="form-section">

                <div class="section-title">

                    <div class="section-icon">
                        <i class="bi bi-toggle-on"></i>
                    </div>

                    <div>
                        <h3>Account Status</h3>
                        <p>
                            Manage delivery boy availability
                        </p>
                    </div>

                </div>


                <div class="row">

                    {{-- IS ACTIVE --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Account Status
                        </label>

                        <select
                            name="is_active"
                            class="form-select">

                            <option
                                value="1"
                                {{ old('is_active', $deliveryBoy->is_active ?? 1) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option
                                value="0"
                                {{ old('is_active', $deliveryBoy->is_active ?? 1) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- IS ONLINE --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Online Status
                        </label>

                        <select
                            name="is_online"
                            class="form-select">

                            <option
                                value="0"
                                {{ old('is_online', $deliveryBoy->is_online ?? 0) == 0 ? 'selected' : '' }}>
                                Offline
                            </option>

                            <option
                                value="1"
                                {{ old('is_online', $deliveryBoy->is_online ?? 0) == 1 ? 'selected' : '' }}>
                                Online
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- =========================
         LOCATION
    ========================== --}}
            <!-- @if(isset($deliveryBoy) && $deliveryBoy)

            <div class="form-section">

                <div class="section-title">

                    <div class="section-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>

                    <div>
                        <h3>Current Location</h3>
                        <p>
                            Last known delivery boy location
                        </p>
                    </div>

                </div>


                <div class="row">

                    {{-- LATITUDE --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Latitude
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $deliveryBoy->current_latitude ?? '' }}"
                            readonly>

                    </div>


                    {{-- LONGITUDE --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Longitude
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $deliveryBoy->current_longitude ?? '' }}"
                            readonly>

                    </div>


                    {{-- LAST LOCATION --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Last Location Update
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $deliveryBoy->last_location_at ?? 'Not available' }}"
                            readonly>

                    </div>

                </div>

            </div>

            @endif -->


            {{-- =========================
         FOOTER
    ========================== --}}
            <div class="form-footer">

                <a
                    href="{{ url()->previous() }}"
                    class="cancel-btn">

                    Cancel

                </a>


                <button
                    type="submit"
                    class="save-btn">

                    @if(isset($deliveryBoy) && $deliveryBoy)

                    Update Delivery Boy

                    @else

                    Save Delivery Boy

                    @endif

                    <i class="bi bi-check-lg"></i>

                </button>

            </div>

        </form>


    </div>


</div>

<style>
    /* =========================================
   PAGE
========================================= */

    .page-wrapper {
        max-width: 1200px;
        margin: auto;
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .page-title {
        font-size: 27px;
        font-weight: 700;
        color: #172018;
        margin: 0 0 5px;
    }

    .page-subtitle {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }


    /* =========================================
   BACK BUTTON
========================================= */

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #374151;
        text-decoration: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
    }

    .back-btn:hover {
        color: #111827;
        background: #f9fafb;
    }


    /* =========================================
   STEP CARD
========================================= */

    .step-card {
        background: #fff;
        border: 1px solid #e8ece8;
        border-radius: 16px;
        padding: 18px 22px;
        margin-bottom: 20px;

        display: flex;
        align-items: center;
    }

    .step-item {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .step-number {
        width: 38px;
        height: 38px;
        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #f1f3f1;
        color: #7a827b;

        font-size: 14px;
        font-weight: 700;
    }

    .step-item.active .step-number {
        background: #176b3a;
        color: #fff;
    }

    .step-content {
        display: flex;
        flex-direction: column;
    }

    .step-content strong {
        font-size: 13px;
        color: #303730;
    }

    .step-item.active .step-content strong {
        color: #176b3a;
    }

    .step-content span {
        font-size: 11px;
        color: #8a918b;
        margin-top: 2px;
    }

    .step-line {
        height: 1px;
        background: #e1e6e1;
        flex: 1;
        margin: 0 16px;
    }


    /* =========================================
   PRODUCT CARD
========================================= */

    .product-card {
        background: #fff;
        border: 1px solid #e8ece8;
        border-radius: 18px;
        overflow: hidden;
    }


    /* =========================================
   FORM SECTION
========================================= */

    .form-section {
        padding: 26px;
        border-bottom: 1px solid #edf0ed;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 13px;
        margin-bottom: 24px;
    }

    .section-icon {
        width: 42px;
        height: 42px;
        border-radius: 11px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #eef7ef;
        color: #176b3a;

        font-size: 19px;
    }

    .section-title h3 {
        margin: 0 0 3px;
        font-size: 17px;
        font-weight: 700;
        color: #172018;
    }

    .section-title p {
        margin: 0;
        font-size: 13px;
        color: #7a827b;
    }


    /* =========================================
   LABEL
========================================= */

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #303730;
        margin-bottom: 8px;
    }

    .form-label span {
        color: #dc2626;
    }


    /* =========================================
   INPUT
========================================= */

    .form-control,
    .form-select {
        min-height: 45px;
        border: 1px solid #dfe5df;
        border-radius: 10px;

        font-size: 14px;
        color: #172018;

        box-shadow: none !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #176b3a;

        box-shadow:
            0 0 0 3px rgba(23, 107, 58, .08) !important;
    }


    /* =========================================
   FOOTER
========================================= */

    .form-footer {
        padding: 20px 26px;

        display: flex;
        align-items: center;
        justify-content: flex-end;

        gap: 10px;

        background: #fcfdfc;
    }

    .cancel-btn {
        padding: 11px 20px;

        border-radius: 10px;
        border: 1px solid #dfe4df;

        background: #fff;
        color: #4b5563;

        text-decoration: none;

        font-size: 14px;
        font-weight: 600;
    }

    .cancel-btn:hover {
        background: #f9fafb;
        color: #374151;
    }

    .save-btn {
        border: 0;

        padding: 11px 21px;

        border-radius: 10px;

        background: #176b3a;
        color: #fff;

        font-size: 14px;
        font-weight: 600;

        cursor: pointer;

        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .save-btn:hover {
        background: #12562e;
    }


    /* =========================================
   RESPONSIVE
========================================= */

    @media (max-width: 768px) {

        .page-wrapper {
            width: 100%;
        }

        .page-header {
            align-items: flex-start;
            gap: 15px;
        }

        .page-title {
            font-size: 23px;
        }

        .step-card {
            overflow-x: auto;
            padding: 15px;
        }

        .step-content span {
            display: none;
        }

        .step-line {
            min-width: 25px;
            margin: 0 10px;
        }

        .form-section {
            padding: 20px 16px;
        }

        .form-footer {
            padding: 16px;
        }

    }


    @media (max-width: 480px) {

        .page-header {
            display: block;
        }

        .back-btn {
            margin-top: 14px;
        }

        .step-card {
            border-radius: 12px;
        }

        .step-item {
            gap: 7px;
        }

        .step-number {
            width: 34px;
            height: 34px;
            font-size: 13px;
        }

        .step-content strong {
            font-size: 11px;
        }

        .section-title {
            align-items: flex-start;
        }

        .section-icon {
            flex-shrink: 0;
        }

        .form-footer {
            flex-direction: row;
        }

        .cancel-btn,
        .save-btn {
            flex: 1;
            text-align: center;
            justify-content: center;
        }

    }
</style>


@endsection