@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')

<div class="page-wrapper">

    <!-- =========================================
         PAGE HEADER
    ========================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <div class="page-title">
                Delivery Charges
            </div>

            <div class="page-subtitle">
                Manage delivery charges based on distance and order amount
            </div>

        </div>


        <!-- ADD -->

        <button
            type="button"
            class="add-btn"
            data-bs-toggle="modal"
            data-bs-target="#deliveryChargeModal"
            title="Add Delivery Charge">

            <i class="bi bi-plus-lg"></i>

        </button>

    </div>


    <!-- =========================================
         TABLE CARD
    ========================================== -->

    <div class="premium-card">

        <!-- HEADER -->

        <div class="card-header-custom">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <strong>
                        All Delivery Rules
                    </strong>

                </div>

            </div>

        </div>


        <!-- =========================================
             TABLE
        ========================================== -->

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>
                            Rule
                        </th>

                        <th>
                            Distance
                        </th>

                        <th>
                            Order Amount
                        </th>

                        <th>
                            Delivery Charge
                        </th>

                        <th>
                            Status
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

                    @forelse($deliveryCharges as $deliveryCharge)

                        <tr>

                            <!-- RULE -->

                            <td>

                                <div class="rule-wrapper">

                                    <div>

                                        <div class="rule-id">
                                            #{{ $deliveryCharge->id }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            <!-- DISTANCE -->

                            <td>

                                <div class="range-main">

                                    {{ number_format($deliveryCharge->min_distance, 2) }}
                                    km

                                    <span class="range-arrow">
                                        →
                                    </span>

                                    @if($deliveryCharge->max_distance !== null)
                                        {{ number_format($deliveryCharge->max_distance, 2) }}
                                        km
                                    @else
                                        Unlimited
                                    @endif

                                </div>

                            </td>


                            <!-- ORDER AMOUNT -->

                            <td>

                                <div class="range-main">

                                    ₹{{ number_format($deliveryCharge->min_order_amount, 2) }}

                                    <span class="range-arrow">
                                        →
                                    </span>

                                    @if($deliveryCharge->max_order_amount !== null)

                                        ₹{{ number_format($deliveryCharge->max_order_amount, 2) }}

                                    @else

                                        Unlimited

                                    @endif

                                </div>

                            </td>


                            <!-- CHARGE -->

                            <td>

                                <div class="charge-amount">

                                    @if((float) $deliveryCharge->charge <= 0)

                                        FREE

                                    @else

                                        ₹{{ number_format($deliveryCharge->charge, 2) }}

                                    @endif

                                </div>

                            </td>


                            <!-- STATUS -->

                            <td>

                                @if($deliveryCharge->is_active)

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


                            <!-- CREATED -->

                            <td>

                                <div class="created-date">

                                    {{ $deliveryCharge->created_at?->format('d M Y') }}

                                </div>

                                <div class="created-time">

                                    {{ $deliveryCharge->created_at?->format('h:i A') }}

                                </div>

                            </td>


                            <!-- ACTIONS -->

                            <td>

                                <div class="action-wrapper">

                                    <!-- EDIT -->

                                    <button
                                        type="button"
                                        class="icon-btn edit-btn"
                                        title="Edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editDeliveryChargeModal{{ $deliveryCharge->id }}">

                                        <i class="bi bi-pencil"></i>

                                    </button>


                                    <!-- DELETE -->

                                    <form
                                        action=""
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this delivery charge rule?');">

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


                        <!-- =========================================
                             EDIT MODAL
                        ========================================== -->

                        <div
                            class="modal fade"
                            id="editDeliveryChargeModal{{ $deliveryCharge->id }}"
                            tabindex="-1"
                            aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content">


                                    <!-- HEADER -->

                                    <div class="modal-header">

                                        <div>

                                            <h5 class="modal-title mb-1">
                                                Edit Delivery Charge
                                            </h5>

                                        </div>

                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal">
                                        </button>

                                    </div>


                                    <!-- FORM -->

                                    <form
                                        action="{{ route('admin.deliverycharges.save') }}"
                                        method="POST">

                                        @csrf

                                        <input
                                            type="hidden"
                                            name="id"
                                            value="{{ $deliveryCharge->id }}">


                                        <div class="modal-body">

                                            <!-- DISTANCE -->

                                            <div class="row">

                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Minimum Distance
                                                    </label>

                                                    <div class="input-group">

                                                        <input
                                                            type="number"
                                                            name="min_distance"
                                                            class="form-control"
                                                            step="0.01"
                                                            min="0"
                                                            value="{{ $deliveryCharge->min_distance }}"
                                                            placeholder="0"
                                                            required>

                                                        <span class="input-group-text">
                                                            KM
                                                        </span>

                                                    </div>

                                                </div>


                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Maximum Distance
                                                    </label>

                                                    <div class="input-group">

                                                        <input
                                                            type="number"
                                                            name="max_distance"
                                                            class="form-control"
                                                            step="0.01"
                                                            min="0"
                                                            value="{{ $deliveryCharge->max_distance }}"
                                                            placeholder="5">

                                                        <span class="input-group-text">
                                                            KM
                                                        </span>

                                                    </div>

                                                </div>

                                            </div>


                                            <!-- ORDER AMOUNT -->

                                            <div class="row">

                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Minimum Order Amount
                                                    </label>

                                                    <div class="input-group">

                                                        <span class="input-group-text">
                                                            ₹
                                                        </span>

                                                        <input
                                                            type="number"
                                                            name="min_order_amount"
                                                            class="form-control"
                                                            step="0.01"
                                                            min="0"
                                                            value="{{ $deliveryCharge->min_order_amount }}"
                                                            placeholder="0"
                                                            required>

                                                    </div>

                                                </div>


                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Maximum Order Amount
                                                    </label>

                                                    <div class="input-group">

                                                        <span class="input-group-text">
                                                            ₹
                                                        </span>

                                                        <input
                                                            type="number"
                                                            name="max_order_amount"
                                                            class="form-control"
                                                            step="0.01"
                                                            min="0"
                                                            value="{{ $deliveryCharge->max_order_amount }}"
                                                            placeholder="500">

                                                    </div>

                                                </div>

                                            </div>


                                            <!-- CHARGE -->

                                            <div class="mb-3">

                                                <label class="form-label">
                                                    Delivery Charge
                                                </label>

                                                <div class="input-group">

                                                    <span class="input-group-text">
                                                        ₹
                                                    </span>

                                                    <input
                                                        type="number"
                                                        name="charge"
                                                        class="form-control"
                                                        step="0.01"
                                                        min="0"
                                                        value="{{ $deliveryCharge->charge }}"
                                                        placeholder="30"
                                                        required>

                                                </div>

                                            </div>


                                            <!-- STATUS -->

                                            <div class="mb-3">

                                                <label class="form-label">
                                                    Status
                                                </label>

                                                <select
                                                    name="is_active"
                                                    class="form-select"
                                                    required>

                                                    <option
                                                        value="1"
                                                        {{ $deliveryCharge->is_active ? 'selected' : '' }}>
                                                        Active
                                                    </option>

                                                    <option
                                                        value="0"
                                                        {{ !$deliveryCharge->is_active ? 'selected' : '' }}>
                                                        Inactive
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        <!-- FOOTER -->

                                        <div class="modal-footer">

                                            <button
                                                type="button"
                                                class="btn btn-light"
                                                data-bs-dismiss="modal">

                                                Cancel

                                            </button>

                                            <button
                                                type="submit"
                                                class="save-btn">

                                                <i class="bi bi-check-lg me-1"></i>

                                                Update Rule

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @empty

                        <!-- EMPTY -->

                        <tr>

                            <td
                                colspan="7"
                                class="text-center">

                                <div class="empty-state">

                                    <div class="empty-icon">

                                        <i class="bi bi-truck"></i>

                                    </div>

                                    <h6>
                                        No delivery rules found
                                    </h6>

                                    <p>
                                        Create your first delivery charge rule.
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



<!-- =========================================
     ADD DELIVERY CHARGE MODAL
========================================== -->

<div
    class="modal fade"
    id="deliveryChargeModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            <!-- HEADER -->

            <div class="modal-header">

                <div>

                    <h5 class="modal-title mb-1">
                        Add Delivery Charge
                    </h5>

                    <div class="page-subtitle">
                        Create a new delivery charge rule
                    </div>

                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>


            <!-- FORM -->

            <form
                action="{{ route('admin.deliverycharges.save') }}"
                method="POST">

                @csrf


                <div class="modal-body">


                    <!-- DISTANCE -->

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Minimum Distance
                            </label>

                            <div class="input-group">

                                <input
                                    type="number"
                                    name="min_distance"
                                    class="form-control"
                                    step="0.01"
                                    min="0"
                                    placeholder="0"
                                    required>

                                <span class="input-group-text">
                                    KM
                                </span>

                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Maximum Distance
                            </label>

                            <div class="input-group">

                                <input
                                    type="number"
                                    name="max_distance"
                                    class="form-control"
                                    step="0.01"
                                    min="0"
                                    placeholder="5">

                                <span class="input-group-text">
                                    KM
                                </span>

                            </div>

                        </div>

                    </div>


                    <!-- ORDER AMOUNT -->

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Minimum Order Amount
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    ₹
                                </span>

                                <input
                                    type="number"
                                    name="min_order_amount"
                                    class="form-control"
                                    step="0.01"
                                    min="0"
                                    placeholder="0"
                                    required>

                            </div>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Maximum Order Amount
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    ₹
                                </span>

                                <input
                                    type="number"
                                    name="max_order_amount"
                                    class="form-control"
                                    step="0.01"
                                    min="0"
                                    placeholder="500">

                            </div>

                        </div>

                    </div>


                    <!-- CHARGE -->

                    <div class="mb-3">

                        <label class="form-label">
                            Delivery Charge
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                ₹
                            </span>

                            <input
                                type="number"
                                name="charge"
                                class="form-control"
                                step="0.01"
                                min="0"
                                placeholder="30"
                                required>

                        </div>

                    </div>


                    <!-- STATUS -->

                    <div class="mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="is_active"
                            class="form-select"
                            required>

                            <option value="1" selected>
                                Active
                            </option>

                            <option value="0">
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>


                <!-- FOOTER -->

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="save-btn">

                        <i class="bi bi-plus-lg me-1"></i>

                        Save Rule

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


@endsection