@extends('frontend.layouts.app')

@section('title', 'Order Placed Successfully - Nonveg Bazar')

@section('content')

<style>
    .success-page {
        min-height: calc(100vh - 70px);
        background: #f7f8f5;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 18px 110px;
    }

    .success-card {
        width: 100%;
        max-width: 430px;
        text-align: center;
        background: #ffffff;
        border-radius: 28px;
        padding: 42px 22px 28px;
        box-shadow: 0 12px 40px rgba(23, 32, 24, 0.08);
        animation: successCardIn .55s ease;
    }

    .success-icon-wrap {
        width: 92px;
        height: 92px;
        margin: 0 auto 24px;
        border-radius: 50%;
        background: #e9f8ef;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        animation: iconPop .65s cubic-bezier(.17,.67,.35,1.35);
    }

    .success-icon {
        width: 66px;
        height: 66px;
        border-radius: 50%;
        background: #176b3a;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 31px;
    }

    .success-title {
        margin: 0;
        color: #172018;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .success-subtitle {
        margin: 12px auto 0;
        max-width: 330px;
        color: #6d756e;
        font-size: 14px;
        line-height: 1.6;
    }

    .delivery-box {
        margin-top: 26px;
        padding: 16px;
        border-radius: 18px;
        background: #f7f8f5;
        display: flex;
        align-items: center;
        gap: 13px;
        text-align: left;
    }

    .delivery-icon {
        width: 44px;
        height: 44px;
        flex: 0 0 44px;
        border-radius: 13px;
        background: #fff1e8;
        color: #f27b35;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .delivery-text strong {
        display: block;
        color: #172018;
        font-size: 14px;
        margin-bottom: 3px;
    }

    .delivery-text span {
        color: #737a74;
        font-size: 12px;
    }

    .success-actions {
        margin-top: 28px;
    }

    .home-btn {
        width: 100%;
        border: 0;
        border-radius: 15px;
        padding: 15px 20px;
        background: #176b3a;
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        transition: transform .2s ease, box-shadow .2s ease;
        box-shadow: 0 8px 20px rgba(23, 107, 58, .18);
    }

    .home-btn:active {
        transform: scale(.97);
    }

    .continue-text {
        display: block;
        margin-top: 15px;
        color: #8a918b;
        font-size: 12px;
    }

    @keyframes successCardIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes iconPop {
        0% {
            opacity: 0;
            transform: scale(.5);
        }

        70% {
            transform: scale(1.08);
        }

        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @media (min-width: 600px) {
        .success-page {
            min-height: 100vh;
        }

        .success-card {
            padding: 50px 30px 32px;
        }
    }
</style>

<div class="success-page">

    <div class="success-card">

        <div class="success-icon-wrap">
            <div class="success-icon">
                <i class="fa-solid fa-check"></i>
            </div>
        </div>

        <h1 class="success-title">
            Order Placed!
        </h1>

        <p class="success-subtitle">
            Your order has been successfully placed.
            We're preparing your fresh items with care.
        </p>

        <div class="delivery-box">

            <div class="delivery-icon">
                <i class="fa-solid fa-truck"></i>
            </div>

            <div class="delivery-text">
                <strong>Delivery in 30–45 mins</strong>
                <span>
                    Freshly packed and delivered to your doorstep.
                </span>
            </div>

        </div>

        <div class="success-actions">

            <a href="{{ route('home') }}" class="home-btn">
                <i class="fa-solid fa-house"></i>
                Go to Home
            </a>

            <span class="continue-text">
                Thank you for choosing Nonveg Bazar ❤️
            </span>

        </div>

    </div>

</div>

@endsection

