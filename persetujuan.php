<?php
	
	include "connection.php";
	include 'header_administrator.php';
	session_start();
	if(!isset($_SESSION['username']) ){
	echo"<script>window.alert('maaf anda harus login terlebih dahulu')</script>";
	echo"<script>window.location=('index.php')</script>";
	exit();
}include "connection.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Tambah Barang </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</head>
<body>
		<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				
				<a class="navbar-brand" href="">RANTED TOOLS</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="home.php">Home</a></li>
				<li class="active"><a href="tampil.php">Tambah Barang</a></li>
				<li class="active"><a href="tambahadmin.php">Tambah User</a></li>
				<li class="active"><a href="tambahadmin.php">Lihat Anggota</a></li>
				<li class="active"><a href="tampilpinjamadmin.php">Data Peminjaman</a></li>
				<li class="active"><a href="index2.php">LOGOUT</a></li>
			
			</ul>
		</div>
	</nav>
	

<html lang="en"
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="js/jquery.js"></script>
	<script src="js.bootstrap.js"></script>
</head>
<body>
	<div class="container">
	<div class="jumbotron">
		<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login System</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			background-color:lightblue;
		}
		.row {
			margin:50px auto;
			width:800px;
			text-align:center;
		}
		#footer {
			height:50px;
			line-height:50px;
			background-color: grey;
			bottom:0px;
			width:100%;

		}
	
	
	</style>



	<center><p>DAFTAR USER PINJAM</p>

	</a>
	</center>
	</a><br><br>
	
		<thead>
			<tr>

<div class="container">
	
	<table class="table table-striped">


	<thead>
	<tr>

				<th width="85"><span style="color:teal;font-size:14px;"><b>ID Pinjam</b></span></h2></th>
				<th width="150"><span style="color:teal;font-size:14px;"><b>Tanggal Pinjam</b></span></h2></th>
				<th width="150"><span style="color:teal;font-size:14px;"><b>Tanggal Kembali</b></span></h2></th>
				<th width="100"><span style="color:teal;font-size:14px;"><b>ID User</b></span></h2></th>
				<th width="85"><span style="color:teal;font-size:14px;"><b>ID Barang</b></span></h2></th>
				<th width="50"><span style="color:teal;font-size:14px;"><b>Jumlah</b></span></h2></th>
				<th width="130"><span style="color:teal;font-size:14px;"><b>Tujuan Pinjam</b></span></h2></th>
				<th width="90"><span style="color:teal;font-size:14px;"><b>Status</b></span></h2></th>
				<th width="200"><span style="color:teal;font-size:14px;"><b>Options</b></span></h2></th>
			

			</tr>
		</thead>
		<tbody>
			<?php
				$pinjam = mysqli_query($mysqli,"SELECT * FROM pinjam");

				while ($show = mysqli_fetch_array($pinjam)) {
			?>
		</tr>
	<tr class="info">
				<td><?php echo $show['id_pinjam'];?></td>
				<td><?php echo $show['tanggal_pinjam'];?></td>
				<td><?php echo $show['tanggal_kembali'];?></td>
				<td><?php echo $show['id_user'];?></td>
				<td><?php echo $show['id_barang'];?></td>
				<td><?php echo $show['jumlah_pinjam'];?></td>
				<td><?php echo $show['tujuan_pinjam'];?></td>
				<td><?php echo $show['status'];?></td>
				<td>
					<form action="setuju.php" method="POST">
						<input type="hidden" name="id_pinjam" value="<?= $show['id_pinjam'];?>">
						<input type="hidden" name="id_barang" value="<?= $show['id_barang'];?>">
						<input type="submit" name="setuju" value="setuju" class="btn btn-info">
						<input type="submit" name="tidaksetuju" value="tidak setuju" class="btn btn-danger">
				    </form>

					<!-- <a href="setuju.php?id_barang=<?php echo $show['id_barang'];?>"><button type="button" class="btn btn-info">Setujui <span class="glyphicon glyphicon-ok "></button></a> 

					<a href="preview.php?id_barang=<?php echo $show['id_barang'];?>"><button type="button" class="btn btn-danger">Tidak<span class="glyphicon glyphicon-remove "></button></a> -->
				</td>
				
				


				
				</td>
			</tr>
			<?php
				}
			?>

		</tbody>
	</table>
</div>
</div>
	<div id ="footer">
	Copyright &copy; 2018
	Designed by Ivfa Tut Tazkiyah
</div>
	
	
</body>
</html>








</body>
</html>

