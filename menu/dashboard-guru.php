<?php
session_start();
require '../controller/koneksi.php';

// Pastikan pengguna adalah guru
if ($_SESSION['role_user'] != 'Guru Ngaji') {
    header("Location: login.php");
    exit();
}

// Ambil data peserta yang diajar
$query = "SELECT p.id_user, p.nama_lengkap, p.gender FROM peserta p JOIN login_user l ON p.id_user = l.id_user WHERE l.role_user = 'Peserta'";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Dashboard Guru</h1>
    <table>
        <thead>
            <tr>
                <th>ID User</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($peserta = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($peserta['id_user']); ?></td>
                    <td><?php echo htmlspecialchars($peserta['nama_lengkap']); ?></td>
                    <td><?php echo htmlspecialchars($peserta['gender']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
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
