<?php 
    $conn = mysql_connect("localhost", "root", "") or die ("koneksi database gagal");
    mysql_select_db("nikahyuk") or die ("database tidak ada");

    $uang_muka = $status = $edit =null;
    
    if(isset($_GET['edit']) and isset($_GET['Id_Pembayaran'])){
        $edit=$_GET['edit'];
        $id_pembayaran = $_GET['Id_Pembayaran'];
        $result=mysql_query("SELECT * FROM pembayaran;");
        while ($row1=mysql_fetch_array($result)){
            $uang_muka= $row1["Uang_Muka"];
            $status = $row1["Status"];
        }
    }

    if(isset($_POST["submit"])){
		$uang_muka= $row1["Uang_Muka"];
        $status = $row1["Status"];
        $id_customer=$_POST['Id_Customer'];
        $id_login_custom=$_POST['id_login_custom'];
        $edit=$_POST['edit'];

        if($edit != true){
            if(($user and $email and $password) != null){
                $query1="INSERT INTO pembayaran (Uang_Muka,Status) VALUES ('".$uang_muka."','".$status."');";
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
<!doctype html>
<html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vendor Form Nikah Yuk</title>
    <meta name="description" content="Register Nikah Yuk">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logonikahIcon.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="styles/bootstrap-4.1.2/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" >

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="dashboard_admin.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">Kelola Akun</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Tables</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="vendor_tampildata.php">Tabel Akun Vendor</a></li>
                            <li><i class="fa fa-table"></i><a href="vendor_producttampil.php">Tabel Product Vendor</a></li>
                            <li><i class="fa fa-table"></i><a href="customer_tampilAkun.php">Tabel Akun Customer</a></li>
							<li><i class="fa fa-table"></i><a href="admin_tampilAkun.php">Tabel Akun Admin</a></li>
							<li><i class="fa fa-table"></i><a href="tampilKategori.php">Tabel Kategori</a></li>
							<li><i class="fa fa-table"></i><a href="vendor_pekerjaan.php">Tabel Pekerjaan Vendor</a></li>
							<li><i class="fa fa-table"></i><a href="pembayaran.php">Tabel Pembayaran</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Forms</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="vendor_form.php">Tambah Akun Vendor</a></li>
							<li><i class="menu-icon fa fa-th"></i><a href="product_form.php">Tambah Product</a></li>
							<li><i class="menu-icon fa fa-th"></i><a href="cust_form.php">Tambah Akun Customer</a></li>
							<li><i class="menu-icon fa fa-th"></i><a href="category_form.php">Tambah Kategori</a></li>
							<li><i class="menu-icon fa fa-th"></i><a href="pekerjaan_form.php">Tambah Pekerjaan Vendor</a></li>
							<li><i class="menu-icon fa fa-th"></i><a href="pembayaran_form.php">Tambah Pembayaran</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard_admin.php"><img src="images/logonikahyuk.png" alt="" style="padding-left:20px;width:35%;hight:35%"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">3</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <span class="count bg-primary">4</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jonathan Smith</span>
                                        <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jack Sanders</span>
                                        <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Cheryl Wheeler</span>
                                        <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Rachel Santos</span>
                                        <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa-bell-o"></i>Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i>Settings</a>

                            <a class="nav-link" href="page_login.php"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- /header -->
        <!-- Header-->

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
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Uang Muka</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="Uang Muka" placeholder="Uang Muka" class="form-control" value="<?php echo $uang_muka; ?>"><small class="form-text text-muted">Masukkan Uang Muka</small></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Status</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="Status" placeholder="Status" class="form-control" value="<?php echo $status; ?>"><small class="form-text text-muted">Masukkan Status </small></div>
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
