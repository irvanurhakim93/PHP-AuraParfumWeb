<?php
session_start();
$koneksi = new mysqli("localhost","root","","auraparfum");
if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('item kosong,silakan berbelanja dahulu');</script>";
	echo "<script>location='index.php';</script>";
}
?>
<html>
<head>
	<title>Checkout</title>
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
	<h1>Berikut daftar belanjaan anda</h1>
	<hr>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Produk</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<?php $nomor=1; ?>
			<?php $totalbelanja = 0; ?>
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
				<td>Rp. <?php echo number_format($pecah["harga"]); ?></td>
				<td><?php echo $jumlah; ?></td>
				<td>Rp. <?php echo number_format($total); ?></td>
			</tr>
			<?php $nomor++; ?>
			<?php $totalbelanja+=$total; ?>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			<tr>
			<th colspan="4">Total Belanja</th>
			<th>Rp. <?php echo number_format($totalbelanja) ?></th>
			</tr>
	</table>
		<form method="post">			
	
						<div class="row">
	    				<div class="col-md-7">
	      					<label for="ongkir"></label>
	      					<select class="form-control" name="ongkir">
	                <option value="">Pilih Ongkir</option>
	                <?php
	                $ambil = $koneksi->query("SELECT * FROM ongkir");
	                while ($ongkir = $ambil->fetch_assoc()){
	                ?>
	                <option value="<?php echo $ongkir['id_ongkir'];?>">
	                    	<?php echo $ongkir['jenis_jasa']; ?> -
	                    	<?php echo number_format($ongkir['tarif']) ?>
	               	</option>
	               <?php } ?>
	                </select>
	      				</div>
	      			</div>
	      			<br>
				<button class="btn btn-success" name="checkout" type="submit">Check Out & lanjutkan</button>
		</form>
		<?php   
		//if (isset($_SESSION["pelanggan"])):
		// {
			if(isset($_POST["checkout"]))
			{
//				exit(var_dump($id_parfum));
				$id_ongkir = $_POST["ongkir"];
				$tanggal = date("Y-m-d");

				$ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
				$arrayongkir = $ambil->fetch_assoc();
				$tarif = $arrayongkir['tarif'];

				$total_pembelian = $totalbelanja + $tarif;

				//menyimpan data ke tabel pembelian
				$koneksi->query("INSERT INTO pembelian (id_ongkir,id_parfum,tanggal,total_pembelian,jumlah) VALUES ('$id_ongkir','$id_parfum','$tanggal','$total_pembelian','$jumlah')");
//
				//mendapatkan id_pembelian yang baru terjadi
				$id_pembelian_barusan = $koneksi->insert_id;

//				exit(var_dump($id_pembelian_barusan));
/*				foreach ($_SESSION["keranjang"] as $id_parfum => $jumlah)
			{
				$koneksi->query("INSERT INTO pembelian_produk (id_pembeli,id_parfum,jumlah) VALUES ('$id_pembelian_barusan','$id_parfum','$jumlah') ");						
			}
*/			echo"<script>alert('Pembelian sukses,silakan input data diri anda');</script>";
			echo"<script>location='input.php?id=$id_pembelian_barusan&parfum=$id_parfum';</script>";
			
				
		}
			
		?>

		
	</div>
</section>


</body>
<html>