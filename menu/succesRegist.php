<?php
// Memeriksa apakah data telah dikirim melalui GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nama = $_GET['nama'];
    $gender = $_GET['gender'];
    $tempatLahir = $_GET['tempatLahir'];
    $tanggalLahir = $_GET['tanggalLahir'];
    $alamat = $_GET['alamat'];
    $noHp = $_GET['noHp'];
    $username = $_GET['username'];

    // Validasi: Memeriksa apakah ada field yang kosong
    $error = false;
    if (empty($nama) || empty($gender) || empty($tempatLahir) || empty($tanggalLahir) || empty($alamat) || empty($noHp) || empty($username)) {
        $error = true;
    }

    if ($error) {
        // Jika ada field yang kosong, redirect kembali ke form
        header("Location: regist.php");
        exit();
    }

    // Memformat tanggal lahir
    if (!empty($tanggalLahir)) {
        $tanggalLahir = date("d/m/Y", strtotime($tanggalLahir));
    }
} else {
    // Jika tidak ada data, redirect kembali ke form
    header("Location: regist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Anggota</title>
    <link rel="stylesheet" href="../css/successRegist.css">
</head>
<body>

<article class="<?php echo ($gender == 'Laki-Laki') ? 'article-male' : 'article-female'; ?>">
    <h2>Kartu Anggota</h2>
    <section>
            <table>
                <tr>
                    <td>Nama Lengkap:</td>
                    <td><?php echo htmlspecialchars($nama); ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin:</td>
                    <td><?php echo htmlspecialchars($gender); ?></td>
                </tr>
                <tr>
                    <td>Tempat Lahir:</td>
                    <td><?php echo htmlspecialchars($tempatLahir); ?></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir:</td>
                    <td><?php echo htmlspecialchars($tanggalLahir); ?></td>
                </tr>
                <tr>
                    <td>Alamat:</td>
                    <td><?php echo htmlspecialchars($alamat); ?></td>
                </tr>
                <tr>
                    <td>Nomor HP:</td>
                    <td><?php echo htmlspecialchars($noHp); ?></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><?php echo htmlspecialchars($username); ?></td>
                </tr>
            </table>
        </section>
</article>
</body>
</html>
