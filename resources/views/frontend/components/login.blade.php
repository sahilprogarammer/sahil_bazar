{{-- =========================================================
     NONVEG BAZAR - LOGIN POPUP
========================================================= --}}

<div class="nvb-login-overlay" id="loginPopup">

    <div class="nvb-login-modal">

        {{-- Close --}}
        <button type="button"
            class="nvb-login-close"
            onclick="closeLoginPopup()">
            ×
        </button>

        {{-- ================= MOBILE STEP ================= --}}
        <div class="nvb-login-step active" id="mobileStep">

            <div class="nvb-login-icon">
                🥩
            </div>

            <div class="nvb-login-brand">
                <span>NONVEG</span> BAZAR
            </div>

            <h2>Welcome back 👋</h2>

            <p class="nvb-login-subtitle">
                Login to continue shopping fresh meat,
                chicken & more.
            </p>

            <div class="nvb-mobile-label">
                Mobile number
            </div>

            <div class="nvb-mobile-input">

                <span class="nvb-country-code">
                    +91
                </span>

                <span class="nvb-input-divider"></span>

                <input
                    type="tel"
                    id="loginMobile"
                    maxlength="10"
                    inputmode="numeric"
                    placeholder="Enter mobile number"
                    autocomplete="tel">

            </div>

            <p class="nvb-login-error" id="mobileError"></p>

            <button
                type="button"
                class="nvb-login-primary"
                onclick="sendLoginOTP()">

                <span>Continue</span>
                <span class="nvb-arrow">→</span>

            </button>

            <p class="nvb-login-policy">
                By continuing, you agree to our
                <a href="#">Terms</a> &
                <a href="#">Privacy Policy</a>.
            </p>

        </div>


        {{-- ================= OTP STEP ================= --}}
        <div class="nvb-login-step" id="otpStep">

            <button
                type="button"
                class="nvb-otp-back"
                onclick="backToMobile()">

                ← <span>Change number</span>

            </button>

            <div class="nvb-login-icon nvb-otp-icon">
                🔐
            </div>

            <div class="nvb-login-brand">
                <span>NONVEG</span> BAZAR
            </div>

            <h2>Verify your number</h2>

            <p class="nvb-login-subtitle">
                We sent a 6-digit OTP to
                <strong id="otpMobileText"></strong>
            </p>

            <div class="nvb-otp-container">

                <input type="tel" maxlength="1" class="nvb-otp-box">
                <input type="tel" maxlength="1" class="nvb-otp-box">
                <input type="tel" maxlength="1" class="nvb-otp-box">
                <input type="tel" maxlength="1" class="nvb-otp-box">
                <input type="tel" maxlength="1" class="nvb-otp-box">
                <input type="tel" maxlength="1" class="nvb-otp-box">

            </div>

            <p class="nvb-login-error" id="otpError"></p>

            <button
                type="button"
                class="nvb-login-primary"
                onclick="verifyLoginOTP()">

                <span>Verify & Login</span>
                <span class="nvb-arrow">→</span>

            </button>

            <div class="nvb-resend-area">

                <span>Didn't receive the OTP?</span>

                <button
                    type="button"
                    id="resendOtpBtn"
                    onclick="resendLoginOTP()"
                    disabled>

                    Resend OTP
                </button>

                <span
                    class="nvb-countdown"
                    id="otpCountdown">
                    30s
                </span>

            </div>

        </div>


        {{-- ================= SUCCESS STEP ================= --}}
        <div class="nvb-login-step" id="successStep">

            <div class="nvb-success-icon">
                ✓
            </div>

            <h2>You're logged in!</h2>

            <p class="nvb-login-subtitle">
                Welcome to Nonveg Bazar.
                Let's get something delicious.
            </p>

            <div class="nvb-success-loading">
                <span></span>
                Opening your account...
            </div>

        </div>

    </div>

</div>


<style>
    /* =========================================================
   NONVEG BAZAR LOGIN POPUP
========================================================= */

    .nvb-login-overlay {
        position: fixed;
        inset: 0;
        z-index: 99999;

        background: rgba(11, 20, 12, 0.62);
        backdrop-filter: blur(5px);

        display: flex;
        align-items: flex-end;
        justify-content: center;

        opacity: 0;
        visibility: hidden;

        transition:
            opacity .25s ease,
            visibility .25s ease;
    }

    .nvb-login-overlay.show {
        opacity: 1;
        visibility: visible;
    }


    .nvb-login-modal {
        width: 100%;
        max-width: 430px;

        background: #F7F8F5;

        border-radius: 28px 28px 0 0;

        padding: 30px 24px 25px;

        position: relative;

        transform: translateY(100%);

        transition:
            transform .35s cubic-bezier(.22, .61, .36, 1);

        box-shadow:
            0 -15px 50px rgba(0, 0, 0, .18);
    }

    .nvb-login-overlay.show .nvb-login-modal {
        transform: translateY(0);
    }


    /* Close */

    .nvb-login-close {
        position: absolute;

        right: 18px;
        top: 16px;

        width: 36px;
        height: 36px;

        border: none;
        border-radius: 50%;

        background: #E9EDE7;

        color: #172018;

        font-size: 24px;
        line-height: 1;

        cursor: pointer;
    }


    /* Steps */

    .nvb-login-step {
        display: none;
    }

    .nvb-login-step.active {
        display: block;
    }


    /* Icon */

    .nvb-login-icon {
        width: 64px;
        height: 64px;

        margin: 3px auto 16px;

        border-radius: 20px;

        background: #E5F1E8;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 29px;
    }

    .nvb-otp-icon {
        background: #FFF0E1;
    }


    /* Brand */

    .nvb-login-brand {
        text-align: center;

        font-size: 14px;
        font-weight: 800;

        letter-spacing: 2px;

        color: #172018;

        margin-bottom: 10px;
    }

    .nvb-login-brand span {
        color: #F47B20;
    }


    /* Heading */

    .nvb-login-modal h2 {
        margin: 0;

        text-align: center;

        color: #172018;

        font-size: 25px;
        line-height: 1.25;

        font-weight: 800;
    }

    .nvb-login-subtitle {
        margin: 10px auto 25px;

        max-width: 330px;

        text-align: center;

        color: #6D756D;

        font-size: 14px;
        line-height: 1.55;
    }


    /* Mobile label */

    .nvb-mobile-label {
        font-size: 13px;
        font-weight: 700;

        color: #303830;

        margin-bottom: 8px;
    }


    /* Mobile input */

    .nvb-mobile-input {
        height: 58px;

        display: flex;
        align-items: center;

        background: #FFFFFF;

        border: 1.5px solid #DCE2DB;

        border-radius: 15px;

        padding: 0 15px;

        transition: .2s;
    }

    .nvb-mobile-input:focus-within {
        border-color: #0F6B3C;

        box-shadow:
            0 0 0 4px rgba(15, 107, 60, .08);
    }

    .nvb-country-code {
        color: #172018;

        font-weight: 700;

        font-size: 15px;
    }

    .nvb-input-divider {
        width: 1px;
        height: 25px;

        background: #D9DED8;

        margin: 0 12px;
    }

    .nvb-mobile-input input {
        flex: 1;

        border: none;
        outline: none;

        background: transparent;

        color: #172018;

        font-size: 16px;

        font-family: inherit;
    }

    .nvb-mobile-input input::placeholder {
        color: #A0A7A0;
    }


    /* Error */

    .nvb-login-error {
        min-height: 18px;

        margin: 7px 2px 4px;

        color: #D93B30;

        font-size: 12px;
    }


    /* Primary button */

    .nvb-login-primary {
        width: 100%;
        height: 56px;

        margin-top: 4px;

        border: none;
        border-radius: 15px;

        background: #0F6B3C;

        color: #FFFFFF;

        display: flex;
        align-items: center;
        justify-content: center;

        gap: 10px;

        font-size: 15px;
        font-weight: 800;

        cursor: pointer;

        transition: .2s;
    }

    .nvb-login-primary:active {
        transform: scale(.98);
    }

    .nvb-arrow {
        font-size: 19px;
    }


    /* Policy */

    .nvb-login-policy {
        margin: 17px auto 0;

        max-width: 320px;

        text-align: center;

        color: #858C85;

        font-size: 11px;
        line-height: 1.5;
    }

    .nvb-login-policy a {
        color: #0F6B3C;
        text-decoration: none;
        font-weight: 700;
    }


    /* OTP */

    .nvb-otp-back {
        border: none;

        background: transparent;

        padding: 0;

        margin-bottom: 20px;

        color: #0F6B3C;

        font-size: 13px;

        font-weight: 700;

        cursor: pointer;
    }

    .nvb-otp-back span {
        margin-left: 4px;
    }


    /* OTP boxes */

    .nvb-otp-container {
        display: flex;

        justify-content: center;

        gap: 8px;

        margin: 12px 0 4px;
    }

    .nvb-otp-box {
        width: 45px;
        height: 52px;

        border: 1.5px solid #DCE2DB;

        border-radius: 13px;

        background: #FFFFFF;

        outline: none;

        text-align: center;

        font-size: 20px;

        font-weight: 800;

        color: #172018;

        transition: .2s;
    }

    .nvb-otp-box:focus {
        border-color: #0F6B3C;

        box-shadow:
            0 0 0 4px rgba(15, 107, 60, .08);
    }


    /* Resend */

    .nvb-resend-area {
        margin-top: 19px;

        text-align: center;

        font-size: 12px;

        color: #858C85;
    }

    .nvb-resend-area button {
        border: none;
        background: transparent;

        color: #0F6B3C;

        font-weight: 800;

        margin-left: 4px;

        cursor: pointer;
    }

    .nvb-resend-area button:disabled {
        color: #A6ADA6;

        cursor: default;
    }

    .nvb-countdown {
        margin-left: 3px;

        color: #F47B20;

        font-weight: 700;
    }


    /* Success */

    #successStep {
        padding: 30px 0 20px;
    }

    .nvb-success-icon {
        width: 75px;
        height: 75px;

        margin: 15px auto 22px;

        border-radius: 50%;

        background: #DFF1E5;

        color: #0F6B3C;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 38px;
        font-weight: 800;
    }

    .nvb-success-loading {
        margin-top: 25px;

        text-align: center;

        color: #858C85;

        font-size: 12px;
    }

    .nvb-success-loading span {
        display: inline-block;

        width: 8px;
        height: 8px;

        margin-right: 5px;

        border-radius: 50%;

        background: #F47B20;

        animation: nvbPulse 1s infinite;
    }

    @keyframes nvbPulse {

        0%,
        100% {
            opacity: .3;
        }

        50% {
            opacity: 1;
        }
    }


    /* =========================================================
   DESKTOP
   Still keeps the mobile-app appearance
========================================================= */

    @media (min-width: 600px) {

        .nvb-login-overlay {
            align-items: center;
        }

        .nvb-login-modal {
            border-radius: 28px;

            max-width: 420px;

            transform: translateY(30px) scale(.97);
        }

        .nvb-login-overlay.show .nvb-login-modal {
            transform: translateY(0) scale(1);
        }
    }


    /* Very small phones */

    @media (max-width: 360px) {

        .nvb-login-modal {
            padding-left: 18px;
            padding-right: 18px;
        }

        .nvb-otp-container {
            gap: 5px;
        }

        .nvb-otp-box {
            width: 41px;
            height: 49px;
        }

    }
</style>


<script>
    /* =========================================================
   NONVEG BAZAR LOGIN JAVASCRIPT
========================================================= */

    let loginMobileNumber = '';
    let otpTimer = null;


    /*
    |--------------------------------------------------------------------------
    | OPEN LOGIN
    |--------------------------------------------------------------------------
    */

    function openLoginPopup() {

        const popup = document.getElementById('loginPopup');

        popup.classList.add('show');

        document.body.style.overflow = 'hidden';

        showMobileStep();

        // setTimeout(() => {

        //     document.getElementById('loginMobile').focus();

        // }, 350);
    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE LOGIN
    |--------------------------------------------------------------------------
    */

    function closeLoginPopup() {

        const popup = document.getElementById('loginPopup');

        popup.classList.remove('show');

        document.body.style.overflow = '';

    }


    /*
    |--------------------------------------------------------------------------
    | SHOW MOBILE STEP
    |--------------------------------------------------------------------------
    */

    function showMobileStep() {

        document.querySelectorAll('.nvb-login-step')
            .forEach(step => {

                step.classList.remove('active');

            });

        document.getElementById('mobileStep')
            .classList.add('active');

    }


    /*
    |--------------------------------------------------------------------------
    | SEND OTP
    |--------------------------------------------------------------------------
    */

    async function sendLoginOTP() {

        const mobileInput =
            document.getElementById('loginMobile');

        const error =
            document.getElementById('mobileError');

        const mobile =
            mobileInput.value.trim();

        error.textContent = '';

        if (!/^[6-9][0-9]{9}$/.test(mobile)) {

            error.textContent =
                'Please enter a valid 10-digit mobile number.';

            return;
        }

        try {

            const response = await fetch(
                "{{ route('login.sendOtp') }}", {
                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]'
                        ).getAttribute('content')
                    },

                    body: JSON.stringify({
                        mobile: mobile
                    })
                }
            );

            const data = await response.json();

            if (!response.ok || !data.status) {

                error.textContent =
                    data.message ||
                    'Unable to send OTP.';

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | OTP SENT SUCCESSFULLY
            |--------------------------------------------------------------------------
            */

            loginMobileNumber = mobile;

            document.getElementById('otpMobileText')
                .textContent =
                '+91 ' +
                mobile.substring(0, 2) +
                '******' +
                mobile.substring(8);

            /*
            |--------------------------------------------------------------------------
            | SHOW OTP STEP
            |--------------------------------------------------------------------------
            */

            document.querySelectorAll('.nvb-login-step')
                .forEach(step => {
                    step.classList.remove('active');
                });

            document.getElementById('otpStep')
                .classList.add('active');

            clearOTPInputs();

            startOTPCountdown();

            /*
             * Keyboard will NOT automatically open.
             */

        } catch (error) {

            console.error(error);

            document.getElementById('mobileError')
                .textContent =
                'Something went wrong. Please try again.';
        }
    }


    /*
    |--------------------------------------------------------------------------
    | OTP INPUT
    |--------------------------------------------------------------------------
    */

    document.addEventListener('input', function(e) {

        if (!e.target.classList.contains('nvb-otp-box')) {
            return;
        }

        e.target.value =
            e.target.value.replace(/\D/g, '');

        if (e.target.value.length === 1) {

            const next =
                e.target.nextElementSibling;

            if (next &&
                next.classList.contains('nvb-otp-box')) {

                next.focus();

            }

        }

    });


    /*
    |--------------------------------------------------------------------------
    | OTP BACKSPACE
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function(e) {

        if (!e.target.classList.contains('nvb-otp-box')) {
            return;
        }

        if (
            e.key === 'Backspace' &&
            e.target.value === ''
        ) {

            const previous =
                e.target.previousElementSibling;

            if (previous &&
                previous.classList.contains('nvb-otp-box')) {

                previous.focus();

            }

        }

    });


    /*
    |--------------------------------------------------------------------------
    | VERIFY OTP
    |--------------------------------------------------------------------------
    */

    async function verifyLoginOTP() {

        const boxes =
            document.querySelectorAll('.nvb-otp-box');

        const error =
            document.getElementById('otpError');

        let otp = '';

        boxes.forEach(box => {
            otp += box.value;
        });

        error.textContent = '';

        if (otp.length !== 6) {

            error.textContent =
                'Please enter the complete 6-digit OTP.';

            return;
        }

        try {

            const response = await fetch(
                "{{ route('login.verifyOtp') }}", {
                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]'
                        ).getAttribute('content')
                    },

                    body: JSON.stringify({
                        mobile: loginMobileNumber,
                        otp: otp
                    })
                }
            );

            const data = await response.json();

            if (!response.ok || !data.status) {

                error.textContent =
                    data.message ||
                    'Invalid OTP. Please try again.';

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | LOGIN SUCCESS
            |--------------------------------------------------------------------------
            */

            document.querySelectorAll('.nvb-login-step')
                .forEach(step => {
                    step.classList.remove('active');
                });

            document.getElementById('successStep')
                .classList.add('active');

            clearInterval(otpTimer);

            /*
            |--------------------------------------------------------------------------
            | REDIRECT
            |--------------------------------------------------------------------------
            */

            setTimeout(() => {

                window.location.href =
                    data.redirect;

            }, 1200);

        } catch (error) {

            console.error(error);

            document.getElementById('otpError')
                .textContent =
                'Something went wrong. Please try again.';
        }
    }


    /*
    |--------------------------------------------------------------------------
    | LOGIN SUCCESS
    |--------------------------------------------------------------------------
    */

    function showLoginSuccess() {

        document.querySelectorAll('.nvb-login-step')
            .forEach(step => {

                step.classList.remove('active');

            });

        document.getElementById('successStep')
            .classList.add('active');

        setTimeout(() => {

            closeLoginPopup();

            /*
             * Redirect after successful login
             */

            window.location.href =
                "{{ route('home') }}";

        }, 1500);

    }


    /*
    |--------------------------------------------------------------------------
    | RESEND OTP
    |--------------------------------------------------------------------------
    */

    async function resendLoginOTP() {

        if (!loginMobileNumber) {
            return;
        }

        const error =
            document.getElementById('otpError');

        error.textContent = '';

        try {

            const response = await fetch(
                "{{ route('login.sendOtp') }}", {
                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]'
                        ).getAttribute('content')
                    },

                    body: JSON.stringify({
                        mobile: loginMobileNumber
                    })
                }
            );

            const data = await response.json();

            if (!response.ok || !data.status) {

                error.textContent =
                    data.message ||
                    'Unable to resend OTP.';

                return;
            }

            startOTPCountdown();

        } catch (error) {

            console.error(error);

            document.getElementById('otpError')
                .textContent =
                'Unable to resend OTP.';
        }
    }


    /*
    |--------------------------------------------------------------------------
    | OTP COUNTDOWN
    |--------------------------------------------------------------------------
    */

    function startOTPCountdown() {

        const button =
            document.getElementById('resendOtpBtn');

        const countdown =
            document.getElementById('otpCountdown');

        let seconds = 30;

        button.disabled = true;

        countdown.textContent =
            seconds + 's';

        clearInterval(otpTimer);

        otpTimer = setInterval(() => {

            seconds--;

            countdown.textContent =
                seconds + 's';

            if (seconds <= 0) {

                clearInterval(otpTimer);

                button.disabled = false;

                countdown.textContent = '';

            }

        }, 1000);

    }


    /*
    |--------------------------------------------------------------------------
    | BACK TO MOBILE
    |--------------------------------------------------------------------------
    */

    function backToMobile() {

        clearInterval(otpTimer);

        showMobileStep();

        // setTimeout(() => {

        //     document.getElementById('loginMobile')
        //         .focus();

        // }, 150);

    }


    /*
    |--------------------------------------------------------------------------
    | CLEAR OTP
    |--------------------------------------------------------------------------
    */

    function clearOTPInputs() {

        document.querySelectorAll('.nvb-otp-box')
            .forEach(box => {

                box.value = '';

            });

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE WHEN CLICK OUTSIDE
    |--------------------------------------------------------------------------
    */

    document.getElementById('loginPopup')
        .addEventListener('click', function(e) {

            if (e.target === this) {

                closeLoginPopup();

            }

        });


    /*
    |--------------------------------------------------------------------------
    | ESC KEY
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function(e) {

        if (e.key === 'Escape') {

            closeLoginPopup();

        }

    });
</script>