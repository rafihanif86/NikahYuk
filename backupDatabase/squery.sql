SELECT * FROM produk P, kategori K WHERE p.`Category` = k.`Id_category` AND p.`Category` = ;
SELECT * FROM produk P, kategori K, vendor V WHERE p.Category = k.Id_category AND V.`Id_Vendor` = P.`Id_Vendor` ;
SELECT P.*,K.*,V.`Alamat_Vendor`,V.`Id_Admin`,V.`id_kategori`, V.`Id_Login`,V.`Nama_Vendor`,V.`Telp_Vendor` FROM produk P, kategori K, vendor V WHERE p.Category = k.Id_category AND V.`Id_Vendor` = P.`Id_Vendor`;
