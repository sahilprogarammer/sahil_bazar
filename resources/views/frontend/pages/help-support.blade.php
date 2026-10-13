@extends('frontend.layouts.app')

@section('title', 'Help & Support - Nonveg Mart')

@section('content')

<div class="nm-support">

    {{-- Header --}}
    <section class="support-header">

        <div class="support-top">
            <a href="{{ url()->previous() }}" class="support-back">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <span>Help & Support</span>

            <div class="support-top-icon">
                <i class="fa-regular fa-circle-question"></i>
            </div>
        </div>

        <div class="support-welcome">
            <span class="support-label">
                WE'RE HERE TO HELP
            </span>

            <h1>
                How can we<br>
                <span>help you?</span>
            </h1>

            <p>
                Find answers quickly or get in touch with our support team.
            </p>
        </div>

        {{-- Search --}}
        <div class="support-search">
            <i class="fa-solid fa-magnifying-glass"></i>

            <input type="text"
                   id="supportSearch"
                   placeholder="Search your question...">

        </div>

    </section>


    {{-- Quick Help --}}
    <section class="support-section">

        <div class="support-section-title">
            <h2>Quick help</h2>
            <span>Common topics</span>
        </div>


        <div class="help-list">

            <a href="#orders" class="help-item">

                <div class="help-icon green">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>

                <div class="help-text">
                    <strong>My Orders</strong>
                    <span>Track, cancel or manage your order</span>
                </div>

                <i class="fa-solid fa-chevron-right help-arrow"></i>

            </a>


            <a href="#delivery" class="help-item">

                <div class="help-icon orange">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>

                <div class="help-text">
                    <strong>Delivery</strong>
                    <span>Delivery time, charges and tracking</span>
                </div>

                <i class="fa-solid fa-chevron-right help-arrow"></i>

            </a>


            <a href="#payment" class="help-item">

                <div class="help-icon blue">
                    <i class="fa-solid fa-credit-card"></i>
                </div>

                <div class="help-text">
                    <strong>Payments</strong>
                    <span>Payment issues, refunds and COD</span>
                </div>

                <i class="fa-solid fa-chevron-right help-arrow"></i>

            </a>


            <a href="#account" class="help-item">

                <div class="help-icon purple">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="help-text">
                    <strong>Account & Address</strong>
                    <span>Manage your profile and saved addresses</span>
                </div>

                <i class="fa-solid fa-chevron-right help-arrow"></i>

            </a>

        </div>

    </section>


    {{-- FAQ --}}
    <section class="support-section faq-section">

        <div class="support-section-title">
            <h2>Frequently asked</h2>
            <span>Quick answers</span>
        </div>


        <div class="faq-list">

            <div class="faq-item">

                <button class="faq-question">
                    <span>How can I track my order?</span>
                    <i class="fa-solid fa-plus"></i>
                </button>

                <div class="faq-answer">
                    You can track your order from the
                    <strong>My Orders</strong> section after placing your order.
                </div>

            </div>


            <div class="faq-item">

                <button class="faq-question">
                    <span>How long does delivery take?</span>
                    <i class="fa-solid fa-plus"></i>
                </button>

                <div class="faq-answer">
                    Delivery time depends on your location and order.
                    You can see the estimated delivery time during checkout.
                </div>

            </div>


            <div class="faq-item">

                <button class="faq-question">
                    <span>Can I cancel my order?</span>
                    <i class="fa-solid fa-plus"></i>
                </button>

                <div class="faq-answer">
                    Orders can be cancelled depending on their current
                    preparation or delivery status.
                </div>

            </div>


            <div class="faq-item">

                <button class="faq-question">
                    <span>What payment methods are available?</span>
                    <i class="fa-solid fa-plus"></i>
                </button>

                <div class="faq-answer">
                    We support available online payment options and
                    Cash on Delivery where applicable.
                </div>

            </div>


            <div class="faq-item">

                <button class="faq-question">
                    <span>What if I receive the wrong item?</span>
                    <i class="fa-solid fa-plus"></i>
                </button>

                <div class="faq-answer">
                    Please contact our support team as soon as possible
                    with your order details so we can help resolve the issue.
                </div>

            </div>

        </div>

    </section>


    {{-- Contact Support --}}
    <section class="contact-support">

        <div class="contact-icon">
            <i class="fa-solid fa-headset"></i>
        </div>

        <span>NEED MORE HELP?</span>

        <h2>
            Talk to our<br>
            support team.
        </h2>

        <p>
            We're happy to help with your order or any other questions.
        </p>

        <div class="support-actions">

            <a href="tel:+919999999999" class="support-action call">
                <i class="fa-solid fa-phone"></i>
                <span>Call Us</span>
            </a>

            <a href="mailto:support@nonvegmart.com"
               class="support-action email">
                <i class="fa-regular fa-envelope"></i>
                <span>Email Us</span>
            </a>

        </div>

    </section>


    {{-- Bottom --}}
    <div class="support-footer">
        <i class="fa-solid fa-heart"></i>
        <span>Thank you for choosing Nonveg Mart</span>
    </div>

</div>


<style>

/*
|--------------------------------------------------------------------------
| NONVEG MART — MOBILE HELP & SUPPORT
|--------------------------------------------------------------------------
*/

.nm-support {
    width: 100%;
    max-width: 430px;
    margin: 0 auto;
    min-height: 100vh;
    background: #f7f8f5;
    color: #172018;
    font-family: 'Plus Jakarta Sans', sans-serif;
    overflow: hidden;
}


/* HEADER */

.support-header {
    padding: 18px 20px 28px;
    background: #176b38;
    color: #fff;
    border-radius: 0 0 28px 28px;
}

.support-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.support-top > span {
    font-size: 13px;
    font-weight: 700;
}

.support-back,
.support-top-icon {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: rgba(255,255,255,.12);
    color: #fff;
    text-decoration: none;
}

.support-back {
    font-size: 12px;
}

.support-top-icon {
    font-size: 14px;
}

.support-welcome {
    padding: 30px 2px 20px;
}

.support-label {
    color: #b9dfbd;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.support-welcome h1 {
    font-size: 32px;
    line-height: 1.1;
    letter-spacing: -1px;
    margin: 10px 0 10px;
}

.support-welcome h1 span {
    color: #ffd09e;
}

.support-welcome p {
    margin: 0;
    max-width: 320px;
    color: rgba(255,255,255,.72);
    font-size: 11px;
    line-height: 1.7;
}


/* SEARCH */

.support-search {
    height: 48px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 15px;
    border-radius: 13px;
    background: #fff;
    color: #8b938c;
    box-shadow: 0 8px 25px rgba(0,0,0,.08);
}

.support-search i {
    font-size: 13px;
}

.support-search input {
    flex: 1;
    width: 100%;
    border: 0;
    outline: 0;
    background: transparent;
    font-family: inherit;
    font-size: 11px;
    color: #172018;
}

.support-search input::placeholder {
    color: #a2a8a2;
}


/* SECTIONS */

.support-section {
    padding: 30px 20px 5px;
}

.support-section-title {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 14px;
}

.support-section-title h2 {
    margin: 0;
    font-size: 17px;
    letter-spacing: -.3px;
}

.support-section-title span {
    color: #909790;
    font-size: 9px;
}


/* HELP LIST */

.help-list {
    background: #fff;
    border-radius: 18px;
    padding: 5px 15px;
    border: 1px solid #edf0eb;
}

.help-item {
    min-height: 67px;
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    color: #172018;
    border-bottom: 1px solid #f0f2ef;
}

.help-item:last-child {
    border-bottom: 0;
}

.help-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    font-size: 14px;
}

.help-icon.green {
    background: #e8f3e9;
    color: #176b38;
}

.help-icon.orange {
    background: #fff0e3;
    color: #e57c23;
}

.help-icon.blue {
    background: #eaf2ff;
    color: #3975d8;
}

.help-icon.purple {
    background: #f1eaff;
    color: #7955c7;
}

.help-text {
    flex: 1;
}

.help-text strong {
    display: block;
    font-size: 11px;
    margin-bottom: 4px;
}

.help-text span {
    display: block;
    color: #8a918a;
    font-size: 9px;
}

.help-arrow {
    color: #aeb4ae;
    font-size: 9px;
}


/* FAQ */

.faq-section {
    padding-top: 35px;
}

.faq-list {
    background: #fff;
    border-radius: 18px;
    padding: 0 15px;
    border: 1px solid #edf0eb;
}

.faq-item {
    border-bottom: 1px solid #edf0eb;
}

.faq-item:last-child {
    border-bottom: 0;
}

.faq-question {
    width: 100%;
    min-height: 57px;
    border: 0;
    background: transparent;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 0;
    text-align: left;
    color: #172018;
    font-family: inherit;
    cursor: pointer;
}

.faq-question span {
    font-size: 11px;
    font-weight: 600;
}

.faq-question i {
    color: #176b38;
    font-size: 10px;
    transition: transform .2s ease;
}

.faq-answer {
    display: none;
    padding: 0 5px 16px 0;
    color: #7d847d;
    font-size: 10px;
    line-height: 1.7;
}

.faq-item.active .faq-answer {
    display: block;
}

.faq-item.active .faq-question i {
    transform: rotate(45deg);
}


/* CONTACT */

.contact-support {
    margin: 35px 15px 20px;
    padding: 35px 20px;
    border-radius: 23px;
    background: #fff0e3;
    text-align: center;
}

.contact-icon {
    width: 45px;
    height: 45px;
    margin: 0 auto 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    color: #e57c23;
    border-radius: 14px;
    font-size: 17px;
}

.contact-support > span {
    color: #e57c23;
    font-size: 8px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.contact-support h2 {
    margin: 9px 0;
    font-size: 25px;
    line-height: 1.15;
    letter-spacing: -.7px;
}

.contact-support p {
    color: #7d817d;
    font-size: 10px;
    line-height: 1.6;
    margin: 0 auto 20px;
    max-width: 270px;
}


/* ACTIONS */

.support-actions {
    display: flex;
    gap: 9px;
}

.support-action {
    flex: 1;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    border-radius: 11px;
    text-decoration: none;
    font-size: 10px;
    font-weight: 700;
}

.support-action.call {
    background: #176b38;
    color: #fff;
}

.support-action.email {
    background: #fff;
    color: #172018;
    border: 1px solid #e8ebe7;
}

.support-action i {
    font-size: 10px;
}


/* FOOTER */

.support-footer {
    padding: 20px 20px 40px;
    text-align: center;
    color: #a1a7a1;
    font-size: 9px;
}

.support-footer i {
    color: #e57c23;
    margin-right: 4px;
}


/* SEARCH FILTER */

.help-item.hidden {
    display: none;
}

</style>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /* FAQ */

    document.querySelectorAll('.faq-question').forEach(function (button) {

        button.addEventListener('click', function () {

            const item = this.closest('.faq-item');

            document.querySelectorAll('.faq-item').forEach(function (faq) {
                if (faq !== item) {
                    faq.classList.remove('active');
                }
            });

            item.classList.toggle('active');

        });

    });


    /* SEARCH */

    const searchInput = document.getElementById('supportSearch');

    if (searchInput) {

        searchInput.addEventListener('input', function () {

            const value = this.value.toLowerCase().trim();

            document.querySelectorAll('.help-item').forEach(function (item) {

                const text = item.innerText.toLowerCase();

                if (text.includes(value)) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }

            });

        });

    }

});

</script>

@endsection

