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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="biodata_dosen.css">
</head>
<body>
    <div class="container">
        <h2>Biodata Dosen</h2>
        <form action="#">
            <input type="text" placeholder="NIDN" required />
            <input type="text" placeholder="Nama Lengkap" required />
            <input type="email" placeholder="Email" required />
            <input type="tel" placeholder="No. Telp" required />
            <input type="text" placeholder="Jabatan" required />
            <input type="text" placeholder="Alamat" required />
            
            <label for="tglLahir">Tgl Lahir</label>
            <input type="date" id="tglLahir" required />
            
            <input type="text" placeholder="Kota Kelahiran" required />
            <select required>
                <option value="" disabled selected hidden>Agama</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
            <button type="submit">Simpan</button>
        </form>

        <div class="login-link">
            <p><a href="#">Kembali</a></p>
        </div>
    </div>
</body>
</html>