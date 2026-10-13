@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')

<div class="page-wrapper">


    <!-- =========================================
     PAGE HEADER
========================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <div class="page-title">
                Products
            </div>

            <div class="page-subtitle">
                Manage products and their status
            </div>

        </div>


        <!-- Add Product -->

        <a href="{{ route('product.step1') }}"
            class="add-btn"
            title="Add Product">

            <i class="bi bi-plus-lg"></i>

        </a>

    </div>


    <!-- =========================================
     PRODUCT TABLE CARD
========================================== -->

    <div class="premium-card">

        <!-- Card Header -->

        <div class="card-header-custom">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <strong>
                        All Products
                    </strong>

                    <div class="page-subtitle">

                        {{ $products->total() }} Products

                    </div>

                </div>

            </div>

        </div>


        <!-- =========================================
         TABLE
    ========================================== -->

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>
                            Product
                        </th>

                        <th>
                            Category
                        </th>

                        <th>
                            Subcategory
                        </th>

                        <th>
                            Type
                        </th>

                        <th>
                            Price
                        </th>

                        <th>
                            Unit
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Created
                        </th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($products as $product)

                    <tr>

                        <!-- Product -->

                        <td>

                            <div class="d-flex align-items-center gap-2">

                                @php
                                $images = $product->images ?? [];

                                if (is_string($images)) {
                                $images = json_decode($images, true) ?? [];
                                }
                                @endphp


                                @if(!empty($images))

                                <img
                                    src="{{ asset($images[0]) }}"
                                    alt="{{ $product->name }}"
                                    width="50"
                                    height="50"
                                    style="object-fit: cover; border-radius: 8px;">

                                @else

                                <div
                                    style="width:50px; height:50px; background:#f3f4f6; border-radius:8px; display:flex; align-items:center; justify-content:center;">

                                    <i class="bi bi-image text-muted"></i>

                                </div>

                                @endif


                                <div>

                                    <div class="fw-semibold">

                                        {{ $product->name }}

                                    </div>

                                    <small class="text-muted">

                                        {{ $product->slug }}

                                    </small>

                                </div>

                            </div>

                        </td>


                        <!-- Category -->

                        <td>

                            {{ $product->category->name ?? '-' }}

                        </td>


                        <!-- Subcategory -->

                        <td>

                            {{ $product->subcategory->name ?? '-' }}

                        </td>


                        <!-- Type -->

                        <td>

                            @if($product->type === 'veg')

                            <span class="badge bg-success">
                                Veg
                            </span>

                            @else

                            <span class="badge bg-danger">
                                Non-Veg
                            </span>

                            @endif

                        </td>


                        <!-- Price -->

                        <td>

                            @if($product->discount_price)

                            <strong>
                                ₹{{ number_format($product->discount_price, 2) }}
                            </strong>

                            <small class="text-muted text-decoration-line-through">

                                ₹{{ number_format($product->price, 2) }}

                            </small>

                            @else

                            <strong>
                                ₹{{ number_format($product->price, 2) }}
                            </strong>

                            @endif

                        </td>


                        <!-- Stock -->

                        <td>

                            {{ $product->stock }}

                            {{ strtoupper($product->unit) }}

                        </td>


                        <!-- Status -->

                        <td>

                            <form
                                action="{{ route('product.toggleStatus', $product->id) }}"
                                method="POST">
                                @csrf

                                @if($product->status === 'active')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-success">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Active
                                </button>

                                @else

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-secondary">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Inactive
                                </button>

                                @endif

                            </form>

                        </td>


                        <!-- Created -->

                        <td>

                            {{ $product->created_at->format('d M Y') }}

                        </td>


                        <!-- Actions -->

                        <td class="text-end">

                            <div class="d-flex justify-content-end gap-2">

                                {{-- Edit Dropdown --}}

                                <div class="dropdown">

                                    <button
                                        type="button"
                                        class="btn btn-sm"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        title="Edit Product">

                                        <i class="bi bi-pencil"></i>

                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">

                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="{{ route('product.step1', ['id' => $product->id]) }}">

                                                <i class="bi bi-info-circle me-2"></i>
                                                Basic Information

                                            </a>
                                        </li>

                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="{{ route('product.step2', ['id' => $product->id]) }}">

                                                <i class="bi bi-currency-rupee me-2"></i>
                                                Pricing & Stock

                                            </a>
                                        </li>

                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="{{ route('product.step3', ['id' => $product->id]) }}">

                                                <i class="bi bi-images me-2"></i>
                                                Media & Description

                                            </a>
                                        </li>

                                    </ul>

                                </div>


                                {{-- View --}}

                                <a
                                    href="{{ route('product.step4', ['id' => $product->id]) }}"
                                    title="View Product">

                                    <i class="bi bi-eye"></i>

                                </a>


                                {{-- Delete --}}

                                <!-- <form
                                    action="{{ route('product.delete', ['id' => $product->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        title="Delete Product"
                                        class="border-0 bg-transparent p-0">

                                        <i class="bi bi-trash text-danger"></i>

                                    </button>

                                </form> -->

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="9" class="text-center py-5">

                            <i class="bi bi-box-seam fs-1 text-muted"></i>

                            <div class="mt-2 text-muted">

                                No products found.

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- =========================================
         PAGINATION
    ========================================== -->

        @if($products->hasPages())

        <div class="p-3">

            {{ $products->links() }}

        </div>

        @endif

    </div>


</div>

@endsection