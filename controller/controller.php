<?php
function handleLogin($username, $password) {
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
            return "Password salah.";
        }
    } else {
        return "Username tidak ditemukan.";
    }
}

function handleRegistration($koneksi) {
    // Inisialisasi variabel untuk menghindari error "undefined index"
    $nama = $_POST['nama'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $tempatLahir = $_POST['tempatLahir'] ?? '';
    $tanggalLahir = $_POST['tanggalLahir'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $noHp = $_POST['noHp'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? null;

    // Memeriksa apakah ada field yang kosong
    if (empty($username) || empty($password) || empty($nama) || empty($gender) || empty($tempatLahir) || empty($tanggalLahir) || empty($alamat) || empty($noHp) || empty($role)) {
        return "Mohon Lengkapi Data Anda!";
    }

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
            // Registrasi berhasil
            return false;
        } else {
            return "Gagal menyimpan data peserta!";
        }
    } else {
        return "Gagal menyimpan data login!";
    }
}
?>
