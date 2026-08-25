@extends('frontend.layouts.app')

@section('title', 'Nonveg Bazar - Fresh Non-Veg Delivered')

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

                    <a href="#" class="hero-btn">
                        Shop Now
                        <span>→</span>
                    </a>

                </div>

            </div>

        </section>


        {{-- =========================
             CATEGORIES
        ========================== --}}
        <section class="section">

            <div class="section-header">

                <h2 class="section-title">
                    Shop by Category
                </h2>

                <a href="{{ route('categories') }}" class="view-all">
                    View All
                </a>

            </div>


            <div class="categories">

                <a href="#" class="category">

                    <div class="category-image">

                        <img
                            src="https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&w=300&q=80"
                            alt="Chicken">

                    </div>

                    <span class="category-name">
                        Chicken
                    </span>

                </a>


                <a href="#" class="category">

                    <div class="category-image">

                        <img
                            src="https://images.unsplash.com/photo-1544943910-4c1dc44aab44?auto=format&fit=crop&w=300&q=80"
                            alt="Fish">

                    </div>

                    <span class="category-name">
                        Fish
                    </span>

                </a>


                <a href="#" class="category">

                    <div class="category-image">

                        <img
                            src="https://images.unsplash.com/photo-1529692236671-f1f6cf9683ba?auto=format&fit=crop&w=300&q=80"
                            alt="Mutton">

                    </div>

                    <span class="category-name">
                        Mutton
                    </span>

                </a>


                <a href="#" class="category">

                    <div class="category-image">

                        <img
                            src="https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&w=300&q=80"
                            alt="Prawns">

                    </div>

                    <span class="category-name">
                        Prawns
                    </span>

                </a>


                <a href="#" class="category">

                    <div class="category-image">

                        <img
                            src="https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?auto=format&fit=crop&w=300&q=80"
                            alt="Liver">

                    </div>

                    <span class="category-name">
                        Liver
                    </span>

                </a>

            </div>

        </section>


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

                <a href="#" class="view-all">
                    See All
                </a>

            </div>


            <div class="products">

                {{-- Product --}}
                <article class="product-card">

                    <div class="product-image">

                        <img
                            src="https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&w=600&q=85"
                            alt="Fresh Chicken Curry Cut">

                        <span class="discount">
                            12% OFF
                        </span>

                        <button type="button" class="heart">
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

                        <div class="product-bottom">

                            <div class="product-price">

                                <span class="price">
                                    ₹149
                                </span>

                                <span class="old-price">
                                    ₹169
                                </span>

                            </div>

                            <button type="button" class="add-btn">
                                +
                            </button>

                        </div>

                    </div>

                </article>


                {{-- Product --}}
                <article class="product-card">

                    <div class="product-image">

                        <img
                            src="https://images.unsplash.com/photo-1529692236671-f1f6cf9683ba?auto=format&fit=crop&w=600&q=85"
                            alt="Premium Mutton">

                        <span class="discount">
                            10% OFF
                        </span>

                        <button type="button" class="heart">
                            ♡
                        </button>

                    </div>


                    <div class="product-info">

                        <h3 class="product-name">
                            Premium Mutton
                        </h3>

                        <p class="product-weight">
                            500 g • Fresh Cut
                        </p>

                        <div class="product-bottom">

                            <div class="product-price">

                                <span class="price">
                                    ₹399
                                </span>

                                <span class="old-price">
                                    ₹449
                                </span>

                            </div>

                            <button type="button" class="add-btn">
                                +
                            </button>

                        </div>

                    </div>

                </article>


                {{-- Product --}}
                <article class="product-card">

                    <div class="product-image">

                        <img
                            src="https://images.unsplash.com/photo-1544943910-4c1dc44aab44?auto=format&fit=crop&w=600&q=85"
                            alt="Fresh Rohu Fish">

                        <span class="discount">
                            15% OFF
                        </span>

                        <button type="button" class="heart">
                            ♡
                        </button>

                    </div>


                    <div class="product-info">

                        <h3 class="product-name">
                            Fresh Rohu Fish
                        </h3>

                        <p class="product-weight">
                            1 kg • Cleaned
                        </p>

                        <div class="product-bottom">

                            <div class="product-price">

                                <span class="price">
                                    ₹249
                                </span>

                                <span class="old-price">
                                    ₹299
                                </span>

                            </div>

                            <button type="button" class="add-btn">
                                +
                            </button>

                        </div>

                    </div>

                </article>


                {{-- Product --}}
                <article class="product-card">

                    <div class="product-image">

                        <img
                            src="https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&w=600&q=85"
                            alt="Fresh Prawns">

                        <span class="discount">
                            8% OFF
                        </span>

                        <button type="button" class="heart">
                            ♡
                        </button>

                    </div>


                    <div class="product-info">

                        <h3 class="product-name">
                            Fresh Prawns
                        </h3>

                        <p class="product-weight">
                            500 g • Cleaned
                        </p>

                        <div class="product-bottom">

                            <div class="product-price">

                                <span class="price">
                                    ₹329
                                </span>

                                <span class="old-price">
                                    ₹359
                                </span>

                            </div>

                            <button type="button" class="add-btn">
                                +
                            </button>

                        </div>

                    </div>

                </article>

            </div>

        </section>


        {{-- =========================
             WHY NONVEG BAZAR
        ========================== --}}
        <section class="section">

            <div class="section-header">

                <h2 class="section-title">
                    Why Nonveg Bazar?
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