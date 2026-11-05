<script>
    /* =========================================================
       STATE
    ========================================================= */

    let selectedAddressId = null;
    let editingAddressId = null;
    let loadedAddresses = [];


    /* =========================================================
       ADDRESS SELECTOR: OPEN / CLOSE
    ========================================================= */

    function openAddressSelector() {
        const modal = document.getElementById('addressSelectorModal');
        if (!modal) return;

        modal.classList.add('show');
        document.body.style.overflow = 'hidden';

        loadAddresses();
    }

    function closeAddressSelector() {
        const modal = document.getElementById('addressSelectorModal');
        if (modal) modal.classList.remove('show');

        document.body.style.overflow = '';
    }


    /* =========================================================
       LOAD USER ADDRESSES
    ========================================================= */

    function loadAddresses() {
        const list = document.getElementById('addressList');
        const useBtn = document.getElementById('useSelectedAddressBtn');

        if (!list) return;

        list.innerHTML = `
            <div class="address-loading">
                <i class="fa-solid fa-spinner fa-spin"></i>
                <span>Loading addresses...</span>
            </div>
        `;

        fetch("{{ route('addresses.list') }}", {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to load addresses');
                return response.json();
            })
            .then(data => {

                if (!data.success || !data.addresses.length) {
                    loadedAddresses = [];
                    selectedAddressId = null;

                    list.innerHTML = `
                        <div class="address-empty">
                            <div class="address-empty-icon">📍</div>
                            <h3>No saved address</h3>
                            <p>Add an address to continue.</p>
                        </div>
                    `;

                    if (useBtn) useBtn.disabled = true;
                    return;
                }

                loadedAddresses = data.addresses;

                // Select default automatically, otherwise the first one
                const defaultAddress = data.addresses.find(a => a.is_default);
                selectedAddressId = defaultAddress ? defaultAddress.id : data.addresses[0].id;

                list.innerHTML = data.addresses.map(address => {

                    const isSelected = Number(address.id) === Number(selectedAddressId);

                    const addressType = address.address_type ?
                        address.address_type.charAt(0).toUpperCase() + address.address_type.slice(1) :
                        'Address';

                    const fullAddress = address.full_address ||
                        [
                            address.house_no,
                            address.street,
                            address.landmark,
                            address.city,
                            address.state,
                            address.pincode
                        ].filter(Boolean).join(', ');

                    return `
                        <div class="address-item ${isSelected ? 'selected' : ''}"
                            onclick="selectAddress(this, ${address.id})">

                            <div class="address-radio"></div>

                            <div class="address-item-content">

                                <div class="address-item-top">

                                    <span class="address-item-type">${escapeHtml(addressType)}</span>

                                    ${address.is_default
                                        ? `<span class="address-default">Default</span>`
                                        : ''}

                                    <button type="button" class="address-edit-btn"
                                        onclick="event.stopPropagation(); editAddress(${address.id})">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>

                                </div>

                                <div class="address-item-name">${escapeHtml(address.name)}</div>

                                <div class="address-item-text">${escapeHtml(fullAddress)}</div>

                            </div>

                        </div>
                    `;
                }).join('');

                if (useBtn) useBtn.disabled = false;
            })
            .catch(error => {
                console.error(error);

                list.innerHTML = `
                    <div class="address-empty">
                        <div class="address-empty-icon">⚠️</div>
                        <h3>Unable to load addresses</h3>
                        <p>Please try again.</p>
                    </div>
                `;

                if (useBtn) useBtn.disabled = true;
            });
    }


    /* =========================================================
       SELECT ADDRESS
    ========================================================= */

    function selectAddress(element, addressId) {
        document.querySelectorAll('.address-item').forEach(item => item.classList.remove('selected'));

        element.classList.add('selected');
        selectedAddressId = addressId;

        const useBtn = document.getElementById('useSelectedAddressBtn');
        if (useBtn) useBtn.disabled = false;
    }


    /* =========================================================
       USE SELECTED ADDRESS (set as default)
    ========================================================= */

    document.getElementById('useSelectedAddressBtn')?.addEventListener('click', function() {

        if (!selectedAddressId) return;

        const button = this;

        button.disabled = true;
        button.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> Updating...`;

        fetch("{{ route('address.setDefault') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    address_id: selectedAddressId
                })
            })
            .then(response => response.json())
            .then(data => {

                if (!data.success) {
                    throw new Error(data.message || 'Unable to update address.');
                }

                if (typeof userAddresses !== 'undefined') {
                    userAddresses.forEach(function(address) {
                        address.is_default = Number(address.id) === Number(selectedAddressId) ? 1 : 0;
                    });
                }

                closeAddressSelector();

                button.innerHTML = 'Use Selected Address';
                button.disabled = false;
            })
            .catch(error => {
                console.error('Default address update error:', error);

                alert(error.message || 'Something went wrong.');

                button.innerHTML = 'Use Selected Address';
                button.disabled = false;
            });
    });


    /* =========================================================
       ADDRESS FORM: OPEN / CLOSE
       openAddressForm(true)  -> new address (clean form)
       openAddressForm()      -> keeps current state (used by edit)
    ========================================================= */

    function openAddressForm(isNew = false) {
        const selectorModal = document.getElementById('addressSelectorModal');
        const formModal = document.getElementById('addressFormModal');

        if (isNew) resetAddressForm();

        if (selectorModal) selectorModal.classList.remove('show');

        if (!formModal) {
            console.error('addressFormModal NOT FOUND');
            return;
        }

        formModal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeAddressForm() {
        const formModal = document.getElementById('addressFormModal');
        if (formModal) formModal.classList.remove('show');

        document.body.style.overflow = '';

        resetAddressForm();
    }


    /* =========================================================
       ADDRESS TYPE (Home / Work / Other)
    ========================================================= */

    function setAddressType(type) {
        const input = document.getElementById('addressTypeInput');
        if (input) input.value = type;

        document.querySelectorAll('.address-type-option').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.addressType === type);
        });
    }

    document.querySelectorAll('.address-type-option').forEach(btn => {
        btn.addEventListener('click', () => setAddressType(btn.dataset.addressType));
    });


    /* =========================================================
       EDIT ADDRESS
    ========================================================= */

    function editAddress(addressId) {
        const address = loadedAddresses.find(a => Number(a.id) === Number(addressId));
        if (!address) return;

        editingAddressId = address.id;

        openAddressForm(); // no reset, keeps edit state

        document.getElementById('addressName').value = address.name ?? '';
        document.getElementById('addressMobile').value = address.mobile ?? '';
        document.getElementById('addressStreet').value = address.area ?? '';
        document.getElementById('addressHouse').value = address.house_no ?? '';
        document.getElementById('addressLandmark').value = address.landmark ?? '';
        document.getElementById('addressLatitude').value = address.latitude ?? '';
        document.getElementById('addressLongitude').value = address.longitude ?? '';
        document.getElementById('addressIsDefault').checked = !!Number(address.is_default);

        setAddressType(address.address_type || 'home');

        document.getElementById('addressFormTitle').textContent = 'Edit Address';
        document.getElementById('saveAddressBtnText').textContent = 'Update Address';
    }


    /* =========================================================
       RESET FORM (back to "Add New" mode)
    ========================================================= */

    function resetAddressForm() {
        editingAddressId = null;

        document.getElementById('commonAddressForm')?.reset();
        setAddressType('home');

        const err = document.getElementById('addressFormError');
        if (err) {
            err.classList.remove('show');
            err.textContent = '';
        }

        const title = document.getElementById('addressFormTitle');
        const btnText = document.getElementById('saveAddressBtnText');

        if (title) title.textContent = 'Add New Address';
        if (btnText) btnText.textContent = 'Save Address';
    }


    /* =========================================================
       SUBMIT FORM (create or update)
    ========================================================= */

    document.getElementById('commonAddressForm')?.addEventListener('submit', function(e) {
        e.preventDefault();

        const btn = document.getElementById('saveAddressBtn');
        const errBox = document.getElementById('addressFormError');
        const isEdit = !!editingAddressId;

        const url = isEdit ?
            "{{ route('address-update', ':id') }}".replace(':id', editingAddressId) :
            "{{ route('address-store') }}";

        const formData = new FormData(this);

        // Unchecked checkbox is not sent, so send it explicitly
        if (!document.getElementById('addressIsDefault').checked) {
            formData.delete('is_default');
        }

        if (isEdit) formData.append('_method', 'post');

        btn.classList.add('loading');
        errBox.classList.remove('show');

        fetch(url, {
                method: 'POST', // PUT is spoofed with _method
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();

                if (!response.ok || !data.success) {
                    const firstError = data.errors ? Object.values(data.errors)[0][0] : null;
                    throw new Error(firstError || data.message || 'Unable to save address.');
                }

                return data;
            })
            .then(() => {
                closeAddressForm();
                openAddressSelector(); // reopens and reloads the list
            })
            .catch(error => {
                errBox.textContent = error.message || 'Something went wrong.';
                errBox.classList.add('show');
            })
            .finally(() => btn.classList.remove('loading'));
    });


    /* =========================================================
       ESCAPE HTML
    ========================================================= */

    function escapeHtml(value) {
        if (value === null || value === undefined) return '';

        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }
</script>
