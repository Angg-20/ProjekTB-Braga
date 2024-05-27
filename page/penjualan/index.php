<?php
session_start();

include "../../config/database.php";

if (!isset($_SESSION['user'])) {
    header("location: ../auth/login.php");
}

$sql = "SELECT * FROM buku";
$hasil = $db->query($sql);

?>




<?php

include "../../layout/header.php";

?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
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
                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></i></div>
                        penjualan
                    </a>
                    <div class="sb-sidenav-menu-heading">Setings</div>
                    <a class="nav-link" href="/page/auth/Exit.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-door"></i></div>
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
                    <h5>Transaksi</h5>
                    <div class="row">
                        <div class="col">
                            <div class="card p-3">
                                <form action="" method="">
                                    <div class="row">
                                        <div class="col-auto mt-2">
                                            <label for="tanggal">Tanggal </label>
                                        </div>
                                        <div class="col-2">
                                            <input type="date" id="date" class="form-control" value="<?= date("Y-m-d"); ?>" readonly>
                                        </div>
                                        <div class="col-auto mt-2">
                                            <label for="Total">Total </label>
                                        </div>
                                        <div class="col">
                                            <input type="number" id="Total" class="form-control" readonly>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table mt-4">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Penerbit</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">jumlah</th>
                                            <th scope="col">Diskon</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="number" id="kode" name="kode" class="form-control"></td>
                                            <td><input type="text" id="judul" name="judul" class="form-control" readonly></td>
                                            <td><input type="text" id="penerbit" name="penerbit" class="form-control" readonly></td>
                                            <td><input type="number" id="harga" name="harga" class="form-control" readonly></td>
                                            <td><input type="number" id="jumlah" name="jumlah" class="form-control" ></td>
                                            <td><input type="number" id="diskon" name="diskon" class="form-control" readonly></td>
                                            <td><input type="number" id="total" name="total" class="form-control" readonly></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    let data_buku = <?php echo json_encode($buku); ?>

    document.getElementById("kode").onkeyup = function() {
        document.getElementById("judul").value = data_buku[this.value].judul;
        document.getElementById("penerbit").value = data_buku[this.value].penerbit;
        document.getElementById("harga").value = data_buku[this.value].harga_jual;
        document.getElementById("diskon").value = data_buku[this.value].diskon;
    }
    
    document.getElementById("jumlah").onkeyup = function() {
        document.getElementById("total").value = document.getElementById("harga").value * this.value - document.getElementById("diskon").value ;
    }
</script>

<?php include "../../layout/footer.php"; ?>