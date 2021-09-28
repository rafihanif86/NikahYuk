</head>
<body>

	<!-- Menu -->
	<div class="menu" >

		<!-- Navigation -->
		<div class="menu_nav" style="padding-top: -5px;">
			<ul>
				<li><img src="images/logonikahyuk.png" alt="" align="center" style="width:100%;hight:100%"></li>
				<li><hr></li>
				<li><h3><b>Category</b></h3></li>
		        <?php
		            while ($row=mysql_fetch_array($result_category)){
		        ?>
	            <li><a href="index.php?id_cat=<?php echo $row["Id_category"];; ?>"><?php echo $row["Category_Name"]; ?></a></li>
		        <?php
		            }
		        ?>
	        	<li><hr></li>
	            <li><a href="#">Our Galery</a></li>
	            <li><a href="#">Contact</a></li>
			</ul>
		</div>
		<!-- Contact Info -->
		<div class="menu_contact">
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
					<div class="cart"><a href="cart.php"><div><img class="svg" src="images/cart.svg" ></div></a></div>
				</div>
			</div>
		</header>
	</div>
	</body>
</html>