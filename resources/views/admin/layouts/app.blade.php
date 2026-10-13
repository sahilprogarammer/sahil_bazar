<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Dashboard') | Nonveg Bazar
    </title>


    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">


    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">


    <!-- Admin CSS -->
    <link
        rel="stylesheet"
        href="{{ asset('admin/css/admin.css') }}">


    @stack('styles')


    <style>

        /* =====================================================
           SIDEBAR DROPDOWN
        ===================================================== */

        .nav-dropdown {
            width: 100%;
        }


        /* Dropdown parent button */

        .nav-dropdown-toggle {
            width: 100%;

            border: 0;

            background: transparent;

            text-align: left;

            cursor: pointer;

            display: flex;

            align-items: center;

            font-family: inherit;

            color: inherit;
        }


        /* Arrow */

        .dropdown-arrow {

            margin-left: auto;

            width: 24px;

            height: 24px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 10px;

            transition: transform 0.25s ease;

            flex-shrink: 0;

        }


        /* Rotate arrow */

        .nav-dropdown-toggle.open .dropdown-arrow {

            transform: rotate(180deg);

        }


        /* Dropdown menu */

        .nav-dropdown-menu {

            max-height: 0;

            overflow: hidden;

            opacity: 0;

            transition:
                max-height 0.3s ease,
                opacity 0.2s ease;

        }


        /* Open dropdown */

        .nav-dropdown-menu.open {

            max-height: 500px;

            opacity: 1;

        }


        /* =====================================================
           SUB MENU
        ===================================================== */

        .nav-sub-item {

            display: flex;

            align-items: center;

            min-height: 42px;

            padding: 9px 15px 9px 52px;

            margin: 2px 8px;

            text-decoration: none;

            font-size: 13px;

            font-weight: 500;

            color: #6b7280;

            border-radius: 8px;

            transition:
                background 0.2s ease,
                color 0.2s ease,
                padding-left 0.2s ease;

        }


        /* Sub menu dot */

        .sub-dot {

            width: 5px;

            height: 5px;

            border-radius: 50%;

            background: #9ca3af;

            margin-right: 12px;

            flex-shrink: 0;

            transition: background 0.2s ease;

        }


        /* Hover */

        .nav-sub-item:hover {

            background: rgba(11, 99, 246, 0.06);

            color: #0B63F6;

            padding-left: 56px;

        }


        .nav-sub-item:hover .sub-dot {

            background: #0B63F6;

        }


        /* Active submenu */

        .nav-sub-item.active {

            background: rgba(11, 99, 246, 0.09);

            color: #0B63F6;

            font-weight: 600;

        }


        .nav-sub-item.active .sub-dot {

            background: #0B63F6;

        }


        /* Active parent */

        .nav-dropdown-toggle.active {

            color: #0B63F6;

        }


        /* Remove button focus outline */

        .nav-dropdown-toggle:focus {

            outline: none;

            box-shadow: none;

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 768px) {

            .nav-sub-item {

                padding-left: 50px;

            }

            .nav-sub-item:hover {

                padding-left: 54px;

            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         ADMIN APP
    ====================================================== -->

    <div class="admin-app">


        <!-- =================================================
             SIDEBAR
        ================================================== -->

        <aside class="sidebar" id="sidebar">


            <!-- LOGO -->

            <div class="sidebar-logo">

                <div class="logo-box">
                    🥩
                </div>

                <div class="logo-info">

                    <div class="logo-name">
                        Nonveg Bazar
                    </div>

                    <div class="logo-subtitle">
                        ADMIN PANEL
                    </div>

                </div>

            </div>


            <!-- =================================================
                 NAVIGATION
            ================================================== -->

            <nav class="sidebar-nav">


                <!-- ================= MAIN ================= -->

                <div class="nav-section">
                    Main
                </div>


                <a href="{{ route('admin.dashboard') }}"
                    class="nav-item
                    {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">

                    <span class="nav-icon">
                        ⌂
                    </span>

                    <span class="nav-label">
                        Dashboard
                    </span>

                </a>


                <!-- =================================================
                     MANAGEMENT
                ================================================== -->

                <div class="nav-dropdown">

                    <button type="button"
                        class="nav-item nav-dropdown-toggle
                        {{ request()->routeIs(
                            'admin.category*',
                            'admin.subcategory*',
                            'admin.products*',
                            'admin.orders*'
                        ) ? 'active' : '' }}"
                        onclick="toggleNavDropdown(this)">

                        <span class="nav-icon">
                            🗂
                        </span>

                        <span class="nav-label">
                            Management
                        </span>

                        <span class="dropdown-arrow">

                            <i class="fa-solid fa-chevron-down"></i>

                        </span>

                    </button>


                    <div class="nav-dropdown-menu">


                        <a href="{{ route('admin.category') }}"
                            class="nav-sub-item
                            {{ request()->routeIs('admin.category*') ? 'active' : '' }}">

                            <span class="sub-dot"></span>

                            Categories

                        </a>


                        <a href="{{ route('admin.subcategory') }}"
                            class="nav-sub-item
                            {{ request()->routeIs('admin.subcategory*') ? 'active' : '' }}">

                            <span class="sub-dot"></span>

                            Subcategories

                        </a>


                        <a href="{{ route('admin.product') }}"
                            class="nav-sub-item
                            {{ request()->routeIs('admin.products*') ? 'active' : '' }}">

                            <span class="sub-dot"></span>

                            Products

                        </a>


                        <a href="{{ route('admin.order') }}"
                            class="nav-sub-item
                            {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">

                            <span class="sub-dot"></span>

                            Orders

                        </a>

                        

                        <a href="{{ route('admin.deliverycharge') }}"
                            class="nav-sub-item
                            {{ request()->routeIs('admin.deliverycharges*') ? 'active' : '' }}">

                            <span class="sub-dot"></span>

                            Delivery Charges

                        </a>


                    </div>

                </div>


                <!-- =================================================
                     REPORT
                ================================================== -->

                <div class="nav-dropdown">

                    <button type="button"
                        class="nav-item nav-dropdown-toggle
                        {{ request()->routeIs(
                            'admin.order.*',
                            'admin.completeorder*',
                            'admin.pendingorder*',
                            'admin.cancelorder*'
                        ) ? 'active' : '' }}"
                        onclick="toggleNavDropdown(this)">

                        <span class="nav-icon">
                            📊
                        </span>

                        <span class="nav-label">
                            Report
                        </span>

                        <span class="dropdown-arrow">

                            <i class="fa-solid fa-chevron-down"></i>

                        </span>

                    </button>


                    <div class="nav-dropdown-menu">


                        <a href="{{ route('admin.order') }}"
                            class="nav-sub-item
                            {{ request()->routeIs('admin.order.*') ? 'active' : '' }}">

                            <span class="sub-dot"></span>

                            All Orders

                        </a>


                        <a href="{{ route('admin.completeorder') }}"
                            class="nav-sub-item
                            {{ request()->routeIs('admin.completeorder*') ? 'active' : '' }}">

                            <span class="sub-dot"></span>

                            Complete Orders

                        </a>


                        <a href="{{ route('admin.pendingorder') }}"
                            class="nav-sub-item
                            {{ request()->routeIs('admin.pendingorder*') ? 'active' : '' }}">

                            <span class="sub-dot"></span>

                            Pending Orders

                        </a>


                        <a href="{{ route('admin.cancelorder') }}"
                            class="nav-sub-item
                            {{ request()->routeIs('admin.cancelorder*') ? 'active' : '' }}">

                            <span class="sub-dot"></span>

                            Cancel Orders

                        </a>


                    </div>

                </div>


                <!-- =================================================
                     MARKETING
                ================================================== -->

                <div class="nav-dropdown">

                    <button type="button"
                        class="nav-item nav-dropdown-toggle"
                        onclick="toggleNavDropdown(this)">

                        <span class="nav-icon">
                            🎁
                        </span>

                        <span class="nav-label">
                            Delivery Management
                        </span>

                        <span class="dropdown-arrow">

                            <i class="fa-solid fa-chevron-down"></i>

                        </span>

                    </button>


                    <div class="nav-dropdown-menu">
                        <a href="{{ route('admin.deliveryboy') }}"
                            class="nav-sub-item
                            {{ request()->routeIs('admin.deliveryboy*') ? 'active' : '' }}">

                            <span class="sub-dot"></span>

                            Delivery Boys

                        </a>

                    </div>

                </div>


                <!-- =================================================
                     OPERATIONS
                ================================================== -->

                <div class="nav-dropdown">

                    <button type="button"
                        class="nav-item nav-dropdown-toggle"
                        onclick="toggleNavDropdown(this)">

                        <span class="nav-icon">
                            🚚
                        </span>

                        <span class="nav-label">
                            Operations
                        </span>

                        <span class="dropdown-arrow">

                            <i class="fa-solid fa-chevron-down"></i>

                        </span>

                    </button>


                    <div class="nav-dropdown-menu">


                        <a href="#"
                            class="nav-sub-item">

                            <span class="sub-dot"></span>

                            Delivery

                        </a>


                        <a href="#"
                            class="nav-sub-item">

                            <span class="sub-dot"></span>

                            Payments

                        </a>


                        <a href="#"
                            class="nav-sub-item">

                            <span class="sub-dot"></span>

                            Reports

                        </a>


                    </div>

                </div>


                <!-- =================================================
                     SYSTEM
                ================================================== -->

                <div class="nav-dropdown">

                    <button type="button"
                        class="nav-item nav-dropdown-toggle"
                        onclick="toggleNavDropdown(this)">

                        <span class="nav-icon">
                            ⚙
                        </span>

                        <span class="nav-label">
                            System
                        </span>

                        <span class="dropdown-arrow">

                            <i class="fa-solid fa-chevron-down"></i>

                        </span>

                    </button>


                    <div class="nav-dropdown-menu">


                        <a href="#"
                            class="nav-sub-item">

                            <span class="sub-dot"></span>

                            Settings

                        </a>


                    </div>

                </div>


            </nav>


            <!-- =================================================
                 SIDEBAR FOOTER
            ================================================== -->

            <div class="sidebar-footer">

                <div class="admin-mini">


                    <div class="admin-avatar">
                        AD
                    </div>


                    <div class="admin-info">

                        <div class="admin-name">
                            Admin
                        </div>

                        <div class="admin-role">
                            Administrator
                        </div>

                    </div>


                    <button
                        type="button"
                        class="logout-btn"
                        title="Logout">

                        ↪

                    </button>


                </div>

            </div>


        </aside>


        <!-- =================================================
             SIDEBAR OVERLAY
        ================================================== -->

        <div
            class="sidebar-overlay"
            id="sidebarOverlay"
            onclick="closeSidebar()">
        </div>


        <!-- =================================================
             MAIN WRAPPER
        ================================================== -->

        <main class="main-wrapper">


            <!-- =================================================
                 TOPBAR
            ================================================== -->

            <header class="topbar">


                <!-- MOBILE MENU -->

                <button
                    type="button"
                    class="mobile-menu-btn"
                    onclick="toggleSidebar()"
                    aria-label="Open menu">

                    ☰

                </button>


                <!-- PAGE TITLE -->

                <div class="page-heading">

                    <h1>
                        @yield('page-title', 'Dashboard')
                    </h1>

                    <p>
                        @yield(
                            'page-description',
                            'Welcome back to Nonveg Bazar admin.'
                        )
                    </p>

                </div>


                <!-- TOP ACTIONS -->

                <div class="top-actions">


                    <!-- SEARCH -->

                    <button
                        type="button"
                        class="top-icon-btn"
                        title="Search">

                        🔍

                    </button>


                    <!-- LOGOUT -->

                    <form
                        action="{{ route('admin.logout') }}"
                        method="POST"
                        style="display: inline;">

                        @csrf

                        <button
                            type="submit"
                            class="top-icon-btn"
                            title="Logout">

                            <img
                                src="{{ asset('logout.png') }}"
                                style="height: 20px;"
                                alt="logo">

                        </button>

                    </form>


                </div>


            </header>


            <!-- =================================================
                 PAGE CONTENT
            ================================================== -->

            <section class="content">

                @yield('content')

            </section>


        </main>


    </div>


    <!-- =====================================================
         ADMIN JS
    ====================================================== -->

    <script src="{{ asset('admin/js/admin.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>

        /* =====================================================
           SIDEBAR DROPDOWN
        ===================================================== */

        function toggleNavDropdown(button) {

            const menu = button.nextElementSibling;

            const isOpen = menu.classList.contains('open');


            /*
             * Close all other dropdowns
             */

            document.querySelectorAll('.nav-dropdown-menu.open')
                .forEach(function (item) {

                    if (item !== menu) {

                        item.classList.remove('open');

                    }

                });


            document.querySelectorAll('.nav-dropdown-toggle.open')
                .forEach(function (item) {

                    if (item !== button) {

                        item.classList.remove('open');

                    }

                });


            /*
             * Toggle current dropdown
             */

            if (isOpen) {

                menu.classList.remove('open');

                button.classList.remove('open');

            } else {

                menu.classList.add('open');

                button.classList.add('open');

            }

        }


        /* =====================================================
           AUTO OPEN ACTIVE DROPDOWN
        ===================================================== */

        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.nav-dropdown')
                .forEach(function (dropdown) {

                    const activeItem =
                        dropdown.querySelector('.nav-sub-item.active');


                    if (activeItem) {

                        const button =
                            dropdown.querySelector('.nav-dropdown-toggle');

                        const menu =
                            dropdown.querySelector('.nav-dropdown-menu');


                        if (button && menu) {

                            button.classList.add('open');

                            menu.classList.add('open');

                        }

                    }

                });

        });

    </script>


    @stack('scripts')


</body>

</html>

