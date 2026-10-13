@extends('frontend.layouts.app')

@section('title', 'Chicken - Nonveg Bazar')

@section('content')

<style>
    /* =====================================================
   PRODUCT AVAILABILITY
===================================================== */

    .product-image {
        position: relative;
    }


    /* =====================================================
   UNAVAILABLE PRODUCT
===================================================== */

    .product-unavailable .product-image img {
        filter: grayscale(25%);
        opacity: 0.55;
    }


    /* =====================================================
   STATUS BADGE
===================================================== */

    .product-status {
        position: absolute;

        left: 10px;
        bottom: 10px;

        padding: 6px 10px;

        border-radius: 8px;

        font-size: 10px;
        font-weight: 800;

        letter-spacing: 0.3px;

        color: #ffffff;

        z-index: 2;
    }


    /* SOLD OUT */

    .status-2 {
        background: #555555;
    }


    /* NOT AVAILABLE */

    .status-3 {
        background: #d9534f;
    }


    /* COMING SOON */

    .status-4 {
        background: #f47c20;
    }


    /* =====================================================
   UNAVAILABLE ADD BUTTON
===================================================== */

    .unavailable-btn {
        border: 0;

        background: #eeeeee;

        color: #999999;

        min-height: 34px;

        padding: 0 10px;

        border-radius: 9px;

        font-size: 9px;

        font-weight: 800;

        cursor: not-allowed;

        white-space: nowrap;
    }


    /* =====================================================
   DISABLE HEART
===================================================== */

    .product-unavailable .heart {
        opacity: 0.5;

        cursor: not-allowed;
    }
</style>

<!-- // FIXED PAGE HEADER -->
<header class="page-header">

    <a href="{{ url($category->slug) }}" class="back-btn">
        ←
    </a>

    <div class="page-header-title">

        <h1>
            {{ $subcategory->name }}
        </h1>

        <span>
            Fresh & hygienic
        </span>

    </div>

    <a href="#" class="header-btn page-cart-btn">
        🛒

        <span class="cart-count" id="headerCartCount">0</span>
    </a>

</header>


<!-- // FILTER / SORT BAR -->
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


<!-- // PRODUCT PAGE -->
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
                {{ $subcategory->name }}
            </h2>

        </div>


        <button
            type="button"
            class="sort-btn">

            Sort
            <span>↓</span>

        </button>

    </div>

    <!-- PRODUCTS -->

    <section class="products product-list">

        @foreach($products as $product)

        @php
            $status = $product->availability_status ?? 1;

            $statusText = match ($status) {
                2 => 'SOLD OUT',
                3 => 'NOT AVAILABLE',
                4 => 'COMING SOON',
                default => 'AVAILABLE',
            };

            $isAvailable = $status === 1;
        @endphp


        <article
            class="product-card {{ !$isAvailable ? 'product-unavailable' : '' }}"

            data-product-id="{{ $product->id }}"
            data-name="{{ $product->name }}"
            data-category="{{ $product->subcategory_id }}"
            data-unit="{{ $product->unit }}"
            data-price="{{ $product->price }}"
            data-discount-price="{{ $product->discount_price }}"
            data-min-qty="{{ $product->minimum_order_qty }}"
            data-image="{{ !empty($product->images) ? asset($product->images[0]) : '' }}"
            data-status="{{ $status }}">


            <div class="product-image">

                @if(!empty($product->images) && count($product->images) > 0)

                <img
                    src="{{ asset($product->images[0]) }}"
                    alt="{{ $product->name }}">

                @endif


                {{-- STATUS --}}
                @if(!$isAvailable)

                <span class="product-status status-{{ $status }}">
                    {{ $statusText }}
                </span>

                @elseif($product->price > $product->discount_price)

                @php
                $discount = round(
                (($product->price - $product->discount_price)
                / $product->price) * 100
                );
                @endphp

                <span class="discount">
                    {{ $discount }}% OFF
                </span>

                @endif


                {{-- HEART --}}
                <button
                    type="button"
                    class="heart"
                    {{ !$isAvailable ? 'disabled' : '' }}>

                    ♡

                </button>

            </div>


            <div class="product-info">

                <h3 class="product-name">
                    {{ $product->name }}
                </h3>


                <p class="product-weight">
                    Minimum
                    {{ $product->minimum_order_qty }}
                    {{ $product->unit }}
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
                            ₹{{ number_format($product->discount_price, 0) }}
                        </span>


                        @if($product->price > $product->discount_price)

                        <span class="old-price">
                            ₹{{ number_format($product->price, 0) }}
                        </span>

                        @endif

                    </div>


                    <div class="product-action">

                        @if($isAvailable)

                        <button
                            type="button"
                            class="add-btn"
                            onclick="openQuantityModal(this)">

                            +

                        </button>

                        @else

                        <button
                            type="button"
                            class="unavailable-btn"
                            disabled>

                            {{ $statusText }}

                        </button>

                        @endif

                    </div>

                </div>

            </div>

        </article>

        @endforeach

    </section>


    <!-- NO RESULT -->
    <div
        id="noProducts"
        class="no-products"
        style="{{ $products->count() > 0 ? 'display:none;' : 'display:block;' }}">

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