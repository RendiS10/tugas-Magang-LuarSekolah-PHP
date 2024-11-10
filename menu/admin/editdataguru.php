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

    // Dapatkan data guru ngaji berdasarkan id
    $query = "SELECT * FROM guru_ngaji WHERE id_guru = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $idGuru);
    $stmt->execute();
    $result = $stmt->get_result();
    $guru = $result->fetch_assoc();
    $stmt->close();

    if (!$guru) {
        echo "<script>
                alert('Data guru tidak ditemukan!');
                window.location.href = 'keloladataguru.php';
              </script>";
        exit();
    }
} else {
    header("Location: keloladataguru.php");
    exit();
}

// Inisialisasi variabel
$namaLengkap = $guru['nama_lengkap'];
$gender = $guru['gender'];
$tempatKotaLahir = $guru['tempat_kota_lahir'];
$tanggalLahir = $guru['tanggal_lahir'];
$alamat = $guru['alamat'];
$noHp = $guru['no_hp'];
$hobi = $guru['hobi'];
$fotoGuruNgaji = $guru['fotogurungaji'];
$errors = [];

// Proses form ketika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaLengkap = $_POST['nama_lengkap'];
    $gender = $_POST['gender'];
    $tempatKotaLahir = $_POST['tempat_kota_lahir'];
    $tanggalLahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $noHp = $_POST['no_hp'];
    $hobi = $_POST['hobi'];
    $fotoGuruNgaji = $_POST['fotogurungaji'];

    // Validasi data
    if (empty($namaLengkap)) {
        $errors[] = "Nama lengkap harus diisi.";
    }
    if (empty($gender)) {
        $errors[] = "Gender harus dipilih.";
    }

    // Jika tidak ada error, perbarui data di database
    if (empty($errors)) {
        $query = "UPDATE guru_ngaji SET nama_lengkap = ?, gender = ?, tempat_kota_lahir = ?, tanggal_lahir = ?, alamat = ?, no_hp = ?, hobi = ?, fotogurungaji = ? WHERE id_guru = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssssssssi", $namaLengkap, $gender, $tempatKotaLahir, $tanggalLahir, $alamat, $noHp, $hobi, $fotoGuruNgaji, $idGuru);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Data berhasil diperbarui!');
                    window.location.href = 'keloladataguru.php';
                  </script>";
        } else {
            $errors[] = "Gagal memperbarui data.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Guru Ngaji</title>
    <link rel="stylesheet" href="../../css/keloladata.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Menyertakan sidebar -->
    <?php include('../template/sidebar.php'); ?>

    <div class="container" style="margin-left: 270px; padding-top: 20px;">
        <h2>Edit Data Guru Ngaji</h2>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form id="editForm" action="editdataguru.php?id=<?php echo $idGuru; ?>" method="post" class="mt-4">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($namaLengkap); ?>" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" class="form-control" required>
                    <option value="">Pilih Gender</option>
                    <option value="Laki-laki" <?php if ($gender == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if ($gender == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tempat_kota_lahir">Tempat Kota Lahir:</label>
                <input type="text" name="tempat_kota_lahir" id="tempat_kota_lahir" class="form-control" value="<?php echo htmlspecialchars($tempatKotaLahir); ?>">
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?php echo htmlspecialchars($tanggalLahir); ?>">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea name="alamat" id="alamat" class="form-control"><?php echo htmlspecialchars($alamat); ?></textarea>
            </div>

            <div class="form-group">
                <label for="no_hp">No HP:</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?php echo htmlspecialchars($noHp); ?>">
            </div>

            <div class="form-group">
                <label for="hobi">Hobi:</label>
                <input type="text" name="hobi" id="hobi" class="form-control" value="<?php echo htmlspecialchars($hobi); ?>">
            </div>

            <div class="form-group">
                <label for="fotogurungaji">Foto Guru Ngaji:</label>
                <input type="text" name="fotogurungaji" id="fotogurungaji" class="form-control" value="<?php echo htmlspecialchars($fotoGuruNgaji); ?>">
            </div>

            <a href="keloladataguru.php" class="btn btn-danger">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <br>
            <br>
        </form>
    </div>

    <script>
        // Konfirmasi menggunakan SweetAlert sebelum submit
        document.getElementById('editForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form disubmit langsung

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data guru ngaji akan diperbarui.",
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
