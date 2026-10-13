<div id="quantityModal" class="quantity-modal">

    <div class="quantity-modal-content">

        <!-- CLOSE -->
        <button
            type="button"
            class="modal-close"
            onclick="closeQuantityModal()">
            ×
        </button>


        <!-- PRODUCT NAME -->
        <h2 id="modalProductName"></h2>


        <!-- MINIMUM -->
        <p>
            Minimum:
            <strong id="modalMinQty"></strong>
        </p>


        <!-- PRICE -->
        <p>
            Price:
            <strong id="modalPrice"></strong>
            /
            <span id="modalPriceUnit"></span>
        </p>


        <!-- QUANTITY INPUT -->
        <div class="quantity-input-wrapper">

            <input
                type="number"
                id="quantityInput"
                min="0"
                step="1"
                placeholder="Enter quantity"
                inputmode="decimal">

            <span id="quantityUnit"></span>

        </div>


        <!-- ERROR -->
        <div
            id="quantityError"
            class="quantity-error">
        </div>


        <!-- CALCULATED PRICE -->
        <div class="calculated-price">

            <span>Total:</span>

            <strong id="calculatedPrice">
                ₹0
            </strong>

        </div>


        <!-- ADD TO CART -->
        <button
            type="button"
            id="modalAddCartBtn"
            class="modal-add-cart"
            onclick="addProductToCart()"
            disabled>

            <span>
                Add to Cart
            </span>

            <span class="cart-arrow">
                →
            </span>

        </button>

    </div>

</div>

