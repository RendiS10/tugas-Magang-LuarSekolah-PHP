<?php
session_start();
require '../../controller/koneksi.php';

// Pastikan pengguna adalah admin
if ($_SESSION['role_user'] != 'Admin') {
    header("Location: login.php");
    exit();
}

// Inisialisasi variabel
$namaProgram = $deskripsi = $durasi = $level = "";
$errors = [];

// Proses form ketika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaProgram = $_POST['nama_program'];
    $deskripsi = $_POST['deskripsi'];
    $durasi = $_POST['durasi'];
    $level = $_POST['level'];

    // Validasi data
    if (empty($namaProgram)) {
        $errors[] = "Nama program harus diisi.";
    }

    // Jika tidak ada error, simpan data ke database
    if (empty($errors)) {
        $stmt = $koneksi->prepare("INSERT INTO program_pelatihan (nama_program, deskripsi, durasi, level) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $namaProgram, $deskripsi, $durasi, $level);

        if ($stmt->execute()) {
            header("Location: kelolaprogram.php");
            exit();
        } else {
            $errors[] = "Gagal menambahkan program pelatihan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Program Pelatihan</title>
    <link rel="stylesheet" href="../../css/keloladata.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Menyertakan sidebar -->
    <?php include('../template/sidebar.php'); ?>

    <div class="container" style="margin-left: 270px; padding-top: 20px;">
        <h2>Tambah Program Pelatihan</h2>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="tambahprogram.php" method="post" class="mt-4">
            <div class="form-group">
                <label for="nama_program">Nama Program:</label>
                <input type="text" name="nama_program" id="nama_program" class="form-control" value="<?php echo htmlspecialchars($namaProgram); ?>" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control"><?php echo htmlspecialchars($deskripsi); ?></textarea>
            </div>

            <div class="form-group">
                <label for="durasi">Durasi:</label>
                <input type="text" name="durasi" id="durasi" class="form-control" value="<?php echo htmlspecialchars($durasi); ?>">
            </div>

            <div class="form-group">
                <label for="level">Level:</label>
                <input type="text" name="level" id="level" class="form-control" value="<?php echo htmlspecialchars($level); ?>">
            </div>

            <button type="submit" class="btn btn-primary">Tambah Program</button>
        </form>
    </div>
</body>
</html>
