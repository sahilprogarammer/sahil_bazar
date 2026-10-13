@extends('frontend.layouts.app')

@section('title', 'My Cart - Nonveg Mart')

@section('content')

{{-- =========================
         FIXED HEADER
    ========================== --}}
<header class="page-header">

    <a href="{{ route('home') }}" class="back-btn">
        ←
    </a>

    <div class="page-header-title">

        <h1>My Cart</h1>

        <span>
            Freshness packed for you
        </span>

    </div>

    <div class="cart-header-icon">
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

            <h2 id="cartItemCount">
                0 Items
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
    <section
        class="cart-items"
        id="cartItems">

    </section>


    {{-- =========================
             EMPTY CART
        ========================== --}}
    <div
        id="emptyCart"
        class="empty-cart"
        style="display: none;">

        <div class="empty-cart-icon">
            🛒
        </div>

        <h3>
            Your cart is empty
        </h3>

        <p>
            Add some fresh products to your cart.
        </p>

        <a
            href="{{ route('home') }}"
            class="empty-cart-btn">

            Start Shopping

        </a>

    </div>


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
                ₹0
            </strong>

        </div>


        <div class="bill-row">

            <span>
                Delivery Fee
            </span>

            <strong id="deliveryFee">
                ₹0
            </strong>

        </div>


        <div class="bill-row savings">

            <span>
                Savings
            </span>

            <strong id="savingsAmount">
                - ₹0
            </strong>

        </div>


        <div class="bill-divider"></div>


        <div class="bill-total">

            <span>
                To Pay
            </span>

            <strong id="grandTotal">
                ₹0
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

            @if(isset($defaultAddress) && $defaultAddress)

            <span>
                DELIVERING TO
            </span>

            <strong>
                {{ ucfirst($defaultAddress->address_type) }}
            </strong>

            <p>
                {{ $defaultAddress->full_address }}
            </p>

            @else

            <span>
                DELIVERY ADDRESS
            </span>

            <strong>
                No Address Selected
            </strong>

            <p>
                Add your delivery address
            </p>

            @endif

        </div>

        <button
            type="button"
            onclick="openAddressSelector()"
            class="change-address">

            {{ isset($defaultAddress) && $defaultAddress ? 'Change' : 'Add' }}

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
            ₹0
        </strong>

    </div>

    <div class="checkout-btn" id="checkoutBtn">

        <form
            method="POST"
            action="{{ route('checkout') }}"
            id="checkoutForm">

            @csrf

            <input
                type="hidden"
                name="address_id"
                id="selectedAddressId"
                value="{{ $defaultAddress->id ?? '' }}">

            <input
                type="hidden"
                name="cart"
                id="checkoutCart">

            <button
                type="submit"
                class="checkout-button">

                Proceed to Checkout

            </button>

        </form>

    </div>

</div>


@endsection


@push('scripts')
<script>
    const deliveryChargeRules = @json($deliveryCharges);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        'use strict';

        /* =====================================================
           CONFIGURATION
        ===================================================== */

        const cartRefreshUrl = @json(route('cart.refresh'));

        const checkoutUrl = @json(route('checkout'));

        const csrfToken = document.querySelector(
            'meta[name="csrf-token"]'
        )?.content || '';

        const deliveryRules = Array.isArray(deliveryChargeRules) ?
            deliveryChargeRules :
            [];

        let cartLoading = false;


        /* =====================================================
           CART STORAGE
        ===================================================== */

        function getCart() {
            try {
                const cart = JSON.parse(
                    localStorage.getItem('cart') || '[]'
                );

                return Array.isArray(cart) ? cart : [];

            } catch (error) {
                console.error('Cart storage error:', error);
                return [];
            }
        }

        function saveCart(cart) {
            localStorage.setItem('cart', JSON.stringify(cart));

            if (typeof updateCartCount === 'function') {
                updateCartCount();
            }
        }


        /* =====================================================
           FORMAT HELPERS
        ===================================================== */

        function formatNumber(value) {
            const number = Number(value) || 0;

            return Number.isInteger(number) ?
                number :
                parseFloat(number.toFixed(2));
        }

        function formatPrice(value) {
            const number = Number(value) || 0;

            return '₹' + number.toFixed(2);
        }

        function escapeHtml(value) {
            const element = document.createElement('div');

            element.textContent = value == null ? '' : String(value);

            return element.innerHTML;
        }

        function getUnit(item) {
            return String(item.unit || 'gram').toLowerCase();
        }

        function getMinimumQuantity(item) {
            return Math.max(
                0,
                Number(
                    item.minimum_order_qty ?? item.minQty ?? 0
                ) || 0
            );
        }

        function getSellingPrice(item) {
            if (item.selling_price !== undefined &&
                item.selling_price !== null &&
                item.selling_price !== '') {
                return Number(item.selling_price) || 0;
            }

            if (Number(item.discount_price) > 0) {
                return Number(item.discount_price);
            }

            return Number(item.price) || 0;
        }


        /* =====================================================
           CALCULATE PRODUCT PRICE

           gram:   quantity / 1000 * price per kg
           kg:     quantity * price per kg
           piece:  quantity * (selling price / minimum quantity)
           packet: quantity * price per packet
           liter:  quantity * price per liter
        ===================================================== */

        function calculateItemPrice(item) {
            const quantity = Number(item.quantity) || 0;
            const price = getSellingPrice(item);
            const unit = getUnit(item);

            if (unit === 'gram') {
                return (quantity / 1000) * price;
            }

            if (unit === 'piece') {
                const minimumQty = getMinimumQuantity(item);

                if (minimumQty <= 0) {
                    return 0;
                }

                return quantity * (price / minimumQty);
            }

            return quantity * price;
        }


        /* =====================================================
           REFRESH PRICES FROM LARAVEL DATABASE

           The browser sends only product IDs and quantities.
           Laravel must return current product data and prices.
        ===================================================== */

        async function refreshCartFromDatabase() {
            const cart = getCart();

            if (cart.length === 0) {
                saveCart([]);
                return [];
            }

            if (!csrfToken) {
                throw new Error('CSRF token is missing.');
            }

            const response = await fetch(cartRefreshUrl, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    cart: cart.map(function(item) {
                        return {
                            product_id: item.product_id,
                            quantity: item.quantity
                        };
                    })
                })
            });

            if (!response.ok) {
                throw new Error(
                    'Cart refresh failed. HTTP ' + response.status
                );
            }

            const data = await response.json();

            if (!data.success || !Array.isArray(data.items)) {
                throw new Error(
                    data.message || 'Invalid cart refresh response.'
                );
            }

            // Save the latest prices and product information.
            saveCart(data.items);

            return data.items;
        }


        /* =====================================================
           QUANTITY STEPS
        ===================================================== */

        function getQuantityStep(item) {
            const unit = getUnit(item);

            if (unit === 'gram') {
                return 50;
            }

            if (unit === 'liter') {
                return 0.1;
            }

            return 1;
        }


        /* =====================================================
           CART TOTAL
        ===================================================== */

        function updateCartTotal() {
            const cart = getCart();

            let itemTotal = 0;
            const itemCount = cart.length;

            cart.forEach(function(item) {
                itemTotal += calculateItemPrice(item);
            });

            itemTotal = Math.round((itemTotal + Number.EPSILON) * 100) / 100;

            let deliveryFee = 0;

            if (itemCount > 0) {
                const distance = getDeliveryDistance();

                const matchingRule = deliveryRules.find(function(rule) {
                    const minDistance = Number(rule.min_distance) || 0;
                    const maxDistance = Number(rule.max_distance) || 0;
                    const minAmount = Number(rule.min_order_amount) || 0;

                    // Zero may mean no upper order limit in your database.
                    const maxAmount = Number(rule.max_order_amount) || 0;

                    const distanceMatches =
                        distance >= minDistance &&
                        distance <= maxDistance;

                    const amountMatches =
                        itemTotal >= minAmount &&
                        (maxAmount <= 0 || itemTotal <= maxAmount);

                    return distanceMatches && amountMatches;
                });

                if (matchingRule) {
                    deliveryFee = Number(matchingRule.charge) || 0;
                }
            }

            const savings = 0;

            const grandTotal = Math.max(
                0,
                itemTotal + deliveryFee - savings
            );

            const values = {
                itemTotal: itemTotal,
                deliveryFee: deliveryFee,
                savingsAmount: savings,
                grandTotal: grandTotal,
                bottomTotal: grandTotal
            };

            Object.keys(values).forEach(function(id) {
                const element = document.getElementById(id);

                if (!element) {
                    return;
                }

                if (id === 'savingsAmount') {
                    element.textContent = '- ' + formatPrice(values[id]);
                } else {
                    element.textContent = formatPrice(values[id]);
                }
            });

            const heading = document.getElementById('cartItemCount');

            if (heading) {
                heading.textContent =
                    itemCount + (itemCount === 1 ? ' Item' : ' Items');
            }

            if (typeof updateCartCount === 'function') {
                updateCartCount();
            }

            return {
                itemTotal: itemTotal,
                deliveryFee: deliveryFee,
                savings: savings,
                grandTotal: grandTotal
            };
        }


        /* =====================================================
           RENDER CART
        ===================================================== */

        function renderCart() {
            const cart = getCart();

            const cartItems = document.getElementById('cartItems');
            const emptyCart = document.getElementById('emptyCart');

            if (!cartItems) {
                return;
            }

            cartItems.innerHTML = '';

            if (cart.length === 0) {
                cartItems.style.display = 'none';

                if (emptyCart) {
                    emptyCart.style.display = 'block';
                }

                updateCartTotal();
                return;
            }

            cartItems.style.display = 'block';

            if (emptyCart) {
                emptyCart.style.display = 'none';
            }

            cart.forEach(function(item, index) {
                const quantity = Number(item.quantity) || 0;
                const unit = getUnit(item);
                const itemTotal = calculateItemPrice(item);

                const image = item.image ||
                    'https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&w=300&q=85';

                const article = document.createElement('article');

                article.className = 'cart-item';
                article.dataset.index = index;

                article.innerHTML = `
                <div class="cart-product-image">
                    <img
                        src="${escapeHtml(image)}"
                        alt="${escapeHtml(item.name || 'Product')}"
                        loading="lazy">
                </div>

                <div class="cart-product-details">
                    <div class="cart-product-top">
                        <div>
                            <h3>${escapeHtml(item.name || 'Product')}</h3>
                            <p>${formatNumber(quantity)} ${escapeHtml(unit)}</p>
                        </div>

                        <button
                            type="button"
                            class="remove-cart-item"
                            aria-label="Remove ${escapeHtml(item.name || 'product')}">
                            ×
                        </button>
                    </div>

                    <div class="cart-product-bottom">
                        <div class="cart-price">
                            ${formatPrice(itemTotal)}
                        </div>

                        <div class="cart-quantity">
                            <button
                                type="button"
                                class="cart-minus"
                                aria-label="Decrease quantity">
                                −
                            </button>

                            <span class="cart-qty">
                                ${formatNumber(quantity)}
                            </span>

                            <button
                                type="button"
                                class="cart-plus"
                                aria-label="Increase quantity">
                                +
                            </button>
                        </div>
                    </div>
                </div>
            `;

                const imageElement = article.querySelector('img');

                imageElement.addEventListener('error', function() {
                    this.style.visibility = 'hidden';
                }, {
                    once: true
                });

                cartItems.appendChild(article);
            });

            updateCartTotal();
        }


        /* =====================================================
           GET DELIVERY DISTANCE
        ===================================================== */

        function getDeliveryDistance() {
            const element = document.getElementById('deliveryDistance');

            if (!element) {
                return 0;
            }

            return Number(element.value) || 0;
        }


        /* =====================================================
           UPDATE QUANTITY
        ===================================================== */

        function changeQuantity(index, direction) {
            const cart = getCart();

            if (!cart[index]) {
                return;
            }

            const item = cart[index];
            const minimumQty = getMinimumQuantity(item);
            const step = getQuantityStep(item);

            let quantity = Number(item.quantity) || 0;

            if (direction > 0) {
                if (minimumQty > 0 && quantity < minimumQty) {
                    quantity = minimumQty;
                } else {
                    quantity += step;
                }
            } else {
                const newQuantity = quantity - step;

                if (minimumQty > 0) {
                    quantity = Math.max(minimumQty, newQuantity);
                } else {
                    quantity = Math.max(0, newQuantity);
                }
            }

            item.quantity = formatNumber(quantity);

            item.total_price = Math.round(
                (calculateItemPrice(item) + Number.EPSILON) * 100
            ) / 100;

            saveCart(cart);
            renderCart();
        }


        /* =====================================================
           CART BUTTON EVENTS
        ===================================================== */

        document.addEventListener('click', function(event) {
            const plusButton = event.target.closest('.cart-plus');

            if (plusButton) {
                const article = plusButton.closest('.cart-item');

                if (article) {
                    changeQuantity(Number(article.dataset.index), 1);
                }

                return;
            }

            const minusButton = event.target.closest('.cart-minus');

            if (minusButton) {
                const article = minusButton.closest('.cart-item');

                if (article) {
                    changeQuantity(Number(article.dataset.index), -1);
                }

                return;
            }

            const removeButton = event.target.closest('.remove-cart-item');

            if (removeButton) {
                const article = removeButton.closest('.cart-item');

                if (!article) {
                    return;
                }

                const cart = getCart();
                const index = Number(article.dataset.index);

                if (index >= 0 && index < cart.length) {
                    cart.splice(index, 1);
                    saveCart(cart);
                    renderCart();
                }
            }
        });


        /* =====================================================
           CLEAR CART
        ===================================================== */

        const clearCartButton = document.querySelector('.clear-cart-btn');

        if (clearCartButton) {
            clearCartButton.addEventListener('click', function() {
                if (getCart().length === 0) {
                    return;
                }

                saveCart([]);
                renderCart();
            });
        }


        /* =====================================================
           CHECKOUT

           Refresh database prices before submitting.
        ===================================================== */

        const checkoutForm = document.getElementById('checkoutForm');

        if (checkoutForm) {
            checkoutForm.addEventListener('submit', async function(event) {
                event.preventDefault();

                if (cartLoading) {
                    return;
                }

                const form = this;
                const button = form.querySelector(
                    'button[type="submit"]'
                );

                const originalButtonText = button ?
                    button.textContent :
                    '';

                cartLoading = true;

                if (button) {
                    button.disabled = true;
                    button.textContent = 'Updating prices...';
                }

                try {
                    // Fetch current product prices from the database.
                    await refreshCartFromDatabase();

                    const cart = getCart();

                    if (cart.length === 0) {
                        alert('Your cart is empty.');
                        return;
                    }

                    const addressElement = document.getElementById(
                        'selectedAddressId'
                    );

                    const addressId = addressElement ?
                        addressElement.value :
                        '';

                    if (!addressId) {
                        alert('Please select a delivery address.');

                        if (typeof openAddressSelector === 'function') {
                            openAddressSelector();
                        }

                        return;
                    }

                    const checkoutCart = document.getElementById(
                        'checkoutCart'
                    );

                    if (!checkoutCart) {
                        throw new Error('Checkout cart field not found.');
                    }

                    checkoutCart.value = JSON.stringify(cart);

                    if (button) {
                        button.textContent = 'Processing...';
                    }

                    const response = await fetch(checkoutUrl, {
                        method: 'POST',
                        credentials: 'same-origin',
                        body: new FormData(form),
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(
                            data.message || 'Unable to proceed to checkout.'
                        );
                    }

                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        throw new Error('Checkout redirect URL is missing.');
                    }

                } catch (error) {
                    console.error('Checkout error:', error);

                    alert(
                        error.message ||
                        'Unable to proceed. Please try again.'
                    );

                } finally {
                    cartLoading = false;

                    if (button) {
                        button.disabled = false;
                        button.textContent = originalButtonText;
                    }
                }
            });
        }


        /* =====================================================
           INITIAL PAGE LOAD

           Do not render stale prices before refresh completes.
        ===================================================== */

        async function initializeCart() {
            const cartItems = document.getElementById('cartItems');

            if (cartItems) {
                cartItems.innerHTML = '<p>Updating cart prices...</p>';
            }

            try {
                await refreshCartFromDatabase();
                renderCart();

            } catch (error) {
                console.error('Cart initialization error:', error);

                if (cartItems) {
                    cartItems.innerHTML = `
                    <p class="cart-error">
                        Unable to update product prices.
                        Please check your connection and refresh the page.
                    </p>
                `;
                }

                // Do not display old prices as confirmed current prices.
            }
        }

        initializeCart();

    });
</script>


@endpush