<!-- resources/views/partials/header.blade.php -->
<header class="page-header" id="myheader">
    <div class="logo" id="logo">agriWheel</div>
    <div class="auth-links">
        @guest
        <a href="{{ url('/register') }}">REGISTER</a>
        <a href="{{ url('/login') }}">LOG IN</a>
        @endguest
        @auth
        <a href="{{ url('/notifications') }}">
            <img src="{{ asset('icons/bell_icon.png') }}" alt="Notifications">
        </a>
        <div class="dropdown">
            <img src="{{ asset('icons/user_icon.png') }}" alt="User Icon" id="userIcon">
            <div class="dropdown-menu" id="userDropdown">
                <a href="{{ route('profile') }}">Profile</a>
                <a href="{{ route('transactions.index') }}">Transactions</a> <!-- Added Transactions link -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
        <a href="{{ url('/cart') }}">
            <img src="{{ asset('icons/cart_icon.png') }}" alt="Cart">
        </a>
        @endauth
    </div>
    <!-- Overlay Menu -->
    <div class="overlay-menu" id="overlayMenu">
        <a href="{{ route('home') }}" class="overlay-logo">agriWheel</a> <!-- Wrap logo in a link -->
        <div class="overlay-content">
            <div class="menu-column">
                <h3><a href="{{ route('catalog') }}" style="text-decoration: none; color: inherit;">Products</a></h3>
                <a href="{{ route('products.show', ['slug' => 'grove']) }}">Grove</a>
                <a href="{{ route('products.show', ['slug' => 'move']) }}">Move</a>
                <a href="{{ route('products.show', ['slug' => 'jove']) }}">Jove</a>
            </div>
            <div class="menu-column">
                <h3>Company</h3>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
            <div class="menu-column">
                <h3>Resources</h3>
                <a href="{{ route('faq') }}">FAQ</a>
                <a href="{{ route('guide') }}">Guide</a>
                <a href="{{ route('services.index') }}">Services</a>
            </div>
        </div>
    </div>
</header>