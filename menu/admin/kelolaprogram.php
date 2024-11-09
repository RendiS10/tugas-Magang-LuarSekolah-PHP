<?php
session_start();
require '../../controller/koneksi.php';

// Pastikan pengguna adalah admin
if ($_SESSION['role_user'] != 'Admin') {
    header("Location: login.php");
    exit();
}

// Query untuk mendapatkan data program pelatihan
$query = "SELECT * FROM program_pelatihan";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Program Pelatihan</title>
    <link rel="stylesheet" href="../../css/keloladata.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Menyertakan sidebar -->
    <?php include('../template/sidebar.php'); ?>

    <div class="container" style="margin-left: 270px; padding-top: 20px;">
        <h2>Kelola Program Pelatihan</h2>
        
        <!-- Tombol untuk menambah program pelatihan -->
        <a href="tambahprogram.php" class="btn btn-primary mb-3">Tambah Program Pelatihan</a>
        
        <!-- Tabel untuk menampilkan data program pelatihan -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Program</th>
                    <th>Nama Program</th>
                    <th>Deskripsi</th>
                    <th>Durasi</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($program = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $program['id_program']; ?></td>
                        <td><?php echo htmlspecialchars($program['nama_program']); ?></td>
                        <td><?php echo htmlspecialchars($program['deskripsi']); ?></td>
                        <td><?php echo htmlspecialchars($program['durasi']); ?></td>
                        <td><?php echo htmlspecialchars($program['level']); ?></td>
                        <td>
                            <a href="editprogram.php?id=<?php echo $program['id_program']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="deleteProgram(<?php echo $program['id_program']; ?>)">Hapus</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
    // Fungsi untuk menghapus program pelatihan
    function deleteProgram(idProgram) {
        if (confirm("Apakah Anda yakin ingin menghapus program ini?")) {
            window.location.href = 'deleteprogram.php?id=' + idProgram;
        }
    }
    </script>
</body>
</html>
