<?php 
    include "connection.php";
    include "header_administrator.php";

	$Id_Customer = $nama_customer = $address = $telp = $email = $avatar = $edit = null;
    
    if(isset($_GET['edit']) and isset($_GET['Id_Customer'])){
        $edit=$_GET['edit'];
        $Id_Customer = $_GET['Id_Customer'];
        $result=mysql_query("SELECT * FROM customer;");
        while ($row1=mysql_fetch_array($result)){
			$Id_Customer = $row1["Id_Customer"];
            $nama_customer = $row1["Nama_Customer"];
            $address = $row1["Alamat_Customer"];
            $telp = $row1["Telp_Customer"];
            $email= $row1["Email_customer"];
            $avatar = $row1["Image_customer"];
        }
    }

    if(isset($_POST["submit"])){
        $nama_customer = $_POST["Nama_Customer"];
        $address = $_POST["Alamat_Customer"];
        $telp = $_POST["Telp_Customer"];
        $email= $$_POSTrow1["Email_customer"];
        $avatar = $_POST["Image_customer"];
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
                $query2="INSERT INTO customer (Id_Customer, Nama_Customer,Alamat_Customer,Telp_Customer,Email_customer) VALUES ('".$Id_Customer."','".$nama_customer."','".$address."','".$telp."','".$email."');";
                $sql_insert2 = mysql_query($query2,$conn);
            }
        }else{
            $query1="UPDATE Customer set Id_Customer = '$Id_Customer',Nama_Customer = '$nama_customer', Alamat_Customer = '$address', Email_customer= '$email', Telp_Customer = '$telp' where Id_Customer = $Id_Customer;";
            $sql_insert1 = mysql_query($query1,$conn);
		
            $query2="UPDATE Customer set Id_Login = '$id_login', Nama_Vendor = '$name', Alamat_Vendor = '$alamat', Telp_Vendor = '$telp', Email_vendor = '$email', Id_Admin = '$id_admin', Instagram = '$ig' where Id_Vendor = $id_vendor;";
            $sql_insert2 = mysql_query($query2,$conn);
        }

		echo "<script>alert('Berhasil Menambah Data Customer')
                location.replace('customer_tampilAkun.php')</script>";
	}

    if(isset($_POST["reset"])){
        $Id_Category = $Category_Name = null;
    }

?>
<script LANGUAGE="JavaScript">
    if($id_vendor=null){
        document.frm.id1.hidden = "hidden";
        document.frm.id2.hidden = "hidden";
    }else{
        document.frm.id1.hidden = "";
        document.frm.id1.hidden = "";
    }	
function controlCK(str) {	
	document.frm.submit.disabled = !str;
}
</script>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Customer Form</strong> Elements
                            </div>
                            <div class="card-body card-block">
								<form action="cust_form.php" method="post" name="frm" enctype="multipart/form-data" class="form-horizontal">
                                        
									<div class="row form-group">
										<div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Customer</label></div>
										<div class="col-12 col-md-9"><input type="text" id="text-input" name="Name of Customer" placeholder="Name of Customer" class="form-control" value="<?php echo $nama_customer; ?>"><small class="form-text text-muted">Masukkan Nama Produk</small></div>
									</div>
									<div class="row form-group">
										<div class="col col-md-3"><label for="text-input" class=" form-control-label">Alamat</label></div>
										<div class="col-12 col-md-9"><input type="text" id="text-input" name="Address" placeholder="Address" class="form-control" value="<?php echo $address; ?>"><small class="form-text text-muted">Masukkan Harga Produk</small></div>
									</div>
									<div class="row form-group">
										<div class="col col-md-3"><label for="email-input" class=" form-control-label">Nomor Telepon</label></div>
										<div class="col-12 col-md-9"><input type="text" id="text-input" name="Phone Number" placeholder="Phone Number" class="form-control" value="<?php echo  $telp; ?>"><small class="help-block form-text">Masukkan Nama Deskripsi</small></div>
									</div>
									<div class="row form-group">
										<div class="col col-md-3"><label for="password-input" class=" form-control-label">Email</label></div>
										<div class="col-12 col-md-9"><input type="email" id="email-input" name="Email" placeholder="Email" class="form-control" value="<?php echo $email; ?>"><small class="help-block form-text">Masukkan Kategori Produk</small></div>
									</div>
									<div class="row form-group">
										<div class="col col-md-3"><label for="file-input" class=" form-control-label">Pilih Foto</label></div>
										<div class="col-12 col-md-9"><input type="file" id="image" name="image" class="form-control-file" value="<?php echo $avatar; ?>"></div>
										<input type="text" id="id_vendor" name="id_vendor" hidden="hidden" value="<?php echo $id_vendor; ?>">
										<input type="text" id="id_produk" name="id_produk" hidden="hidden" value="<?php echo $id_produk; ?>">
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
		</div>
    <div class="clearfix"></div>
<?php include "footer_administrator.php" ?>