@extends('frontend.layouts.app')

@section('title', 'Categories - Nonveg Bazar')

@section('content')

    {{-- =========================
         PAGE HEADER
    ========================== --}}
    <header class="page-header">

        <a href="{{ route('home') }}" class="back-btn">
            ←
        </a>

        <div class="page-header-title">
            <h1>Categories</h1>
            <span>Fresh non-veg for every meal</span>
        </div>

        <button type="button" class="header-btn page-cart-btn">
            🛒
            <span class="cart-count">
                2
            </span>
        </button>

    </header>


    {{-- =========================
         SEARCH
    ========================== --}}
    <!-- <div class="category-search-wrapper">

        <div class="category-search">

            <span class="search-icon">
                ⌕
            </span>

            <input
                type="search"
                id="categorySearch"
                placeholder="Search categories..."
                autocomplete="off">

        </div>

    </div> -->


    {{-- =========================
         CATEGORY CONTENT
    ========================== --}}
    <main class="category-page">

        <div class="category-page-intro">

            <span class="category-page-label">
                EXPLORE
            </span>

            <h2>
                What are you<br>
                looking for?
            </h2>

            <p>
                Choose your favourite category and
                discover fresh products.
            </p>

        </div>


        {{-- =========================
             CATEGORIES GRID
        ========================== --}}
        <section class="all-categories">

            <a href="{{ route('products', ['category' => 'chicken']) }}" class="category-large-card">

                <div class="category-large-image">

                    <img
                        src="https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&w=600&q=85"
                        alt="Chicken">

                    <span class="category-product-count">
                        24 Products
                    </span>

                </div>

                <div class="category-large-content">

                    <div>
                        <h3>Chicken</h3>
                        <p>Fresh & cleaned</p>
                    </div>

                    <span class="category-arrow">
                        →
                    </span>

                </div>

            </a>


            <a href="#" class="category-large-card">

                <div class="category-large-image">

                    <img
                        src="https://images.unsplash.com/photo-1544943910-4c1dc44aab44?auto=format&fit=crop&w=600&q=85"
                        alt="Fish">

                    <span class="category-product-count">
                        18 Products
                    </span>

                </div>

                <div class="category-large-content">

                    <div>
                        <h3>Fish</h3>
                        <p>Fresh daily catch</p>
                    </div>

                    <span class="category-arrow">
                        →
                    </span>

                </div>

            </a>


            <a href="#" class="category-large-card">

                <div class="category-large-image">

                    <img
                        src="https://images.unsplash.com/photo-1529692236671-f1f6cf9683ba?auto=format&fit=crop&w=600&q=85"
                        alt="Mutton">

                    <span class="category-product-count">
                        16 Products
                    </span>

                </div>

                <div class="category-large-content">

                    <div>
                        <h3>Mutton</h3>
                        <p>Premium cuts</p>
                    </div>

                    <span class="category-arrow">
                        →
                    </span>

                </div>

            </a>


            <a href="#" class="category-large-card">

                <div class="category-large-image">

                    <img
                        src="https://images.unsplash.com/photo-1559339352-11d035aa65de?auto=format&fit=crop&w=600&q=85"
                        alt="Prawns">

                    <span class="category-product-count">
                        12 Products
                    </span>

                </div>

                <div class="category-large-content">

                    <div>
                        <h3>Prawns</h3>
                        <p>Cleaned seafood</p>
                    </div>

                    <span class="category-arrow">
                        →
                    </span>

                </div>

            </a>


            <a href="#" class="category-large-card">

                <div class="category-large-image">

                    <img
                        src="https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?auto=format&fit=crop&w=600&q=85"
                        alt="Liver">

                    <span class="category-product-count">
                        8 Products
                    </span>

                </div>

                <div class="category-large-content">

                    <div>
                        <h3>Liver</h3>
                        <p>Fresh & tender</p>
                    </div>

                    <span class="category-arrow">
                        →
                    </span>

                </div>

            </a>


            <a href="#" class="category-large-card">

                <div class="category-large-image">

                    <img
                        src="https://images.unsplash.com/photo-1600891964092-4316c288032e?auto=format&fit=crop&w=600&q=85"
                        alt="Seafood">

                    <span class="category-product-count">
                        20 Products
                    </span>

                </div>

                <div class="category-large-content">

                    <div>
                        <h3>Seafood</h3>
                        <p>Fresh from the sea</p>
                    </div>

                    <span class="category-arrow">
                        →
                    </span>

                </div>

            </a>

        </section>


        {{-- =========================
             SPECIAL CATEGORY
        ========================== --}}
        <section class="category-banner">

            <div class="category-banner-content">

                <span>
                    TODAY'S SPECIAL
                </span>

                <h2>
                    Fresh cuts.<br>
                    Better taste.
                </h2>

                <p>
                    Quality meat prepared just
                    the way you like it.
                </p>

                <a href="#" class="category-banner-btn">
                    Explore Deals →
                </a>

            </div>

            <div class="category-banner-image">

                <img
                    src="https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=500&q=85"
                    alt="Fresh meat">

            </div>

        </section>

    </main>


    {{-- Bottom Navigation --}}
    @include('frontend.components.bottom-nav')


@endsection


@push('scripts')

<script>

    const searchInput =
        document.getElementById('categorySearch');

    const categories =
        document.querySelectorAll('.category-large-card');


    searchInput.addEventListener('input', function () {

        const search =
            this.value.toLowerCase().trim();


        categories.forEach(function (category) {

            const name =
                category
                    .querySelector('h3')
                    .textContent
                    .toLowerCase();


            if (name.includes(search)) {

                category.style.display = '';

            } else {

                category.style.display = 'none';

            }

        });

    });

</script>

@endpush