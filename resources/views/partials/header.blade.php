<header>
    <div class="logo" id="logo">agriWheel</div>
    
    <!-- Conditionally display links or icons based on login status -->
    <div class="auth-links">
        @guest
            <!-- If the user is not logged in, show Register and Log In links -->
            <a href="{{ url('/register') }}">REGISTER</a>
            <a href="{{ url('/login') }}">LOG IN</a>
        @endguest

        @auth
            <!-- If the user is logged in, show icons for notifications, user profile, and cart -->
            <a href="{{ url('/notifications') }}">
                <img src="{{ asset('icons/bell_icon.png') }}" alt="Notifications" style="width: 24px; height: 24px;">
            </a>
            <div class="dropdown">
    <img src="{{ asset('icons/user_icon.png') }}" alt="User Icon" class="icon user-icon" id="userIcon">
    <div class="dropdown-menu" id="userDropdown">
        <a href="{{ route('profile') }}">Profile</a>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

            <a href="{{ url('/cart') }}">
                <img src="{{ asset('icons/cart_icon.png') }}" alt="Cart" style="width: 24px; height: 24px;">
            </a>
        @endauth
    </div>
</header>

<!-- Overlay Menu -->
<div class="overlay-menu" id="overlayMenu">
    <div class="overlay-logo">agriWheel</div>
    <div class="overlay-content">
        <div class="menu-column">
            <h3><a href="{{ route('catalog') }}" style="text-decoration: none; color: inherit;">Products</a></h3> <!-- Main Products Link -->
            <a href="{{ route('products.show', ['slug' => 'grove']) }}">Grove</a>
            <a href="{{ route('products.show', ['slug' => 'cihuy']) }}">Cihuy</a>
            <a href="{{ route('products.show', ['slug' => 'asoy']) }}">Asoy</a>
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
            <a href="{{ route('services') }}">Services</a>
        </div>
    </div>
</div>


<script>
    const logo = document.getElementById('logo');
    const overlayMenu = document.getElementById('overlayMenu');
    const header = document.querySelector('header');

    //Function to determine if background is light or dark
    function updateHeaderStyle() {
        const darkBackgroundThreshold = 150; // Adjust threshold as needed
        const bgColor = getComputedStyle(document.body).backgroundColor;
        
        const [r, g, b] = bgColor.match(/\d+/g).map(Number);
        const brightness = (r * 0.299 + g * 0.587 + b * 0.114); // Calculate perceived brightness

        if (brightness > darkBackgroundThreshold) {
            header.classList.remove('dark');
            header.classList.add('light');
        } else {
            header.classList.remove('light');
            header.classList.add('dark');
        }
    }

    // Event listener to update header style on scroll
    window.addEventListener('scroll', updateHeaderStyle);
    updateHeaderStyle(); // Initial check on load

    let overlayVisible = false;

    logo.addEventListener('mouseenter', () => {
        overlayMenu.classList.add('active');
        overlayVisible = true;
    });

    logo.addEventListener('mouseleave', () => {
        if (!overlayVisible) overlayMenu.classList.remove('active');
    });

    overlayMenu.addEventListener('mouseenter', () => {
        overlayVisible = true;
    });

    overlayMenu.addEventListener('mouseleave', () => {
        overlayMenu.classList.remove('active');
        overlayVisible = false;
    });

    document.addEventListener('DOMContentLoaded', () => {
    const userIcon = document.getElementById('userIcon');
    const userDropdown = document.getElementById('userDropdown');

    userIcon.addEventListener('click', () => {
        userDropdown.classList.toggle('show');
    });

    // Close the dropdown if clicked outside
    document.addEventListener('click', (event) => {
        if (!userIcon.contains(event.target) && !userDropdown.contains(event.target)) {
            userDropdown.classList.remove('show');
        }
    });
});


    

    
</script>
