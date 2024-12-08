<?php
// Sertakan file koneksi
include('../konekdatabase/connection.php');

// Menggunakan koneksi PDO
try {
    $pdo = connection();
    
    $sql = "SELECT p.id_akademik, p.nim, m.nama_lengkap, p.semester, p.ip
    FROM prestasi_akademik p 
    JOIN mahasiswa m ON p.nim = m.nim ORDER BY p.id_akademik DESC";
    $stmt = $pdo->prepare($sql); // Memasukkan query ke dalam PDO statement
    $stmt->execute(); // Menjalankan query
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengambil hasil dalam bentuk array
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Prestasi Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../interface/prestasi_akademik.css">
</head>
<body>

    <div class="container">
        <h1>Data Prestasi Akademik</h1>

        <!-- Tabel untuk menampilkan data -->
        <table>
            <thead>
                <tr>
                    <th>ID Akademik</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Semester</th>
                    <th>IP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['id_akademik'] . "</td>";
                        echo "<td>" . $row['nim'] . "</td>";
                        echo "<td>" . $row['nama_lengkap'] . "</td>";
                        echo "<td>" . $row['semester'] . "</td>";
                        echo "<td>" . $row['ip'] . "</td>";
                        echo "<td>
                                <form action='edit_akademik.php' method='get' style='display:inline-block;'>
                                    <input type='hidden' name='id_akademik' value='" . $row['id_akademik'] . "'>
                                    <button type='submit'><i class='fa fa-edit'></i> Edit</button>
                                </form>
                                <form action='hapus_akademik.php' method='get' style='display:inline-block;' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>
                                    <input type='hidden' name='id_akademik' value='" . $row['id_akademik'] . "'>
                                    <button type='submit' class='delete'><i class='fa fa-trash'></i> Hapus</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Container untuk tombol -->
        <div class="button-container">
            <form action="tambah_akademik.php" method="get">
                <button type="submit">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>Tambah Data
                </button>
            </form>

            <form action="dashboard_admin.php" method="get">
                <button type="submit">
                    <i class="fa fa-home" aria-hidden="true"></i>Kembali
                </button>
            </form>
        </div>
    </div>

</body>
</html>

<?php
// Menutup koneksi setelah selesai
// Tidak perlu menutup koneksi karena koneksi PDO tidak memerlukan penutupan eksplisit
?>
