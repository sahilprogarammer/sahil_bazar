@extends('admin.layouts.app')

@section('title', 'Add Product - Basic Information')

@section('content')

<div class="page-wrapper">


    <!-- =========================================
     PAGE HEADER
========================================== -->

    <div class="page-header">

        <div>
            <h1 class="page-title">Add Product</h1>

            <p class="page-subtitle">
                Step 1 of 4 · Basic product information
            </p>
        </div>

        <a href="{{ url()->previous() }}" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back
        </a>

    </div>


    <!-- =========================================
     STEP INDICATOR
========================================== -->

    <div class="step-card">

        <div class="step-item active">

            <div class="step-number">
                1
            </div>

            <div class="step-content">
                <strong>Basic Info</strong>
                <span>Product details</span>
            </div>

        </div>


        <div class="step-line"></div>


        <div class="step-item">

            <div class="step-number">
                2
            </div>

            <div class="step-content">
                <strong>Pricing</strong>
                <span>Price & stock</span>
            </div>

        </div>


        <div class="step-line"></div>


        <div class="step-item">

            <div class="step-number">
                3
            </div>

            <div class="step-content">
                <strong>Media</strong>
                <span>Image & details</span>
            </div>

        </div>


        <div class="step-line"></div>


        <div class="step-item">

            <div class="step-number">
                4
            </div>

            <div class="step-content">
                <strong>Review</strong>
                <span>Save product</span>
            </div>

        </div>

    </div>


    <!-- =========================================
     FORM CARD
========================================== -->

    <div class="product-card">

        <form
            action="{{ route('product.step1.save') }}"
            method="POST">

            @csrf

            {{-- Product ID - only available during edit --}}
            @if(isset($product) && $product)
            <input
                type="hidden"
                name="id"
                value="{{ $product->id }}">
            @endif


            <div class="form-section">

                <div class="section-title">

                    <div class="section-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div>
                        <h3>Product Information</h3>

                        <p>
                            Enter the basic information about your product
                        </p>
                    </div>

                </div>


                <div class="row">

                    {{-- Product Name --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Product Name <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="productName"
                            class="form-control"
                            value="{{ old('name', $product->name ?? '') }}"
                            placeholder="Enter product name"
                            required>

                        @error('name')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>


                    {{-- Slug --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Slug <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="slug"
                            id="productSlug"
                            class="form-control"
                            value="{{ old('slug', $product->slug ?? '') }}"
                            placeholder="product-slug"
                            required>

                        @error('slug')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>


                    {{-- Category --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Category <span>*</span>
                        </label>

                        <select
                            name="category_id"
                            id="category_id"
                            class="form-select"
                            required>

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ old(
                                'category_id',
                                $product->category_id ?? ''
                            ) == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                            @endforeach

                        </select>

                        @error('category_id')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>


                    {{-- Subcategory --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Subcategory <span>*</span>
                        </label>

                        <select
                            name="subcategory_id"
                            id="subcategory_id"
                            class="form-select"
                            required>

                            <option value="">
                                Select Subcategory
                            </option>

                            @foreach($subcategories as $subcategory)

                            <option
                                value="{{ $subcategory->id }}"
                                data-category="{{ $subcategory->category_id }}"
                                {{ old(
                                'subcategory_id',
                                $product->subcategory_id ?? ''
                            ) == $subcategory->id ? 'selected' : '' }}>

                                {{ $subcategory->name }}

                            </option>

                            @endforeach

                        </select>

                        @error('subcategory_id')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>


                    {{-- Product Type --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Product Type <span>*</span>
                        </label>

                        <select
                            name="type"
                            class="form-select"
                            required>

                            <option value="">
                                Select Type
                            </option>

                            <option
                                value="veg"
                                {{ old(
                            'type',
                            $product->type ?? ''
                        ) == 'veg' ? 'selected' : '' }}>

                                Veg

                            </option>

                            <option
                                value="nonveg"
                                {{ old(
                            'type',
                            $product->type ?? ''
                        ) == 'nonveg' ? 'selected' : '' }}>

                                Nonveg

                            </option>

                        </select>

                        @error('type')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- Footer --}}
            <div class="form-footer">

                <a
                    href="{{ url()->previous() }}"
                    class="cancel-btn">

                    Cancel

                </a>


                {{-- IMPORTANT: Submit button, not <a> --}}
                <button
                    type="submit"
                    class="save-btn">

                    @if(isset($product) && $product)

                    Update & Continue

                    @else

                    Save & Continue

                    @endif

                    <i class="bi bi-arrow-right"></i>

                </button>

            </div>

        </form>


    </div>


</div>

<style>
    /* =========================================
   PAGE
========================================= */

    .page-wrapper {
        max-width: 1200px;
        margin: auto;
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .page-title {
        font-size: 27px;
        font-weight: 700;
        color: #172018;
        margin: 0 0 5px;
    }

    .page-subtitle {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }


    /* =========================================
   BACK BUTTON
========================================= */

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #374151;
        text-decoration: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
    }

    .back-btn:hover {
        color: #111827;
        background: #f9fafb;
    }


    /* =========================================
   STEP CARD
========================================= */

    .step-card {
        background: #fff;
        border: 1px solid #e8ece8;
        border-radius: 16px;
        padding: 18px 22px;
        margin-bottom: 20px;

        display: flex;
        align-items: center;
    }

    .step-item {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .step-number {
        width: 38px;
        height: 38px;
        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #f1f3f1;
        color: #7a827b;

        font-size: 14px;
        font-weight: 700;
    }

    .step-item.active .step-number {
        background: #176b3a;
        color: #fff;
    }

    .step-content {
        display: flex;
        flex-direction: column;
    }

    .step-content strong {
        font-size: 13px;
        color: #303730;
    }

    .step-item.active .step-content strong {
        color: #176b3a;
    }

    .step-content span {
        font-size: 11px;
        color: #8a918b;
        margin-top: 2px;
    }

    .step-line {
        height: 1px;
        background: #e1e6e1;
        flex: 1;
        margin: 0 16px;
    }


    /* =========================================
   PRODUCT CARD
========================================= */

    .product-card {
        background: #fff;
        border: 1px solid #e8ece8;
        border-radius: 18px;
        overflow: hidden;
    }


    /* =========================================
   FORM SECTION
========================================= */

    .form-section {
        padding: 26px;
        border-bottom: 1px solid #edf0ed;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 13px;
        margin-bottom: 24px;
    }

    .section-icon {
        width: 42px;
        height: 42px;
        border-radius: 11px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #eef7ef;
        color: #176b3a;

        font-size: 19px;
    }

    .section-title h3 {
        margin: 0 0 3px;
        font-size: 17px;
        font-weight: 700;
        color: #172018;
    }

    .section-title p {
        margin: 0;
        font-size: 13px;
        color: #7a827b;
    }


    /* =========================================
   LABEL
========================================= */

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #303730;
        margin-bottom: 8px;
    }

    .form-label span {
        color: #dc2626;
    }


    /* =========================================
   INPUT
========================================= */

    .form-control,
    .form-select {
        min-height: 45px;
        border: 1px solid #dfe5df;
        border-radius: 10px;

        font-size: 14px;
        color: #172018;

        box-shadow: none !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #176b3a;

        box-shadow:
            0 0 0 3px rgba(23, 107, 58, .08) !important;
    }


    /* =========================================
   FOOTER
========================================= */

    .form-footer {
        padding: 20px 26px;

        display: flex;
        align-items: center;
        justify-content: flex-end;

        gap: 10px;

        background: #fcfdfc;
    }

    .cancel-btn {
        padding: 11px 20px;

        border-radius: 10px;
        border: 1px solid #dfe4df;

        background: #fff;
        color: #4b5563;

        text-decoration: none;

        font-size: 14px;
        font-weight: 600;
    }

    .cancel-btn:hover {
        background: #f9fafb;
        color: #374151;
    }

    .save-btn {
        border: 0;

        padding: 11px 21px;

        border-radius: 10px;

        background: #176b3a;
        color: #fff;

        font-size: 14px;
        font-weight: 600;

        cursor: pointer;

        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .save-btn:hover {
        background: #12562e;
    }


    /* =========================================
   RESPONSIVE
========================================= */

    @media (max-width: 768px) {

        .page-wrapper {
            width: 100%;
        }

        .page-header {
            align-items: flex-start;
            gap: 15px;
        }

        .page-title {
            font-size: 23px;
        }

        .step-card {
            overflow-x: auto;
            padding: 15px;
        }

        .step-content span {
            display: none;
        }

        .step-line {
            min-width: 25px;
            margin: 0 10px;
        }

        .form-section {
            padding: 20px 16px;
        }

        .form-footer {
            padding: 16px;
        }

    }


    @media (max-width: 480px) {

        .page-header {
            display: block;
        }

        .back-btn {
            margin-top: 14px;
        }

        .step-card {
            border-radius: 12px;
        }

        .step-item {
            gap: 7px;
        }

        .step-number {
            width: 34px;
            height: 34px;
            font-size: 13px;
        }

        .step-content strong {
            font-size: 11px;
        }

        .section-title {
            align-items: flex-start;
        }

        .section-icon {
            flex-shrink: 0;
        }

        .form-footer {
            flex-direction: row;
        }

        .cancel-btn,
        .save-btn {
            flex: 1;
            text-align: center;
            justify-content: center;
        }

    }
</style>

<script>
    /* =========================================
   AUTO SLUG
========================================= */

    document.addEventListener('DOMContentLoaded', function() {

        const nameInput = document.getElementById('productName');
        const slugInput = document.getElementById('productSlug');

        if (!nameInput || !slugInput) {
            return;
        }

        nameInput.addEventListener('input', function() {

            // Only auto generate if slug is empty
            // or user has not manually changed it

            if (
                slugInput.dataset.manual !== 'true'
            ) {

                slugInput.value = nameInput.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '');

            }

        });


        slugInput.addEventListener('input', function() {

            slugInput.dataset.manual = 'true';

        });

    });


    /* =========================================
       FILTER SUBCATEGORIES
    ========================================= */

    document.addEventListener('DOMContentLoaded', function() {

        const category =
            document.getElementById('category_id');

        const subcategory =
            document.getElementById('subcategory_id');

        if (!category || !subcategory) {
            return;
        }

        const options = Array.from(
            subcategory.querySelectorAll(
                'option[data-category]'
            )
        );


        function filterSubcategories() {

            const categoryId = category.value;

            options.forEach(function(option) {

                if (
                    option.dataset.category === categoryId
                ) {

                    option.hidden = false;

                } else {

                    option.hidden = true;

                }

            });


            const selected =
                subcategory.querySelector(
                    'option:checked'
                );


            if (
                selected &&
                selected.dataset.category &&
                selected.dataset.category !== categoryId
            ) {

                subcategory.value = '';

            }

        }


        category.addEventListener(
            'change',
            filterSubcategories
        );


        filterSubcategories();

    });
</script>

@endsection