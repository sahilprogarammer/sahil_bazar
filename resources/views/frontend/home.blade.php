<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Nonveg Bazar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
            background: #f7f8f5;
            color: #172018;
        }

        body {
            -webkit-tap-highlight-color: transparent;
        }

        button,
        input {
            font-family: inherit;
        }

        button {
            border: 0;
            cursor: pointer;
        }

        /* =========================
           MOBILE APP CONTAINER
        ========================== */

        .app {
            width: 100%;
            max-width: 390px;
            min-height: 100vh;
            margin: 0 auto;
            background: #f7f8f5;
            padding-bottom: 88px;
            overflow-x: hidden;
        }

        /* =========================
           HEADER
        ========================== */

        .header {
            padding: 18px 16px 12px;
            background: #14532d;
            color: #fff;
            border-radius: 0 0 24px 24px;
        }

        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .location {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .location-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: rgba(255, 255, 255, .13);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .location-text small {
            display: block;
            font-size: 10px;
            color: rgba(255, 255, 255, .7);
            margin-bottom: 2px;
        }

        .location-text strong {
            display: block;
            font-size: 13px;
            font-weight: 700;
        }

        .header-actions {
            display: flex;
            gap: 8px;
        }

        .header-btn {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: rgba(255, 255, 255, .13);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            position: relative;
        }

        .notification-dot {
            position: absolute;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #f97316;
            top: 8px;
            right: 8px;
            border: 2px solid #14532d;
        }

        /* =========================
           SEARCH
        ========================== */

        .search-box {
            margin-top: 18px;
            height: 50px;
            background: #fff;
            border-radius: 15px;
            display: flex;
            align-items: center;
            padding: 0 15px;
            gap: 10px;
            color: #8a938a;
        }

        .search-box span {
            font-size: 18px;
        }

        .search-box input {
            border: 0;
            outline: none;
            background: transparent;
            flex: 1;
            font-size: 13px;
            color: #172018;
        }

        .search-box input::placeholder {
            color: #9aa29b;
        }

        /* =========================
           HERO
        ========================== */

        .hero-section {
            padding: 18px 16px 0;
        }

        .hero {
            min-height: 205px;
            border-radius: 22px;
            overflow: hidden;
            position: relative;
            background:
                linear-gradient(90deg,
                    rgba(10, 46, 25, .96) 0%,
                    rgba(10, 46, 25, .75) 45%,
                    rgba(10, 46, 25, .05) 100%),
                url('https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&w=900&q=85');

            background-size: cover;
            background-position: center;
            padding: 24px 20px;
            color: #fff;
        }

        .hero-content {
            max-width: 210px;
        }

        .hero-badge {
            display: inline-flex;
            background: #f97316;
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 10px;
        }

        .hero h1 {
            font-size: 24px;
            line-height: 1.2;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .hero p {
            font-size: 11px;
            line-height: 1.6;
            color: rgba(255, 255, 255, .82);
            margin-bottom: 15px;
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #fff;
            color: #14532d;
            padding: 10px 15px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 800;
        }

        /* =========================
           SECTION
        ========================== */

        .section {
            padding: 22px 16px 0;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 13px;
        }

        .section-title {
            font-size: 17px;
            font-weight: 800;
            color: #172018;
        }

        .view-all {
            color: #14532d;
            font-size: 11px;
            font-weight: 700;
        }

        /* =========================
           CATEGORIES
        ========================== */

        .categories {
            display: flex;
            gap: 11px;
            overflow-x: auto;
            padding-bottom: 4px;
            scrollbar-width: none;
        }

        .categories::-webkit-scrollbar {
            display: none;
        }

        .category {
            min-width: 76px;
            text-align: center;
        }

        .category-image {
            width: 70px;
            height: 70px;
            margin: auto;
            border-radius: 20px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid #edf0eb;
        }

        .category-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .category-name {
            margin-top: 7px;
            font-size: 10px;
            font-weight: 700;
            color: #39433b;
        }

        /* =========================
           OFFER CARD
        ========================== */

        .offer-card {
            background: #fff3e9;
            border: 1px solid #ffe2cf;
            border-radius: 20px;
            padding: 17px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
            position: relative;
        }

        .offer-content {
            position: relative;
            z-index: 2;
        }

        .offer-small {
            font-size: 10px;
            color: #d85d0b;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .offer-title {
            font-size: 18px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 5px;
        }

        .offer-desc {
            font-size: 10px;
            color: #737873;
            margin-bottom: 11px;
        }

        .offer-btn {
            background: #f97316;
            color: #fff;
            padding: 9px 13px;
            border-radius: 9px;
            font-size: 10px;
            font-weight: 800;
        }

        .offer-image {
            width: 125px;
            height: 125px;
            margin-right: -15px;
            margin-bottom: -10px;
        }

        .offer-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .product-card {
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #edf0eb;
            position: relative;
        }

        .product-image {
            height: 145px;
            position: relative;
            background: #f0f2ee;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .discount {
            position: absolute;
            top: 9px;
            left: 9px;
            background: #14532d;
            color: #fff;
            font-size: 8px;
            font-weight: 800;
            padding: 5px 7px;
            border-radius: 7px;
        }

        .heart {
            position: absolute;
            right: 9px;
            top: 9px;
            width: 29px;
            height: 29px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .95);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .product-info {
            padding: 12px;
        }

        .product-name {
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .product-weight {
            color: #7a817b;
            font-size: 9px;
            margin-bottom: 9px;
        }

        .product-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .price {
            font-size: 15px;
            font-weight: 800;
            color: #14532d;
        }

        .old-price {
            font-size: 9px;
            color: #9da39e;
            text-decoration: line-through;
            margin-left: 3px;
        }

        .add-btn {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: #14532d;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
        }

        /* =========================
           WHY US
        ========================== */

        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 9px;
        }

        .feature {
            background: #fff;
            border: 1px solid #edf0eb;
            border-radius: 16px;
            padding: 13px 7px;
            text-align: center;
        }

        .feature-icon {
            font-size: 22px;
            margin-bottom: 7px;
        }

        .feature-title {
            font-size: 9px;
            font-weight: 800;
        }

        .feature-text {
            font-size: 7px;
            color: #858c86;
            margin-top: 3px;
            line-height: 1.4;
        }

        /* =========================
           BOTTOM NAVIGATION
        ========================== */

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 390px;
            height: 72px;
            background: rgba(255, 255, 255, .96);
            backdrop-filter: blur(15px);
            border-top: 1px solid #e8ece7;
            display: flex;
            align-items: center;
            justify-content: space-around;
            z-index: 100;
            padding: 5px 8px;
        }

        .nav-item {
            text-decoration: none;
            color: #909790;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            min-width: 55px;
            height: 60px;
            position: relative;
        }

        .nav-icon {
            font-size: 19px;
        }

        .nav-label {
            font-size: 8px;
            font-weight: 700;
        }

        .nav-item.active {
            color: #14532d;
        }

        .nav-item.active::before {
            content: "";
            position: absolute;
            top: 2px;
            width: 25px;
            height: 3px;
            background: #14532d;
            border-radius: 10px;
        }

        .cart-wrapper {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -7px;
            right: -9px;
            min-width: 16px;
            height: 16px;
            padding: 0 4px;
            background: #f97316;
            color: #fff;
            border-radius: 20px;
            font-size: 8px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* =========================
           DESKTOP
        ========================== */

        @media (min-width: 600px) {
            body {
                padding: 20px 0;
            }

            .app {
                min-height: calc(100vh - 40px);
                border-radius: 25px;
                box-shadow: 0 10px 50px rgba(20, 83, 45, .08);
            }

            .bottom-nav {
                border-radius: 20px 20px 0 0;
                width: 390px;
                border: 1px solid #e5e9e3;
            }
        }
    </style>
</head>

<body>

    <main class="app">

        <header class="header">

            <div class="header-top">

                <div class="location">

                    <div class="location-icon">
                        📍
                    </div>

                    <div class="location-text">
                        <small>Deliver to</small>
                        <strong>Your Location ▾</strong>
                    </div>

                </div>

                <div class="header-actions">

                    <button class="header-btn">
                        🔔
                        <span class="notification-dot"></span>
                    </button>

                    <button class="header-btn">
                        👤
                    </button>

                </div>

            </div>

            <div class="search-box">
                <span>⌕</span>
                <input type="text" placeholder="Search chicken, fish, mutton...">
            </div>

        </header>


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

                    <button class="hero-btn">
                        Shop Now
                        <span>→</span>
                    </button>

                </div>

            </div>

        </section>


        <section class="section">

            <div class="section-header">
                <h2 class="section-title">
                    Shop by Category
                </h2>

                <a href="#" class="view-all">
                    View All
                </a>
            </div>


            <div class="categories">

                <div class="category">

                    <div class="category-image">
                        <img src="https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&w=300&q=80"
                            alt="Chicken">
                    </div>

                    <div class="category-name">
                        Chicken
                    </div>

                </div>


                <div class="category">

                    <div class="category-image">
                        <img src="https://images.unsplash.com/photo-1544943910-4c1dc44aab44?auto=format&fit=crop&w=300&q=80"
                            alt="Fish">
                    </div>

                    <div class="category-name">
                        Fish
                    </div>

                </div>


                <div class="category">

                    <div class="category-image">
                        <img src="https://images.unsplash.com/photo-1529692236671-f1f6cf9683ba?auto=format&fit=crop&w=300&q=80"
                            alt="Mutton">
                    </div>

                    <div class="category-name">
                        Mutton
                    </div>

                </div>


                <div class="category">

                    <div class="category-image">
                        <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&w=300&q=80"
                            alt="Prawns">
                    </div>

                    <div class="category-name">
                        Prawns
                    </div>

                </div>


                <div class="category">

                    <div class="category-image">
                        <img src="https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?auto=format&fit=crop&w=300&q=80"
                            alt="Liver">
                    </div>

                    <div class="category-name">
                        Liver
                    </div>

                </div>

            </div>

        </section>


        <section class="section">

            <div class="offer-card">

                <div class="offer-content">

                    <div class="offer-small">
                        WEEKEND SPECIAL
                    </div>

                    <div class="offer-title">
                        Get 20% OFF
                    </div>

                    <div class="offer-desc">
                        On your first non-veg order
                    </div>

                    <button class="offer-btn">
                        ORDER NOW
                    </button>

                </div>

                <div class="offer-image">

                    <img src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=400&q=80"
                        alt="Offer">

                </div>

            </div>

        </section>

        <section class="section">

            <div class="section-header">

                <h2 class="section-title">
                    Best Sellers 🔥
                </h2>

                <a href="#" class="view-all">
                    See All
                </a>

            </div>


            <div class="products">

                <div class="product-card">

                    <div class="product-image">

                        <img src="https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&w=600&q=85"
                            alt="Chicken">

                        <span class="discount">
                            12% OFF
                        </span>

                        <button class="heart">
                            ♡
                        </button>

                    </div>

                    <div class="product-info">

                        <div class="product-name">
                            Fresh Chicken Curry Cut
                        </div>

                        <div class="product-weight">
                            500 g • Cleaned
                        </div>

                        <div class="product-bottom">

                            <div>
                                <span class="price">
                                    ₹149
                                </span>

                                <span class="old-price">
                                    ₹169
                                </span>
                            </div>

                            <button class="add-btn">
                                +
                            </button>

                        </div>

                    </div>

                </div>


                <div class="product-card">

                    <div class="product-image">

                        <img src="https://images.unsplash.com/photo-1529692236671-f1f6cf9683ba?auto=format&fit=crop&w=600&q=85"
                            alt="Mutton">

                        <span class="discount">
                            10% OFF
                        </span>

                        <button class="heart">
                            ♡
                        </button>

                    </div>

                    <div class="product-info">

                        <div class="product-name">
                            Premium Mutton
                        </div>

                        <div class="product-weight">
                            500 g • Fresh Cut
                        </div>

                        <div class="product-bottom">

                            <div>
                                <span class="price">
                                    ₹399
                                </span>

                                <span class="old-price">
                                    ₹449
                                </span>
                            </div>

                            <button class="add-btn">
                                +
                            </button>

                        </div>

                    </div>

                </div>

                <div class="product-card">

                    <div class="product-image">

                        <img src="https://images.unsplash.com/photo-1544943910-4c1dc44aab44?auto=format&fit=crop&w=600&q=85"
                            alt="Fish">

                        <span class="discount">
                            15% OFF
                        </span>

                        <button class="heart">
                            ♡
                        </button>

                    </div>

                    <div class="product-info">

                        <div class="product-name">
                            Fresh Rohu Fish
                        </div>

                        <div class="product-weight">
                            1 kg • Cleaned
                        </div>

                        <div class="product-bottom">

                            <div>
                                <span class="price">
                                    ₹249
                                </span>

                                <span class="old-price">
                                    ₹299
                                </span>
                            </div>

                            <button class="add-btn">
                                +
                            </button>

                        </div>

                    </div>

                </div>


                <div class="product-card">

                    <div class="product-image">

                        <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&w=600&q=85"
                            alt="Prawns">

                        <span class="discount">
                            8% OFF
                        </span>

                        <button class="heart">
                            ♡
                        </button>

                    </div>

                    <div class="product-info">

                        <div class="product-name">
                            Fresh Prawns
                        </div>

                        <div class="product-weight">
                            500 g • Cleaned
                        </div>

                        <div class="product-bottom">

                            <div>
                                <span class="price">
                                    ₹329
                                </span>

                                <span class="old-price">
                                    ₹359
                                </span>
                            </div>

                            <button class="add-btn">
                                +
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </section>

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

                    <div class="feature-title">
                        Fresh Meat
                    </div>

                    <div class="feature-text">
                        Freshly prepared
                    </div>

                </div>


                <div class="feature">

                    <div class="feature-icon">
                        🚚
                    </div>

                    <div class="feature-title">
                        Fast Delivery
                    </div>

                    <div class="feature-text">
                        Within your area
                    </div>

                </div>


                <div class="feature">

                    <div class="feature-icon">
                        🛡️
                    </div>

                    <div class="feature-title">
                        Hygienic
                    </div>

                    <div class="feature-text">
                        Safe & clean
                    </div>

                </div>

            </div>

        </section>

    </main>


    <nav class="bottom-nav">

        <a href="{{ url('/') }}" class="nav-item active">

            <span class="nav-icon">
                ⌂
            </span>

            <span class="nav-label">
                Home
            </span>

        </a>


        <a href="#" class="nav-item">

            <span class="nav-icon">
                ⌕
            </span>

            <span class="nav-label">
                Explore
            </span>

        </a>


        <a href="#" class="nav-item">

            <span class="cart-wrapper">

                <span class="nav-icon">
                    🛒
                </span>

                <span class="cart-count">
                    2
                </span>

            </span>

            <span class="nav-label">
                Cart
            </span>

        </a>


        <a href="#" class="nav-item">

            <span class="nav-icon">
                📦
            </span>

            <span class="nav-label">
                Orders
            </span>

        </a>


        <a href="#" class="nav-item">

            <span class="nav-icon">
                👤
            </span>

            <span class="nav-label">
                Account
            </span>

        </a>

    </nav>


</body>

</html>