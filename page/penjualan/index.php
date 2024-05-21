<?php
session_start();

include "../../config/database.php";

if (!isset($_SESSION['user'])) {
    header("location: page/auth/login.php");
}

$term = $_GET['term'];

$sql = "SELECT judul, harga_jual FROM buku WHERE judul LIKE '%$term%'";
$result = $db->query($sql);

$books = array();

while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

?>



<?php

include "../../config/database.php";

if (!isset($_SESSION['user'])) {
    header("location: page/auth/login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_penjualan = $_POST['id_penjualan'];
    $bookTitle = $_POST['bookTitle'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];

    $total_pembelian = $jumlah * $harga;

    $keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : array();
    $keranjang[] = array(
        'id_penjualan' => $id_penjualan,
        'bookTitle' => $bookTitle,
        'jumlah' => $jumlah,
        'harga' => $harga,
        'total_pembelian' => $total_pembelian
    );

    $_SESSION['keranjang'] = $keranjang;
}


?>


<?php

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
                    <a class="nav-link" href="/">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Pages</div>

                    <a class="nav-link" href="/page/buku/index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></i></div>
                        Buku
                    </a>
                    <a class="nav-link" href="/page/penualan/index.php">
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
                <div class="card p-3">
                    <h5>Penjualan</h5>

                    <!-- Form untuk menambah item ke keranjang -->
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="mt-3" for="id_penjualan">ID Penjualan:</label>
                            <input type="text" name="id_penjualan" value="<?php echo uniqid(); ?>" class="form-control">
                        </div>
                        <div>
                            <label class="mt-3" for="bookTitle">Pilih Buku:</label>
                            <select name="bookTitle" id="bookTitle" class="form-control">
                                <?php foreach ($books as $book) { ?>
                                    <option value="<?= $book['judul']; ?>"><?= $book['judul']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mt-3" for="jumlah">Jumlah:</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" value="1">
                        </div>
                        <div>
                            <label class="mt-3" for="harga">Harga:</label>
                            <input type="number" id="harga" class="form-control" name="harga" readonly value="<?= $book['harga_jual']; ?>">
                        </div>
                        <div>
                            <label class="mt-3" for="total">Total:</label>
                            <input type="number" id="total" class="form-control" name="total" readonly>
                        </div>
                        <div>
                            <label class="mt-3" for="bayar">Bayar:</label>
                            <input type="number" id="bayar" class="form-control" name="bayar">
                        </div>
                        <div>
                            <label class="mt-3" for="kembalian">Kembalian:</label>
                            <input type="number" id="kembalian" class="form-control" name="kembalian" readonly>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary mt-3" onclick="hitungTotal()">Hitung Total</button>
                            <button type="submit" class="btn btn-primary mt-3">Tambahkan ke Keranjang</button>
                        </div>
                    </form>

                    </form>
                </div>
            </div>
        </main>
    </div>

</div>
<?php include "../../layout/footer.php"; ?>