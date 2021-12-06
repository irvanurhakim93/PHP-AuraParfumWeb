<?php 
session_start();
$id_parfum=$_GET["id"];
unset($_SESSION["keranjang"][$id_parfum]);

echo "<script>alert('produk telah di hapus dari keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>