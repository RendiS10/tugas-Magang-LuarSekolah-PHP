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
    <link rel="stylesheet" href="../../css/sidebar.css">
</head>
<body>
    <!-- Include Sidebar -->
    <?php include ('../template/sidebar.php'); ?>

    <div class="main-content" style="margin-left: 250px; padding: 20px;">
        <h3 class="text-center mb-4">Dashboard Admin</h3>
        
        <!-- Pesan Selamat Datang -->
        <div class="alert alert-success">
            <h5>Halo Admin, <?php echo $result_admin->fetch_assoc()['nama_lengkap']; ?>!</h5>
        </div>
        
        <!-- Statistik Jumlah Peserta dan Guru -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-users"></i> Jumlah Peserta</h5>
                        <p class="card-text"><?php echo $total_peserta; ?> Peserta</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Jumlah Guru</h5>
                        <p class="card-text"><?php echo $total_guru; ?> Guru</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
