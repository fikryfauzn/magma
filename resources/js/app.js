import './bootstrap';

import Lenis from 'lenis';

// Initialize Lenis
const lenis = new Lenis({
    duration: 1.2, // Scroll duration
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // Easing function
    smooth: true, // Enable smooth scrolling
    direction: 'vertical', // Can be 'vertical' or 'horizontal'
});

function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}

requestAnimationFrame(raf);
