<?php
    $conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
    mysql_select_db("nikahyuk") or die ("database tidak ada");

    $Id_category=$_GET["Id_category"];
   
    $result=mysql_query("SELECT * FROM kategori ;",$conn);
        while ($row1=mysql_fetch_array($result)){
            $Id_category = $row1["Id_category"];
        }
    if($Id_category != null){
        $delete_kategori=mysql_query("DELETE FROM kategori where Id_category = $Id_category;",$conn);
    }
    if($delete_kategori){
        echo "<script>alert('Data Berhasil Dihapus')
            location.replace('tampilKategori.php')</script>";
    }else{
        echo "<script>alert('Data Gagal Dihapus')
        location.replace('tampilKategori.php')</script>";
    }
?>