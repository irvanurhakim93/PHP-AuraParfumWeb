
<h2>Data Produk</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Parfum</th>
			<th>Harga</th>
			<th>Foto</th>
			<th>Aksi</th>
		</tr> 
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM parfum"); ?>
		<?php while($pecah = $ambil->fetch_assoc()) {?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_parfum']; ?></td>
			<td><?php echo $pecah['harga']; ?></td>
			<td>
				<img src="../img/<?php echo $pecah['gambar']; ?>" width="100"></td>
			<td>
				<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_parfum']; ?>" class="btn-danger btn">hapus</a>
				<a href="index.php?halaman=ubahproduk&id<?php echo $pecah['id_parfum']; ?>" class="btn btn-warning">ubah</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>