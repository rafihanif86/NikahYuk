<?php
session_start();
	error_reporting(0);
	include "connection.php";
	include "header.php";
	include "import_cart.php";
	include "header2.php";
	include "getCus.php";

	$search = "";
	$imageCus = "";
	$namaCus = "";
	$hide_slider = "";
	$alamatCus = "";
	$telpCus = "";
	$emailCus = "";
	$queryCustomer = "SELECT * FROM customer C, login L WHERE c.`id_login_custom` = L.`Id_login` AND L.`Status` LIKE '%customer%' AND C.`Id_Customer` = '$id_cus';";
	$result_Customer=mysql_query($queryCustomer,$conn);
	while ($row_Customer=mysql_fetch_array($result_Customer)){
		$imageCus = $row_Customer['Image_cutomer'];
		$namaCus = $row_Customer['Nama_Customer'];
		$alamatCus = $row_Customer['Alamat_Customer'];
		$telpCus = $row_Customer['Telp_Customer'];
		$emailCus = $row_Customer['Email_customer'];
	}

	$queryPemesanan = "SELECT * FROM pemesanan P, jadwal J, customer C, produk R WHERE P.`Id_Produk` = R.`Id_Produk` AND P.`Id_Customer` = C.`Id_Customer` AND J.`Id_Pemesanan` = P.`Id_Pemesanan` AND C.`Id_Customer` = '$id_cus';";
	$result_Pemesanan=mysql_query($queryPemesanan,$conn);
	$totalCost='';

	// $idProduk = "";
 //    $hargaProduk = "";
 //    $idCustomer = "";

 //    $querySelect = "SELECT * FROM customer WHERE Email_Login = '$_SESSION[Email_Login]'";
 //    $result=mysql_query($querySelect);
 //    while ($row=mysql_fetch_array($result)){
 //        $idCustomer = $row['Id_Customer'];
 //    }

 //    $queryInsert = "INSERT INTO pemesenan SET Harga_Produk='$hargaProduk', Status_Pemesanan='Belum Dibayar', Id_Produk='$idProduk', Id_Customer='$idCustomer'";
 //    $resultInsert=mysql_query($queryInsert);

	$search = "";
	$hide_slider = "";
	$queryProduct = "SELECT PM.Id_Pemesanan, PM.Id_Customer, PM.Harga_Produk, CU.Alamat_Customer, CU.Nama_Customer, CU.Telp_Customer FROM Pemesanan AS PM INNER JOIN Customer AS CU ON PM.Id_Customer = CU.Id_Customer ";
	if(isset($_GET['idProduk'])){
		$idProduk=$_GET['idProduk'];
		$result=mysql_query("SELECT * FROM produk;");
		while($row=mysql_fetch_array(result)){
			$idProduk=$row["idProduk"];
		}
		echo location.replace(pembayaran.php);
	}
	if(isset($_POST["search"])){
		$cari=$_POST["text_search"];
		$queryProduct="SELECT * FROM View_produk WHERE `Nama_Produk` LIKE '%$cari%' OR `Harga_Produk` LIKE '%$cari%' OR `Category_Name` LIKE '%$cari%' OR `Nama_Vendor` LIKE '%$cari%'";
		$search="Search For ".$cari;
		$category_selected = 0;
		$hide_slider = "hidden='true'";
	}

	//pagging
	$per_hal=6;
	$jumlah_record=mysql_query($queryProduct);
	$jum=mysql_result($jumlah_record, 0);
	$halaman=ceil($jum / $per_hal);
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$start = ($page - 1) * $per_hal;
	$queryProduct = $queryProduct." limit $start, $per_hal ";

	// $result_product=mysql_query("SELECT * FROM produk P, kategori K WHERE p.Category = k.Id_category AND p.Category = '$category_selected'; ");

	$result_product=mysql_query($queryProduct);


	function getRating($rate){
		if($rate == '1'){
			echo '<i></i>';
		}else if($rate == '2'){
			echo '<i></i><i></i>';
		}else if($rate == '3'){
			echo '<i></i><i></i><i></i>';
		}else if($rate == '4'){
			echo '<i></i><i></i><i></i><i></i>';
		}else if($rate == '5'){
			echo '<i></i><i></i><i></i><i></i><i></i>';
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Checkout</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Little Closet template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/checkout.css">
<link rel="stylesheet" type="text/css" href="styles/checkout_responsive.css">
</head>
<body>



		<!-- Home -->

		<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title">Checkout</div>
					<div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
						<ul class="d-flex flex-row align-items-start justify-content-start text-center">
							<li><a href="#">Home</a></li>
							<li>Checkout</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Checkout -->

		<div class="checkout">
			<div class="container">
				<div class="row">
					
					<!-- Billing -->
					<div class="col-lg-6">
						<div class="billing">
							<div class="checkout_title">Form</div>
							<div class="checkout_form_container">
								<form action="#" id="checkout_form" class="checkout_form">
									<div class="row">
										<div class="col-lg-6">
											<?php
		
		while ($row_product=mysql_fetch_array($result_product)){				
		
		?>
											<!-- Name -->
											<div class="Id_Pemesanan">Id Pemesanan <li><?php echo $row_product['Id_Pemesanan']; ?></li></a></div>
											<div class="product_name">Id Customer <li><?php echo $row_product['Id_Customer']; ?></li></a></div>
											<div class="product_name">Alamat Customer <li><?php echo $row_product['Alamat_Customer']; ?></li></a></div>
											<div class="product_name">Telp Customer <li><?php echo $row_product['Telp_Customer']; ?></li></a></div>
											<div class="Id_Pemesanan">Id Produk <li><?php echo $row_product['Id_Produk']; ?></a></div></li>
											<div class="Id_Pemesanan">Harga Produk <li><?php echo $row_product['Harga_Produk']; ?><li></li></a></div>
											
											
										</div>
									</div>
									<div>
								
											</li>
										</ul>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- Cart Total -->
					<div class="col-lg-6 cart_col">
						<div class="cart_total">
							<div class="cart_extra_content cart_extra_total">
								<div class="checkout_title">Cart Total</div>
								<ul class="cart_extra_total_list">
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Subtotal</div>
										<div class="cart_extra_total_value ml-auto"><?php echo $row_product['Harga_Produk']; ?></div>
									</li>
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Total</div>
										<div class="cart_extra_total_value ml-auto"><?php echo $row_product['Harga_Produk']; ?></div>
									</li>
								</ul><?php } ?>
								<div class="payment_options">
									<div class="checkout_title">Tanggal Acara</div>

									<input type="date" name="tanggal_pinjam" required="" placeholder="Tanggal Pinjam"></td>
									<ul>
										<li class="shipping_option d-flex flex-row align-items-center justify-content-start">
												<input type="radio" id="radio_1" name="payment_radio" class="payment_radio">
											</label>

										</li>
										<!-- <input type="text" id="checkout_last_name" class="checkout_input" placeholder="Uang Muka" required="required">
										<li class="shipping_option d-flex flex-row align-items-center justify-content-start">
										</li> -->
									</ul>
								</div>
								<!-- <div class="cart_text">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integ er bibendum sodales arcu id te mpus. Ut consectetur lacus.</p>
								</div>
 -->								<div class="checkout_button trans_200"><a href="index.php">Selesai</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->

<?php include "footer.php"?>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap-4.1.2/popper.js"></script>
<script src="styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/checkout.js"></script>
</body>
</html>