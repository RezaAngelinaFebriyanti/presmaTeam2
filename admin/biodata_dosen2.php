<?php
// Sertakan file koneksi
include('../konekdatabase/connection.php');

// Menggunakan koneksi PDO
try {
    $pdo = connection();
    
    $sql = "SELECT d.nidn, d.nama, d.email, d.no_telp, d.jabatan, d.alamat, d.kota_kelahiran, d.tgl_lahir, d.agama
            FROM dosen d
            ORDER BY d.nidn ASC";
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
    <title>Data Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../interface/biodata_dosen2.css">
</head>
<body>

    <div class="container">
        <h1>Data Dosen</h1>

        <!-- Tabel untuk menampilkan data dosen -->
        <table>
            <thead>
                <tr>
                    <th>NIDN</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>Kota Kelahiran</th>
                    <th>Tanggal Lahir</th>
                    <th>Agama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['nidn'] . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['no_telp'] . "</td>";
                        echo "<td>" . $row['jabatan'] . "</td>";
                        echo "<td>" . $row['alamat'] . "</td>";
                        echo "<td>" . $row['kota_kelahiran'] . "</td>";

                        // Mengonversi tanggal lahir jika ada
                        $tgl_lahir = $row['tgl_lahir']; 
                        if ($tgl_lahir instanceof DateTime) {
                            $tgl_lahir = $tgl_lahir->format('d-m-Y'); 
                        } else {
                            $tgl_lahir = date('d-m-Y', strtotime($tgl_lahir));
                        }
                        echo "<td>" . $tgl_lahir . "</td>";
                        
                        echo "<td>" . $row['agama'] . "</td>";

                        // Tombol Aksi
                        echo "<td>
                                <!-- Tombol Edit -->
                                <form action='edit_dosen.php' method='get' style='display:inline-block;'>
                                    <input type='hidden' name='nidn' value='" . $row['nidn'] . "'>
                                    <button type='submit' class='btn btn-edit'>
                                        <i class='fa fa-edit'></i> Edit
                                    </button>
                                </form>
                                <!-- Tombol Hapus -->
                                <form action='hapus_dosen.php' method='get' style='display:inline-block;' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>
                                    <input type='hidden' name='nidn' value='" . $row['nidn'] . "'>
                                    <button type='submit' class='btn btn-delete'>
                                        <i class='fa fa-trash'></i> Hapus
                                    </button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Tidak ada data dosen</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tombol kembali ke halaman sebelumnya -->
        <div class="navbar">
            <a href="dashboard_admin.php">Kembali</a>
        </div>
    </div>

</body>
</html>

<?php
// Menutup koneksi setelah selesai
$pdo = null;
?>
