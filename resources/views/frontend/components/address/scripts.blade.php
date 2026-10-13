<script>
    /*
    |--------------------------------------------------------------------------
    | OPEN ADDRESS SELECTOR
    |--------------------------------------------------------------------------
    */

    function openAddressSelector() {

        const modal = document.getElementById('addressSelectorModal');

        if (!modal) return;

        modal.classList.add('show');

        document.body.style.overflow = 'hidden';

        loadAddresses();
    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE ADDRESS SELECTOR
    |--------------------------------------------------------------------------
    */

    function closeAddressSelector() {

        const modal =
            document.getElementById('addressSelectorModal');

        if (modal) {
            modal.classList.remove('show');
        }

        document.body.style.overflow = '';
    }


    /*
    |--------------------------------------------------------------------------
    | LOAD USER ADDRESSES
    |--------------------------------------------------------------------------
    */

    let selectedAddressId = null;

    function loadAddresses() {

        const list =
            document.getElementById('addressList');

        if (!list) return;

        list.innerHTML = `
            <div class="address-loading">
                Loading addresses...
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

                if (!response.ok) {
                    throw new Error('Failed to load addresses');
                }

                return response.json();
            })
            .then(data => {

                if (!data.success || !data.addresses.length) {

                    list.innerHTML = `
                    <div class="address-empty">

                        <div class="address-empty-icon">
                            📍
                        </div>

                        <h3>No saved address</h3>

                        <p>
                            Add an address to continue.
                        </p>

                    </div>
                `;

                    document
                        .getElementById('useSelectedAddressBtn')
                        .disabled = true;

                    selectedAddressId = null;

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Find default address
                |--------------------------------------------------------------------------
                */

                const defaultAddress =
                    data.addresses.find(address => address.is_default);


                /*
                |--------------------------------------------------------------------------
                | Select default automatically
                |--------------------------------------------------------------------------
                */

                if (defaultAddress) {

                    selectedAddressId =
                        defaultAddress.id;

                } else {

                    selectedAddressId =
                        data.addresses[0].id;
                }


                /*
                |--------------------------------------------------------------------------
                | Create HTML
                |--------------------------------------------------------------------------
                */

                list.innerHTML = data.addresses.map(address => {

                    const isSelected =
                        Number(address.id) === Number(selectedAddressId);

                    const addressType =
                        address.address_type ?
                        address.address_type.charAt(0).toUpperCase() +
                        address.address_type.slice(1) :
                        'Address';


                    return `

                    <div
                        class="address-item ${isSelected ? 'selected' : ''}"
                        onclick="selectAddress(this, ${address.id})"
                    >

                        <div class="address-radio"></div>

                        <div class="address-item-content">

                            <div class="address-item-top">

                                <span class="address-item-type">
                                    ${escapeHtml(addressType)}
                                </span>

                                ${
                                    address.is_default
                                        ? `
                                            <span class="address-default">
                                                Default
                                            </span>
                                          `
                                        : ''
                                }

                            </div>


                            <div class="address-item-name">
                                ${escapeHtml(address.name)}
                            </div>


                            <div class="address-item-text">

                                ${escapeHtml(
                                    address.full_address ||
                                    [
                                        address.house_no,
                                        address.street,
                                        address.city,
                                        address.state,
                                        address.pincode
                                    ].filter(Boolean).join(', ')
                                )}

                            </div>

                        </div>

                    </div>

                `;

                }).join('');


                document
                    .getElementById('useSelectedAddressBtn')
                    .disabled = false;

            })
            .catch(error => {

                console.error(error);

                list.innerHTML = `
                <div class="address-empty">

                    <div class="address-empty-icon">
                        ⚠️
                    </div>

                    <h3>Unable to load addresses</h3>

                    <p>
                        Please try again.
                    </p>

                </div>
            `;

                document
                    .getElementById('useSelectedAddressBtn')
                    .disabled = true;
            });
    }


    /*
    |--------------------------------------------------------------------------
    | SELECT ADDRESS
    |--------------------------------------------------------------------------
    */

    function selectAddress(element, addressId) {

        document
            .querySelectorAll('.address-item')
            .forEach(function(item) {

                item.classList.remove('selected');

            });


        element.classList.add('selected');


        selectedAddressId = addressId;


        document
            .getElementById('useSelectedAddressBtn')
            .disabled = false;


        console.log(
            'Selected Address ID:',
            selectedAddressId
        );
    }

    // document
    //     .getElementById('useSelectedAddressBtn')
    //     .addEventListener('click', function() {

    //         if (!selectedAddressId) {
    //             return;
    //         }


    //         console.log(
    //             'Using Address:',
    //             selectedAddressId
    //         );


    //         /*
    //         |----------------------------------------------------------------------
    //         | Later you can save this address ID in session/cart/order
    //         |----------------------------------------------------------------------
    //         */

    //         closeAddressSelector();

    //     });
    const useSelectedAddressBtn = document.getElementById('useSelectedAddressBtn');

    document
        .getElementById('useSelectedAddressBtn')
        .addEventListener('click', function() {

            if (!selectedAddressId) {
                return;
            }

            const button = this;

            // Disable button while saving
            button.disabled = true;

            button.innerHTML = `
            <i class="fa-solid fa-spinner fa-spin"></i>
            Updating...
        `;

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
                        throw new Error(
                            data.message || 'Unable to update address.'
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Update local addresses
                    |--------------------------------------------------------------------------
                    */

                    if (typeof userAddresses !== 'undefined') {

                        userAddresses.forEach(function(address) {

                            address.is_default =
                                Number(address.id) ===
                                Number(selectedAddressId) ?
                                1 :
                                0;

                        });

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Close address selector
                    |--------------------------------------------------------------------------
                    */

                    closeAddressSelector();

                    /*
                    |--------------------------------------------------------------------------
                    | Reset button
                    |--------------------------------------------------------------------------
                    */

                    button.innerHTML = `
                Use Selected Address
            `;

                    button.disabled = false;

                })

                .catch(error => {

                    console.error(
                        'Default address update error:',
                        error
                    );

                    alert(
                        error.message ||
                        'Something went wrong.'
                    );

                    button.innerHTML = `
                Use Selected Address
            `;

                    button.disabled = false;

                });

        });


    /*
    |--------------------------------------------------------------------------
    | OPEN ADD ADDRESS
    |--------------------------------------------------------------------------
    */

    function openAddressForm() {

        const selectorModal =
            document.getElementById('addressSelectorModal');

        const formModal =
            document.getElementById('addressFormModal');


        if (selectorModal) {
            selectorModal.classList.remove('show');
        }


        if (!formModal) {

            console.error(
                'addressFormModal NOT FOUND'
            );

            return;
        }


        formModal.classList.add('show');

        document.body.style.overflow = 'hidden';
    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE ADD ADDRESS
    |--------------------------------------------------------------------------
    */

    function closeAddressForm() {

        const formModal =
            document.getElementById('addressFormModal');


        if (formModal) {
            formModal.classList.remove('show');
        }


        document.body.style.overflow = '';
    }


    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    | Prevent user address data from being inserted as raw HTML.
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {

        if (value === null || value === undefined) {
            return '';
        }

        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }
</script>