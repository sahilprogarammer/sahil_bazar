@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')

<div class="page-wrapper">

    <!-- =========================================
         PAGE HEADER
    ========================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <div class="page-title">
                SubCategories
            </div>

            <div class="page-subtitle">
                Manage product SubCategories and their status
            </div>
        </div>


        <!-- Add Category -->
        <button
            type="button"
            class="add-btn"
            data-bs-toggle="modal"
            data-bs-target="#categoryModal"
            title="Add Category">
            <i class="bi bi-plus-lg"></i>
        </button>

    </div>


    <!-- =========================================
         CATEGORY TABLE CARD
    ========================================== -->

    <div class="premium-card">

        <!-- Card Header -->

        <div class="card-header-custom">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <strong>
                        All SubCategories
                    </strong>

                    <div class="page-subtitle">

                        {{ $categories->count() }} categories

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
                            SubCategories
                        </th>

                        <th>
                            Type
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

                    @forelse($subcategories as $subcategory)

                    <tr>

                        <!-- =================================
                             CATEGORY
                        ================================== -->

                        <td>

                            <div class="category-wrapper">

                                <!-- Image -->

                                <div class="category-image">

                                    @if($subcategory->image)

                                    <img
                                        src="{{ asset($subcategory->image) }}"
                                        alt="{{ $subcategory->name }}">

                                    @else

                                    <div class="category-placeholder">

                                        <i class="bi bi-grid"></i>

                                    </div>

                                    @endif

                                </div>


                                <!-- Name -->

                                <div>

                                    <div class="category-name">

                                        {{ $subcategory->name }}

                                    </div>

                                    <div class="category-id">

                                        #{{ $subcategory->id }}

                                    </div>

                                </div>

                            </div>

                        </td>


                        <!-- =================================
                             TYPE
                        ================================== -->

                        <td>

                            @if($subcategory->type === 'nonveg')

                            <span class="type-badge type-nonveg">

                                <i class="bi bi-egg-fried"></i>

                                Nonveg

                            </span>

                            @elseif($subcategory->type === 'veg')

                            <span class="type-badge type-veg">

                                <i class="bi bi-leaf"></i>

                                Veg

                            </span>

                            @else

                            <span class="type-badge">

                                {{ ucfirst($subcategory->type) }}

                            </span>

                            @endif

                        </td>


                        <!-- =================================
                             STATUS
                        ================================== -->

                        <td>

                            @if($subcategory->status === 'active')

                            <span class="status status-active">

                                <span class="status-dot"></span>

                                Active

                            </span>

                            @else

                            <span class="status status-inactive">

                                <span class="status-dot"></span>

                                Inactive

                            </span>

                            @endif

                        </td>


                        <!-- =================================
                             CREATED
                        ================================== -->

                        <td>

                            <div class="created-date">

                                {{ $subcategory->created_at?->format('d M Y') }}

                            </div>

                            <div class="created-time">

                                {{ $subcategory->created_at?->format('h:i A') }}

                            </div>

                        </td>


                        <!-- =================================
                             ACTIONS
                        ================================== -->

                        <td>

                            <div class="action-wrapper">

                                <!-- Edit -->

                                <button
                                    type="button"
                                    class="icon-btn edit-btn"
                                    title="Edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editSubcategoryModal{{ $subcategory->id }}">

                                    <i class="bi bi-pencil"></i>

                                </button>


                                <!-- Delete -->

                                <form
                                    action=""
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this category?');">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="icon-btn delete-btn"
                                        title="Delete">

                                        <i class="bi bi-trash3"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                    <!-- =========================================
                         EDIT CATEGORY MODAL
                    ========================================== -->

                    <!-- Edit Subcategory Modal -->
<div
    class="modal fade"
    id="editSubcategoryModal{{ $subcategory->id }}"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">

                <div>
                    <h5 class="modal-title mb-1">
                        Edit Subcategory
                    </h5>

                    <div class="page-subtitle">
                        Update subcategory information
                    </div>
                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>


            <!-- Form -->
            <form
                action="{{ route('admin.subcategory.save') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <!-- Subcategory ID -->
                <input
                    type="hidden"
                    name="id"
                    value="{{ $subcategory->id }}">


                <div class="modal-body">

                    <!-- Category -->
                    <div class="mb-3">

                        <label class="form-label">
                            Category
                        </label>

                        <select
                            name="category_id"
                            class="form-select"
                            required>

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- Subcategory Name -->
                    <div class="mb-3">

                        <label class="form-label">
                            Subcategory Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ $subcategory->name }}"
                            placeholder="Enter subcategory name"
                            required>

                    </div>


                    <!-- Slug -->
                    <div class="mb-3">

                        <label class="form-label">
                            Slug
                        </label>

                        <input
                            type="text"
                            name="slug"
                            class="form-control"
                            value="{{ $subcategory->slug }}"
                            placeholder="subcategory-slug"
                            required>

                    </div>


                    <!-- Type + Status -->
                    <div class="row">

                        <!-- Type -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Type
                            </label>

                            <select
                                name="type"
                                class="form-select"
                                required>

                                <option
                                    value="nonveg"
                                    {{ $subcategory->type === 'nonveg' ? 'selected' : '' }}>
                                    Nonveg
                                </option>

                                <option
                                    value="veg"
                                    {{ $subcategory->type === 'veg' ? 'selected' : '' }}>
                                    Veg
                                </option>

                            </select>

                        </div>


                        <!-- Status -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select"
                                required>

                                <option
                                    value="active"
                                    {{ $subcategory->status === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option
                                    value="inactive"
                                    {{ $subcategory->status === 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- Image -->
                    <div class="mb-3">

                        <label class="form-label">
                            Subcategory Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept="image/jpeg,image/png,image/webp">

                        @if($subcategory->image)

                            <div class="mt-2 d-flex align-items-center">

                                <img
                                    src="{{ asset($subcategory->image) }}"
                                    alt="{{ $subcategory->name }}"
                                    style="
                                        width:70px;
                                        height:70px;
                                        object-fit:cover;
                                        border-radius:10px;
                                        border:1px solid #e5e7eb;
                                    ">

                                <small class="text-muted ms-2">
                                    Current image
                                </small>

                            </div>

                        @endif

                    </div>


                    <!-- Description -->
                    <div class="mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="3"
                            placeholder="Enter subcategory description">{{ $subcategory->description }}</textarea>

                    </div>

                </div>


                <!-- Footer -->
                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="save-btn">

                        <i class="bi bi-check-lg me-1"></i>

                        Update Subcategory

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

                    @empty

                    <!-- Empty -->

                    <tr>

                        <td
                            colspan="7"
                            class="text-center py-5">

                            <div class="empty-state">

                                <div class="empty-icon">

                                    <i class="bi bi-grid"></i>

                                </div>

                                <h6>
                                    No categories found
                                </h6>

                                <p>
                                    Create your first category to get started.
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>



<!-- =========================================
     ADD SubCategories MODAL
========================================== -->

<div
    class="modal fade"
    id="categoryModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <div>

                    <h5 class="modal-title mb-1">
                        Add Subcategory
                    </h5>

                    <div class="page-subtitle">
                        Create a new product subcategory
                    </div>

                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>


            <form
                action="{{ route('admin.subcategory.save') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                <div class="modal-body">

                    <!-- Parent Category -->

                    <div class="mb-3">

                        <label class="form-label">
                            Parent Category
                        </label>

                        <select
                            name="category_id"
                            class="form-select"
                            required>

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- Subcategory Name -->

                    <div class="mb-3">

                        <label class="form-label">
                            Subcategory Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="e.g. Chicken Breast"
                            required>

                    </div>


                    <!-- Slug -->

                    <div class="mb-3">

                        <label class="form-label">
                            Slug
                        </label>

                        <input
                            type="text"
                            name="slug"
                            class="form-control"
                            placeholder="e.g. chicken-breast">

                    </div>


                    <div class="row">

                        <!-- Type -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Type
                            </label>

                            <select
                                name="type"
                                class="form-select"
                                required>

                                <option value="nonveg">
                                    Nonveg
                                </option>

                                <option value="veg">
                                    Veg
                                </option>

                            </select>

                        </div>


                        <!-- Status -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select"
                                required>

                                <option value="active">
                                    Active
                                </option>

                                <option value="inactive">
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- Image -->

                    <div class="mb-3">

                        <label class="form-label">
                            Subcategory Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept="image/*">

                        <small class="text-muted">
                            Recommended size: 500 × 500 px
                        </small>

                    </div>


                    <!-- Description -->

                    <div class="mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="3"
                            placeholder="Enter subcategory description"></textarea>

                    </div>

                </div>


                <!-- Footer -->

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="save-btn">

                        <i class="bi bi-plus-lg me-1"></i>

                        Save Subcategory

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


@endsection