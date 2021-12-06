<?php
session_start();
$koneksi = new mysqli("localhost","root","","auraparfum");
?>
<html>
<head>
	<title>Login Pelanggan</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<nav class="navbar navbar-default">
	<div class="container">
	
		<ul class="nav navbar-nav">
		<li><a href="index.php">Beranda</a></li>
		<li><a href="keranjang.php">Keranjang</a></li>
		<!-- jika sudah ada session login -->
		<?php if(isset($_SESSION["pelanggan"])): ?>
			<li><a href="logout.php">Log out</a></li>
		<!-- jika belum ada session login -->
		<?php else: ?>
			<li><a href="login.php">Login</a></li>
		<?php endif ?>
		
		<li><a href="checkout.php">Checkout</a></li>
	</ul>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Login Pelanggan</h3>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email">
						</div>
					<div class="form-group">
					 <label>Password</label>
					 <input type="password" class="form-control" name="password">
					</div>
					<button class="btn btn-primary" name="login">Login</button>
					<br>
					<br>
					<p>Belum punya akun ? silakan <a href="daftar.php">Registrasi</a> terlebih dahulu
				</form>
			</div>
		</div>
	</div>
</div>

<?php
//jika ada tombol login ditekan 
if (isset($_POST["login"]))
{
		$email = $_POST["email"];
		$password = $_POST["password"];
	// lakukan query check akun di tabel pelanggan di db
	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email='$email' AND password='$password'");
	
	//menghitung akun yang terambil
	$akunyangcocok = $ambil->num_rows;
	
	//jika ada akun yang cocok maka di loginkan
	if ($akunyangcocok==1)
	{
		//anda sudah login
		// mendapatkan akun dalam bentuk array
		$akun = $ambil->fetch_assoc();
		//simpan di session pelanggan
		$_SESSION["pelanggan"] = $akun;
		echo "<script>alert('anda sukses login');</script>";
		echo "<script>location='index.php';</script>";
	}
	else
	{
		//anda gagal login
		echo "<script>alert('anda gagal login,periksa kembali akun anda');</script>";
		echo "<script>location='login.php';</script>";
	}
}
?>
<body>
</html>