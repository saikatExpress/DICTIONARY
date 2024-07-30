
    <footer class="footer">
        <ul class="footer-links">
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Support</a></li>
        </ul>
        <p>&copy; 2024 BnDictionary. All rights reserved.</p>
        <p>Developed by <a href="https://www.github.com/saikatExpress" style="color: #fff;">Saikat Talukder</a></p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#serachitem').on('input', function(){
                alert($(this).val());
            });
        });
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.style.display = (dropdownMenu.style.display === 'block' || dropdownMenu.style.display === '') ? 'none' : 'block';
        }

        function toggleSidebar() {
            const sidebarMenu = document.getElementById('sidebarMenu');
            sidebarMenu.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const dropdownMenu = document.getElementById('dropdownMenu');
            if (!event.target.closest('.profile') && !event.target.closest('.hamburger')) {
                dropdownMenu.style.display = 'none';
            }
        });
    </script>
</body>
</html>