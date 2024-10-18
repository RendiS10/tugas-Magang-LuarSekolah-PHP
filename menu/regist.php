<?php 
  if(isset($_GET['submit'])) {
    $nama = $_GET['nama'];
    $gender = $_GET['gender'];
    $tempatLahir = $_GET['tempatLahir'];
    $tanggalLahir = $_GET['tanggalLahir'];
    $alamat = $_GET['alamat'];
    $noHp = $_GET['noHp'];
    $username = $_GET['username'];
    $password = $_GET['password'];
    
    // Memeriksa apakah ada field yang kosong
    if ($nama == "" || $gender == "" || $tempatLahir == "" || $tanggalLahir == "" || $alamat == "" || $noHp == "" || $username == "" || $password == "") {
      echo "<script>alert('Mohon Lengkapi Data Anda !')</script>";
      $error = true;
    } else {
      echo "<script>alert('Registrasi Berhasil,Silahkan anda Login')</script>";
      header("Location: succesRegist.php?nama=$nama&gender=$gender&tempatLahir=$tempatLahir&tanggalLahir=$tanggalLahir&alamat=$alamat&noHp=$noHp&username=$username");
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
        <form method= "_GET" enctype="multipart/form-data">
          <ul>
            <li>
              <label for="nama">Nama Lengkap</label>
              <?php if (isset($error) && empty($nama)) :?>
                <label for="nama" style="color:red">Masukan Nama Lengkap Anda !</label>
              <?php endif ?>
              <input type="text" name="nama" id="nama" placeholder="Masukan Nama Lengkap Anda!" value="<?php echo isset($nama) ? htmlspecialchars($nama) : ''; ?>">
            </li>
            <li>
              <label for="gender">Jenis Kelamin</label>
              <?php if (isset($error) && empty($gender)) :?>
                <label for="gender" style="color:red">Masukan Jenis Kelamin Anda !</label>
              <?php endif ?>
              <select name="gender" id="gender">
                <option value="Laki-Laki" <?php echo (isset($gender) && $gender == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                <option value="Perempuan" <?php echo (isset($gender) && $gender == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
              </select>
            </li>
            <li>
              <label for="tempatLahir">Tempat Kota Lahir</label>
              <?php if (isset($error) && empty($tempatLahir)) :?>
                <label for="tempatLahir" style="color:red">Masukan Kota Lahir Anda !</label>
              <?php endif ?>
              <input type="text" name="tempatLahir" id="tempatLahir" placeholder="Masukan Tempat Lahir Anda" value="<?php echo isset($tempatLahir) ? htmlspecialchars($tempatLahir) : ''; ?>">
            </li>
            <li>
              <label for="tanggalLahir">Tanggal Lahir</label>
              <?php if (isset($error) && empty($tanggalLahir)) :?>
                <label for="tanggalLahir" style="color:red">Masukan Tanggal Lahir Anda !</label>
              <?php endif ?>
              <input type="date" name="tanggalLahir" id="tanggalLahir" value="<?php echo isset($tanggalLahir) ? htmlspecialchars($tanggalLahir) : ''; ?>">
            </li>
            <li>
              <label for="alamat">Alamat</label>
              <?php if (isset($error) && empty($alamat)) :?>
                <label for="alamat" style="color:red">Masukan Alamat Anda !</label>
              <?php endif ?>
              <input type="text" name="alamat" id="alamat" placeholder="Masukan Alamat Anda" value="<?php echo isset($alamat) ? htmlspecialchars($alamat) : ''; ?>">
            </li>
            <li>
              <label for="noHp">No HP</label>
              <?php if (isset($error) && empty($noHp)) :?>
                <label for="noHp" style="color:red">Masukan Nomor HP Anda !</label>
              <?php endif ?>
              <input type="number" name="noHp" id="noHp" placeholder="Masukan Nomor HP Anda" value="<?php echo isset($noHp) ? htmlspecialchars($noHp) : ''; ?>">
            </li>
            <li>
              <label for="hobi">Hobi</label>
              <?php if (isset($error) && empty($hobi)) :?>
                <label for="hobi" style="color:red">Masukan Hobi Anda !</label>
              <?php endif ?>
              <input type="text" name="hobi" id="hobi" placeholder="Masukan Hobi Anda" value="<?php echo isset($hobi) ? htmlspecialchars($hobi) : ''; ?>">
            </li>
            <li>
              <label for="fileUpload">Upload File</label>
              <input type="file" name="fileUpload" id="fileUpload">
            </li>
            <li>
              <label for="username">Username/Email</label>
              <?php if (isset($error) && empty($username)) :?>
                <label for="username" style="color:red">Masukan Username Yang Akan Anda Pakai!</label>
              <?php endif ?>
              <input type="email" name="username" id="username" placeholder="Masukan Username/Email Anda!" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
            </li>
            <li>
              <label for="password">Password</label>
              <?php if (isset($error) && empty($password)) :?>
                <label for="password" style="color:red">Masukan Password Yang Akan Anda Pakai !</label>
              <?php endif ?>
              <input type="password" name="password" id="password" placeholder="Masukan Password Anda!">
            </li>
            <li>
              <input name = "submit" type="submit"></input>
            </li>
            <li class="aksi">
              <a href="login.html">Kembali Ke Halaman Login</a>
            </li>
          </ul>
        </form>
      </fieldset>
    </div>
  </section>
</body>
</html>
