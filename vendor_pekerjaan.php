<?php 
	include "connection.php";
    include "header_administrator.php";

    $conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
    mysql_select_db("nikahyuk") or die ("database tidak ada");

    $cari;
    $queryVendor="SELECT * FROM pekerjaan_vendor;"; //query vendor

    if(isset($_GET["search"])){
        $cari=$_GET["text_search"];
        $queryVendor="SELECT * FROM pekerjaan_vendor WHERE `Nama_pekerjaan` LIKE '%$cari%' OR `tgl_memulai_pekerjaan` LIKE '%$cari%' OR `tgl_pekerjaan_selesai` LIKE '%$cari%' OR `status_pekerjaan` LIKE '%$cari%';";
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
<body>

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
                                    <li><a href="dashboard_admin.php">Dashboard</a></li>
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
											<th>DESCIPTION</th>
											<th>START DATE</th>
											<th>FINISH DATE</th>
                                            <th>STATUS</th>
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
                                            <td><?php echo $row1["Nama_pekerjaan"]; ?></td>
                                            <td><?php echo $row1["tgl_memulai_pekerjaan"]; ?></td>
                                            <td><?php echo $row1["tgl_pekerjaan_selesai"]; ?></td>
											<td><?php echo $row1["status_pekerjaan"]; ?></td>
                                            <td> <p align="center"> 
                                                <a  href="vendor_form.php?edit=true&id_vendor=<?php echo $row1["Id_Produk"];?>" class="btn btn-success btn-sm"> <i class='fa fa-pencil fa-2x'> </i> </a> 
												|
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
            </div><!-- .animated -->
        </div><!-- .content -->


        <div class="clearfix"></div>

        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2019 Admin Nikah Yuk
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="dashboard_admin.php">Nikah Yuk</a>
                    </div>
                </div>
            </div>
        </footer>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );
  </script>


</body>
</html>
