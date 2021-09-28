<?php
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

?>


		<!-- Home -->

		<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title"><?php echo $namaCus;?> Cart</div>
					<div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
						<ul class="d-flex flex-row align-items-start justify-content-start text-center">
							<li><a href="index.php">Home</a></li>
							<li>Your Cart</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Profil -->
		<div class="product">
			<div class="container">
				<div class="row">

					<!-- Product Image -->
					<div class="col-lg-4" >
						<div class="product_image_slider_container" style="width: 80%; height: 80%;">
							<div id="slider" class="flexslider">
								<ul class="slides">
									<li>
										<img src="images/<?php if($namaCus === 'null' || $namaCus === '' || $namaCus === '(NULL)' || $namaCus === null){ echo 'image-not-found.jpg';}else{echo $imageCus;} ?>" />
									</li>
								</ul>
							</div>
						</div>
					</div>

					<!-- Product Info -->
					
					<div class="col-lg-8 product_col">
						<div class="product_info">
							
							<div class="product_name" style="width: 100%;"><?php echo $namaCus;?></div>
							<div class="product_reviews"><?php echo $alamatCus;?></div>
							<div class="product_reviews"><?php echo $telpCus;?></div>
							<div class="product_reviews"><?php echo $emailCus;?></div>
							
							<div class="product_size">
								<div class="product_size_title">Edit your profile</div>
								<div class="button">
									<div><div><a href="customer_form.php?Id_cus=<?php echo $id_cus; ?>" class="" >Edit</a></div></div>
								</div>
							</div>
						
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<hr/>

		<!-- Cart -->

		<div class="cart_section">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="cart_container">
							
							<!--Cart table-->
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Product</th>
							      <th scope="col"></th>
							      <th scope="col">Date of Event</th>
							      <th scope="col">Cost</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
							  	<?php
									$i = 0;
									while ($row_Pemesanan=mysql_fetch_array($result_Pemesanan)){
										$i++;
										$cost = $row_Pemesanan['Harga_Produk'];
										$totalCost += $cost;
								?>
							    <tr>
							      <th scope="row"><?php echo $i; ?> </th>
							      <td><div class="product_image"><img src="images/<?php echo $row_Pemesanan['Ft_sampul_produk']; ?>" alt=""></td>
							      <td><div class="product_name"><a href="product.php?id=<?php echo $row_Pemesanan['Id_Produk']; ?>"><?php echo $row_Pemesanan['Nama_Produk']; ?></a></div></a></td>
							      <td><?php echo $row_Pemesanan['Tgl_Acara']; ?></td>
							      <td>Rp. <?php echo $cost; ?></td>
							      <td><a  href="pemesanan_delete.php?id_pemesanan=<?php echo $row_Pemesanan['Id_Pemesanan'];?>&id_cus=<?php echo $Id_cus;?>" class="btn btn-danger btn-sm"> <i class='fa fa-trash-o fa-2x'></td>
							    </tr>
							    <?php } ?>
							  </tbody>
							</table>
							
							
						</div>
					</div>
				</div>
				<div class="row cart_extra_row">
					<div class="col-lg-6">
						<div class="cart_extra cart_extra_1">
							<div class="cart_extra_content cart_extra_coupon">
								<div class="cart_extra_title">Coupon code</div>
								<img src="images/6-512.png">
								<!-- cuppon -->
								<!-- <div class="coupon_form_container">
									<form action="#" id="coupon_form" class="coupon_form">
										<input type="text" class="coupon_input" required="required">
										<button class="coupon_button">apply</button>
									</form>
								</div>
								<div class="coupon_text">Phasellus sit amet nunc eros. Sed nec congue tellus. Aenean nulla nisl, volutpat blandit lorem ut.</div>
								<div class="shipping">
									<div class="cart_extra_title">Shipping Method</div>
									<ul>
										<li class="shipping_option d-flex flex-row align-items-center justify-content-start">
											<label class="radio_container">
												<input type="radio" id="radio_1" name="shipping_radio" class="shipping_radio">
												<span class="radio_mark"></span>
												<span class="radio_text">Next day delivery</span>
											</label>
											<div class="shipping_price ml-auto">$4.99</div>
										</li>
										<li class="shipping_option d-flex flex-row align-items-center justify-content-start">
											<label class="radio_container">
												<input type="radio" id="radio_2" name="shipping_radio" class="shipping_radio">
												<span class="radio_mark"></span>
												<span class="radio_text">Standard delivery</span>
											</label>
											<div class="shipping_price ml-auto">$1.99</div>
										</li>
										<li class="shipping_option d-flex flex-row align-items-center justify-content-start">
											<label class="radio_container">
												<input type="radio" id="radio_3" name="shipping_radio" class="shipping_radio" checked>
												<span class="radio_mark"></span>
												<span class="radio_text">Personal Pickup</span>
											</label>
											<div class="shipping_price ml-auto">Free</div>
										</li>
									</ul>
								</div> -->
							</div>
						</div>
					</div>
					<div class="col-lg-6 cart_extra_col">
						<div class="cart_extra cart_extra_2">
							<div class="cart_extra_content cart_extra_total">
								<div class="cart_extra_title">Cart Total</div>
								<ul class="cart_extra_total_list">
									<li class="d-flex flex-row align-items-center justify-content-start">
										<div class="cart_extra_total_title">Total</div>
										<div class="cart_extra_total_value ml-auto"><?php echo $totalCost; ?></div>
									</li>
								</ul>
								<div class="checkout_button trans_200"><a href="print.php">Selesai</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
<?php include "footer.php"?>
<script src="js/cart.js"></script>
<script src="js/product.js"></script>
<script src="plugins/flexslider/jquery.flexslider-min.js"></script>
</body>
</html>