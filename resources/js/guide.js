document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.product-slide');
    let currentSlideIndex = 0;

    // Show the initial slide
    slides[currentSlideIndex].classList.add('active');

    // Carousel navigation function
    const showSlide = (index) => {
        // Remove active class from all slides
        slides.forEach((slide) => slide.classList.remove('active'));

        // Add active class to the current slide
        slides[index].classList.add('active');

        // Handle button visibility
        handleButtonVisibility();
    };

    // Function to handle enabling/disabling navigation buttons
    const handleButtonVisibility = () => {
        const prevButton = document.querySelector('.carousel-control.prev');
        const nextButton = document.querySelector('.carousel-control.next');

        // If at the beginning, disable the "prev" button
        if (currentSlideIndex === 0) {
            prevButton.style.display = 'none';
        } else {
            prevButton.style.display = 'block';
        }

        // If at the end, disable the "next" button
        if (currentSlideIndex === slides.length - 1) {
            nextButton.style.display = 'none';
        } else {
            nextButton.style.display = 'block';
        }
    };

    // Event listeners for the buttons
    document.querySelector('.carousel-control.prev').addEventListener('click', () => {
        if (currentSlideIndex > 0) {
            currentSlideIndex--;
            showSlide(currentSlideIndex);
        }
    });

    document.querySelector('.carousel-control.next').addEventListener('click', () => {
        if (currentSlideIndex < slides.length - 1) {
            currentSlideIndex++;
            showSlide(currentSlideIndex);
        }
    });

    // Initial call to handle button visibility
    handleButtonVisibility();
});
