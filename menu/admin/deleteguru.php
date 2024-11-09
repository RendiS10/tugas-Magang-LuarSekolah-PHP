<?php
session_start();
require '../../controller/koneksi.php';

// Pastikan pengguna adalah admin
if ($_SESSION['role_user'] != 'Admin') {
    header("Location: login.php");
    exit();
}

// Cek apakah id guru ada
if (isset($_GET['id'])) {
    $idGuru = $_GET['id'];

    // Dapatkan id_user dari guru ngaji yang akan dihapus
    $query = "SELECT id_user FROM guru_ngaji WHERE id_guru = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $idGuru);
    $stmt->execute();
    $stmt->bind_result($idUser);
    $stmt->fetch();
    $stmt->close();

    // Hapus guru ngaji dari tabel guru_ngaji
    $query = "DELETE FROM guru_ngaji WHERE id_guru = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $idGuru);

    if ($stmt->execute()) {
        // Hapus entri dari login_user
        $query = "DELETE FROM login_user WHERE id_user = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("i", $idUser);
        $stmt->execute();

        // Jika berhasil dihapus, tampilkan pesan konfirmasi
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href = 'keloladataguru.php'; // Redirect ke halaman keloladataguru.php
              </script>";
    } else {
        // Jika gagal menghapus, tampilkan pesan error
        echo "<script>
                alert('Gagal menghapus data!');
                window.location.href = 'keloladataguru.php'; // Redirect ke halaman keloladataguru.php
              </script>";
    }
}
?>
