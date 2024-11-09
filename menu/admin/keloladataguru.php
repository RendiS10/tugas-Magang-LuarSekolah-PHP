<?php include("../template/sidebar.php") ?>
<?php
session_start();
require '../../controller/koneksi.php';

// Pastikan pengguna adalah admin
if ($_SESSION['role_user'] != 'Admin') {
    header("Location: login.php");
    exit();
}

// Query untuk mendapatkan data guru ngaji
$query = "SELECT * FROM guru_ngaji";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Guru Ngaji</title>
    <link rel="stylesheet" href="../../css/keloladata.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Menyertakan sidebar -->
    <?php include('../template/sidebar.php'); ?>

    <div class="main-content">
        <h2>Kelola Data Guru Ngaji</h2>
        
        <!-- Tombol untuk menambah data guru ngaji -->
        <a href="tambahdata.php" class="btn-add">Tambah Data Guru Ngaji</a>
        
        <!-- Tabel untuk menampilkan data guru ngaji -->
        <table>
            <thead>
                <tr>
                    <th>ID Guru</th>
                    <th>Nama Lengkap</th>
                    <th>Gender</th>
                    <th>Tempat, Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($guru = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $guru['id_guru']; ?></td>
                        <td><?php echo htmlspecialchars($guru['nama_lengkap']); ?></td>
                        <td><?php echo htmlspecialchars($guru['gender']); ?></td>
                        <td><?php echo htmlspecialchars($guru['tempat_kota_lahir']) . ', ' . $guru['tanggal_lahir']; ?></td>
                        <td><?php echo htmlspecialchars($guru['alamat']); ?></td>
                        <td><?php echo htmlspecialchars($guru['no_hp']); ?></td>
                        <td>
                            <a href="editdataguru.php?id=<?php echo $guru['id_guru']; ?>" class="btn-edit">Edit</a>
                            <button class="btn-delete" onclick="deleteGuru(<?php echo $guru['id_guru']; ?>)">Hapus</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
    // Fungsi untuk menghapus guru ngaji
    function deleteGuru(idGuru) {
        if (confirm("Apakah Anda yakin ingin menghapus guru ngaji ini?")) {
            window.location.href = 'deleteguru.php?id=' + idGuru;
        }
    }
    </script>
</body>
</html>
