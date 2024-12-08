<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Prestasi Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../interface/tambah_akademik.css">
</head>
<body>
    <div class="container">
        <h1>Form Unggah Prestasi Akademik</h1>

        <!-- Pesan Peringatan jika data belum lengkap -->
        <form id="academicForm">
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" id="nim" name="nim" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" readonly>
            </div>

            <div class="form-group">
                <label for="semester">Semester:</label>
                <select id="semester" name="semester" required>
                    <option value="">Pilih Semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ip">IP:</label>
                <input type="number" id="ip" name="ip" step="0.01" min="0" max="4" required>
            </div>

            <button type="submit">Simpan Data</button>
        </form>

        <!-- Link Kembali ke Dashboard -->
        <a href="../dashboard/dashboardAdmin.php" class="back-link">Kembali</a>
    </div>

    <script>
        // Fungsi untuk mengambil nama mahasiswa berdasarkan NIM
        document.getElementById('nim').addEventListener('input', function() {
            var nim = this.value;

            // Cek apakah NIM sudah ada, jika ada, ambil nama mahasiswa
            if (nim.length === 10) { // Asumsi panjang NIM adalah 10 karakter
                fetch('get_nama_mahasiswa.php?nim=' + nim)
                    .then(response => response.json())
                    .then(data => {
                        if (data.nama) {
                            document.getElementById('nama').value = data.nama;
                        } else {
                            alert('Nama mahasiswa tidak ditemukan!');
                            document.getElementById('nama').value = '';
                        }
                    })
                    .catch(error => {
                        alert('Terjadi kesalahan: ' + error);
                    });
            } else {
                document.getElementById('nama').value = '';
            }
        });

        // Fungsi untuk menangani form submit
        document.getElementById('academicForm').onsubmit = function(e) {
            e.preventDefault();

            // Ambil data form
            var nim = document.getElementById('nim').value;
            var nama = document.getElementById('nama').value;
            var semester = document.getElementById('semester').value;
            var ip = document.getElementById('ip').value;

            if (nim && nama && semester && ip) {
                // Kirim data ke server atau simpan dalam database
                alert('Data berhasil disimpan!');
                window.location.href = 'dashboard_mahasiswa.php'; // Kembali ke dashboard
            } else {
                alert('Mohon lengkapi semua data!');
            }
        };
    </script>
</body>
</html>