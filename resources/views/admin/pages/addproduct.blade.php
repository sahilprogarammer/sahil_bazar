@extends('admin.layouts.app')

@section('title', 'Add Product')

@section('content')

<div class="page-wrapper">


<!-- Page Header -->
<div class="page-header">

    <div>
        <h1 class="page-title">Add Product</h1>

        <p class="page-subtitle">
            Create a new product for your store
        </p>
    </div>

    <a href="{{ url()->previous() }}" class="back-btn">
        <i class="bi bi-arrow-left"></i>
        Back
    </a>

</div>


<!-- Product Form Card -->
<div class="product-card">

    <form
        action="{{ route('admin.product.save') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="form-section">

            <div class="section-title">
                <div class="section-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div>
                    <h3>Product Information</h3>
                    <p>Basic information about your product</p>
                </div>
            </div>


            <div class="row">

                <!-- Product Name -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Product Name <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        placeholder="Enter product name"
                        required>

                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                <!-- Slug -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Slug <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="slug"
                        class="form-control"
                        value="{{ old('slug') }}"
                        placeholder="product-slug"
                        required>

                    @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                <!-- Category -->
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
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                <!-- Subcategory -->
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
                                {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>

                                {{ $subcategory->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('subcategory_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                <!-- Product Type -->
                <div class="col-md-4 mb-3">

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
                            {{ old('type') == 'veg' ? 'selected' : '' }}>
                            Veg
                        </option>

                        <option
                            value="nonveg"
                            {{ old('type') == 'nonveg' ? 'selected' : '' }}>
                            Nonveg
                        </option>

                    </select>

                </div>


                <!-- Unit -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Unit <span>*</span>
                    </label>

                    <select
                        name="unit"
                        class="form-select"
                        required>

                        <option value="">
                            Select Unit
                        </option>

                        <option value="kg">KG</option>
                        <option value="gram">Gram</option>
                        <option value="piece">Piece</option>
                        <option value="packet">Packet</option>
                        <option value="liter">Liter</option>

                    </select>

                </div>


                <!-- Status -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Status <span>*</span>
                    </label>

                    <select
                        name="status"
                        class="form-select"
                        required>

                        <option
                            value="active"
                            {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option
                            value="inactive"
                            {{ old('status') == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>

            </div>

        </div>


        <!-- Pricing -->
        <div class="form-section">

            <div class="section-title">

                <div class="section-icon">
                    <i class="bi bi-currency-rupee"></i>
                </div>

                <div>
                    <h3>Pricing & Stock</h3>
                    <p>Set product price and inventory</p>
                </div>

            </div>


            <div class="row">

                <!-- Price -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Price <span>*</span>
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            ₹
                        </span>

                        <input
                            type="number"
                            name="price"
                            class="form-control"
                            value="{{ old('price') }}"
                            min="0"
                            step="0.01"
                            placeholder="0.00"
                            required>

                    </div>

                </div>


                <!-- Discount Price -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Discount Price
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            ₹
                        </span>

                        <input
                            type="number"
                            name="discount_price"
                            class="form-control"
                            value="{{ old('discount_price') }}"
                            min="0"
                            step="0.01"
                            placeholder="0.00">

                    </div>

                </div>


                <!-- Stock -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Stock <span>*</span>
                    </label>

                    <input
                        type="number"
                        name="stock"
                        class="form-control"
                        value="{{ old('stock', 0) }}"
                        min="0"
                        placeholder="Enter stock quantity"
                        required>

                </div>

            </div>

        </div>


        <!-- Product Image -->
        <div class="form-section">

            <div class="section-title">

                <div class="section-icon">
                    <i class="bi bi-image"></i>
                </div>

                <div>
                    <h3>Product Image</h3>
                    <p>Upload a clear product image</p>
                </div>

            </div>


            <div class="image-upload">

                <div class="upload-icon">
                    <i class="bi bi-cloud-arrow-up"></i>
                </div>

                <h4>Upload Product Image</h4>

                <p>
                    JPG, PNG or WEBP · Maximum 2MB
                </p>

                <input
                    type="file"
                    name="image"
                    id="productImage"
                    accept="image/jpeg,image/png,image/webp"
                    class="form-control">

            </div>

        </div>


        <!-- Description -->
        <div class="form-section">

            <div class="section-title">

                <div class="section-icon">
                    <i class="bi bi-text-paragraph"></i>
                </div>

                <div>
                    <h3>Description</h3>
                    <p>Describe your product</p>
                </div>

            </div>


            <textarea
                name="description"
                class="form-control"
                rows="5"
                placeholder="Enter product description...">{{ old('description') }}</textarea>

        </div>


        <!-- Footer -->
        <div class="form-footer">

            <a
                href="{{ url()->previous() }}"
                class="cancel-btn">

                Cancel

            </a>

            <button
                type="submit"
                class="save-btn">

                <i class="bi bi-check-lg"></i>

                Save Product

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
   CARD
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
    box-shadow: 0 0 0 3px rgba(23, 107, 58, .08) !important;
}

textarea.form-control {
    min-height: auto;
    resize: vertical;
}

.input-group-text {
    background: #f7f9f7;
    border-color: #dfe5df;
    color: #176b3a;
    font-weight: 600;
}


/* =========================================
   IMAGE UPLOAD
========================================= */

.image-upload {
    border: 1.5px dashed #cfd8d0;
    border-radius: 14px;
    padding: 30px;
    text-align: center;
    background: #fafcf9;
}

.upload-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: #edf7ef;
    color: #176b3a;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    font-size: 23px;
}

.image-upload h4 {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 5px;
}

.image-upload p {
    color: #7b837c;
    font-size: 12px;
    margin-bottom: 18px;
}

.image-upload .form-control {
    max-width: 420px;
    margin: auto;
    background: #fff;
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

.save-btn {
    border: 0;
    padding: 11px 21px;
    border-radius: 10px;
    background: #176b3a;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
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

    .back-btn {
        padding: 9px 12px;
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

    .section-title {
        align-items: flex-start;
    }

    .section-icon {
        flex-shrink: 0;
    }

    .image-upload {
        padding: 22px 15px;
    }

    .form-footer {
        flex-direction: column-reverse;
    }

    .cancel-btn,
    .save-btn {
        width: 100%;
        text-align: center;
    }

}

</style>

<script>

/* =========================================
   FILTER SUBCATEGORIES
========================================= */

document.addEventListener('DOMContentLoaded', function () {

    const category = document.getElementById('category_id');
    const subcategory = document.getElementById('subcategory_id');

    if (!category || !subcategory) {
        return;
    }

    const options = Array.from(
        subcategory.querySelectorAll('option[data-category]')
    );

    function filterSubcategories() {

        const categoryId = category.value;

        options.forEach(function (option) {

            if (option.dataset.category === categoryId) {
                option.hidden = false;
            } else {
                option.hidden = true;
            }

        });

        const selected = subcategory.querySelector(
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
