/*
SQLyog Ultimate
MySQL - 10.5.9-MariaDB-log : Database - simpenin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`simpenin` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

/*Table structure for table `gudang` */

DROP TABLE IF EXISTS `gudang`;

CREATE TABLE `gudang` (
  `id_gudang` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama_gudang` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `fasilitas` text DEFAULT NULL,
  `luas` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_gudang`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `gudang` */

insert  into `gudang`(`id_gudang`,`id_user`,`nama_gudang`,`alamat`,`fasilitas`,`luas`,`deskripsi`,`gambar`,`created_at`,`updated_at`) values (1,1,'Gudang Kiti','Jl.Tuanku Tambusai, Kumu, Rokan Hulu','[\"Rutin Dibersihkan\",\"CCTV 24 Jam\",\"Lokasi Strategis\"]',1000,'Ut volutpat lobortis faucibus. Nunc faucibus elit eu ligula efficitur, eget rhoncus velit porttitor. Nunc consectetur nec metus in tincidunt. Morbi facilisis venenatis lectus ac condimentum. Vivamus ultricies bibendum urna quis cursus. Donec molestie purus ut condimentum posuere. Duis imperdiet quam eu diam tincidunt, ut rhoncus enim maximus. Pellentesque justo orci, suscipit nec finibus non, finibus posuere dui. Morbi scelerisque hendrerit libero, non tincidunt dolor varius at. In hac habitasse platea dictumst. Ut fermentum egestas dolor, vel ultrices massa posuere vel. Fusce tempus aliquet scelerisque.','1656771870_9621aaf6d6d637447186.jpg','2022-07-02 08:25:26','2022-07-04 13:12:49');
insert  into `gudang`(`id_gudang`,`id_user`,`nama_gudang`,`alamat`,`fasilitas`,`luas`,`deskripsi`,`gambar`,`created_at`,`updated_at`) values (2,1,'Gudang Trenten','Jl.Tuanku Tambusai, Kumu, Rokan Hulu','[\"Rutin Dibersihkan\",\"CCTV 24 Jam\"]',2000000,'Ut ut eros in quam semper consequat. Vivamus vestibulum tempus massa vitae scelerisque. Quisque sed enim dolor. Sed rhoncus vel augue maximus eleifend. Nulla facilisi. Donec tempor vulputate magna, id ultrices leo auctor non. Proin id urna quis tortor condimentum porta. Vivamus interdum rutrum urna quis fringilla. Quisque a imperdiet justo.','1656769857_de4ce80afc4a669c8b43.jpg','2022-07-02 08:50:57','2022-07-04 13:12:38');
insert  into `gudang`(`id_gudang`,`id_user`,`nama_gudang`,`alamat`,`fasilitas`,`luas`,`deskripsi`,`gambar`,`created_at`,`updated_at`) values (3,1,'Gudang Kirana','Pekanbaru, Riau','[\"Rutin Dibersihkan\",\"CCTV 24 Jam\",\"Lokasi Strategis\"]',500,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut vestibulum ex, non placerat sem. Etiam euismod faucibus dolor, eget ultricies risus. Maecenas suscipit ipsum id mi venenatis, in blandit mi tempor. Nullam tempor elit vel elementum tempor. Curabitur pulvinar turpis leo. Mauris ornare ut dui sed malesuada. Vestibulum dignissim molestie vehicula. Suspendisse porta lacinia convallis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc ut molestie risus.','1656771845_26df3cda68f4e8087428.jpg','2022-07-02 08:54:15','2022-07-04 13:12:28');
insert  into `gudang`(`id_gudang`,`id_user`,`nama_gudang`,`alamat`,`fasilitas`,`luas`,`deskripsi`,`gambar`,`created_at`,`updated_at`) values (4,1,'Gudang Cirasa','Jln Lintas Timur Pekanbaru','[\"Rutin Dibersihkan\",\"CCTV 24 Jam\"]',1500000,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis at ipsum sit amet metus vestibulum aliquet. Nullam pharetra vel eros id dignissim. Aenean tristique lectus nec auctor sagittis. Maecenas bibendum, ex non aliquet vestibulum, metus leo ullamcorper ante, eu consequat diam libero ut orci. Morbi fringilla lorem in ligula mattis tincidunt. Duis ut facilisis massa. Mauris pulvinar, dui at facilisis imperdiet, tellus nisi cursus justo, quis molestie neque nisl ullamcorper diam. Sed elementum imperdiet massa sed maximus. Vestibulum scelerisque tincidunt aliquet. Mauris feugiat rutrum dolor. Aliquam erat volutpat. In justo sem, tristique sit amet aliquam non, tempor vitae justo. Nunc bibendum tincidunt arcu. Pellentesque a eleifend arcu, eget posuere urna. Integer commodo ullamcorper mauris vel facilisis. Morbi vel metus ut sem maximus pharetra.','1656818249_6b4a50c453f8a66ce31b.jpg','2022-07-02 22:17:29','2022-07-03 23:16:01');
insert  into `gudang`(`id_gudang`,`id_user`,`nama_gudang`,`alamat`,`fasilitas`,`luas`,`deskripsi`,`gambar`,`created_at`,`updated_at`) values (5,4,'Gudang A','Jakarta','[\"Rutin Dibersihkan\",\"CCTV 24 Jam\"]',300000,'Hanya menampung apa saja','1657127136_b3c6551b92aae6acdf6b.jpg','2022-07-06 12:05:36','2022-07-06 12:07:55');

/*Table structure for table `kirim` */

DROP TABLE IF EXISTS `kirim`;

CREATE TABLE `kirim` (
  `id_kirim` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `ukuran` bigint(20) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `metode_bayar` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_kirim`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `kirim` */

insert  into `kirim`(`id_kirim`,`id_user`,`id_transaksi`,`ukuran`,`harga`,`penerima`,`alamat`,`created_at`,`updated_at`,`metode_bayar`) values (12,1,1,14400,288000,'Pak Didik','Pekanbaru, Riau','2022-07-05 22:00:27','2022-07-05 22:00:27','bni');
insert  into `kirim`(`id_kirim`,`id_user`,`id_transaksi`,`ukuran`,`harga`,`penerima`,`alamat`,`created_at`,`updated_at`,`metode_bayar`) values (13,4,4,805000,16100000,'Pak Joko','Kuningan, Jakarta','2022-07-06 11:58:28','2022-07-06 11:58:28','bni');
insert  into `kirim`(`id_kirim`,`id_user`,`id_transaksi`,`ukuran`,`harga`,`penerima`,`alamat`,`created_at`,`updated_at`,`metode_bayar`) values (14,4,4,80500,1610000,'Pak Didi','Rantau, Jakarta','2022-07-06 12:02:58','2022-07-06 12:02:58','bri');
insert  into `kirim`(`id_kirim`,`id_user`,`id_transaksi`,`ukuran`,`harga`,`penerima`,`alamat`,`created_at`,`updated_at`,`metode_bayar`) values (15,5,5,19800,45000,'Pak Joko','Jakarta','2022-07-07 10:04:48','2022-07-07 10:04:48','bri');
insert  into `kirim`(`id_kirim`,`id_user`,`id_transaksi`,`ukuran`,`harga`,`penerima`,`alamat`,`created_at`,`updated_at`,`metode_bayar`) values (16,5,5,660,45000,'Pak Joko','Jakarta','2022-07-07 10:06:05','2022-07-07 10:06:05','gopay');

/*Table structure for table `kirim_detail` */

DROP TABLE IF EXISTS `kirim_detail`;

CREATE TABLE `kirim_detail` (
  `id_kirim_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_kirim` int(11) DEFAULT NULL,
  `id_transaksi_detail` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kirim_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `kirim_detail` */

insert  into `kirim_detail`(`id_kirim_detail`,`id_kirim`,`id_transaksi_detail`,`qty`) values (7,12,17,2);
insert  into `kirim_detail`(`id_kirim_detail`,`id_kirim`,`id_transaksi_detail`,`qty`) values (8,13,19,10);
insert  into `kirim_detail`(`id_kirim_detail`,`id_kirim`,`id_transaksi_detail`,`qty`) values (9,13,20,5);
insert  into `kirim_detail`(`id_kirim_detail`,`id_kirim`,`id_transaksi_detail`,`qty`) values (10,14,19,2);
insert  into `kirim_detail`(`id_kirim_detail`,`id_kirim`,`id_transaksi_detail`,`qty`) values (11,14,20,1);
insert  into `kirim_detail`(`id_kirim_detail`,`id_kirim`,`id_transaksi_detail`,`qty`) values (12,15,23,12);
insert  into `kirim_detail`(`id_kirim_detail`,`id_kirim`,`id_transaksi_detail`,`qty`) values (13,16,23,2);

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_gudang` int(11) DEFAULT NULL,
  `ukuran` double NOT NULL COMMENT 'cm2',
  `jenis` varchar(50) DEFAULT NULL COMMENT 'simpan,kirim',
  `status` int(11) NOT NULL COMMENT '1 = masih proses',
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `metode_bayar` varchar(20) DEFAULT NULL,
  `bayar` double DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `total_bayar` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id_transaksi`,`id_user`,`id_gudang`,`ukuran`,`jenis`,`status`,`tgl_mulai`,`tgl_selesai`,`metode_bayar`,`bayar`,`diskon`,`total_bayar`,`created_at`,`updated_at`) values (1,1,2,73520,'simpan',1,'2022-07-05','2022-06-28','gopay',NULL,NULL,NULL,'2022-07-03 23:31:34','2022-07-05 22:00:51');
insert  into `transaksi`(`id_transaksi`,`id_user`,`id_gudang`,`ukuran`,`jenis`,`status`,`tgl_mulai`,`tgl_selesai`,`metode_bayar`,`bayar`,`diskon`,`total_bayar`,`created_at`,`updated_at`) values (4,4,2,761400,'simpan',1,'2022-07-06','2023-07-06','bri',NULL,NULL,NULL,'2022-07-06 11:48:19','2022-07-06 12:02:58');
insert  into `transaksi`(`id_transaksi`,`id_user`,`id_gudang`,`ukuran`,`jenis`,`status`,`tgl_mulai`,`tgl_selesai`,`metode_bayar`,`bayar`,`diskon`,`total_bayar`,`created_at`,`updated_at`) values (5,5,4,183460,'simpan',1,'2022-07-07','2022-07-22','bri',25900,2590,23310,'2022-07-06 12:27:07','2022-07-07 10:06:05');
insert  into `transaksi`(`id_transaksi`,`id_user`,`id_gudang`,`ukuran`,`jenis`,`status`,`tgl_mulai`,`tgl_selesai`,`metode_bayar`,`bayar`,`diskon`,`total_bayar`,`created_at`,`updated_at`) values (6,5,3,0,'simpan',0,NULL,NULL,NULL,NULL,NULL,NULL,'2022-07-07 02:51:36','2022-07-07 02:51:36');

/*Table structure for table `transaksi_detail` */

DROP TABLE IF EXISTS `transaksi_detail`;

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `panjang` int(11) DEFAULT NULL,
  `lebar` int(11) DEFAULT NULL,
  `tinggi` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi_detail`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_detail` */

insert  into `transaksi_detail`(`id_transaksi_detail`,`id_transaksi`,`nama_barang`,`panjang`,`lebar`,`tinggi`,`catatan`,`qty`,`satuan`,`gambar`) values (14,1,'Tusu Sate',30,20,30,'mudah bengkok',1,'Pack','1656916810_f03d8ca92a4ddf085b9b.png');
insert  into `transaksi_detail`(`id_transaksi_detail`,`id_transaksi`,`nama_barang`,`panjang`,`lebar`,`tinggi`,`catatan`,`qty`,`satuan`,`gambar`) values (15,1,'Sendok Makan',23,40,1,'',1,'Pack','1656916861_e988e2db8eebc236d0b5.png');
insert  into `transaksi_detail`(`id_transaksi_detail`,`id_transaksi`,`nama_barang`,`panjang`,`lebar`,`tinggi`,`catatan`,`qty`,`satuan`,`gambar`) values (16,1,'Plastik PE',100,30,10,'testing',2,'Pack','1656919697_2fd7e3499df951e8671a.png');
insert  into `transaksi_detail`(`id_transaksi_detail`,`id_transaksi`,`nama_barang`,`panjang`,`lebar`,`tinggi`,`catatan`,`qty`,`satuan`,`gambar`) values (17,1,'Plastik Tomat',20,30,10,'',10,'Pack','1656939568_5400250f80f6ed210d1d.png');
insert  into `transaksi_detail`(`id_transaksi_detail`,`id_transaksi`,`nama_barang`,`panjang`,`lebar`,`tinggi`,`catatan`,`qty`,`satuan`,`gambar`) values (18,2,'Johnny yes papa',10,20,30,'Oke',20,'Pack','1656985719_3b406774dc2f519c3438.jpg');
insert  into `transaksi_detail`(`id_transaksi_detail`,`id_transaksi`,`nama_barang`,`panjang`,`lebar`,`tinggi`,`catatan`,`qty`,`satuan`,`gambar`) values (19,4,'Nasi Ramas',200,20,10,'Rapuh',8,'Pack','1657126200_def92187a4c229b6e47c.jpg');
insert  into `transaksi_detail`(`id_transaksi_detail`,`id_transaksi`,`nama_barang`,`panjang`,`lebar`,`tinggi`,`catatan`,`qty`,`satuan`,`gambar`) values (20,4,'Aqua',10,2,50,'',4,'Pack','1657126233_0ee791e1c5e403a88c45.jpg');
insert  into `transaksi_detail`(`id_transaksi_detail`,`id_transaksi`,`nama_barang`,`panjang`,`lebar`,`tinggi`,`catatan`,`qty`,`satuan`,`gambar`) values (22,5,'Send Doc',10,20,10,'kaskaskddddd',10,'Pack','1657128966_f4734bc637c28d8accfd.png');
insert  into `transaksi_detail`(`id_transaksi_detail`,`id_transaksi`,`nama_barang`,`panjang`,`lebar`,`tinggi`,`catatan`,`qty`,`satuan`,`gambar`) values (23,5,'Foto Dokter',10,11,100,'foto dokter oke ',1,'Pack','1657180366_48baa28f3002ece1533f.jpg');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto_profil` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `login_at` datetime DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `telp` varchar(16) DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `alamat_penerima` text DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`nama`,`username`,`email`,`password`,`foto_profil`,`alamat`,`created_at`,`updated_at`,`login_at`,`tempat_lahir`,`tanggal_lahir`,`telp`,`penerima`,`alamat_penerima`) values (1,'Vanrezky','van','vanrezkysadewa77@gmail.com','$2y$10$mTENdxIhf.NtiII1xufxxeScYYmRsj114VLzVENZbSw.ojkvHDXjS','1656749223_57e6e53bcbda9abd8be3.jpg','Jln Soebrantas Panam, Pekanbaru','2022-07-01 23:55:42','2022-07-07 21:10:21','2022-07-07 21:10:21','Rumbai','2022-07-02','082268262017','Pak Didik','Pekanbaru, Riau');
insert  into `user`(`id_user`,`nama`,`username`,`email`,`password`,`foto_profil`,`alamat`,`created_at`,`updated_at`,`login_at`,`tempat_lahir`,`tanggal_lahir`,`telp`,`penerima`,`alamat_penerima`) values (2,'Van Rezky Sadewa Nababan S.Kom','vangci','vanrezkysadewa88@gmail.com','$2y$10$15fLH0U.5c9gSl3MymQeX.iyTg9cKZ0VLYni2N6JO0m3ymmItBj4O',NULL,NULL,'2022-07-01 12:23:27','2022-07-01 12:23:27',NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `user`(`id_user`,`nama`,`username`,`email`,`password`,`foto_profil`,`alamat`,`created_at`,`updated_at`,`login_at`,`tempat_lahir`,`tanggal_lahir`,`telp`,`penerima`,`alamat_penerima`) values (3,'Rindi','rindi','rindi@gmail.com','$2y$10$yJ5ZCVaHLpJILlv8D5LaOO5wTei5MNfRc5gZzQXf1e8hL/u6JN6Dm',NULL,NULL,'2022-07-01 12:24:34','2022-07-02 00:24:50','2022-07-02 00:24:50',NULL,NULL,NULL,NULL,NULL);
insert  into `user`(`id_user`,`nama`,`username`,`email`,`password`,`foto_profil`,`alamat`,`created_at`,`updated_at`,`login_at`,`tempat_lahir`,`tanggal_lahir`,`telp`,`penerima`,`alamat_penerima`) values (4,'Ridwan','akun1','ridwan@gmail.com','$2y$10$rFI5KlWpAwXp62CfZMU5f.kbfvFxmKCVcmm6yY2.CX3U1lloL0Nf2','1657127315_c70806d913163c5eecd8.jpg','Jakarta','2022-07-06 01:04:07','2022-07-06 12:09:05','2022-07-06 13:04:16',NULL,NULL,NULL,'Pak Didi','Rantau, Jakarta');
insert  into `user`(`id_user`,`nama`,`username`,`email`,`password`,`foto_profil`,`alamat`,`created_at`,`updated_at`,`login_at`,`tempat_lahir`,`tanggal_lahir`,`telp`,`penerima`,`alamat_penerima`) values (5,'Haidar','haidar','haidar@gmail.com','$2y$10$WknZQTFL5dGWVA6ktQoX.ulZCyS.h9fXiM6z2PHsz4qPXPm/0ZyQO','1657127555_2caa03e264eb920eaf82.jpg','lorem ipsum doner donar','2022-07-06 12:11:09','2022-07-07 10:04:42','2022-07-07 21:14:00',NULL,NULL,NULL,'Pak Joko','Jakarta');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
