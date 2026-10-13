let selectedProduct = null;


/* =====================================================
   OPEN QUANTITY MODAL
===================================================== */

function openQuantityModal(button) {

    const card = button.closest('.product-card');

    if (!card) {
        return;
    }


    /* =====================================================
       PRODUCT DATA
    ===================================================== */

    const originalPrice =
        parseFloat(card.dataset.price) || 0;

    const discountPrice =
        parseFloat(card.dataset.discountPrice) || 0;

    const minimumQty =
        parseFloat(card.dataset.minQty) || 0;

    const unit =
        (card.dataset.unit || 'gram').toLowerCase();


    /* =====================================================
       SELLING PRICE
    ===================================================== */

    const sellingPrice =
        discountPrice > 0
            ? discountPrice
            : originalPrice;


    const image =
        card.dataset.image || '';


    /* =====================================================
       SELECTED PRODUCT
    ===================================================== */

    selectedProduct = {

        id:
            card.dataset.productId,

        name:
            card.dataset.name || 'Product',

        unit:
            unit,

        price:
            originalPrice,

        discountPrice:
            discountPrice,

        sellingPrice:
            sellingPrice,

        minQty:
            minimumQty,

        image:
            image
    };


    /* =====================================================
       MODAL ELEMENTS
    ===================================================== */

    const modal =
        document.getElementById('quantityModal');

    const productName =
        document.getElementById('modalProductName');

    const minQtyElement =
        document.getElementById('modalMinQty');

    const modalPrice =
        document.getElementById('modalPrice');

    const modalPriceUnit =
        document.getElementById('modalPriceUnit');

    const quantityInput =
        document.getElementById('quantityInput');

    const quantityUnit =
        document.getElementById('quantityUnit');

    const error =
        document.getElementById('quantityError');

    const calculatedPrice =
        document.getElementById('calculatedPrice');


    if (!modal) {

        console.error(
            'Quantity modal not found.'
        );

        return;
    }


    /* =====================================================
       PRODUCT NAME
    ===================================================== */

    if (productName) {

        productName.textContent =
            selectedProduct.name;

    }


    /* =====================================================
       MINIMUM QUANTITY
    ===================================================== */

    if (minQtyElement) {

        minQtyElement.textContent =
            formatQuantity(
                selectedProduct.minQty,
                selectedProduct.unit
            );

    }


    /* =====================================================
       DISPLAY PRICE
    ===================================================== */

    /*
     * PIECE
     *
     * Example:
     *
     * minimum_order_qty = 5
     * selling price = ₹300
     *
     * 5 pieces = ₹300
     * 1 piece = ₹60
     */

    if (
        selectedProduct.unit === 'piece'
    ) {

        let pricePerPiece = 0;

        if (
            selectedProduct.minQty > 0
        ) {

            pricePerPiece =
                selectedProduct.sellingPrice /
                selectedProduct.minQty;

        }


        if (modalPrice) {

            modalPrice.textContent =
                '₹' +
                pricePerPiece.toFixed(2);

        }


        if (modalPriceUnit) {

            modalPriceUnit.textContent =
                'piece';

        }

    }


    /*
     * GRAM
     *
     * Price is per KG
     */

    else if (
        selectedProduct.unit === 'gram'
    ) {

        if (modalPrice) {

            modalPrice.textContent =
                '₹' +
                selectedProduct.sellingPrice.toFixed(2);

        }


        if (modalPriceUnit) {

            modalPriceUnit.textContent =
                'kg';

        }

    }


    /*
     * ALL OTHER UNITS
     */

    else {

        if (modalPrice) {

            modalPrice.textContent =
                '₹' +
                selectedProduct.sellingPrice.toFixed(2);

        }


        if (modalPriceUnit) {

            modalPriceUnit.textContent =
                selectedProduct.unit;

        }

    }


    /* =====================================================
       QUANTITY UNIT
    ===================================================== */

    if (quantityUnit) {

        quantityUnit.textContent =
            getDisplayUnit(
                selectedProduct.unit
            );

    }


    /* =====================================================
       INPUT SETTINGS
    ===================================================== */

    if (quantityInput) {

        quantityInput.min =
            selectedProduct.minQty;

    }


    /* =====================================================
       GRAM
    ===================================================== */

    if (
        selectedProduct.unit === 'gram'
    ) {

        quantityInput.step =
            '50';

        quantityInput.placeholder =
            'Enter grams';

        quantityInput.inputMode =
            'numeric';

    }


    /* =====================================================
       KG
    ===================================================== */

    else if (
        selectedProduct.unit === 'kg'
    ) {

        quantityInput.step =
            '1';

        quantityInput.placeholder =
            'Enter kg';

        quantityInput.inputMode =
            'decimal';

    }


    /* =====================================================
       PIECE
    ===================================================== */

    else if (
        selectedProduct.unit === 'piece'
    ) {

        quantityInput.step =
            '1';

        quantityInput.placeholder =
            'Enter pieces';

        quantityInput.inputMode =
            'numeric';

    }


    /* =====================================================
       PACKET
    ===================================================== */

    else if (
        selectedProduct.unit === 'packet'
    ) {

        quantityInput.step =
            '1';

        quantityInput.placeholder =
            'Enter packets';

        quantityInput.inputMode =
            'numeric';

    }


    /* =====================================================
       LITER
    ===================================================== */

    else if (
        selectedProduct.unit === 'liter'
    ) {

        quantityInput.step =
            '0.1';

        quantityInput.placeholder =
            'Enter liters';

        quantityInput.inputMode =
            'decimal';

    }


    /* =====================================================
       FALLBACK
    ===================================================== */

    else {

        quantityInput.step =
            '1';

        quantityInput.placeholder =
            'Enter quantity';

        quantityInput.inputMode =
            'decimal';

    }


    /* =====================================================
       GET EXISTING CART
    ===================================================== */

    let cart = [];

    try {

        cart =
            JSON.parse(
                localStorage.getItem('cart')
            ) || [];

    } catch (error) {

        cart = [];

    }


    /* =====================================================
       FIND EXISTING PRODUCT
    ===================================================== */

    const existingCartItem =
        cart.find(function (item) {

            return String(
                item.product_id
            ) ===
                String(
                    selectedProduct.id
                );

        });


    /* =====================================================
       SET QUANTITY
    ===================================================== */

    if (existingCartItem) {

        quantityInput.value =
            existingCartItem.quantity;

    }

    else {

        quantityInput.value =
            selectedProduct.minQty;

    }


    /* =====================================================
       RESET ERROR
    ===================================================== */

    if (error) {

        error.textContent =
            '';

    }


    /* =====================================================
       CALCULATE PRICE
    ===================================================== */

    calculateProductPrice();


    /* =====================================================
       OPEN MODAL
    ===================================================== */

    modal.classList.add('show');


    /* =====================================================
       FOCUS INPUT
    ===================================================== */

    setTimeout(function () {

        quantityInput.focus();

    }, 250);

}


/* =====================================================
   GET DISPLAY UNIT
===================================================== */

function getDisplayUnit(unit) {

    switch (unit) {

        case 'gram':
            return 'gram';

        case 'kg':
            return 'kg';

        case 'piece':
            return 'piece';

        case 'packet':
            return 'packet';

        case 'liter':
            return 'liter';

        default:
            return unit;

    }

}


/* =====================================================
   FORMAT QUANTITY
===================================================== */

function formatQuantity(quantity, unit) {

    const number =
        Number(quantity);


    if (!Number.isFinite(number)) {

        return '0 ' +
            getDisplayUnit(unit);

    }


    let formatted;


    if (
        Number.isInteger(number)
    ) {

        formatted =
            number;

    }

    else {

        formatted =
            number.toFixed(2);

    }


    return formatted +
        ' ' +
        getDisplayUnit(unit);

}


/* =====================================================
   CALCULATE TOTAL PRICE
===================================================== */

function calculateProductPrice() {

    if (!selectedProduct) {
        return;
    }


    const quantityInput =
        document.getElementById(
            'quantityInput'
        );

    const error =
        document.getElementById(
            'quantityError'
        );

    const calculatedPrice =
        document.getElementById(
            'calculatedPrice'
        );


    if (!quantityInput) {
        return;
    }


    const quantity =
        parseFloat(
            quantityInput.value
        ) || 0;


    /* =====================================================
       EMPTY / ZERO
    ===================================================== */

    if (
        quantity <= 0
    ) {

        if (error) {

            error.textContent =
                '';

        }


        if (calculatedPrice) {

            calculatedPrice.textContent =
                '₹0';

        }


        updateAddToCartButton(false);

        return;
    }


    /* =====================================================
       BELOW MINIMUM
    ===================================================== */

    if (
        quantity <
        selectedProduct.minQty
    ) {

        if (error) {

            error.textContent =
                'Minimum quantity is ' +
                formatQuantity(
                    selectedProduct.minQty,
                    selectedProduct.unit
                );

        }


        if (calculatedPrice) {

            calculatedPrice.textContent =
                '₹0';

        }


        updateAddToCartButton(false);

        return;
    }


    /* =====================================================
       TOTAL PRICE
    ===================================================== */

    let totalPrice = 0;


    /* =====================================================
       GRAM

       Example:

       700 gram
       ₹270/kg

       700 / 1000 × 270

       = ₹189
    ===================================================== */

    if (
        selectedProduct.unit === 'gram'
    ) {

        totalPrice =
            (
                quantity / 1000
            ) *
            selectedProduct.sellingPrice;

    }


    /* =====================================================
       KG

       Example:

       2 kg
       ₹800/kg

       = ₹1600
    ===================================================== */

    else if (
        selectedProduct.unit === 'kg'
    ) {

        totalPrice =
            quantity *
            selectedProduct.sellingPrice;

    }


    /* =====================================================
       PIECE

       IMPORTANT

       minimum_order_qty represents
       the number of pieces covered
       by the product price.

       Example:

       minimum_order_qty = 5
       selling_price = ₹300

       5 pieces = ₹300

       1 piece = ₹60

       6 pieces = ₹360
    ===================================================== */

    else if (
        selectedProduct.unit === 'piece'
    ) {

        if (
            selectedProduct.minQty <= 0
        ) {

            if (error) {

                error.textContent =
                    'Invalid minimum quantity.';

            }


            if (calculatedPrice) {

                calculatedPrice.textContent =
                    '₹0';

            }


            updateAddToCartButton(false);

            return;
        }


        const pricePerPiece =
            selectedProduct.sellingPrice /
            selectedProduct.minQty;


        totalPrice =
            quantity *
            pricePerPiece;

    }


    /* =====================================================
       PACKET
    ===================================================== */

    else if (
        selectedProduct.unit === 'packet'
    ) {

        totalPrice =
            quantity *
            selectedProduct.sellingPrice;

    }


    /* =====================================================
       LITER
    ===================================================== */

    else if (
        selectedProduct.unit === 'liter'
    ) {

        totalPrice =
            quantity *
            selectedProduct.sellingPrice;

    }


    /* =====================================================
       FALLBACK
    ===================================================== */

    else {

        totalPrice =
            quantity *
            selectedProduct.sellingPrice;

    }


    /* =====================================================
       SHOW TOTAL
    ===================================================== */

    if (error) {

        error.textContent =
            '';

    }


    if (calculatedPrice) {

        calculatedPrice.textContent =
            '₹' +
            totalPrice.toFixed(2);

    }


    updateAddToCartButton(true);

}


/* =====================================================
   UPDATE ADD TO CART BUTTON
===================================================== */

function updateAddToCartButton(isValid) {

    const button =
        document.getElementById(
            'modalAddCartBtn'
        );


    if (!button) {
        return;
    }


    button.disabled =
        !isValid;

}


/* =====================================================
   QUANTITY INPUT EVENT
===================================================== */

document.addEventListener(
    'input',
    function (event) {

        if (
            event.target &&
            event.target.id ===
            'quantityInput'
        ) {

            calculateProductPrice();

        }

    }
);


/* =====================================================
   ADD / UPDATE PRODUCT IN CART
===================================================== */

function addProductToCart() {

    if (!selectedProduct) {
        return;
    }


    const quantityInput =
        document.getElementById(
            'quantityInput'
        );

    const error =
        document.getElementById(
            'quantityError'
        );


    if (!quantityInput) {
        return;
    }


    const quantity =
        parseFloat(
            quantityInput.value
        ) || 0;


    /* =====================================================
       VALIDATION
    ===================================================== */

    if (
        quantity <= 0
    ) {

        if (error) {

            error.textContent =
                'Please enter quantity';

        }


        updateAddToCartButton(false);

        return;
    }


    /* =====================================================
       MINIMUM VALIDATION
    ===================================================== */

    if (
        quantity <
        selectedProduct.minQty
    ) {

        if (error) {

            error.textContent =
                'Minimum quantity is ' +
                formatQuantity(
                    selectedProduct.minQty,
                    selectedProduct.unit
                );

        }


        updateAddToCartButton(false);

        return;
    }


    /* =====================================================
       CALCULATE TOTAL
    ===================================================== */

    let totalPrice = 0;


    /* =====================================================
       GRAM
    ===================================================== */

    if (
        selectedProduct.unit === 'gram'
    ) {

        totalPrice =
            (
                quantity / 1000
            ) *
            selectedProduct.sellingPrice;

    }


    /* =====================================================
       KG
    ===================================================== */

    else if (
        selectedProduct.unit === 'kg'
    ) {

        totalPrice =
            quantity *
            selectedProduct.sellingPrice;

    }


    /* =====================================================
       PIECE

       Example:

       5 pieces = ₹300

       ₹300 / 5 = ₹60

       6 pieces = ₹360
    ===================================================== */

    else if (
        selectedProduct.unit === 'piece'
    ) {

        if (
            selectedProduct.minQty <= 0
        ) {

            if (error) {

                error.textContent =
                    'Invalid minimum quantity.';

            }

            return;
        }


        const pricePerPiece =
            selectedProduct.sellingPrice /
            selectedProduct.minQty;


        totalPrice =
            quantity *
            pricePerPiece;

    }


    /* =====================================================
       PACKET
    ===================================================== */

    else if (
        selectedProduct.unit === 'packet'
    ) {

        totalPrice =
            quantity *
            selectedProduct.sellingPrice;

    }


    /* =====================================================
       LITER
    ===================================================== */

    else if (
        selectedProduct.unit === 'liter'
    ) {

        totalPrice =
            quantity *
            selectedProduct.sellingPrice;

    }


    /* =====================================================
       FALLBACK
    ===================================================== */

    else {

        totalPrice =
            quantity *
            selectedProduct.sellingPrice;

    }


    /* =====================================================
       CART ITEM

       IMPORTANT:

       minimum_order_qty is stored here.

       For piece:

       minimum_order_qty = 5
       selling_price = 300

       Therefore:

       5 pieces = ₹300
    ===================================================== */


    const cartItem = {
        product_id: String(selectedProduct.id),
        quantity: quantity
    };



    /* =====================================================
       GET CART
    ===================================================== */

    let cart = [];

    try {

        cart =
            JSON.parse(
                localStorage.getItem('cart')
            ) || [];

    } catch (error) {

        cart = [];

    }


    /* =====================================================
       FIND SAME PRODUCT
    ===================================================== */

    const existingIndex =
        cart.findIndex(
            function (item) {

                return String(
                    item.product_id
                ) ===
                    String(
                        cartItem.product_id
                    );

            }
        );


    /* =====================================================
       UPDATE EXISTING PRODUCT
    ===================================================== */


    if (existingIndex !== -1) {
        cart[existingIndex].quantity = quantity;
    } else {
        cart.push(cartItem);
    }

    localStorage.setItem('cart', JSON.stringify(cart));


    /* =====================================================
       DEBUG
    ===================================================== */

    console.log(
        'Updated Cart:',
        cart
    );


    /* =====================================================
       CLOSE MODAL
    ===================================================== */

    closeQuantityModal();


    /* =====================================================
       UPDATE CART COUNT
    ===================================================== */

    if (
        typeof updateCartCount ===
        'function'
    ) {

        updateCartCount();

    }

    showCartNotification(
        ' added to cart successfully!'
    );

}


/* =====================================================
   CLOSE MODAL
===================================================== */

function closeQuantityModal() {

    const modal =
        document.getElementById(
            'quantityModal'
        );


    if (modal) {

        modal.classList.remove(
            'show'
        );

    }


    selectedProduct =
        null;

}


/* =====================================================
   FORMAT NUMBER
===================================================== */

function formatNumber(number) {

    const value =
        Number(number);


    if (!Number.isFinite(value)) {

        return 0;

    }


    return Number.isInteger(value)

        ? value

        : parseFloat(
            value.toFixed(2)
        );

}


/* =====================================================
   CART NOTIFICATION
===================================================== */

function showCartNotification(message) {

    let toast = document.getElementById('cartNotification');

    if (!toast) {

        toast = document.createElement('div');

        toast.id = 'cartNotification';

        toast.innerHTML = `
            <div class="cart-notification-icon">
                <i class="fa-solid fa-check"></i>
            </div>

            <div class="cart-notification-content">
                <strong>Added to cart</strong>
                <span></span>
            </div>
        `;

        document.body.appendChild(toast);
    }

    toast.querySelector('span').textContent = message;

    toast.classList.remove('show');

    // Restart animation
    void toast.offsetWidth;

    toast.classList.add('show');

    clearTimeout(toast.notificationTimer);

    toast.notificationTimer = setTimeout(function () {
        toast.classList.remove('show');
    }, 2500);
}




async function refreshCartFromDatabase() {
    let cart = [];

    try {
        cart = JSON.parse(localStorage.getItem('cart')) || [];
    } catch (error) {
        cart = [];
    }

    if (!cart.length) {
        localStorage.setItem('cart', JSON.stringify([]));
        return [];
    }

    const csrfToken = document.querySelector(
        'meta[name="csrf-token"]'
    )?.content;

    if (!csrfToken) {
        throw new Error('CSRF token is missing.');
    }

    const response = await fetch('/cart/refresh', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            cart: cart.map(item => ({
                product_id: item.product_id,
                quantity: item.quantity
            }))
        })
    });

    if (!response.ok) {
        throw new Error('Unable to refresh cart prices.');
    }

    const data = await response.json();

    if (!data.success || !Array.isArray(data.items)) {
        throw new Error('Cart refresh failed.');
    }

    // Save the latest database prices and product details.
    localStorage.setItem('cart', JSON.stringify(data.items));

    // Update the cart count if your function exists.
    if (typeof updateCartCount === 'function') {
        updateCartCount();
    }

    return data.items;
}

