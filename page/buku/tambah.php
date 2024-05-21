<?php
session_start();

include "../../config/database.php";


if (!isset($_SESSION['user'])) {
    header("location: page/auth/login.php");
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $stok = $_POST['stok'];
    $harga_pokok = $_POST['harga_pokok'];
    $harga_jual = $_POST['harga_jual'];
    $diskon = $_POST['diskon'];

    $sql = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, stok, harga_pokok, harga_jual, diskon) 
            VALUES ('$judul', '$penulis', '$penerbit', '$tahun_terbit', '$stok', '$harga_pokok', '$harga_jual', '$diskon')";

    if ($db->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan.";

        header("location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}
?>

<?php
if (!isset($_SESSION['user'])) {
    header("location: page/auth/login.php");
}
?>




<?php

include "../../config/database.php";

$hs = "SELECT * FROM buku limit 10";
$hasil = $db->query($hs);
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
$maju = $offset + 10;
$mundur = $offset - 10;


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

                <div class="card p-5">
                    <h5 class="mb-3 text">Tambah</h5>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="judul" class="form-label">judul</label>
                            <input type="text" class="form-control" id="judul" name="judul">
                        </div>
                        <div class="mb-3">
                            <label for="penulis" class="form-label">penulis</label>
                            <input type="text" class="form-control" id="penulis " name="penulis">
                        </div>
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">penerbit</label>
                            <input type="text" class="form-control" id="penerbit " name="penerbit">
                        </div>
                        <div class="mb-3">
                            <label for="tahun_terbit" class="form-label">Tahun</label>
                            <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit">
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">stok</label>
                            <input type="text" class="form-control" id="stok " name="stok">
                        </div>
                        <div class="mb-3">
                            <label for="harga_pokok" class="form-label">harga_pokok</label>
                            <input type="text" class="form-control" id="harga_pokok" name="harga_pokok">
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">harga_jual</label>
                            <input type="text" class="form-control" id="harga_jual" name="harga_jual">
                        </div>
                        <div class="mb-3">
                            <label for="diskon" class="form-label">diskon</label>
                            <input type="text" class="form-control" id="diskon" name="diskon">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </main>

    </div>
</div>

<?php include "../../layout/footer.php"; ?>