<?php 
	$today = date("ymd");
	$query = "SELECT max(Id_Pemesanan) AS last FROM pemesanan WHERE Id_Pemesanan LIKE '$today%'";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$lastNoTransaksi = $data['last'];
 
	// baca nomor urut transaksi dari id transaksi terakhir
	$lastNoUrut = substr($lastNoTransaksi, 8, 4);
 
	// nomor urut ditambah 1
	$nextNoUrut = $lastNoUrut + 1;
 
	// membuat format nomor transaksi berikutnya
	$nextNoTransaksi= $today.sprintf('%04s', $nextNoUrut);
?>