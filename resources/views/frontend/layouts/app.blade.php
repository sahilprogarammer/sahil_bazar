<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Nonveg Mart - Fresh Non-Veg Delivered')
    </title>

    <meta name="theme-color" content="#14532D">

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Main CSS --}}
    <link rel="stylesheet" href="{{ asset('css/nonveg-bazar.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @stack('styles')
</head>

<body>

    <div class="app">

        @yield('content')
        @include('frontend.components.quantity-modal')
        @include('frontend.components.address.selector')
        @include('frontend.components.address.form')

        @include('frontend.components.address.scripts')
        @include('frontend.components.login')

    </div>

    {{-- =====================================================
     NONVEG BAZAR - PREMIUM PAGE LOADER
===================================================== --}}

    <div id="premiumPageLoader" class="premium-page-loader">

        <div class="premium-loader-box">

            <div class="premium-loader-logo">
                <div class="premium-loader-ring"></div>

                <div class="premium-loader-logo-inner">
                    <span>NB</span>
                </div>
            </div>

            <div class="premium-loader-brand">
                <span class="brand-main">NONVEG</span>
                <span class="brand-highlight">BAZAR</span>
            </div>

            <div class="premium-loader-status">
                <span>Preparing your order</span>

                <span class="loading-dots">
                    <i></i>
                    <i></i>
                    <i></i>
                </span>
            </div>

            <div class="premium-loader-line">
                <span></span>
            </div>

        </div>

    </div>

    <script src="{{ asset('js/nonveg-bazar.js') }}"></script>

    @stack('scripts')

</body>

<script>
(function () {

    const loader = document.getElementById('premiumPageLoader');

    if (!loader) {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Hide Loader
    |--------------------------------------------------------------------------
    */

    function hideLoader() {
        loader.classList.add('hide');
    }


    /*
    |--------------------------------------------------------------------------
    | Show Loader
    |--------------------------------------------------------------------------
    */

    function showLoader() {
        loader.classList.remove('hide');
    }


    /*
    |--------------------------------------------------------------------------
    | Initial Page Load
    |--------------------------------------------------------------------------
    */

    if (document.readyState === 'loading') {

        document.addEventListener('DOMContentLoaded', function () {

            requestAnimationFrame(function () {
                hideLoader();
            });

        }, {
            once: true
        });

    } else {

        hideLoader();

    }


    /*
    |--------------------------------------------------------------------------
    | Normal Laravel Links
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', function (event) {

        const link = event.target.closest('a');

        if (!link) {
            return;
        }

        const href = link.getAttribute('href');

        if (!href) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Ignore special links
        |--------------------------------------------------------------------------
        */

        if (
            href === '#' ||
            href.startsWith('#') ||
            href.startsWith('javascript:') ||
            href.startsWith('tel:') ||
            href.startsWith('mailto:')
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Ignore new tab
        |--------------------------------------------------------------------------
        */

        if (
            link.target === '_blank' ||
            link.hasAttribute('download') ||
            link.hasAttribute('data-no-loader')
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Convert to URL
        |--------------------------------------------------------------------------
        */

        let url;

        try {

            url = new URL(
                href,
                window.location.href
            );

        } catch (error) {

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | Ignore external URLs
        |--------------------------------------------------------------------------
        */

        if (url.origin !== window.location.origin) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Same URL
        |--------------------------------------------------------------------------
        */

        if (
            url.href === window.location.href
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Show loader
        |--------------------------------------------------------------------------
        */

        showLoader();

        /*
        |--------------------------------------------------------------------------
        | IMPORTANT
        |--------------------------------------------------------------------------
        |
        | We DO NOT use preventDefault()
        | We DO NOT use pushState()
        | Browser performs normal Laravel navigation.
        |
        */

    });


    /*
    |--------------------------------------------------------------------------
    | Mobile Back / Forward
    |--------------------------------------------------------------------------
    |
    | Do NOT call history.pushState()
    | Do NOT call location.reload() here.
    |
    */

    window.addEventListener('pageshow', function (event) {

        /*
        | If browser restored page from BFCache,
        | make sure loader is hidden.
        */

        if (event.persisted) {
            hideLoader();
        }

    });


})();
</script>

</html>