<?php 
include("../template/sidebar.php");
session_start();
require '../../controller/koneksi.php';

// Pastikan pengguna adalah admin
if ($_SESSION['role_user'] != 'Admin') {
    header("Location: login.php");
    exit();
}

// Query untuk mendapatkan data guru ngaji dengan join tabel login_user
$query = "SELECT g.id_guru, g.nama_lengkap, g.gender, g.tempat_kota_lahir, g.tanggal_lahir, g.alamat, g.no_hp, g.hobi, g.fotogurungaji, u.username 
          FROM guru_ngaji g 
          JOIN login_user u ON g.id_user = u.id_user";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Guru Ngaji</title>
    <link rel="stylesheet" href="../../css/keloladata.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Gaya khusus untuk tombol tambah data */
        .btn-add {
            margin-bottom: 15px;
            font-weight: bold;
            background-color: #28a745;
            color: white;
        }
        .btn-add:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <?php include('../template/sidebar.php'); ?>

    <div class="main-content">
        <h4>Kelola Data Guru Ngaji</h4>
        <!-- Tabel untuk menampilkan data guru ngaji -->
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>ID Guru</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php while ($guru = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($guru['nama_lengkap']); ?></td>
                        <td><?php echo $guru['id_guru']; ?></td>
                        <td>
                            <a href="editdataguru.php?id=<?php echo $guru['id_guru']; ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button class="btn btn-danger btn-sm" onclick="deleteGuru(<?php echo $guru['id_guru']; ?>)">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                            <button class="btn btn-info btn-sm" onclick="showDetailModal(this)"
                                    data-id="<?php echo $guru['id_guru']; ?>"
                                    data-nama="<?php echo htmlspecialchars($guru['nama_lengkap']); ?>"
                                    data-gender="<?php echo htmlspecialchars($guru['gender']); ?>"
                                    data-ttl="<?php echo htmlspecialchars($guru['tempat_kota_lahir']) . ', ' . $guru['tanggal_lahir']; ?>"
                                    data-alamat="<?php echo htmlspecialchars($guru['alamat']); ?>"
                                    data-nohp="<?php echo htmlspecialchars($guru['no_hp']); ?>"
                                    data-username="<?php echo htmlspecialchars($guru['username']); ?>"
                                    data-hobi="<?php echo htmlspecialchars($guru['hobi']); ?>"
                                    data-foto="<?php echo htmlspecialchars($guru['fotogurungaji']); ?>">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Detail Guru Ngaji -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="detailModalLabel">
                        <i class="fas fa-user-circle"></i> Detail Guru Ngaji
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID Guru</th>
                                <td><i class="fas fa-id-card"></i> <span id="idGuru"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td><i class="fas fa-user"></i> <span id="namaLengkap"></span></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td><i class="fas fa-venus-mars"></i> <span id="gender"></span></td>
                            </tr>
                            <tr>
                                <th>Tempat, Tanggal Lahir</th>
                                <td><i class="fas fa-birthday-cake"></i> <span id="ttl"></span></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><i class="fas fa-map-marker-alt"></i> <span id="alamat"></span></td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td><i class="fas fa-phone-alt"></i> <span id="noHp"></span></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td><i class="fas fa-user-alt"></i> <span id="username"></span></td>
                            </tr>
                            <tr>
                                <th>Hobi</th>
                                <td><i class="fas fa-heart"></i> <span id="hobi"></span></td>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <td><img id="foto" src="" alt="Foto Guru Ngaji" style="width: 150px; height: 150px; object-fit: cover;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times-circle"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function showDetailModal(button) {
        // Mengambil data dari atribut data- tombol
        document.getElementById('idGuru').textContent = button.getAttribute('data-id');
        document.getElementById('namaLengkap').textContent = button.getAttribute('data-nama');
        document.getElementById('gender').textContent = button.getAttribute('data-gender');
        document.getElementById('ttl').textContent = button.getAttribute('data-ttl');
        document.getElementById('alamat').textContent = button.getAttribute('data-alamat');
        document.getElementById('noHp').textContent = button.getAttribute('data-nohp');
        document.getElementById('username').textContent = button.getAttribute('data-username');
        document.getElementById('hobi').textContent = button.getAttribute('data-hobi');
        document.getElementById('foto').src = button.getAttribute('data-foto');

        // Menampilkan modal
        new bootstrap.Modal(document.getElementById('detailModal')).show();
    }

    function deleteGuru(idGuru) {
        if (confirm("Apakah Anda yakin ingin menghapus guru ngaji ini?")) {
            window.location.href = 'deleteguru.php?id=' + idGuru;
        }
    }
    </script>
</body>
</html>
