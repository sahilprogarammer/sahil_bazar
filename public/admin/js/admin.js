/* =========================================================
   NONVEG BAZAR — ADMIN PANEL
   Main Admin JavaScript
========================================================= */


/* =========================================================
   DOM READY
========================================================= */

document.addEventListener('DOMContentLoaded', function () {

    initializeSidebar();

    initializeDropdowns();

    initializeNavLinks();

    initializeResponsiveSidebar();

});


/* =========================================================
   SIDEBAR
========================================================= */

function initializeSidebar() {

    const sidebar =
        document.getElementById('sidebar');

    const overlay =
        document.getElementById('sidebarOverlay');

    if (!sidebar) {
        return;
    }


    window.toggleSidebar = function () {

        sidebar.classList.toggle('open');

        if (overlay) {
            overlay.classList.toggle('show');
        }

        document.body.classList.toggle(
            'sidebar-open'
        );

    };


    window.closeSidebar = function () {

        sidebar.classList.remove('open');

        if (overlay) {
            overlay.classList.remove('show');
        }

        document.body.classList.remove(
            'sidebar-open'
        );

    };


    /* Close when clicking overlay */

    if (overlay) {

        overlay.addEventListener(
            'click',
            function () {

                closeSidebar();

            }
        );

    }

}


/* =========================================================
   NAVIGATION LINKS
========================================================= */

function initializeNavLinks() {

    const navItems =
        document.querySelectorAll('.nav-item');

    navItems.forEach(function (item) {

        item.addEventListener(
            'click',
            function () {

                if (window.innerWidth <= 900) {

                    closeSidebar();

                }

            }
        );

    });

}


/* =========================================================
   RESPONSIVE SIDEBAR
========================================================= */

function initializeResponsiveSidebar() {

    let previousWidth =
        window.innerWidth;


    window.addEventListener(
        'resize',
        function () {

            const currentWidth =
                window.innerWidth;


            /*
             * If moving from mobile to desktop,
             * reset sidebar state.
             */

            if (
                previousWidth <= 900 &&
                currentWidth > 900
            ) {

                closeSidebar();

            }


            previousWidth =
                currentWidth;

        }
    );

}


/* =========================================================
   DROPDOWNS
========================================================= */

function initializeDropdowns() {

    const dropdownButtons =
        document.querySelectorAll(
            '[data-dropdown]'
        );


    dropdownButtons.forEach(function (button) {

        button.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();


                const dropdownId =
                    button.getAttribute(
                        'data-dropdown'
                    );


                const dropdown =
                    document.getElementById(
                        dropdownId
                    );


                if (!dropdown) {
                    return;
                }


                document
                    .querySelectorAll(
                        '.admin-dropdown.show'
                    )
                    .forEach(function (item) {

                        if (item !== dropdown) {

                            item.classList.remove(
                                'show'
                            );

                        }

                    });


                dropdown.classList.toggle(
                    'show'
                );

            }
        );

    });


    /* Close dropdown when clicking outside */

    document.addEventListener(
        'click',
        function () {

            document
                .querySelectorAll(
                    '.admin-dropdown.show'
                )
                .forEach(function (dropdown) {

                    dropdown.classList.remove(
                        'show'
                    );

                });

        }
    );

}


/* =========================================================
   CONFIRM ACTION
========================================================= */

function confirmAction(
    message = 'Are you sure you want to continue?'
) {

    return window.confirm(message);

}


/* =========================================================
   DELETE CONFIRMATION
========================================================= */

function confirmDelete(
    itemName = 'this item'
) {

    return window.confirm(
        'Are you sure you want to delete ' +
        itemName +
        '? This action cannot be undone.'
    );

}


/* =========================================================
   SELECT ALL CHECKBOXES
========================================================= */

function initializeSelectAll() {

    const selectAll =
        document.querySelector(
            '[data-select-all]'
        );


    if (!selectAll) {
        return;
    }


    selectAll.addEventListener(
        'change',
        function () {

            const checkboxes =
                document.querySelectorAll(
                    '[data-row-checkbox]'
                );


            checkboxes.forEach(
                function (checkbox) {

                    checkbox.checked =
                        selectAll.checked;

                }
            );

        }
    );

}


/* =========================================================
   TABLE ROW CHECKBOX
========================================================= */

function updateSelectAllState() {

    const selectAll =
        document.querySelector(
            '[data-select-all]'
        );


    const checkboxes =
        document.querySelectorAll(
            '[data-row-checkbox]'
        );


    if (
        !selectAll ||
        checkboxes.length === 0
    ) {

        return;

    }


    const checked =
        document.querySelectorAll(
            '[data-row-checkbox]:checked'
        );


    selectAll.checked =
        checked.length ===
        checkboxes.length;

}


/* =========================================================
   SEARCH FILTER
========================================================= */

function filterTable(
    input,
    tableSelector
) {

    if (!input) {
        return;
    }


    const searchValue =
        input.value
            .toLowerCase()
            .trim();


    const table =
        document.querySelector(
            tableSelector
        );


    if (!table) {
        return;
    }


    const rows =
        table.querySelectorAll(
            'tbody tr'
        );


    rows.forEach(function (row) {

        const text =
            row.textContent
                .toLowerCase();


        if (
            text.includes(searchValue)
        ) {

            row.style.display = '';

        } else {

            row.style.display = 'none';

        }

    });

}


/* =========================================================
   TOAST NOTIFICATION
========================================================= */

function showToast(
    message,
    type = 'success'
) {

    let container =
        document.getElementById(
            'adminToastContainer'
        );


    if (!container) {

        container =
            document.createElement('div');

        container.id =
            'adminToastContainer';

        container.className =
            'admin-toast-container';

        document.body.appendChild(
            container
        );

    }


    const toast =
        document.createElement('div');


    toast.className =
        'admin-toast ' + type;


    let icon =
        '✓';


    if (type === 'error') {
        icon = '!';
    }

    if (type === 'warning') {
        icon = '!';
    }

    if (type === 'info') {
        icon = 'i';
    }


    toast.innerHTML = `

        <span class="toast-icon">
            ${icon}
        </span>

        <span class="toast-message">
            ${message}
        </span>

        <button
            type="button"
            class="toast-close"
            onclick="this.parentElement.remove()">

            ×

        </button>

    `;


    container.appendChild(
        toast
    );


    setTimeout(function () {

        toast.classList.add(
            'hide'
        );


        setTimeout(function () {

            toast.remove();

        }, 300);


    }, 3500);

}


/* =========================================================
   LOADING BUTTON
========================================================= */

function setButtonLoading(
    button,
    loading = true
) {

    if (!button) {
        return;
    }


    if (loading) {

        button.dataset.originalText =
            button.innerHTML;


        button.disabled = true;


        button.innerHTML = `

            <span class="button-spinner"></span>

            Processing...

        `;

    } else {

        button.disabled = false;


        if (
            button.dataset.originalText
        ) {

            button.innerHTML =
                button.dataset.originalText;

        }

    }

}


/* =========================================================
   PASSWORD TOGGLE
========================================================= */

function togglePassword(
    inputId,
    button
) {

    const input =
        document.getElementById(
            inputId
        );


    if (!input) {
        return;
    }


    if (
        input.type === 'password'
    ) {

        input.type = 'text';

        if (button) {
            button.innerHTML = '🙈';
        }

    } else {

        input.type = 'password';

        if (button) {
            button.innerHTML = '👁';
        }

    }

}


/* =========================================================
   IMAGE PREVIEW
========================================================= */

function previewImage(
    input,
    previewId
) {

    if (
        !input ||
        !input.files ||
        !input.files[0]
    ) {

        return;

    }


    const preview =
        document.getElementById(
            previewId
        );


    if (!preview) {
        return;
    }


    const reader =
        new FileReader();


    reader.onload =
        function (event) {

            preview.src =
                event.target.result;

            preview.style.display =
                'block';

        };


    reader.readAsDataURL(
        input.files[0]
    );

}


/* =========================================================
   NUMBER FORMAT
========================================================= */

function formatNumber(
    number
) {

    return new Intl.NumberFormat(
        'en-IN'
    ).format(number);

}


/* =========================================================
   INDIAN CURRENCY
========================================================= */

function formatCurrency(
    amount
) {

    return new Intl.NumberFormat(
        'en-IN',
        {
            style: 'currency',
            currency: 'INR',
            maximumFractionDigits: 0
        }
    ).format(amount);

}


/* =========================================================
   AUTO HIDE ALERT
========================================================= */

function initializeAlerts() {

    const alerts =
        document.querySelectorAll(
            '[data-auto-hide]'
        );


    alerts.forEach(function (alert) {

        const delay =
            parseInt(
                alert.dataset.autoHide
            ) || 4000;


        setTimeout(function () {

            alert.classList.add(
                'hide'
            );


            setTimeout(function () {

                alert.remove();

            }, 300);


        }, delay);

    });

}


/* =========================================================
   INITIALIZE CHECKBOX SYSTEM
========================================================= */

document.addEventListener(
    'change',
    function (event) {

        if (
            event.target.matches(
                '[data-select-all]'
            )
        ) {

            const checkboxes =
                document.querySelectorAll(
                    '[data-row-checkbox]'
                );


            checkboxes.forEach(
                function (checkbox) {

                    checkbox.checked =
                        event.target.checked;

                }
            );

        }


        if (
            event.target.matches(
                '[data-row-checkbox]'
            )
        ) {

            updateSelectAllState();

        }

    }
);


/* =========================================================
   ESCAPE KEY
========================================================= */

document.addEventListener(
    'keydown',
    function (event) {

        if (
            event.key === 'Escape'
        ) {

            closeSidebar();


            document
                .querySelectorAll(
                    '.admin-dropdown.show'
                )
                .forEach(
                    function (dropdown) {

                        dropdown.classList.remove(
                            'show'
                        );

                    }
                );

        }

    }
);


/* =========================================================
   PAGE LOADED
========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    function () {

        initializeSelectAll();

        initializeAlerts();

    }
);