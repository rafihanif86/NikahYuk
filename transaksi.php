<?php
error_reporting(0);


$conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
mysql_select_db("nikahyuk") or die ("database tidak ada");

$result_category=mysql_query("select * from kategori ");
$result_slider=mysql_query("SELECT * FROM slider_vendor S, vendor V, kategori K WHERE s.`status` = 1 AND s.`id_vendor` = v.`Id_Vendor`;");

$result_category_selected=mysql_query("select * from kategori;");
$category_selected = '1';
if(isset($_GET['id_cat'])){
	$category_selected = $_GET['id_cat'];
}

$queryProduct = "SELECT * FROM view_VPC WHERE Category = ".$category_selected;

if(isset($_POST["search"])){
	$cari=$_POST["text_search"];
	$queryProduct="SELECT * FROM View_produk WHERE `Nama_Produk` LIKE '%$cari%' OR `Harga_Produk` LIKE '%$cari%' OR `Category_Name` LIKE '%$cari%' OR `Nama_Vendor` LIKE '%$cari%'";
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
<title>Nikah Yuk</title>
<link rel="shortcut icon" href="images/logonikahIcon.png">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Little Closet template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" >
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>
<body>

<!-- Menu -->

<div class="menu">

	<!-- Navigation -->
	<div class="menu_nav">
		<ul>
        <?php
            while ($row=mysql_fetch_array($result_category)){
        ?>
            <li><a href="index.php?id_cat=<?php echo $row["Id_category"];; ?>"><?php echo $row["Category_Name"]; ?></a></li>
        <?php
            }
        ?>
            <li><a href="#">Our Galery</a></li>
            <li><a href="#">Contact</a></li>
		</ul>
	</div>
	<!-- Contact Info -->
	<div class="menu_contact">
		<div class="menu_phone d-flex flex-row align-items-center justify-content-start">
			<div><div><img src="images/phone.svg" alt=""></div></div>
			<div>+1 912-252-7350</div>
		</div>
		<div class="menu_social">
			<ul class="menu_social_list d-flex flex-row align-items-start justify-content-start">
				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</div>
</div>

<div class="super_container">

	<!-- Header -->

	<header class="header">
		<div class="header_overlay"></div>
		<div class="header_content d-flex flex-row align-items-center justify-content-start">
            <div class="hamburger" ><i class="fa fa-bars" aria-hidden="true"></i></div>
			<div class="logo">
				<a href="index.php">
					<div class="d-flex flex-row align-items-center justify-content-start">
						<img src="images/logonikahyuk.png" alt="" style="padding-left:20px;width:25%;hight:25%">
					</div>
				</a>	
			</div>
			<div class="header_right d-flex flex-row align-items-center justify-content-start ml-auto">
				<!-- Search -->
				<div class="header_search">
					<form action="index.php" method="post" id="header_search_form" >
						<input type="text" class="search_input" name="text_search" placeholder="Search Item" required="required">
						<button class="header_search_button" name="search"><img src="images/search.png" alt=""></button>
					</form>
				</div>
				<!-- User -->
				<div class="user"><a href="page_login.php"><div><img src="images/user.svg" ><div>1</div></div></a></div>
				<!-- Cart -->
				<div class="cart"><a href="page_login.php"><div><img class="svg" src="images/cart.svg" ></div></a></div>
			</div>
		</div>
	</header>

	<div class="super_container_inner">
		<div class="super_overlay"></div>

		<!-- Home -->

		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
			

                                       <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Vendors Form</strong> Elements
                                </div>
                                <div class="card-body card-block">
                                <form action="vendor_form.php" method="post" name="frm" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label class="form-control-label" class="id1">ID</label></div>
                                            <div class="col-12 col-md-9">
                                                <p class="form-control-static" class="id2"><?php echo $id_vendor; ?></p>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name of Vendor</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="name" placeholder="Name of vendor" class="form-control" value="<?php echo $name; ?>"><small class="form-text text-muted">This is a help text</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Username</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="username" placeholder="Username" class="form-control" value="<?php echo $user; ?>"><small class="form-text text-muted">This is a help text</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email </label></div>
                                            <div class="col-12 col-md-9"><input type="email" id="email-input" name="email" placeholder="Enter Email" class="form-control" value="<?php echo $email; ?>"><small class="help-block form-text">Please enter your email</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="password-input" class=" form-control-label">Password</label></div>
                                            <div class="col-12 col-md-9"><input type="password" id="password-input" name="password" placeholder="Password" class="form-control" value="<?php echo $password; ?>"><small class="help-block form-text">Please enter a complex password</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Address</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="address" name="address" placeholder="Address" class="form-control" value="<?php echo $alamat; ?>"><small class="form-text text-muted">This is a help text</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Phone Number</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="phone" name="phone" placeholder="Phone" class="form-control" value="<?php echo $telp; ?>"><small class="form-text text-muted">This is a help text</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Instagram Account</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="ig" name="ig" placeholder="Instagram Account" class="form-control" value="<?php echo $ig; ?>"><small class="form-text text-muted">This is a help text</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Choose Company Image</label></div>
                                            <div class="col-12 col-md-9"><input type="file" id="image" name="image" class="form-control-file" value="<?php echo $image; ?>"></div>
                                            <input type="text" id="id_vendor" name="id_vendor" hidden="hidden" value="<?php echo $id_vendor; ?>">
                                            <input type="text" id="id_login" name="id_login" hidden="hidden" value="<?php echo $id_login; ?>">
                                            <input type="text" id="edit" name="edit" hidden="hidden" value="<?php echo $edit; ?>">
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="check" onClick="controlCK(this.checked)"> Agree the terms and policy
                                            </label>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm" name="submit" disabled="true">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm" name="reset">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
		<!-- Footer -->

		<footer class="footer">
			<div class="footer_content">
				<div class="container">
					<div class="row">
						
						<!-- About -->
						<div class="col-lg-4 footer_col">
							<div class="footer_about">
								<div class="footer_logo">
									<a href="#">
										<div class="d-flex flex-row align-items-center justify-content-start">
											<img src="images/logonikahyuk.png" alt="" style="padding-left:90px;width:80%;hight:80%">
										</div>
									</a>		
								</div>
								<div class="footer_about_text">
									<p>This website offers many wedding vendors to make it easier for young couples to prepare for their wedding. so the wedding can run smoothly without draining the couple's time. we hope that this website can help users so that it can be used by everyone who is preparing for the wedding.</p>
								</div>
							</div>
						</div>

						<!-- Footer Links -->
						<div class="col-lg-4 footer_col">
							<div class="footer_menu">
								<div class="footer_title">Support</div>
								<ul class="footer_list">
									<li>
										<a href="#"><div>Customer Service<div class="footer_tag_1">online now</div></div></a>
									</li>
									<li>
										<a href="#"><div>Return Policy</div></a>
									</li>
									<li>
										<a href="#"><div>Size Guide<div class="footer_tag_2">recommended</div></div></a>
									</li>
									<li>
										<a href="#"><div>Terms and Conditions</div></a>
									</li>
									<li>
										<a href="#"><div>Contact</div></a>
									</li>
								</ul>
							</div>
						</div>

						<!-- Footer Contact -->
						<div class="col-lg-4 footer_col">
							<div class="footer_contact">
								<div class="footer_title">Stay in Touch</div>
								<div class="newsletter">
									<form action="#" id="newsletter_form" class="newsletter_form">
										<input type="email" class="newsletter_input" placeholder="Subscribe me with your E-mail" required="required">
										<button class="newsletter_button">+</button>
									</form>
								</div>
								<div class="footer_social">
									<div class="footer_title">Social</div>
									<ul class="footer_social_list d-flex flex-row align-items-start justify-content-start">
										<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
										<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer_bar">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="footer_bar_content d-flex flex-md-row flex-column align-items-center justify-content-start">
								<div class="copyright order-md-1"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This Website Made by MI2F Group 2
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
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
<script src="js/custom.js"></script>
</body>
</html>