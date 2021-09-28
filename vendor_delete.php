<?php
    $conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
    mysql_select_db("nikahyuk") or die ("database tidak ada");

    $id_vendor=$_GET["id_vendor"];
    $id_login = null;
    $delete_login= false;
    
    $result=mysql_query("SELECT * FROM vendor V, login L WHERE V.`Id_Vendor` = $id_vendor AND V.`Id_Login` = L.`Id_login`;",$conn);
        while ($row1=mysql_fetch_array($result)){
            $id_login = $row1["Id_login"];
        }
    if($id_login != null){
        $delete_vendor=mysql_query("DELETE FROM vendor where Id_Vendor = $id_vendor;",$conn);
    }
    if($delete_vendor){
        $delete_login = mysql_query("DELETE FROM login where Id_login = $id_login;",$conn);
    }
    if($delete_vendor and $delete_login){
        echo "<script>alert('Data Berhasil Dihapus')
            location.replace('vendor_producttampil.php')</script>";
    }else{
        echo "<script>alert('Data Gagal Dihapus')
        location.replace('vendor_producttampil.php')</script>";
    }
?>