<?php 
	include "connection.php";
    include "header_administrator.php";

    $conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
    mysql_select_db("nikahyuk") or die ("database tidak ada");

    $nama_pekerjaan = $start_date = $end_date = $status = $edit =null;
    
    if(isset($_GET['edit']) and isset($_GET['id_pekerjaan'])){
        $edit=$_GET['edit'];
        $id_pekerjaan = $_GET['id_pekerjaan'];
        $result=mysql_query("SELECT * FROM pekerjaan_vendor;");
        while ($row1=mysql_fetch_array($result)){
            $nama_pekerjaan = $row1["Nama_pekerjaan"];
            $start_date = $row1["tgl_memulai_pekerjaan"];
            $end_date = $row1["tgl_pekerjaan_selesai"];
            $status= $row1["status_pekerjaan"];
        }
    }

    if(isset($_POST["submit"])){
        $nama_pekerjaan = $row1["Nama_pekerjaan"];
        $start_date = $row1["tgl_memulai_pekerjaan"];
        $end_date = $row1["tgl_pekerjaan_selesai"];
        $status= $row1["status_pekerjaan"];
        $id_customer=$_POST['Id_Customer'];
        $id_login_custom=$_POST['id_login_custom'];
        $edit=$_POST['edit'];

        if($edit != true){
            if(($user and $email and $password) != null){
                $query1="INSERT INTO customer (Nama_Customer,Alamat_Customer,Telp_Customer,Email_customer) VALUES ('".$nama_customer."','".$address."','".$telp."','".$email."');";
                $sql_insert1 = mysql_query($query1,$conn);
            }else{
                echo "<script>alert('Ada data yang kosong')</script>";
            }
    
            $result=mysql_query("SELECT * FROM customer WHERE Id_Customer LIKE '%$id_customer%'");
            while ($row=mysql_fetch_array($result)){
                $id_customer = $row["Id_Customer"];
            }
            if($idLogin != null){
                $query2="INSERT INTO vendor (Id_Login, Nama_vendor, Alamat_Vendor, Telp_Vendor, Email_vendor,Id_Admin,Instagram) VALUES ('".$id_login."','".$name."','".$alamat."','".$telp."','".$email."','".$id_admin."','".$ig."');";
                $sql_insert2 = mysql_query($query2,$conn);
            }
        }else{
            $query1="UPDATE login set Username = '$user',Password = '$password', Email_login = '$email', Status = '$status' where Id_login = $id_login;";
            $sql_insert1 = mysql_query($query1,$conn);

            $query2="UPDATE vendor set Id_Login = '$id_login', Nama_Vendor = '$name', Alamat_Vendor = '$alamat', Telp_Vendor = '$telp', Email_vendor = '$email', Id_Admin = '$id_admin', Instagram = '$ig' where Id_Vendor = $id_vendor;";
            $sql_insert2 = mysql_query($query2,$conn);
        }


        if($sql_insert1 and $sql_insert2){
            $ekstensi_diperbolehkan	= array('png','jpg');
            $nama = $_FILES['image']['name'];
            $x = explode('.', $nama);
            $ekstensi = strtolower(end($x));
            $ukuran	= $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
        
                move_uploaded_file($file_tmp, 'images/'.$nama);
                $query = mysql_query("UPDATE vendor SET Image_vendor = '$nama' where Email_vendor Like '%$email%'",$conn);
                if($query){
                    echo "<script>alert('Berhasil Mengupload Gambar')</script>";
                }else{
                    echo "<script>alert('Gagal Mengupload Gambar')</script>";
                }

        
            echo "<script>alert('Berhasil Membuat Akun')
                location.replace('vendor_tampildata.php?search=true&text_search=$email')</script>";
        }else{
            echo "<script>alert('Gagal Membuat Akun')</script>";
        }
    }

    if(isset($_POST["reset"])){
        $user = $email = $password = $name = $alamat = $telp = $image = $ig = null;
    }

    

?>
<SCRIPT LANGUAGE="JavaScript">
    if($id_vendor=null){
        document.frm.id1.hidden = "hidden";
        document.frm.id2.hidden = "hidden";
    }else{
        document.frm.id1.hidden = "";
        document.frm.id1.hidden = "";
    }
<!-- 	
function controlCK(str) {	
	document.frm.submit.disabled = !str;
}
//  End -->
</script>
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
                                    <li><a href="#">Forms</a></li>
                                    <li class="active">Product Form</li>
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

                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Vendors Form</strong> Elements
                                </div>
                                <div class="card-body card-block">
                                <form action="cust_form.php" method="post" name="frm" enctype="multipart/form-data" class="form-horizontal">
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Pekerjaan</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="Nama Pekerjaan" placeholder="Nama Pekerjaan" class="form-control" value="<?php echo $nama_pekerjaan; ?>"><small class="form-text text-muted">Masukkan Nama Produk</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Starting Date</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="Starting Date" placeholder="Starting Date" class="form-control" value="<?php echo $start_date; ?>"><small class="form-text text-muted">Masukkan Harga Produk</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="email-input" class=" form-control-label">End Date</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="End Date" placeholder="End Date" class="form-control" value="<?php echo  $end_date; ?>"><small class="help-block form-text">Masukkan Nama Deskripsi</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="password-input" class=" form-control-label">Status</label></div>
                                            <div class="col-12 col-md-9"><input type="email" id="email-input" name="Status" placeholder="Status" class="form-control" value="<?php echo $status; ?>"><small class="help-block form-text">Masukkan Kategori Produk</small></div>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="check" onClick="controlCK(this.checked)"> Agree the terms and policy
                                            </label>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm" name="submit" disabled="true">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm" name="reset">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                    </form>
                                </div>
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


</body>
</html>
