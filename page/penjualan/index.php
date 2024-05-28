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
                            <form id="book-form" action="" method="post">
                                <div class="table mt-4">
                                    <div class="card p-3">
                                        <div class="row">
                                            <div class="col-auto mt-2">
                                                <label for="tanggal">Tanggal </label>
                                            </div>
                                            <div class="col-2">
                                                <input type="date" id="date" class="form-control" value="<?= date("Y-m-d"); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table mt-4">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Kode</th>
                                                    <th scope="col">Judul</th>
                                                    <th scope="col">Penerbit</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Diskon</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="book-rows">
                                                <tr class="book-row">
                                                    <td><input type="number" name="kode" class="form-control kode"></td>
                                                    <td><input type="text" name="judul" class="form-control judul" readonly></td>
                                                    <td><input type="text" name="penerbit" class="form-control penerbit" readonly></td>
                                                    <td><input type="number" name="harga" class="form-control harga" readonly></td>
                                                    <td><input type="number" name="jumlah" class="form-control jumlah" value="1"></td>
                                                    <td><input type="number" name="diskon" class="form-control diskon" readonly></td>
                                                    <td><input type="number" name="subtotal" class="form-control subtotal" readonly></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" class="text-right">SubTotal</td>
                                                    <td><input type="number" id="grand-total" class="form-control" readonly></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="button" id="tambah">Tambah</button>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    let data_buku = <?php echo json_encode($buku); ?>;

    function addEventListeners(row) {
        row.querySelector(".kode").addEventListener("input", function() {
            let kode = this.value;
            if (data_buku[kode]) {
                row.querySelector(".judul").value = data_buku[kode].judul;
                row.querySelector(".penerbit").value = data_buku[kode].penerbit;
                row.querySelector(".harga").value = data_buku[kode].harga_jual;
                row.querySelector(".diskon").value = data_buku[kode].diskon;
            } else {
                row.querySelector(".judul").value = "";
                row.querySelector(".penerbit").value = "";
                row.querySelector(".harga").value = "";
                row.querySelector(".diskon").value = "";
            }
            updateTotal(row);
        });

        row.querySelector(".jumlah").addEventListener("input", function() {
            updateTotal(row);
        });
    }

    document.querySelectorAll(".book-row").forEach(row => addEventListeners(row));

    document.getElementById("tambah").addEventListener("click", function() {
        let newRow = document.querySelector(".book-row").cloneNode(true);
        newRow.querySelectorAll("input").forEach(function(input) {
            input.value = "";
        });
        document.getElementById("book-rows").appendChild(newRow);
        addEventListeners(newRow);
    });

    function updateTotal(row) {
        let harga = parseFloat(row.querySelector(".harga").value) || 0;
        let jumlah = parseInt(row.querySelector(".jumlah").value ) || 1;
        let diskon = parseFloat(row.querySelector(".diskon").value) || 0;
        let subtotal = (harga * jumlah) - diskon;
        row.querySelector(".subtotal").value = subtotal.toFixed();
        updateGrandTotal();
    }

    function updateGrandTotal() {
        let totalElements = document.querySelectorAll('.subtotal');
        let grandTotal = 0;
        totalElements.forEach(function(element) {
            grandTotal += parseFloat(element.value) || 0;
        });
        document.getElementById("grand-total").value = grandTotal.toFixed();
    }
</script>

<?php include "../../layout/footer.php"; ?>