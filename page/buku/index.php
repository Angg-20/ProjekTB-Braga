<?php
session_start();

include "../../config/database.php";

if (!isset($_SESSION['user'])) {
    header("location: page/auth/login.php");
}

$cari = $_GET['query'] ?? "";

// Pagination
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
$limit = 10;

// SQL Query
$sql = "SELECT * FROM buku WHERE judul LIKE '%$cari%' OR penulis LIKE '%$cari%' OR penerbit LIKE '%$cari%' OR penulis LIKE '%$cari%' OR stok LIKE '%$cari%' LIMIT $offset, $limit";
$hasil = $db->query($sql);

// Total rows for pagination
$total_results = $db->query("SELECT COUNT(*) as total FROM buku")->fetch_assoc()['total'];

include "../../layout/header.php";
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

                    <a class="nav-link" href="">
                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></i></div>
                        Buku
                    </a>
                    <div class="sb-sidenav-menu-heading">Setings</div>
                    <a class="nav-link" href="page/auth/Exit.php">
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
                <div class="card p-3">
                    <form action="" method="GET" class="mb-3 d-flex">
                        <input type="text" name="query" class="form-control w-25" placeholder="Search...">
                        <button type="submit" class="btn btn-primary">Search</button>

                        <div class="container">
                            <a href="tambah.php" class="btn btn-primary ms-auto">Tambah</a>
                        </div>
                    </form>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($hasil as $h) { ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <th scope="row"><?= $h['judul']; ?></th>
                                    <th scope="row"><?= $h['penulis']; ?></th>
                                    <th scope="row"><?= $h['penerbit']; ?></th>
                                    <th scope="row"><?= $h['stok']; ?></th>
                                    <th scope="row"><?= $h['harga_pokok']; ?></th>
                                    <th scope="row" class="text-center">
                                        <a href="update.php?id=<?= $h['id_buku']; ?>" style="width: 100px;" class="btn btn-primary">edit</a>
                                        <a href="hapus.php?id=<?= $h['id_buku']; ?>" style="width: 100px;" class="btn btn-danger">hapus</a>
                                    </th>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="container">
                        <?php if ($offset > 0) : ?>
                            <a href="?offset=<?= max(0, $offset - $limit); ?>" class="btn btn-primary">Previous</a>
                        <?php endif; ?>
                        <?php if ($offset + $limit < $total_results) : ?>
                            <a href="?offset=<?= min($offset + $limit, $total_results); ?>" class="btn btn-primary">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include "../../layout/footer.php"; ?>