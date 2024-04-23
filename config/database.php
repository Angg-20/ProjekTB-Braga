<?php

$db = new mysqli("localhost", "root", "", "tb");

if($db -> connect_error){
    die("Connection Failed".$db->connect_error);
}
