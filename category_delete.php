<?php
    $conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
    mysql_select_db("nikahyuk") or die ("database tidak ada");

    $id_category=$_GET["Id_category"];
    $id_login = null;
    $delete_login= false;
    $result=mysql_query("SELECT * FROM kategori K;",$conn);
        while ($row1=mysql_fetch_array($result)){
            $id_login = $row1["Id_login"];
        }
    if($id_login != null){
        $delete_vendor=mysql_query("DELETE FROM kategori where Id_kategory = $id_category;",$conn);
    }
    if($delete_vendor and $delete_login){
        echo "<script>alert('Data Berhasil Dihapus')
            location.replace('vendor_tampildata.php')</script>";
    }else{
        echo "<script>alert('Data Gagal Dihapus')
        location.replace('vendor_tampildata.php')</script>";
    }
?>