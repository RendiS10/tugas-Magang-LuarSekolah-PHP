<?php 
// Mulai session
session_start();
require '../controller/koneksi.php';
require '../controller/controller.php'; // Include the registration handler

$error = ''; // Variabel untuk pesan error atau status registrasi

// Proses form jika ada input dari pengguna
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = handleRegistration($koneksi);

    // Periksa apakah registrasi berhasil atau gagal
    if ($result === true) {
        $error = 'success'; // Set 'success' jika registrasi berhasil
    } else {
        $error = $result; // Set pesan error jika registrasi gagal
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Nuruddin Institute</title>
  <link rel="stylesheet" href="../css/regist.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="../css/responsive.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <section>
    <div class="login-container">
      <img src="../img/FotoProfilNuruddinInstitue.jpg" alt="Logo Nuruddin Institute">
      <fieldset>
        <legend>Action</legend>
        <form method="POST" enctype="multipart/form-data">
          <ul>
            <!-- Form input fields -->
            <li>
              <label for="nama">Nama Lengkap</label>
              <input type="text" name="nama" id="nama" placeholder="Masukan Nama Lengkap Anda!" value="<?php echo htmlspecialchars($_POST['nama'] ?? ''); ?>">
            </li>
            <li>
              <label for="gender">Jenis Kelamin</label>
              <select name="gender" id="gender">
                <option value="" disabled <?php echo (empty($_POST['gender'])) ? 'selected' : ''; ?>>Silahkan Pilih</option>
                <option value="Laki-Laki" <?php echo ($_POST['gender'] ?? '' == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                <option value="Perempuan" <?php echo ($_POST['gender'] ?? '' == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
              </select>
            </li>
            <li>
              <label for="tempatLahir">Tempat Kota Lahir</label>
              <input type="text" name="tempatLahir" id="tempatLahir" placeholder="Masukan Tempat Lahir Anda" value="<?php echo htmlspecialchars($_POST['tempatLahir'] ?? ''); ?>">
            </li>
            <li>
              <label for="tanggalLahir">Tanggal Lahir</label>
              <input type="date" name="tanggalLahir" id="tanggalLahir" value="<?php echo htmlspecialchars($_POST['tanggalLahir'] ?? ''); ?>">
            </li>
            <li>
              <label for="alamat">Alamat</label>
              <input type="text" name="alamat" id="alamat" placeholder="Masukan Alamat Anda" value="<?php echo htmlspecialchars($_POST['alamat'] ?? ''); ?>">
            </li>
            <li>
              <label for="noHp">No HP</label>
              <input type="number" name="noHp" id="noHp" placeholder="Masukan Nomor HP Anda" value="<?php echo htmlspecialchars($_POST['noHp'] ?? ''); ?>">
            </li>
            <li>
              <label for="role">Role</label>
              <select name="role" id="role">
                <option value="" disabled selected>Pilih Role</option>
                <option value="Peserta" <?php echo ($_POST['role'] ?? '' == 'Peserta') ? 'selected' : ''; ?>>Peserta</option>
                <option value="Admin" <?php echo ($_POST['role'] ?? '' == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="Guru Ngaji" <?php echo ($_POST['role'] ?? '' == 'Guru Ngaji') ? 'selected' : ''; ?>>Guru Ngaji</option>
              </select>
            </li>
            <li>
              <label for="username">Username/Email</label>
              <input type="email" name="username" id="username" placeholder="Masukan Username/Email Anda!" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
            </li>
            <li>
              <label for="password">Password</label>
              <input type="password" name="password" id="password" placeholder="Masukan Password Anda!">
            </li>
            <li>
              <input name="submit" type="submit" value="Daftar">
            </li>
            <li class="aksi">
              <a href="login.php">Kembali Ke Halaman Login</a>
            </li>
          </ul>
        </form>

        <!-- SweetAlert untuk notifikasi hasil registrasi -->
        <?php if ($error === 'success'): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Registrasi Berhasil',
                    text: 'Anda telah berhasil mendaftar!',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = 'login.php'; // Redirect ke halaman login setelah sukses
                });
            </script>
        <?php elseif (!empty($error)): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registrasi Gagal',
                    text: '<?php echo $error; ?>',
                });
            </script>
        <?php endif; ?>
      </fieldset>
    </div>
  </section>
</body>
</html>
