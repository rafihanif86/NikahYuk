<?php 
	include "connection.php";
    include "header_administrator.php";

    $conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
    mysql_select_db("nikahyuk") or die ("database tidak ada");

    $nama_kategori = $id_category = null;
    
    if(isset($_GET['edit']) and isset($_GET['Id_category'])){
        $edit=$_GET['edit'];
        $id_vendor = $_GET['Id_category'];
        $result=mysql_query("SELECT * FROM kategori;");
        while ($row1=mysql_fetch_array($result)){
            $nama_kategori = $row1["Category_Name"];
        }
    }

    if(isset($_POST["submit"])){
        $nama_kategori = $row1["Category_Name"];
        $id_category=$_POST['Id_category'];
        $edit=$_POST['edit'];

        if($edit != true){
            if(($user and $email and $password) != null){
                $query1="INSERT INTO kategori (Category_Name) VALUES ('".$nama_kategory."');";
                $sql_insert1 = mysql_query($query1,$conn);
            }else{
                echo "<script>alert('Ada data yang kosong')</script>";
            }
    
            $result=mysql_query("SELECT * FROM produk WHERE Id_Produk LIKE '%$id_produk%'");
            while ($row=mysql_fetch_array($result)){
                $id_produk = $row["Id_Produk"];
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
        echo "<script>alert('Berhasil') 
            location.replace('tampilKategori.php')</script>";


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
                                    <strong>Product Form</strong> Elements
                                </div>
                                <div class="card-body card-block">
                                <form action="" method="post" name="frm" enctype="multipart/form-data" class="form-horizontal">
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Kategori</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="Category Name" placeholder="Category Name" class="form-control" value="<?php echo $nama_kategori; ?>"><small class="form-text text-muted">Masukkan Nama Kategori</small></div>
                                        </div>
                                    <div>
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
