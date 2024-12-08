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
<html lang="en">
<!-- NYOBAK REKK -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../interface/biodata_admin.css">
</head>
<body>
    <div class="container">
        <h2>Biodata Admin</h2>
        <form action="#">
            <input type="text" placeholder="NIP" required />
            <input type="text" placeholder="Nama Lengkap" required />
            <input type="email" placeholder="Email" required />
            <input type="tel" placeholder="Nomor Telepon" required />
            <input type="text" placeholder="Alamat" required />
            <button type="submit">Simpan</button>
        </form>
        <div class="login-link">
            <p><a href="../dashboard/dashboardAdmin.php">Kembali</a></p>
        </div>
    </div>
</body>
</html>