@extends('frontend.layouts.app')

@section('title', 'About Us - Nonveg Mart')

@section('content')

<div class="about-page">

    {{-- Hero --}}
    <section class="about-hero">
        <div class="about-hero-content">
            <span class="about-badge">
                Freshness You Can Trust
            </span>

            <h1>
                Fresh Food.<br>
                <span>Delivered Fresh.</span>
            </h1>

            <p>
                Welcome to <strong>Nonveg Mart</strong> — your trusted destination
                for fresh meat, seafood, groceries and everyday essentials,
                delivered conveniently to your doorstep.
            </p>

            <a href="{{ url('/') }}" class="about-btn">
                Shop Fresh Products
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="about-hero-image">
            <div class="hero-image-circle">
                <img src="{{ asset('images/about-meat.png') }}"
                     alt="Fresh meat and food">
            </div>

            <div class="fresh-card">
                <i class="fa-solid fa-circle-check"></i>
                <div>
                    <strong>Fresh & Quality</strong>
                    <small>Carefully selected for you</small>
                </div>
            </div>
        </div>
    </section>


    {{-- Introduction --}}
    <section class="about-intro">
        <div class="section-label">
            <span></span>
            ABOUT NONVEG MART
        </div>

        <h2>
            Your everyday food,<br>
            <span>made simple.</span>
        </h2>

        <p>
            At Nonveg Mart, we believe buying fresh food should be simple,
            convenient and trustworthy. That's why we bring quality meat,
            seafood, groceries and essential products together in one easy-to-use
            platform.
        </p>

        <p>
            From selecting your favourite cuts to getting them delivered to
            your doorstep, we focus on making every step smooth, reliable and
            hassle-free.
        </p>
    </section>


    {{-- Features --}}
    <section class="about-features">

        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-drumstick-bite"></i>
            </div>

            <h3>Fresh Products</h3>

            <p>
                We focus on providing fresh and carefully selected meat,
                seafood and food products.
            </p>
        </div>


        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-shield-heart"></i>
            </div>

            <h3>Quality First</h3>

            <p>
                Quality matters to us. We work to maintain high standards
                from selection to delivery.
            </p>
        </div>


        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-truck-fast"></i>
            </div>

            <h3>Fast Delivery</h3>

            <p>
                Get your order delivered conveniently to your doorstep
                without unnecessary waiting.
            </p>
        </div>


        <div class="feature-card">
            <div class="feature-icon">
                <i class="fa-solid fa-heart"></i>
            </div>

            <h3>Made for You</h3>

            <p>
                Everything we do is designed around making your everyday
                shopping easier and better.
            </p>
        </div>

    </section>


    {{-- Why Us --}}
    <section class="why-section">

        <div class="why-image">
            <img src="{{ asset('images/about-fresh-food.png') }}"
                 alt="Fresh food from Nonveg Mart">
        </div>

        <div class="why-content">

            <div class="section-label">
                <span></span>
                WHY NONVEG MART
            </div>

            <h2>
                More than just<br>
                <span>a grocery delivery app.</span>
            </h2>

            <p>
                We are building Nonveg Mart with one simple idea:
                make fresh food shopping easier for everyone.
            </p>

            <div class="why-list">

                <div class="why-item">
                    <div class="why-check">
                        <i class="fa-solid fa-check"></i>
                    </div>

                    <div>
                        <strong>Freshness you can feel</strong>
                        <p>
                            Fresh products selected with care.
                        </p>
                    </div>
                </div>


                <div class="why-item">
                    <div class="why-check">
                        <i class="fa-solid fa-check"></i>
                    </div>

                    <div>
                        <strong>Simple online shopping</strong>
                        <p>
                            Browse, order and track everything easily.
                        </p>
                    </div>
                </div>


                <div class="why-item">
                    <div class="why-check">
                        <i class="fa-solid fa-check"></i>
                    </div>

                    <div>
                        <strong>Convenient doorstep delivery</strong>
                        <p>
                            Your order reaches you where you need it.
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </section>


    {{-- Mission --}}
    <section class="mission-section">

        <div class="mission-content">

            <span class="mission-label">
                OUR MISSION
            </span>

            <h2>
                Making fresh food<br>
                <span>easier for everyone.</span>
            </h2>

            <p>
                Our mission is to create a reliable and convenient food
                shopping experience where customers can discover fresh
                products, order with confidence and receive them at their
                doorstep.
            </p>

        </div>

    </section>


    {{-- CTA --}}
    <section class="about-cta">

        <div>
            <span>READY TO ORDER?</span>

            <h2>
                Freshness is just<br>
                a few clicks away.
            </h2>

            <p>
                Explore our products and order your favourites today.
            </p>

            <a href="{{ url('/') }}" class="cta-btn">
                Start Shopping
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

    </section>

    @include('frontend.components.bottom-nav')

</div>


<style>

    .about-page {
        background: #f7f8f5;
        color: #172018;
        font-family: 'Plus Jakarta Sans', sans-serif;
        overflow: hidden;
    }


    /* HERO */

    .about-hero {
        max-width: 1180px;
        margin: auto;
        padding: 70px 25px 80px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 50px;
    }

    .about-badge {
        display: inline-flex;
        padding: 9px 15px;
        border-radius: 50px;
        background: #e8f2e8;
        color: #176b38;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .about-hero h1 {
        font-size: 58px;
        line-height: 1.05;
        margin: 0 0 22px;
        letter-spacing: -2px;
        font-weight: 800;
    }

    .about-hero h1 span {
        color: #176b38;
    }

    .about-hero p {
        max-width: 540px;
        color: #667066;
        line-height: 1.8;
        font-size: 15px;
        margin-bottom: 30px;
    }

    .about-btn,
    .cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: #176b38;
        color: #fff;
        padding: 14px 21px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: .2s ease;
    }

    .about-btn:hover,
    .cta-btn:hover {
        background: #0f512a;
        color: #fff;
        transform: translateY(-2px);
    }


    .about-hero-image {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hero-image-circle {
        width: 410px;
        height: 410px;
        border-radius: 50%;
        background: #e8efe6;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .hero-image-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .fresh-card {
        position: absolute;
        left: 5px;
        bottom: 25px;
        background: #fff;
        border-radius: 15px;
        padding: 13px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 35px rgba(0,0,0,.10);
    }

    .fresh-card i {
        color: #176b38;
        font-size: 23px;
    }

    .fresh-card strong {
        display: block;
        font-size: 12px;
    }

    .fresh-card small {
        display: block;
        margin-top: 3px;
        color: #858c85;
        font-size: 10px;
    }


    /* INTRO */

    .about-intro {
        max-width: 800px;
        margin: auto;
        padding: 75px 25px;
        text-align: center;
    }

    .section-label {
        color: #176b38;
        font-size: 11px;
        letter-spacing: 1.5px;
        font-weight: 800;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-bottom: 15px;
    }

    .section-label span {
        width: 25px;
        height: 2px;
        background: #e57c23;
    }

    .about-intro h2,
    .why-content h2 {
        font-size: 40px;
        line-height: 1.15;
        letter-spacing: -1px;
        margin: 0 0 20px;
    }

    .about-intro h2 span,
    .why-content h2 span {
        color: #176b38;
    }

    .about-intro p {
        color: #687068;
        line-height: 1.8;
        font-size: 14px;
        margin: 10px auto;
        max-width: 700px;
    }


    /* FEATURES */

    .about-features {
        max-width: 1100px;
        margin: auto;
        padding: 30px 25px 90px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
    }

    .feature-card {
        background: #fff;
        padding: 27px 22px;
        border-radius: 18px;
        border: 1px solid #edf0eb;
    }

    .feature-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: #edf5ec;
        color: #176b38;
        font-size: 19px;
        margin-bottom: 18px;
    }

    .feature-card:nth-child(even) .feature-icon {
        background: #fff0e4;
        color: #e57c23;
    }

    .feature-card h3 {
        font-size: 15px;
        margin: 0 0 10px;
    }

    .feature-card p {
        color: #788078;
        line-height: 1.7;
        font-size: 12px;
        margin: 0;
    }


    /* WHY */

    .why-section {
        max-width: 1100px;
        margin: auto;
        padding: 30px 25px 100px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 70px;
        align-items: center;
    }

    .why-image {
        height: 500px;
        border-radius: 25px;
        overflow: hidden;
    }

    .why-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .why-content .section-label {
        justify-content: flex-start;
    }

    .why-content > p {
        color: #707870;
        line-height: 1.8;
        font-size: 14px;
        margin-bottom: 30px;
    }

    .why-item {
        display: flex;
        gap: 13px;
        margin-bottom: 20px;
    }

    .why-check {
        width: 27px;
        height: 27px;
        min-width: 27px;
        border-radius: 50%;
        background: #e8f2e8;
        color: #176b38;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
    }

    .why-item strong {
        font-size: 13px;
    }

    .why-item p {
        margin: 5px 0 0;
        color: #7b827b;
        font-size: 11px;
    }


    /* MISSION */

    .mission-section {
        background: #176b38;
        color: #fff;
        padding: 85px 25px;
        text-align: center;
    }

    .mission-content {
        max-width: 700px;
        margin: auto;
    }

    .mission-label {
        color: #f7b06b;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .mission-section h2 {
        font-size: 42px;
        line-height: 1.15;
        margin: 15px 0;
        letter-spacing: -1px;
    }

    .mission-section h2 span {
        color: #ffd09e;
    }

    .mission-section p {
        color: rgba(255,255,255,.78);
        font-size: 14px;
        line-height: 1.8;
        max-width: 600px;
        margin: auto;
    }


    /* CTA */

    .about-cta {
        max-width: 1100px;
        margin: 70px auto;
        padding: 65px 50px;
        border-radius: 25px;
        background: #fff1e5;
        text-align: center;
    }

    .about-cta span {
        color: #e57c23;
        font-size: 10px;
        letter-spacing: 2px;
        font-weight: 800;
    }

    .about-cta h2 {
        font-size: 38px;
        line-height: 1.15;
        margin: 12px 0;
        letter-spacing: -1px;
    }

    .about-cta p {
        color: #737873;
        font-size: 13px;
        margin-bottom: 25px;
    }


    /* MOBILE */

    @media (max-width: 768px) {

        .about-hero {
            grid-template-columns: 1fr;
            padding: 45px 20px 60px;
            text-align: center;
            gap: 35px;
        }

        .about-hero h1 {
            font-size: 40px;
        }

        .about-hero p {
            font-size: 13px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-image-circle {
            width: 290px;
            height: 290px;
        }

        .fresh-card {
            left: 10px;
            bottom: 10px;
        }

        .about-intro {
            padding: 55px 20px;
        }

        .about-intro h2,
        .why-content h2 {
            font-size: 30px;
        }

        .about-features {
            grid-template-columns: 1fr 1fr;
            padding: 20px;
        }

        .feature-card {
            padding: 20px 16px;
        }

        .why-section {
            grid-template-columns: 1fr;
            padding: 30px 20px 70px;
            gap: 40px;
        }

        .why-image {
            height: 350px;
        }

        .mission-section {
            padding: 65px 20px;
        }

        .mission-section h2 {
            font-size: 31px;
        }

        .about-cta {
            margin: 40px 15px;
            padding: 45px 20px;
        }

        .about-cta h2 {
            font-size: 30px;
        }
    }


    @media (max-width: 420px) {

        .about-hero h1 {
            font-size: 36px;
        }

        .about-features {
            grid-template-columns: 1fr;
        }

        .hero-image-circle {
            width: 260px;
            height: 260px;
        }

        .about-cta {
            border-radius: 20px;
        }
    }

</style>

@endsection

