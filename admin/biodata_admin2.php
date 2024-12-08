<?php
// Mengimpor koneksi database dari connection.php
include('../konekdatabase/connection.php');

try {
    // Memanggil fungsi connection() untuk mendapatkan koneksi PDO
    $pdo = connection();

    // Query untuk mengambil semua biodata admin
    $sql = "SELECT * FROM admin";
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
    <title>Biodata Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../interface/biodata_admin2.css">
</head>
<body>
    <div class="container">
        <h1>Biodata Admin</h1>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["nip"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["no_telp"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["alamat"]) . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<form action='edit_admin.php' method='get'>";
                    echo "<input type='hidden' name='nip' value='" . htmlspecialchars($row['nip']) . "'>";
                    echo "<button type='submit' class='edit-button'><i class='fas fa-edit'></i> Edit</button>";
                    echo "</form>";
                    echo "<form action='hapus_admin.php' method='get' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>";
                    echo "<input type='hidden' name='nip' value='" . htmlspecialchars($row['nip']) . "'>";
                    echo "<button type='submit' class='delete-button'><i class='fas fa-trash'></i> Hapus</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="button-container">
            <a href="tambah_admin.php" class="btn btn-primary">
                <i class="fa fa-plus-circle"></i> Tambah Data
            </a>
            <a href="dashboard_admin.php" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</body>
</html>
