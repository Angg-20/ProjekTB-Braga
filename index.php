<?php
session_start();

include "config/database.php";

if (!isset($_SESSION['user'])) {
    header("location: page/auth/login.php");
}

$cari = $_GET['query'] ?? "";

$sql = "SELECT * FROM buku WHERE judul LIKE '%$cari%' OR penulis LIKE '%$cari%' OR penerbit LIKE '%$cari%' OR penulis LIKE '%$cari%' OR stok LIKE '%$cari%' limit 10";
$hasil = $db->query($sql);

?>




<?php

include "layout/header.php";

?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">Toko Buku</a>

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </div>

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#!">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

<div id="layoutSidenav">

    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Dashboard</div>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Pages</div>

                    <a class="nav-link" href="/page/buku/index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></i></div>
                        Buku
                    </a>
                    <a class="nav-link" href="/page/penjualan/index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-sale"></i></i></div>
                        penjualan
                    </a>
                    <div class="sb-sidenav-menu-heading">Setings</div>
                    <a class="nav-link" href="/page/auth/Exit.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Log out
                    </a>
                </div>
            </div>
        </nav>
    </div>


    <div id="layoutSidenav_content">

        <main class="mt-3">
            <div class="container">

            </div>
        </main>
    </div>

</div>
<?php include "layout/footer.php"; ?>