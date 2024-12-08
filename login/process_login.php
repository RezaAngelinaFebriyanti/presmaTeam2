<?php
// Mengimpor koneksi database dari connection.php
require_once '../konekdatabase/connection.php';

// Ambil parameter role dan data form
$role = $_GET['role'] ?? '';
$username = trim($_POST['username'] ?? '');  // Pangkas spasi pada username
$password = trim($_POST['password'] ?? '');  // Pangkas spasi pada password

// Validasi input
if (!$role || !$username || !$password) {
    die("Permintaan tidak valid.");
}

// Tentukan tabel dan kolom berdasarkan role
$table = '';
$column = '';
switch ($role) {
    case 'mahasiswa':
        $table = 'login_mahasiswa';
        $column = 'nim';  // Mahasiswa menggunakan kolom 'nim' untuk username
        break;
    case 'admin':
        $table = 'login_admin';
        $column = 'nip';  // Admin menggunakan kolom 'nip' untuk username
        break;
    case 'dosen':
        $table = 'login_dosen';
        $column = 'nidn'; // Dosen menggunakan kolom 'nidn' untuk username
        break;
    default:
        die("Role tidak valid.");
}

// Query cek login berdasarkan role dan username
$conn = connection();
$query = "SELECT * FROM $table WHERE $column = :username;";
$stmt = $conn->prepare($query);
$stmt->bindParam(":username", $username);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Debugging: Cek hasil query
if (!$result) {
    echo "Username salah";
    return;
}

foreach ($result as $res) {
    // Hilangkan spasi tambahan pada password dari database
    $dbPassword = trim($res["password"]);
    // Debugging: Periksa nilai yang digunakan untuk verifikasi
    var_dump($dbPassword);
    var_dump($password);
    // Jika password di-hash, gunakan password_verify. Jika tidak, gunakan perbandingan string.
    if ($dbPassword === $password || password_verify($password, $dbPassword)) {
        // Login sukses, redirect sesuai role
        switch ($role) {
            case 'mahasiswa':
                header("Location: dashboard/dashboardMahasiswa.php");
                exit();
            case 'admin':
                header("Location: dashboard/dashboardAdmin.php");
                exit();
            case 'dosen':
                header("Location: dashboard/dashboardDosen.php");
                exit();
            default:
                echo "Role tidak valid";
                return;
        }
    } else {
        echo "Password salah";
        return;
    }
}
?>