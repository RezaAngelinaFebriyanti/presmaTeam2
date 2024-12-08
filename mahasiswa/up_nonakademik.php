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
        <form action="#">
            <label for="nama-kompetisi">Nama Kompetisi</label>
            <input type="text" placeholder="Nama Kompetisi" required />
            <label for="ID Dosen Pembimbing">ID Dosen Pembimbing</label>
            <input type="text" placeholder="ID Dosen Pembimbing" required />
            <label for="nim-mahasiswa">NIM Mahasiswa</label>
            <input type="text" placeholder="NIM Mahasiswa" required />
            <label for="peran">Peran dalam Kompetisi:</label>
            <select id="peran" name="peran" required>
                <option value="" disabled selected>Pilih Peran</option>
                <option value="ketua">Ketua</option>
                <option value="Anggota">Anggota</option>
                <option value="Personal">Personal</option>
            </select>
            <label for="jenis-kompetisi">Jenis Kompetisi:</label>
            <select id="jenis-kompetisi" name="jenis-kompetisi" required>
                <option value="" disabled selected>Pilih Jenis Kompetisi</option>
                <option value="">Kepenulisan</option>
                <option value="">Seni</option>
                <option value="">Olahraga</option>
                <option value="">Kewirausahaan</option>
                <option value="">Ilmiah</option>
                <option value="">Kreativitas</option>
                <option value="">Teknologi</option>
                <option value="">Lainnya</option>
            </select>

            <!-- Tingkat Kompetisi: Dropdown dengan placeholder -->
            <label for="tingkat-kompetisi">Tingkat Kompetisi:</label>
            <select id="tingkat-kompetisi" name="tingkat-kompetisi" required>
                <option value="" disabled selected>Pilih Tingkat Kompetisi</option>
                <option value="">Internal</option>
                <option value="">Kabupaten/Kota</option>
                <option value="">Provinsi</option>
                <option value="">Nasional</option>
                <option value="">Internasional</option>
                <option value="">Lainnya</option>
            </select>
            <label for="Tanggal-Penyelenggaraan">Tanggal Penyelenggaraan</label>
            <input type="date" placeholder="Tanggal Penyelenggaraan" required />
            <label for="upload-dokumentasi">Upload Dokumentasi</label>
            <input type="file" id="upload-dokumentasi" required />
            <label for="upload-sertifikat">Upload Sertifikat</label>
            <input type="file" id="upload-sertifikat" required />
            <label for="upload-karya">Upload Karya</label>
            <input type="file" id="upload-karya" required />
            <label for="upload-surat-tugas">Upload Surat Tugas</label>
            <input type="file" id="upload-surat-tugas" required />
            <label for="penyelenggara">Penyelenggara</label>
            <input type="text" placeholder="Penyelenggara" required />
            <label for="peringkat">Peringkat:</label>
            <select id="peringkat" name="Peringkat" required>
                <option value="" disabled selected>Pilih Peringkat</option>
                <option value="juara1">Juara 1</option>
                <option value="juara2">Juara 2</option>
                <option value="juara3">Juara 3</option>
                <option value="harapan1">Harapan 1</option>
                <option value="harapan2">Harapan 2</option>
                <option value="harapan3">Harapan 3</option>
                <option value="lainnya">Lainnya</option>
            </select>

            <button type="submit">Simpan</button>
        </form>
        <div class="login-link">
            <p><a href="../dashboard/dashboardMahasiswa.php">Kembali</a></p>
        </div>
    </div>
</body>
</html>