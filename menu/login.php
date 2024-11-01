<?php
session_start();
require '../controller/koneksi.php'; // Pastikan file ini menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    global $koneksi;

    // Menggunakan prepared statement untuk keamanan
    $stmt = $koneksi->prepare("SELECT * FROM login_user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah username ada di database
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password dengan password_verify()
        if (password_verify($password, $user['password'])) {
            // Password benar, simpan informasi login ke session
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_user'] = $user['role_user'];

            // Mengarahkan pengguna berdasarkan peran mereka
            if ($user['role_user'] == 'Peserta') {
                header("Location: peserta_dashboard.php"); // Sesuaikan halaman dashboard peserta
            } elseif ($user['role_user'] == 'Admin') {
                header("Location: admin_dashboard.php"); // Sesuaikan halaman dashboard admin
            } elseif ($user['role_user'] == 'Guru Ngaji') {
                header("Location: guru_dashboard.php"); // Sesuaikan halaman dashboard guru ngaji
            }
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Login</title>
    <link rel="stylesheet" href="../css/login.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="../css/responsive.css" />
</head>

<body>
    <section>
        <div class="login-container">
            <img src="../img/FotoProfilNuruddinInstitue.jpg" alt="Logo Nuruddin Institute" />
            <fieldset>
                <legend>Action</legend>
                <form id="loginForm" method="POST" action="">
                    <ul>
                        <li>
                            <label for="username">Username/Email</label>
                            <input type="email" name="username" id="username" placeholder="Masukan Username/Email Anda!" required />
                        </li>
                        <li>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Masukan Password Anda!" required />
                        </li>
                        <li>
                            <input type="submit" value="Login" name="submit" />
                        </li>
                        <li class="aksi">
                            <a href="regist.php">Daftar</a>
                        </li>
                        <li class="aksi">
                            <a href="../index.html">Kembali Ke Home</a>
                        </li>
                    </ul>
                </form>
                <!-- Pesan error jika login gagal -->
                <?php if (!empty($error)): ?>
                    <p style="color:red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </fieldset>
        </div>
    </section>
</body>
</html>
