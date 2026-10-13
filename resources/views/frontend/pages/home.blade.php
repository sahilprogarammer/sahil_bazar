@extends('frontend.layouts.app')

@section('title', 'Nonveg Mart - Fresh Non-Veg Delivered')

@section('content')

{{-- Header --}}
@include('frontend.components.header')


{{-- =========================
         MAIN CONTENT
    ========================== --}}
<main class="home-content">

    {{-- Hero --}}
    <section class="hero-section">

        <div class="hero">

            <div class="hero-content">

                <span class="hero-badge">
                    Fresh Everyday
                </span>

                <h1>
                    Fresh Non-Veg.<br>
                    Delivered Fast.
                </h1>

                <p>
                    Premium quality chicken, fish, mutton
                    and seafood at your doorstep.
                </p>

                <a href="{{ url('/nonveg') }}" class="hero-btn">
                    Shop Now
                    <span>→</span>
                </a>

            </div>

        </div>

    </section>


    {{-- =========================
             CATEGORIES
        ========================== --}}
    @foreach($categories as $category)
    <section class="section">

        <div class="section-header">

            <h2 class="section-title">
                Shop by {{ $category->name }}
            </h2>

            <a href="{{ url($category->slug) }}" class="view-all">
                View All
            </a>

        </div>


        <div class="categories">

            @foreach($category->subcategories as $subcategory)

            <a href="{{ url($category->slug . '/' . $subcategory->slug) }}" class="category">

                <div class="category-image">

                    <img
                        src="{{ $subcategory->image }}"
                        alt="Chicken">

                </div>

                <span class="category-name">
                    {{ $subcategory->name }}
                </span>

            </a>

            @endforeach

        </div>

    </section>
    @endforeach


    {{-- =========================
             OFFER
        ========================== --}}
    <section class="section">

        <div class="offer-card">

            <div class="offer-content">

                <span class="offer-small">
                    WEEKEND SPECIAL
                </span>

                <h2 class="offer-title">
                    Get 20% OFF
                </h2>

                <p class="offer-desc">
                    On your first non-veg order
                </p>

                <a href="#" class="offer-btn">
                    ORDER NOW
                </a>

            </div>

            <div class="offer-image">

                <img
                    src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=400&q=80"
                    alt="Special Offer">

            </div>

        </div>

    </section>


    {{-- =========================
             BEST SELLERS
        ========================== --}}
    <section class="section">

        <div class="section-header">

            <h2 class="section-title">
                Best Sellers
                <span class="fire-icon">🔥</span>
            </h2>

            <!-- <a href="#" class="view-all">
                See All
            </a> -->

        </div>


        <div class="products">

            {{-- Product --}}
            @foreach($popularProducts as $product)
            <article
                class="product-card"
                data-product-id="{{ $product->id }}"
                data-name="{{ $product->name }}"
                data-category="{{ $product->subcategory_id }}"
                data-unit="{{ $product->unit }}"
                data-price="{{ $product->price }}"
                data-discount-price="{{ $product->discount_price }}"
                data-min-qty="{{ $product->minimum_order_qty }}"
                data-image="{{ !empty($product->images) ? asset($product->images[0]) : '' }}">

                <div class=" product-image">

                    @if(!empty($product->images) && count($product->images) > 0)
                    <img
                        src="{{ asset($product->images[0]) }}"
                        alt="{{ $product->name }}">
                    @endif

                    @if($product->price > $product->discount_price)
                    @php
                    $discount = round(
                    (($product->price - $product->discount_price) / $product->price) * 100
                    );
                    @endphp

                    <span class="discount">
                        {{ $discount }}% OFF
                    </span>
                    @endif

                    <!-- <button type="button" class="heart">
                        ♡
                    </button> -->

                </div>

                <div class="product-info">

                    <h3 class="product-name">
                        {{ $product->name }}
                    </h3>

                    <p class="product-weight">
                        Minimum {{ $product->minimum_order_qty }} {{ $product->unit }}
                    </p>

                    <div class="product-rating">
                        ★ 4.8
                        <span>(124)</span>
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

                            <button
                                type="button"
                                class="add-btn"
                                onclick="openQuantityModal(this)">
                                +
                            </button>

                        </div>

                    </div>

                </div>

            </article>
            @endforeach

        </div>

    </section>


    {{-- =========================
             WHY NONVEG BAZAR
        ========================== --}}
    <section class="section">

        <div class="section-header">

            <h2 class="section-title">
                Why Nonveg Mart?
            </h2>

        </div>


        <div class="features">

            <div class="feature">

                <div class="feature-icon">
                    🥩
                </div>

                <h3 class="feature-title">
                    Fresh Meat
                </h3>

                <p class="feature-text">
                    Freshly prepared
                </p>

            </div>


            <div class="feature">

                <div class="feature-icon">
                    🚚
                </div>

                <h3 class="feature-title">
                    Fast Delivery
                </h3>

                <p class="feature-text">
                    Within your area
                </p>

            </div>


            <div class="feature">

                <div class="feature-icon">
                    🛡️
                </div>

                <h3 class="feature-title">
                    Hygienic
                </h3>

                <p class="feature-text">
                    Safe & clean
                </p>

            </div>

        </div>

    </section>

</main>


{{-- Bottom Navigation --}}
@include('frontend.components.bottom-nav')

@endsection