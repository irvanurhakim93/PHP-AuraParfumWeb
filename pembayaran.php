<?php
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","auraparfum");
if(!isset($_SESSION["keranjang"]))
?>
<html>
<head>
	<title>Aura Parfum - Beranda</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<nav class="navbar navbar-default">
	<div class="container">
<div class="navbar-header">
		<a href="index.php" class="navbar-brand">Aura Parfum</a>
	</div>	
		<ul class="nav navbar-nav">
		<li><a href="index.php">Beranda</a></li>
		<li><a href="keranjang.php">Keranjang</a></li>
		<li><a href="checkout.php">Checkout</a></li>
	</ul>
	</div>
</nav>

<section class="konten">
	<div class="container">
		<h2>Konfirmasi Pembayaran</h2>
		<p>Kirim bukti pembayaran anda disini</p>
		
			<?php 
			$id_pembeli=$_GET['id'];
			$id_parfum=$_GET['parfum'];
			$ambil= $koneksi->query("SELECT * FROM pembelian join konsumen on id_pembelian=id_pembeli where id_pembelian='$id_pembeli'");
			$get=$ambil->fetch_assoc();
			$total_pembelian=$get["total_pembelian"]; 
			?>
		<div class="alert alert-info">Total belanja anda  <strong>Rp. <?php echo number_format($total_pembelian); ?></strong>, silakan melakukan pembayaran ke <strong>BANK BRI  435401011865531 AN WAWAN SETIAWAN</strong> dan menkonfirmasi dengan mengisi data berikut 
		</div>

		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Penyetor</label>
				<input type="text" class="form-control" name="nama" value="<?php echo $get['nama_pembeli'];?>" readonly>
			</div>
			<div class="form-group">
				<label>Bank</label>
				<input type="text" class="form-control" name="bank">
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" name="jumlah" min="1">
			</div>
			<div class="form-group">
				<label>Foto bukti</label>
				<input type="file" class="form-control" name="bukti">
				<p class="text-danger">Foto bukti harus format JPG maksimal 2 MB</p>
			</div>
			<button class="btn btn-success" name="kirim" type="submit">Kirim</button>
			</form>
	</div>
	<?php
	if (isset($_POST["kirim"]))
	{
		//upload dulu bukti foto
		$namabukti = $_FILES["bukti"]["name"];
		$lokasibukti = $_FILES["bukti"]["tmp_name"];
		$namafix = date("Y-m-d").$namabukti;
		move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafix");

		$nama = $_POST["nama"];
		$bank = $_POST["bank"];
		$jumlah = $_POST["jumlah"];
		$tanggal = date("Y-m-d");
//exit(var_dump($_POST));
		//simpan pembayaran
		$koneksi->query("INSERT INTO pembayaran(nama,bank,jumlah,tanggal,bukti) VALUES ('$nama','$bank','$jumlah','$tanggal','$namafix') ");

//		exit(var_dump($koneksi));
		if($koneksi){
		echo "<script>alert('Terima kasih telah mengirimkan bukti pembayaran');</script>";
		echo"<script>location='rekening.php?id=$id_pembeli&parfum=$id_parfum';</script>";									
		}else{
		echo "<script>alert('Terjadi Kesalahan');</script>";
		echo"<script>location='pembayaran.php?id=$id_pembeli&parfum=$id_parfum';</script>";									
		}
	}

	?>
</section>

</body>
</html>