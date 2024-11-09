<?php
session_start();
require '../../controller/koneksi.php';

// Pastikan pengguna adalah admin
if ($_SESSION['role_user'] != 'Admin') {
    header("Location: login.php");
    exit();
}

// Cek apakah id program ada
if (isset($_GET['id'])) {
    $idProgram = $_GET['id'];

    // Hapus program pelatihan dari tabel program_pelatihan
    $query = "DELETE FROM program_pelatihan WHERE id_program = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $idProgram);

    if ($stmt->execute()) {
        // Jika berhasil dihapus, tampilkan pesan konfirmasi
        echo "<script>
                alert('Program berhasil dihapus!');
                window.location.href = 'kelolaprogram.php'; // Redirect ke halaman kelolaprogram.php
              </script>";
    } else {
        // Jika gagal menghapus, tampilkan pesan error
        echo "<script>
                alert('Gagal menghapus program!');
                window.location.href = 'kelolaprogram.php'; // Redirect ke halaman kelolaprogram.php
              </script>";
    }
}
?>
