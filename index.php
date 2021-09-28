<?php
	error_reporting(0);
	include "connection.php";
	include "header.php";
	include "dateSelector.php";
	include "getCus.php";

	$search = $cari = $date = "";
	$hide_slider = "";
	$count = 0;

	$date=$_GET['tgl'];

	if(isset($_GET["find"])){
		$date = $_GET['dateform'];
	}


	$dateStart = date('Y-m-d', strtotime('-2 days', strtotime($date)));
	$dateEnd = date('Y-m-d', strtotime('+2 days', strtotime($date)));

	$queryTgl="SELECT V.`Id_Produk` FROM View_produk V, pemesanan P , jadwal J WHERE Category = '$category_selected' AND v.`Id_Produk` = p.`Id_Produk` AND p.`Id_Pemesanan` = j.`Id_Pemesanan` AND (J.`Tgl_Acara` BETWEEN '$dateStart' AND '$dateEnd');";
	$result_tgl=mysql_query($queryTgl);
        while ($rowtgl=mysql_fetch_array($result_tgl)){
        	$count++;
        }

    if($count > 0){
    	$queryProduct = "SELECT * FROM (SELECT V.* FROM View_produk V WHERE Category = '$category_selected') AS t1, (SELECT V.`Id_Produk` FROM View_produk V, pemesanan P , jadwal J WHERE Category = '1' AND v.`Id_Produk` = p.`Id_Produk` AND p.`Id_Pemesanan` = j.`Id_Pemesanan` AND (J.`Tgl_Acara` BETWEEN '$dateStart' AND '$dateEnd')) AS t2 WHERE t1.Id_Produk != t2.Id_Produk ";
    }else{
    	$queryProduct = "SELECT V.* FROM View_produk V WHERE Category = '$category_selected'";
    }
	

	if(isset($_POST["search"]) || isset($_GET['cari'])){
		if(isset($_POST["search"])){
			$cari=$_POST["text_search"];
		}else{
			$cari=$_GET['cari'];
		}
		$date = $_POST['date'];
		$dateStart = date('Y-m-d', strtotime('-2 days', strtotime($date)));
		$dateEnd = date('Y-m-d', strtotime('+2 days', strtotime($date)));

		$queryTgl="SELECT V.`Id_Produk` FROM View_produk V, pemesanan P , jadwal J WHERE Category = '$category_selected' AND v.`Id_Produk` = p.`Id_Produk` AND p.`Id_Pemesanan` = j.`Id_Pemesanan` AND (J.`Tgl_Acara` BETWEEN '$dateStart' AND '$dateEnd');";
		$result_tgl=mysql_query($queryTgl);
	        while ($rowtgl=mysql_fetch_array($result_tgl)){
	        	$count++;
	        }

	    if($count > 0){
	    	$queryProduct = "SELECT * FROM (SELECT V.* FROM View_produk V WHERE Category = '$category_selected') AS t1, (SELECT V.`Id_Produk` FROM View_produk V, pemesanan P , jadwal J WHERE Category = '1' AND v.`Id_Produk` = p.`Id_Produk` AND p.`Id_Pemesanan` = j.`Id_Pemesanan` AND (J.`Tgl_Acara` BETWEEN '$dateStart' AND '$dateEnd')) AS t2 WHERE t1.Id_Produk != t2.Id_Produk ";
	    }else{
	    	$queryProduct = "SELECT V.* FROM View_produk V WHERE Category = '$category_selected'";
	    }
		$queryProduct .= " OR `Nama_Produk` LIKE '%$cari%' OR `Harga_Produk` LIKE '%$cari%' OR `Category_Name` LIKE '%$cari%' OR `Nama_Vendor` LIKE '%$cari%'";
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

	include "import_index.php";
	include "header2.php";

?>


	<div class="super_container_inner">
		<div class="super_overlay"></div>

		<!-- Home -->

		<div class="home" <?php echo $hide_slider;?>>
			<!-- Home Slider -->
			<div class="home_slider_container" >
				<div class="owl-carousel owl-theme home_slider">
					
                    <!-- Slide -->
                    <?php
                        while ($row1=mysql_fetch_array($result_slider)){
                    ?>
					<div class="owl-item">
						<div class="background_image"><img src="images/<?php echo $row1["ft_background"]; ?>" alt="" class="img-fluid"></div>
						<div class="container fill_height">
							<div class="row fill_height">
								<div class="col fill_height">
									<div class="home_container d-flex flex-column align-items-center justify-content-start">
										<div class="home_content">
											<div class="home_title"><?php echo $row1["Category_Name"]; ?></div>
											<div class="home_subtitle"><?php echo $row1["Nama_Vendor"]; ?></div>
											<div class="home_items">
												<div class="row">
													<div class="col-sm-3 offset-lg-1">
														<div class="home_item_side"><a href="product.html"><img src="images/<?php echo $row1["ft_kiri"]; ?>" alt=""></a></div>
													</div>
													<div class="col-lg-4 col-md-6 col-sm-8 offset-sm-2 offset-md-0">
														<div class="product home_item_large">
															<div class="product_image"><img src="images/<?php echo $row1["ft_depan"]; ?>" alt=""></div>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="home_item_side"><a href="product.html"><img src="images/<?php echo $row1["ft_kanan"]; ?>" alt=""></a></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>	
                    </div>
                    <?php
                        }
                    ?>

				</div>
				<div class="home_slider_nav home_slider_nav_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
				<div class="home_slider_nav home_slider_nav_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>

			</div>
		</div>

		<!-- Products -->

		<div class="products">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3">
						<div class="section_title text-center">
							Your Date <?php echo $date; ?>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contohModalBesarl">Choose</button>
							<?php include"popupTgl.php"?>

							<br/><br/>
							<?php

								while ($row_category=mysql_fetch_array($result_category_selected)){
									$id_category = $row_category["Id_category"];
									if($category_selected == $id_category){ 
										$search = $row_category["Category_Name"];
									}
								}
								echo $search;
							?>
						</div>
					</div>
				</div>
				<div class="row products_row">
					
					<!-- Product -->
					<?php
						while ($row_product=mysql_fetch_array($result_product)){
							$category_selected=$row_product["Category"];
					?>
					<div class="col-xl-4 col-md-6">
						<div class="product">
							<div class="product_image"><img src="images/<?php echo $row_product["Ft_sampul_produk"]; ?>" alt=""></div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name"><a href="product.php?id=<?php $id_pro = $row_product["Id_Produk"]; echo $id_pro; ?>&date=<?php echo $date ?>"><?php echo $row_product["Nama_Produk"]; ?></a></div>
											<div class="product_category"><a href="vendor.html?id_ven=<?php echo $row_product["Id_Vendor"]; ?>"><?php echo $row_product["Nama_Vendor"]; ?></a></div>
										</div>
									</div>
									<div class="ml-auto text-right">
										<div class="rating_r rating_r_4 home_item_rating"><?php getRating($row1["Rating"]);?> </div>
										<div class="product_price text-right"><span>Rp. <?php echo $row_product["Harga_Produk"]; ?></span></div>
									</div>
								</div>
								<div class="product_buttons">
									<div class="text-right d-flex flex-row align-items-start justify-content-start">
										<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
											<div><div><img src="images/heart_2.svg" class="svg" alt=""><div>+</div></div></div>
										</div>
										<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
											<div>											
												<div>
													<a href="insert_pemesanan.php?id_produk=<?php echo $id_pro; ?>&id_cus=<?php echo $id_cus; ?>&date=<?php echo $date; ?>">
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
					</div>
					<?php
						}
					?>

				</div>
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
						<li class="page-item disabled">
						<a class="page-link" href="index.php?page=<?php echo $x+1 ?>">Previous</a>
						</li>
						<?php
							for($x=1;$x<=$halaman;$x++){
						?>
						<li class="page-item"><a class="page-link" href="index.php?page=<?php echo $x; ?>&tgl=<?php echo $date; ?>&cari=<?php echo $cari; ?>"><?php echo $x ?></a></a></li>
						<?php
							}
						?>
						<li class="page-item">
							<a class="page-link" href="index.php?page=<?php echo $x-1 ?>&tgl=<?php echo $date; ?>&cari=<?php echo $cari; ?>">Next</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>

		<!-- Features -->

		<div class="features">
			<div class="container">
				<div class="row">
					
					<!-- Feature -->
					<div class="col-lg-4 feature_col">
						<div class="feature d-flex flex-row align-items-start justify-content-start">
							<div class="feature_left">
								<div class="feature_icon"><img src="images/icon_1.svg" alt=""></div>
							</div>
							<div class="feature_right d-flex flex-column align-items-start justify-content-center">
								<div class="feature_title">Fast Secure Payments</div>
							</div>
						</div>
					</div>

					<!-- Feature -->
					<div class="col-lg-4 feature_col">
						<div class="feature d-flex flex-row align-items-start justify-content-start">
							<div class="feature_left">
								<div class="feature_icon ml-auto mr-auto"><img src="images/icon_2.svg" alt=""></div>
							</div>
							<div class="feature_right d-flex flex-column align-items-start justify-content-center">
								<div class="feature_title">Premium Service</div>
							</div>
						</div>
					</div>

					<!-- Feature -->
					<div class="col-lg-4 feature_col">
						<div class="feature d-flex flex-row align-items-start justify-content-start">
							<div class="feature_left">
								<div class="feature_icon"><img src="images/icon_3.svg" alt=""></div>
							</div>
							<div class="feature_right d-flex flex-column align-items-start justify-content-center">
								<div class="feature_title">Free Schaduling</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- Footer -->

<?php include "footer.php"?>
<script>
		$('#contohModalBesarl').modal('show');
</script>