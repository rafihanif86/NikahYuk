<!-- <?php 
	$conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
	mysql_select_db("nikahyuk") or die ("database tidak ada");
?> -->
<?php
$conn = mysqli_connect("localhost","root","","nikahyuk");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>