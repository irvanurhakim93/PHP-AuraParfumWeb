<h2>Ubah Produk</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM parfum WHERE id_parfum='$_GET[id]'");
$pecah=$ambil->fetch_assoc();

echo "<pre>";
print_r($pecah);
echo"</pre>";
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Parfum</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_parfum']; ?>">
	</div>
	<div class="form-group">
		<label>Harga Rp</label>
		<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga']; ?>">
	</div>
	<div class="form-group">
	<img src="../img/<?php echo $pecah['gambar'] ?>" width="200">
	</div>
	<div class="form-group">
	<label>Deskripsi</label>
	<textarea name="deskripsi" class="form-control" rows="10">
	<?php echo $pecah['keterangan']; ?>
	</textarea>
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</div>	
</form>

<?php 
if (isset($_POST['ubah'])) {
	$namagambar=$gambar['name'];
	$lokasigambar=$gambar=['tmp_nama'];
	//jika gambar dirubah
	if(!empty($lokasigambar)) 
	{
		move_uploaded_file($lokasigambar, "../img/$namagambar");
		
		$koneksi->query("UPDATE parfum SET nama_parfum='$_POST[nama]',
		harga='$_POST[harga]',
		gambar='$namagambar',
		keterangan='$_POST[keterangan]'
		WHERE id_parfum='$_GET[id]'");
	}
	else
	{
		 $koneksi->query("UPDATE parfum SET nama_parfum='$_POST[nama]',
		harga='$_POST[harga]',
		keterangan='$_POST[keterangan]'
		WHERE id_parfum='$_GET[id]'");
	}
	echo "<script>alert('data parfum telah di ubah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>"; 
} 