@extends('admin.layouts.app')

@section('title', 'Delivery Boy Management')

@section('content')

<div class="page-wrapper">

    <!-- =========================================
         PAGE HEADER
    ========================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <div class="page-title">
                Delivery Boys
            </div>

            <div class="page-subtitle">
                Manage delivery boys and their status
            </div>
        </div>


        <!-- Add Delivery Boy -->
        <a href="{{ route('admin.addDeliveryBoy') }}"class="add-btn" title="Add Delivery Boy">
            <i class="bi bi-plus-lg"></i>
        </a>

    </div>


    <!-- =========================================
         DELIVERY BOY TABLE CARD
    ========================================== -->

    <div class="premium-card">

        <!-- =========================================
             TABLE
        ========================================== -->

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>
                            Delivery Boy
                        </th>

                        <th>
                            Mobile
                        </th>

                        <th>
                            Vehicle
                        </th>

                        <th>
                            Online
                        </th>

                        <th>
                            Account
                        </th>

                        <th>
                            Created
                        </th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($alldata as $deliveryBoy)

                    <tr>

                        {{-- =================================
                 DELIVERY BOY
            ================================== --}}
                        <td>

                            <div class="category-wrapper">

                                {{-- Profile Image --}}
                                <div class="category-image">

                                    @if($deliveryBoy->profile_image)

                                    <img
                                        src="{{ asset($deliveryBoy->profile_image) }}"
                                        alt="{{ $deliveryBoy->name }}">

                                    @else

                                    <div class="category-placeholder">

                                        <i class="bi bi-person-fill"></i>

                                    </div>

                                    @endif

                                </div>


                                {{-- Name --}}
                                <div>

                                    <div class="category-name">
                                        {{ $deliveryBoy->name }}
                                    </div>

                                    <div class="category-id">
                                        #{{ $deliveryBoy->id }}
                                    </div>

                                </div>

                            </div>

                        </td>


                        {{-- =================================
                 MOBILE
            ================================== --}}
                        <td>

                            <div>
                                <strong>
                                    {{ $deliveryBoy->mobile }}
                                </strong>
                            </div>

                            @if($deliveryBoy->email)

                            <small class="text-muted">
                                {{ $deliveryBoy->email }}
                            </small>

                            @endif

                        </td>


                        {{-- =================================
                 VEHICLE
            ================================== --}}
                        <td>

                            @if($deliveryBoy->vehicle_type)

                            <span class="type-badge">

                                @if($deliveryBoy->vehicle_type === 'bike')

                                <i class="bi bi-bicycle"></i>

                                @elseif($deliveryBoy->vehicle_type === 'scooter')

                                <i class="bi bi-scooter"></i>

                                @elseif($deliveryBoy->vehicle_type === 'cycle')

                                <i class="bi bi-bicycle"></i>

                                @else

                                <i class="bi bi-truck"></i>

                                @endif

                                {{ ucfirst($deliveryBoy->vehicle_type) }}

                            </span>

                            @else

                            <span class="text-muted">
                                Not Set
                            </span>

                            @endif


                            @if($deliveryBoy->vehicle_number)

                            <div class="mt-1">

                                <small>
                                    {{ strtoupper($deliveryBoy->vehicle_number) }}
                                </small>

                            </div>

                            @endif

                        </td>


                        {{-- =================================
                 ONLINE STATUS
            ================================== --}}
                        <td>

                            @if($deliveryBoy->is_online)

                            <span class="status status-active">

                                <span class="status-dot"></span>

                                Online

                            </span>

                            @else

                            <span class="status status-inactive">

                                <span class="status-dot"></span>

                                Offline

                            </span>

                            @endif

                        </td>


                        {{-- =================================
                 ACCOUNT STATUS
            ================================== --}}
                        <td>

                            @if($deliveryBoy->is_active)

                            <span class="status status-active">

                                <span class="status-dot"></span>

                                Active

                            </span>

                            @else

                            <span class="status status-inactive">

                                <span class="status-dot"></span>

                                Inactive

                            </span>

                            @endif

                        </td>


                        {{-- =================================
                 CREATED
            ================================== --}}
                        <td>

                            <div class="created-date">

                                {{ $deliveryBoy->created_at?->format('d M Y') }}

                            </div>

                            <div class="created-time">

                                {{ $deliveryBoy->created_at?->format('h:i A') }}

                            </div>

                        </td>


                        {{-- =================================
                 ACTIONS
            ================================== --}}
                        <td>

                            <div class="action-wrapper">

                                {{-- Edit --}}
                                <a
                                    href="{{ route('admin.addDeliveryBoy.edit', $deliveryBoy->id) }}"
                                    class="icon-btn edit-btn"
                                    title="Edit">

                                    <i class="bi bi-pencil"></i>

                                </a>


                                {{-- Delete --}}
                                <form
                                    action="{{ route('admin.deliveryboy.delete', $deliveryBoy->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this delivery boy?');">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="icon-btn delete-btn"
                                        title="Delete">

                                        <i class="bi bi-trash3"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    {{-- =================================
             EMPTY STATE
        ================================== --}}
                    <tr>

                        <td
                            colspan="7"
                            class="text-center py-5">

                            <div class="empty-state">

                                <div class="empty-icon">

                                    <i class="bi bi-person-badge"></i>

                                </div>

                                <h6>
                                    No delivery boys found
                                </h6>

                                <p>
                                    Add your first delivery boy to get started.
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection