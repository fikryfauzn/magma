document.addEventListener('DOMContentLoaded', () => {
    // Overlay menu logic
    const logo = document.getElementById('logo');
    const overlayMenu = document.getElementById('overlayMenu');
    let overlayVisible = false;
    let lastScrollTop = 0;
    const delta = 15; // Minimum scroll distance to trigger the effect
    const header = document.getElementById('myheader'); // Ensure the header has this ID
    

    

    window.addEventListener('scroll', () => {
        const st = window.scrollY || document.documentElement.scrollTop;
        const windowHeight = window.innerHeight;
        const scrollY = window.scrollY;
        const pageHeight = document.documentElement.scrollHeight;

        // Check if user reached the bottom of the page
        const bottomOfPageReached = (windowHeight + scrollY) >= (pageHeight - 5);
        console.log("Bottom of page reached:", bottomOfPageReached);

        if (bottomOfPageReached) {
            // Force show header when at the bottom of the page
            header.style.transform = "translateY(0)";
            return; // Exit to prevent any further scroll logic
        }

        // Only proceed if the scroll distance is more than `delta`
        if (Math.abs(lastScrollTop - st) <= delta) return;

        if (st > lastScrollTop) {
            // Scrolling down - hide the header
            header.style.transform = "translateY(-100%)";
        } else {
            // Scrolling up - show the header
            header.style.transform = "translateY(0)";
        }

        lastScrollTop = st;
    });

    // Overlay menu toggle logic
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

    // Dropdown toggle for user icon
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