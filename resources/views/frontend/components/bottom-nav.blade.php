<style>
    /* =====================================================
   DEMO CONTENT
===================================================== */

    .page-content {
        width: 100%;
        max-width: 430px;
        margin: auto;
        padding: 25px 18px;
    }

    .demo-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .demo-card h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .demo-card p {
        font-size: 14px;
        color: #777;
        line-height: 1.6;
    }


    /* =====================================================
   BOTTOM NAVIGATION
===================================================== */

    .bottom-nav {
        position: fixed;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        width: 100%;
        max-width: 430px;
        height: 70px;
        background: #ffffff;
        border-top: 1px solid #e8ebe5;
        display: flex;
        align-items: center;
        justify-content: space-around;
        z-index: 9000;
        padding: 5px 4px calc(5px + env(safe-area-inset-bottom));
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.06);
    }

    .nav-item {
        flex: 1;
        height: 58px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        border: 0;
        background: transparent;
        text-decoration: none;
        color: #8b918a;
        cursor: pointer;
        font-family: inherit;
        -webkit-tap-highlight-color: transparent;
        transition: color 0.2s ease, transform 0.2s ease;
    }

    .nav-item:active {
        transform: scale(0.92);
    }

    .nav-icon {
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        line-height: 1;
    }

    .nav-label {
        font-size: 10px;
        font-weight: 600;
        line-height: 1;
    }

    .nav-item.active {
        color: #146b2f;
    }

    .nav-item.active .nav-icon {
        transform: translateY(-1px);
    }


    /* =====================================================
   CART
===================================================== */

    .cart-wrapper {
        position: relative;
        width: 28px;
        height: 27px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-count {
        position: absolute;
        top: -5px;
        right: -7px;
        min-width: 17px;
        height: 17px;
        padding: 0 4px;
        border-radius: 50px;
        background: #f47c20;
        color: #ffffff;
        font-size: 9px;
        font-weight: 700;
        display: none;
        align-items: center;
        justify-content: center;
        border: 2px solid #ffffff;
    }


    /* =====================================================
   MENU ROOT
   Keeps overlay + drawer INSIDE the 430px app frame
===================================================== */

    .menu-root {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        max-width: 430px;
        overflow: hidden;
        z-index: 9998;

        visibility: hidden;
        pointer-events: none;
        transition: visibility 0s linear 0.5s;
    }

    .menu-root.active {
        visibility: visible;
        pointer-events: auto;
        transition-delay: 0s;
    }


    /* =====================================================
   OVERLAY
===================================================== */

    .menu-overlay {
        position: absolute;
        inset: 0;
        background: rgba(8, 20, 11, 0.55);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .menu-root.active .menu-overlay {
        opacity: 1;
    }


    /* =====================================================
   DRAWER
===================================================== */

    .menu-sheet {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 82%;
        max-width: 340px;
        background: #fafbf8;
        border-radius: 0 28px 28px 0;
        box-shadow: 14px 0 50px rgba(0, 0, 0, 0.25);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transform: translate3d(-105%, 0, 0);
        will-change: transform;
        transition: transform 0.5s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .menu-sheet.active {
        transform: translate3d(0, 0, 0);
    }


    /* =====================================================
   PREMIUM HEADER
===================================================== */

    .menu-hero {
        position: relative;
        padding: calc(22px + env(safe-area-inset-top)) 20px 26px;
        background: linear-gradient(145deg, #0c4a21 0%, #146b2f 55%, #1f8a41 100%);
        color: #ffffff;
        overflow: hidden;
        border-radius: 0 0 28px 0;
    }

    .menu-hero::before,
    .menu-hero::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
    }

    .menu-hero::before {
        width: 160px;
        height: 160px;
        top: -60px;
        right: -50px;
    }

    .menu-hero::after {
        width: 100px;
        height: 100px;
        bottom: -40px;
        left: -30px;
    }

    .menu-close-btn {
        position: absolute;
        top: calc(14px + env(safe-area-inset-top));
        right: 14px;
        z-index: 2;
        width: 34px;
        height: 34px;
        border: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.18);
        color: #ffffff;
        font-size: 22px;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
        transition: transform 0.2s ease, background 0.2s ease;
    }

    .menu-close-btn:active {
        transform: scale(0.88);
        background: rgba(255, 255, 255, 0.3);
    }

    .menu-user {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 14px;
        margin-top: 10px;
    }

    .menu-avatar {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-weight: 800;
    }

    .menu-user-hello {
        font-size: 12px;
        opacity: 0.8;
    }

    .menu-user-name {
        font-size: 18px;
        font-weight: 800;
        margin-top: 2px;
    }

    .menu-badges {
        position: relative;
        z-index: 1;
        display: flex;
        gap: 8px;
        margin-top: 18px;
    }

    .menu-badge {
        flex: 1;
        padding: 9px 10px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.2);
        font-size: 11px;
        font-weight: 600;
        text-align: center;
    }


    /* =====================================================
   SCROLL BODY
===================================================== */

    .menu-body {
        flex: 1;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        overscroll-behavior: contain;
        padding: 18px 14px 10px;
    }

    .menu-section-label {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        color: #9aa199;
        margin: 4px 8px 10px;
    }

    .menu-list {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }


    /* =====================================================
   MENU ITEM
===================================================== */

    .menu-list-item {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 11px 12px;
        background: #ffffff;
        border: 1px solid #eef1ea;
        border-radius: 18px;
        text-decoration: none;
        color: #172018;
        font-family: inherit;
        text-align: left;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;

        opacity: 0;
        transform: translate3d(-18px, 0, 0);
        transition: opacity 0.3s ease,
            transform 0.4s cubic-bezier(0.22, 1, 0.36, 1),
            background 0.18s ease;
    }

    .menu-sheet.active .menu-list-item {
        opacity: 1;
        transform: translate3d(0, 0, 0);
        transition-delay: calc(0.14s + var(--i, 0) * 0.05s);
    }

    .menu-list-item:active {
        background: #f1f6ee;
        transform: scale(0.97);
        transition-delay: 0s;
    }

    .menu-item-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .profile-icon {
        background: #e8f4e6;
    }

    .order-icon {
        background: #fff0dd;
    }

    .address-icon {
        background: #e9f3ff;
    }

    .help-icon {
        background: #f0ebff;
        color: #6644d9;
        font-weight: 800;
        font-size: 18px;
    }

    .menu-item-content {
        flex: 1;
        min-width: 0;
        margin-left: 12px;
    }

    .menu-item-title {
        font-size: 14px;
        font-weight: 700;
        color: #172018;
    }

    .menu-item-subtitle {
        margin-top: 3px;
        font-size: 11px;
        color: #858b84;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .menu-arrow {
        font-size: 22px;
        color: #b3b9b1;
        margin-left: 6px;
        line-height: 1;
    }


    /* =====================================================
   PINNED BOTTOM (LOGIN / LOGOUT)
===================================================== */

    .menu-bottom {
        padding: 12px 14px calc(14px + env(safe-area-inset-bottom));
        background: #ffffff;
        border-top: 1px solid #eef1ea;
    }

    .menu-logout-form {
        margin: 0;
        padding: 0;
    }

    .menu-action-btn {
        width: 100%;
        height: 48px;
        border: 0;
        border-radius: 16px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        -webkit-tap-highlight-color: transparent;
        transition: transform 0.2s ease;
    }

    .menu-action-btn:active {
        transform: scale(0.97);
    }

    .menu-logout-btn {
        background: #ffeded;
        color: #d93333;
    }

    .menu-login-btn {
        background: linear-gradient(135deg, #146b2f, #1f8a41);
        color: #ffffff;
    }

    .menu-sheet-footer {
        text-align: center;
        margin-top: 10px;
        font-size: 10px;
        color: #9ca29b;
    }


    /* =====================================================
   BODY LOCK
===================================================== */

    body.menu-open {
        overflow: hidden;
    }


    /* =====================================================
   REDUCED MOTION
===================================================== */

    @media (prefers-reduced-motion: reduce) {

        .menu-root,
        .menu-overlay,
        .menu-sheet,
        .menu-list-item {
            transition: none !important;
        }
    }
</style>


<!-- =====================================================
     BOTTOM NAVIGATION
===================================================== -->

<nav class="bottom-nav">

    <!-- HOME -->
    <a href="{{ url('/') }}"
        class="nav-item {{ request()->is('/') || request()->is('Home') ? 'active' : '' }}">
        <span class="nav-icon">⌂</span>
        <span class="nav-label">Home</span>
    </a>

    <!-- EXPLORE -->
    <a href="{{ route('explore') }}"
        class="nav-item {{ request()->routeIs('explore') ? 'active' : '' }}">
        <span class="nav-icon">⌕</span>
        <span class="nav-label">Explore</span>
    </a>

    <!-- CART -->
    <a href="{{ route('cart') }}"
        class="nav-item {{ request()->routeIs('cart') ? 'active' : '' }}">
        <span class="cart-wrapper">
            <span class="nav-icon">🛒</span>
            <span class="cart-count" id="cartCount"></span>
        </span>
        <span class="nav-label">Cart</span>
    </a>

    <!-- ACCOUNT -->
    <a href="{{ Auth::check() ? route('profile') : 'javascript:void(0)' }}"
        class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}"
        @if(!Auth::check()) onclick="openLoginPopup()" @endif>
        <span class="nav-icon">👤</span>
        <span class="nav-label">Account</span>
    </a>

    <!-- MENU -->
    <button type="button" class="nav-item menu-nav-btn" onclick="openMenuSheet()">
        <span class="nav-icon">☰</span>
        <span class="nav-label">Menu</span>
    </button>

</nav>


<!-- =====================================================
     MENU (overlay + left drawer)
===================================================== -->

<div class="menu-root" id="menuRoot">

    <div class="menu-overlay" onclick="closeMenuSheet()"></div>

    <aside class="menu-sheet" id="menuSheet">

        <!-- PREMIUM HEADER -->
        <div class="menu-hero">

            <button type="button" class="menu-close-btn" onclick="closeMenuSheet()">×</button>

            <div class="menu-user">
                <div class="menu-avatar">
                    @auth
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    @else
                        🥩
                    @endauth
                </div>

                <div>
                    <div class="menu-user-hello">
                        @auth Welcome back, @else Welcome to @endauth
                    </div>
                    <div class="menu-user-name">
                        @auth {{ Auth::user()->name }} @else Nonveg Mart @endauth
                    </div>
                </div>
            </div>

            <div class="menu-badges">
                <div class="menu-badge">⚡ Fast Delivery</div>
                <div class="menu-badge">🥩 100% Fresh</div>
            </div>

        </div>


        <!-- MENU LIST -->
        <div class="menu-body">

            <div class="menu-section-label">Account</div>

            <div class="menu-list">

                <!-- PROFILE -->
                <a href="{{ Auth::check() ? route('profile') : 'javascript:void(0)' }}"
                    class="menu-list-item" style="--i:0"
                    @if(!Auth::check()) onclick="closeMenuSheet(); openLoginPopup();" @endif>
                    <div class="menu-item-icon profile-icon">👤</div>
                    <div class="menu-item-content">
                        <div class="menu-item-title">My Profile</div>
                        <div class="menu-item-subtitle">Manage your account</div>
                    </div>
                    <div class="menu-arrow">›</div>
                </a>

                <!-- ORDERS -->
                <a href="{{ route('my-orders') }}" class="menu-list-item" style="--i:1">
                    <div class="menu-item-icon order-icon">📦</div>
                    <div class="menu-item-content">
                        <div class="menu-item-title">My Orders</div>
                        <div class="menu-item-subtitle">View your order history</div>
                    </div>
                    <div class="menu-arrow">›</div>
                </a>

            </div>

            <div class="menu-section-label" style="margin-top:18px">More</div>

            <div class="menu-list">

                <!-- ABOUT -->
                <a href="{{ route('about-us') }}" class="menu-list-item" style="--i:2">
                    <div class="menu-item-icon address-icon">📍</div>
                    <div class="menu-item-content">
                        <div class="menu-item-title">About Us</div>
                        <div class="menu-item-subtitle">Learn more about Nonveg Mart</div>
                    </div>
                    <div class="menu-arrow">›</div>
                </a>

                <!-- HELP -->
                <a href="javascript:void(0)" class="menu-list-item" style="--i:3">
                    <div class="menu-item-icon help-icon">?</div>
                    <div class="menu-item-content">
                        <div class="menu-item-title">Help &amp; Support</div>
                        <div class="menu-item-subtitle">Get help with your order</div>
                    </div>
                    <div class="menu-arrow">›</div>
                </a>

            </div>

        </div>


        <!-- PINNED BOTTOM -->
        <div class="menu-bottom">

            @auth
                <form method="POST" action="{{ route('logout') }}" class="menu-logout-form">
                    @csrf
                    <button type="submit" class="menu-action-btn menu-logout-btn">
                        ↪ Logout
                    </button>
                </form>
            @else
                <button type="button" class="menu-action-btn menu-login-btn"
                    onclick="closeMenuSheet(); openLoginPopup();">
                    Login / Sign up
                </button>
            @endauth

            <div class="menu-sheet-footer">Nonveg Mart • Fresh. Fast. Local.</div>

        </div>

    </aside>

</div>


<script>
    /* =====================================================
       OPEN MENU
    ===================================================== */

    function openMenuSheet() {
        const root = document.getElementById('menuRoot');
        const sheet = document.getElementById('menuSheet');

        if (!root || !sheet) {
            return;
        }

        root.classList.add('active');
        sheet.classList.add('active');
        document.body.classList.add('menu-open');
    }


    /* =====================================================
       CLOSE MENU
    ===================================================== */

    function closeMenuSheet() {
        const root = document.getElementById('menuRoot');
        const sheet = document.getElementById('menuSheet');

        if (!root || !sheet) {
            return;
        }

        root.classList.remove('active');
        sheet.classList.remove('active');
        document.body.classList.remove('menu-open');
    }


    /* =====================================================
       SWIPE LEFT TO CLOSE
    ===================================================== */

    const menuSheet = document.getElementById('menuSheet');

    let touchStartX = 0;
    let touchEndX = 0;

    if (menuSheet) {

        menuSheet.addEventListener('touchstart', function(event) {
            touchStartX = event.touches[0].clientX;
        }, {
            passive: true
        });

        menuSheet.addEventListener('touchend', function(event) {
            touchEndX = event.changedTouches[0].clientX;

            // Swipe right-to-left closes the drawer
            if (touchStartX - touchEndX > 80) {
                closeMenuSheet();
            }
        }, {
            passive: true
        });

    }


    /* =====================================================
       ESC TO CLOSE
    ===================================================== */

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeMenuSheet();
        }
    });


    /* =====================================================
       CART COUNT
    ===================================================== */

    function updateCartCount() {
        let cart = [];

        try {
            cart = JSON.parse(localStorage.getItem('cart')) || [];
        } catch (error) {
            console.error('Cart localStorage error:', error);
            cart = [];
        }

        const count = cart.length;
        const element = document.getElementById('cartCount');

        if (!element) {
            return;
        }

        if (count === 0) {
            element.textContent = '';
            element.style.display = 'none';
        } else {
            element.textContent = count;
            element.style.display = 'flex';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
    });

    window.addEventListener('storage', function(event) {
        if (event.key === 'cart') {
            updateCartCount();
        }
    });
</script>
