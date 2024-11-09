<?php include("../template/sidebar.php") ?>
<?php
session_start();
require '../../controller/koneksi.php';

// Pastikan pengguna adalah admin
if ($_SESSION['role_user'] != 'Admin') {
    header("Location: login.php");
    exit();
}

// Query untuk mendapatkan data peserta dan program yang dipilih
$query = "
    SELECT p.id_peserta, p.nama_lengkap, p.gender, p.tempat_kota_lahir, p.tanggal_lahir, p.alamat, p.no_hp, GROUP_CONCAT(pp.nama_program SEPARATOR ', ') AS program_dipilih
    FROM peserta p
    LEFT JOIN peserta_program_pelatihan ppp ON p.id_peserta = ppp.id_peserta
    LEFT JOIN program_pelatihan pp ON ppp.id_program = pp.id_program
    GROUP BY p.id_peserta
";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Peserta</title>
    <link rel="stylesheet" href="../../css/keloladata.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Menyertakan sidebar -->
    <?php include('../template/sidebar.php'); ?>

    <div class="main-content">
        <h2>Kelola Data Peserta</h2>
        
        <!-- Tombol untuk menambah data peserta -->
        <a href="tambahdata.php" class="btn-add">Tambah Data Peserta</a>
        
        <!-- Tabel untuk menampilkan data peserta -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Peserta</th>
                    <th>Nama Lengkap</th>
                    <th>Gender</th>
                    <th>Tempat, Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Program Dipilih</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php while ($peserta = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $peserta['id_peserta']; ?></td>
                        <td><?php echo htmlspecialchars($peserta['nama_lengkap']); ?></td>
                        <td><?php echo htmlspecialchars($peserta['gender']); ?></td>
                        <td><?php echo htmlspecialchars($peserta['tempat_kota_lahir']) . ', ' . $peserta['tanggal_lahir']; ?></td>
                        <td><?php echo htmlspecialchars($peserta['alamat']); ?></td>
                        <td><?php echo htmlspecialchars($peserta['program_dipilih']); ?></td>
                        <td>
                            <a href="editdatapeserta.php?id=<?php echo $peserta['id_peserta']; ?>" class="btn-edit">Edit</a>
                            <button class="btn-delete" onclick="deletePeserta(<?php echo $peserta['id_peserta']; ?>)">Hapus</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
    // Fungsi untuk menghapus peserta
    function deletePeserta(idPeserta) {
        if (confirm("Apakah Anda yakin ingin menghapus peserta ini?")) {
            window.location.href = 'deletepeserta.php?id=' + idPeserta;
        }
    }
    </script>
</body>
</html>
