<?php
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","auraparfum");
?>

<html>
<head>
	<title>Daftar</title>
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

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 clas  s="panel-title">Form Registrasi Pelanggan</h3>
						</div>
						<div class="panel-body">
							<form method="post" class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-md-3">Nama</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="nama_pelanggan" required>
					 </div>
					</div>
					<div class="form-group">
									<label class="control-label col-md-3">Email</label>
									<div class="col-md-7">
										<input type="email" class="form-control" name="email" required=>
					 </div>
					</div>
<div class="form-group">
									<label class="control-label col-md-3">Password</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="password" required>
					 </div>
					</div>					
					<div class="form-group">
									<label class="control-label col-md-3">Alamat</label>
									<div class="col-md-7">
										<textarea class="form-control" name="alamat" required></textarea>
					 </div>
					</div>
					<div class="form-group">
									<label class="control-label col-md-3">No HP</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="nohp" required>
					 </div>
					</div>
					<div class="form-group"> 
						<div class="col-md-7 col-md-offset-3">
							<button class="btn btn-primary" name="daftar" >Daftar</button>
					 </div>
							</form>
							<?php
							//jika ada tombol daftar ditekan
							if (isset($_POST["daftar"])) 
							{
								//mengambil isian nama,email,password,alamat,telepon
								$nama = $_POST["nama_pelanggan"];
								$email = $_POST["email"];
								$password = $_POST["password"];
								$alamat = $_POST["alamat"];
								$nohp = $_POST["nohp"];

								//cek validasi apakah email sudah digunakan atau belum
								$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email='$email'");
								$yangcocok = $ambil->num_rows; 
								if(yangcocok==1) 
								{
									echo"<script>alert('Pendaftaran gagal,email sudah digunakan');</script>";
									echo "<script>location='daftar.php';</script>";
								}
								else
								{
									//query insert ke tabel pelanggan
									$koneksi->query("INSERT INTO pelanggan (email,password,nama_pelanggan,no_hp,alamat) VALUES('$email','$password','$nama_pelanggan','$nohp','$alamat') ");

									echo"<script>alert('Pendaftaran berhasil,silakan login');</script>";
									echo "<script>location='login.php';</script>";
								}
								//query
							}
							?>  
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>