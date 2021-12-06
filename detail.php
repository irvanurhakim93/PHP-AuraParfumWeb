<?php
session_start();
$koneksi = new mysqli("localhost","root","","auraparfum");
?>
<?php 
//mendapatkan id_parfum dari url
$id_parfum = $_GET["id"];

//query ambil data
$ambil = $koneksi->query("SELECT * FROM parfum WHERE id_parfum='$id_parfum'");
$detail = $ambil->fetch_assoc();
?>
<html>
<head>
	<title>Detail Produk</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<nav class="navbar navbar-default">
	<div class="container">
	
		<ul class="nav navbar-nav">
		<li><a href="index.php">Beranda</a></li>
		<li><a href="keranjang.php">Keranjang</a></li>
		<li><a href="checkout.php">Checkout</a></li>
	</ul>
	</div>
</nav>
<section class="konten">
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<img src="img/<?php echo $detail["gambar"]; ?>" alt="" class="img-responsive">
		</div>
		<div class="col-md-6">
			<h2><?php echo $detail["nama_parfum"] ?></h2>
			<h4>Rp. <?php echo number_format($detail["harga"]) ?></h4>
		<form method="post">
			<div class="form-group">
				<div class="input-group">
				<input type="number" min="1" class="form-control" name="jumlah">
				<div class="input-group-btn">
					<button class="btn btn-success" name="beli">Beli</button>
				</div>
			</div>
		</div>
		</form>

		<?php
		if (isset($_POST["beli"]))
		{
			$jumlah = $_POST["jumlah"];

			$_SESSION["keranjang"][$id_parfum] = $jumlah;

			echo"<script>alert('Produk telah masuk ke keranjang');</script>";
			echo"<script>location='keranjang.php';</script>";
		}
		?>
		</div>
	</div>
</div>
</section>


</body>
</html>