/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.27 : Database - nikahyuk
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`nikahyuk` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `nikahyuk`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `Id_Admin` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Admin` varchar(50) NOT NULL,
  `Telp_Admin` varchar(12) NOT NULL,
  `Id_login` int(11) NOT NULL,
  PRIMARY KEY (`Id_Admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2147483647 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`Id_Admin`,`Nama_Admin`,`Telp_Admin`,`Id_login`) values (1,'Rafi','081394893398',1),(2,'mila','082233203907',1),(3,'ivfa','085755827424',1),(4,'bagus','081220875422',1);

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `Id_Customer` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Customer` varchar(50) NOT NULL,
  `Alamat_Customer` varchar(50) NOT NULL,
  `Telp_Customer` varchar(12) NOT NULL,
  PRIMARY KEY (`Id_Customer`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

insert  into `customer`(`Id_Customer`,`Nama_Customer`,`Alamat_Customer`,`Telp_Customer`) values (1,'silva','Jl.Semanggi Barat 15D Jatimulyo, Lowokwaru','085230431450'),(2,'ardian','Jl.Joyo Agung 33B Merjosari, Lowokwaru','081257547232');

/*Table structure for table `image` */

DROP TABLE IF EXISTS `image`;

CREATE TABLE `image` (
  `Id_Image` int(11) NOT NULL AUTO_INCREMENT,
  `Image_name` varbinary(100) NOT NULL,
  `Id_Owner` int(11) NOT NULL,
  `Owner` varbinary(10) NOT NULL,
  PRIMARY KEY (`Id_Image`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `image` */

insert  into `image`(`Id_Image`,`Image_name`,`Id_Owner`,`Owner`) values (1,'2-panggih-8-ngabekten-ppf-photography-and-videography-HJIsyGo2G.jpg',1,'produk'),(2,'2-panggih-7-dulangan-trevo-pictures-Sk35kGi2f.jpg',1,'produk'),(3,'anttijitters-SyGsFw22f.jpg',1,'produk'),(4,'2-panggih-4-bobot-timbang-iluminen2-H16VRbinz.jpg',1,'produk'),(5,'2-panggih-ngidak-tagan-iluminen-HJ6habo2z.jpg',1,'produk'),(6,'2-panggih-1-balangan-gantal-le-motion-S1MnpZihM.jpg',1,'produk'),(7,'davy4-rJJzwnp2M.jpg',1,'produk'),(8,'davy4-rJJzwnp2M.jpg',1,'produk'),(9,'5-adol-dawet-terralogical2-BJ0WT-o3z.png',1,'produk'),(10,'4-siraman-davy-linggar-SyT1aZo3G.jpg',1,'produk'),(11,'3-pasang-tuwuhanpyara-SkOanbshf.jpg',1,'produk'),(12,'2-ppf-kembar-mayang-SyD33Wj2z.jpg',1,'produk'),(13,'sasana krida um',1,'produk'),(14,'graha cakrawala',1,'produk');

/*Table structure for table `jadwal` */

DROP TABLE IF EXISTS `jadwal`;

CREATE TABLE `jadwal` (
  `Id_Jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Pemesanan` int(11) NOT NULL,
  `Tgl_Pemesanan` date NOT NULL,
  `Tgl_Pengerjaan` date NOT NULL,
  `Tgl_Acara` date NOT NULL,
  `Tgl_Selesai` date NOT NULL,
  PRIMARY KEY (`Id_Jadwal`),
  KEY `Fk_Jadwal_Relation_Pemesanan` (`Id_Pemesanan`),
  CONSTRAINT `FK_Jadwal_Pemesanan` FOREIGN KEY (`Id_Pemesanan`) REFERENCES `pemesanan` (`Id_Pemesanan`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jadwal` */

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `Id_category` int(11) NOT NULL AUTO_INCREMENT,
  `Category_Name` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`Id_category`,`Category_Name`) values (1,'Wedding Package'),(2,'Catering'),(3,'Wedding Organizer'),(4,'Hall Room'),(5,'Entertaiment'),(6,'Documentation');

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `Id_login` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`Id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `login` */

insert  into `login`(`Id_login`,`Username`,`Password`,`Status`) values (1,'rafi','rafi','admin'),(2,'vendor1','vendor1','vendor');

/*Table structure for table `pekerjaan_vendor` */

DROP TABLE IF EXISTS `pekerjaan_vendor`;

CREATE TABLE `pekerjaan_vendor` (
  `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) NOT NULL,
  `Nama_pekerjaan` varchar(100) NOT NULL,
  `tgl_memulai_pekerjaan` date NOT NULL,
  `tgl_pekerjaan_selesai` date DEFAULT NULL,
  `status_pekerjaan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_pekerjaan`),
  KEY `Fk_Pekerjaan_jadwal` (`id_jadwal`),
  CONSTRAINT `Fk_Pekerjaan_jadwal` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`Id_Jadwal`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pekerjaan_vendor` */

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `Id_Pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `Uang_Muka` int(11) NOT NULL,
  `Id_Pemesanan` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id_Pembayaran`),
  KEY `Fk_Pembayaran_Relation_Pemesanan` (`Id_Pemesanan`),
  CONSTRAINT `Fk_Pembayaran_Relation_Pemesanan` FOREIGN KEY (`Id_Pemesanan`) REFERENCES `pemesanan` (`Id_Pemesanan`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pembayaran` */

/*Table structure for table `pemesanan` */

DROP TABLE IF EXISTS `pemesanan`;

CREATE TABLE `pemesanan` (
  `Id_Pemesanan` int(11) NOT NULL AUTO_INCREMENT,
  `Harga_Produk` int(11) NOT NULL,
  `Status Pemesanan` tinyint(1) NOT NULL,
  `Id_Produk` int(11) NOT NULL,
  `Id_Customer` int(11) NOT NULL,
  PRIMARY KEY (`Id_Pemesanan`),
  KEY `Fk_Pemesanan_Relation_Produk` (`Id_Produk`),
  KEY `Fk_Pemesanan_Relation_Customer` (`Id_Customer`),
  CONSTRAINT `Fk_Pemesanan_Relation_Customer` FOREIGN KEY (`Id_Customer`) REFERENCES `customer` (`Id_Customer`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `Fk_Pemesanan_Relation_Produk` FOREIGN KEY (`Id_Produk`) REFERENCES `produk` (`Id_Produk`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pemesanan` */

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `Id_Produk` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Produk` varchar(50) NOT NULL,
  `Harga_Produk` int(11) NOT NULL,
  `Id_Vendor` int(11) NOT NULL,
  `Description` text,
  `Category` int(11) NOT NULL,
  `Ft_sampul_produk` varchar(100) DEFAULT NULL,
  `rating_prodak` int(1) DEFAULT NULL,
  PRIMARY KEY (`Id_Produk`),
  KEY `Fk_Produk_Relation_Vendor` (`Id_Vendor`),
  KEY `Fk_produk_kategori` (`Category`),
  CONSTRAINT `Fk_produk_kategori` FOREIGN KEY (`Category`) REFERENCES `kategori` (`Id_category`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `Fk_Produk_Relation_Vendor` FOREIGN KEY (`Id_Vendor`) REFERENCES `vendor` (`Id_Vendor`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `produk` */

insert  into `produk`(`Id_Produk`,`Nama_Produk`,`Harga_Produk`,`Id_Vendor`,`Description`,`Category`,`Ft_sampul_produk`,`rating_prodak`) values (1,'Pernikahan Adat jawa',11500000,1,'Pada setiap praktik upacara adat dan tak terkecuali pada rangkaian pernikahan adat Jawa, para calon mempelai mungkin sudah tidak asing dan bahkan hafal setiap runtutan prosesi yang akan mereka jalani. Namun, jangan sampai Anda menjalani rangkaian prosesi adat yang telah turun temurun diwariskan tersebut tanpa mengerti makna di baliknya. Di bawah ini, kami akan mengurutkan serta membahas rangkaian upacara pernikahan adat Jawa yang terbagi atas dua prosesi besar. Baik prosesi hajatan maupun prosesi panggih, keduanya memiliki sub-prosesi yang berisi tahapan ritual adat penuh makna.\r\n\r\nPROSESI HAJATAN\r\nSebagai prosesi persiapan dalam menyambut hari pernikahan, prosesi hajatan dilangsungkan dengan harapan seluruh keluarga besar dan calon pengantin yang akan melaksanakan hajat dijauhkan dari segala halangan dan seluruh acara berjalan dengan lancar.\r\n1. Pasang tratag dan tarub\r\nPemasangan tratag (dekorasi tenda) dan tarub (hiasan dari janur atau daun kelapa yang muda) yang dipajang sebagai hiasan pintu masuk ini menandai bahwa sang keluarga sedang mengadakan acara hajatan mantu. Adapun janur kuning melengkung sebagai pengharapan berkah dan kemakmuran bagi kedua mempelai layaknya meminta cahaya kepada Yang Maha Kuasa.\r\n2. Kembar mayang\r\nKali ini, ornamen yang dibentuk dari rangkaian akar, batang, daun, bunga, dan buah ini dipercayai dapat memberikan kebijaksanaan dan motivasi bagi kedua pengantin untuk menjalani kehidupan barunya dalam berumah tangga. Biasanya, daun-daun beraneka ragam akan ditekuk ke sebuah batang pisang sehingga menyerupai bentuk gunung, keris, cambuk, payung, belalang, dan burung.\r\n3. Pasang tuwuhan\r\nTuwuhan yang berarti tumbuh-tumbuhan ini diletakkan di tempat siraman. Anda juga dapat menambahkan buah-buahan seperti setandan pisang pada masing-masing sisi sebagai harapan agar sang pengantin kelak cepat memperoleh buah hati.\r\n4. Siraman\r\nSecara harafiah, siraman berarti mandi dengan air. Pada ritual ini, akan ada tujuh orang yang menyiramkan air ke sang pengantin. Nantinya, sang ayah mempelai wanitalah yang akan menyelesaikan ritual yang dilambangkan sebagai pembersihan diri sebelum menjalankan ritual selanjutnya yang lebih sakral. Selain bertugas mengakhiri siraman tersebut, sang ayah juga akan menggendong mempelai wanita menuju kamar pengantinnya.\r\n5. Adol dawet\r\nKemudian, kedua orang tua menyelenggarakan acara menjual dawet sebagai hidangan kepada para tamu undangan yang telah hadir menyaksikan prosesi yang telah berjalan. Tetapi, penjualan dawet ini tidak dibayar dengan uang, melainkan dengan kreweng atau pecahan tembikar dari tanah liat sebagai tanda bahwa pokok kehidupan berasal dari bumi. Di sini, sang ibu akan melayani para pembeli, sedangkan sang ayah akan memayungi sang ibu. Artinya adalah untuk memberikan contoh kepada anak-anaknya di kemudian hari bahwa mereka harus saling bergotong royong dalam membina rumah tangga.\r\n6. Potong tumpeng\r\nTumpeng merupakan sajian nasi berbentuk kerucut dengan aneka lauk pauk yang ditata mengelilinginya di atas nampan bulat yang terbuat dari anyaman bambu. Dalam ritual Jawa, tumpeng identik dengan simbol kemakmuran dan kesejahteraan karena bentuknya menyerupai gunung. Prosesi pemotongan tumpeng ini akan dilakukan oleh ayah dan ibu dengan mengambil bagian puncak tumpeng dan lauk pauknya.\r\n7. Dulangan pungkasan\r\nKemudian, acara dilanjutkan dengan prosesi suapan terakhir oleh ayah dan ibu kepada calon pengantin sebagai tanda tanggung jawab terakhir dari orang tua kepada anaknya yang akan menikah.\r\n8. Tanam rambut dan lepas ayam\r\nMenanamkan potongan rambut kedua calon mempelai bermaksud agar segala hal buruk dijauhkan dari rumah tangga kedua anaknya. Setelahnya akan dilanjutkan dengan pelepasan ayam jantan hitam yang menandai bahwa kedua orang tua telah mengikhlaskan anaknya hidup mandiri bagaikan seekor ayam yang sudah dapat mencari makanan sendiri.\r\n9. Midodareni\r\nArti kata midodareni sendiri adalah bidadari, sehingga harapan dari ritual malam sebelum melepas masa lajang ini adalah sang pengantin wanita akan terlihat cantik esok harinya bak bidadari dari surga. Pada malam ini, pengantin wanita akan ditemani oleh pihak keluarga saja dan dilarang bertemu oleh calon suaminya karena ia akan menerima nasehat-nasehat yang berkaitan dengan pernikahan.\r\n\r\n\r\nPROSESI PUNCAK:\r\n\r\nHari berikutnya adalah acara inti yang merupakan puncak dari seluruh rangkaian yang telah dijalankan. Di sini akan terselenggara upacara pernikahan serta resepsi pernikahan dan tentunya, terdapat ritual-ritual juga yang bertujuan untuk kebahagiaan hidup baru kedua mempelai dalam menjalani rumah tangganya.\r\n1. Upacara pernikahan.\r\nMomen ini adalah ketika kedua pengantin bersumpah di hadapan penghulu, orang tua, wali, dan tamu undangan untuk meresmikan pernikahan mereka secara keagamaan. Pada upacara ini, kedua pengantin akan mengenakan pakaian tradisional adat Jawa berwarna putih sebagai lambang kesucian.\r\n\r\n2. Upacara panggih:\r\nTahapan prosesi-prosesi berikut ini termasuk dalam upacara panggih yang berarti temu dalam bahasa Jawa, karena kedua pengantin yang telah resmi menikah akhirnya bertemu sebagai sepasang suami dan istri. Adapun rangkaian upacara ini berisi berbagai acara-acara yang akan memantapkan kedua mempelai dalam membina rumah tangganya.\r\na. Balangan gantal\r\nGantal atau sirih yang diikat oleh benang putih akan saling dilempar oleh kedua pasangan. Pengantin pria melemparkan gantal ke dada pengantin wanita sebagai tanda bahwa ia telah mengambil hati sang kekasih, dan pengantin wanita akan menujukan gantal ke lutut sang pria sebagai tanda bakti kepada suami.\r\nb. Ngidak tagan/nincak endog\r\nRitual menginjak sebutir telur ayam mentah oleh mempelai pria dilaksanakan sebagai harapan bahwa ia akan mendapatkan keturunan karena keduanya telah bersatu. Kemudian, sang istri akan membasuh kaki suaminya sebagai tanda kasih sayangnya.\r\nc. Sinduran\r\nKain sindur berwarna merah dan putih diharapkan akan memberikan keberanian bagi kedua pengantin agar menjalani pernikahan mereka dengan semangat dan penuh gairah. Pada ritual ini, keduanya akan dibalut oleh kain sindur sembari diantar menuju pelaminan oleh ayah sang mempelai wanita.\r\nd. Bobot timbang\r\nSetelah kedua pengantin duduk di kursi pelaminan, akan dilangsungkan ritual menimbang anak sendiri dan anak menantu oleh ayah pengantin wanita dengan cara memangku kedua mempelai. Kemudian, ibu pengantin akan naik ke atas panggung untuk menanyakan kepada sang ayah, siapa yang lebih berat di antara mereka. Kemudian, ayah akan menjawabnya jika keduanya sama beratnya. Dengan percakapan ini, diharapkan bahwa kedua anak mengetahui bahwa tidak ada perbedaan kasih sayang bagi mereka.\r\ne. Minum rujak degan\r\nSecara harafiah, rujak degan adalah minuman yang terbuat dari serutan kelapa muda. Tradisi minum air kelapa ini dilakukan secara bergilir dalam satu gelas untuk satu keluarga. Dimulai dari sang bapak untuk diteruskan kepada sang ibu sehingga diberikan kepada kedua pasang pengantin. Air kelapa ini dilambangkan sebagai air suci yang dapat membersihkan rohani seluruh anggota keluarga.\r\nf. Kacar kucur\r\nRitual ini dilakukan oleh pengantin pria yang mengucurkan uang logam beserta kebutuhan pokok seperti beras dan biji-bijian kepada sang istri sebagai simbol bahwa Ia akan bertanggung jawab dalam memberikan nafkah kepada keluarga.\r\ng. Dulangan\r\nAdapun ritual saling menyuapi sebanyak tiga kali sebagai simbol bahwa kedua pasangan akan selalu menolong satu sama lain dan juga saling memadu kasih hingga tua.\r\nh. Sungkeman\r\nSeluruh prosesi upacara dalam adat Jawa akan diakhiri dengan acara sungkeman, yaitu berlutut di depan kedua orang tua masing-masing mempelai sebagai bentuk penghormatan karena telah membesarkan mereka hingga akhirnya dapat menjalani kehidupan baru bersama pasangan.\r\n\r\nDemikianlah seluruh prosesi pernikahan adat Jawa beserta makna-makna tersiratnya. Seperti yang telah disebutkan di atas, maka kedua pasangan pengantin telah direstui pernikahannya jika sukses melewati tiap tahapan-tahapan dari prosesi hajatan hingga puncak.\r\n\r\nKami pun memperoleh tip tambahan dari Mita Hardo, yang telah menekuni prosesi pernikahan adat Jawa dengan merias dan membuat paes pengantin Jawa selama 10 tahun. Ia berbagi saran pada keluarga inti dan kedua calon mempelai agar prosesi acara berjalan lancar. \"Untuk kelancaran seluruh ritual, tip paling terutama tentunya dengan memohon doa kepada Tuhan agar segala persiapan dari acara hingga kehidupan berumah tangga dapat berjalan lancar. Namun, diperlukan juga kontribusi para expert yang dapat membantu kelancaran acara hajatan hinggah panggih. Sehingga, bijaklah dalam menentukan pemandu adat dan wedding organizer terpercaya yang dapat didelegasikan penuh pada hari H. Bagi saya sendiri, kedua pengantin dan keluarga adalah bintang dalam perayaan tersebut di mana mereka tidak perlu memikirkan hal lain di luar makna dalam ritual-ritual adat yang dijalankan,\" MIta menjelaskan.\r\n\r\n',1,'panduan-rangkaian-prosesi-pernikahan-adat-jawa-beserta-makna-di-balik-setiap-ritualnya-3.jpg',4),(2,'Sasana Krida UM',7500000,6,'Fasilitas: \r\nAC 4 unit, \r\nSound system 5000 watt 2 mic, \r\nLCD Projectors 2 buah, \r\nScreen LCD 2 buah, meja panjang 9 buah, \r\n200 kursi, \r\nGenset, \r\nTeknisi 2 orang, \r\nCleaning Service 2 orang, \r\nSecurity 6 orang. \r\nWaktu pemakaian sesi 1: 07.00-14.00 sesi 2: 15.00-22.00. \r\nTamu>1000.',4,'sasana krida um',4),(3,'Graha Cakrawala UM',50000000,6,'Graha Cakrawala terletak di Jl. Cakrawala kompleks Kampus Induk UM. \r\nGedung dengan luas bangunan sekitar 3.800 m2 mampu menampung undangan sekitar 5.500 orang \r\n(kapsitas hall: 2.000 s/d 2.500 orang serta tribun dan balkon: 3.000 orang.',4,'graha cakrawala',4);

/*Table structure for table `slider_vendor` */

DROP TABLE IF EXISTS `slider_vendor`;

CREATE TABLE `slider_vendor` (
  `id_slider` int(11) NOT NULL AUTO_INCREMENT,
  `ft_background` varbinary(100) NOT NULL,
  `ft_depan` varchar(100) NOT NULL,
  `ft_kanan` varchar(100) NOT NULL,
  `ft_kiri` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Harga_termurah` int(11) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `Ft_sampul_vendor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_slider`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `slider_vendor` */

insert  into `slider_vendor`(`id_slider`,`ft_background`,`ft_depan`,`ft_kanan`,`ft_kiri`,`status`,`id_vendor`,`Rating`,`Harga_termurah`,`keterangan`,`Ft_sampul_vendor`) values (1,'bali-vip-wedding-organizer-provide.jpg','aeug8kj876x7122120151402.jpg','pelaminan-pekanbaru.jpg','Resepsi1.jpg',1,3,4,5000000,'WO terbaik di Kota Malang',NULL);

/*Table structure for table `vendor` */

DROP TABLE IF EXISTS `vendor`;

CREATE TABLE `vendor` (
  `Id_Vendor` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Login` int(11) NOT NULL,
  `Nama_Vendor` varchar(50) NOT NULL,
  `Alamat_Vendor` varchar(100) NOT NULL,
  `Telp_Vendor` varchar(12) NOT NULL,
  `Id_Admin` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  PRIMARY KEY (`Id_Vendor`),
  KEY `Fk_Vendor_Relation_Admin` (`Id_Admin`),
  CONSTRAINT `Fk_Vendor_Relation_Admin` FOREIGN KEY (`Id_Admin`) REFERENCES `admin` (`Id_Admin`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `vendor` */

insert  into `vendor`(`Id_Vendor`,`Id_Login`,`Nama_Vendor`,`Alamat_Vendor`,`Telp_Vendor`,`Id_Admin`,`id_kategori`) values (1,2,'Princess Wedding Organizer','Jl.Kelengkeng 5 Bareng, Klojen ','0341 565367',1,3),(2,2,'My Story Event Organizer','Jl.Borobudur 3G Mojolangu, Lowokwaru','08121745428',1,3),(3,2,'Gracia Event Organizer','Jl.Kesumba Dalam 11A Jatimulyo, Lowokwaru','0341 498466',1,3),(4,2,'VIP Event Organizer','Jl.Seram 06 Kasin, Klojen','0341 362844',1,3),(5,2,'Eleanoore Wedding Organizer','Griya Santa L-3 07 Mojolangu, Lowokwaru','081357010132',1,3),(6,2,'Wisma Rias & WO','Jl.Sulfat Agung V 6 Purwantoro, Blimbing','08123315551',1,3),(7,2,'Global 99 Wedding','Jl.Tumenggung Ssuryo 11 Kota Malang','341',1,3);

/*Table structure for table `view_produk` */

DROP TABLE IF EXISTS `view_produk`;

/*!50001 DROP VIEW IF EXISTS `view_produk` */;
/*!50001 DROP TABLE IF EXISTS `view_produk` */;

/*!50001 CREATE TABLE  `view_produk`(
 `Id_Produk` int(11) ,
 `Nama_Produk` varchar(50) ,
 `Harga_Produk` int(11) ,
 `Id_Vendor` int(11) ,
 `Description` text ,
 `Category` int(11) ,
 `Ft_sampul_produk` varchar(100) ,
 `rating_prodak` int(1) ,
 `Id_category` int(11) ,
 `Category_Name` varchar(20) ,
 `Alamat_Vendor` varchar(100) ,
 `Id_Admin` int(11) ,
 `id_kategori` int(11) ,
 `Id_Login` int(11) ,
 `Nama_Vendor` varchar(50) ,
 `Telp_Vendor` varchar(12) 
)*/;

/*View structure for view view_produk */

/*!50001 DROP TABLE IF EXISTS `view_produk` */;
/*!50001 DROP VIEW IF EXISTS `view_produk` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_produk` AS (select `p`.`Id_Produk` AS `Id_Produk`,`p`.`Nama_Produk` AS `Nama_Produk`,`p`.`Harga_Produk` AS `Harga_Produk`,`p`.`Id_Vendor` AS `Id_Vendor`,`p`.`Description` AS `Description`,`p`.`Category` AS `Category`,`p`.`Ft_sampul_produk` AS `Ft_sampul_produk`,`p`.`rating_prodak` AS `rating_prodak`,`k`.`Id_category` AS `Id_category`,`k`.`Category_Name` AS `Category_Name`,`v`.`Alamat_Vendor` AS `Alamat_Vendor`,`v`.`Id_Admin` AS `Id_Admin`,`v`.`id_kategori` AS `id_kategori`,`v`.`Id_Login` AS `Id_Login`,`v`.`Nama_Vendor` AS `Nama_Vendor`,`v`.`Telp_Vendor` AS `Telp_Vendor` from ((`produk` `p` join `kategori` `k`) join `vendor` `v`) where ((`p`.`Category` = `k`.`Id_category`) and (`v`.`Id_Vendor` = `p`.`Id_Vendor`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
