	<?php
	session_start();
	//koneksi ke database
	$koneksi = new mysqli("localhost","root","","auraparfum");
	?>

	<html>
	<head>
		<title>Aura Parfum - Input</title>
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

		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 clas s="panel-title">Input data diri anda</h3>
							</div>
							<div class="panel-body">
								<form method="post" class="form-horizontal">
									<div class="form-group">
										<label class="control-label col-md-3">Nama</label>
										<div class="col-md-7">
											<input type="text" class="form-control" name="nama_pembeli" required>
						 </div>
						</div>

						<div class="form-group">
	    				<div class="col-md-7 col-md-offset-3">
	      					<label for="jenis_kelamin"></label>
	      					<select class="form-control" name="jenis_kelamin">
	                <option value="">Jenis Kelamin</option>
	               	<option>Laki Laki</option>
	               	<option>Perempuan</option>
	                </select>
	      				</div>
	      			</div>

	      			<div class="form-group">
										<label class="control-label col-md-3">No HP</label>
										<div class="col-md-7">
											<input type="text" class="form-control" name="no_hp" required>
					</div>
					 </div>

					 <div class="form-group">
									<label class="control-label col-md-3">Email</label>
									<div class="col-md-7">
										<input type="email" class="form-control" name="email" required=>
					 </div>
					</div>


						<div class="form-group">
										<label class="control-label col-md-3">Alamat</label>
										<div class="col-md-7">
											<textarea class="form-control" name="alamat" required></textarea>
						 </div>
						</div>

							<div class="form-group"> 
							<div class="col-md-7 col-md-offset-5">
								<button class="btn btn-success" name="input" type="submit">Input</button>
						 </div>
								</form>
								
								<?php
								//jika ada tombol input ditekan	
								if (isset($_POST["input"]))
								
								{

								$id_pembeli=$_GET['id'];
								$id_parfum=$_GET['parfum'];

								//mengambil isian nama,jenis kelamin,alamat,dan tipe ongkir
								$nama_pembeli = $_POST["nama_pembeli"];
								$jenis_kelamin = $_POST["jenis_kelamin"];
								$alamat = $_POST["alamat"];
								$no_hp = $_POST["no_hp"];

//								exit(var_dump($_POST));
								//query insert ke tabel pembeli
								$koneksi->query("INSERT INTO konsumen (id_pembeli,nama_pembeli,jenis_kelamin,alamat,no_hp) VALUES('$id_pembeli','$nama_pembeli','$jenis_kelamin','$alamat','$no_hp') ");
								if($koneksi){
									echo"<script>alert('input data diri sukses');</script>";
									echo"<script>location='pembayaran.php?id=$id_pembeli&parfum=$id_parfum';</script>";									
								}else{									
									echo"<script>alert('Terjadi Kesalahan, harap input lagi');</script>";
									echo"<script>location='input.php?id=$id_pembeli&parfum=$id_parfum';</script>";									
								}
								}
									
								?>  

								
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>