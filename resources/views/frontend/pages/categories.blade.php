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
        <h1>{{ $category->name }}</h1>
        <span>Fresh {{ $category->name }} for every meal</span>
    </div>

    <button type="button" class="header-btn page-cart-btn">
        🛒
        <span class="cart-count" id="headerCartCount">0
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
            What are you looking for?
        </h2>

        <p>
            Choose your favourite category and discover fresh products.
        </p>

    </div>


    {{-- =========================
             CATEGORIES GRID
        ========================== --}}
    <section class="all-categories">

        @forelse($category->subcategories as $subcat)

        <a
            href="{{ url($category->slug . '/' . $subcat->slug) }}"
            class="category-circle-card">


            {{-- =====================================
                     CATEGORY IMAGE
                ====================================== --}}

            <div class="category-circle-image">

                <img
                    src="{{ $subcat->image }}"
                    alt="{{ $subcat->name }}"
                    loading="lazy">


            </div>



            {{-- =====================================
                     CATEGORY DETAILS
                ====================================== --}}

            <div class="category-circle-content">

                <h3>
                    {{ $subcat->name }}
                </h3>


                <p>
                    Fresh & cleaned
                </p>


                <!-- <span class="category-circle-arrow">
                    →
                </span> -->

            </div>

        </a>

        @empty

        <div class="category-empty">

            <div class="category-empty-icon">
                🥩
            </div>

            <strong>
                No categories available
            </strong>

            <p>
                New categories will appear here soon.
            </p>

        </div>

        @endforelse

    </section>


    {{-- =========================
             SPECIAL CATEGORY
        ========================== --}}
    <!-- <section class="category-banner">

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

    </section> -->

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


    // searchInput.addEventListener('input', function() {

    //     const search =
    //         this.value.toLowerCase().trim();


    //     categories.forEach(function(category) {

    //         const name =
    //             category
    //             .querySelector('h3')
    //             .textContent
    //             .toLowerCase();


    //         if (name.includes(search)) {

    //             category.style.display = '';

    //         } else {

    //             category.style.display = 'none';

    //         }

    //     });

    // });
</script>

@endpush