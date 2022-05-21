-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2022 at 05:56 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `incarrival`
--

CREATE TABLE `incarrival` (
  `id_arrival` varchar(255) NOT NULL,
  `date_arrived` datetime NOT NULL,
  `email_tenant` varchar(255) NOT NULL,
  `id_po` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `incarrivalproduct`
--

CREATE TABLE `incarrivalproduct` (
  `id_arrivalproduct` int(11) NOT NULL,
  `id_poproduct` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_arrival` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `incpurchaseorder`
--

CREATE TABLE `incpurchaseorder` (
  `id_po` int(11) NOT NULL,
  `invoice_po` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `createdby` varchar(255) NOT NULL,
  `email_tenant` varchar(255) NOT NULL,
  `shipping_cost` decimal(10,0) DEFAULT NULL,
  `delivery_status` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `date_due` datetime DEFAULT NULL,
  `payment_price` decimal(10,0) DEFAULT NULL,
  `id_supplier` int(11) NOT NULL,
  `tax_cost` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `incpurchaseorder`
--

INSERT INTO `incpurchaseorder` (`id_po`, `invoice_po`, `date_created`, `createdby`, `email_tenant`, `shipping_cost`, `delivery_status`, `payment_status`, `date_due`, `payment_price`, `id_supplier`, `tax_cost`) VALUES
(19, '', '0000-00-00 00:00:00', 'a@a', '220511-191240', '0', 'Done', 'Paid', '0000-00-00 00:00:00', NULL, 4, '0'),
(20, '', '0000-00-00 00:00:00', 'a@a', '220511-191240', '0', 'Done', 'Paid', '0000-00-00 00:00:00', NULL, 4, '0'),
(21, '1652506084', '0000-00-00 00:00:00', 'a@a', '220511-191240', '0', 'Done', 'Paid', '0000-00-00 00:00:00', NULL, 4, '0'),
(22, '220514-073024', '0000-00-00 00:00:00', 'a@a', '220511-191240', '0', 'Done', 'Paid', '0000-00-00 00:00:00', NULL, 4, '0'),
(23, '220514-104815', '0000-00-00 00:00:00', 'a@a', '220511-191240', '0', 'Done', 'Paid', '0000-00-00 00:00:00', NULL, 4, '0'),
(24, '220514-104938', '0000-00-00 00:00:00', 'a@a', '220511-191240', '0', 'Done', 'Debt', '0000-00-00 00:00:00', NULL, 4, '0'),
(25, '220514-105127', '0000-00-00 00:00:00', 'a@a', '220511-191240', '0', 'Done', 'Debt', '0000-00-00 00:00:00', NULL, 4, '0'),
(26, '111', '0000-00-00 00:00:00', 'anggaagustira@gmail.com', '220519-090450', '0', 'On Going', 'Paid', '0000-00-00 00:00:00', NULL, 5, '0');

-- --------------------------------------------------------

--
-- Table structure for table `incpurchaseorderproduct`
--

CREATE TABLE `incpurchaseorderproduct` (
  `id_poproduct` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `id_po` int(11) DEFAULT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` decimal(10,0) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `expired_date` datetime DEFAULT NULL,
  `storage` varchar(255) DEFAULT NULL,
  `sku` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `incpurchaseorderproduct`
--

INSERT INTO `incpurchaseorderproduct` (`id_poproduct`, `date_created`, `id_po`, `id_product`, `quantity`, `purchase_price`, `subtotal`, `expired_date`, `storage`, `sku`) VALUES
(9, '0000-00-00 00:00:00', 20, 20, 33, '400000', '13200000', '0000-00-00 00:00:00', '', '220513-081836'),
(10, '0000-00-00 00:00:00', 20, 19, 1, '6800000', '6800000', '0000-00-00 00:00:00', '', '220512-035448'),
(11, '0000-00-00 00:00:00', 20, 21, 33, '100000', '3300000', '0000-00-00 00:00:00', '', '220513-083802'),
(12, '0000-00-00 00:00:00', 21, 19, 2, '6800000', '13600000', '0000-00-00 00:00:00', '', '220512-035448'),
(13, '0000-00-00 00:00:00', 21, 20, 33, '450000', '13200000', '0000-00-00 00:00:00', '', '220513-081836'),
(14, '0000-00-00 00:00:00', 21, 21, 3, '100000', '300000', '0000-00-00 00:00:00', '', '220513-083802'),
(15, '0000-00-00 00:00:00', 22, 19, 1, '6800000', '6800000', '0000-00-00 00:00:00', '', '220512-035448'),
(16, '0000-00-00 00:00:00', 22, 21, 10, '200000', '2000000', '0000-00-00 00:00:00', '', '220513-083802'),
(17, '0000-00-00 00:00:00', 22, 20, 10, '400000', '4000000', '0000-00-00 00:00:00', '', '220513-081836'),
(18, '0000-00-00 00:00:00', 23, 19, 2, '6800000', '13600000', '0000-00-00 00:00:00', '', '220512-035448'),
(19, '0000-00-00 00:00:00', 23, 20, 2, '400000', '800000', '0000-00-00 00:00:00', '', '220513-081836'),
(20, '0000-00-00 00:00:00', 24, 19, 2, '6800000', '13600000', '0000-00-00 00:00:00', '', '220512-035448'),
(21, '0000-00-00 00:00:00', 24, 20, 2, '400000', '800000', '0000-00-00 00:00:00', '', '220513-081836'),
(22, '0000-00-00 00:00:00', 25, 19, 2, '6800000', '13600000', '0000-00-00 00:00:00', '', '220512-035448'),
(23, '0000-00-00 00:00:00', 25, 20, 2, '400000', '800000', '0000-00-00 00:00:00', '', '220513-081836'),
(24, '0000-00-00 00:00:00', 26, 25, 1, '1500', '1500', '0000-00-00 00:00:00', '', '220519-092153');

-- --------------------------------------------------------

--
-- Table structure for table `invputaway`
--

CREATE TABLE `invputaway` (
  `id_putaway` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `invputawayproduct`
--

CREATE TABLE `invputawayproduct` (
  `id_putawayproduct` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_expired` datetime DEFAULT NULL,
  `id_putaway` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `invstockopname`
--

CREATE TABLE `invstockopname` (
  `id_stockopname` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `createdby` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `mascourier`
--

CREATE TABLE `mascourier` (
  `id_courier` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mascourier`
--

INSERT INTO `mascourier` (`id_courier`, `name`) VALUES
(1, 'Anatar Sendiri'),
(2, 'JNE'),
(3, 'NCS'),
(4, 'Sicepat');

-- --------------------------------------------------------

--
-- Table structure for table `mascustomer`
--

CREATE TABLE `mascustomer` (
  `id_customer` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_customertype` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_tenant` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mascustomer`
--

INSERT INTO `mascustomer` (`id_customer`, `name`, `id_customertype`, `address`, `phone_number`, `email`, `email_tenant`, `status`) VALUES
(8, 'Cust 1', 1, '', '', '', '220513-151635', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `mascustomertype`
--

CREATE TABLE `mascustomertype` (
  `Id_CustomerType` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mascustomertype`
--

INSERT INTO `mascustomertype` (`Id_CustomerType`, `name`) VALUES
(1, 'Reguler'),
(2, 'Dropshipper'),
(3, 'Distributor');

-- --------------------------------------------------------

--
-- Table structure for table `masemployee`
--

CREATE TABLE `masemployee` (
  `id_employee` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_tenant` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `masemployee`
--

INSERT INTO `masemployee` (`id_employee`, `name`, `email`, `email_tenant`, `picture`, `status`, `address`, `phone_number`) VALUES
(8, 'Faris', 'f@f', '220511-191240', 'default-avatar.png', 'active', '', ''),
(10, 'danggo', 'danggo@gmail.com', '220519-090450', 'employee-10.png', 'active', 'bokas', '08222222222'),
(11, 'danggu', 'danggu@gmail.com', '220519-090450', 'employee-4.png', 'active', 'bokas', '08222222');

-- --------------------------------------------------------

--
-- Table structure for table `masmarketplace`
--

CREATE TABLE `masmarketplace` (
  `id_marketplace` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `masmarketplace`
--

INSERT INTO `masmarketplace` (`id_marketplace`, `name`) VALUES
(1, 'Tokopedia'),
(2, 'Bukalapak');

-- --------------------------------------------------------

--
-- Table structure for table `maspiutang`
--

CREATE TABLE `maspiutang` (
  `id_piutang` int(11) NOT NULL,
  `invoice_so` varchar(255) NOT NULL,
  `total_utang` decimal(10,0) NOT NULL,
  `total_bayar` decimal(10,0) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `masproduct`
--

CREATE TABLE `masproduct` (
  `id_product` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `code_image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` decimal(10,0) NOT NULL,
  `selling_price` decimal(10,0) NOT NULL,
  `actual_weight` double DEFAULT NULL,
  `panjang` double DEFAULT NULL,
  `lebar` double DEFAULT NULL,
  `tinggi` double DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `minimum_stock` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_productunit` int(11) NOT NULL,
  `id_productcategory` int(11) NOT NULL,
  `email_tenant` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `masproduct`
--

INSERT INTO `masproduct` (`id_product`, `sku`, `code`, `code_image`, `name`, `quantity`, `purchase_price`, `selling_price`, `actual_weight`, `panjang`, `lebar`, `tinggi`, `description`, `minimum_stock`, `status`, `id_productunit`, `id_productcategory`, `email_tenant`, `picture`) VALUES
(19, '220512-035448', '61375487-DCA0-4E76-A4D7-11A0DDE79399', '61375487-DCA0-4E76-A4D7-11A0DDE79399.png', 'Aspire 5 Slim (A514-54)', 25, '6800000', '8900000', 0, 0, 0, 0, '', 3, 'Active', 8, 9, '220511-191240', 'default-product.png'),
(20, '220513-081836', '1D430E8D-796C-4D0D-B6A1-E5AB097B6CA9', '1D430E8D-796C-4D0D-B6A1-E5AB097B6CA9.png', 'Box RAM Laptop Corsair DDR4 4gb 2400MHz Sodim', 14, '400000', '500000', 0, 0, 0, 0, '', 3, 'Active', 8, 9, '220511-191240', '1D430E8D-796C-4D0D-B6A1-E5AB097B6CA9.jpg'),
(21, '220513-083802', 'D17B1636-04D9-44E6-8524-84810FE16379', 'D17B1636-04D9-44E6-8524-84810FE16379.png', 'Geoff Max Sandals Anniver 9 0 Black Pink', 10, '200000', '130000', 0, 0, 0, 0, '', 3, 'Active', 7, 10, '220511-191240', 'D17B1636-04D9-44E6-8524-84810FE16379.png'),
(22, '220513-152504', '36F9F672-F1F4-4EA3-9E54-B48DB50FAF30', '36F9F672-F1F4-4EA3-9E54-B48DB50FAF30.png', 'RAM Laptop Corsair DDR4 4gb 2400MHz Sodim', 3, '900000', '1000000', 1, 1, 1, 1, 'Ok', 3, 'Active', 10, 11, '220513-151635', '36F9F672-F1F4-4EA3-9E54-B48DB50FAF30.jpg'),
(23, '220514-062158', 'EBA04A27-AD33-4B5D-A744-41883031AC3F', 'EBA04A27-AD33-4B5D-A744-41883031AC3F.png', 'as', 0, '12', '12', 0, 0, 0, 0, '', 3, 'Active', 7, 7, '220511-191240', 'default-product.png'),
(24, '220514-062210', 'F630629C-657B-48D6-A622-CF18F204C1EC', 'F630629C-657B-48D6-A622-CF18F204C1EC.png', '12', 12, '12', '12', 0, 0, 0, 0, '', 3, 'Active', 7, 7, '220511-191240', 'default-product.png'),
(25, '220519-092153', '456B2157-81D9-4FDA-8267-F25DD86541BD', '456B2157-81D9-4FDA-8267-F25DD86541BD.png', 'alat', 10, '1500', '2000', 0, 0, 0, 0, 'bokas', 3, 'Active', 11, 12, '220519-090450', '456B2157-81D9-4FDA-8267-F25DD86541BD.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `masproductcategory`
--

CREATE TABLE `masproductcategory` (
  `id_productcategory` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_tenant` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `masproductcategory`
--

INSERT INTO `masproductcategory` (`id_productcategory`, `name`, `email_tenant`, `status`) VALUES
(7, 'Makanan', '220511-191240', ''),
(8, 'Minuman', '220511-191240', ''),
(9, 'Elektronik', '220511-191240', ''),
(10, 'Alas Kaki', '220511-191240', ''),
(11, 'Makanan', '220513-151635', ''),
(12, 'SS', '220519-090450', '');

-- --------------------------------------------------------

--
-- Table structure for table `masproductgrosir`
--

CREATE TABLE `masproductgrosir` (
  `id_productgrosir` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `minimum_quantity` int(11) NOT NULL,
  `selling_price` decimal(10,0) NOT NULL,
  `id_product` int(11) NOT NULL,
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `masproductunit`
--

CREATE TABLE `masproductunit` (
  `id_productunit` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `masproductunit`
--

INSERT INTO `masproductunit` (`id_productunit`, `name`, `email_tenant`) VALUES
(7, 'Box', '220511-191240'),
(8, 'Unit', '220511-191240'),
(9, 'Pcs', '220511-191240'),
(10, 'Pcs', '220513-151635'),
(11, 'a1', '220519-090450');

-- --------------------------------------------------------

--
-- Table structure for table `massupplier`
--

CREATE TABLE `massupplier` (
  `id_supplier` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_tenant` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `massupplier`
--

INSERT INTO `massupplier` (`id_supplier`, `name`, `address`, `phone_number`, `email`, `email_tenant`, `status`) VALUES
(3, 'Sup 1', '', 0, '', '220513-151635', 'active'),
(4, 'Angga', '', 0, '', '220511-191240', 'active'),
(5, 'dangga', 'asdsadsadsa', 111111, 'dangga@gmail.com', '220519-090450', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `mastenant`
--

CREATE TABLE `mastenant` (
  `email_tenant` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mastenant`
--

INSERT INTO `mastenant` (`email_tenant`, `name`, `address`, `phone_number`, `picture`, `email`) VALUES
('220511-191240', 'Muzakki Ahmad Al Farisi', '', '085329981115', 'default-avatar.png', 'a@a'),
('220512-035600', 'Yunia Fransisca Utami', '', '085156541514', 'default-avatar.png', 's@s'),
('220512-101624', 'Zakiyatu Barokathil Ilmiah', '', '082137717205', 'default-avatar.png', 'd@d'),
('220513-151635', 'Faris', '', '085329981115', 'default-avatar.png', 'faris@gmail.com'),
('220519-090450', 'angga', 'sadsadas', '0811111', 'default-avatar.png', 'anggaagustira@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `mastoko`
--

CREATE TABLE `mastoko` (
  `id_toko` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `komisi` int(11) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `id_marketplace` int(255) NOT NULL,
  `email_tenant` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `masutang`
--

CREATE TABLE `masutang` (
  `id_utang` int(11) NOT NULL,
  `id_po` int(11) DEFAULT NULL,
  `total_utang` decimal(10,0) NOT NULL,
  `total_bayar` decimal(10,0) NOT NULL,
  `status` varchar(255) NOT NULL,
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `masutang`
--

INSERT INTO `masutang` (`id_utang`, `id_po`, `total_utang`, `total_bayar`, `status`, `email_tenant`) VALUES
(1, 25, '14400000', '0', 'Debt', '220511-191240');

-- --------------------------------------------------------

--
-- Table structure for table `maswarehouse`
--

CREATE TABLE `maswarehouse` (
  `id_warehouse` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `maswarehouse`
--

INSERT INTO `maswarehouse` (`id_warehouse`, `name`, `address`, `picture`, `email_tenant`) VALUES
('0000001', 'Gudang Satu', 'as', '0000001.jpg', '220511-191240'),
('0000002', 'Gudang Garam', 'as', 'default-warehousdefault-warehouse.pnge.png', '220512-035600'),
('0000003', 'Gudang Mlinjo', '-', '0000003.png', '220512-101624'),
('0000004', 'Gudang garam', 'jakarta', '0000004.png', '220513-151635'),
('0000005', 'danggakom1', 'bokas', '0000005.jpg', '220519-090450');

-- --------------------------------------------------------

--
-- Table structure for table `outsalesorder`
--

CREATE TABLE `outsalesorder` (
  `invoice_so` varchar(255) NOT NULL,
  `airway_bill` varchar(255) DEFAULT NULL,
  `id_marketplace` int(11) DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `outsalesordercustomer`
--

CREATE TABLE `outsalesordercustomer` (
  `invoice_so` varchar(255) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `discount` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `outsalesorderdelivery`
--

CREATE TABLE `outsalesorderdelivery` (
  `invoice_so` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_courier` int(11) NOT NULL,
  `shipping_cost` decimal(10,0) NOT NULL,
  `airway_bill` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `outsalesorderpayment`
--

CREATE TABLE `outsalesorderpayment` (
  `invoice_so` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `payment_price` decimal(10,0) NOT NULL,
  `rek_number` varchar(255) DEFAULT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `date_due` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `outsalesorderproduct`
--

CREATE TABLE `outsalesorderproduct` (
  `id_soproduct` int(11) NOT NULL,
  `invoice_so` varchar(255) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `selling_price` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `secmenu`
--

CREATE TABLE `secmenu` (
  `menuid` varchar(255) NOT NULL,
  `parentid` varchar(255) NOT NULL,
  `menuname` varchar(255) NOT NULL,
  `menusort` int(11) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `iconclass` varchar(255) NOT NULL,
  `menugroup` varchar(255) NOT NULL,
  `menukey` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tenant` int(11) DEFAULT NULL,
  `employee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `secmenu`
--

INSERT INTO `secmenu` (`menuid`, `parentid`, `menuname`, `menusort`, `controller`, `action`, `iconclass`, `menugroup`, `menukey`, `status`, `tenant`, `employee`) VALUES
('1.1', '1', 'Main', 1, '-', '-', '-\r\nfa-chart-pie\r\n-\r\nfa-shield-alt\r\n-\r\n-\r\nfa-user\r\nfa-warehouse\r\nfa-archive\r\n-\r\n-\r\n-\r\n-\r\nfa-store\r\nfa-user-tie\r\nfa-user-friends\r\nfa-users\r\n-\r\n-\r\nfa-shipping-fast\r\nfa-users\r\n-\r\nfa-cart-plus\r\nfa-truck-loading\r\n-\r\nfa-dolly-flatbed\r\nfa-boxes\r\n-\r\nfa-shopping-ba', 'Module', '-', '1', 1, 1),
('1.1.1', '1.1', 'Dashboard', 2, 'Dashboards', 'Index', 'fa-chart-pie', 'Parent', 'Dashboards', '1', 1, 1),
('1.2', '1', 'Maintenance', 3, '-', '-', '-', 'Module', '-', '1', 1, 0),
('1.2.1', '1.2', 'Security', 4, '-', '-', 'fa-shield-alt', 'Parent', 'Security', '1', 0, 0),
('1.2.1.1', '1.2.1', 'User Roles', 5, 'UserRoles', 'Index', '-', 'Child', 'Security', '1', 0, 0),
('1.2.1.2', '1.2.1', 'Users', 6, 'Users', 'Index', '-', 'Child', 'Security', '1', 0, 0),
('1.2.2', '1.2', 'Tenant', 7, 'Tenants', 'Index', 'fa-user', 'Parent', 'Tenants', '1', 0, 0),
('1.2.3', '1.2', 'Warehouse', 8, 'Warehouses', 'Index', 'fa-warehouse', 'Parent', 'Warehouses', '1', 1, 0),
('1.2.4', '1.2', 'Product', 9, '-', '-', 'fa-archive', 'Parent', 'Products', '1', 1, 0),
('1.2.4.1', '1.2.4', 'Product Item', 10, 'ProductUnits', 'Index', '-', 'Child', 'Products', '1', 1, 0),
('1.2.4.2', '1.2.4', 'Product Kategori', 11, 'ProductCategories', 'Index', '-', 'Child', 'Products', '1', 1, 0),
('1.2.4.3', '1.2.4', 'Product Data', 12, 'Products', 'Index', '-', 'Child', 'Products', '1', 1, 0),
('1.2.4.4', '1.2.4', 'Wholesale Products', 13, 'UnderConstructions', 'Index', '-', 'Child', 'Products', '1', 1, 0),
('1.2.5', '1.2', 'Stores', 14, 'Stores', 'Index', 'fa-city', 'Parent', 'Stores', '1', 1, 0),
('1.2.6', '1.2', 'Employees', 15, 'Employees', 'Index', 'fa-user-tie', 'Parent', 'Employees', '1', 1, 0),
('1.2.7', '1.2', 'Suppliers', 16, 'Suppliers', 'Index', 'fa-user-friends', 'Parent', 'Suppliers', '1', 1, 0),
('1.2.8', '1.2', 'Customer', 17, '-', '-', 'fa-users', 'Parent', 'Customers', '1', 1, 0),
('1.2.8.1', '1.2.8', 'Customer Type', 18, 'CustomerTypes', 'Index', '-', 'Child', 'Customers', '1', 0, 0),
('1.2.8.2', '1.2.8', 'Customers', 19, 'Customers', 'Index', '-', 'Child', 'Customers', '1', 1, 0),
('1.2.9', '1.2', 'Couriers', 20, 'Couriers', 'Index', 'fa-shipping-fast', 'Parent', 'Couriers', '1', 0, 0),
('1.2.10', '1.2', 'Marketplaces', 21, 'Marketplaces', 'Index', 'fa-store', 'Parent', 'Marketplaces', '1', 0, 0),
('1.3', '1', 'Incoming', 22, '-', '-', '-', 'Module', '-', '1', 1, 1),
('1.3.1', '1.3', 'Purchase Orders', 23, 'PurchaseOrders', 'Index', 'fa-cart-plus', 'Parent', 'Purchase Orders', '1', 1, 1),
('1.4', '1', 'Inventory', 25, '-', '-', '-', 'Module', '-', '1', 1, 1),
('1.4.2', '1.4', 'Stock Opname', 27, 'UnderConstructions', 'Index', 'fa-boxes', 'Parent', 'Stock Opname', '1', 1, 1),
('1.5', '1', 'Out Going', 28, '-', '-', '-', 'Module', '-', '1', 1, 1),
('1.5.1', '1.5', 'Sales Orders', 29, 'SalesOrders', 'Index', 'fa-shopping-basket', 'Parent', 'Sales Orders', '1', 1, 1),
('1.6', '1', 'Transaction', 30, '-', '-', '-', 'Module', '-', '1', 1, 1),
('1.6.1', '1.6', 'Utang', 32, 'Utangs', 'Index', '-', 'Parent', 'Utang', '1', 1, 1),
('1.6.2', '1.6', 'Piutang', 33, 'UnderConstructions', 'Index', '-', 'Parent', 'Piutang', '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `secuser`
--

CREATE TABLE `secuser` (
  `email_user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `email_confirmed` tinyint(1) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `id_usertype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `secuser`
--

INSERT INTO `secuser` (`email_user`, `password`, `token`, `email_confirmed`, `status`, `id_usertype`) VALUES
('a@a', '$2y$12$JYJ4DCqfhDWbGr4jA8Cl9eOWjz9iLAX10/8mrJaCL6tOOZ7B3Jx7W', '5a8c1ec86c1ecb3b4b2f19e7022bf757', 0, 'active', 2),
('admin', '$2y$12$c4cd4a1f900f538b77e01un3qNM3mgZ5A.sZPfdawzeyCqwS0t2bC', 'c4cd4a1f900f538b77e0125ffa60099b', 1, 'active', 1),
('anggaagustira@gmail.com', '$2y$12$hXAPV7T21IyDPA4gO.SSnu/pIxox4FQnApXiHgURjz7tMlh0zWvuS', '6d4ebc0ea9294e0f83b0a808a5229f33', 0, 'active', 2),
('d@d', '$2y$12$ncbr3qiuTU2eScfpFpZLsegmsEgG.fO72oph5HdFCp/kgopiSpCbO', '6d5a07afca06c5b7475ee8e92274ae92', 0, 'active', 2),
('danggo@gmail.com', '$2y$12$zul95Z/KfuImNRQtc/vLP.qgvHxYYdfRj3iy.U75w3uGI2CKQ6VVi', 'd872eb8cab23da3be270c480f0de885c', 0, 'active', 3),
('danggu@gmail.com', '$2y$12$Pb3TiCYBjxZPyDLe8OjIru7uNsYFawE92PtLbsjE14RX5XAYq3s6S', '0dec281f70bbc1392db166ad9507e119', 0, 'active', 3),
('f@f', '$2y$12$1kYZIdGHnIeUn5IKXQXrHeeY813ZLrGUcx4wIWLb5sHS63ortslLy', '23737521e366c3df3835ae1239757d14', 0, 'active', 3),
('faris@gmail.com', '$2y$12$YcR4oi1w0GpoIqevTb0z4O1XjoKAzx9KLQGbEI//YjHs4EOodANb.', '85466f9cb157ce7b72048eb104c343cf', 0, 'active', 2),
('s@s', '$2y$12$tnk/1t0WUVI3ocrQWp7z0.qJRTO.lDSG6PP7hhhTy432ahW6lmdLW', 'a97622a921da1857d0c1f86de01fc60c', 0, 'active', 2);

-- --------------------------------------------------------

--
-- Table structure for table `secuserrole`
--

CREATE TABLE `secuserrole` (
  `id_usertype` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `secuserrole`
--

INSERT INTO `secuserrole` (`id_usertype`, `name`, `description`, `status`) VALUES
(1, 'Admin', 'admin', 'active'),
(2, 'Tenant', 'tenant', 'active'),
(3, 'Employee', 'employee', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incarrival`
--
ALTER TABLE `incarrival`
  ADD PRIMARY KEY (`id_arrival`) USING BTREE,
  ADD KEY `FK_IncomingArivalMasTenant` (`email_tenant`) USING BTREE,
  ADD KEY `FK_IncArrivalIncPurchaseOrder` (`id_po`) USING BTREE;

--
-- Indexes for table `incarrivalproduct`
--
ALTER TABLE `incarrivalproduct`
  ADD PRIMARY KEY (`id_arrivalproduct`) USING BTREE,
  ADD KEY `FK_IncArrivalProductIncPurchaseOrderProduk` (`id_poproduct`) USING BTREE,
  ADD KEY `FK_IncArrivalProductMasProduct` (`id_product`) USING BTREE,
  ADD KEY `FK_IncArrivalProductIncArrival` (`id_arrival`) USING BTREE;

--
-- Indexes for table `incpurchaseorder`
--
ALTER TABLE `incpurchaseorder`
  ADD PRIMARY KEY (`id_po`) USING BTREE,
  ADD KEY `FK_MasTenantIncPurchaseOrder` (`email_tenant`) USING BTREE,
  ADD KEY `id_po` (`id_po`) USING BTREE,
  ADD KEY `id_supplier` (`id_supplier`) USING BTREE;

--
-- Indexes for table `incpurchaseorderproduct`
--
ALTER TABLE `incpurchaseorderproduct`
  ADD PRIMARY KEY (`id_poproduct`) USING BTREE,
  ADD KEY `FK_MasProductIncPurchaseOrderProduct` (`id_product`) USING BTREE,
  ADD KEY `FK_IncPurchaseOrderIncPurchaseOrderProduct` (`id_po`) USING BTREE;

--
-- Indexes for table `invputaway`
--
ALTER TABLE `invputaway`
  ADD PRIMARY KEY (`id_putaway`) USING BTREE,
  ADD KEY `FK_MasTenantInvPutAway` (`email_tenant`) USING BTREE;

--
-- Indexes for table `invputawayproduct`
--
ALTER TABLE `invputawayproduct`
  ADD PRIMARY KEY (`id_putawayproduct`) USING BTREE,
  ADD KEY `FK_MasProductInvPutAwayProduct` (`id_product`) USING BTREE,
  ADD KEY `FK_InvPutAwayInvPutAwayProduct` (`id_putaway`) USING BTREE;

--
-- Indexes for table `invstockopname`
--
ALTER TABLE `invstockopname`
  ADD PRIMARY KEY (`id_stockopname`) USING BTREE,
  ADD KEY `FK_MasProductInvStockOpname` (`id_product`) USING BTREE,
  ADD KEY `FK_MasTenantInvStockOpname` (`email_tenant`) USING BTREE;

--
-- Indexes for table `mascourier`
--
ALTER TABLE `mascourier`
  ADD PRIMARY KEY (`id_courier`) USING BTREE;

--
-- Indexes for table `mascustomer`
--
ALTER TABLE `mascustomer`
  ADD PRIMARY KEY (`id_customer`) USING BTREE,
  ADD KEY `FK_MasCustomerMasTenant` (`email_tenant`) USING BTREE,
  ADD KEY `FK_MasCustomerMasCustomerTyoe` (`id_customertype`) USING BTREE;

--
-- Indexes for table `mascustomertype`
--
ALTER TABLE `mascustomertype`
  ADD PRIMARY KEY (`Id_CustomerType`) USING BTREE;

--
-- Indexes for table `masemployee`
--
ALTER TABLE `masemployee`
  ADD PRIMARY KEY (`id_employee`) USING BTREE,
  ADD KEY `FK_MasEmployeeMasTenant` (`email_tenant`) USING BTREE;

--
-- Indexes for table `masmarketplace`
--
ALTER TABLE `masmarketplace`
  ADD PRIMARY KEY (`id_marketplace`) USING BTREE;

--
-- Indexes for table `maspiutang`
--
ALTER TABLE `maspiutang`
  ADD PRIMARY KEY (`id_piutang`) USING BTREE,
  ADD KEY `FK_OutSalesOrderMasPiutang` (`invoice_so`) USING BTREE;

--
-- Indexes for table `masproduct`
--
ALTER TABLE `masproduct`
  ADD PRIMARY KEY (`id_product`) USING BTREE,
  ADD KEY `FK_MasProductUnitMasProduct` (`id_productunit`) USING BTREE,
  ADD KEY `FK_MasProductCategoryMasProduct` (`id_productcategory`) USING BTREE,
  ADD KEY `FK_MasTenantMasProduct` (`email_tenant`) USING BTREE;

--
-- Indexes for table `masproductcategory`
--
ALTER TABLE `masproductcategory`
  ADD PRIMARY KEY (`id_productcategory`) USING BTREE,
  ADD KEY `FK_MasTenantMasProductCategory` (`email_tenant`) USING BTREE;

--
-- Indexes for table `masproductgrosir`
--
ALTER TABLE `masproductgrosir`
  ADD PRIMARY KEY (`id_productgrosir`) USING BTREE,
  ADD KEY `FK_MasProductMasProductGrosir` (`id_product`) USING BTREE,
  ADD KEY `FK_MasTenantMasProductGrosir` (`email_tenant`) USING BTREE;

--
-- Indexes for table `masproductunit`
--
ALTER TABLE `masproductunit`
  ADD PRIMARY KEY (`id_productunit`) USING BTREE,
  ADD KEY `FK_MasTenantMasProductUnit` (`email_tenant`) USING BTREE;

--
-- Indexes for table `massupplier`
--
ALTER TABLE `massupplier`
  ADD PRIMARY KEY (`id_supplier`) USING BTREE,
  ADD KEY `FK_MasSupplierMasTenant` (`email_tenant`) USING BTREE;

--
-- Indexes for table `mastenant`
--
ALTER TABLE `mastenant`
  ADD PRIMARY KEY (`email_tenant`,`email`) USING BTREE,
  ADD KEY `email_tenant` (`email_tenant`) USING BTREE;

--
-- Indexes for table `mastoko`
--
ALTER TABLE `mastoko`
  ADD PRIMARY KEY (`id_toko`) USING BTREE,
  ADD KEY `FK_MasTokoMasTenant` (`email_tenant`) USING BTREE,
  ADD KEY `FK_MasTokoMasMarketplace` (`id_marketplace`) USING BTREE;

--
-- Indexes for table `masutang`
--
ALTER TABLE `masutang`
  ADD PRIMARY KEY (`id_utang`) USING BTREE,
  ADD KEY `FK_IncPurchaseOrderMasUtang` (`id_po`) USING BTREE,
  ADD KEY `email_tenant` (`email_tenant`) USING BTREE;

--
-- Indexes for table `maswarehouse`
--
ALTER TABLE `maswarehouse`
  ADD PRIMARY KEY (`id_warehouse`) USING BTREE,
  ADD KEY `FK_MasTenantMasWarehouse` (`email_tenant`) USING BTREE;

--
-- Indexes for table `outsalesorder`
--
ALTER TABLE `outsalesorder`
  ADD PRIMARY KEY (`invoice_so`) USING BTREE,
  ADD KEY `FK_MasMarketplaceOutSalesOrder` (`id_marketplace`) USING BTREE,
  ADD KEY `FK_MasTokoOutSalesOrder` (`id_toko`) USING BTREE,
  ADD KEY `FK_MasTenantOutSalesOrder` (`email_tenant`) USING BTREE;

--
-- Indexes for table `outsalesordercustomer`
--
ALTER TABLE `outsalesordercustomer`
  ADD PRIMARY KEY (`invoice_so`) USING BTREE,
  ADD KEY `FK_MasCustomerOutSalesOrderCustomer` (`id_customer`) USING BTREE;

--
-- Indexes for table `outsalesorderdelivery`
--
ALTER TABLE `outsalesorderdelivery`
  ADD PRIMARY KEY (`invoice_so`) USING BTREE,
  ADD KEY `FK_MasCourierOutSalesOrderDelivery` (`id_courier`) USING BTREE;

--
-- Indexes for table `outsalesorderpayment`
--
ALTER TABLE `outsalesorderpayment`
  ADD PRIMARY KEY (`invoice_so`) USING BTREE;

--
-- Indexes for table `outsalesorderproduct`
--
ALTER TABLE `outsalesorderproduct`
  ADD PRIMARY KEY (`id_soproduct`) USING BTREE,
  ADD KEY `FK_OutSalesOrderOutSalesOrderProduct` (`invoice_so`) USING BTREE,
  ADD KEY `FK_MasProductOutSalesOrderProduct` (`id_product`) USING BTREE;

--
-- Indexes for table `secuser`
--
ALTER TABLE `secuser`
  ADD PRIMARY KEY (`email_user`) USING BTREE,
  ADD KEY `FK_SecUserRoleSecUser` (`id_usertype`) USING BTREE;

--
-- Indexes for table `secuserrole`
--
ALTER TABLE `secuserrole`
  ADD PRIMARY KEY (`id_usertype`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incarrivalproduct`
--
ALTER TABLE `incarrivalproduct`
  MODIFY `id_arrivalproduct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incpurchaseorder`
--
ALTER TABLE `incpurchaseorder`
  MODIFY `id_po` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `incpurchaseorderproduct`
--
ALTER TABLE `incpurchaseorderproduct`
  MODIFY `id_poproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `invputawayproduct`
--
ALTER TABLE `invputawayproduct`
  MODIFY `id_putawayproduct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mascourier`
--
ALTER TABLE `mascourier`
  MODIFY `id_courier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mascustomer`
--
ALTER TABLE `mascustomer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mascustomertype`
--
ALTER TABLE `mascustomertype`
  MODIFY `Id_CustomerType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `masemployee`
--
ALTER TABLE `masemployee`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `masmarketplace`
--
ALTER TABLE `masmarketplace`
  MODIFY `id_marketplace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maspiutang`
--
ALTER TABLE `maspiutang`
  MODIFY `id_piutang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masproduct`
--
ALTER TABLE `masproduct`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `masproductcategory`
--
ALTER TABLE `masproductcategory`
  MODIFY `id_productcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `masproductgrosir`
--
ALTER TABLE `masproductgrosir`
  MODIFY `id_productgrosir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masproductunit`
--
ALTER TABLE `masproductunit`
  MODIFY `id_productunit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `massupplier`
--
ALTER TABLE `massupplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mastoko`
--
ALTER TABLE `mastoko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `masutang`
--
ALTER TABLE `masutang`
  MODIFY `id_utang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `outsalesorderproduct`
--
ALTER TABLE `outsalesorderproduct`
  MODIFY `id_soproduct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secuserrole`
--
ALTER TABLE `secuserrole`
  MODIFY `id_usertype` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incarrival`
--
ALTER TABLE `incarrival`
  ADD CONSTRAINT `FK_IncomingArivalMasTenant` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incarrivalproduct`
--
ALTER TABLE `incarrivalproduct`
  ADD CONSTRAINT `FK_IncArrivalProductIncArrival` FOREIGN KEY (`id_arrival`) REFERENCES `incarrival` (`id_arrival`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_IncArrivalProductIncPurchaseOrderProduk` FOREIGN KEY (`id_poproduct`) REFERENCES `incpurchaseorderproduct` (`id_poproduct`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_IncArrivalProductMasProduct` FOREIGN KEY (`id_product`) REFERENCES `masproduct` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incpurchaseorder`
--
ALTER TABLE `incpurchaseorder`
  ADD CONSTRAINT `FK_MasTenantIncPurchaseOrder` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `massupplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incpurchaseorderproduct`
--
ALTER TABLE `incpurchaseorderproduct`
  ADD CONSTRAINT `FK_IncPurchaseOrderIncPurchaseOrderProduct` FOREIGN KEY (`id_po`) REFERENCES `incpurchaseorder` (`id_po`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MasProductIncPurchaseOrderProduct` FOREIGN KEY (`id_product`) REFERENCES `masproduct` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invputaway`
--
ALTER TABLE `invputaway`
  ADD CONSTRAINT `FK_MasTenantInvPutAway` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invputawayproduct`
--
ALTER TABLE `invputawayproduct`
  ADD CONSTRAINT `FK_InvPutAwayInvPutAwayProduct` FOREIGN KEY (`id_putaway`) REFERENCES `invputaway` (`id_putaway`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MasProductInvPutAwayProduct` FOREIGN KEY (`id_product`) REFERENCES `masproduct` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invstockopname`
--
ALTER TABLE `invstockopname`
  ADD CONSTRAINT `FK_MasProductInvStockOpname` FOREIGN KEY (`id_product`) REFERENCES `masproduct` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MasTenantInvStockOpname` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mascustomer`
--
ALTER TABLE `mascustomer`
  ADD CONSTRAINT `FK_MasCustomerMasCustomerTyoe` FOREIGN KEY (`id_customertype`) REFERENCES `mascustomertype` (`Id_CustomerType`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MasCustomerMasTenant` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masemployee`
--
ALTER TABLE `masemployee`
  ADD CONSTRAINT `FK_MasEmployeeMasTenant` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maspiutang`
--
ALTER TABLE `maspiutang`
  ADD CONSTRAINT `FK_OutSalesOrderMasPiutang` FOREIGN KEY (`invoice_so`) REFERENCES `outsalesorder` (`invoice_so`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masproduct`
--
ALTER TABLE `masproduct`
  ADD CONSTRAINT `FK_MasProductCategoryMasProduct` FOREIGN KEY (`id_productcategory`) REFERENCES `masproductcategory` (`id_productcategory`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MasProductUnitMasProduct` FOREIGN KEY (`id_productunit`) REFERENCES `masproductunit` (`id_productunit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MasTenantMasProduct` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masproductcategory`
--
ALTER TABLE `masproductcategory`
  ADD CONSTRAINT `FK_MasTenantMasProductCategory` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masproductgrosir`
--
ALTER TABLE `masproductgrosir`
  ADD CONSTRAINT `FK_MasProductMasProductGrosir` FOREIGN KEY (`id_product`) REFERENCES `masproduct` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MasTenantMasProductGrosir` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masproductunit`
--
ALTER TABLE `masproductunit`
  ADD CONSTRAINT `FK_MasTenantMasProductUnit` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `massupplier`
--
ALTER TABLE `massupplier`
  ADD CONSTRAINT `FK_MasSupplierMasTenant` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mastoko`
--
ALTER TABLE `mastoko`
  ADD CONSTRAINT `FK_MasTokoMasMarketplace` FOREIGN KEY (`id_marketplace`) REFERENCES `masmarketplace` (`id_marketplace`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MasTokoMasTenant` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masutang`
--
ALTER TABLE `masutang`
  ADD CONSTRAINT `FK_IncPurchaseOrderMasUtang` FOREIGN KEY (`id_po`) REFERENCES `incpurchaseorder` (`id_po`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `email_tenant` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maswarehouse`
--
ALTER TABLE `maswarehouse`
  ADD CONSTRAINT `FK_MasTenantMasWarehouse` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outsalesorder`
--
ALTER TABLE `outsalesorder`
  ADD CONSTRAINT `FK_MasMarketplaceOutSalesOrder` FOREIGN KEY (`id_marketplace`) REFERENCES `masmarketplace` (`id_marketplace`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MasTenantOutSalesOrder` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MasTokoOutSalesOrder` FOREIGN KEY (`id_toko`) REFERENCES `mastoko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outsalesordercustomer`
--
ALTER TABLE `outsalesordercustomer`
  ADD CONSTRAINT `FK_MasCustomerOutSalesOrderCustomer` FOREIGN KEY (`id_customer`) REFERENCES `mascustomer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_OutSalesOrderOutSalesOrderCustomer` FOREIGN KEY (`invoice_so`) REFERENCES `outsalesorder` (`invoice_so`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outsalesorderdelivery`
--
ALTER TABLE `outsalesorderdelivery`
  ADD CONSTRAINT `FK_MasCourierOutSalesOrderDelivery` FOREIGN KEY (`id_courier`) REFERENCES `mascourier` (`id_courier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_OutSalesOrderOutSalesOrderDelivery` FOREIGN KEY (`invoice_so`) REFERENCES `outsalesorder` (`invoice_so`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outsalesorderpayment`
--
ALTER TABLE `outsalesorderpayment`
  ADD CONSTRAINT `FK_OutSalesOrderOutSalesOrderPayment` FOREIGN KEY (`invoice_so`) REFERENCES `outsalesorder` (`invoice_so`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outsalesorderproduct`
--
ALTER TABLE `outsalesorderproduct`
  ADD CONSTRAINT `FK_MasProductOutSalesOrderProduct` FOREIGN KEY (`id_product`) REFERENCES `masproduct` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_OutSalesOrderOutSalesOrderProduct` FOREIGN KEY (`invoice_so`) REFERENCES `outsalesorder` (`invoice_so`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `secuser`
--
ALTER TABLE `secuser`
  ADD CONSTRAINT `FK_SecUserRoleSecUser` FOREIGN KEY (`id_usertype`) REFERENCES `secuserrole` (`id_usertype`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
