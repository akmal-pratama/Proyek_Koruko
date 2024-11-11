<?php
require"koneksi.php";


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Mengisi session default
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
} else {
    $user = "";
}

// Mengambil data admin
$sql = "SELECT nama_admin FROM admin";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nama_admin = $row['nama_admin'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <style>
        .navbar {
            background-color: black;
            padding: 10px 0;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .navbar-logo {
            display: flex;
            align-items: center;
        }

        .navbar-logo-link {
            text-decoration: none;
        }

        .navbar-logo-img {
            width: auto;
            height: 30px;
        }

        .navbar-middle {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar-item {
            list-style: none;
            margin: 0 10px;
        }

        .navbar-link {
            text-decoration: none;
            color: white;
        }

        .navbar-right {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <!-- Navbar kiri -->
            <div class="navbar-logo">
                <a href="index.php" class="navbar-logo-link">
                    <img src="images/website/koruko_purple.png" alt="logo" class="navbar-logo-img">
                    Judul Web
                </a>
            </div>
            <ul class="navbar-middle">
                <!-- Signed Out User -->
                <?php if ($user != $nama_admin): ?>
                <li class="navbar-item">
                    <a href="index.php" class="navbar-link">Beranda</a>
                </li>
                <li class="navbar-item">
                    <a href="tentang.php" class="navbar-link">Tentang</a>
                </li>
                <li class="navbar-item">
                    <a href="pencarian.php" class="navbar-link">Cari</a>
                </li>

                <!-- Signed In User-->
                <?php elseif (isset($_SESSION['user']) && $user != $nama_admin): ?>
                <li class="navbar-item">
                    <a href="kelola.php" class="navbar-link">Kelola</a>
                
                <!-- Signed In Admin-->
                 <?php elseif (isset($_SESSION['user']) && $user == $nama_admin): ?>
                 <li class="navbar-item">
                    <a href="admin_properti.php" class="navbar-link">Properti</a>
                </li>
                <li class="navbar-item">
                    <a href="admin_akun.php" class="navbar-link">Pengguna</a>   
                </li>
                <li class="navbar-item">
                    <a href="admin_tentang.php" class="navbar-link">Tentang</a>
                </li>
                <li class="navbar-item">
                    <a href="admin_pengaturan.php" class="navbar-link">Pengaturan</a>
                </li>
                <?php endif; ?>


            </ul>
            <ul class="navbar-right">
                <!-- Signed Out -->
                 <?php if (!isset($_SESSION['user'])): ?>
                <li class="navbar-item">
                    <a href="masuk.php" class="navbar-link">Masuk</a>
                </li>
                <li class="navbar-item">
                    <a href="daftar.php" class="navbar-link">Daftar</a>
                </li>
                <?php else: ?>
                <!-- Signed In -->
                <li class="navbar-item">
                    <a href="profil.php" class="navbar-link">Profil</a>
                </li>
                <li class="navbar-item">
                    <a href="keluar.php" class="navbar-link">Keluar</a>
                </li>
                <?php endif; ?>
        </div>
    </nav>
    
</body>
</html>