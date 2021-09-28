<?php
    $conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
    mysql_select_db("nikahyuk") or die ("database tidak ada");

    $Id_Produk=$_GET["Id_Produk"];
   
    $result=mysql_query("SELECT * FROM produk ;",$conn);
        while ($row1=mysql_fetch_array($result)){
            $Id_Produk = $row1["Id_Produk"];
        }
    if($Id_Produk != null){
        $delete_produk=mysql_query("DELETE FROM produk where Id_Produk = $Id_Produk;",$conn);
    }
    if($delete_produk){
        echo "<script>alert('Data Berhasil Dihapus')
            location.replace('tampilKategori.php')</script>";
    }else{
        echo "<script>alert('Data Gagal Dihapus')
        location.replace('tampilKategori.php')</script>";
    }
?>