<?php 
session_start();
$id_parfum=$_GET["id"];
unset($_SESSION["keranjang"][$id_parfum]);

echo "<script>alert('Checkout telah dibatalkan');</script>";
echo "<script>location='keranjang.php';</script>";
?>