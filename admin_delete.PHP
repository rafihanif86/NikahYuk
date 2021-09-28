<?php

include "connection.php";
$Id_Admin = $_GET['Id_Admin'];
mysql_query("delete from admin where Id_Admin = $Id_Admin") or die(mysql_error());


header("location:admin_tampilAkun.php?pesan=hapus");
?>