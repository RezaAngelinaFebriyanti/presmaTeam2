<?php
include('../konekdatabase/connection.php');

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    try {
        // Membuka koneksi ke database
        $pdo = connection();

        // Query untuk mengambil data berdasarkan NIM
        $sql = "SELECT * FROM prestasi_nonakademik WHERE nim = :nim";
        $query = $pdo->prepare($sql);
        $query->execute(['nim' => $nim]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            die("Data tidak ditemukan untuk NIM $nim");
        }
    } catch (PDOException $e) {
        die("Query gagal: " . $e->getMessage());
    }
} else {
    die("Parameter NIM tidak tersedia.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Prestasi Non-Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../interface/up_nonakademik.css">
</head>
<body>
    <div class="container">
        <h2>Data Prestasi Non-Akademik</h2>
        <form action="#" method="POST">
            <label for="nama-kompetisi">Nama Kompetisi</label>
            <input type="text" name="nama_kompetisi" placeholder="Nama Kompetisi" value="<?= htmlspecialchars($data['nama_kompetisi'] ?? '') ?>" required />

            <label for="ID Dosen Pembimbing">ID Dosen Pembimbing</label>
            <input type="text" name="id_dosen_pembimbing" placeholder="ID Dosen Pembimbing" value="<?= htmlspecialchars($data['id_dosen_pembimbing'] ?? '') ?>" required />

            <label for="nim-mahasiswa">NIM Mahasiswa</label>
            <input type="text" name="nim_mahasiswa" placeholder="NIM Mahasiswa" value="<?= htmlspecialchars($data['nim'] ?? '') ?>" readonly />

            <label for="peran">Peran dalam Kompetisi:</label>
            <select id="peran" name="peran" required>
                <option value="" disabled>Pilih Peran</option>
                <option value="ketua" <?= isset($data['peran']) && $data['peran'] === 'ketua' ? 'selected' : '' ?>>Ketua</option>
                <option value="anggota" <?= isset($data['peran']) && $data['peran'] === 'anggota' ? 'selected' : '' ?>>Anggota</option>
                <option value="personal" <?= isset($data['peran']) && $data['peran'] === 'personal' ? 'selected' : '' ?>>Personal</option>
            </select>

            <label for="jenis-kompetisi">Jenis Kompetisi:</label>
            <select id="jenis-kompetisi" name="jenis-kompetisi" required>
                <option value="" disabled selected>Pilih Jenis Kompetisi</option>
                <option value="kepenulisan" <?= isset($data['jenis_kompetisi']) && $data['jenis_kompetisi'] === 'kepenulisan' ? 'selected' : '' ?>>Kepenulisan</option>
                <option value="seni" <?= isset($data['jenis_kompetisi']) && $data['jenis_kompetisi'] === 'seni' ? 'selected' : '' ?>>Seni</option>
                <option value="olahraga" <?= isset($data['jenis_kompetisi']) && $data['jenis_kompetisi'] === 'olahraga' ? 'selected' : '' ?>>Olahraga</option>
                <option value="kewirausahaan" <?= isset($data['jenis_kompetisi']) && $data['jenis_kompetisi'] === 'kewirausahaan' ? 'selected' : '' ?>>Kewirausahaan</option>
                <option value="ilmiah" <?= isset($data['jenis_kompetisi']) && $data['jenis_kompetisi'] === 'ilmiah' ? 'selected' : '' ?>>Ilmiah</option>
                <option value="kreativitas" <?= isset($data['jenis_kompetisi']) && $data['jenis_kompetisi'] === 'kreativitas' ? 'selected' : '' ?>>Kreativitas</option>
                <option value="teknologi" <?= isset($data['jenis_kompetisi']) && $data['jenis_kompetisi'] === 'teknologi' ? 'selected' : '' ?>>Teknologi</option>
                <option value="lainnya" <?= isset($data['jenis_kompetisi']) && $data['jenis_kompetisi'] === 'lainnya' ? 'selected' : '' ?>>Lainnya</option>
            </select>


            <label for="tingkat-kompetisi">Tingkat Kompetisi:</label>
            <select id="tingkat-kompetisi" name="tingkat-kompetisi" required>
                <option value="" disabled selected>Pilih Tingkat Kompetisi</option>
                <option value="internal" <?= isset($data['tingkat_kompetisi']) && $data['tingkat_kompetisi'] === 'internal' ? 'selected' : '' ?>>Internal</option>
                <option value="kabupaten_kota" <?= isset($data['tingkat_kompetisi']) && $data['tingkat_kompetisi'] === 'kabupaten_kota' ? 'selected' : '' ?>>Kabupaten/Kota</option>
                <option value="provinsi" <?= isset($data['tingkat_kompetisi']) && $data['tingkat_kompetisi'] === 'provinsi' ? 'selected' : '' ?>>Provinsi</option>
                <option value="nasional" <?= isset($data['tingkat_kompetisi']) && $data['tingkat_kompetisi'] === 'nasional' ? 'selected' : '' ?>>Nasional</option>
                <option value="internasional" <?= isset($data['tingkat_kompetisi']) && $data['tingkat_kompetisi'] === 'internasional' ? 'selected' : '' ?>>Internasional</option>
                <option value="lainnya" <?= isset($data['tingkat_kompetisi']) && $data['tingkat_kompetisi'] === 'lainnya' ? 'selected' : '' ?>>Lainnya</option>
            </select>

            <label for="Tanggal-Penyelenggaraan">Tanggal Penyelenggaraan</label>
            <input type="date" name="tanggal_penyelenggaraan" id="Tanggal-Penyelenggaraan" value="<?= isset($data['tanggal_penyelenggaraan']) ? $data['tanggal_penyelenggaraan'] : '' ?>" required />

            <label for="upload-dokumentasi">Upload Dokumentasi</label>
            <input type="file" id="upload-dokumentasi" name="upload_dokumentasi" <?= empty($data['dokumentasi']) ? '' : 'data-file="'.$data['dokumentasi'].'"' ?> />

            <?php if (!empty($data['dokumentasi'])): ?>
                <p>Dokumentasi yang sudah diupload: <?= htmlspecialchars($data['dokumentasi']) ?></p>
            <?php endif; ?>

            <label for="upload-sertifikat">Upload Sertifikat</label>
            <input type="file" id="upload-sertifikat" name="upload_sertifikat" <?= empty($data['sertifikat']) ? '' : 'data-file="'.$data['sertifikat'].'"' ?> />

            <?php if (!empty($data['sertifikat'])): ?>
                <p>Sertifikat yang sudah diupload: <?= htmlspecialchars($data['sertifikat']) ?></p>
            <?php endif; ?>

            <label for="upload-karya">Upload Karya</label>
            <input type="file" id="upload-karya" name="upload_karya" <?= empty($data['karya']) ? '' : 'data-file="'.$data['karya'].'"' ?> />

            <?php if (!empty($data['karya'])): ?>
                <p>Karya yang sudah diupload: <?= htmlspecialchars($data['karya']) ?></p>
            <?php endif; ?>

            <label for="upload-surat-tugas">Upload Surat Tugas</label>
            <input type="file" id="upload-surat-tugas" name="upload_surat_tugas" <?= empty($data['surat_tugas']) ? '' : 'data-file="'.$data['surat_tugas'].'"' ?> />

            <?php if (!empty($data['surat_tugas'])): ?>
                <p>Surat Tugas yang sudah diupload: <?= htmlspecialchars($data['surat_tugas']) ?></p>
            <?php endif; ?>

            <label for="penyelenggara">Penyelenggara</label>
    <input type="text" name="penyelenggara" placeholder="Penyelenggara" value="<?= htmlspecialchars($data['penyelenggara'] ?? '') ?>" required />

    <label for="peringkat">Peringkat:</label>
        <select id="peringkat" name="peringkat" required>
            <option value="" disabled selected>Pilih Peringkat</option>
            <option value="juara 1" <?= $data['peringkat'] === 'juara 1' ? 'selected' : '' ?>>Juara 1</option>
            <option value="juara 2" <?= $data['peringkat'] === 'juara 2' ? 'selected' : '' ?>>Juara 2</option>
            <option value="juara 3" <?= $data['peringkat'] === 'juara 3' ? 'selected' : '' ?>>Juara 3</option>
            <option value="harapan 1" <?= $data['peringkat'] === 'harapan 1' ? 'selected' : '' ?>>Harapan 1</option>
            <option value="harapan 2" <?= $data['peringkat'] === 'harapan 2' ? 'selected' : '' ?>>Harapan 2</option>
            <option value="harapan 3" <?= $data['peringkat'] === 'harapan 3' ? 'selected' : '' ?>>Harapan 3</option>
            <option value="lainnya" <?= $data['peringkat'] === 'lainnya' ? 'selected' : '' ?>>Lainnya</option>
        </select>
        </form>


        <div class="login-link">
            <p><a href="validasi_prestasi.php">Kembali</a></p>
        </div>
    </div>
</body>
</html>