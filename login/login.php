<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_GET['message']) && $_GET['message'] == 'logout') {
    echo '<script>alert("Anda sudah berhasil keluar")</script>';
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Prestasi.mu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../interface/cssLogin.css"> <!-- Link ke file CSS eksternal -->
</head>
<body>
    <div class="container">
        <div class="tabs">
            <div class="tab active" onclick="showTab('mahasiswa')">Mahasiswa</div>
            <div class="tab" onclick="showTab('admin')">Admin</div>
            <div class="tab" onclick="showTab('dosen')">Dosen</div>
        </div>
        <div class="forms">
            <!-- Form Login Mahasiswa -->
            <form id="mahasiswa" class="form-container active" action="process_login.php?role=mahasiswa" method="POST">
                <h2>Login Mahasiswa</h2>
                <input type="text" name="username" placeholder="nim" required />
                <input type="password" id="mahasiswa-password" name="password" placeholder="Password" required />
                <div class="show-password">
                    <input type="checkbox" id="mahasiswa-show-password" onclick="togglePasswordVisibility('mahasiswa-password', this)">
                    <label for="mahasiswa-show-password">Show Password</label>
                </div>
                <button type="submit">Login</button>
            </form>

            <!-- Form Login Admin -->
            <form id="admin" class="form-container" action="process_login.php?role=admin" method="POST">
                <h2>Login Admin</h2>
                <input type="text" name="username" placeholder="ID ADMIN" required />
                <input type="password" id="admin-password" name="password" placeholder="Password" required />
                <div class="show-password">
                    <input type="checkbox" id="admin-show-password" onclick="togglePasswordVisibility('admin-password', this)">
                    <label for="admin-show-password">Show Password</label>
                </div>
                <button type="submit">Login</button>
            </form>

            <!-- Form Login Dosen -->
            <form id="dosen" class="form-container" action="process_login.php?role=dosen" method="POST">
                <h2>Login Dosen</h2>
                <input type="text" name="username" placeholder="NIDN" required />
                <input type="password" id="dosen-password" name="password" placeholder="Password" required />
                <div class="show-password">
                    <input type="checkbox" id="dosen-show-password" onclick="togglePasswordVisibility('dosen-password', this)">
                    <label for="dosen-show-password">Show Password</label>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>

        <div class="login-link">
            <p><a href="../landing/landing.php">Kembali</a></p>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan form sesuai role yang dipilih
        function showTab(tabName) {
            const forms = document.querySelectorAll('.form-container');
            forms.forEach(form => {
                form.classList.remove('active');
            });

            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });

            document.getElementById(tabName).classList.add('active');
            const activeTab = Array.from(tabs).find(tab => tab.textContent.toLowerCase() === tabName.toLowerCase());
            activeTab.classList.add('active');
        }

        // Fungsi untuk toggle password visibility
        function togglePasswordVisibility(passwordId, checkbox) {
            const passwordField = document.getElementById(passwordId);
            passwordField.type = checkbox.checked ? 'text' : 'password';
        }
    </script>
    
</body>
</html>