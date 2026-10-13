@extends('frontend.layouts.app')

@section('title', 'Explore - Nonveg Bazar')

@section('content')

{{-- =====================================================
         EXPLORE HEADER
    ====================================================== --}}

<header class="explore-header">

    <div class="explore-top">

        <div class="explore-location">

            <div class="explore-location-icon">
                📍
            </div>

            <div>

                <span>
                    DELIVERING TO
                </span>

                <strong>
                    Home
                    <small>⌄</small>
                </strong>

            </div>

        </div>


        <a
            href="{{ route('cart') }}"
            class="explore-cart">

            🛒

            <span>
                2
            </span>

        </a>

    </div>


    <div class="explore-heading">


    </div>


    {{-- SEARCH --}}

    <!-- <div class="explore-search">

            <span>
                ⌕
            </span>

            <input
                type="search"
                id="exploreSearch"
                placeholder="Search chicken, fish, prawns..."
                autocomplete="off">

            <button
                type="button"
                class="explore-filter-btn">

                ⚙

            </button>

        </div> -->

    <div class="explore-search-wrapper">

        <div class="explore-search">

            <span>⌕</span>

            <input
                type="search"
                id="exploreSearch"
                placeholder="Search chicken, fish, prawns..."
                autocomplete="off">

            <button
                type="button"
                class="explore-filter-btn">
                ⚙
            </button>

        </div>


        {{-- SUBCATEGORY SEARCH DROPDOWN --}}
        <div
            class="subcategory-search-dropdown"
            id="subcategorySearchDropdown">

            @foreach($subcategories as $subcategory)

            <a
                href="{{ url(
            '/' .
            $subcategory->category->slug .
            '/' .
            $subcategory->slug
        ) }}"
                class="subcategory-search-item"
                data-name="{{ strtolower($subcategory->name) }}">

                <div class="subcategory-search-icon">
                    🥩
                </div>

                <div class="subcategory-search-info">

                    <strong>
                        {{ $subcategory->name }}
                    </strong>

                    <span>
                        {{ $subcategory->category->name }}
                    </span>

                </div>

                <span class="subcategory-search-arrow">
                    →
                </span>

            </a>

            @endforeach

        </div>

    </div>

</header>


{{-- =====================================================
         EXPLORE PAGE
    ====================================================== --}}

<main class="explore-page">


    {{-- =================================================
             QUICK CATEGORIES
        ================================================== --}}

    {{-- =================================================
     ALL SUBCATEGORIES
================================================== --}}

    <section class="explore-section">

        <div class="explore-section-heading">

            <div>

                <span>
                    SHOP BY
                </span>

                <h2>
                    What are you craving?
                </h2>

            </div>

        </div>


        <div class="explore-category-scroll">

            @foreach($subcategories as $subcategory)

            <a
                href="{{ url(
                    '/' .
                    $subcategory->category->slug .
                    '/' .
                    $subcategory->slug
                ) }}"
                class="explore-category">

                <div class="explore-category-image">

                    @if($subcategory->image)

                    <img
                        src="{{ asset($subcategory->image) }}"
                        alt="{{ $subcategory->name }}">

                    @else

                    <img
                        src="https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&w=300&q=85"
                        alt="{{ $subcategory->name }}">

                    @endif

                </div>


                <strong>
                    {{ $subcategory->name }}
                </strong>


                <span>
                    Browse now
                </span>

            </a>

            @endforeach

        </div>

    </section>


    {{-- =================================================
             HERO OFFER
        ================================================== --}}

    <!-- <section class="explore-offer">

        <div class="explore-offer-content">

            <span class="offer-badge">
                WEEKEND SPECIAL
            </span>

            <h2>
                Freshness<br>
                worth sharing.
            </h2>

            <p>
                Get up to 25% OFF on selected
                fresh cuts & seafood.
            </p>

            <a href=""
                class="offer-action">

                Shop Deals

                <span>
                    →
                </span>

            </a>

        </div>


        <div class="explore-offer-image">

            <img
                src="https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=700&q=85"
                alt="Fresh food">

        </div>

    </section> -->


    {{-- =================================================
             TRENDING
        ================================================== --}}

    <!-- <section class="explore-section">

        <div class="explore-section-heading">

            <div>

                <span>
                    TRENDING NOW
                </span>

                <h2>
                    Customers love these
                </h2>

            </div>

            <a href="">
                See all
            </a>

        </div>


        <div class="explore-product-scroll">


            {{-- PRODUCT --}}

            <article class="explore-product-card">

                <div class="explore-product-image">

                    <img
                        src="https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&w=500&q=85"
                        alt="Chicken Curry Cut">

                    <span>
                        12% OFF
                    </span>

                    <button>
                        ♡
                    </button>

                </div>


                <div class="explore-product-content">

                    <h3>
                        Chicken Curry Cut
                    </h3>

                    <p>
                        500 g • Cleaned
                    </p>

                    <div class="explore-product-bottom">

                        <strong>
                            ₹149
                        </strong>

                        <button class="explore-add-btn">
                            +
                        </button>

                    </div>

                </div>

            </article>


            <article class="explore-product-card">

                <div class="explore-product-image">

                    <img
                        src="https://images.unsplash.com/photo-1603360946369-dc9bb6258143?auto=format&fit=crop&w=500&q=85"
                        alt="Chicken Breast">

                    <span>
                        15% OFF
                    </span>

                    <button>
                        ♡
                    </button>

                </div>


                <div class="explore-product-content">

                    <h3>
                        Chicken Breast
                    </h3>

                    <p>
                        500 g • Boneless
                    </p>

                    <div class="explore-product-bottom">

                        <strong>
                            ₹229
                        </strong>

                        <button class="explore-add-btn">
                            +
                        </button>

                    </div>

                </div>

            </article>


            <article class="explore-product-card">

                <div class="explore-product-image">

                    <img
                        src="https://images.unsplash.com/photo-1565680018434-b513d5e5fd47?auto=format&fit=crop&w=500&q=85"
                        alt="Fresh Prawns">

                    <span>
                        10% OFF
                    </span>

                    <button>
                        ♡
                    </button>

                </div>


                <div class="explore-product-content">

                    <h3>
                        Fresh Prawns
                    </h3>

                    <p>
                        500 g • Cleaned
                    </p>

                    <div class="explore-product-bottom">

                        <strong>
                            ₹299
                        </strong>

                        <button class="explore-add-btn">
                            +
                        </button>

                    </div>

                </div>

            </article>


        </div>

    </section> -->


    {{-- =================================================
             READY TO COOK
        ================================================== --}}

    <section class="explore-section">

        <div class="explore-section-heading">

            <div>

                <span>
                    EASY COOKING
                </span>

                <h2>
                    Ready to Cook
                </h2>

            </div>

            <a href="#">
                View all
            </a>

        </div>


        <div class="ready-cook-grid">


            <a href="#"
                class="ready-cook-card large">

                <img
                    src="https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?auto=format&fit=crop&w=700&q=85"
                    alt="Chicken Tikka">

                <div>

                    <span>
                        20 MIN
                    </span>

                    <h3>
                        Chicken Tikka
                    </h3>

                </div>

            </a>


            <a href="#"
                class="ready-cook-card">

                <img
                    src="https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=500&q=85"
                    alt="Kebab">

                <div>

                    <span>
                        15 MIN
                    </span>

                    <h3>
                        Seekh Kebab
                    </h3>

                </div>

            </a>


            <a href="#"
                class="ready-cook-card">

                <img
                    src="https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=500&q=85"
                    alt="Marinated Chicken">

                <div>

                    <span>
                        25 MIN
                    </span>

                    <h3>
                        Marinated Chicken
                    </h3>

                </div>

            </a>


        </div>

    </section>


    {{-- =================================================
             COMBO
        ================================================== --}}

    <section class="combo-banner">

        <div class="combo-content">

            <span>
                VALUE COMBO
            </span>

            <h2>
                Family Feast
            </h2>

            <p>
                Chicken + kebabs + sides
            </p>

            <strong>
                ₹499
            </strong>

            <a href="#">
                Grab Deal →
            </a>

        </div>


        <div class="combo-image">

            <img
                src="https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=600&q=85"
                alt="Family Feast">

        </div>

    </section>


    {{-- =================================================
             WHY NONVEG BAZAR
        ================================================== --}}

    <section class="why-explore">

        <div class="explore-section-heading">

            <div>

                <span>
                    WHY US
                </span>

                <h2>
                    Freshness you can trust
                </h2>

            </div>

        </div>


        <div class="why-grid">

            <div class="why-card">

                <div>
                    🥩
                </div>

                <strong>
                    Fresh Cuts
                </strong>

                <span>
                    Selected daily
                </span>

            </div>


            <div class="why-card">

                <div>
                    🧼
                </div>

                <strong>
                    Hygienic
                </strong>

                <span>
                    Clean & packed
                </span>

            </div>


            <div class="why-card">

                <div>
                    🚴
                </div>

                <strong>
                    Fast Delivery
                </strong>

                <span>
                    Under 45 mins
                </span>

            </div>


            <div class="why-card">

                <div>
                    💰
                </div>

                <strong>
                    Best Value
                </strong>

                <span>
                    Great daily deals
                </span>

            </div>

        </div>

    </section>


</main>


{{-- =====================================================
         BOTTOM NAVIGATION
    ====================================================== --}}

@include('frontend.components.bottom-nav')


@endsection


@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        /* =====================================================
           SEARCH
        ====================================================== */

        const search =
            document.getElementById('exploreSearch');

        const cards =
            document.querySelectorAll('.explore-product-card');

        const dropdown =
            document.getElementById('subcategorySearchDropdown');

        const subcategoryItems =
            document.querySelectorAll('.subcategory-search-item');


        /* =====================================================
           SEARCH INPUT
        ====================================================== */

        if (search) {

            search.addEventListener('input', function() {

                const value =
                    this.value
                    .toLowerCase()
                    .trim();


                /* =============================================
                   PRODUCT SEARCH
                ============================================== */

                cards.forEach(function(card) {

                    const heading =
                        card.querySelector('h3');

                    if (!heading) {
                        return;
                    }

                    const name =
                        heading.textContent
                        .toLowerCase();

                    card.style.display =
                        name.includes(value) ?
                        '' :
                        'none';

                });


                /* =============================================
                   SUBCATEGORY DROPDOWN
                   
                   Show ONLY when user types
                ============================================== */

                if (!dropdown) {
                    return;
                }


                /*
                 * Empty search
                 * Hide dropdown
                 */

                if (value === '') {

                    dropdown.classList.remove('show');

                    subcategoryItems.forEach(function(item) {

                        item.style.display = '';

                    });

                    const emptyMessage =
                        dropdown.querySelector(
                            '.subcategory-search-empty'
                        );

                    if (emptyMessage) {
                        emptyMessage.remove();
                    }

                    return;
                }


                /*
                 * User typed something
                 * Show dropdown
                 */

                dropdown.classList.add('show');


                let found = false;


                subcategoryItems.forEach(function(item) {

                    const name =
                        (
                            item.dataset.name ||
                            item.textContent
                        )
                        .toLowerCase()
                        .trim();


                    if (name.includes(value)) {

                        item.style.display = '';

                        found = true;

                    } else {

                        item.style.display = 'none';

                    }

                });


                /* =============================================
                   NO RESULT
                ============================================== */

                let emptyMessage =
                    dropdown.querySelector(
                        '.subcategory-search-empty'
                    );


                if (!found) {

                    if (!emptyMessage) {

                        emptyMessage =
                            document.createElement('div');

                        emptyMessage.className =
                            'subcategory-search-empty';

                        emptyMessage.textContent =
                            'No subcategory found';

                        dropdown.appendChild(
                            emptyMessage
                        );

                    }

                } else {

                    if (emptyMessage) {
                        emptyMessage.remove();
                    }

                }

            });

        }


        /* =====================================================
           CLOSE DROPDOWN
        ====================================================== */

        document.addEventListener('click', function(event) {

            if (!event.target.closest('.explore-search-wrapper')) {

                if (dropdown) {

                    dropdown.classList.remove('show');

                }

            }

        });


        /* =====================================================
           WISHLIST
        ====================================================== */

        document
            .querySelectorAll(
                '.explore-product-image button'
            )
            .forEach(function(button) {

                button.addEventListener(
                    'click',
                    function(event) {

                        event.preventDefault();
                        event.stopPropagation();


                        this.textContent =
                            this.textContent === '♡' ?
                            '♥' :
                            '♡';


                        this.classList.toggle('liked');

                    }
                );

            });

    });
</script>

@endpush