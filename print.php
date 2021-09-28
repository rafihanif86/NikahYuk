<?php
    include "connection.php";
    include "header.php";
    include "import_cart.php";
    include "header2.php";
    include "getCus.php";


    $search = "";
    $imageCus = "";
    $namaCus = "";
    $hide_slider = "";
    $alamatCus = "";
    $telpCus = "";
    $emailCus = "";
    $queryCustomer = "SELECT * FROM customer C, login L WHERE c.`id_login_custom` = L.`Id_login` AND L.`Status` LIKE '%customer%' AND C.`Id_Customer` = '$id_cus';";
    $result_Customer=mysql_query($queryCustomer,$conn);
    while ($row_Customer=mysql_fetch_array($result_Customer)){
        $imageCus = $row_Customer['Image_cutomer'];
        $namaCus = $row_Customer['Nama_Customer'];
        $alamatCus = $row_Customer['Alamat_Customer'];
        $telpCus = $row_Customer['Telp_Customer'];
        $emailCus = $row_Customer['Email_customer'];
    }

    // $cari = "";
    // $Id_Produk = "";
    // $Nama_Produk = "";
    // $Harga_Produk = "";
    // $queryProduk = "SELECT * FROM produk p, pemesanan c WHERE p.`Id_Produk` = c.`Id_Produk` AND p.`Nama_Produk` = c.`Nama_Produk`;";
    // $result_Produk=mysql_query($queryProduk,$conn);
    // while ($row_Customer=mysql_fetch_array($result_Produk)){
    //     $Id_Produk = $row_Produk['Id_Produk'];
    //     $Nama_Produk = $row_Produk['Nama_Produk'];
    //     $Harga_Produk = $row_Produk['Harga_Produk'];
    // }

    $queryPemesanan = "SELECT * FROM pemesanan P, jadwal J, customer C, produk R WHERE P.`Id_Produk` = R.`Id_Produk` AND P.`Id_Customer` = C.`Id_Customer` AND J.`Id_Pemesanan` = P.`Id_Pemesanan` AND C.`Id_Customer` = '$id_cus';";
    $result_Pemesanan=mysql_query($queryPemesanan,$conn);
    $totalCost='';

?>
<html>
<head>
<title> Print Documen </title>
<link href = "style.css" type = "text/css" rel = "stylesheet"/>
</head>
<body>
    <center><h1><br>FORM TRANSAKSI<h1></center>
    <table border = "1" width = "90%" style = "border-collapse:collapse;" align = "center">
    <tr class = "tableheader">
    <th rowspan = "1" width = "70" height = "50"> Id Customer</th>
    <th> Nama Customer</th>
    <th> Id Produk</th>
    <th> Nama Produk</th>
    <th> Status Pemesanan</th>
    <th> Harga Produk</th>
    </tr>
    <?php
        $i = 0;
        while ($row1=mysql_fetch_array($result_Pemesanan)){
        $i++;
     }
 $result_Customer=mysql_query($queryCustomer,$conn);
while($hasil = mysql_fetch_array($result_Customer)){
    ?>
    <tr id = "rowHover">
    <td width = "10%" align = "center"><center><?php echo $hasil['Id_Customer'];?></td>
    <td width = "15%" align = "center"><center><?php echo $hasil['Nama_Customer'];?></td>
    <td width = "10%" align = "center"><center><?php echo $hasil['Id_Produk'];?></td>
    <td width = "35%" align = "center"><center><?php echo $hasil['Nama_Produk'];?></td>
    <td width = "15%" align = "center"><center><?php echo $hasil['Status Pemesanan'];?></td>
    <td width = "15%" align = "center"><center><?php echo $hasil['Harga_Produk'];?></td>   
    </tr>
    <?php
    }
    ?>

</table>
<script>
    window.load = print_d();
    function print_d(){
        window.print();
    }
    </script>
</body>
</html>