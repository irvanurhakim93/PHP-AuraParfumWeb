<h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM temp_pembelian JOIN pembelian");
$detail = $ambil->fetch_assoc();
?>
<pre><?php print_r($detail); ?></pre>

<strong><?php echo $detail['nama']; ?></strong> <br>
<p>
	<?php echo $detail['no_hp']; ?> <br>
	<?php echo $detail['pesan']; ?>
</p>

<p>
	Tanggal : <?php echo $detail['tanggal']; ?> <br>
	Total belanja : <?php echo $detail['totalbeli']; ?>
</p>

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
		<?php $ambil = $koneksi->query("SELECT * FROM pembelian_parfum") ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_parfum']; ?></td>
			<td><?php echo $pecah['harga']; ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>
				<?php echo $pecah['harga']*$pecah['jumlah']; ?>
			</td>
		</tr>
		<?php $nomor++; ?> 
		<?php } ?>
	</tbody>
</table>