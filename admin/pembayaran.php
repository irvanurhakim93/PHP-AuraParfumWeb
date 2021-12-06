<h2>Data Pembelian</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Konsumen</th>
			<th>Bank</th>
			<th>Jumlah</th>
			<th>Tanggal</th>
			<th>Bukti</th>		
		</tr> 
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil= $koneksi->query("SELECT * FROM pembayaran"); ?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td><?php echo $pecah['bank']; ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td><?php echo $pecah['tanggal']; ?></td>
			<td>
				<img src="../img/<?php echo $pecah['gambar']; ?>" width="100"></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>

<form method="post">
	<div class="form-group">
		<label>No Resi</label>
		<input type="text" class="form-control" name="resi">
</div>
	<div class="form-group"></div>
<div class="form-group">
	<label>Status</label>
	<select class="form-control" name="status">
		<option value="lunas">Lunas</option>
		<option value="barang dikirim">Barang Dikirim</option>
		<option value="batal">Batal</option>
	</select>
	<br>
	<button class="btn btn-success" name="proses">Proses</button>
</form>

<?php
if (isset($_POST["proses"]))
{

	$resi = $_POST["resi"];
	$status = $_POST["status"];
	$koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi', status_pembelian='$status' WHERE id_pembelian='$id_pembelian'");
	echo"<script>alert('data pembelian sudah update');</script>";
	echo"<script>location='index.php?halaman=pembelian;</script>";
}