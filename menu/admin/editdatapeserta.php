<?php
session_start();
require '../../controller/koneksi.php';

// Pastikan pengguna adalah admin
if ($_SESSION['role_user'] != 'Admin') {
    header("Location: login.php");
    exit();
}

// Periksa apakah ada ID peserta yang diberikan
if (!isset($_GET['id'])) {
    echo "ID peserta tidak ditemukan.";
    exit();
}

$id_peserta = $_GET['id'];

// Ambil data peserta berdasarkan ID
$query = "SELECT * FROM peserta WHERE id_peserta = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_peserta);
$stmt->execute();
$result = $stmt->get_result();
$peserta = $result->fetch_assoc();

if (!$peserta) {
    echo "Data peserta tidak ditemukan.";
    exit();
}

// Update data peserta jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $gender = $_POST['gender'];
    $tempat_kota_lahir = $_POST['tempat_kota_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $hobi = $_POST['hobi'];

    // Proses update data peserta
    $update_query = "UPDATE peserta SET nama_lengkap=?, gender=?, tempat_kota_lahir=?, tanggal_lahir=?, alamat=?, no_hp=?, hobi=? WHERE id_peserta=?";
    $stmt = $koneksi->prepare($update_query);
    $stmt->bind_param("sssssssi", $nama_lengkap, $gender, $tempat_kota_lahir, $tanggal_lahir, $alamat, $no_hp, $hobi, $id_peserta);

    if ($stmt->execute()) {
        echo "<script>
                alert('Data peserta berhasil diperbarui.');
                window.location.href = 'keloladata.php';
              </script>";
    } else {
        echo "Gagal memperbarui data peserta.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Peserta</title>
    <link rel="stylesheet" href="../css/editdata.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include("../template/sidebar.php")?>

<div class="container" style="margin-left: 270px; padding-top: 20px;">
    <h2>Edit Data Peserta</h2>
    
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" id="editForm" class="mt-4">
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($peserta['nama_lengkap']); ?>" required>
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" class="form-control" required>
                <option value="Laki-laki" <?php echo $peserta['gender'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="Perempuan" <?php echo $peserta['gender'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tempat_kota_lahir">Tempat Kota Lahir:</label>
            <input type="text" id="tempat_kota_lahir" name="tempat_kota_lahir" class="form-control" value="<?php echo htmlspecialchars($peserta['tempat_kota_lahir']); ?>">
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="<?php echo htmlspecialchars($peserta['tanggal_lahir']); ?>">
        </div>

        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" class="form-control"><?php echo htmlspecialchars($peserta['alamat']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="no_hp">No. HP:</label>
            <input type="text" id="no_hp" name="no_hp" class="form-control" value="<?php echo htmlspecialchars($peserta['no_hp']); ?>">
        </div>

        <div class="form-group">
            <label for="hobi">Hobi:</label>
            <input type="text" id="hobi" name="hobi" class="form-control" value="<?php echo htmlspecialchars($peserta['hobi']); ?>">
        </div>

        <button type="submit" id="submitBtn" class="btn btn-primary">Simpan Perubahan</button>
        <button type="button" onclick="window.location.href='keloladata.php'" class="btn btn-secondary">Batal</button>
        <br>
        <br>
    </form>
</div>

<script>
document.getElementById('editForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah form disubmit langsung

    // Konfirmasi dengan SweetAlert2 sebelum menyimpan perubahan
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data peserta akan diperbarui.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, simpan perubahan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika dikonfirmasi, kirim form
            document.getElementById('editForm').submit();
        }
    });
});
</script>

</body>
</html>
