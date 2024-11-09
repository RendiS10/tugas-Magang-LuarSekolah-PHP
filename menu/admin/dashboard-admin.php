<?php
session_start();
require '../../controller/koneksi.php';

// Pastikan pengguna adalah admin
if ($_SESSION['role_user'] != 'Admin') {
    header("Location: login.php");
    exit();
}

// Ambil data admin
$query_admin = "SELECT nama_lengkap FROM admin";
$result_admin = $koneksi->query($query_admin);

// Hitung jumlah peserta
$query_peserta_count = "SELECT COUNT(*) as total_peserta FROM peserta";
$result_peserta_count = $koneksi->query($query_peserta_count);
$total_peserta = $result_peserta_count->fetch_assoc()['total_peserta'];

// Hitung jumlah guru
$query_guru_count = "SELECT COUNT(*) as total_guru FROM guru_ngaji";
$result_guru_count = $koneksi->query($query_guru_count);
$total_guru = $result_guru_count->fetch_assoc()['total_guru'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
</head>
<body>
    <!-- Include Sidebar -->
    <?php include ('../template/sidebar.php'); ?>

    <div class="main-content" style="margin-left: 250px; padding: 20px;">
        <h3 align="center">Dashboard Admin</h3>
        <br>
        
        <!-- Tambahkan pesan selamat datang -->
        <h5>Halo Admin, <?php echo $result_admin->fetch_assoc()['nama_lengkap']; ?>!</h5>
        
        <!-- Tampilkan jumlah peserta dan guru -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Peserta</h5>
                        <p class="card-text"><?php echo $total_peserta; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Guru</h5>
                        <p class="card-text"><?php echo $total_guru; ?></p>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
