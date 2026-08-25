<nav class="bottom-nav">

    <a href="{{ url('/Home') }}"
       class="nav-item {{ request()->is('/Home') ? 'active' : '' }}">

        <span class="nav-icon">
            ⌂
        </span>

        <span class="nav-label">
            Home
        </span>

    </a>


    <a href="#"
       class="nav-item">

        <span class="nav-icon">
            ⌕
        </span>

        <span class="nav-label">
            Explore
        </span>

    </a>


    <a href="{{ route('cart') }}"
       class="nav-item">

        <span class="cart-wrapper">

            <span class="nav-icon">
                🛒
            </span>

            <span class="cart-count">
                2
            </span>

        </span>

        <span class="nav-label">
            Cart
        </span>

    </a>


    <a href="#"
       class="nav-item">

        <span class="nav-icon">
            📦
        </span>

        <span class="nav-label">
            Orders
        </span>

    </a>


    <a href="#"
       class="nav-item">

        <span class="nav-icon">
            👤
        </span>

        <span class="nav-label">
            Account
        </span>

    </a>

</nav>