<?php 
    include "connection.php";
    include "header_administrator.php";


    $id = $nama = $harga = $desc = $kategori = $foto = $rating = $avatar = $edit = null;
    
    if(isset($_GET['edit']) and isset($_GET['Id_Produk'])){
        $edit=$_GET['edit'];
        $id = $_GET['Id_Produk'];
        $result=mysql_query("SELECT * FROM produk;");
        while ($row1=mysql_fetch_array($result)){
            $id = $row1["Id_Produk"];
            $nama = $row1["Nama_Produk"];
            $harga = $row1["Harga_Produk"];
            $desc = $row1["Description"];
            $kategori = $row1["Category"];
            $rating = $row1["rating_prodak"];
            $avatar = $row1["Ft_sampul_produk"];
        }
    }

    if(isset($_POST["submit"])){
// $id = $_POST["Id_Produk"];
        $nama=$_POST['nama'];
        $harga=$_POST['harga'];
        $desc=$_POST['desc'];
        $kategori=$_POST['kategori'];
        $rating=$_POST['rating'];
        $edit=$_POST['edit'];

        if($edit != true){
            if(($nama and $harga) != null){
                // $query1="INSERT INTO produk (nama, harga, desc, kategori, foto, rating) VALUES ('".$nama."', '".$harga."', '".$desc."', '".$kategori."', '".$foto."', '".$rating."');";
                $query1 = "INSERT INTO produk SET Nama_Produk='$nama', Harga_Produk='$harga', Description='$desc', Category='$kategori',  rating_prodak='$rating', Ft_sampul_produk= '$avatar'";
                $sql_insert1 = mysql_query($query1,$conn);
            }else{
                echo "<script>alert('Ada data yang kosong')</script>";
            }
        }else{
            $query1="UPDATE produk SET Nama_Produk='$nama', Harga_Produk='$harga', Description='$desc', Category='$kategori',  rating_prodak='$rating', Ft_sampul_produk= '$avatar'";
            $sql_insert1 = mysql_query($query1,$conn);
        }
         if($sql_insert1){
            $ekstensi_diperbolehkan = array('png','jpg');
            $namae = $_FILES['image']['name'];
            $x = explode('.', $namae);
            $ekstensi = strtolower(end($x));
            $ukuran = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
        
                move_uploaded_file($file_tmp, 'images/'.$namae);
                $query = mysql_query("UPDATE produk SET Ft_sampul_produk = '$avatar'",$conn);
                if($query){
                    echo "<script>alert('Berhasil Mengupload Gambar')</script>";
                }else{
                    echo "<script>alert('Gagal Mengupload Gambar')</script>";
                }

        
            echo "<script>alert('Berhasil Membuat Akun')
                location.replace('vendor_producttampil.php?search=true&text_search=$email')</script>";
        }else{
            echo "<script>alert('Gagal Membuat Akun')</script>";
        }
    }

    if(isset($_POST["reset"])){
        $id = $nama = $harga = $desc = $kategori = $foto = $rating = $avatar = $edit = null;
    }
    

?>
<SCRIPT LANGUAGE="JavaScript">
    if($id=null){
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
                                    <strong>Poduct Form</strong>
                                </div>
                                <div class="card-body card-block">
                                <form action="form-produk.php" method="post" name="frm" enctype="multipart/form-data" class="form-horizontal">  
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label class="form-control-label">ID</label></div>
                                            <div class="col-12 col-md-9">
                                                <p class="form-control-static" class="id2"><?php echo $id; ?></p>
                                                <input type="text" id="text-input" name="id" class="form-control" value="<?php echo $id; ?>" hidden="true">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama</label></div>
                                            <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="nama" placeholder="nama" class="form-control" value="<?php echo $nama; ?>"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Harga</label></div>
                                            <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="harga" placeholder="harga" class="form-control" value="<?php echo $harga; ?>"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Deskripsi</label></div>
                                            <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="desc" placeholder="desc" class="form-control" value="<?php echo $desc; ?>"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Kategori</label></div>
                                            <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="kategori" placeholder="kategori" class="form-control" value="<?php echo $kategori; ?>"></div>
                                        </div>
                                        <!-- <div class="row form-group">
                                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Pilih Gambar</label></div>
                                            <div class="col-12 col-md-9"><input type="file" id="foto" name="foto" class="form-control-file" value="<?php echo $foto; ?>"></div>
                                        </div> -->
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Rating</label></div>
                                            <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="rating" placeholder="rating" class="form-control" value="<?php echo $rating; ?>"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Choose Product Image</label></div>
                                            <div class="col-12 col-md-9"><input type="file" id="foto" name="avatar" class="form-control-file" value="<?php echo $avatar; ?>"></div>
                                           
                                            <input type="text" id="id_produk" name="id_produk" hidden="hidden" value="<?php echo $id_produk; ?>">
                                            <input type="text" id="edit" name="edit" hidden="hidden" value="<?php echo $edit; ?>">
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
