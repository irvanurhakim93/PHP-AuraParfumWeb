<?php
session_start();


$koneksi = new mysqli("localhost","root","","auraparfum");

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Keranjang kosong,silakan belanja terlebih dahulu');</script>";
	echo "<script>location='index.php';</script>";
	unset($_SESSION["keranjang"]);
}

?>

<html>
<head>
	<title>Aura Parfum - Keranjang Belanja</title>
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
	<h1>Keranjang Belanja</h1>
	<hr>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Produk</th>
				<th>Foto</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Total</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $nomor=1; ?>
			<?php foreach ($_SESSION["keranjang"] as $id_parfum => $jumlah): ?>
			<!-- menampilkan produk yang telah dibeli berdasarkan id_parfum-->
			<?php
			$ambil = $koneksi->query("SELECT * FROM parfum WHERE id_parfum='$id_parfum'");
			$pecah = $ambil->fetch_assoc();
			$total = $pecah["harga"]*$jumlah;
			?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah["nama_parfum"]; ?></td>
				<td><img src="img/<?php echo $pecah["gambar"]; ?>" alt="" width="100""></td>
				<td>Rp. <?php echo number_format($pecah["harga"]); ?></td>
				<td><?php echo $jumlah; ?></td>
				<td>Rp. <?php echo number_format($total); ?></td>
				<td>
					<a href="hapuskeranjang.php?id=<?php echo $id_parfum ?>" class="btn btn-danger btn-xs">Hapus</a>
				</td>
			</tr>
			<?php $nomor++; ?> 
			<?php endforeach ?>
		</tbody>
	</table>
	
		<a href="index.php" class="btn btn-default">Belanja lagi</a>
		<a href="checkout.php" class="btn btn-success">Check out</a>
			</div>
</section>


</body>
</html>