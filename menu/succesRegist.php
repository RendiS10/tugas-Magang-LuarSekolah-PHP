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

<article>
    <h2>Kartu Anggota</h2>
    <section>
        <ul>
            <li>
                <h3><?php echo htmlspecialchars($nama); ?></h3>
            </li>
            <li>
                <p><strong>Jenis Kelamin:</strong> <?php echo htmlspecialchars($gender); ?></p>
            </li>
            <li>
                <p><strong>Tempat Lahir:</strong> <?php echo htmlspecialchars($tempatLahir); ?></p>
            </li>
            <li>
                <p><strong>Tanggal Lahir:</strong> <?php echo htmlspecialchars($tanggalLahir); ?></p>
            </li>
            <li>
                <p><strong>Alamat:</strong> <?php echo htmlspecialchars($alamat); ?></p>
            </li>
            <li>
                <p><strong>Nomor HP:</strong> <?php echo htmlspecialchars($noHp); ?></p>
            </li>
             <li>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
            </li> 
</ul>
</section>
</article>
</body>
</html>
