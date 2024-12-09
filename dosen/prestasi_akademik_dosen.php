<?php
        // Mengimpor koneksi database dari connection.php
        include('../konekdatabase/connection.php');

        try {
            // Memanggil fungsi connection() untuk mendapatkan koneksi PDO
            $pdo = connection();

            // Query untuk mengambil semua biodata admin
            $sql = "SELECT pn.nim, m.nama_lengkap, pn.semester, pn.ip FROM prestasi_akademik pn INNER JOIN mahasiswa m ON pn.nim = m.nim";
            $query = $pdo->prepare($sql);  // Menggunakan objek PDO dari connection.php
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query gagal: " . $e->getMessage());
        }
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validasi Prestasi Akademik</title>
  <link rel="stylesheet" href="../interface/prestasi_akademik_dosen.css">
</head>
<body>
  <div class="container">
    <h2>Prestasi Akademik Mahasiswa</h2>
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
          <?php for ($i = 1; $i <= 8; $i++): ?>
            <th>Smt <?= $i ?></th>
          <?php endfor; ?>
        </tr>
      </thead>
      <tbody>
    <?php
    if (!empty($results)) {
        // Membuat array untuk menyimpan data per semester
        $semester_data = [];
        foreach ($results as $row) {
            // Kelompokkan data berdasarkan nim dan nama
            $nim = $row['nim'];
            $nama_lengkap = $row['nama_lengkap'];
            
            // Pastikan ada entri untuk nim jika belum ada
            if (!isset($semester_data[$nim])) {
                $semester_data[$nim] = [
                    'nama_lengkap' => $nama_lengkap,
                    'semesters' => array_fill(1, 8, '-') // Inisialisasi semester 1-8 dengan '-'
                ];
            }
            
            // Isi data untuk semester terkait
            $semester_data[$nim]['semesters'][$row['semester']] = $row['ip'];
        }

        // Tampilkan data ke tabel
        foreach ($semester_data as $nim => $data) {
            echo "<tr>";
            echo "<td>" . $nim . "</td>";
            echo "<td>" . $data['nama_lengkap'] . "</td>";

            // Tampilkan kolom semester 1 hingga 8
            foreach ($data['semesters'] as $ip) {
                echo "<td>" . $ip . "</td>";
            }

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10'>Tidak ada data</td></tr>"; // colspan disesuaikan dengan jumlah kolom
    }
    ?>
</tbody>
    </table>
  </div>
</body>
</html>
