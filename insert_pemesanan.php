<?php
    include 'connection.php';
    include 'noTrans.php';

    $id_produk=$_GET["id_produk"];
    $id_cus=$_GET["id_cus"];
    $date=$_GET["date"];
    $dateNow = date('d-m-Y');
    
    $dateStart = date('Y-m-d', strtotime('-2 days', strtotime($date)));
    $dateEnd = date('Y-m-d', strtotime('+2 days', strtotime($date)));

    if($id_produk != null){
        $query1="INSERT INTO pemesanan (Id_Pemesanan,Status,Id_Produk,Id_Customer) VALUES ('".$nextNoTransaksi."',1,'".$id_produk."','".$id_cus."');";
        $insert_pemesanan = mysql_query($query1,$conn);
        if($insert_pemesanan){
            $query2="INSERT INTO jadwal (Id_Pemesanan,Tgl_Pemesanan,Tgl_Pengerjaan,Tgl_Acara,Tgl_Selesai) VALUES ('".$nextNoTransaksi."','".$dateNow."','".$dateStart."','".$date."','".$dateEnd."');";
            $insert_jadwal = mysql_query($query2,$conn);
            if($insert_jadwal){
                echo "<script>alert('Data Berhasil Ditambahkan')
                    location.replace('index.php?id_cus=$id_cus&tgl=$date')</script>";
            }else{
                echo "<script>alert('Data Gagal Ditambahkan di tabel jadwal')
                location.replace('index.php?id_cus=$id_cus&tgl=$date')</script>";
            }
        }else{
            echo "<script>alert('Data Gagal Ditambahkan di tabel pemesanan')
                location.replace('index.php?id_cus=$id_cus&tgl=$date')</script>";
        }
    }else{
        echo "<script>alert('Id Produk kosong')
                location.replace('index.php?id_cus=$id_cus&tgl=$date')</script>";
    }
?>