<?php
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","auraparfum");
?>
<html>
<head>
	<title>Aura Parfum - Beranda</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
	<div class="container">
	
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
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
	<h1>Daftar Produk</h1>
	
	<div class="row">
	
	<?php $ambil = $koneksi->query("SELECT * FROM parfum");?>
	<?php while($perproduk = $ambil->fetch_assoc()){ ?>	
		<div class="col-md-3">
			<div class="thumbnail">
			<img src="img/<?php echo $perproduk['gambar']; ?>" class="image-responsive">
			<div class="caption">
				<h3><?php echo $perproduk['nama_parfum']; ?></h3>
				<h5><?php echo $perproduk['harga'];?></h5>
				<a href="beli.php?id=<?php echo $perproduk['id_parfum']; ?>" class="btn btn-success">Beli</a>
			</div>
		</div>
	</form>
	<?php
		if (isset($_POST["beli"]))
		{
			$jumlah = $_POST["jumlah"];

			$_SESSION["keranjang"][$id_parfum] = $jumlah;
		}
		?>
	</div>
	<?php } ?>
</div>	
	</section>
</body>
</html>