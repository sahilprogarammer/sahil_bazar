@extends('frontend.layouts.app')

@section('title', 'Chicken - Nonveg Bazar')

@section('content')

{{-- =========================
         FIXED PAGE HEADER
    ========================== --}}
<header class="page-header">

    <a href="{{ route('categories') }}" class="back-btn">
        ←
    </a>

    <div class="page-header-title">

        <h1>
            {{ ucfirst($category ?? 'Products') }}
        </h1>

        <span>
            Fresh & hygienic
        </span>

    </div>

    <a href="#" class="header-btn page-cart-btn">
        🛒

        <span class="cart-count">
            2
        </span>
    </a>

</header>


{{-- =========================
         FILTER / SORT BAR
    ========================== --}}
<!-- <div class="product-filter-wrapper">

    <div class="product-search">

        <span>
            ⌕
        </span>

        <input
            type="search"
            id="productSearch"
            placeholder="Search products..."
            autocomplete="off">

    </div>


    <div class="filter-row">

        <button
            type="button"
            class="filter-btn active"
            data-filter="all">

            All

        </button>


        <button
            type="button"
            class="filter-btn"
            data-filter="chicken">

            Chicken

        </button>


        <button
            type="button"
            class="filter-btn"
            data-filter="combo">

            Combos

        </button>


        <button
            type="button"
            class="filter-btn">

            ⚙ Filter

        </button>

    </div>

</div> -->


{{-- =========================
         PRODUCT PAGE
    ========================== --}}
<main class="product-page">


    {{-- =========================
             TITLE
        ========================== --}}
    <div class="product-page-heading">

        <div>

            <span class="product-page-label">
                FRESH TODAY
            </span>

            <h2>
                {{ ucfirst($category ?? 'Chicken') }}
            </h2>

        </div>


        <button
            type="button"
            class="sort-btn">

            Sort
            <span>↓</span>

        </button>

    </div>


    {{-- =========================
             PRODUCTS
        ========================== --}}
    <section class="products product-list">


        {{-- PRODUCT 1 --}}
        <article
            class="product-card"
            data-name="fresh chicken curry cut"
            data-category="chicken">

            <div class="product-image">

                <img
                    src="https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&w=700&q=85"
                    alt="Fresh Chicken Curry Cut">

                <span class="discount">
                    12% OFF
                </span>

                <button
                    type="button"
                    class="heart">

                    ♡

                </button>

            </div>


            <div class="product-info">

                <h3 class="product-name">
                    Fresh Chicken Curry Cut
                </h3>

                <p class="product-weight">
                    500 g • Cleaned
                </p>

                <div class="product-rating">
                    ★ 4.8
                    <span>
                        (124)
                    </span>
                </div>


                <div class="product-bottom">

                    <div class="product-price">

                        <span class="price">
                            ₹149
                        </span>

                        <span class="old-price">
                            ₹169
                        </span>

                    </div>

                    <div class="quantity-control">

                        <button type="button" class="quantity-btn minus">
                            −
                        </button>

                        <span class="quantity">
                            0
                        </span>

                        <button type="button" class="quantity-btn plus">
                            +
                        </button>

                    </div>

                </div>

            </div>

        </article>


        {{-- PRODUCT 2 --}}
        <article
            class="product-card"
            data-name="chicken breast boneless"
            data-category="chicken">

            <div class="product-image">

                <img
                    src="https://images.unsplash.com/photo-1603360946369-dc9bb6258143?auto=format&fit=crop&w=700&q=85"
                    alt="Chicken Breast">

                <span class="discount">
                    15% OFF
                </span>

                <button
                    type="button"
                    class="heart">

                    ♡

                </button>

            </div>


            <div class="product-info">

                <h3 class="product-name">
                    Chicken Breast Boneless
                </h3>

                <p class="product-weight">
                    500 g • Boneless
                </p>

                <div class="product-rating">
                    ★ 4.9
                    <span>
                        (98)
                    </span>
                </div>


                <div class="product-bottom">

                    <div class="product-price">

                        <span class="price">
                            ₹229
                        </span>

                        <span class="old-price">
                            ₹269
                        </span>

                    </div>

                    <div class="quantity-control">

                        <button type="button" class="quantity-btn minus">
                            −
                        </button>

                        <span class="quantity">
                            0
                        </span>

                        <button type="button" class="quantity-btn plus">
                            +
                        </button>

                    </div>

                </div>

            </div>

        </article>


        {{-- PRODUCT 3 --}}
        <article
            class="product-card"
            data-name="chicken leg pieces"
            data-category="chicken">

            <div class="product-image">

                <img
                    src="https://images.unsplash.com/photo-1527477396000-e27163b481c2?auto=format&fit=crop&w=700&q=85"
                    alt="Chicken Leg">

                <span class="discount">
                    10% OFF
                </span>

                <button
                    type="button"
                    class="heart">

                    ♡

                </button>

            </div>


            <div class="product-info">

                <h3 class="product-name">
                    Chicken Leg Pieces
                </h3>

                <p class="product-weight">
                    500 g • Fresh Cut
                </p>

                <div class="product-rating">
                    ★ 4.7
                    <span>
                        (76)
                    </span>
                </div>


                <div class="product-bottom">

                    <div class="product-price">

                        <span class="price">
                            ₹179
                        </span>

                        <span class="old-price">
                            ₹199
                        </span>

                    </div>

                    <div class="quantity-control">

                        <button type="button" class="quantity-btn minus">
                            −
                        </button>

                        <span class="quantity">
                            0
                        </span>

                        <button type="button" class="quantity-btn plus">
                            +
                        </button>

                    </div>

                </div>

            </div>

        </article>


        {{-- PRODUCT 4 --}}
        <article
            class="product-card"
            data-name="chicken wings"
            data-category="chicken">

            <div class="product-image">

                <img
                    src="https://images.unsplash.com/photo-1567620832903-9fc6debc209f?auto=format&fit=crop&w=700&q=85"
                    alt="Chicken Wings">

                <span class="discount">
                    8% OFF
                </span>

                <button
                    type="button"
                    class="heart">

                    ♡

                </button>

            </div>


            <div class="product-info">

                <h3 class="product-name">
                    Chicken Wings
                </h3>

                <p class="product-weight">
                    500 g • Fresh
                </p>

                <div class="product-rating">
                    ★ 4.6
                    <span>
                        (54)
                    </span>
                </div>


                <div class="product-bottom">

                    <div class="product-price">

                        <span class="price">
                            ₹159
                        </span>

                        <span class="old-price">
                            ₹179
                        </span>

                    </div>

                    <div class="quantity-control">

                        <button type="button" class="quantity-btn minus">
                            −
                        </button>

                        <span class="quantity">
                            0
                        </span>

                        <button type="button" class="quantity-btn plus">
                            +
                        </button>

                    </div>

                </div>

            </div>

        </article>


        {{-- PRODUCT 5 --}}
        <article
            class="product-card"
            data-name="chicken keema"
            data-category="chicken">

            <div class="product-image">

                <img
                    src="https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=700&q=85"
                    alt="Chicken Keema">

                <span class="discount">
                    12% OFF
                </span>

                <button
                    type="button"
                    class="heart">

                    ♡

                </button>

            </div>


            <div class="product-info">

                <h3 class="product-name">
                    Chicken Keema
                </h3>

                <p class="product-weight">
                    500 g • Minced
                </p>

                <div class="product-rating">
                    ★ 4.8
                    <span>
                        (61)
                    </span>
                </div>


                <div class="product-bottom">

                    <div class="product-price">

                        <span class="price">
                            ₹199
                        </span>

                        <span class="old-price">
                            ₹229
                        </span>

                    </div>

                    <div class="quantity-control">

                        <button type="button" class="quantity-btn minus">
                            −
                        </button>

                        <span class="quantity">
                            0
                        </span>

                        <button type="button" class="quantity-btn plus">
                            +
                        </button>

                    </div>

                </div>

            </div>

        </article>


        {{-- PRODUCT 6 --}}
        <article
            class="product-card"
            data-name="chicken tikka cut"
            data-category="combo">

            <div class="product-image">

                <img
                    src="https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?auto=format&fit=crop&w=700&q=85"
                    alt="Chicken Tikka">

                <span class="discount">
                    18% OFF
                </span>

                <button
                    type="button"
                    class="heart">

                    ♡

                </button>

            </div>


            <div class="product-info">

                <h3 class="product-name">
                    Chicken Tikka Cut
                </h3>

                <p class="product-weight">
                    500 g • Ready to Cook
                </p>

                <div class="product-rating">
                    ★ 4.9
                    <span>
                        (89)
                    </span>
                </div>


                <div class="product-bottom">

                    <div class="product-price">

                        <span class="price">
                            ₹249
                        </span>

                        <span class="old-price">
                            ₹299
                        </span>

                    </div>

                    <div class="quantity-control">

                        <button type="button" class="quantity-btn minus">
                            −
                        </button>

                        <span class="quantity">
                            0
                        </span>

                        <button type="button" class="quantity-btn plus">
                            +
                        </button>

                    </div>

                </div>

            </div>

        </article>


    </section>


    {{-- =========================
             NO RESULT
        ========================== --}}
    <div
        id="noProducts"
        class="no-products"
        style="display:none;">

        <div class="no-products-icon">
            🔍
        </div>

        <h3>
            No products found
        </h3>

        <p>
            Try searching with another name.
        </p>

    </div>


</main>


{{-- Bottom Navigation --}}
@include('frontend.components.bottom-nav')

@endsection


@push('scripts')

<script>
    /* =========================================================
   PRODUCT QUANTITY
========================================================= */

    document
        .querySelectorAll('.product-card')
        .forEach(function(card) {

            const quantityControl =
                card.querySelector('.quantity-control');

            const quantity =
                card.querySelector('.quantity');

            const plusBtn =
                card.querySelector('.plus');

            const minusBtn =
                card.querySelector('.minus');


            let count = 0;


            /* PLUS */

            plusBtn.addEventListener('click', function() {

                count++;

                quantity.textContent = count;

                quantityControl.classList.add('show');

            });


            /* MINUS */

            minusBtn.addEventListener('click', function() {

                if (count > 0) {

                    count--;

                    quantity.textContent = count;

                }


                if (count === 0) {

                    quantityControl.classList.remove('show');

                }

            });

        });

    document.addEventListener('DOMContentLoaded', function() {

        const searchInput =
            document.getElementById('productSearch');

        const products =
            document.querySelectorAll('.product-card');

        const filterButtons =
            document.querySelectorAll('.filter-btn');

        const noProducts =
            document.getElementById('noProducts');


        let activeFilter = 'all';


        function filterProducts() {

            const search =
                searchInput.value
                .toLowerCase()
                .trim();

            let visibleCount = 0;


            products.forEach(function(product) {

                const name =
                    product.dataset.name
                    .toLowerCase();

                const category =
                    product.dataset.category
                    .toLowerCase();


                const matchesSearch =
                    name.includes(search);


                const matchesFilter =
                    activeFilter === 'all' ||
                    category === activeFilter;


                if (
                    matchesSearch &&
                    matchesFilter
                ) {

                    product.style.display = '';

                    visibleCount++;

                } else {

                    product.style.display = 'none';

                }

            });


            noProducts.style.display =
                visibleCount === 0 ?
                'block' :
                'none';

        }


        /* Search */

        searchInput.addEventListener(
            'input',
            filterProducts
        );


        /* Filter */

        filterButtons.forEach(function(button) {

            button.addEventListener(
                'click',
                function() {

                    filterButtons.forEach(function(btn) {

                        btn.classList.remove('active');

                    });


                    this.classList.add('active');


                    activeFilter =
                        this.dataset.filter || 'all';


                    filterProducts();

                }
            );

        });


        /* Heart */

        document
            .querySelectorAll('.heart')
            .forEach(function(button) {

                button.addEventListener(
                    'click',
                    function(event) {

                        event.preventDefault();

                        this.classList.toggle('liked');

                        this.textContent =
                            this.classList.contains('liked') ?
                            '♥' :
                            '♡';

                    }
                );

            });


    });
</script>

@endpush