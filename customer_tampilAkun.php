<?php 
	include "connection.php";
    include "header_administrator.php";
	
    $conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
    mysql_select_db("nikahyuk") or die ("database tidak ada");

    $cari;
    $queryVendor="SELECT * FROM customer;"; //query vendor

    if(isset($_GET["search"])){
        $cari=$_GET["text_search"];
        $queryVendor="SELECT * FROM customer WHERE `Nama_Customer` LIKE '%$cari%' OR `Alamat_Customer` LIKE '%$cari%' OR `Telp_Customer` LIKE '%$cari%' OR `Email_customer` LIKE '%$cari%' OR `Image_customer` LIKE '%$cari%' OR `Username` LIKE '%$cari%' ;";
    }

    // $per_hal=6;
    // $jumlah_record=mysql_query($queryProduct);
    // $jum=mysql_result($jumlah_record, 0);
    // $halaman=ceil($jum / $per_hal);
    // $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
    // $start = ($page - 1) * $per_hal;
    // $queryProduct = $queryProduct." limit $start, $per_hal ";
    
    
    $result_vendor=mysql_query($queryVendor,$conn) or die (mysql_error($conn));
?>
<!doctype html>
<html class="no-js" lang=""> 
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="vendor_produk.php">Dashboard</a></li>
                                    <li><a href="#">Table</a></li>
                                    <li class="active">Data table</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Table</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
											<th>NAME</th>
											<th>ADDRESS</th>
											<th>PHONE NUMBER</th>
											<th>EMAIL</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $i = 0;
                                        while ($row1=mysql_fetch_array($result_vendor)){
                                            $i++;
                                    ?>
                                        <tr>
                                            <td><?php echo $i ?></td>

                                            <td><?php echo $row1["Id_Customer"]; ?></td>
                                            <td><?php echo $row1["Nama_Customer"]; ?></td>
                                            <td><?php echo $row1["Alamat_Customer"]; ?></td>
                                            <td><?php echo $row1["Telp_Customer"]; ?></td>
											<td><?php echo $row1["Email_customer"]; ?></td>
                                            <td> <p align="center"> 
                                                <a  href="vendor_form.php?edit=true&id_vendor=<?php echo $row1["Id_Produk"];?>" class="btn btn-success btn-sm"> <i class='fa fa-pencil fa-2x'> </i> </a> 
											
                                                <a  href="vendor_delete.php?id_vendor=<?php echo $row1["Id_Produk"];?>" class="btn btn-danger btn-sm"> <i class='fa fa-trash-o fa-2x'> </i> </a>
											</p>
											</td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
<?php include "footer_administrator.php" ?>