INSERT INTO login (Username,PASSWORD,Email_login,STATUS)VALUES('','','','');
INSERT INTO customer`login``admin` (Email_Customer) VALUES ('');
SELECT * FROM vendor WHERE `Nama_Vendor` LIKE '%%' OR `Alamat_Vendor` LIKE '%%' OR `Telp_Vendor` LIKE '%%' OR `Email_vendor` LIKE '%%' OR `Instagram` LIKE '%%';
SELECT * FROM slider_vendor S, vendor V, kategori K WHERE s.`status` = 1 AND s.`id_vendor` = v.`Id_Vendor` AND v.`id_kategori` = k.`Id_category`;
DELETE FROM login WHERE Id_login = 17;