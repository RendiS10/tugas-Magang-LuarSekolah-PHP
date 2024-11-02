<?php 
session_start();
require '../controller/koneksi.php'; // Pastikan file ini menghubungkan ke database
require '../controller/controller.php'; // Include the login handler 

$error = '';
$loginSuccess = false;
$roleUser = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Cek apakah login berhasil atau gagal
    $result = handleLogin($username, $password);
    if ($result === "Peserta" || $result === "Admin" || $result === "Guru Ngaji") {
        $loginSuccess = true;
        $roleUser = $result;
    } else {
        $error = $result;
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal',
                            text: '<?php echo $error; ?>',
                        });
                    </script>
                <?php endif; ?>
                
                <!-- Pesan sukses jika login berhasil -->
                <?php if ($loginSuccess): ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Berhasil',
                            text: 'Anda berhasil login!',
                        }).then(function() {
                            // Arahkan pengguna ke halaman yang sesuai dengan peran
                            <?php if ($roleUser == 'Peserta'): ?>
                                window.location.href = 'peserta_dashboard.php';
                            <?php elseif ($roleUser == 'Admin'): ?>
                                window.location.href = 'admin_dashboard.php';
                            <?php elseif ($roleUser == 'Guru Ngaji'): ?>
                                window.location.href = 'guru_dashboard.php';
                            <?php endif; ?>
                        });
                    </script>
                <?php endif; ?>
            </fieldset>
        </div>
    </section>
</body>
</html>