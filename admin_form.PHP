<?php 
    include "connection.php";
    include "header_administrator.php";


    $Id_Admin = $Nama_Admin = $edit = null;
    
    if(isset($_GET['edit']) and isset($_GET['Id_Admin'])){
        $edit=$_GET['edit'];
        $Id_Admin = $_GET['Id_Admin'];
        $result=mysql_query("SELECT * FROM admin;");
        while ($row1=mysql_fetch_array($result)){
            $Id_Admin = $row1["Id_Admin"];
            $Nama_Admin = $row1["Nama_Admin"];
            $Telp_Admin=$row1['Telp_Admin'];
        }
    }

    if(isset($_POST["submit"])){
        $Id_Admin=$_POST['Id_Admin'];
        $Nama_Admin=$_POST['Nama_Admin'];
        $Telp_Admin=$_POST['Telp_Admin'];
        // $edit=$_POST['edit'];

        if($edit != true){
            if(($Nama_Admin) != null){
                $query1="INSERT INTO admin (Nama_Admin, Telp_Admin) VALUES ('".$Nama_Admin."','".$Telp_Admin."');";
                $sql_insert1 = mysql_query($query1,$conn);
            }else{
                echo "<script>alert('Ada data yang kosong')</script>";
            }
        }else{
            $query1="UPDATE admin set Nama_Admin = '$Nama_Admin', Telp_Admin = $Telp_Admin where Id_Admin = $Id_Admin;";
            $sql_insert1 = mysql_query($query1,$conn);
        }
        
            echo "<script>alert('Berhasil Menambah admin')
                location.replace('admin_tampilAkun.php')</script>";
        
    }

    // else{
    //         echo "<script>alert('Gagal Input admin')</script>";
    //     }


    if(isset($_POST["reset"])){
        $Id_Admin = $Nama_Admin = $Telp_Admin = null;
    }

    

?>
<SCRIPT LANGUAGE="JavaScript">
    if($Id_Admin=null){
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

    

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Category Form</strong> Elements
                                </div>
                                <div class="card-body card-block">
                                <form action="" method="post" name="frm" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label class="form-control-label">ID</label></div>
                                            <div class="col-12 col-md-9">
                                                <p class="form-control-static" class="id2"><?php echo $Id_Admin; ?></p>
                                                <input type="text" id="text-input" name="Id_Admin" class="form-control" value="<?php echo $Id_Admin; ?>" hidden="true">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name of Admin</label></div>
                                            <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="Nama_Admin" placeholder="Name of category" class="form-control" value="<?php echo $Nama_Admin; ?>"></div>
                                        </div>
                                         <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Phone</label></div>
                                            <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="Telp_Admin" placeholder="Name of category" class="form-control" value="<?php echo $Telp_Admin; ?>"></div>
                                        </div>
                                        
                                        
                                    <div class="card-footer">
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
    <div class="clearfix"></div>
<?php include "footer_administrator.php"?>
