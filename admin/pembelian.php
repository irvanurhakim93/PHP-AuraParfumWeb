<h2>Data Pembelian</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Konsumen</th>
			<th>Tanggal</th>
			<th>Status</th>
			<th>Total</th>
			<th>aksi</th>		
		</tr> 
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil= $koneksi->query("SELECT * FROM konsumen JOIN pembelian"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_pembeli']; ?></td>
			<td><?php echo $pecah['tanggal']; ?></td>
			<td><?php echo $pecah['status']; ?></td>
			<td><?php echo $pecah['total_pembelian']; ?></td>
			<td>
				<a href="index.php?halaman=detail&id=<?php  echo $pecah['idbeli']; ?>" class="btn btn-info">detail</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>