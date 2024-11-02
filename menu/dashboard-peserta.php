<?php
session_start();
require '../controller/koneksi.php';

// Pastikan pengguna adalah peserta
if ($_SESSION['role_user'] != 'Peserta') {
    header("Location: login.php");
    exit();
}

// Ambil data peserta
$query = "SELECT id_user, nama_lengkap, gender FROM peserta WHERE id_user = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $_SESSION['id_user']);
$stmt->execute();
$result = $stmt->get_result();
$peserta = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peserta Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Selamat datang di Dashboard Peserta</h1>
    <h2>Informasi Anda</h2>
    <p>ID User: <?php echo htmlspecialchars($peserta['id_user']); ?></p>
    <p>Nama Lengkap: <?php echo htmlspecialchars($peserta['nama_lengkap']); ?></p>
    <p>Jenis Kelamin: <?php echo htmlspecialchars($peserta['gender']); ?></p>
    
    <button id="logoutButton">Logout</button>

    <script>
        document.getElementById('logoutButton').addEventListener('click', function() {
            Swal.fire({
                title: 'Anda yakin ingin logout?',
                text: "Anda akan diarahkan kembali ke halaman login.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php';
                }
            });
        });
    </script>
</body>
</html>
