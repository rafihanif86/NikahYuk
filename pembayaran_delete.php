<?php
    $conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
    mysql_select_db("nikahyuk") or die ("database tidak ada");

    $id_pembayaran=$_GET["Id_Pembayaran"];
   
    $result=mysql_query("SELECT * FROM pembayaran ;",$conn);
        while ($row1=mysql_fetch_array($result)){
            $id_pembayaran = $row1["Id_Pembayaran"];
        }
    if($id_pembayaran != null){
        $delete_pembayaran=mysql_query("DELETE FROM pembayaran where Id_Pembayaran = $id_pembayaran;",$conn);
    }
    if($delete_pembayaran){
        echo "<script>alert('Data Berhasil Dihapus')
            location.replace('pembayaran.php')</script>";
    }else{
        echo "<script>alert('Data Gagal Dihapus')
        location.replace('pembayaran.php')</script>";
    }
?>