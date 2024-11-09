<!-- sidebar-peserta.php -->
<?php
// Link CSS dan Bootstrap
?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../css/sidebar.css">

<!-- Sidebar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 100vh; position: fixed; width: 250px; top: 0; left: 0; z-index: 1000;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="sidebarMenu">
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="dashboard-peserta.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php" id="logoutButton">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Tambahkan Bootstrap JS dan jQuery di akhir file -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
