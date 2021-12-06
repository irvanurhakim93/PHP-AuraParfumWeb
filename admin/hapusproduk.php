<?php 

$ambil = $koneksi->query("SELECT * FROM parfum WHERE id_parfum='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotoparfum = $pecah['gambar'];
if (file_exists("filename")) 
{
	unlink("filename"); 
}

$koneksi->query("DELETE FROM parfum WHERE id_parfum='$_GET[id]'");

echo "<script>alert('produk terhapus');</script>";
echo "<script>location='index.php?halaman=produk';</script>"; 
?>