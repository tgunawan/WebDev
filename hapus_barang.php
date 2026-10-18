<?php
require "koneksi.php";

$id = $_GET["id"];

$query = "DELETE FROM barang WHERE id_barang = $id";
mysqli_query($conn, $query);

header("Location: barang.php");
exit;
?>