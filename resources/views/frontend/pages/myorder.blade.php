@extends('frontend.layouts.app')

@section('title', 'My Orders - Nonveg Bazar')

@section('content')

<style>

/* =========================================================
   MY ORDERS
========================================================= */

.orders-header {
    min-height: 72px;
    padding: 14px 16px;
    background: var(--primary);
    color: var(--white);
    display: flex;
    align-items: center;
}

.orders-header-top {
    width: 100%;
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.orders-header-top h1 {
    margin: 0;
    font-size: 16px;
    font-weight: 800;
}

.orders-back-btn {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    border-radius: 12px;
    background: rgba(255, 255, 255, .12);
    color: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
    text-decoration: none;
}

.orders-page {
    width: 100%;
    max-width: 430px;
    margin: 0 auto;
    padding: 16px 14px 2px;
    background: #f7f8f5;
    min-height: calc(100vh - 68px);
}

.orders-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}


/* =========================================================
   ORDER CARD
========================================================= */

.order-card {
    display: block;
    background: #ffffff;
    border: 1px solid #eceee9;
    border-radius: 18px;
    padding: 15px;
    text-decoration: none;
    color: inherit;
    box-shadow: 0 4px 18px rgba(23, 32, 24, .045);
    transition: transform .18s ease;
}

.order-card:active {
    transform: scale(.985);
}

.order-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    padding-bottom: 13px;
    border-bottom: 1px solid #f0f1ee;
}

.order-card-top > div {
    display: flex;
    flex-direction: column;
    gap: 5px;
    min-width: 0;
}

.order-card-top strong {
    color: #172018;
    font-size: 14px;
    font-weight: 700;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.order-card-top span:not(.order-status) {
    color: #858b85;
    font-size: 11px;
}

.order-status {
    flex-shrink: 0;
    padding: 6px 9px;
    border-radius: 20px;
    background: #edf8ef;
    color: #25833d;
    font-size: 10px;
    font-weight: 700;
    text-transform: capitalize;
}

.order-card-middle {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 0;
}

.order-icon {
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 13px;
    background: #fff4e8;
    font-size: 21px;
}

.order-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.order-info strong {
    color: #737a73;
    font-size: 11px;
    font-weight: 500;
}

.order-info span {
    color: #172018;
    font-size: 17px;
    font-weight: 800;
}

.order-card-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 12px;
    border-top: 1px solid #f0f1ee;
    color: #0b6b3a;
    font-size: 12px;
    font-weight: 700;
}

.order-card-bottom span:last-child {
    font-size: 18px;
}


/* =========================================================
   EMPTY ORDERS
========================================================= */

.empty-orders {
    min-height: 65vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 30px 20px;
}

.empty-orders-icon {
    width: 76px;
    height: 76px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 24px;
    background: #ffffff;
    font-size: 34px;
    box-shadow: 0 8px 25px rgba(23, 32, 24, .06);
    margin-bottom: 18px;
}

.empty-orders h2 {
    margin: 0 0 8px;
    color: #172018;
    font-size: 20px;
    font-weight: 800;
}

.empty-orders p {
    max-width: 280px;
    margin: 0;
    color: #858b85;
    font-size: 13px;
    line-height: 1.6;
}

.start-shopping-btn {
    margin-top: 22px;
    min-width: 170px;
    padding: 13px 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 13px;
    background: #0b6b3a;
    color: #ffffff;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
}


/* =========================================================
   ORDER SHEET OVERLAY
========================================================= */

.order-sheet-overlay {
    position: fixed;
    inset: 0;
    z-index: 99999;
    background: rgba(0, 0, 0, .48);
    opacity: 0;
    visibility: hidden;
    transition:
        opacity .28s ease,
        visibility .28s ease;
}

.order-sheet-overlay.active {
    opacity: 1;
    visibility: visible;
}


/* =========================================================
   BOTTOM SHEET
========================================================= */

.order-bottom-sheet {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    max-width: 430px;
    margin: 0 auto;

    max-height: 90vh;

    background: #ffffff;

    border-radius: 25px 25px 0 0;

    overflow: hidden;

    display: flex;
    flex-direction: column;

    transform: translateY(100%);

    transition:
        transform .42s cubic-bezier(.22, 1, .36, 1);
}

.order-sheet-overlay.active .order-bottom-sheet {
    transform: translateY(0);
}


/* =========================================================
   HANDLE
========================================================= */

.order-sheet-handle {
    width: 42px;
    height: 4px;
    margin: 9px auto 5px;
    border-radius: 20px;
    background: #d9ddd8;
}


/* =========================================================
   SHEET HEADER
========================================================= */

.order-sheet-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 13px 18px 15px;

    border-bottom: 1px solid #eeeeee;
}

.order-sheet-header-left {
    min-width: 0;
}

.order-sheet-header h3 {
    margin: 0;
    color: #172018;
    font-size: 18px;
    font-weight: 800;
}

.order-sheet-header p {
    margin: 4px 0 0;
    color: #858b85;
    font-size: 11px;
}

.order-sheet-close {
    width: 38px;
    height: 38px;

    flex-shrink: 0;

    border: 0;
    border-radius: 50%;

    background: #f3f5f1;

    color: #172018;

    font-size: 25px;

    display: flex;
    align-items: center;
    justify-content: center;

    cursor: pointer;
}


/* =========================================================
   SHEET CONTENT
========================================================= */

.order-sheet-content {
    overflow-y: auto;

    padding: 16px 15px 30px;

    -webkit-overflow-scrolling: touch;
}


/* =========================================================
   STATUS
========================================================= */

.sheet-status-box {
    display: flex;
    align-items: center;

    gap: 12px;

    padding: 14px;

    margin-bottom: 18px;

    background: #f5faf5;

    border: 1px solid #e2eee2;

    border-radius: 16px;
}

.sheet-status-icon {
    width: 42px;
    height: 42px;

    flex-shrink: 0;

    border-radius: 50%;

    background: var(--primary);

    color: #ffffff;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 18px;
    font-weight: 800;
}

.sheet-status-box strong {
    display: block;

    color: var(--primary);

    font-size: 14px;
}

.sheet-status-box span {
    display: block;

    margin-top: 2px;

    color: #7a827b;

    font-size: 12px;
}


/* =========================================================
   SECTION
========================================================= */

.sheet-section {
    margin-bottom: 20px;
}

.sheet-section-title {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-bottom: 10px;
}

.sheet-section-title h4 {
    margin: 0;

    color: #172018;

    font-size: 15px;
    font-weight: 800;
}

.sheet-section-title span {
    color: #7b847c;
    font-size: 12px;
}


/* =========================================================
   ORDER ITEM
========================================================= */

.order-items-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.order-item-card {
    padding: 13px;

    background: #fafbf9;

    border: 1px solid #e9ede8;

    border-radius: 16px;
}

.order-item-top {
    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 12px;
}

.order-item-name {
    color: #172018;

    font-size: 14px;

    font-weight: 800;

    line-height: 1.35;
}

.order-item-total {
    flex-shrink: 0;

    color: var(--primary);

    font-size: 14px;

    font-weight: 800;
}

.order-item-meta {
    margin-top: 7px;

    display: flex;

    flex-wrap: wrap;

    gap: 6px;
}

.order-item-meta span {
    padding: 4px 8px;

    border-radius: 7px;

    background: #eef2ed;

    color: #596259;

    font-size: 10px;
}

.order-item-price-row {
    margin-top: 10px;

    padding-top: 9px;

    border-top: 1px dashed #dfe4de;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 8px;
}

.order-item-price {
    color: #858c85;

    font-size: 11px;
}

.order-item-price strong {
    color: #252c25;

    font-size: 12px;
}

.order-item-discount {
    color: #198754;

    font-size: 11px;
}


/* =========================================================
   SUMMARY
========================================================= */

.order-summary-box {
    padding: 15px;

    background: #f7f8f5;

    border-radius: 16px;

    margin-bottom: 15px;
}

.order-summary-row {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    margin-bottom: 9px;
}

.order-summary-row:last-child {
    margin-bottom: 0;
}

.order-summary-label {
    color: #737a73;

    font-size: 11px;
}

.order-summary-value {
    color: #172018;

    font-size: 12px;

    font-weight: 700;

    text-align: right;
}

.order-summary-total {
    padding-top: 10px;

    margin-top: 10px;

    border-top: 1px solid #e3e6e1;
}

.order-summary-total .order-summary-label {
    color: #172018;

    font-size: 13px;

    font-weight: 700;
}

.order-summary-total .order-summary-value {
    color: #0b6b3a;

    font-size: 18px;

    font-weight: 800;
}


/* =========================================================
   TRACK
========================================================= */

.track-order-btn {
    width: 100%;

    min-height: 48px;

    margin-top: 4px;

    border: 0;

    border-radius: 14px;

    background: var(--primary);

    color: #ffffff;

    font-size: 13px;

    font-weight: 700;

    cursor: pointer;
}


/* =========================================================
   EMPTY ITEMS
========================================================= */

.empty-order-items {
    padding: 25px;

    background: #fafbf9;

    border: 1px solid #e9ede8;

    border-radius: 16px;

    text-align: center;

    color: #858b85;

    font-size: 12px;
}


/* =========================================================
   BODY LOCK
========================================================= */

body.order-sheet-open {
    overflow: hidden;
}


/* =========================================================
   DESKTOP
========================================================= */

@media (min-width: 600px) {

    .orders-page {
        padding-left: 18px;
        padding-right: 18px;
    }

    .order-card:hover {
        transform: translateY(-2px);

        box-shadow:
            0 8px 25px rgba(23, 32, 24, .08);
    }

}

</style>


{{-- =========================================================
     HEADER
========================================================= --}}

<header class="orders-header">

    <div class="orders-header-top">

        <a
            href="{{ route('profile') }}"
            class="orders-back-btn">

            ←

        </a>

        <h1>
            My Orders
        </h1>

        <div></div>

    </div>

</header>


{{-- =========================================================
     ORDERS
========================================================= --}}

<main class="orders-page">

    @if($orders->count())

        <div class="orders-list">

            @foreach($orders as $order)

                <a
                    href="javascript:void(0)"
                    class="order-card"
                    onclick='openOrderSheet(@json($order))'>

                    <div class="order-card-top">

                        <div>

                            <strong>

                                Order #{{ $order->order_number }}

                            </strong>

                            <span>

                                {{ $order->created_at->format('d M Y, h:i A') }}

                            </span>

                        </div>


                        <span class="order-status">

                            {{ ucfirst($order->order_status ?? 'Pending') }}

                        </span>

                    </div>


                    <div class="order-card-middle">

                        <div class="order-icon">

                            📦

                        </div>


                        <div class="order-info">

                            <strong>

                                {{ $order->orderItems->count() }}

                                {{ $order->orderItems->count() == 1 ? 'Item' : 'Items' }}

                            </strong>


                            <span>

                                ₹{{ number_format($order->total_amount, 2) }}

                            </span>

                        </div>

                    </div>


                    <div class="order-card-bottom">

                        <span>
                            View Order
                        </span>

                        <span>
                            →
                        </span>

                    </div>

                </a>

            @endforeach

        </div>

    @else

        <div class="empty-orders">

            <div class="empty-orders-icon">
                📦
            </div>

            <h2>
                No Orders Yet
            </h2>

            <p>
                Your orders will appear here after you place your first order.
            </p>

            <a
                href="{{ route('home') }}"
                class="start-shopping-btn">

                Start Shopping

            </a>

        </div>

    @endif

</main>


{{-- =========================================================
     ORDER DETAILS BOTTOM SHEET
========================================================= --}}

<div
    class="order-sheet-overlay"
    id="orderSheetOverlay"
    onclick="handleOrderSheetOverlay(event)">


    <div
        class="order-bottom-sheet"
        id="orderBottomSheet"
        onclick="event.stopPropagation()">


        {{-- HANDLE --}}

        <div class="order-sheet-handle"></div>


        {{-- HEADER --}}

        <div class="order-sheet-header">

            <div class="order-sheet-header-left">

                <h3>
                    Order Details
                </h3>

                <p id="sheetOrderNumber">
                    Order #--
                </p>

            </div>


            <button
                type="button"
                class="order-sheet-close"
                onclick="closeOrderSheet()">

                ×

            </button>

        </div>


        {{-- CONTENT --}}

        <div class="order-sheet-content">


            {{-- STATUS --}}

            <div class="sheet-status-box">

                <div class="sheet-status-icon">
                    ✓
                </div>

                <div>

                    <strong id="sheetOrderStatus">
                        Pending
                    </strong>

                    <span>
                        Your order details
                    </span>

                </div>

            </div>


            {{-- ORDER ITEMS --}}

            <div class="sheet-section">

                <div class="sheet-section-title">

                    <h4>
                        Order Items
                    </h4>

                    <span id="sheetItemCount">
                        0 Items
                    </span>

                </div>


                <div
                    class="order-items-list"
                    id="sheetOrderItems">

                </div>

            </div>


            {{-- ORDER INFORMATION --}}

            <div class="sheet-section">

                <div class="sheet-section-title">

                    <h4>
                        Order Information
                    </h4>

                </div>


                <div class="order-summary-box">


                    {{-- ORDER NUMBER --}}

                    <div class="order-summary-row">

                        <span class="order-summary-label">
                            Order Number
                        </span>

                        <span
                            class="order-summary-value"
                            id="sheetOrderNumberValue">

                            --

                        </span>

                    </div>


                    {{-- DATE --}}

                    <div class="order-summary-row">

                        <span class="order-summary-label">
                            Order Date
                        </span>

                        <span
                            class="order-summary-value"
                            id="sheetOrderDate">

                            --

                        </span>

                    </div>


                    {{-- PAYMENT METHOD --}}

                    <div class="order-summary-row">

                        <span class="order-summary-label">
                            Payment Method
                        </span>

                        <span
                            class="order-summary-value"
                            id="sheetPaymentMethod">

                            --

                        </span>

                    </div>


                    {{-- PAYMENT STATUS --}}

                    <div class="order-summary-row">

                        <span class="order-summary-label">
                            Payment Status
                        </span>

                        <span
                            class="order-summary-value"
                            id="sheetPaymentStatus">

                            --

                        </span>

                    </div>


                    {{-- ORDER STATUS --}}

                    <div class="order-summary-row">

                        <span class="order-summary-label">
                            Order Status
                        </span>

                        <span
                            class="order-summary-value"
                            id="sheetOrderStatusValue">

                            --

                        </span>

                    </div>


                    {{-- SUBTOTAL --}}

                    <div class="order-summary-row">

                        <span class="order-summary-label">
                            Subtotal
                        </span>

                        <span
                            class="order-summary-value"
                            id="sheetOrderSubtotal">

                            ₹0.00

                        </span>

                    </div>


                    {{-- DISCOUNT --}}

                    <div class="order-summary-row">

                        <span class="order-summary-label">
                            Discount
                        </span>

                        <span
                            class="order-summary-value"
                            id="sheetOrderDiscount">

                            ₹0.00

                        </span>

                    </div>


                    {{-- DELIVERY --}}

                    <div class="order-summary-row">

                        <span class="order-summary-label">
                            Delivery Charge
                        </span>

                        <span
                            class="order-summary-value"
                            id="sheetDeliveryCharge">

                            ₹0.00

                        </span>

                    </div>


                    {{-- TAX --}}

                    <div class="order-summary-row">

                        <span class="order-summary-label">
                            Tax
                        </span>

                        <span
                            class="order-summary-value"
                            id="sheetOrderTax">

                            ₹0.00

                        </span>

                    </div>


                    {{-- TOTAL --}}

                    <div class="order-summary-row order-summary-total">

                        <span class="order-summary-label">
                            Total Amount
                        </span>

                        <span
                            class="order-summary-value"
                            id="sheetOrderTotal">

                            ₹0.00

                        </span>

                    </div>


                </div>

            </div>


            {{-- TRACK ORDER --}}

            <button
                type="button"
                class="track-order-btn">

                Track Order

                <span>
                    →
                </span>

            </button>


        </div>

    </div>

</div>


@include('frontend.components.bottom-nav')


<script>

/* =========================================================
   SET VALUE SAFELY
========================================================= */

function setSheetValue(id, value) {

    const element = document.getElementById(id);

    if (element) {

        element.textContent =
            value ?? '--';

    }

}


/* =========================================================
   OPEN ORDER SHEET
========================================================= */

function openOrderSheet(order) {

    console.log('Opening order:', order);


    /*
    |--------------------------------------------------------------------------
    | CHECK ORDER OBJECT
    |--------------------------------------------------------------------------
    */

    if (!order || typeof order !== 'object') {

        console.error(
            'Invalid order data:',
            order
        );

        return;

    }


    /*
    |--------------------------------------------------------------------------
    | BASIC INFORMATION
    |--------------------------------------------------------------------------
    */

    setSheetValue(
        'sheetOrderNumber',
        'Order #' +
        (order.order_number ?? '--')
    );


    setSheetValue(
        'sheetOrderNumberValue',
        order.order_number ?? '--'
    );


    /*
    |--------------------------------------------------------------------------
    | ORDER STATUS
    |--------------------------------------------------------------------------
    */

    const orderStatus =
        order.order_status
            ? capitalizeStatus(order.order_status)
            : 'Pending';


    setSheetValue(
        'sheetOrderStatus',
        orderStatus
    );


    setSheetValue(
        'sheetOrderStatusValue',
        orderStatus
    );


    /*
    |--------------------------------------------------------------------------
    | PAYMENT
    |--------------------------------------------------------------------------
    */

    const paymentMethod =
        order.payment_method
            ? capitalizeStatus(order.payment_method)
            : 'Not selected';


    const paymentStatus =
        order.payment_status
            ? capitalizeStatus(order.payment_status)
            : 'Pending';


    setSheetValue(
        'sheetPaymentMethod',
        paymentMethod
    );


    setSheetValue(
        'sheetPaymentStatus',
        paymentStatus
    );


    /*
    |--------------------------------------------------------------------------
    | DATE
    |--------------------------------------------------------------------------
    */

    setSheetValue(
        'sheetOrderDate',
        formatOrderDate(
            order.placed_at ??
            order.created_at
        )
    );


    /*
    |--------------------------------------------------------------------------
    | AMOUNTS
    |--------------------------------------------------------------------------
    */

    setSheetValue(
        'sheetOrderSubtotal',
        formatMoney(order.subtotal)
    );


    setSheetValue(
        'sheetOrderDiscount',
        formatMoney(order.discount)
    );


    setSheetValue(
        'sheetDeliveryCharge',
        formatMoney(order.delivery_charge)
    );


    setSheetValue(
        'sheetOrderTax',
        formatMoney(order.tax)
    );


    setSheetValue(
        'sheetOrderTotal',
        formatMoney(order.total_amount)
    );


    /*
    |--------------------------------------------------------------------------
    | ORDER ITEMS
    |--------------------------------------------------------------------------
    */

    const items =
        Array.isArray(order.order_items)
            ? order.order_items
            : [];


    setSheetValue(
        'sheetItemCount',
        items.length +
        (
            items.length === 1
                ? ' Item'
                : ' Items'
        )
    );


    const itemsContainer =
        document.getElementById(
            'sheetOrderItems'
        );


    if (itemsContainer) {

        if (items.length === 0) {

            itemsContainer.innerHTML = `
                <div class="empty-order-items">
                    No items found in this order.
                </div>
            `;

        } else {

            itemsContainer.innerHTML =
                items.map(function(item) {

                    const quantity =
                        parseFloat(
                            item.quantity ?? 0
                        );


                    const originalPrice =
                        parseFloat(
                            item.price ?? 0
                        );


                    const sellingPrice =
                        parseFloat(
                            item.selling_price ??
                            item.discount_price ??
                            item.price ??
                            0
                        );


                    const totalPrice =
                        parseFloat(
                            item.total_price ?? 0
                        );


                    const discount =
                        originalPrice -
                        sellingPrice;


                    return `

                        <div class="order-item-card">

                            <div class="order-item-top">

                                <div class="order-item-name">

                                    ${escapeHtml(
                                        item.product_name ??
                                        'Product'
                                    )}

                                </div>


                                <div class="order-item-total">

                                    ₹${totalPrice.toFixed(2)}

                                </div>

                            </div>


                            <div class="order-item-meta">

                                <span>
                                    Qty:
                                    ${formatQuantity(quantity)}
                                </span>

                                <span>
                                    Unit:
                                    ${escapeHtml(
                                        item.unit ?? ''
                                    )}
                                </span>

                            </div>


                            <div class="order-item-price-row">

                                <div class="order-item-price">

                                    Price:
                                    <strong>
                                        ₹${originalPrice.toFixed(2)}
                                    </strong>

                                    <span>
                                        / ${escapeHtml(
                                            item.unit ?? ''
                                        )}
                                    </span>

                                </div>


                                ${
                                    discount > 0
                                    ? `
                                        <div class="order-item-discount">

                                            Saved
                                            ₹${discount.toFixed(2)}
                                            / unit

                                        </div>
                                    `
                                    : ''
                                }

                            </div>

                        </div>

                    `;

                }).join('');

        }

    }


    /*
    |--------------------------------------------------------------------------
    | GET SHEET ELEMENTS
    |--------------------------------------------------------------------------
    */

    const overlay =
        document.getElementById(
            'orderSheetOverlay'
        );


    const sheet =
        document.getElementById(
            'orderBottomSheet'
        );


    if (!overlay || !sheet) {

        console.error(
            'Order sheet HTML not found.',
            {
                overlay: overlay,
                sheet: sheet
            }
        );

        return;

    }


    /*
    |--------------------------------------------------------------------------
    | SHOW SHEET
    |--------------------------------------------------------------------------
    */

    overlay.classList.add('active');

    document.body.classList.add(
        'order-sheet-open'
    );


    /*
    |--------------------------------------------------------------------------
    | PREVENT BACKGROUND SCROLL
    |--------------------------------------------------------------------------
    */

    setTimeout(function() {

        sheet.scrollTop = 0;

    }, 50);

}


/* =========================================================
   CLOSE SHEET
========================================================= */

function closeOrderSheet() {

    const overlay =
        document.getElementById(
            'orderSheetOverlay'
        );


    if (!overlay) {
        return;
    }


    overlay.classList.remove('active');


    document.body.classList.remove(
        'order-sheet-open'
    );

}


/* =========================================================
   CLOSE WHEN CLICKING DARK BACKGROUND
========================================================= */

function handleOrderSheetOverlay(event) {

    if (
        event.target.id ===
        'orderSheetOverlay'
    ) {

        closeOrderSheet();

    }

}


/* =========================================================
   ESC KEY
========================================================= */

document.addEventListener(
    'keydown',
    function(event) {

        if (
            event.key === 'Escape'
        ) {

            closeOrderSheet();

        }

    }
);


/* =========================================================
   MONEY
========================================================= */

function formatMoney(value) {

    const amount =
        parseFloat(value ?? 0);


    return '₹' +
        amount.toFixed(2);

}


/* =========================================================
   QUANTITY
========================================================= */

function formatQuantity(value) {

    const number =
        parseFloat(value ?? 0);


    if (Number.isInteger(number)) {

        return number;

    }


    return number
        .toFixed(2)
        .replace(/\.?0+$/, '');

}


/* =========================================================
   DATE
========================================================= */

function formatOrderDate(dateString) {

    if (!dateString) {

        return '--';

    }


    const date =
        new Date(
            String(dateString)
                .replace(' ', 'T')
        );


    if (
        isNaN(
            date.getTime()
        )
    ) {

        return dateString;

    }


    return date.toLocaleDateString(
        'en-IN',
        {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        }
    )
    +
    ' • '
    +
    date.toLocaleTimeString(
        'en-IN',
        {
            hour: '2-digit',
            minute: '2-digit'
        }
    );

}


/* =========================================================
   STATUS
========================================================= */

function capitalizeStatus(value) {

    if (!value) {

        return '--';

    }


    return String(value)
        .replace(/_/g, ' ')
        .replace(
            /\b\w/g,
            function(char) {

                return char.toUpperCase();

            }
        );

}


/* =========================================================
   ESCAPE HTML
========================================================= */

function escapeHtml(value) {

    return String(value)
        .replace(
            /&/g,
            '&amp;'
        )
        .replace(
            /</g,
            '&lt;'
        )
        .replace(
            />/g,
            '&gt;'
        )
        .replace(
            /"/g,
            '&quot;'
        )
        .replace(
            /'/g,
            '&#039;'
        );

}

</script>

@endsection