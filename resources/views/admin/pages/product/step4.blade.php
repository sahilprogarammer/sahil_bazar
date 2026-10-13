@extends('admin.layouts.app')

@section('title', 'Review Product')

@section('content')

<style>
    .product-page {
        max-width: 1100px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 25px;
    }

    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: #172018;
        margin-bottom: 5px;
    }

    .page-subtitle {
        color: #6b7280;
        font-size: 14px;
    }

    /* ================================
       STEP INDICATOR
    ================================= */

    .step-wrapper {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #9ca3af;
        font-size: 14px;
        font-weight: 600;
    }

    .step-number {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e5e7eb;
        color: #6b7280;
        font-weight: 700;
    }

    .step.completed .step-number,
    .step.active .step-number {
        background: #176b3a;
        color: white;
    }

    .step.active {
        color: #176b3a;
    }

    .step-line {
        flex: 1;
        height: 2px;
        background: #e5e7eb;
        margin: 0 15px;
    }

    .step-line.completed {
        background: #176b3a;
    }

    /* ================================
       CARD
    ================================= */

    .review-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .review-card-header {
        padding: 18px 22px;
        border-bottom: 1px solid #eef0f2;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .review-card-title {
        font-size: 17px;
        font-weight: 700;
        color: #172018;
        margin: 0;
    }

    .edit-link {
        color: #176b3a;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .edit-link:hover {
        text-decoration: underline;
    }

    .review-body {
        padding: 22px;
    }

    /* ================================
       INFORMATION
    ================================= */

    .info-item {
        margin-bottom: 20px;
    }

    .info-label {
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .info-value {
        color: #172018;
        font-size: 15px;
        font-weight: 600;
        word-break: break-word;
    }

    /* ================================
       PRICE
    ================================= */

    .price-box {
        background: #f7faf7;
        border: 1px solid #e0ebe3;
        border-radius: 14px;
        padding: 18px;
        height: 100%;
    }

    .price-title {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 6px;
    }

    .main-price {
        font-size: 25px;
        font-weight: 700;
        color: #176b3a;
    }

    .old-price {
        color: #9ca3af;
        text-decoration: line-through;
        margin-left: 8px;
        font-size: 14px;
    }

    /* ================================
       IMAGES
    ================================= */

    .image-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .product-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        background: #f3f4f6;
        aspect-ratio: 1 / 1;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .image-number {
        position: absolute;
        top: 8px;
        left: 8px;
        background: rgba(0, 0, 0, .65);
        color: #fff;
        border-radius: 20px;
        padding: 4px 8px;
        font-size: 11px;
        font-weight: 600;
    }

    .image-placeholder {
        width: 180px;
        height: 180px;
        border-radius: 16px;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
    }

    .no-images {
        background: #f9fafb;
        border: 1px dashed #d1d5db;
        border-radius: 14px;
        padding: 35px 20px;
        text-align: center;
        color: #9ca3af;
    }

    .no-images i {
        font-size: 32px;
        display: block;
        margin-bottom: 8px;
    }

    /* ================================
       DESCRIPTION
    ================================= */

    .description-box {
        background: #f9fafb;
        border-radius: 12px;
        padding: 15px;
        color: #4b5563;
        font-size: 14px;
        line-height: 1.7;
        white-space: pre-line;
    }

    .description-title {
        color: #172018;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    /* ================================
       STATUS
    ================================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #e9f7ef;
        color: #176b3a;
        border-radius: 30px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .type-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 30px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .type-veg {
        background: #e9f7ef;
        color: #176b3a;
    }

    .type-nonveg {
        background: #fff1f1;
        color: #dc2626;
    }

    /* ================================
       FOOTER
    ================================= */

    .form-footer {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 18px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .btn-previous {
        background: #ffffff;
        color: #374151;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        padding: 11px 20px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-previous:hover {
        background: #f9fafb;
        color: #172018;
    }

    .btn-save {
        background: #176b3a;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-save:hover {
        background: #12582f;
        color: #ffffff;
    }

    /* ================================
       RESPONSIVE
    ================================= */

    @media(max-width: 767px) {

        .step {
            font-size: 0;
        }

        .step-number {
            width: 32px;
            height: 32px;
        }

        .step-line {
            margin: 0 8px;
        }

        .image-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .form-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-previous,
        .btn-save {
            width: 100%;
            text-align: center;
        }
    }
</style>


@php

$unitLabels = [
'kg' => 'KG',
'gram' => 'Gram',
'piece' => 'Piece',
'packet' => 'Packet',
'liter' => 'Liter',
];

$unitLabel = $unitLabels[$product->unit ?? ''] ?? 'Unit';

$price = (float) ($product->price ?? 0);

$discountPrice = $product->discount_price !== null
? (float) $product->discount_price
: null;

$discountPercentage = 0;

if ($discountPrice !== null && $price > 0) {

$discountPercentage = round(
(($price - $discountPrice) / $price) * 100
);
}

$images = $product->images ?? [];

@endphp


<div class="product-page">

    {{-- =========================================
        HEADER
    ========================================== --}}

    <div class="page-header">

        <h1 class="page-title">
            Review Product
        </h1>

        <div class="page-subtitle">
            Review your product information before saving.
        </div>

    </div>


    {{-- =========================================
        STEP INDICATOR
    ========================================== --}}

    <div class="step-wrapper">

        {{-- Step 1 --}}

        <div class="step completed">

            <div class="step-number">
                <i class="bi bi-check"></i>
            </div>

            <span>Basic</span>

        </div>


        <div class="step-line completed"></div>


        {{-- Step 2 --}}

        <div class="step completed">

            <div class="step-number">
                <i class="bi bi-check"></i>
            </div>

            <span>Pricing</span>

        </div>


        <div class="step-line completed"></div>


        {{-- Step 3 --}}

        <div class="step completed">

            <div class="step-number">
                <i class="bi bi-check"></i>
            </div>

            <span>Media</span>

        </div>


        <div class="step-line completed"></div>


        {{-- Step 4 --}}

        <div class="step active">

            <div class="step-number">
                4
            </div>

            <span>Review</span>

        </div>

    </div>


    {{-- =========================================
        BASIC INFORMATION
    ========================================== --}}

    <div class="review-card">

        <div class="review-card-header">

            <h5 class="review-card-title">
                Basic Information
            </h5>

            <a
                href="{{ route('product.step1', ['id' => $product->id]) }}"
                class="edit-link">

                <i class="bi bi-pencil me-1"></i>

                Edit

            </a>

        </div>


        <div class="review-body">

            <div class="row">

                {{-- Product Name --}}

                <div class="col-md-4">

                    <div class="info-item">

                        <div class="info-label">
                            Product Name
                        </div>

                        <div class="info-value">
                            {{ $product->name ?? '-' }}
                        </div>

                    </div>

                </div>


                {{-- Slug --}}

                <div class="col-md-4">

                    <div class="info-item">

                        <div class="info-label">
                            Slug
                        </div>

                        <div class="info-value">
                            {{ $product->slug ?? '-' }}
                        </div>

                    </div>

                </div>


                {{-- Product Type --}}

                <div class="col-md-4">

                    <div class="info-item">

                        <div class="info-label">
                            Product Type
                        </div>

                        <div class="info-value">

                            @if($product->type === 'veg')

                            <span class="type-badge type-veg">

                                <i class="bi bi-circle-fill"></i>

                                Veg

                            </span>

                            @else

                            <span class="type-badge type-nonveg">

                                <i class="bi bi-circle-fill"></i>

                                Non-Veg

                            </span>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Category --}}

                <div class="col-md-6">

                    <div class="info-item mb-0">

                        <div class="info-label">
                            Category
                        </div>

                        <div class="info-value">

                            {{ $product->category->name ?? '-' }}

                        </div>

                    </div>

                </div>


                {{-- Subcategory --}}

                <div class="col-md-6">

                    <div class="info-item mb-0">

                        <div class="info-label">
                            Subcategory
                        </div>

                        <div class="info-value">

                            {{ $product->subcategory->name ?? '-' }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================
        PRICING & STOCK
    ========================================== --}}

    <div class="review-card">

        <div class="review-card-header">

            <h5 class="review-card-title">
                Pricing & Stock
            </h5>

            <a
                href="{{ route('product.step2', ['id' => $product->id]) }}"
                class="edit-link">

                <i class="bi bi-pencil me-1"></i>

                Edit

            </a>

        </div>


        <div class="review-body">

            <div class="row g-3">

                {{-- Customer Price --}}

                <div class="col-md-4">

                    <div class="price-box">

                        <div class="price-title">
                            Customer Price
                        </div>

                        <div>

                            @if($discountPrice !== null)

                            <span class="main-price">

                                ₹{{ number_format($discountPrice, 2) }}

                            </span>

                            <span class="old-price">

                                ₹{{ number_format($price, 2) }}

                            </span>

                            @else

                            <span class="main-price">

                                ₹{{ number_format($price, 2) }}

                            </span>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Minimum Order --}}

                <div class="col-md-4">

                    <div class="price-box">

                        <div class="price-title">
                            Minimum Order
                        </div>

                        <div class="main-price">

                            {{ $product->minimum_order_qty ?? 0 }}

                            <small style="font-size:14px;">
                                {{ $unitLabel }}
                            </small>

                        </div>

                    </div>

                </div>


                {{-- Stock --}}

                <div class="col-md-4">

                    <div class="price-box">

                        <div class="price-title">
                            Available Stock
                        </div>

                        <div class="main-price">

                            {{ $product->stock ?? 0 }}

                            <small style="font-size:14px;">
                                {{ $unitLabel }}
                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Discount --}}

            @if($discountPercentage > 0)

            <div class="mt-3">

                <span class="status-badge">

                    <i class="bi bi-tag-fill"></i>

                    {{ $discountPercentage }}% OFF

                </span>

            </div>

            @endif

        </div>

    </div>


    {{-- =========================================
        MEDIA & DESCRIPTION
    ========================================== --}}

    <div class="review-card">

        <div class="review-card-header">

            <h5 class="review-card-title">
                Media & Description
            </h5>

            <a
                href="{{ route('product.step3', ['id' => $product->id]) }}"
                class="edit-link">

                <i class="bi bi-pencil me-1"></i>

                Edit

            </a>

        </div>


        <div class="review-body">

            <div class="row g-4 align-items-start">


                {{-- Images --}}

                <div class="col-md-5">

                    <div class="info-label mb-2">
                        Product Images
                    </div>


                    @if(!empty($images))

                    <div class="image-grid">

                        @foreach($images as $index => $image)

                        <div class="product-image-wrapper">

                            <img
                                src="{{ asset($image) }}"
                                class="product-image"
                                alt="{{ $product->name }}">

                            <span class="image-number">
                                {{ $index + 1 }}
                            </span>

                        </div>

                        @endforeach

                    </div>

                    @else

                    <div class="no-images">

                        <i class="bi bi-image"></i>

                        <div>
                            No product images added.
                        </div>

                    </div>

                    @endif

                </div>


                {{-- Description --}}

                <div class="col-md-7">


                    {{-- Short Description --}}

                    <div class="mb-4">

                        <div class="description-title">
                            Short Description
                        </div>

                        @if(!empty($product->short_desc))

                        <div class="description-box">

                            {{ $product->short_desc }}

                        </div>

                        @else

                        <div class="description-box">

                            No short description added.

                        </div>

                        @endif

                    </div>


                    {{-- Long Description --}}

                    <div>

                        <div class="description-title">
                            Detailed Description
                        </div>

                        @if(!empty($product->long_desc))

                        <div class="description-box">

                            {{ $product->long_desc }}

                        </div>

                        @else

                        <div class="description-box">

                            No detailed description added.

                        </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================
        FINAL SAVE
    ========================================== --}}

    <form
        action="{{ route('product.store', ['id' => $product->id]) }}"
        method="POST">

        @csrf

        <div class="form-footer">


            {{-- Previous --}}

            <a
                href="{{ route('product.step3', ['id' => $product->id]) }}"
                class="btn-previous">

                <i class="bi bi-arrow-left me-1"></i>

                Previous

            </a>


            {{-- Save Product --}}

            <a href="{{ route('admin.product') }}"
                class="btn-save">

                <i class="bi bi-check-circle me-1"></i>

                Save Product

            </a>

        </div>

    </form>

</div>

@endsection