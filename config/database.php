<?php

$db = new mysqli("localhost", "root", "", "tb");

$query = "SELECT * FROM buku";
$result = $db->query($query);

$buku = [];

while ($item = $result->fetch_assoc()) {
    $buku[] = $item;
};
