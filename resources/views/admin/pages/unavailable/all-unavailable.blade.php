@extends('admin.layouts.app')

@section('title', 'Product Availability')

@section('content')

<div class="page-wrapper">

    <!-- =========================================
         PAGE HEADER
    ========================================== -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <div class="page-title">Product Availability</div>
            <div class="page-subtitle">Manage product availability and their status</div>
        </div>

        <!-- Add Availability -->
        <button
            type="button"
            class="add-btn"
            id="openAddModalBtn"
            title="Add Availability">
            <i class="bi bi-plus-lg"></i>
        </button>

    </div>


    <!-- =========================================
         TABLE CARD
    ========================================== -->
    <div class="premium-card">

        <div class="card-header-custom">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <strong>All Product Availability Records</strong>
                </div>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>
                    <tr>
                        <th>Subcategory</th>
                        <th>Products</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $item)
                    <tr>

                        {{-- Subcategory --}}
                        <td>
                            <div class="category-name">
                                {{ $item->subcategory_name ?? 'N/A' }}
                            </div>
                            <div class="category-id">
                                #{{ $item->subcategory_id }}
                            </div>
                        </td>

                        {{-- Products --}}
                        <td>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($item->products as $product)
                                <span class="badge bg-light text-dark border">
                                    {{ $product }}
                                </span>
                                @endforeach
                            </div>
                        </td>

                        {{-- Date --}}
                        <td>
                            {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                        </td>

                        {{-- Status --}}
                        <td>
                            @if($item->availability_status === 'out_of_stock')
                            <span class="status status-inactive">
                                <span class="status-dot"></span>
                                Out of Stock
                            </span>
                            @else
                            <span class="status status-active">
                                <span class="status-dot"></span>
                                Available
                            </span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td>
                            <button
                                type="button"
                                class="btn btn-sm btn-primary edit-availability-btn"
                                data-subcategory="{{ $item->subcategory_id }}"
                                data-products="{{ json_encode($item->product_ids) }}"
                                data-date="{{ $item->date }}"
                                data-status="{{ $item->availability_status }}">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <button
                                type="button"
                                class="btn btn-sm btn-danger delete-availability-btn"
                                data-subcategory="{{ $item->subcategory_id }}"
                                data-subcategory-name="{{ $item->subcategory_name }}"
                                data-products="{{ json_encode($item->product_ids) }}"
                                data-date="{{ $item->date }}">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <h6>No availability records found</h6>
                                <p>No product availability records are available yet.</p>
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
     ADD / EDIT MODAL
========================================== -->
<div
    class="modal fade"
    id="categoryModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            {{-- MODAL HEADER --}}
            <div class="modal-header">

                <div>
                    <h5 class="modal-title mb-1" id="availabilityModalTitle">
                        Manage Product Availability
                    </h5>

                    <div class="page-subtitle">
                        Manage product stock and availability by date
                    </div>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>


            {{-- FORM (same route for add and update) --}}
            <form action="{{ route('admin.product-availability.store') }}" method="POST" id="productAvailabilityForm">

                @csrf

                {{-- Hidden fields so the controller knows if it is add or update --}}
                <input type="hidden" name="is_edit" id="isEdit" value="0">
                <input type="hidden" name="old_subcategory_id" id="oldSubcategoryId" value="">
                <input type="hidden" name="old_date" id="oldDate" value="">
                <input type="hidden" name="old_status" id="oldStatus" value="">
                <input type="hidden" name="old_product_ids" id="oldProductIds" value="">

                <div class="modal-body">

                    {{-- SUBCATEGORY --}}
                    <div class="mb-3">

                        <label for="availabilitySubcategory" class="form-label">
                            Subcategory <span class="text-danger">*</span>
                        </label>

                        <select
                            name="subcategory_id"
                            id="availabilitySubcategory"
                            class="form-select"
                            data-subcategories-url="{{ route('admin.product-availability.subcategories') }}"
                            data-products-url="{{ route('admin.product-availability.products', ['subcategory' => '__ID__']) }}"
                            required>
                            <option value="">Loading subcategories...</option>
                        </select>

                    </div>


                    {{-- PRODUCTS --}}
                    <div class="mb-3">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <label class="form-label mb-0">
                                Select Products <span class="text-danger">*</span>
                            </label>

                            <label class="small mb-0">
                                <input type="checkbox" id="selectAllAvailabilityProducts" class="form-check-input me-1">
                                Select All
                            </label>

                        </div>

                        <div id="availabilityProducts" class="border rounded p-3"
                            style="min-height: 80px; max-height: 230px; overflow-y: auto;">
                            <div class="text-muted small">
                                Select a subcategory to load products.
                            </div>
                        </div>

                        <small id="availabilityProductCount" class="text-muted d-block mt-2">
                            0 products selected
                        </small>

                    </div>


                    {{-- DATE AND STATUS --}}
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="availabilityDate" class="form-label">
                                Date <span class="text-danger">*</span>
                            </label>

                            <input type="date" name="date" id="availabilityDate" class="form-control"
                                min="{{ now()->toDateString() }}" value="{{ now()->toDateString() }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="availabilityStatus" class="form-label">
                                Availability Status <span class="text-danger">*</span>
                            </label>

                            <select name="availability_status" id="availabilityStatus" class="form-select" required>
                                <option value="">Select Status</option>
                                <option value="out_of_stock">Out of Stock</option>
                                <option value="available">Available</option>
                            </select>
                        </div>

                    </div>


                    {{-- HELP TEXT --}}
                    <div class="alert alert-light border small mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        The selected availability status will be applied
                        to all selected products for the chosen date.
                    </div>

                </div>


                {{-- MODAL FOOTER --}}
                <div class="modal-footer">

                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="save-btn" id="saveAvailabilityBtn">
                        <i class="bi bi-check-lg me-1"></i>
                        <span id="saveAvailabilityBtnText">Save Availability</span>
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- =========================================
     DELETE CONFIRM MODAL
========================================== -->
<div class="modal fade" id="deleteAvailabilityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Delete Availability</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.product-availability.destroy') }}" method="POST" id="deleteAvailabilityForm">
                @csrf
                @method('DELETE')

                <input type="hidden" name="subcategory_id" id="deleteSubcategoryId">
                <input type="hidden" name="date" id="deleteDate">
                <div id="deleteProductInputs"></div>

                <div class="modal-body">
                    <p class="mb-1">
                        Are you sure you want to delete this availability record?
                    </p>
                    <div class="small text-muted" id="deleteInfoText"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const modalElement = document.getElementById('categoryModal');
        const form = document.getElementById('productAvailabilityForm');
        const subcategorySelect = document.getElementById('availabilitySubcategory');
        const productsContainer = document.getElementById('availabilityProducts');
        const selectAllCheckbox = document.getElementById('selectAllAvailabilityProducts');
        const productCount = document.getElementById('availabilityProductCount');
        const dateInput = document.getElementById('availabilityDate');
        const statusSelect = document.getElementById('availabilityStatus');

        const modalTitle = document.getElementById('availabilityModalTitle');
        const saveBtnText = document.getElementById('saveAvailabilityBtnText');

        const isEditInput = document.getElementById('isEdit');
        const oldSubcategoryInput = document.getElementById('oldSubcategoryId');
        const oldDateInput = document.getElementById('oldDate');
        const oldStatusInput = document.getElementById('oldStatus');
        const oldProductIdsInput = document.getElementById('oldProductIds');

        if (!modalElement || !subcategorySelect || !productsContainer || !selectAllCheckbox) {
            return;
        }

        const bsModal = bootstrap.Modal.getOrCreateInstance(modalElement);

        const subcategoriesUrl = subcategorySelect.dataset.subcategoriesUrl;
        const productsUrlTemplate = subcategorySelect.dataset.productsUrl;

        const todayMin = dateInput.getAttribute('min');
        const todayValue = dateInput.value;

        let requestController = null;
        let subcategoriesReady = null; // promise, resolved when subcategories are loaded

        // ---------------------------------------------
        // Helpers
        // ---------------------------------------------
        function showMessage(message, className = 'text-muted') {
            productsContainer.replaceChildren();

            const div = document.createElement('div');
            div.className = className + ' small';
            div.textContent = message;

            productsContainer.appendChild(div);

            updateCount();
        }

        function updateCount() {
            const checkboxes = productsContainer.querySelectorAll('.availability-product-checkbox');
            const selected = productsContainer.querySelectorAll('.availability-product-checkbox:checked');

            if (productCount) {
                productCount.textContent = selected.length + ' product(s) selected';
            }

            selectAllCheckbox.checked =
                checkboxes.length > 0 && selected.length === checkboxes.length;

            selectAllCheckbox.indeterminate =
                selected.length > 0 && selected.length < checkboxes.length;

            selectAllCheckbox.disabled = checkboxes.length === 0;
        }

        async function fetchData(url, signal) {
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin',
                signal: signal
            });

            if (!response.ok) {
                throw new Error('Request failed: ' + response.status);
            }

            return await response.json();
        }

        // ---------------------------------------------
        // Load subcategories
        // ---------------------------------------------
        async function loadSubcategories() {
            subcategorySelect.disabled = true;

            try {
                const data = await fetchData(subcategoriesUrl);

                subcategorySelect.replaceChildren();

                const placeholder = document.createElement('option');
                placeholder.value = '';
                placeholder.textContent = 'Select Subcategory';
                subcategorySelect.appendChild(placeholder);

                if (!Array.isArray(data.subcategories) || data.subcategories.length === 0) {
                    placeholder.textContent = 'No subcategories found';
                    showMessage('No subcategories found.');
                    return;
                }

                data.subcategories.forEach(function(subcategory) {
                    const option = document.createElement('option');
                    option.value = subcategory.id;
                    option.textContent = subcategory.name;
                    subcategorySelect.appendChild(option);
                });

                showMessage('Select a subcategory to load products.');

            } catch (error) {
                console.error('Subcategory error:', error);

                subcategorySelect.replaceChildren();

                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'Failed to load subcategories';
                subcategorySelect.appendChild(option);

                showMessage('Unable to load subcategories. Please refresh and try again.', 'text-danger');

            } finally {
                subcategorySelect.disabled = false;
            }
        }

        // ---------------------------------------------
        // Load products
        // preselectIds = array of product ids to tick (used in edit mode)
        // ---------------------------------------------
        async function loadProducts(subcategoryId, preselectIds = []) {

            if (requestController) {
                requestController.abort();
            }

            if (!subcategoryId) {
                showMessage('Select a subcategory to load products.');
                return;
            }

            requestController = new AbortController();
            const controller = requestController;

            const preselected = preselectIds.map(String);

            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.disabled = true;

            showMessage('Loading products...');

            try {
                const url = productsUrlTemplate.replace('__ID__', encodeURIComponent(subcategoryId));

                const data = await fetchData(url, controller.signal);

                if (requestController !== controller) {
                    return;
                }

                productsContainer.replaceChildren();

                if (!Array.isArray(data.products) || data.products.length === 0) {
                    showMessage('No products found in this subcategory.');
                    return;
                }

                data.products.forEach(function(product) {

                    const label = document.createElement('label');
                    label.className = 'd-flex align-items-center gap-2 mb-3';
                    label.style.cursor = 'pointer';

                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'product_ids[]';
                    checkbox.value = product.id;
                    checkbox.className = 'form-check-input availability-product-checkbox';
                    checkbox.checked = preselected.includes(String(product.id));

                    const name = document.createElement('span');
                    name.className = 'small';
                    name.textContent = product.name;

                    label.appendChild(checkbox);
                    label.appendChild(name);

                    productsContainer.appendChild(label);

                    checkbox.addEventListener('change', updateCount);
                });

                updateCount();

            } catch (error) {
                if (error.name === 'AbortError') {
                    return;
                }

                console.error('Product loading error:', error);
                showMessage('Unable to load products. Please try again.', 'text-danger');

            } finally {
                if (requestController === controller) {
                    requestController = null;
                    updateCount();
                }
            }
        }

        // ---------------------------------------------
        // Modes: ADD / EDIT
        // ---------------------------------------------
        function setAddMode() {
            form.reset();

            isEditInput.value = '0';
            oldSubcategoryInput.value = '';
            oldDateInput.value = '';
            oldStatusInput.value = '';
            oldProductIdsInput.value = '';

            subcategorySelect.value = '';
            dateInput.setAttribute('min', todayMin);
            dateInput.value = todayValue;
            statusSelect.value = '';

            modalTitle.textContent = 'Manage Product Availability';
            saveBtnText.textContent = 'Save Availability';

            showMessage('Select a subcategory to load products.');
        }

        async function setEditMode(button) {
            const subcategoryId = button.dataset.subcategory || '';
            const date = (button.dataset.date || '').substring(0, 10);
            const status = button.dataset.status || '';

            let productIds = [];
            try {
                productIds = JSON.parse(button.dataset.products || '[]');
            } catch (e) {
                productIds = [];
            }

            // Show modal immediately
            modalTitle.textContent = 'Edit Product Availability';
            saveBtnText.textContent = 'Update Availability';

            isEditInput.value = '1';
            oldSubcategoryInput.value = subcategoryId;
            oldDateInput.value = date;
            oldStatusInput.value = status;
            oldProductIdsInput.value = JSON.stringify(productIds);

            // Allow past dates when editing old records
            dateInput.removeAttribute('min');
            dateInput.value = date;
            statusSelect.value = status;

            bsModal.show();

            // Wait until subcategories are loaded, then select and load products
            await subcategoriesReady;

            subcategorySelect.value = subcategoryId;

            await loadProducts(subcategoryId, productIds);
        }

        // ---------------------------------------------
        // Events
        // ---------------------------------------------

        // Add button
        document.getElementById('openAddModalBtn').addEventListener('click', function() {
            setAddMode();
            bsModal.show();
        });

        // Edit buttons
        document.querySelectorAll('.edit-availability-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                setEditMode(button);
            });
        });

        // Reset to add mode whenever the modal closes
        modalElement.addEventListener('hidden.bs.modal', function() {
            setAddMode();
        });

        // Subcategory change
        subcategorySelect.addEventListener('change', function() {
            loadProducts(this.value);
        });

        // Select all
        selectAllCheckbox.addEventListener('change', function() {
            productsContainer.querySelectorAll('.availability-product-checkbox').forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });

            updateCount();
        });

        // Require at least one product before submit
        form.addEventListener('submit', function(e) {
            const selected = productsContainer.querySelectorAll('.availability-product-checkbox:checked');

            if (selected.length === 0) {
                e.preventDefault();
                alert('Please select at least one product.');
            }
        });

        // ---------------------------------------------
        // Initial setup
        // ---------------------------------------------
        showMessage('Select a subcategory to load products.');
        subcategoriesReady = loadSubcategories();

    });


    // ---------------------------------------------
    // DELETE
    // ---------------------------------------------
    const deleteModalElement = document.getElementById('deleteAvailabilityModal');
    const deleteModal = bootstrap.Modal.getOrCreateInstance(deleteModalElement);
    const deleteSubcategoryInput = document.getElementById('deleteSubcategoryId');
    const deleteDateInput = document.getElementById('deleteDate');
    const deleteProductInputs = document.getElementById('deleteProductInputs');
    const deleteInfoText = document.getElementById('deleteInfoText');

    document.querySelectorAll('.delete-availability-btn').forEach(function(button) {
        button.addEventListener('click', function() {

            let productIds = [];
            try {
                productIds = JSON.parse(button.dataset.products || '[]');
            } catch (e) {
                productIds = [];
            }

            const date = (button.dataset.date || '').substring(0, 10);

            deleteSubcategoryInput.value = button.dataset.subcategory || '';
            deleteDateInput.value = date;

            // Build product_ids[] hidden inputs
            deleteProductInputs.replaceChildren();
            productIds.forEach(function(id) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'product_ids[]';
                input.value = id;
                deleteProductInputs.appendChild(input);
            });

            deleteInfoText.textContent =
                (button.dataset.subcategoryName || 'Subcategory') +
                ' • ' + productIds.length + ' product(s) • ' + date;

            deleteModal.show();
        });
    });
</script>

@endsection