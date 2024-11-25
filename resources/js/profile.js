document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    const welcomeMessage = document.getElementById('welcome-message');
    const buttonSection = document.getElementById('button-section');
    const editProfileButton = document.getElementById('edit-profile-button');
    const changePasswordButton = document.getElementById('change-password-button');
    const editProfileForm = document.getElementById('edit-profile-form');
    const changePasswordForm = document.getElementById('change-password-form');
    const backProfileButton = document.getElementById('back-profile-button');
    const backPasswordButton = document.getElementById('back-password-button');
    const alertMessages = document.querySelectorAll('.alert');

    // Function to fade out an element
    function fadeOut(element, callback) {
        element.style.transition = 'opacity 1.5s ease';
        element.style.opacity = '0';
        setTimeout(() => {
            element.style.display = 'none';
            if (callback) callback();
        }, 1500);
    }

    // Function to fade in an element
    function fadeIn(element) {
        element.style.display = 'flex';
        element.style.opacity = '0';
        setTimeout(() => {
            element.style.transition = 'opacity 1.5s ease';
            element.style.opacity = '1';
        }, 10);
    }

    // Automatically hide alert messages after 3 seconds
    if (alertMessages.length > 0) {
        setTimeout(() => {
            alertMessages.forEach(alert => {
                fadeOut(alert);
            });
        }, 3000); // Hide after 3 seconds
    }

    // Function to clear feedback messages when starting a new action
    function clearAlerts() {
        alertMessages.forEach(alert => {
            alert.style.display = 'none';
        });
    }

    // Event listener for Edit Profile Button
    editProfileButton.addEventListener('click', function() {
        clearAlerts();
        fadeOut(welcomeMessage);
        fadeOut(buttonSection, () => {
            fadeIn(editProfileForm);
        });
    });

    // Event listener for Change Password Button
    changePasswordButton.addEventListener('click', function() {
        clearAlerts();
        fadeOut(welcomeMessage);
        fadeOut(buttonSection, () => {
            fadeIn(changePasswordForm);
        });
    });

    // Event listener for Back Button in Edit Profile Form
    backProfileButton.addEventListener('click', function() {
        clearAlerts();
        fadeOut(editProfileForm, () => {
            fadeIn(welcomeMessage);
            fadeIn(buttonSection);
        });
    });

    // Event listener for Back Button in Change Password Form
    backPasswordButton.addEventListener('click', function() {
        clearAlerts();
        fadeOut(changePasswordForm, () => {
            fadeIn(welcomeMessage);
            fadeIn(buttonSection);
        });
    });
});
