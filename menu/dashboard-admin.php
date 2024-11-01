<?php
session_start();
require '../controller/koneksi.php';

// Pastikan pengguna adalah admin
if ($_SESSION['role_user'] != 'Admin') {
    header("Location: login.php");
    exit();
}

// Ambil data pengguna
$query = "SELECT id_user, username, role_user FROM login_user";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $user['id_user']; ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['role_user']); ?></td>
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
