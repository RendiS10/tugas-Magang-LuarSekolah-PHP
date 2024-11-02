<?php 
// Mulai session
session_start();

require '../controller/koneksi.php';
require '../controller/controller.php'; // Include the registration handler

$error = false;
$registrationSuccess = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = handleRegistration($koneksi);

    // Jika tidak ada error, anggap registrasi berhasil
    if (!$error) {
        $registrationSuccess = true;
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
            <li>
              <label for="nama">Nama Lengkap</label>
              <?php if ($error && empty($_POST['nama'])) :?>
                <label for="nama" style="color:red">Masukan Nama Lengkap Anda !</label>
              <?php endif ?>
              <input type="text" name="nama" id="nama" placeholder="Masukan Nama Lengkap Anda!" value="<?php echo htmlspecialchars($_POST['nama'] ?? ''); ?>">
            </li>
            <li>
              <label for="gender">Jenis Kelamin</label>
              <?php if ($error && empty($_POST['gender'])) :?>
                <label for="gender" style="color:red">Masukan Jenis Kelamin Anda !</label>
              <?php endif ?>
              <select name="gender" id="gender">
                <option value="" disabled <?php echo (empty($_POST['gender'])) ? 'selected' : ''; ?>>Silahkan Pilih</option>
                <option value="Laki-Laki" <?php echo ($_POST['gender'] ?? '' == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                <option value="Perempuan" <?php echo ($_POST['gender'] ?? '' == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
              </select>
            </li>
            <li>
              <label for="tempatLahir">Tempat Kota Lahir</label>
              <?php if ($error && empty($_POST['tempatLahir'])) :?>
                <label for="tempatLahir" style="color:red">Masukan Kota Lahir Anda !</label>
              <?php endif ?>
              <input type="text" name="tempatLahir" id="tempatLahir" placeholder="Masukan Tempat Lahir Anda" value="<?php echo htmlspecialchars($_POST['tempatLahir'] ?? ''); ?>">
            </li>
            <li>
              <label for="tanggalLahir">Tanggal Lahir</label>
              <?php if ($error && empty($_POST['tanggalLahir'])) :?>
                <label for="tanggalLahir" style="color:red">Masukan Tanggal Lahir Anda !</label>
              <?php endif ?>
              <input type="date" name="tanggalLahir" id="tanggalLahir" value="<?php echo htmlspecialchars($_POST['tanggalLahir'] ?? ''); ?>">
            </li>
            <li>
              <label for="alamat">Alamat</label>
              <?php if ($error && empty($_POST['alamat'])) :?>
                <label for="alamat" style="color:red">Masukan Alamat Anda !</label>
              <?php endif ?>
              <input type="text" name="alamat" id="alamat" placeholder="Masukan Alamat Anda" value="<?php echo htmlspecialchars($_POST['alamat'] ?? ''); ?>">
            </li>
            <li>
              <label for="noHp">No HP</label>
              <?php if ($error && empty($_POST['noHp'])) :?>
                <label for="noHp" style="color:red">Masukan Nomor HP Anda !</label>
              <?php endif ?>
              <input type="number" name="noHp" id="noHp" placeholder="Masukan Nomor HP Anda" value="<?php echo htmlspecialchars($_POST['noHp'] ?? ''); ?>">
            </li>
            <li>
              <label for="role">Role</label>
              <?php if ($error && empty($_POST['role'])) :?>
                <label for="role" style="color:red">Pilih Role Anda !</label>
              <?php endif ?>
              <select name="role" id="role">
                <option value="" disabled selected>Pilih Role</option>
                <option value="Peserta" <?php echo ($_POST['role'] ?? '' == 'Peserta') ? 'selected' : ''; ?>>Peserta</option>
                <option value="Admin" <?php echo ($_POST['role'] ?? '' == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="Guru Ngaji" <?php echo ($_POST['role'] ?? '' == 'Guru Ngaji') ? 'selected' : ''; ?>>Guru Ngaji</option>
              </select>
            </li>
            <li>
              <label for="username">Username/Email</label>
              <?php if ($error && empty($_POST['username'])) :?>
                <label for="username" style="color:red">Masukan Username Yang Akan Anda Pakai!</label>
              <?php endif ?>
              <input type="email" name="username" id="username" placeholder="Masukan Username/Email Anda!" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
            </li>
            <li>
              <label for="password">Password</label>
              <?php if ($error && empty($_POST['password'])) :?>
                <label for="password" style="color:red">Masukan Password Yang Akan Anda Pakai !</label>
              <?php endif ?>
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
      </fieldset>
    </div>
  </section>

  <!-- SweetAlert untuk menampilkan pesan sukses atau gagal -->
  <?php if ($registrationSuccess): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Registrasi Berhasil',
        text: 'Akun Anda berhasil dibuat. Silakan login.',
      }).then(function() {
        window.location.href = 'login.php';
      });
    </script>
  <?php elseif ($error): ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Registrasi Gagal',
        text: 'Mohon Lengkapi Data Anda !.',
      });
    </script>
  <?php endif; ?>
</body>
</html>
