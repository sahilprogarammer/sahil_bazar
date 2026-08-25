@extends('frontend.layouts.app')

@section('title', 'My Cart - Nonveg Bazar')

@section('content')

    {{-- =========================
         FIXED HEADER
    ========================== --}}
    <header class="page-header">

        <a href="{{ url()->previous() }}" class="back-btn">
            ←
        </a>

        <div class="page-header-title">

            <h1>My Cart</h1>

            <span>
                Freshness packed for you
            </span>

        </div>

        <div class="cart-header-icon">
            🛒
        </div>

    </header>


    {{-- =========================
         CART PAGE
    ========================== --}}
    <main class="cart-page">


        {{-- =========================
             DELIVERY INFO
        ========================== --}}
        <div class="delivery-card">

            <div class="delivery-icon">
                🚴
            </div>

            <div class="delivery-info">

                <strong>
                    Delivery in 30–45 mins
                </strong>

                <span>
                    Freshly packed & delivered to you
                </span>

            </div>

            <span class="delivery-arrow">
                →
            </span>

        </div>


        {{-- =========================
             CART TITLE
        ========================== --}}
        <div class="cart-section-heading">

            <div>

                <span>
                    YOUR ORDER
                </span>

                <h2>
                    3 Items
                </h2>

            </div>

            <button
                type="button"
                class="clear-cart-btn">

                Clear All

            </button>

        </div>


        {{-- =========================
             CART ITEMS
        ========================== --}}
        <section class="cart-items">


            {{-- ITEM 1 --}}
            <article
                class="cart-item"
                data-price="149">

                <div class="cart-product-image">

                    <img
                        src="https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&w=300&q=85"
                        alt="Chicken Curry Cut">

                </div>


                <div class="cart-product-details">

                    <div class="cart-product-top">

                        <div>

                            <h3>
                                Chicken Curry Cut
                            </h3>

                            <p>
                                500 g • Cleaned
                            </p>

                        </div>


                        <button
                            type="button"
                            class="remove-cart-item">

                            ×

                        </button>

                    </div>


                    <div class="cart-product-bottom">

                        <div class="cart-price">

                            ₹149

                        </div>


                        <div class="cart-quantity">

                            <button
                                type="button"
                                class="cart-minus">

                                −

                            </button>

                            <span class="cart-qty">
                                1
                            </span>

                            <button
                                type="button"
                                class="cart-plus">

                                +

                            </button>

                        </div>

                    </div>

                </div>

            </article>


            {{-- ITEM 2 --}}
            <article
                class="cart-item"
                data-price="229">

                <div class="cart-product-image">

                    <img
                        src="https://images.unsplash.com/photo-1603360946369-dc9bb6258143?auto=format&fit=crop&w=300&q=85"
                        alt="Chicken Breast">

                </div>


                <div class="cart-product-details">

                    <div class="cart-product-top">

                        <div>

                            <h3>
                                Chicken Breast Boneless
                            </h3>

                            <p>
                                500 g • Boneless
                            </p>

                        </div>


                        <button
                            type="button"
                            class="remove-cart-item">

                            ×

                        </button>

                    </div>


                    <div class="cart-product-bottom">

                        <div class="cart-price">

                            ₹229

                        </div>


                        <div class="cart-quantity">

                            <button
                                type="button"
                                class="cart-minus">

                                −

                            </button>

                            <span class="cart-qty">
                                1
                            </span>

                            <button
                                type="button"
                                class="cart-plus">

                                +

                            </button>

                        </div>

                    </div>

                </div>

            </article>


            {{-- ITEM 3 --}}
            <article
                class="cart-item"
                data-price="179">

                <div class="cart-product-image">

                    <img
                        src="https://images.unsplash.com/photo-1527477396000-e27163b481c2?auto=format&fit=crop&w=300&q=85"
                        alt="Chicken Leg">

                </div>


                <div class="cart-product-details">

                    <div class="cart-product-top">

                        <div>

                            <h3>
                                Chicken Leg Pieces
                            </h3>

                            <p>
                                500 g • Fresh Cut
                            </p>

                        </div>


                        <button
                            type="button"
                            class="remove-cart-item">

                            ×

                        </button>

                    </div>


                    <div class="cart-product-bottom">

                        <div class="cart-price">

                            ₹179

                        </div>


                        <div class="cart-quantity">

                            <button
                                type="button"
                                class="cart-minus">

                                −

                            </button>

                            <span class="cart-qty">
                                1
                            </span>

                            <button
                                type="button"
                                class="cart-plus">

                                +

                            </button>

                        </div>

                    </div>

                </div>

            </article>


        </section>


        {{-- =========================
             COUPON
        ========================== --}}
        <section class="coupon-card">

            <div class="coupon-icon">
                %
            </div>

            <div class="coupon-info">

                <strong>
                    Apply Coupon
                </strong>

                <span>
                    Save more on your order
                </span>

            </div>

            <button
                type="button"
                class="coupon-btn">

                Apply

            </button>

        </section>


        {{-- =========================
             BILL DETAILS
        ========================== --}}
        <section class="bill-card">

            <h3>
                Bill Details
            </h3>


            <div class="bill-row">

                <span>
                    Item Total
                </span>

                <strong id="itemTotal">
                    ₹557
                </strong>

            </div>


            <div class="bill-row">

                <span>
                    Delivery Fee
                </span>

                <strong>
                    ₹30
                </strong>

            </div>


            <div class="bill-row savings">

                <span>
                    Savings
                </span>

                <strong>
                    - ₹70
                </strong>

            </div>


            <div class="bill-divider"></div>


            <div class="bill-total">

                <span>
                    To Pay
                </span>

                <strong id="grandTotal">
                    ₹517
                </strong>

            </div>

        </section>


        {{-- =========================
             ADDRESS
        ========================== --}}
        <section class="address-card">

            <div class="address-icon">
                📍
            </div>

            <div class="address-info">

                <span>
                    DELIVERING TO
                </span>

                <strong>
                    Home
                </strong>

                <p>
                    Add your delivery address
                </p>

            </div>

            <button
                type="button"
                class="change-address">

                Change

            </button>

        </section>


    </main>


    {{-- =========================
         STICKY CHECKOUT
    ========================== --}}
    <div class="checkout-bar">

        <div class="checkout-total">

            <span>
                Total
            </span>

            <strong id="bottomTotal">
                ₹517
            </strong>

        </div>


        <a
            href="#"
            class="checkout-btn">

            Proceed to Checkout

            <span>
                →
            </span>

        </a>

    </div>


    {{-- Bottom Navigation --}}
    @include('frontend.components.bottom-nav')


@endsection


@push('scripts')

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* =====================================================
           UPDATE CART TOTAL
        ====================================================== */

        function updateCartTotal() {

            let itemTotal = 0;

            let itemCount = 0;


            document
                .querySelectorAll('.cart-item')
                .forEach(function (item) {

                    const price =
                        parseFloat(
                            item.dataset.price
                        );


                    const qty =
                        parseInt(
                            item.querySelector(
                                '.cart-qty'
                            ).textContent
                        );


                    itemTotal += price * qty;

                    itemCount += qty;

                });


            const deliveryFee =
                itemCount > 0 ? 30 : 0;


            const savings =
                itemCount > 0 ? 70 : 0;


            const grandTotal =
                itemTotal +
                deliveryFee -
                savings;


            document.getElementById(
                'itemTotal'
            ).textContent =
                '₹' + itemTotal;


            document.getElementById(
                'grandTotal'
            ).textContent =
                '₹' + grandTotal;


            document.getElementById(
                'bottomTotal'
            ).textContent =
                '₹' + grandTotal;


            updateItemCount(itemCount);

        }


        /* =====================================================
           ITEM COUNT
        ====================================================== */

        function updateItemCount(count) {

            const heading =
                document.querySelector(
                    '.cart-section-heading h2'
                );


            if (heading) {

                heading.textContent =
                    count +
                    (count === 1
                        ? ' Item'
                        : ' Items');

            }

        }


        /* =====================================================
           PLUS
        ====================================================== */

        document
            .querySelectorAll('.cart-plus')
            .forEach(function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        const item =
                            this.closest(
                                '.cart-item'
                            );


                        const qtyElement =
                            item.querySelector(
                                '.cart-qty'
                            );


                        let qty =
                            parseInt(
                                qtyElement.textContent
                            );


                        qty++;


                        qtyElement.textContent =
                            qty;


                        updateCartTotal();

                    }
                );

            });


        /* =====================================================
           MINUS
        ====================================================== */

        document
            .querySelectorAll('.cart-minus')
            .forEach(function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        const item =
                            this.closest(
                                '.cart-item'
                            );


                        const qtyElement =
                            item.querySelector(
                                '.cart-qty'
                            );


                        let qty =
                            parseInt(
                                qtyElement.textContent
                            );


                        if (qty > 1) {

                            qty--;

                            qtyElement.textContent =
                                qty;

                            updateCartTotal();

                        }

                    }
                );

            });


        /* =====================================================
           REMOVE ITEM
        ====================================================== */

        document
            .querySelectorAll('.remove-cart-item')
            .forEach(function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        const item =
                            this.closest(
                                '.cart-item'
                            );


                        item.remove();


                        updateCartTotal();

                    }
                );

            });


        /* =====================================================
           CLEAR CART
        ====================================================== */

        document
            .querySelector('.clear-cart-btn')
            .addEventListener(
                'click',
                function () {

                    document
                        .querySelectorAll(
                            '.cart-item'
                        )
                        .forEach(function (item) {

                            item.remove();

                        });


                    updateCartTotal();

                }
            );


        /* Initial */

        updateCartTotal();

    });

</script>

@endpush