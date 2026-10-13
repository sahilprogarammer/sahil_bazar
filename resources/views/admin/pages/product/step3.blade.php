@extends('admin.layouts.app')

@section('title', 'Add Product - Media & Details')

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
                Step 3 of 4 · Product image & description
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
            href="{{ route(
                'product.step1',
                ['id' => $product->id]
            ) }}"
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

        <a
            href="{{ route(
                'product.step2',
                ['id' => $product->id]
            ) }}"
            class="step-item completed">

            <div class="step-number">

                <i class="bi bi-check-lg"></i>

            </div>

            <div class="step-content">

                <strong>
                    Pricing
                </strong>

                <span>
                    Price & stock
                </span>

            </div>

        </a>


        <div class="step-line completed-line"></div>



        {{-- Step 3 --}}

        <div class="step-item active">

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
            action="{{ route(
                'product.step3.save',
                $product->id
            ) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf



            {{-- =====================================
                 PRODUCT IMAGE
            ====================================== --}}

            <div class="form-section">


                <div class="section-title">

                    <div class="section-icon">

                        <i class="bi bi-images"></i>

                    </div>


                    <div>

                        <h3>
                            Product Images
                        </h3>

                        <p>
                            Upload clear images of your product
                        </p>

                    </div>

                </div>



                {{-- Existing Images --}}

                {{-- Existing Images --}}

                @if(!empty($product->images) && count($product->images) > 0)

                <div class="existing-images">

                    <div class="existing-title">

                        <span>
                            Existing Images
                        </span>

                        <small>
                            {{ count($product->images) }} image(s)
                        </small>

                    </div>


                    <div class="existing-image-grid">

                        @foreach($product->images as $image)

                        <div class="existing-image-item">

                            <img
                                src="{{ asset($image) }}"
                                alt="{{ $product->name }}">

                        </div>

                        @endforeach

                    </div>

                </div>

                @endif



                {{-- Upload Area --}}

                <div
                    class="image-upload"
                    id="imageUpload">


                    {{-- Preview Grid --}}

                    <div
                        class="preview-grid"
                        id="previewGrid">
                    </div>



                    {{-- Upload Icon --}}

                    <div
                        class="upload-icon"
                        id="uploadIcon">

                        <i class="bi bi-cloud-arrow-up"></i>

                    </div>


                    <h4 id="uploadTitle">

                        Upload Product Images

                    </h4>


                    <p id="uploadText">

                        JPG, PNG or WEBP · Maximum 2MB per image

                    </p>



                    <label
                        for="productImages"
                        class="choose-image-btn">

                        <i class="bi bi-upload"></i>

                        Choose Images

                    </label>



                    <input
                        type="file"
                        name="images[]"
                        id="productImages"
                        accept="image/jpeg,image/png,image/webp"
                        multiple
                        hidden>



                    @error('images')

                    <div class="text-danger image-error">

                        {{ $message }}

                    </div>

                    @enderror


                    @error('images.*')

                    <div class="text-danger image-error">

                        {{ $message }}

                    </div>

                    @enderror


                </div>


                <div class="input-help image-help">

                    You can select multiple images.
                    The first image will be used as the primary image
                    if no primary image exists.

                </div>

            </div>



            {{-- =====================================
                 DESCRIPTION
            ====================================== --}}

            <div class="form-section">


                <div class="section-title">

                    <div class="section-icon">

                        <i class="bi bi-text-paragraph"></i>

                    </div>


                    <div>

                        <h3>
                            Product Description
                        </h3>

                        <p>
                            Describe your product for customers
                        </p>

                    </div>

                </div>



                {{-- =================================
                     SHORT DESCRIPTION
                ================================== --}}

                <div class="mb-4">

                    <label
                        for="short_description"
                        class="form-label">

                        Short Description

                    </label>


                    <textarea
                        name="short_description"
                        id="short_description"
                        class="form-control description-box"
                        rows="5"
                        maxlength="500"
                        placeholder="Enter a short description of the product...">{{ old(
                            'short_description',
                            $product->short_desc ?? ''
                        ) }}</textarea>


                    <div class="description-footer">

                        <span>

                            Short summary shown to customers.

                        </span>


                        <span>

                            <strong id="shortCharacterCount">
                                0
                            </strong>/500

                        </span>

                    </div>


                    @error('short_description')

                    <small class="text-danger">

                        {{ $message }}

                    </small>

                    @enderror

                </div>



                {{-- =================================
                     LONG DESCRIPTION
                ================================== --}}

                <div>

                    <label
                        for="long_description"
                        class="form-label">

                        Long Description

                    </label>


                    <textarea
                        name="long_description"
                        id="long_description"
                        class="form-control description-box"
                        rows="8"
                        maxlength="5000"
                        placeholder="Enter detailed product information...">{{ old(
                            'long_description',
                            $product->long_desc ?? ''
                        ) }}</textarea>


                    <div class="description-footer">

                        <span>

                            Add ingredients, quality,
                            preparation or other useful details.

                        </span>


                        <span>

                            <strong id="longCharacterCount">
                                0
                            </strong>/5000

                        </span>

                    </div>


                    @error('long_description')

                    <small class="text-danger">

                        {{ $message }}

                    </small>

                    @enderror

                </div>

            </div>



            {{-- =====================================
                 FOOTER
            ====================================== --}}

            <div class="form-footer">


                {{-- Previous --}}

                <a
                    href="{{ route(
                        'product.step2',
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

        flex-shrink: 0;
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
   IMAGE UPLOAD
========================================= */

    .image-upload {

        border: 1.5px dashed #cfd8d0;

        border-radius: 14px;

        padding: 35px 20px;

        text-align: center;

        background: #fafcf9;

        transition: .2s ease;
    }

    .image-upload:hover {

        border-color: #176b3a;

        background: #f8fbf8;
    }

    .upload-icon {

        width: 58px;
        height: 58px;

        border-radius: 50%;

        background: #edf7ef;

        color: #176b3a;

        display: flex;

        align-items: center;
        justify-content: center;

        margin: 0 auto 13px;

        font-size: 25px;
    }

    .image-upload h4 {

        font-size: 15px;

        font-weight: 700;

        margin-bottom: 5px;

        color: #172018;
    }

    .image-upload p {

        color: #7b837c;

        font-size: 12px;

        margin-bottom: 18px;
    }


    /* =========================================
   CHOOSE IMAGE BUTTON
========================================= */

    .choose-image-btn {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

        padding: 10px 17px;

        border-radius: 9px;

        background: #176b3a;

        color: #fff;

        font-size: 13px;

        font-weight: 600;

        cursor: pointer;

        transition: .2s ease;
    }

    .choose-image-btn:hover {

        background: #12562e;

        color: #fff;
    }


    /* =========================================
   PREVIEW GRID
========================================= */

    .preview-grid {

        display: none;

        grid-template-columns:
            repeat(auto-fill, minmax(120px, 1fr));

        gap: 12px;

        max-width: 700px;

        margin: 0 auto 20px;
    }

    .preview-item {

        height: 120px;

        border-radius: 12px;

        overflow: hidden;

        position: relative;

        border: 1px solid #e1e7e1;

        background: #fff;
    }

    .preview-item img {

        width: 100%;
        height: 100%;

        object-fit: cover;
    }

    .preview-remove {

        position: absolute;

        top: 6px;
        right: 6px;

        width: 28px;
        height: 28px;

        border: 0;

        border-radius: 50%;

        background: rgba(0, 0, 0, .7);

        color: #fff;

        display: flex;

        align-items: center;
        justify-content: center;

        cursor: pointer;

        font-size: 15px;
    }


    /* =========================================
   EXISTING IMAGES
========================================= */

    .existing-images {

        margin-bottom: 20px;

        padding: 15px;

        border-radius: 12px;

        background: #f8faf8;

        border: 1px solid #e6ebe6;
    }

    .existing-title {

        display: flex;

        align-items: center;

        justify-content: space-between;

        margin-bottom: 12px;
    }

    .existing-title span {

        font-size: 13px;

        font-weight: 700;

        color: #303730;
    }

    .existing-title small {

        font-size: 11px;

        color: #7a827b;
    }

    .existing-image-grid {

        display: grid;

        grid-template-columns:
            repeat(auto-fill, minmax(110px, 1fr));

        gap: 10px;
    }

    .existing-image-item {

        height: 110px;

        position: relative;

        border-radius: 10px;

        overflow: hidden;

        border: 1px solid #dfe5df;

        background: #fff;
    }

    .existing-image-item img {

        width: 100%;
        height: 100%;

        object-fit: cover;
    }

    .primary-badge {

        position: absolute;

        left: 6px;
        bottom: 6px;

        padding: 4px 7px;

        border-radius: 6px;

        background: #176b3a;

        color: #fff;

        font-size: 9px;

        font-weight: 600;
    }

    .primary-badge i {

        font-size: 8px;

        margin-right: 2px;
    }


    /* =========================================
   IMAGE ERROR
========================================= */

    .image-error {

        margin-top: 12px;

        font-size: 12px;
    }

    .image-help {

        margin-top: 8px;
    }


    /* =========================================
   DESCRIPTION
========================================= */

    .description-box {

        min-height: 130px;

        resize: vertical;

        padding: 13px 14px;
    }

    .description-footer {

        display: flex;

        justify-content: space-between;

        gap: 15px;

        margin-top: 7px;

        font-size: 11px;

        color: #8a918b;
    }

    .description-footer strong {

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

        .image-upload {

            padding: 25px 15px;
        }

        .preview-grid {

            grid-template-columns:
                repeat(2, 1fr);
        }

        .existing-image-grid {

            grid-template-columns:
                repeat(2, 1fr);
        }

        .description-footer {

            align-items: flex-start;

            flex-direction: column;

            gap: 3px;
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
   IMAGE PREVIEW
========================================= */

    document.addEventListener('DOMContentLoaded', function() {

        const imageInput =
            document.getElementById('productImages');

        const previewGrid =
            document.getElementById('previewGrid');

        const uploadIcon =
            document.getElementById('uploadIcon');

        const uploadTitle =
            document.getElementById('uploadTitle');

        const uploadText =
            document.getElementById('uploadText');


        if (!imageInput) {
            return;
        }


        imageInput.addEventListener(
            'change',
            function() {

                previewGrid.innerHTML = '';


                const files =
                    Array.from(this.files);


                if (!files.length) {

                    previewGrid.style.display =
                        'none';

                    uploadIcon.style.display =
                        'flex';

                    uploadTitle.textContent =
                        'Upload Product Images';

                    uploadText.textContent =
                        'JPG, PNG or WEBP · Maximum 2MB per image';

                    return;
                }


                const allowedTypes = [

                    'image/jpeg',

                    'image/png',

                    'image/webp'

                ];


                let validFiles = [];


                files.forEach(function(file) {

                    if (
                        !allowedTypes.includes(file.type)
                    ) {

                        alert(
                            file.name +
                            ' is not a valid image.'
                        );

                        return;
                    }


                    if (
                        file.size >
                        2 * 1024 * 1024
                    ) {

                        alert(
                            file.name +
                            ' is larger than 2MB.'
                        );

                        return;
                    }


                    validFiles.push(file);

                });


                if (!validFiles.length) {

                    imageInput.value = '';

                    return;
                }


                previewGrid.style.display =
                    'grid';

                uploadIcon.style.display =
                    'none';

                uploadTitle.textContent =
                    validFiles.length +
                    ' Image(s) Selected';

                uploadText.textContent =
                    'Ready to upload';


                validFiles.forEach(function(
                    file,
                    index
                ) {

                    const reader =
                        new FileReader();


                    reader.onload =
                        function(event) {

                            const item =
                                document.createElement(
                                    'div'
                                );

                            item.className =
                                'preview-item';


                            item.innerHTML = `

                            <img
                                src="${event.target.result}"
                                alt="Product Image">

                            <button
                                type="button"
                                class="preview-remove"
                                data-index="${index}">

                                <i class="bi bi-x"></i>

                            </button>

                        `;


                            previewGrid.appendChild(
                                item
                            );

                        };


                    reader.readAsDataURL(file);

                });

            }
        );

    });



    /* =========================================
       SHORT DESCRIPTION COUNT
    ========================================= */

    document.addEventListener(
        'DOMContentLoaded',
        function() {

            const description =
                document.getElementById(
                    'short_description'
                );

            const counter =
                document.getElementById(
                    'shortCharacterCount'
                );


            if (!description || !counter) {
                return;
            }


            function updateCount() {

                counter.textContent =
                    description.value.length;

            }


            description.addEventListener(
                'input',
                updateCount
            );


            updateCount();

        }
    );



    /* =========================================
       LONG DESCRIPTION COUNT
    ========================================= */

    document.addEventListener(
        'DOMContentLoaded',
        function() {

            const description =
                document.getElementById(
                    'long_description'
                );

            const counter =
                document.getElementById(
                    'longCharacterCount'
                );


            if (!description || !counter) {
                return;
            }


            function updateCount() {

                counter.textContent =
                    description.value.length;

            }


            description.addEventListener(
                'input',
                updateCount
            );


            updateCount();

        }
    );
</script>

@endsection