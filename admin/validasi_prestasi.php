<?php
        // Mengimpor koneksi database dari connection.php
        include('../konekdatabase/connection.php');

        try {
            // Memanggil fungsi connection() untuk mendapatkan koneksi PDO
            $pdo = connection();

            // Query untuk mengambil semua biodata admin
            $sql = "SELECT pn.nim, m.nama_lengkap FROM prestasi_nonakademik pn INNER JOIN mahasiswa m ON pn.nim = m.nim";
            $query = $pdo->prepare($sql);  // Menggunakan objek PDO dari connection.php
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query gagal: " . $e->getMessage());
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validasi Prestasi Non Akademik</title>
  <link rel="stylesheet" href="../interface/validasi_prestasi.css">
</head>
<body>
  <div class="container">
    <h2>Validasi Prestasi Non Akademik</h2>
    <div class="search-container">
      <form method="GET" action="">
        <input type="text" name="nim" placeholder="Cari berdasarkan NIM" value="<?= isset($_GET['nim']) ? htmlspecialchars($_GET['nim']) : '' ?>">
        <button type="submit" class="button">Cari</button>
      </form>
    </div>
    <table>
      <thead>
        <tr>
          <th>NIM</th>
          <th>Nama</th>
          <th>Data</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
    <?php if (!empty($results)): ?>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['nim']) ?></td>
                <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                <td>
                    <a href="up_nonakademik.php?nim=<?= urlencode($row['nim']) ?>" class="button">Detail</a>
                </td>
                <td>
                    <div class="status-buttons">
                        <button class="status-button" onclick="handleStatus(this, 'ya', '<?= htmlspecialchars($row['nim']) ?>')">Ya</button>
                        <button class="status-button" onclick="handleStatus(this, 'tidak', '<?= htmlspecialchars($row['nim']) ?>')">Tidak</button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4" style="text-align: center;">Data tidak ditemukan.</td>
        </tr>
    <?php endif; ?>
</tbody>

    </table>
    <div class="login-link">
        <p><a href="../dashboard/dashboardAdmin.php">Kembali</a></p>
    </div>
  </div>
  <script>
    function handleStatus(button, status, nim) {
    console.log(`Status untuk NIM ${nim} diubah menjadi: ${status}`);

    // Hapus kelas 'clicked' dari tombol lain dalam grup
    const buttons = button.parentElement.querySelectorAll('.status-button');
    buttons.forEach(btn => btn.classList.remove('clicked'));

    // Tambahkan kelas 'clicked' ke tombol yang dipilih
    button.classList.add('clicked');
    }
  </script>
</body>
</html>