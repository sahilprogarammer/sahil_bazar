@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')

<div class="page-wrapper">


    <!-- =========================================
         PAGE HEADER
    ========================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">
                Pending Reports
            </h4>

            <div class="text-muted">
                Manage all customer orders
            </div>

        </div>

    </div>


    <!-- =========================================
         PRODUCT TABLE CARD
    ========================================== -->

    <div class="premium-card">


        <!-- =========================================
             CARD HEADER
        ========================================== -->

        <!-- <div class="card-header-custom">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <strong>
                        All Orders
                    </strong>

                    <div class="page-subtitle">

                        {{ $orders->total() }} Orders

                    </div>

                </div>

            </div>

        </div> -->


        <!-- =========================================
             FILTERS
        ========================================== -->

        <div class="p-3 border-bottom">

            <form
                method="post"
                action="{{ route('admin.report.pendingorder.filter') }}">
                @csrf

                <div class="row g-3 align-items-end">


                    {{-- FROM DATE --}}
                    <div class="col-md-2">

                        <label class="form-label fw-semibold">
                            From Date
                        </label>

                        <input
                            type="date"
                            name="from_date"
                            class="form-control"
                            value="{{ request('from_date') }}">

                    </div>


                    {{-- TO DATE --}}
                    <div class="col-md-2">

                        <label class="form-label fw-semibold">
                            To Date
                        </label>

                        <input
                            type="date"
                            name="to_date"
                            class="form-control"
                            value="{{ request('to_date') }}">

                    </div>


                    {{-- ORDER ID --}}
                    <div class="col-md-3">

                        <label class="form-label fw-semibold">
                            Order ID
                        </label>

                        <input
                            type="text"
                            name="order_id"
                            class="form-control"
                            placeholder="Search order number..."
                            value="{{ request('order_id') }}">

                    </div>


                    {{-- BUTTONS --}}
                    <div class="col-md-3">

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="bi bi-funnel"></i>

                                Filter

                            </button>


                            <a
                                href="{{ route('admin.pendingorder') }}"
                                class="btn btn-outline-secondary">

                                <i class="bi bi-arrow-clockwise"></i>

                                Reset

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>


        <!-- =========================================
             TABLE
        ========================================== -->

        <div class="table-responsive">

            <table class="table align-middle">


                <!-- TABLE HEADER -->

                <thead>

                    <tr>

                        <th>
                            Order ID
                        </th>

                        <th>
                            Customer / Address
                        </th>

                        <th>
                            Product
                        </th>

                        <th>
                            Price
                        </th>

                        <th>
                            Unit
                        </th>

                        <th>
                            Quantity
                        </th>

                        <th>
                            Total
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Created
                        </th>

                        <!-- <th class="text-end">
                            Actions
                        </th> -->

                    </tr>

                </thead>


                <!-- TABLE BODY -->

                <tbody>


                    @forelse($orders as $order)


                    <tr>


                        {{-- =====================================
                             ORDER ID
                        ====================================== --}}

                        <td>

                            <div class="fw-semibold">

                                #{{ $order->order_number }}

                            </div>

                            <small class="text-muted">

                                Order #{{ $order->id }}

                            </small>

                        </td>


                        {{-- =====================================
                             CUSTOMER / ADDRESS
                        ====================================== --}}

                        <td style="min-width: 250px;">

                            @if($order->address)


                            <div class="fw-semibold">

                                {{ $order->address->name }}

                            </div>


                            <small class="text-muted d-block">

                                <i class="bi bi-telephone"></i>

                                {{ $order->address->mobile }}

                            </small>


                            <small class="text-muted d-block mt-1">

                                {{ $order->address->full_address }}

                            </small>


                            @else


                            <span class="text-muted">

                                Address not available

                            </span>


                            @endif

                        </td>


                        {{-- =====================================
                             PRODUCT
                        ====================================== --}}

                        <td>

                            @foreach($order->orderItems as $item)


                            <div
                                class="{{ !$loop->last ? 'mb-2 pb-2 border-bottom' : '' }}">

                                <div class="fw-semibold">

                                    {{ $item->product_name }}

                                </div>

                            </div>


                            @endforeach

                        </td>


                        {{-- =====================================
                             PRICE
                        ====================================== --}}

                        <td>

                            @foreach($order->orderItems as $item)


                            <div
                                class="{{ !$loop->last ? 'mb-2 pb-2 border-bottom' : '' }}">

                                <strong>

                                    ₹{{ number_format($item->selling_price, 2) }}

                                </strong>

                            </div>


                            @endforeach

                        </td>


                        {{-- =====================================
                             UNIT
                        ====================================== --}}

                        <td>

                            @foreach($order->orderItems as $item)


                            <div
                                class="{{ !$loop->last ? 'mb-2 pb-2 border-bottom' : '' }}">

                                {{ strtoupper($item->unit) }}

                            </div>


                            @endforeach

                        </td>


                        {{-- =====================================
                             QUANTITY
                        ====================================== --}}

                        <td>

                            @foreach($order->orderItems as $item)


                            <div
                                class="{{ !$loop->last ? 'mb-2 pb-2 border-bottom' : '' }}">

                                {{ number_format($item->quantity, 2) }}

                                {{ strtoupper($item->unit) }}

                            </div>


                            @endforeach

                        </td>


                        {{-- =====================================
                             TOTAL
                        ====================================== --}}

                        <td>

                            @foreach($order->orderItems as $item)


                            <div
                                class="{{ !$loop->last ? 'mb-2 pb-2 border-bottom' : '' }}">

                                <strong>

                                    ₹{{ number_format($item->total_price, 2) }}

                                </strong>

                            </div>


                            @endforeach

                        </td>


                        {{-- =====================================
                             STATUS
                        ====================================== --}}

                        <td>


                            @if($order->order_status === 'pending')


                            <span class="badge bg-warning text-dark">

                                Pending

                            </span>


                            @elseif($order->order_status === 'confirmed')


                            <span class="badge bg-primary">

                                Confirmed

                            </span>


                            @elseif($order->order_status === 'processing')


                            <span class="badge bg-info">

                                Processing

                            </span>


                            @elseif($order->order_status === 'shipped')


                            <span class="badge bg-primary">

                                Shipped

                            </span>


                            @elseif($order->order_status === 'delivered')


                            <span class="badge bg-success">

                                Delivered

                            </span>


                            @elseif($order->order_status === 'cancelled')


                            <span class="badge bg-danger">

                                Cancelled

                            </span>


                            @else


                            <span class="badge bg-secondary">

                                {{ ucfirst($order->order_status ?? 'Unknown') }}

                            </span>


                            @endif


                        </td>


                        {{-- =====================================
                             CREATED
                        ====================================== --}}

                        <td>

                            {{ $order->created_at->format('d M Y') }}

                            <br>

                            <small class="text-muted">

                                {{ $order->created_at->format('h:i A') }}

                            </small>

                        </td>


                        {{-- =====================================
                             ACTIONS
                        ====================================== --}}

                        <!-- <td class="text-end">

                            <a
                                href=""
                                class="btn btn-sm btn-outline-primary">

                                <i class="bi bi-eye"></i>

                                View

                            </a>

                        </td> -->


                    </tr>


                    @empty


                    <!-- =====================================
                         EMPTY STATE
                    ====================================== -->

                    <tr>

                        <td
                            colspan="10"
                            class="text-center py-5">


                            <i
                                class="bi bi-cart-x fs-1 text-muted">
                            </i>


                            <div class="mt-2 text-muted">

                                No orders found.

                            </div>


                            @if(
                            request()->filled('from_date') ||
                            request()->filled('to_date') ||
                            request()->filled('order_id') ||
                            request()->filled('status')
                            )

                            <a
                                href="{{ url()->current() }}"
                                class="btn btn-sm btn-outline-primary mt-3">

                                Clear Filters

                            </a>

                            @endif


                        </td>

                    </tr>


                    @endforelse


                </tbody>

            </table>

        </div>


        <!-- =========================================
             PAGINATION
        ========================================== -->

        @if($orders->hasPages())

        <div class="p-3">

            {{ $orders->withQueryString()->links() }}

        </div>

        @endif


    </div>

</div>

@endsection