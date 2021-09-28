<!-- Image Slider -->
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		  <ol class="carousel-indicators">
		  	<?php 
				for($i = 1; $i <= $jm_slider; $i++){
			?>
				<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo '$i';?>"></li>;
			<?php
				}
			?>
		  </ol>
		  <div class="carousel-inner">
		  	<?php
                while ($row_imageShow=mysql_fetch_array($result_imageShow)){
            ?>
            <div class="carousel-item active">
		      <img class="d-block w-100" src="images/
		      	<?php 
					$url ='';
					$url = $row_imageShow["Image_name"];
					if(strcmp($url,'') == null){
							echo 'image-not-found.jpg';
						}else{
							echo $row_imageShow["Image_name"]; 
						}
				?>" alt="">
		    </div>
            <?php
                }
            ?>
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>