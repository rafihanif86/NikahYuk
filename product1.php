<?php
session_start();
	error_reporting(0);
	include "header.php";
	include "connection.php";

	$search = "";
	$hide_slider = "";
	$queryProduct = "SELECT p.description,p.Nama_Produk,p.Harga_Produk,p.Ft_sampul_produk,v.Id_Vendor FROM produk AS p INNER JOIN vendor AS v ON p.Id_Vendor = v.Id_Vendor WHERE Id_Produk = '$_GET[id]' ";
	if(isset($_POST["search"])){
		$cari=$_POST["text_search"];
		$queryProduct="SELECT * FROM View_produk WHERE `Nama_Produk` LIKE '%$cari%' OR `Harga_Produk` LIKE '%$cari%' OR `Category_Name` LIKE '%$cari%' OR `Nama_Vendor` LIKE '%$cari%'";
		$search="Search For ".$cari;
		$category_selected = 0;
		$hide_slider = "hidden='true'";
	}
	$idCustomer = '';
	$query = "SELECT * FROM customer WHERE Email_login='$_SESSION[Email_login]'";
    $result=mysql_query($query);
    while ($row=mysql_fetch_array($result)){
        $idCustomer = $row['Id_Customer'];
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
<title>Product</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Little Closet template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/flexslider/flexslider.css">
<link rel="stylesheet" type="text/css" href="styles/product.css">
<link rel="stylesheet" type="text/css" href="styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

		<!-- Home -->

		<div class="home">
			<div class="home_container d-flex flex-column align-items-center justify-content-end">
				<div class="home_content text-center">
					<div class="home_title">Product Page</div>
					<div class="breadcrumbs d-flex flex-column align-items-center justify-content-center">
						<ul class="d-flex flex-row align-items-start justify-content-start text-center">
							<li><a href="#">Home</a></li>
							<li><a href="category.html">Woman</a></li>
							<li>New Products</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Product -->
<?php
		// $queryDetail = "SELECT p.Nama_Produk,p.Harga_Produk,p.Ft_sampul_produk,v.Id_Vendor FROM produk AS p INNER JOIN vendor AS v ON p.Id_Vendor = v.Id_Vendor WHERE Id_Produk=2";
		// $result_detail=mysql_query($queryDetail);
				
		while ($row_product=mysql_fetch_array($result_product)){				
		
		?>
		<div class="product">
			<div class="container">
				<div class="row">
					
					<!-- Product Image -->
					<div class="col-lg-6">
						<div class="product_image_slider_container">
							<div id="slider" class="flexslider">
								<ul class="slides">
									<li>
										<div class="wrapper">
											<div class="zoom-effect">
												<div class="kotak">
													
										<?php echo "<img src='images/".$row_product['Ft_sampul_produk']."' width='800px'; height='500px'>";?>
												</div>
											</div>		
										</div>
									</li>
									<li>
										<img src="images/2-ppf-kembar-mayang-SyD33Wj2z.jpg" />
									</li>
									<li>
										<img src="images/2-panggih-sinduran-ppf-rkxZAZj3z.jpg" />
									</li>
									<li>
										<img src="images/2-panggih-ngidak-tagan-iluminen-HJ6habo2z.jpg" />
									</li>
									
								</ul>
							</div>
							<div class="carousel_container">
								<div id="carousel" class="flexslider">
									<ul class="slides">
										<li>
										<?php echo "<img src='images/".$row_product['Ft_sampul_produk']."' width='800px'; height='500px'>";?>
									</li>
										<li>
										<img src="images/2-ppf-kembar-mayang-SyD33Wj2z.jpg" />
									</li>
									<li>
										<img src="images/2-panggih-sinduran-ppf-rkxZAZj3z.jpg" />
									</li>
									<li>
										<img src="images/2-panggih-ngidak-tagan-iluminen-HJ6habo2z.jpg" />
									</li>
										
									</ul>
								</div>
								<div class="fs_prev fs_nav disabled"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
								<div class="fs_next fs_nav"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>

					<!-- Product Info -->
					<div class="col-lg-6 product_col">

						<div class="product_info">
							<div class="product_name"><?php echo $row_product['Nama_Produk']; ?></div>
							<div class="product_category"><a href="vendor.html?id_ven=<?php echo $row_product["Id_Vendor"]; ?>"><?php echo $row_product['Nama_Vendor']; ?>Category</a></div>
							<div class="product_rating_container d-flex flex-row align-items-center justify-content-start">
								<div class="rating_r rating_r_4 product_rating"><?php getRating($row1["Rating"]);?><i></i><i></i><i></i><i></i><i></i></div>
								<div class="product_reviews">4.7 out of (3514)</div>
								<div class="product_reviews_link"><a href="#">Reviews</a></div>
							</div>
							<div class="product_price"><span>Rp. <?php echo $row_product["Harga_Produk"]; ?></div>
							
							<div class="product_text">
								<p><?php echo $row_product["description"]; ?></p>
							</div>
							<div class="product_buttons">
								<div class="text-right d-flex flex-row align-items-start justify-content-start">
									<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
										<div><div><img src="images/heart_2.svg" class="svg" alt=""><div>+</div></div></div>
									</div>
									<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
										<div><div><a href="checkout.php?Id_Produk=<?php echo $row_product['Id_Produk']?>" class="svg" ><img src="images/cart.svg" style="width:120px; height: 40px; "><div>+</div></div></div>
									</div>
								</div>
							</div>
						</div>
							<?php
						}
					?>
					</div>
				</div>
			</div>
		</div>

		<!-- Boxes -->

		<div class="boxes">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="box d-flex flex-row align-items-center justify-content-start">
							<div class="mt-auto"><div class="box_image"><img src="images/boxes_1.png" alt=""></div></div>
							<div class="box_content">
								<div class="box_title">Size Guide</div>
								<div class="box_text">Phasellus sit amet nunc eros sed nec tellus.</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 box_col">
						<div class="box d-flex flex-row align-items-center justify-content-start">
							<div class="mt-auto"><div class="box_image"><img src="images/boxes_2.png" alt=""></div></div>
							<div class="box_content">
								<div class="box_title">Shipping</div>
								<div class="box_text">Phasellus sit amet nunc eros sed nec tellus.</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->

	<?php include "footer_administrator.php" ?>

	</div>
		
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap-4.1.2/popper.js"></script>
<script src="styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/progressbar/progressbar.min.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="plugins/flexslider/jquery.flexslider-min.js"></script>
<script src="js/product.js"></script>
</body>
</html>