<?php 
	include "connection.php";
    include "header_administrator.php";

    $conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
    mysql_select_db("nikahyuk") or die ("database tidak ada");

    $user = $email = $password = $name = $alamat = $telp = $image = $ig = $idLogin = $id_vendor = $edit =null;
    
    if(isset($_GET['edit']) and isset($_GET['id_vendor'])){
        $edit=$_GET['edit'];
        $id_vendor = $_GET['id_vendor'];
        $result=mysql_query("SELECT * FROM vendor V, login L WHERE V.`Id_Vendor` = $id_vendor AND V.`Id_Login` = L.`Id_login`;");
        while ($row1=mysql_fetch_array($result)){
            $user = $row1["Username"];
            $email = $row1["Email_vendor"];
            $password = $row1["Password"];
            $name = $row1["Nama_Vendor"];
            $alamat = $row1["Alamat_Vendor"];
            $telp = $row1["Telp_Vendor"];
            $image = $row1["Image_vendor"];
            $ig = $row1["Instagram"];
            $id_login = $row1["Id_login"];
        }
    }

    if(isset($_POST["submit"])){
        $user=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $status = 'vendor';
        $name = $_POST["name"];
        $alamat = $_POST["address"];
        $telp = $_POST["phone"];
        $ig = $_POST["ig"];
        $id_admin = 1;
        $id_login=$_POST['id_login'];
        $id_vendor=$_POST['id_vendor'];
        $edit=$_POST['edit'];

        if($edit != true){
            if(($user and $email and $password) != null){
                $query1="INSERT INTO login (Username,Password,Email_login,Status) VALUES ('".$user."','".$password."','".$email."','".$status."');";
                $sql_insert1 = mysql_query($query1,$conn);
            }else{
                echo "<script>alert('Ada data yang kosong')</script>";
            }
    
            $result=mysql_query("SELECT * FROM login WHERE Email_login LIKE '%$email%'");
            while ($row=mysql_fetch_array($result)){
                $id_login = $row["Id_login"];
            }
            if($id_login != null){
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
                                    <li><a href="vendor_form.php">Dashboard</a></li>
                                    <li><a href="#">Forms</a></li>
                                    <li class="active">Vendor Form</li>
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
                                <form action="vendor_form.php" method="post" name="frm" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label class="form-control-label" class="id1">ID</label></div>
                                            <div class="col-12 col-md-9">
                                                <p class="form-control-static" class="id2"><?php echo $id_vendor; ?></p>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name of Vendor</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="name" placeholder="Name of vendor" class="form-control" value="<?php echo $name; ?>"><small class="form-text text-muted">This is a help text</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Username</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="username" placeholder="Username" class="form-control" value="<?php echo $user; ?>"><small class="form-text text-muted">This is a help text</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email </label></div>
                                            <div class="col-12 col-md-9"><input type="email" id="email-input" name="email" placeholder="Enter Email" class="form-control" value="<?php echo $email; ?>"><small class="help-block form-text">Please enter your email</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="password-input" class=" form-control-label">Password</label></div>
                                            <div class="col-12 col-md-9"><input type="password" id="password-input" name="password" placeholder="Password" class="form-control" value="<?php echo $password; ?>"><small class="help-block form-text">Please enter a complex password</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Address</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="address" name="address" placeholder="Address" class="form-control" value="<?php echo $alamat; ?>"><small class="form-text text-muted">This is a help text</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Phone Number</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="phone" name="phone" placeholder="Phone" class="form-control" value="<?php echo $telp; ?>"><small class="form-text text-muted">This is a help text</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Instagram Account</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="ig" name="ig" placeholder="Instagram Account" class="form-control" value="<?php echo $ig; ?>"><small class="form-text text-muted">This is a help text</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Choose Company Image</label></div>
                                            <div class="col-12 col-md-9"><input type="file" id="image" name="image" class="form-control-file" value="<?php echo $image; ?>"></div>
                                            <input type="text" id="id_vendor" name="id_vendor" hidden="hidden" value="<?php echo $id_vendor; ?>">
                                            <input type="text" id="id_login" name="id_login" hidden="hidden" value="<?php echo $id_login; ?>">
                                            <input type="text" id="edit" name="edit" hidden="hidden" value="<?php echo $edit; ?>">
                                        </div>
                                        
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-sm" name="submit">
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
