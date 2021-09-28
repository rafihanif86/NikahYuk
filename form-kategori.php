<?php 
    include "connection.php";
    include "header_administrator.php";


    $Id_Category = $Category_Name = $edit = null;
    
    if(isset($_GET['edit']) and isset($_GET['Id_Category'])){
        $edit=$_GET['edit'];
        $Id_Category = $_GET['Id_Category'];
        $result=mysql_query("SELECT * FROM kategori;");
        while ($row1=mysql_fetch_array($result)){
            $Id_Category = $row1["Id_Category"];
            $Category_Name = $row1["Category_Name"];
        }
    }

    if(isset($_POST["submit"])){
        $Id_Category=$_POST['Id_Category'];
        $Category_Name=$_POST['Category_Name'];
        // $edit=$_POST['edit'];

        if($edit != true){
            if(($Category_Name) != null){
                $query1="INSERT INTO kategori (Category_Name) VALUES ('".$Category_Name."');";
                $sql_insert1 = mysql_query($query1,$conn);
            }else{
                echo "<script>alert('Ada data yang kosong')</script>";
            }
        }else{
            $query1="UPDATE kategori set Id_Category = '$Id_Category',Category_Name = '$Category_Name' where Id_Category = $Id_Category;";
            $sql_insert1 = mysql_query($query1,$conn);
        }
        
            echo "<script>alert('Berhasil Menambah Kategori')
                location.replace('tampilKategori.php')</script>";
        
    }

    // else{
    //         echo "<script>alert('Gagal Input Kategori')</script>";
    //     }


    if(isset($_POST["reset"])){
        $Id_Category = $Category_Name = null;
    }

    

?>
<SCRIPT LANGUAGE="JavaScript">
    if($Id_Category=null){
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
                                <form action="form-kategori.php" method="post" name="frm" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label class="form-control-label">ID</label></div>
                                            <div class="col-12 col-md-9">
                                                <p class="form-control-static" class="id2"><?php echo $Id_Category; ?></p>
                                                <input type="text" id="text-input" name="Id_Category" class="form-control" value="<?php echo $Id_Category; ?>" hidden="true">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name of Category</label></div>
                                            <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="Category_Name" placeholder="Name of category" class="form-control" value="<?php echo $Category_Name; ?>"></div>
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
