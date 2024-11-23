<script>
        // Fungsi untuk membuka popup profil
        function toggleProfilePopup(event) {
            event.stopPropagation(); // Mencegah klik pada ikon menutup popup
            const popup = document.getElementById('profile-popup');
            const overlay = document.getElementById('overlay');
            popup.style.display = 'block';
            overlay.style.display = 'block';
        }

        // Fungsi untuk menutup popup profil
        function closeProfilePopup() {
            const popup = document.getElementById('profile-popup');
            const overlay = document.getElementById('overlay');
            popup.style.display = 'none';
            overlay.style.display = 'none';
        }

        // Fungsi untuk toggle notifikasi
        function toggleNotificationPopup(event) {
            event.stopPropagation(); // Mencegah klik pada ikon menutup popup
            const notificationPopup = document.getElementById('notification-popup');
            notificationPopup.style.display = notificationPopup.style.display === 'block' ? 'none' : 'block';
        }

        // Menutup popup saat klik di luar popup
        window.addEventListener('click', function(event) {
            const notificationPopup = document.getElementById('notification-popup');
            const profilePopup = document.getElementById('profile-popup');
            const overlay = document.getElementById('overlay');

            // Menutup popup notifikasi dan profil jika klik di luar mereka
            if (!notificationPopup.contains(event.target) && event.target !== document.querySelector('.notification-icon')) {
                notificationPopup.style.display = 'none';
            }

            if (!profilePopup.contains(event.target) && event.target !== document.querySelector('.profile-icon')) {
                profilePopup.style.display = 'none';
                overlay.style.display = 'none';
            }
        });
    </script>