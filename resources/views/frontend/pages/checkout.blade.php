@extends('frontend.layouts.app')

@section('title', 'Checkout - Nonveg Mart')

@section('content')

<style>
    /* =====================================================
   CHECKOUT BOTTOM BAR
===================================================== */
    .note {
        font-size: 12px;
        color: #0b632f;
    }

    .checkout-bottom-bar {

        position: fixed;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        width: 100%;
        max-width: var(--app-width);
        padding: 11px 16px;
        background: var(--white);
        border-top: 1px solid var(--border);
        box-shadow: 0 -5px 20px rgba(20, 40, 25, .06);
        z-index: 1100;
        display: flex;
        align-items: center;
        gap: 12px;

    }


    /* Total */

    .checkout-bottom-total {

        display: flex;

        flex-direction: column;

        gap: 3px;

        min-width: 80px;

    }


    .checkout-bottom-total span {

        display: block;
        color: var(--text-muted);
        font-size: 8px;

    }


    .checkout-bottom-total strong {

        display: block;
        margin-top: 2px;
        color: var(--text);
        font-size: 15px;
        font-weight: 800;

    }


    /* Button */

    .checkout-place-order {

        flex: 1;
        height: 44px;
        border-radius: 13px;
        background: var(--primary);
        color: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 10px;
        font-weight: 800;

    }

    .checkout-place-order span {
        background: #14532d;
        color: white;
        font-size: 14px;
    }


    .checkout-place-order:active {

        transform: scale(0.97);

    }


    .checkout-place-order:disabled {

        opacity: 0.6;

        cursor: not-allowed;

    }


    /* Prevent bottom bar covering content */

    /* .checkout-page {

        padding-bottom: 100px;

    } */
</style>


{{-- =========================================================
     CHECKOUT HEADER
========================================================= --}}

<header class="page-header">

    <a
        href="{{ route('cart') }}"
        class="back-btn">
        ←
    </a>

    <div class="page-header-title">

        <h1>
            Checkout
        </h1>

        <span>
            Complete your order
        </span>

    </div>

    <div class="cart-header-icon">
        🛒
    </div>

</header>


{{-- =========================================================
     CHECKOUT PAGE
========================================================= --}}

<main class="checkout-page">


    {{-- =====================================================
         DELIVERY INFO
    ====================================================== --}}

    <div class="checkout-delivery-card">

        <div class="checkout-delivery-icon">
            🚴
        </div>

        <div class="checkout-delivery-info">

            <strong>
                Delivery in 30–45 mins
            </strong>

            <span>
                Freshly packed & delivered to you
            </span>

        </div>

        <span class="checkout-delivery-arrow">
            →
        </span>

    </div>


    {{-- =====================================================
         DELIVERY ADDRESS
    ====================================================== --}}

    <!-- <section class="checkout-card">

        <div class="checkout-card-heading">

            <div>

                <span class="checkout-label">
                    DELIVERING TO
                </span>

                <h2>
                    Delivery Address
                </h2>

            </div>

            <button
                type="button"
                class="checkout-change-btn">

                Change

            </button>

        </div>


        <div class="checkout-address-box">

            <div class="checkout-address-icon">
                📍
            </div>

            <div class="checkout-address-content">

                <strong>
                    Home
                </strong>

                <p>
                    Add your delivery address
                </p>

            </div>

        </div>

    </section> -->


    {{-- =====================================================
         ORDER ITEMS
    ====================================================== --}}

    <section class="checkout-card">

        <div class="checkout-card-heading">

            <div>

                <span class="checkout-label">
                    YOUR ORDER
                </span>

                <h2 id="checkoutItemCount">
                    0 Items
                </h2>

            </div>

        </div>


        <div
            class="checkout-items"
            id="checkoutItems">

        </div>

    </section>


    {{-- =====================================================
         BILL DETAILS
    ====================================================== --}}

    <section class="checkout-card">

        <div class="checkout-card-heading">

            <h2>
                Bill Details
            </h2>

        </div>


        <div class="checkout-bill-row">

            <span>
                Item Total
            </span>

            <strong id="checkoutItemTotal">
                ₹0
            </strong>

        </div>


        <div class="checkout-bill-row">

            <span>
                Delivery Fee
            </span>

            <strong id="checkoutDeliveryFee">
                ₹0
            </strong>

        </div>


        <div class="checkout-bill-row checkout-savings">

            <span>
                Savings
            </span>

            <strong id="checkoutSavings">
                - ₹0
            </strong>

        </div>


        <div class="checkout-bill-divider"></div>


        <div class="checkout-grand-total">

            <span>
                To Pay
            </span>

            <strong id="checkoutGrandTotal">
                ₹0
            </strong>

        </div>

    </section>


    {{-- =====================================================
         PAYMENT METHOD
    ====================================================== --}}

    <section class="checkout-card">

        <div class="checkout-card-heading">

            <div>

                <span class="checkout-label">
                    PAYMENT
                </span>

                <h2>
                    Payment Method
                </h2>

            </div>

        </div>


        {{-- UPI --}}

        <label
            class="checkout-payment-option"
            id="upiPaymentOption">

            <div class="checkout-payment-icon">
                📱
            </div>

            <div class="checkout-payment-info">

                <strong>
                    UPI
                </strong>

                <span>
                    Pay securely using UPI
                </span>

            </div>

            <input
                type="radio"
                name="payment_method"
                value="upi"
                checked>

        </label>


        {{-- CASH ON DELIVERY --}}

        <label
            class="checkout-payment-option"
            id="codPaymentOption">

            <div class="checkout-payment-icon">
                💵
            </div>

            <div class="checkout-payment-info">

                <strong>
                    Cash on Delivery
                </strong>

                <span>
                    Pay when your order arrives
                </span>

            </div>

            <input
                type="radio"
                name="payment_method"
                value="cod">

        </label>


        {{-- PAYMENT INFO --}}

        <div
            class="checkout-payment-message"
            id="checkoutPaymentMessage">

        </div>

    </section>


    {{-- =====================================================
         EMPTY CHECKOUT
    ====================================================== --}}

    <div
        id="checkoutEmpty"
        class="checkout-empty"
        style="display: none;">

        <div class="checkout-empty-icon">
            🛒
        </div>

        <h3>
            Your cart is empty
        </h3>

        <p>
            Add some fresh products before checkout.
        </p>

        <a
            href="{{ route('home') }}"
            class="checkout-empty-btn">

            Start Shopping

        </a>

    </div>


</main>


{{-- =========================================================
     STICKY PLACE ORDER BAR
========================================================= --}}

<div
    class="checkout-bottom-bar"
    id="checkoutBottomBar"
    style="display: none;">

    <div class="checkout-bottom-total">

        <span>
            To Pay
        </span>

        <strong id="checkoutBottomTotal">
            ₹0.00
        </strong>

    </div>

    <button
        type="button"
        class="checkout-place-order"
        id="placeOrderBtn">

        <span id="placeOrderButtonText">
            Pay ₹0.00
        </span>

        <span>
            →
        </span>

    </button>

</div>


@endsection


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       ROUTES
    ===================================================== */

    const cashPaymentRoute =
        @json(route('payment.cash'));

    const upiPaymentRoute =
        @json(route('payment.create'));


    /* =====================================================
       IMPORTANT
       EXISTING ORDER ID FROM SESSION
    ===================================================== */

    const checkoutOrderId =
        @json(session('checkout_order_id'));


    console.log(
        'Checkout Order ID:',
        checkoutOrderId
    );


    /* =====================================================
       CART STORAGE
    ===================================================== */

    function getCart() {

        try {

            return JSON.parse(
                localStorage.getItem('cart')
            ) || [];

        } catch (error) {

            console.error(
                'Cart storage error:',
                error
            );

            return [];

        }

    }


    /* =====================================================
       FORMAT NUMBER
    ===================================================== */

    function formatNumber(number) {

        number = Number(number) || 0;

        return Number.isInteger(number)
            ? number
            : parseFloat(number.toFixed(2));

    }


    /* =====================================================
       FORMAT PRICE
    ===================================================== */

    function formatPrice(price) {

        price = Number(price) || 0;

        return '₹' + price.toFixed(2);

    }


    /* =====================================================
       ESCAPE HTML
    ===================================================== */

    function escapeHtml(value) {

        const div =
            document.createElement('div');

        div.textContent =
            value == null ? '' : value;

        return div.innerHTML;

    }


    /* =====================================================
       CALCULATE ITEM PRICE
    ===================================================== */

    function calculateItemPrice(item) {

        const quantity =
            parseFloat(item.quantity) || 0;


        const sellingPrice =
            parseFloat(item.selling_price) ||
            parseFloat(item.discount_price) ||
            parseFloat(item.price) ||
            0;


        /*
         * Gram products:
         *
         * 300g × ₹750/kg
         * = 300 / 1000 × 750
         * = ₹225
         */

        if (
            item.unit &&
            item.unit.toLowerCase() === 'gram'
        ) {

            return (
                quantity / 1000
            ) * sellingPrice;

        }


        return quantity * sellingPrice;

    }


    /* =====================================================
       CALCULATE ORIGINAL PRICE
    ===================================================== */

    function calculateOriginalPrice(item) {

        const quantity =
            parseFloat(item.quantity) || 0;


        const originalPrice =
            parseFloat(item.price) || 0;


        if (
            item.unit &&
            item.unit.toLowerCase() === 'gram'
        ) {

            return (
                quantity / 1000
            ) * originalPrice;

        }


        return quantity * originalPrice;

    }


    /* =====================================================
       GET CHECKOUT TOTALS
    ===================================================== */

    function getCheckoutTotals() {

        const cart =
            getCart();


        let itemTotal = 0;

        let originalTotal = 0;

        let itemCount = 0;


        cart.forEach(function (item) {

            itemTotal +=
                calculateItemPrice(item);


            originalTotal +=
                calculateOriginalPrice(item);


            itemCount++;

        });


        /* ================================================
           DELIVERY FEE
        ================================================= */

        const deliveryFee =
            itemCount > 0
                ? 30
                : 0;


        /* ================================================
           SAVINGS
        ================================================= */

        const savings =
            Math.max(
                originalTotal - itemTotal,
                0
            );


        /* ================================================
           GRAND TOTAL
        ================================================= */

        const grandTotal =
            itemTotal +
            deliveryFee;


        return {

            itemTotal: itemTotal,

            originalTotal: originalTotal,

            deliveryFee: deliveryFee,

            savings: savings,

            grandTotal: grandTotal,

            itemCount: itemCount

        };

    }


    /* =====================================================
       UPDATE PAYMENT UI
    ===================================================== */

    function updatePaymentMethodUI() {

        const selectedPayment =
            document.querySelector(
                'input[name="payment_method"]:checked'
            );


        const buttonText =
            document.getElementById(
                'placeOrderButtonText'
            );


        const paymentMessage =
            document.getElementById(
                'checkoutPaymentMessage'
            );


        const bottomTotal =
            document.getElementById(
                'checkoutBottomTotal'
            );


        if (!selectedPayment) {

            return;

        }


        const totals =
            getCheckoutTotals();


        const grandTotal =
            formatPrice(
                totals.grandTotal
            );


        /* ================================================
           BOTTOM TOTAL
        ================================================= */

        if (bottomTotal) {

            bottomTotal.textContent =
                grandTotal;

        }


        /* ================================================
           UPI
        ================================================= */

        if (
            selectedPayment.value === 'upi'
        ) {

            if (buttonText) {

                buttonText.textContent =
                    'Pay ' + grandTotal;

            }


            if (paymentMessage) {

                paymentMessage.innerHTML = '';

            }

        }


        /* ================================================
           CASH ON DELIVERY
        ================================================= */

        if (
            selectedPayment.value === 'cod'
        ) {

            if (buttonText) {

                buttonText.textContent =
                    'Place Order';

            }


            if (paymentMessage) {

                paymentMessage.innerHTML = `

                    <p class="note">
                        Please note: COD orders cannot be cancelled after the order is placed.
                    </p>

                `;

            }

        }

    }


    /* =====================================================
       UPDATE TOTALS
    ===================================================== */

    function updateCheckoutTotals() {

        const totals =
            getCheckoutTotals();


        /* ================================================
           ITEM COUNT
        ================================================= */

        const itemCountElement =
            document.getElementById(
                'checkoutItemCount'
            );


        if (itemCountElement) {

            itemCountElement.textContent =
                totals.itemCount +
                (
                    totals.itemCount === 1
                        ? ' Item'
                        : ' Items'
                );

        }


        /* ================================================
           ITEM TOTAL
        ================================================= */

        const itemTotalElement =
            document.getElementById(
                'checkoutItemTotal'
            );


        if (itemTotalElement) {

            itemTotalElement.textContent =
                formatPrice(
                    totals.itemTotal
                );

        }


        /* ================================================
           DELIVERY FEE
        ================================================= */

        const deliveryElement =
            document.getElementById(
                'checkoutDeliveryFee'
            );


        if (deliveryElement) {

            deliveryElement.textContent =
                formatPrice(
                    totals.deliveryFee
                );

        }


        /* ================================================
           SAVINGS
        ================================================= */

        const savingsElement =
            document.getElementById(
                'checkoutSavings'
            );


        if (savingsElement) {

            savingsElement.textContent =
                '- ' +
                formatPrice(
                    totals.savings
                );

        }


        /* ================================================
           GRAND TOTAL
        ================================================= */

        const grandTotalElement =
            document.getElementById(
                'checkoutGrandTotal'
            );


        if (grandTotalElement) {

            grandTotalElement.textContent =
                formatPrice(
                    totals.grandTotal
                );

        }


        /* ================================================
           BOTTOM TOTAL
        ================================================= */

        const bottomTotalElement =
            document.getElementById(
                'checkoutBottomTotal'
            );


        if (bottomTotalElement) {

            bottomTotalElement.textContent =
                formatPrice(
                    totals.grandTotal
                );

        }


        /* ================================================
           PAYMENT BUTTON
        ================================================= */

        updatePaymentMethodUI();

    }


    /* =====================================================
       RENDER CHECKOUT ITEMS
    ===================================================== */

    function renderCheckout() {

        const cart =
            getCart();


        const checkoutItems =
            document.getElementById(
                'checkoutItems'
            );


        const checkoutEmpty =
            document.getElementById(
                'checkoutEmpty'
            );


        const checkoutBottomBar =
            document.getElementById(
                'checkoutBottomBar'
            );


        if (!checkoutItems) {

            return;

        }


        /* ================================================
           EMPTY CART
        ================================================= */

        if (cart.length === 0) {

            checkoutItems.innerHTML = '';

            checkoutItems.style.display =
                'none';


            if (checkoutEmpty) {

                checkoutEmpty.style.display =
                    'block';

            }


            if (checkoutBottomBar) {

                checkoutBottomBar.style.display =
                    'none';

            }


            updateCheckoutTotals();

            return;

        }


        /* ================================================
           SHOW CHECKOUT
        ================================================= */

        checkoutItems.style.display =
            'block';


        if (checkoutEmpty) {

            checkoutEmpty.style.display =
                'none';

        }


        if (checkoutBottomBar) {

            checkoutBottomBar.style.display =
                'flex';

        }


        /* ================================================
           BUILD ITEMS
        ================================================= */

        let html = '';


        cart.forEach(function (item) {

            const quantity =
                parseFloat(item.quantity) || 0;


            const unit =
                item.unit || 'gram';


            const itemTotal =
                calculateItemPrice(item);


            const originalTotal =
                calculateOriginalPrice(item);


            const image =
                item.image || '';


            const saving =
                Math.max(
                    originalTotal - itemTotal,
                    0
                );


            html += `

                <article class="checkout-item">

                    <div class="checkout-item-image">

                        ${
                            image
                            ?
                            `

                            <img
                                src="${escapeHtml(image)}"
                                alt="${escapeHtml(
                                    item.name || 'Product'
                                )}"
                            >

                            `
                            :
                            `

                            <div class="checkout-no-image">
                                🥩
                            </div>

                            `
                        }

                    </div>


                    <div class="checkout-item-details">

                        <div class="checkout-item-top">

                            <div>

                                <h3>
                                    ${escapeHtml(
                                        item.name || 'Product'
                                    )}
                                </h3>

                                <p>
                                    ${formatNumber(quantity)}
                                    ${escapeHtml(unit)}
                                </p>

                            </div>

                        </div>


                        <div class="checkout-item-bottom">

                            <div>

                                <strong class="checkout-item-price">
                                    ${formatPrice(itemTotal)}
                                </strong>


                                ${
                                    saving > 0
                                    ?
                                    `

                                    <span class="checkout-item-old-price">
                                        ${formatPrice(originalTotal)}
                                    </span>

                                    `
                                    :
                                    ''
                                }

                            </div>


                            <span class="checkout-item-quantity">

                                Qty:
                                ${formatNumber(quantity)}
                                ${escapeHtml(unit)}

                            </span>

                        </div>

                    </div>

                </article>

            `;

        });


        checkoutItems.innerHTML =
            html;


        /* ================================================
           UPDATE TOTALS
        ================================================= */

        updateCheckoutTotals();

    }


    /* =====================================================
       PAYMENT METHOD CHANGE
    ===================================================== */

    const paymentMethods =
        document.querySelectorAll(
            'input[name="payment_method"]'
        );


    paymentMethods.forEach(
        function (paymentInput) {

            paymentInput.addEventListener(
                'change',
                function () {

                    updatePaymentMethodUI();

                }
            );

        }
    );


    /* =====================================================
       PLACE ORDER BUTTON
    ===================================================== */

    const placeOrderButton =
        document.getElementById(
            'placeOrderBtn'
        );


    if (placeOrderButton) {

        placeOrderButton.addEventListener(
            'click',
            async function () {

                /* ==========================================
                   CHECK EXISTING ORDER ID
                ========================================== */

                if (!checkoutOrderId) {

                    alert(
                        'Order session expired. Please start checkout again.'
                    );

                    window.location.href =
                        '{{ route('cart') }}';

                    return;

                }


                /* ==========================================
                   GET CART
                ========================================== */

                const cart =
                    getCart();


                if (cart.length === 0) {

                    alert(
                        'Your cart is empty.'
                    );

                    return;

                }


                /* ==========================================
                   PAYMENT METHOD
                ========================================== */

                const paymentMethod =
                    document.querySelector(
                        'input[name="payment_method"]:checked'
                    );


                if (!paymentMethod) {

                    alert(
                        'Please select a payment method.'
                    );

                    return;

                }


                const method =
                    paymentMethod.value;


                /* ==========================================
                   TOTALS
                ========================================== */

                const totals =
                    getCheckoutTotals();


                /* ==========================================
                   ADDRESS
                ========================================== */

                // const selectedAddressId =
                //     localStorage.getItem(
                //         'selectedAddressId'
                //     );


                // if (!selectedAddressId) {

                //     alert(
                //         'Please select a delivery address.'
                //     );

                //     return;

                // }


                /* ==========================================
                   ORDER DATA
                ========================================== */

                const orderData = {

                    /*
                     * Existing order created earlier.
                     */

                    order_id:
                        checkoutOrderId,

                    items:
                        cart,

                    payment_method:
                        method,

                    address_id:
                        selectedAddressId,

                    item_total:
                        totals.itemTotal,

                    delivery_fee:
                        totals.deliveryFee,

                    savings:
                        totals.savings,

                    total_amount:
                        totals.grandTotal

                };


                console.log(
                    'ORDER DATA:',
                    orderData
                );


                /* ==========================================
                   DISABLE BUTTON
                ========================================== */

                placeOrderButton.disabled =
                    true;


                /* =================================================
                   CASH ON DELIVERY
                ================================================= */

                if (method === 'cod') {

                    placeOrderButton.innerHTML = `

                        <span>
                            Placing Order...
                        </span>

                    `;


                    try {

                        const response =
                            await fetch(
                                cashPaymentRoute,
                                {

                                    method: 'POST',

                                    headers: {

                                        'Content-Type':
                                            'application/json',

                                        'X-CSRF-TOKEN':
                                            '{{ csrf_token() }}',

                                        'Accept':
                                            'application/json'

                                    },

                                    body:
                                        JSON.stringify(
                                            orderData
                                        )

                                }
                            );


                        const data =
                            await response.json();


                        console.log(
                            'COD RESPONSE:',
                            data
                        );


                        if (!response.ok) {

                            throw new Error(
                                data.message ||
                                'Unable to place order.'
                            );

                        }


                        /* =====================================
                           SUCCESS
                        ===================================== */

                        if (data.success) {

                            /*
                             * Clear cart
                             */

                            localStorage.removeItem(
                                'cart'
                            );


                            /*
                             * Clear selected address
                             * if you want it cleared.
                             *
                             * Keep this commented if
                             * you want address remembered.
                             */

                            // localStorage.removeItem(
                            //     'selectedAddressId'
                            // );


                            /*
                             * Redirect
                             */

                            if (data.redirect) {

                                window.location.href =
                                    data.redirect;

                                return;

                            }


                            /*
                             * Fallback
                             */

                            window.location.href =
                                '{{ route('home') }}';

                            return;

                        }


                        throw new Error(
                            data.message ||
                            'Unable to place order.'
                        );


                    } catch (error) {

                        console.error(
                            'COD ERROR:',
                            error
                        );


                        alert(
                            error.message ||
                            'Something went wrong while placing your order.'
                        );


                        placeOrderButton.disabled =
                            false;


                        updatePaymentMethodUI();

                    }


                    return;

                }


                /* =================================================
                   UPI
                ================================================= */

                if (method === 'upi') {

                    placeOrderButton.innerHTML = `

                        <span>
                            Processing Payment...
                        </span>

                    `;


                    try {

                        const response =
                            await fetch(
                                upiPaymentRoute,
                                {

                                    method: 'POST',

                                    headers: {

                                        'Content-Type':
                                            'application/json',

                                        'X-CSRF-TOKEN':
                                            '{{ csrf_token() }}',

                                        'Accept':
                                            'application/json'

                                    },

                                    body:
                                        JSON.stringify(
                                            orderData
                                        )

                                }
                            );


                        const data =
                            await response.json();


                        console.log(
                            'UPI RESPONSE:',
                            data
                        );


                        if (!response.ok) {

                            throw new Error(
                                data.message ||
                                'Unable to start payment.'
                            );

                        }


                        /* =====================================
                           PAYMENT REDIRECT
                        ===================================== */

                        if (data.redirect) {

                            window.location.href =
                                data.redirect;

                            return;

                        }


                        if (data.payment_url) {

                            window.location.href =
                                data.payment_url;

                            return;

                        }


                        console.log(
                            'Payment response:',
                            data
                        );


                        alert(
                            data.message ||
                            'Payment could not be started.'
                        );


                        placeOrderButton.disabled =
                            false;


                        updatePaymentMethodUI();


                    } catch (error) {

                        console.error(
                            'UPI ERROR:',
                            error
                        );


                        alert(
                            error.message ||
                            'Something went wrong while starting payment.'
                        );


                        placeOrderButton.disabled =
                            false;


                        updatePaymentMethodUI();

                    }


                    return;

                }

            }
        );

    }


    /* =====================================================
       INITIAL LOAD
    ===================================================== */

    updatePaymentMethodUI();

    renderCheckout();

});
</script>

@endpush