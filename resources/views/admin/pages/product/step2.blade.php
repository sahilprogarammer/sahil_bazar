@extends('admin.layouts.app')

@section('title', 'Add Product - Pricing & Stock')

@section('content')

<div class="page-wrapper">

    {{-- =========================================
         PAGE HEADER
    ========================================== --}}

    <div class="page-header">

        <div>
            <h1 class="page-title">
                Add Product
            </h1>

            <p class="page-subtitle">
                Step 2 of 4 · Pricing & stock
            </p>
        </div>

        <a
            href="{{ route('product.step1') }}"
            class="back-btn">

            <i class="bi bi-arrow-left"></i>

            Start Over

        </a>

    </div>


    {{-- =========================================
         STEP INDICATOR
    ========================================== --}}

    <div class="step-card">

        {{-- Step 1 --}}
        <a
            href="{{ route('product.step1', ['id' => $product->id]) }}"
            class="step-item completed">

            <div class="step-number">

                <i class="bi bi-check-lg"></i>

            </div>

            <div class="step-content">

                <strong>
                    Basic Info
                </strong>

                <span>
                    Product details
                </span>

            </div>

        </a>


        <div class="step-line completed-line"></div>


        {{-- Step 2 --}}
        <div class="step-item active">

            <div class="step-number">
                2
            </div>

            <div class="step-content">

                <strong>
                    Pricing
                </strong>

                <span>
                    Price & stock
                </span>

            </div>

        </div>


        <div class="step-line"></div>


        {{-- Step 3 --}}
        <div class="step-item">

            <div class="step-number">
                3
            </div>

            <div class="step-content">

                <strong>
                    Media
                </strong>

                <span>
                    Image & details
                </span>

            </div>

        </div>


        <div class="step-line"></div>


        {{-- Step 4 --}}
        <div class="step-item">

            <div class="step-number">
                4
            </div>

            <div class="step-content">

                <strong>
                    Review
                </strong>

                <span>
                    Save product
                </span>

            </div>

        </div>

    </div>


    {{-- =========================================
         PRODUCT CARD
    ========================================== --}}

    <div class="product-card">

        <form
            action="{{ route('product.step2.save', $product->id) }}"
            method="POST">

            @csrf


            {{-- =====================================
                 PRICING & STOCK
            ====================================== --}}

            <div class="form-section">

                <div class="section-title">

                    <div class="section-icon">

                        <i class="bi bi-currency-rupee"></i>

                    </div>

                    <div>

                        <h3>
                            Pricing & Stock
                        </h3>

                        <p>
                            Set the selling price and inventory
                        </p>

                    </div>

                </div>


                <div class="row">


                    {{-- =================================
                         UNIT
                    ================================== --}}

                    <div class="col-md-6 mb-4">

                        <label class="form-label">

                            Unit <span>*</span>

                        </label>

                        <select
                            name="unit"
                            id="unit"
                            class="form-select"
                            required>

                            <option value="">
                                Select Unit
                            </option>

                            <option
                                value="kg"
                                {{ old('unit', $product->unit) == 'kg' ? 'selected' : '' }}>

                                KG

                            </option>

                            <option
                                value="gram"
                                {{ old('unit', $product->unit) == 'gram' ? 'selected' : '' }}>

                                Gram

                            </option>

                            <option
                                value="piece"
                                {{ old('unit', $product->unit) == 'piece' ? 'selected' : '' }}>

                                Piece

                            </option>

                            <option
                                value="packet"
                                {{ old('unit', $product->unit) == 'packet' ? 'selected' : '' }}>

                                Packet

                            </option>

                            <option
                                value="liter"
                                {{ old('unit', $product->unit) == 'liter' ? 'selected' : '' }}>

                                Liter

                            </option>

                        </select>


                        @error('unit')

                            <small class="text-danger">
                                {{ $message }}
                            </small>

                        @enderror


                        <div class="input-help">

                            Select how this product is sold.

                        </div>

                    </div>



                    {{-- =================================
                         PRICE
                    ================================== --}}

                    <div class="col-md-6 mb-4">

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
                                id="price"
                                class="form-control"
                                value="{{ old('price', $product->price) }}"
                                min="0"
                                step="0.01"
                                placeholder="0.00"
                                required>

                        </div>


                        @error('price')

                            <small class="text-danger">
                                {{ $message }}
                            </small>

                        @enderror


                        <div class="input-help">

                            Regular selling price.

                        </div>

                    </div>



                    {{-- =================================
                         DISCOUNT PRICE
                    ================================== --}}

                    <div class="col-md-6 mb-4">

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
                                id="discount_price"
                                class="form-control"
                                value="{{ old('discount_price', $product->discount_price) }}"
                                min="0"
                                step="0.01"
                                placeholder="0.00">

                        </div>


                        @error('discount_price')

                            <small class="text-danger">
                                {{ $message }}
                            </small>

                        @enderror


                        <div class="input-help">

                            Leave empty if there is no discount.

                        </div>

                    </div>



                    {{-- =================================
                         MINIMUM ORDER QUANTITY
                    ================================== --}}

                    <div class="col-md-6 mb-4">

                        <label class="form-label">

                            Minimum Order Quantity
                            <span>*</span>

                        </label>


                        <div class="input-group">

                            <input
                                type="number"
                                name="minimum_order_qty"
                                id="minimum_order_qty"
                                class="form-control"
                                value="{{ old(
                                    'minimum_order_qty',
                                    $product->minimum_order_qty ?? 0.5
                                ) }}"
                                min="0.01"
                                step="0.01"
                                placeholder="Example: 0.5"
                                required>


                            <span
                                class="input-group-text"
                                id="unitLabel">

                                {{ $product->unit
                                    ? strtoupper($product->unit)
                                    : 'Unit'
                                }}

                            </span>

                        </div>


                        @error('minimum_order_qty')

                            <small class="text-danger">
                                {{ $message }}
                            </small>

                        @enderror


                        <div class="input-help">

                            Minimum quantity a customer must order.

                        </div>

                    </div>

                </div>

            </div>



            {{-- =====================================
                 FOOTER
            ====================================== --}}

            <div class="form-footer">


                {{-- Previous --}}

                <a
                    href="{{ route(
                        'product.step1',
                        ['id' => $product->id]
                    ) }}"
                    class="previous-btn">

                    <i class="bi bi-arrow-left"></i>

                    Previous

                </a>



                {{-- Next --}}

                <button
                    type="submit"
                    class="save-btn">

                    Next

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
    text-decoration: none;
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

.step-item.completed .step-number {
    background: #e8f5eb;
    color: #176b3a;
}

.step-content {
    display: flex;
    flex-direction: column;
}

.step-content strong {
    font-size: 13px;
    color: #303730;
}

.step-item.active .step-content strong,
.step-item.completed .step-content strong {
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

.step-line.completed-line {
    background: #176b3a;
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
        0 0 0 3px rgba(23, 107, 58, .08)
        !important;
}


/* =========================================
   INPUT GROUP
========================================= */

.input-group-text {
    background: #f7f9f7;
    border-color: #dfe5df;
    color: #176b3a;
    font-weight: 600;
}

.input-group > .input-group-text:first-child {
    border-radius: 10px 0 0 10px;
}

.input-group > .input-group-text:last-child {
    border-radius: 0 10px 10px 0;
}

.input-group .form-control {
    border-radius: 0;
}

.input-group > .form-control:first-child {
    border-radius: 10px 0 0 10px;
}


/* =========================================
   HELP TEXT
========================================= */

.input-help {
    margin-top: 6px;
    color: #8a918b;
    font-size: 11px;
}


/* =========================================
   PRICE PREVIEW
========================================= */

.price-preview {
    margin-top: 5px;
    padding: 17px;
    border-radius: 13px;
    background: #f7faf7;
    border: 1px solid #e4ebe4;
    display: flex;
    align-items: center;
    gap: 12px;
}

.preview-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #e8f5eb;
    color: #176b3a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.preview-content {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.preview-content span {
    font-size: 11px;
    color: #7a827b;
}

.preview-content strong {
    font-size: 18px;
    color: #176b3a;
    margin-top: 2px;
}

.discount-info {
    font-size: 12px;
    font-weight: 600;
    color: #176b3a;
}


/* =========================================
   FOOTER
========================================= */

.form-footer {
    padding: 20px 26px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    background: #fcfdfc;
}

.previous-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 20px;
    border-radius: 10px;
    border: 1px solid #dfe4df;
    background: #fff;
    color: #4b5563;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
}

.previous-btn:hover {
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

    .price-preview {
        flex-wrap: wrap;
    }

    .discount-info {
        width: 100%;
        margin-left: 52px;
    }

    .form-footer {
        flex-direction: row;
    }

    .previous-btn,
    .save-btn {
        flex: 1;
        justify-content: center;
        text-align: center;
    }

}

</style>



<script>

/* =========================================
   PRICE CALCULATION
========================================= */

document.addEventListener('DOMContentLoaded', function () {

    const price =
        document.getElementById('price');

    const discount =
        document.getElementById('discount_price');

    const customerPrice =
        document.getElementById('customerPrice');

    const discountText =
        document.getElementById('discountText');


    function updatePrice() {

        let regularPrice =
            parseFloat(price.value) || 0;

        let discountPrice =
            parseFloat(discount.value) || 0;


        let finalPrice =
            discountPrice > 0
                ? discountPrice
                : regularPrice;


        customerPrice.textContent =
            '₹' + finalPrice.toFixed(2);


        if (
            discountPrice > 0 &&
            regularPrice > 0 &&
            discountPrice < regularPrice
        ) {

            let percentage =
                (
                    (regularPrice - discountPrice)
                    / regularPrice
                ) * 100;


            discountText.textContent =
                Math.round(percentage) +
                '% OFF';

        } else {

            discountText.textContent =
                'No discount';

        }

    }


    price.addEventListener(
        'input',
        updatePrice
    );

    discount.addEventListener(
        'input',
        updatePrice
    );


    updatePrice();

});



/* =========================================
   DISCOUNT VALIDATION
========================================= */

document.addEventListener('DOMContentLoaded', function () {

    const price =
        document.getElementById('price');

    const discount =
        document.getElementById('discount_price');


    function validateDiscount() {

        const regularPrice =
            parseFloat(price.value) || 0;

        const discountPrice =
            parseFloat(discount.value) || 0;


        if (
            discountPrice > 0 &&
            regularPrice > 0 &&
            discountPrice >= regularPrice
        ) {

            discount.setCustomValidity(
                'Discount price must be less than the regular price.'
            );

        } else {

            discount.setCustomValidity('');

        }

    }


    discount.addEventListener(
        'input',
        validateDiscount
    );

    price.addEventListener(
        'input',
        validateDiscount
    );


    validateDiscount();

});



/* =========================================
   UNIT LABEL
========================================= */

document.addEventListener('DOMContentLoaded', function () {

    const unit =
        document.getElementById('unit');

    const unitLabel =
        document.getElementById('unitLabel');

    const stockUnitLabel =
        document.getElementById('stockUnitLabel');


    if (!unit) {
        return;
    }


    const labels = {

        kg: 'KG',

        gram: 'Gram',

        piece: 'Piece',

        packet: 'Packet',

        liter: 'Liter'

    };


    function updateUnitLabel() {

        const label =
            labels[unit.value] || 'Unit';


        if (unitLabel) {

            unitLabel.textContent =
                label;

        }


        if (stockUnitLabel) {

            stockUnitLabel.textContent =
                label;

        }

    }


    unit.addEventListener(
        'change',
        updateUnitLabel
    );


    updateUnitLabel();

});



/* =========================================
   MINIMUM QUANTITY VALIDATION
========================================= */

document.addEventListener('DOMContentLoaded', function () {

    const minimumQty =
        document.getElementById('minimum_order_qty');

    const stock =
        document.getElementById('stock');


    if (!minimumQty || !stock) {
        return;
    }


    function validateMinimumQty() {

        const minimum =
            parseFloat(minimumQty.value) || 0;

        const availableStock =
            parseFloat(stock.value) || 0;


        if (
            minimum > 0 &&
            availableStock > 0 &&
            minimum > availableStock
        ) {

            minimumQty.setCustomValidity(
                'Minimum order quantity cannot be greater than available stock.'
            );

        } else {

            minimumQty.setCustomValidity('');

        }

    }


    minimumQty.addEventListener(
        'input',
        validateMinimumQty
    );

    stock.addEventListener(
        'input',
        validateMinimumQty
    );


    validateMinimumQty();

});

</script>

@endsection
