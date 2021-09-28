<?php
	error_reporting(0);
	include "connection.php";
	include "header.php";
	include "import_produk.php";
	include "header2.php";
	include "getCus.php";

	$date = $_GET['date'];
	$notFound = "image-not-found.jpg";
	$search = "";
	$hide_slider = "";
	$product_id = $_GET[id];
	$queryProduct = "SELECT * from view_produk WHERE Id_Produk = '$product_id' ";
	$result_product=mysql_query($queryProduct,$conn);

	$jm_slider='';
	$queryImage = "SELECT COUNT(*) as jumlah FROM image WHERE OWNER LIKE '%produk%' AND Id_Owner = $product_id;";
	$result_image=mysql_query($queryImage,$conn);
	while ($row_image=mysql_fetch_array($result_image)){
		$jm_slider = $row_image["jumlah"];
	}

	$queryImageShow = "SELECT * FROM image WHERE OWNER LIKE '%produk%' AND Id_Owner = $product_id;";
	$result_imageShow=mysql_query($queryImageShow,$conn);


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
<title>Product</title>
<?php include "header.php"; ?>

		<!-- Home -->
		<?php			
			while ($row_product=mysql_fetch_array($result_product)){				
		?>
		<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title"><?php echo $row_product['Category_Name']; ?></div>
					<div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
						<ul class="d-flex flex-row align-items-start justify-content-start text-center">
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php?id_cat=<?php echo $row_product['Id_category']; ?>"><?php echo $row_product['Category_Name']; ?></a></li>
							<li><?php echo $row_product['Nama_Produk']; ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

	<div class="super_container_inner">
		<div class="super_overlay"></div>
				<!-- slider -->
				<div class="home_slider_container" style="height: 800px;">
					<div class="owl-carousel owl-theme home_slider">
	                    <!-- Slide -->
	                    <?php
			                while ($row_imageShow=mysql_fetch_array($result_imageShow)){
			            ?>
						<div class="owl-item">
							<div class="background_image">
								<img src="images/
									<?php 
										$notFound = $row_imageShow["Image_name"];
										echo $notFound;
										// if($jm_slider === 0){
										// 		echo $notFound; 
										// 	}else{
										// 		echo $row_imageShow["Image_name"];
										// 	}
									?>
								" alt="" class="img-fluid" >
							</div>	
	                    </div>
	                    <?php
	                        }
	                    ?>
					</div>
					<div class="home_slider_nav home_slider_nav_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
					<div class="home_slider_nav home_slider_nav_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>

					<!-- Home Slider Dots -->
					
					<div class="home_slider_dots_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_slider_dots">
										<ul id="home_slider_custom_dots" class="home_slider_custom_dots d-flex flex-row align-items-center justify-content-center">
											<?php 
												for($i = 1; $i <= $jm_slider; $i++){
											?>
											<li class="home_slider_custom_dot active"><?php echo '$i';?></li>
											<?php
						                        }
						                    ?>
										</ul>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>

		<!-- Product -->
		<div class="product">
			<div class="container">
				<div class="row">

					<!-- Product Info -->
					<div class="col-lg-12 product_col">
						<div class="row">
							<div class="col col-lg-6">
								<div class="product_info">
									<div class="product_name"><?php echo $row_product['Nama_Produk']; ?></div>
									<div class="product_category"><a href="vendor.html?id_ven=<?php echo $row_product["Id_Vendor"]; ?>"><?php echo $row_product['Nama_Vendor']; ?>Category</a></div>
									<div class="product_rating_container d-flex flex-row align-items-center justify-content-start">
										<div class="rating_r rating_r_4 product_rating"><?php getRating($row1["Rating"]);?><i></i><i></i><i></i><i></i><i></i></div>
										<div class="product_reviews">4.7 out of (3514)</div>
										<div class="product_reviews_link"><a href="#">Reviews</a></div>
									</div>
									<div class="product_price"><span>Rp. <?php echo $row_product["Harga_Produk"]; ?></div>
									
									<!-- <div class="product_text">
										<p><?php echo $row_product["description"]; ?></p>
									</div> -->
									<div class="product_buttons">
										<div class="text-right d-flex flex-row align-items-start justify-content-start">
											<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
												<div><div><img src="images/heart_2.svg" class="svg" alt=""><div>+</div></div></div>
											</div>
											<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
												<div>											
													<div>
														<a href="insert_pemesanan.php?id_produk=<?php echo $product_id; ?>&id_cus=<?php echo $id_cus; ?>&date=<?php echo $date; ?>">
															<img src="images/cart.svg" class="svg" alt="">
														</a>
														<div>+</div>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div class="col col-lg-6">
								<div class="product_text">
										<p><?php echo $row_product["Description"]; ?></p>
								</div>
							</div>
							<?php
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->

	<?php include "footer.php"?>