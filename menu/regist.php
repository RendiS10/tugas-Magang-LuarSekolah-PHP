<?php 
// Mulai session
session_start();

require '../controller/koneksi.php';

// Inisialisasi variabel untuk menghindari error "undefined index"
$nama = $gender = $tempatLahir = $tanggalLahir = $alamat = $noHp = $username = $password = $role = '';
$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form dengan pengecekan isset
    $nama = $_POST['nama'] ?? ''; // Menyimpan data nama atau string kosong
    $gender = $_POST['gender'] ?? ''; // Menyimpan data gender atau string kosong
    $tempatLahir = $_POST['tempatLahir'] ?? '';
    $tanggalLahir = $_POST['tanggalLahir'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $noHp = $_POST['noHp'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? null; // Menyimpan role yang dipilih, gunakan null jika tidak ada

    // Memeriksa apakah ada field yang kosong
    if (empty($username) || empty($password) || empty($nama) || empty($gender) || empty($tempatLahir) || empty($tanggalLahir) || empty($alamat) || empty($noHp) || empty($role)) {
        echo "<script>alert('Mohon Lengkapi Data Anda !')</script>";
        $error = true;
    } else {
        // Hash password sebelum disimpan
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Menyimpan data ke dalam tabel login_user
        $stmt = $koneksi->prepare("INSERT INTO login_user (username, password, role_user) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $role);

        if ($stmt->execute()) {
            // Mendapatkan ID pengguna yang baru saja ditambahkan
            $id_user = $koneksi->insert_id;

            // Menyimpan data tambahan di tabel peserta
            $stmt2 = $koneksi->prepare("INSERT INTO peserta (id_user, nama_lengkap, gender, tempat_kota_lahir, tanggal_lahir, alamat, no_hp) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt2->bind_param("issssss", $id_user, $nama, $gender, $tempatLahir, $tanggalLahir, $alamat, $noHp);

            if ($stmt2->execute()) {
                // Berhasil menyimpan data
                echo "<script>alert('Registrasi berhasil!'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data peserta!')</script>";
            }
        } else {
            echo "<script>alert('Gagal menyimpan data login!')</script>";
        }
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
              <?php if ($error && empty($nama)) :?>
                <label for="nama" style="color:red">Masukan Nama Lengkap Anda !</label>
              <?php endif ?>
              <input type="text" name="nama" id="nama" placeholder="Masukan Nama Lengkap Anda!" value="<?php echo htmlspecialchars($nama); ?>">
            </li>
            <li>
              <label for="gender">Jenis Kelamin</label>
              <?php if ($error && empty($gender)) :?>
                <label for="gender" style="color:red">Masukan Jenis Kelamin Anda !</label>
              <?php endif ?>
              <select name="gender" id="gender">
                <option value="" disabled <?php echo ($gender == '') ? 'selected' : ''; ?>>Silahkan Pilih</option>
                <option value="Laki-Laki" <?php echo ($gender == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                <option value="Perempuan" <?php echo ($gender == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
              </select>
            </li>
            <li>
              <label for="tempatLahir">Tempat Kota Lahir</label>
              <?php if ($error && empty($tempatLahir)) :?>
                <label for="tempatLahir" style="color:red">Masukan Kota Lahir Anda !</label>
              <?php endif ?>
              <input type="text" name="tempatLahir" id="tempatLahir" placeholder="Masukan Tempat Lahir Anda" value="<?php echo htmlspecialchars($tempatLahir); ?>">
            </li>
            <li>
              <label for="tanggalLahir">Tanggal Lahir</label>
              <?php if ($error && empty($tanggalLahir)) :?>
                <label for="tanggalLahir" style="color:red">Masukan Tanggal Lahir Anda !</label>
              <?php endif ?>
              <input type="date" name="tanggalLahir" id="tanggalLahir" value="<?php echo htmlspecialchars($tanggalLahir); ?>">
            </li>
            <li>
              <label for="alamat">Alamat</label>
              <?php if ($error && empty($alamat)) :?>
                <label for="alamat" style="color:red">Masukan Alamat Anda !</label>
              <?php endif ?>
              <input type="text" name="alamat" id="alamat" placeholder="Masukan Alamat Anda" value="<?php echo htmlspecialchars($alamat); ?>">
            </li>
            <li>
              <label for="noHp">No HP</label>
              <?php if ($error && empty($noHp)) :?>
                <label for="noHp" style="color:red">Masukan Nomor HP Anda !</label>
              <?php endif ?>
              <input type="number" name="noHp" id="noHp" placeholder="Masukan Nomor HP Anda" value="<?php echo htmlspecialchars($noHp); ?>">
            </li>
            <li>
              <label for="role">Role</label>
              <?php if ($error && empty($role)) :?>
                <label for="role" style="color:red">Pilih Role Anda !</label>
              <?php endif ?>
              <select name="role" id="role">
                <option value="" disabled selected>Pilih Role</option>
                <option value="Peserta" <?php echo ($role == 'Peserta') ? 'selected' : ''; ?>>Peserta</option>
                <option value="Admin" <?php echo ($role == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="Guru Ngaji" <?php echo ($role == 'Guru Ngaji') ? 'selected' : ''; ?>>Guru Ngaji</option>
              </select>
            </li>
            <li>
              <label for="username">Username/Email</label>
              <?php if ($error && empty($username)) :?>
                <label for="username" style="color:red">Masukan Username Yang Akan Anda Pakai!</label>
              <?php endif ?>
              <input type="email" name="username" id="username" placeholder="Masukan Username/Email Anda!" value="<?php echo htmlspecialchars($username); ?>">
            </li>
            <li>
              <label for="password">Password</label>
              <?php if ($error && empty($password)) :?>
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
</body>
</html>
