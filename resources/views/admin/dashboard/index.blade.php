@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('page-description', 'Here’s what’s happening with your marketplace today.')

@section('content')


{{-- =====================================================
         DASHBOARD HEADER
    ====================================================== --}}

<div class="dashboard-header">

    <div>

        <div class="dashboard-welcome">
            Good evening, Admin 👋
        </div>
        <!-- <div>
            <form method="GET" action="{{ route('admin.dashboard') }}" class="row g-3 mb-4">

                <div class="col-md-4">
                    <label class="form-label">From Date</label>

                    <input
                        type="date"
                        name="from_date"
                        class="form-control"
                        value="{{ $fromDate }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">To Date</label>

                    <input
                        type="date"
                        name="to_date"
                        class="form-control"
                        value="{{ $toDate }}">
                </div>

                <div class="col-md-4 d-flex align-items-end gap-2">

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-filter"></i>
                        Filter
                    </button>

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="btn btn-secondary">
                        Today
                    </a>

                </div>

            </form>
        </div> -->

        <!-- <h2>
                Overview
            </h2> -->

        <!-- <p>
                Track your orders, sales, customers and products
                from one place.
            </p> -->

    </div>


    <div class="dashboard-actions">
        <form method="GET" action="{{ route('admin.dashboard') }}" id="dashboardDateForm">
            <input type="date" name="from_date" id="fromDate" value="{{ $fromDate }}" hidden>
            <input type="date" name="to_date" id="toDate" value="{{ $toDate }}" hidden>
            <button type="button" class="dashboard-date-btn" id="dashboardDateBtn">
                <span> 📅 </span>
                <span id="dashboardDateText"> @if($fromDate === $toDate) Today @else {{ \Carbon\Carbon::parse($fromDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($toDate)->format('d M Y') }} @endif </span>
                <span> ▾ </span> </button>
        </form>
    </div> <!-- Date Range Popup -->
    <div id="dashboardDatePopup" class="dashboard-date-popup">
        <div class="dashboard-date-popup-content">
            <div class="dashboard-date-header">
                <h4>Select Date Range</h4>
                <button type="button" id="closeDashboardDate"> × </button>
            </div>
            <div class="dashboard-date-fields">
                <div> <label>From Date</label> <input type="date" id="popupFromDate" value="{{ $fromDate }}"> </div>
                <div> <label>To Date</label> <input type="date" id="popupToDate" value="{{ $toDate }}"> </div>
            </div>
            <div class="dashboard-date-actions">

                <button
                    type="button"
                    id="resetDashboardDate"
                    class="date-today-btn">
                    Reset
                </button>

                <button
                    type="button"
                    id="applyDashboardDate"
                    class="date-apply-btn">
                    Apply
                </button>

            </div>
        </div>
    </div>

</div>



{{-- =====================================================
         STAT CARDS
    ====================================================== --}}

<div class="dashboard-stat-grid">


    {{-- REVENUE --}}

    <div class="dashboard-stat-card">

        <div class="stat-card-top">

            <div class="stat-icon revenue">
                ₹
            </div>

        </div>

        <div class="stat-label">
            Total Revenue
        </div>

        <div class="stat-value">
            ₹{{ $totalRevenue }}
        </div>

    </div>


    {{-- ORDERS --}}

    <div class="dashboard-stat-card">

        <div class="stat-card-top">

            <div class="stat-icon orders">
                📦
            </div>

        </div>

        <div class="stat-label">
            Total Orders
        </div>

        <div class="stat-value">
            {{ $totalOrders }}
        </div>

    </div>
    <div class="dashboard-stat-card">

        <div class="stat-card-top">

            <div class="stat-icon orders">
                📦
            </div>

        </div>

        <div class="stat-label">
            Orders Completed
        </div>

        <div class="stat-value">
            {{ $completedOrder }}
        </div>

    </div>

    <div class="dashboard-stat-card">

        <div class="stat-card-top">

            <div class="stat-icon orders">
                📦
            </div>

        </div>

        <div class="stat-label">
            Pending Orders
        </div>

        <div class="stat-value">
            {{ $pendingOrder }}
        </div>

    </div>


    {{-- CUSTOMERS --}}

    <div class="dashboard-stat-card">

        <div class="stat-card-top">

            <div class="stat-icon customers">
                👥
            </div>

            <span class="stat-growth positive">
                +15.4%
            </span>

        </div>

        <div class="stat-label">
            Total Customers
        </div>

        <div class="stat-value">
            {{ $totalUser }}
        </div>

        <!-- <div class="stat-bottom">
            246 new customers
        </div> -->

    </div>


</div>



{{-- =====================================================
         MAIN DASHBOARD GRID
    ====================================================== --}}

<div class="dashboard-main-grid">


    {{-- =================================================
             SALES OVERVIEW
        ================================================== --}}

    <div class="dashboard-card sales-card">


        <div class="dashboard-card-header">

            <div>

                <h3>
                    Sales Overview
                </h3>

                <p>
                    Revenue performance
                </p>

            </div>


            <select class="dashboard-select">

                <option>
                    Last 7 Days
                </option>

                <option>
                    Last 30 Days
                </option>

                <option>
                    Last 12 Months
                </option>

            </select>

        </div>


        <div class="sales-summary">

            <div>

                <strong>
                    ₹{{ $totalRevenue }}
                </strong>

                <!-- <span class="summary-growth">
                    ↑ 18.4%
                </span> -->

            </div>

            <small>
                Revenue this week
            </small>

        </div>


        <div class="chart-wrapper">

            <canvas id="salesChart"></canvas>

        </div>


    </div>



    {{-- =================================================
             ORDER STATUS
        ================================================== --}}

    <div class="dashboard-card order-status-card">

        <div class="dashboard-card-header">

            <div>

                <h3>
                    Order Status
                </h3>

                <p>
                    Order breakdown for selected dates
                </p>

            </div>

        </div>


        <div class="order-status-list">


            {{-- =====================================================
             PENDING
        ====================================================== --}}

            @php
            $pendingCount = $orderStatusCounts['pending'];

            $pendingPercentage = $totalOrders > 0
            ? ($pendingCount / $totalOrders) * 100
            : 0;
            @endphp

            <div class="order-status-item">

                <div class="status-info">

                    <span class="status-dot pending"></span>

                    <span>
                        Pending
                    </span>

                </div>

                <strong>
                    {{ $pendingCount }}
                </strong>

            </div>


            <div class="status-progress">

                <span
                    style="width: {{ $pendingPercentage }}%;">
                </span>

            </div>



            {{-- =====================================================
             CONFIRMED
        ====================================================== --}}

            @php
            $confirmedCount = $orderStatusCounts['confirmed'];

            $confirmedPercentage = $totalOrders > 0
            ? ($confirmedCount / $totalOrders) * 100
            : 0;
            @endphp

            <div class="order-status-item">

                <div class="status-info">

                    <span class="status-dot confirmed"></span>

                    <span>
                        Confirmed
                    </span>

                </div>

                <strong>
                    {{ $confirmedCount }}
                </strong>

            </div>


            <div class="status-progress">

                <span
                    style="width: {{ $confirmedPercentage }}%;">
                </span>

            </div>



            {{-- =====================================================
             PREPARING
        ====================================================== --}}

            @php
            $preparingCount = $orderStatusCounts['preparing'];

            $preparingPercentage = $totalOrders > 0
            ? ($preparingCount / $totalOrders) * 100
            : 0;
            @endphp

            <div class="order-status-item">

                <div class="status-info">

                    <span class="status-dot preparing"></span>

                    <span>
                        Preparing
                    </span>

                </div>

                <strong>
                    {{ $preparingCount }}
                </strong>

            </div>


            <div class="status-progress">

                <span
                    style="width: {{ $preparingPercentage }}%;">
                </span>

            </div>



            {{-- =====================================================
             OUT FOR DELIVERY
        ====================================================== --}}

            @php
            $deliveryCount = $orderStatusCounts['out_for_delivery'];

            $deliveryPercentage = $totalOrders > 0
            ? ($deliveryCount / $totalOrders) * 100
            : 0;
            @endphp

            <div class="order-status-item">

                <div class="status-info">

                    <span class="status-dot delivery"></span>

                    <span>
                        Out for Delivery
                    </span>

                </div>

                <strong>
                    {{ $deliveryCount }}
                </strong>

            </div>


            <div class="status-progress">

                <span
                    style="width: {{ $deliveryPercentage }}%;">
                </span>

            </div>



            {{-- =====================================================
             DELIVERED
        ====================================================== --}}

            @php
            $deliveredCount = $orderStatusCounts['delivered'];

            $deliveredPercentage = $totalOrders > 0
            ? ($deliveredCount / $totalOrders) * 100
            : 0;
            @endphp

            <div class="order-status-item">

                <div class="status-info">

                    <span class="status-dot delivered"></span>

                    <span>
                        Delivered
                    </span>

                </div>

                <strong>
                    {{ $deliveredCount }}
                </strong>

            </div>


            <div class="status-progress">

                <span
                    style="width: {{ $deliveredPercentage }}%;">
                </span>

            </div>


        </div>

    </div>


</div>



{{-- =====================================================
         SECOND GRID
    ====================================================== --}}

<div class="dashboard-secondary-grid">


    {{-- =================================================
             RECENT ORDERS
        ================================================== --}}

    <div class="dashboard-card recent-orders-card">


        <div class="dashboard-card-header">

            <div>

                <h3>
                    Recent Orders
                </h3>

                <p>
                    Latest customer orders
                </p>

            </div>


            <a href="#" class="view-all-link">
                View All →
            </a>

        </div>


        <div class="orders-table-wrapper">

            <table class="orders-table">

                <thead>

                    <tr>

                        <th>
                            Order
                        </th>

                        <th>
                            Customer
                        </th>

                        <th>
                            Amount
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Time
                        </th>

                    </tr>

                </thead>


                <tbody>


                    <tr>

                        <td>

                            <div class="order-id">
                                #NB1028
                            </div>

                        </td>


                        <td>

                            <div class="customer-cell">

                                <div class="customer-avatar">
                                    RK
                                </div>

                                <div>

                                    <strong>
                                        Rahul Kumar
                                    </strong>

                                    <small>
                                        Chicken
                                    </small>

                                </div>

                            </div>

                        </td>


                        <td>
                            <strong>
                                ₹650
                            </strong>
                        </td>


                        <td>

                            <span class="order-badge preparing">
                                Preparing
                            </span>

                        </td>


                        <td>
                            5 min ago
                        </td>

                    </tr>



                    <tr>

                        <td>

                            <div class="order-id">
                                #NB1027
                            </div>

                        </td>


                        <td>

                            <div class="customer-cell">

                                <div class="customer-avatar">
                                    AS
                                </div>

                                <div>

                                    <strong>
                                        Ankit Sharma
                                    </strong>

                                    <small>
                                        Mutton
                                    </small>

                                </div>

                            </div>

                        </td>


                        <td>
                            <strong>
                                ₹1,280
                            </strong>
                        </td>


                        <td>

                            <span class="order-badge delivery">
                                Out for Delivery
                            </span>

                        </td>


                        <td>
                            18 min ago
                        </td>

                    </tr>



                    <tr>

                        <td>

                            <div class="order-id">
                                #NB1026
                            </div>

                        </td>


                        <td>

                            <div class="customer-cell">

                                <div class="customer-avatar">
                                    PS
                                </div>

                                <div>

                                    <strong>
                                        Priya Singh
                                    </strong>

                                    <small>
                                        Fish
                                    </small>

                                </div>

                            </div>

                        </td>


                        <td>
                            <strong>
                                ₹480
                            </strong>
                        </td>


                        <td>

                            <span class="order-badge delivered">
                                Delivered
                            </span>

                        </td>


                        <td>
                            32 min ago
                        </td>

                    </tr>



                    <tr>

                        <td>

                            <div class="order-id">
                                #NB1025
                            </div>

                        </td>


                        <td>

                            <div class="customer-cell">

                                <div class="customer-avatar">
                                    MK
                                </div>

                                <div>

                                    <strong>
                                        Mohit Kumar
                                    </strong>

                                    <small>
                                        Seafood
                                    </small>

                                </div>

                            </div>

                        </td>


                        <td>
                            <strong>
                                ₹920
                            </strong>
                        </td>


                        <td>

                            <span class="order-badge pending">
                                Pending
                            </span>

                        </td>


                        <td>
                            45 min ago
                        </td>

                    </tr>


                </tbody>

            </table>

        </div>


    </div>



    {{-- =================================================
             TOP PRODUCTS
        ================================================== --}}

    <div class="dashboard-card top-products-card">


        <div class="dashboard-card-header">

            <div>

                <h3>
                    Best Sellers
                </h3>

                <p>
                    Top selling products
                </p>

            </div>


            <a href="#" class="view-all-link">
                View All →
            </a>

        </div>


        <div class="product-list">


            <div class="dashboard-product">

                <div class="product-image">
                    🐔
                </div>

                <div class="product-info">

                    <strong>
                        Fresh Chicken
                    </strong>

                    <small>
                        1,284 sold
                    </small>

                </div>

                <strong class="product-price">
                    ₹320
                </strong>

            </div>



            <div class="dashboard-product">

                <div class="product-image">
                    🐐
                </div>

                <div class="product-info">

                    <strong>
                        Premium Mutton
                    </strong>

                    <small>
                        846 sold
                    </small>

                </div>

                <strong class="product-price">
                    ₹780
                </strong>

            </div>



            <div class="dashboard-product">

                <div class="product-image">
                    🐟
                </div>

                <div class="product-info">

                    <strong>
                        Fresh Rohu Fish
                    </strong>

                    <small>
                        724 sold
                    </small>

                </div>

                <strong class="product-price">
                    ₹280
                </strong>

            </div>



            <div class="dashboard-product">

                <div class="product-image">
                    🦐
                </div>

                <div class="product-info">

                    <strong>
                        Fresh Prawns
                    </strong>

                    <small>
                        512 sold
                    </small>

                </div>

                <strong class="product-price">
                    ₹560
                </strong>

            </div>



            <div class="dashboard-product">

                <div class="product-image">
                    🥚
                </div>

                <div class="product-info">

                    <strong>
                        Farm Eggs
                    </strong>

                    <small>
                        438 sold
                    </small>

                </div>

                <strong class="product-price">
                    ₹120
                </strong>

            </div>


        </div>


    </div>


</div>



{{-- =====================================================
         QUICK ACTIONS
    ====================================================== --}}

<div class="dashboard-card quick-actions-card">


    <div class="dashboard-card-header">

        <div>

            <h3>
                Quick Actions
            </h3>

            <p>
                Frequently used actions
            </p>

        </div>

    </div>


    <div class="quick-actions">


        <a href="#" class="quick-action">

            <span class="quick-action-icon">
                🥩
            </span>

            <span>

                <strong>
                    Add Product
                </strong>

                <small>
                    Create a new product
                </small>

            </span>

            <span class="quick-arrow">
                →
            </span>

        </a>


        <a href="#" class="quick-action">

            <span class="quick-action-icon">
                🗂
            </span>

            <span>

                <strong>
                    Add Category
                </strong>

                <small>
                    Create product category
                </small>

            </span>

            <span class="quick-arrow">
                →
            </span>

        </a>


        <a href="#" class="quick-action">

            <span class="quick-action-icon">
                🎁
            </span>

            <span>

                <strong>
                    Create Offer
                </strong>

                <small>
                    Add discount or coupon
                </small>

            </span>

            <span class="quick-arrow">
                →
            </span>

        </a>


        <a href="#" class="quick-action">

            <span class="quick-action-icon">
                🖼
            </span>

            <span>

                <strong>
                    Add Banner
                </strong>

                <small>
                    Update home promotion
                </small>

            </span>

            <span class="quick-arrow">
                →
            </span>

        </a>


    </div>


</div>


@endsection



@push('scripts')

{{-- Chart.js --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        /*
        |--------------------------------------------------------------------------
        | SALES CHART
        |--------------------------------------------------------------------------
        */

        const chartElement = document.getElementById('salesChart');

        if (chartElement) {

            const chartLabels = @json($chartLabels);
            const chartData = @json($chartData);

            new Chart(chartElement, {

                type: 'line',

                data: {

                    labels: chartLabels,

                    datasets: [

                        {
                            label: 'Revenue',

                            data: chartData,

                            tension: 0.4,

                            fill: true,

                            borderWidth: 2,

                            pointRadius: 3,

                            pointHoverRadius: 5
                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },

                    plugins: {

                        legend: {
                            display: false
                        },

                        tooltip: {

                            callbacks: {

                                label: function(context) {

                                    return ' Revenue: ₹' +
                                        Number(context.raw)
                                        .toLocaleString('en-IN');

                                }

                            }

                        }

                    },

                    scales: {

                        x: {

                            grid: {
                                display: false
                            },

                            border: {
                                display: false
                            }

                        },

                        y: {

                            beginAtZero: true,

                            grid: {
                                color: '#eef1ed'
                            },

                            border: {
                                display: false
                            },

                            ticks: {

                                callback: function(value) {

                                    if (value >= 1000) {

                                        return '₹' +
                                            (value / 1000) +
                                            'k';

                                    }

                                    return '₹' + value;

                                }

                            }

                        }

                    }

                }

            });

        }


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD DATE ELEMENTS
        |--------------------------------------------------------------------------
        */

        const dateBtn =
            document.getElementById('dashboardDateBtn');

        const popup =
            document.getElementById('dashboardDatePopup');

        const closeBtn =
            document.getElementById('closeDashboardDate');

        const applyBtn =
            document.getElementById('applyDashboardDate');

        const resetBtn =
            document.getElementById('resetDashboardDate');

        const popupFrom =
            document.getElementById('popupFromDate');

        const popupTo =
            document.getElementById('popupToDate');

        const fromDate =
            document.getElementById('fromDate');

        const toDate =
            document.getElementById('toDate');

        const form =
            document.getElementById('dashboardDateForm');


        /*
        |--------------------------------------------------------------------------
        | OPEN POPUP
        |--------------------------------------------------------------------------
        */

        if (dateBtn && popup) {

            dateBtn.addEventListener('click', function() {

                popup.classList.add('active');

            });

        }


        /*
        |--------------------------------------------------------------------------
        | CLOSE POPUP
        |--------------------------------------------------------------------------
        */

        if (closeBtn && popup) {

            closeBtn.addEventListener('click', function() {

                popup.classList.remove('active');

            });

        }


        /*
        |--------------------------------------------------------------------------
        | CLICK OUTSIDE
        |--------------------------------------------------------------------------
        */

        if (popup) {

            popup.addEventListener('click', function(event) {

                if (event.target === popup) {

                    popup.classList.remove('active');

                }

            });

        }


        /*
        |--------------------------------------------------------------------------
        | RESET
        |--------------------------------------------------------------------------
        */

        if (resetBtn) {

            resetBtn.addEventListener('click', function() {

                window.location.href =
                    "{{ route('admin.dashboard') }}";

            });

        }


        /*
        |--------------------------------------------------------------------------
        | APPLY DATE RANGE
        |--------------------------------------------------------------------------
        */

        if (
            applyBtn &&
            popupFrom &&
            popupTo &&
            fromDate &&
            toDate &&
            form
        ) {

            applyBtn.addEventListener('click', function() {

                if (
                    !popupFrom.value ||
                    !popupTo.value
                ) {

                    alert('Please select both dates.');

                    return;
                }


                if (
                    popupFrom.value >
                    popupTo.value
                ) {

                    alert(
                        'From date cannot be greater than To date.'
                    );

                    return;
                }


                fromDate.value =
                    popupFrom.value;

                toDate.value =
                    popupTo.value;

                form.submit();

            });

        }


        /*
        |--------------------------------------------------------------------------
        | ESC CLOSE
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'keydown',
            function(event) {

                if (
                    event.key === 'Escape' &&
                    popup
                ) {

                    popup.classList.remove('active');

                }

            }
        );

    });
</script>

@endpush