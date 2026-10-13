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
                Categories
            </div>

            <div class="page-subtitle">
                Manage product categories and their status
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
                        All Categories
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
                            Category
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

                    @forelse($categories as $category)

                    <tr>

                        <!-- =================================
                             CATEGORY
                        ================================== -->

                        <td>

                            <div class="category-wrapper">

                                <!-- Image -->

                                <div class="category-image">

                                    @if($category->image)

                                    <img
                                        src="{{ asset($category->image) }}"
                                        alt="{{ $category->name }}">

                                    @else

                                    <div class="category-placeholder">

                                        <i class="bi bi-grid"></i>

                                    </div>

                                    @endif

                                </div>


                                <!-- Name -->

                                <div>

                                    <div class="category-name">

                                        {{ $category->name }}

                                    </div>

                                    <div class="category-id">

                                        #{{ $category->id }}

                                    </div>

                                </div>

                            </div>

                        </td>


                        <!-- =================================
                             TYPE
                        ================================== -->

                        <td>

                            @if($category->type === 'nonveg')

                            <span class="type-badge type-nonveg">

                                <i class="bi bi-egg-fried"></i>

                                Nonveg

                            </span>

                            @elseif($category->type === 'veg')

                            <span class="type-badge type-veg">

                                <i class="bi bi-leaf"></i>

                                Veg

                            </span>

                            @else

                            <span class="type-badge">

                                {{ ucfirst($category->type) }}

                            </span>

                            @endif

                        </td>


                        <!-- =================================
                             STATUS
                        ================================== -->

                        <td>

                            @if($category->status === 'active')

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

                                {{ $category->created_at?->format('d M Y') }}

                            </div>

                            <div class="created-time">

                                {{ $category->created_at?->format('h:i A') }}

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
                                    data-bs-target="#editCategoryModal{{ $category->id }}">

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

                    <div
                        class="modal fade"
                        id="editCategoryModal{{ $category->id }}"
                        tabindex="-1"
                        aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <div>

                                        <h5 class="modal-title mb-1">
                                            Edit Category
                                        </h5>

                                        <div class="page-subtitle">
                                            Update category information
                                        </div>

                                    </div>

                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"></button>

                                </div>


                                <form
                                    action="{{ route('admin.category.save') }}"
                                    method="POST"
                                    enctype="multipart/form-data">

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="{{ $category->id }}">

                                    <div class="modal-body">

                                        <!-- Category Name -->

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Category Name
                                            </label>

                                            <input
                                                type="text"
                                                name="name"
                                                class="form-control"
                                                value="{{ $category->name }}"
                                                placeholder="Enter category name"
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
                                                value="{{ $category->slug }}"
                                                placeholder="category-slug"
                                                required>

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

                                                    <option
                                                        value="nonveg"
                                                        {{ $category->type === 'nonveg' ? 'selected' : '' }}>
                                                        Nonveg
                                                    </option>

                                                    <option
                                                        value="veg"
                                                        {{ $category->type === 'veg' ? 'selected' : '' }}>
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
                                                        {{ $category->status === 'active' ? 'selected' : '' }}>
                                                        Active
                                                    </option>

                                                    <option
                                                        value="inactive"
                                                        {{ $category->status === 'inactive' ? 'selected' : '' }}>
                                                        Inactive
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        <!-- Image -->

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Category Image
                                            </label>

                                            <input
                                                type="file"
                                                name="image"
                                                class="form-control"
                                                accept="image/*">

                                            @if($category->image)

                                            <div class="mt-2">

                                                <img
                                                    src="{{ asset($category->image) }}"
                                                    alt="{{ $category->name }}"
                                                    style="
                            width:70px;
                            height:70px;
                            object-fit:cover;
                            border-radius:10px;
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
                                                placeholder="Enter category description">{{ $category->description }}</textarea>

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
                                            Update Category
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
     ADD CATEGORY MODAL
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
                        Add Category
                    </h5>

                    <div class="page-subtitle">
                        Create a new product category
                    </div>

                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"></button>

            </div>


            <form
                action="{{ route('admin.category.save') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                <div class="modal-body">

                    <!-- Category Name -->

                    <div class="mb-3">

                        <label class="form-label">
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="e.g. Chicken"
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
                            placeholder="e.g. chicken">

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
                            Category Image
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
                            placeholder="Enter category description"></textarea>

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
                        Save Category
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


@endsection