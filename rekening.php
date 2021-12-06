<?php
session_start();
$koneksi = new mysqli("localhost","root","","auraparfum");

if(!isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Checkout gagal');</script>";
	echo "<script>location='index.php';</script>";
}
// jika session keranjang kosong,maka akan dialihkan ke beranda untuk belanja dulu

?>
<html>
<head>
	<title>Aura Parfum - Riwayat</title>
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
	<h1>Berikut riwayat transaksi anda</h1>
			<?php $totalbelanja = 0; 
			$id_pembeli=$_GET['id'];
			$id_parfum=$_GET['parfum'];
//			 foreach ($_SESSION["keranjang"] as $id_parfum => $jumlah): 
			?>
			<!-- menampilkan produk yang telah dibeli berdasarkan id_parfum-->
			<?php
			$ambil = $koneksi->query("SELECT * FROM parfum join pembelian on parfum.id_parfum=pembelian.id_parfum WHERE parfum.id_parfum='$id_parfum'");
			$pecah = $ambil->fetch_assoc();
/*			$total = $pecah["harga"]*$jumlah;
			?>
			<?php $totalbelanja+=$total; ?>
			<?php endforeach */?>
		
			<!-- menampilkan produk yang telah dibeli berdasarkan id_parfum-->
			<?php
//			$ambil = $koneksi->query("SELECT * FROM parfum WHERE id_parfum='$id_parfum'");
			$ambil = $koneksi->query("SELECT * FROM parfum join pembelian on parfum.id_parfum=pembelian.id_parfum join konsumen on id_pembelian=id_pembeli join ongkir on pembelian.id_ongkir=ongkir.id_ongkir WHERE parfum.id_parfum='$id_parfum' and konsumen.id_pembeli='$id_pembeli' ");
			$pecah = $ambil->fetch_assoc();
//			$total = $pecah["harga"]*$jumlah;
//			var_dump($id_pembeli)
			?>
			<table class="table table-bordered">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Nama :</th> 
				<th>Jenis Kelamin</th>
				<th>No Hp</th>
				<th>Alamat</th>
				<th>Produk yang dibeli</th>  
				<th>Jumlah</th>  
				<th>Ongkos kirim</th>
				<th>Total</th> 
			</tr>
		</thead>
		<tbody>
			<td><?php echo date("d-m-Y"); ?></td>
			<td><?php echo $pecah["nama_pembeli"]; ?></td>
			<td><?php echo $pecah["jenis_kelamin"]; ?></td>
			<td><?php echo $pecah["no_hp"]; ?></td>
			<td><?php echo $pecah["alamat"]; ?></td>
			<td><?php echo $pecah["nama_parfum"]; ?></td>
			<td><?php echo $pecah["jumlah"]; ?></td>
			<td><?php echo $pecah["tarif"]; ?></td>
			<td> Rp. <?php echo number_format($pecah['total_pembelian']); ?></td>
		</tbody>
	</table>
				Produk yang anda pesan telah kami kirimkan,Terima kasih telah anda telah mempercayai kami dan bertransaksi di <strong>Aura Parfum</strong>

			</p>
		</div>
	</div>
</div>
				<center>
				<button class="btn btn-primary hidden-print" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>Cetak Resi</button>
				<a href="index.php" class="btn btn-success">Selesai</a>

				<script>
					function myFunction() {
						window.print();
					}
				</script>
				</center>
		<?php   
			
								
		?>
			
	</div>
</section>

</body>
<html>