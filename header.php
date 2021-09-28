<?php 
	include "connection.php";

	$result_category=mysql_query("select * from kategori ");
	$result_slider=mysql_query("SELECT * FROM slider_vendor S, vendor V, kategori K WHERE s.`status` = 1 AND s.`id_vendor` = v.`Id_Vendor`;");

	$result_category_selected=mysql_query("select * from kategori;");
	$category_selected = '1';
	if(isset($_GET['id_cat'])){
		$category_selected = $_GET['id_cat'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

