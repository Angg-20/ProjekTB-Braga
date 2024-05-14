<?php

    include '../../config/database.php';

    $angga = 'DELETE FROM buku where id_buku=' .$_GET['id'];

    $db->query($angga);
    header('location: index.php')
?>