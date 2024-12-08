<?php
// Sertakan file koneksi
include('../konekdatabase/connection.php');

try {
    // Menggunakan PDO untuk menyiapkan dan mengeksekusi query
    $pdo = connection();

    // Query untuk mengambil data mahasiswa
    $sql = "SELECT m.nim, m.nama_lengkap, m.email, m.no_telp, m.agama, m.nama_ortu, m.jenis_kelamin, m.kota_kelahiran, m.tgl_lahir, m.tahun_masuk, p.nama_prodi, m.no_telp_ortu, m.no_telp_wali
    FROM mahasiswa m
    JOIN prodi p ON m.id_prodi = p.id_prodi
    ORDER BY m.nim ASC";
    
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
    <title>Data Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../interface/biodata_mahasiswa2.css">
</head>
<body>

    <div class="container">
        <h1>Data Mahasiswa</h1>

        <!-- Tabel untuk menampilkan data mahasiswa -->
        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Agama</th>
                    <th>Nama Orang Tua</th>
                    <th>Jenis Kelamin</th>
                    <th>Kota Kelahiran</th>
                    <th>Tanggal Lahir</th>
                    <th>Tahun Masuk</th>
                    <th>Program Studi</th>
                    <th>No. Telepon Orang Tua</th>
                    <th>No. Telepon Wali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['nim'] . "</td>";
                        echo "<td>" . $row['nama_lengkap'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['no_telp'] . "</td>";
                        echo "<td>" . $row['agama'] . "</td>";
                        echo "<td>" . $row['nama_ortu'] . "</td>";
                        echo "<td>" . $row['jenis_kelamin'] . "</td>";
                        echo "<td>" . $row['kota_kelahiran'] . "</td>";

                        // Mengonversi tanggal lahir jika ada
                        $tgl_lahir = $row['tgl_lahir']; 
                        if ($tgl_lahir instanceof DateTime) {
                            $tgl_lahir = $tgl_lahir->format('d-m-Y'); 
                        } else {
                            $tgl_lahir = date('d-m-Y', strtotime($tgl_lahir));
                        }
                        echo "<td>" . $tgl_lahir . "</td>";

                        echo "<td>" . $row['tahun_masuk'] . "</td>";
                        echo "<td>" . $row['nama_prodi'] . "</td>";
                        echo "<td>" . $row['no_telp_ortu'] . "</td>";
                        echo "<td>" . $row['no_telp_wali'] . "</td>";

                        // Tombol Aksi
                        echo "<td>
                                <!-- Tombol Edit -->
                                <form action='edit_mahasiswa.php' method='get' style='display:inline-block;'>
                                    <input type='hidden' name='nim' value='" . $row['nim'] . "'>
                                    <button type='submit' class='btn btn-edit'>
                                        <i class='fa fa-edit'></i> Edit
                                    </button>
                                </form>
                                <!-- Tombol Hapus -->
                                <form action='hapus_mahasiswa.php' method='get' style='display:inline-block;' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>
                                    <input type='hidden' name='nim' value='" . $row['nim'] . "'>
                                    <button type='submit' class='btn btn-delete'><i class='fa fa-trash'></i> Hapus
                                    </button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='14'>Tidak ada data mahasiswa</td></tr>";
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
// Menutup koneksi setelah
