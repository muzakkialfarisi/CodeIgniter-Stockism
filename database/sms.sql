-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2022 at 10:23 PM
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
  `invoice_po` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `incpurchaseorder`
--

CREATE TABLE `incpurchaseorder` (
  `invoice_po` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `createdby` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `incpurchaseorderdelivery`
--

CREATE TABLE `incpurchaseorderdelivery` (
  `invoice_po` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `shipping_cost` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `incpurchaseorderpayment`
--

CREATE TABLE `incpurchaseorderpayment` (
  `invoice_po` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_due` datetime DEFAULT NULL,
  `payment_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `incpurchaseorderproduct`
--

CREATE TABLE `incpurchaseorderproduct` (
  `id_poproduct` int(11) NOT NULL,
  `invoice_po` varchar(255) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `selling_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `incpurchaseordersupplier`
--

CREATE TABLE `incpurchaseordersupplier` (
  `invoice_po` varchar(255) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `tax_cost` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invputaway`
--

CREATE TABLE `invputaway` (
  `id_putaway` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mascourier`
--

CREATE TABLE `mascourier` (
  `id_courier` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mascustomer`
--

INSERT INTO `mascustomer` (`id_customer`, `name`, `id_customertype`, `address`, `phone_number`, `email`, `email_tenant`) VALUES
(1, 'dangga', 1, 'bojong\r\n', '079897987', 'dangga@gmail.com', 'anggaagustira@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `mascustomertype`
--

CREATE TABLE `mascustomertype` (
  `Id_CustomerType` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masemployee`
--

INSERT INTO `masemployee` (`id_employee`, `name`, `email`, `email_tenant`, `picture`) VALUES
(1, 'Dangga', 'anggaagustiraEmp@gmail.com', 'anggaagustira@gmail.com', NULL),
(2, 'Angga Agustira', 'anggaagustiraEmp2@gmail.com', 'anggaagustira@gmail.com', NULL),
(6, 'Faris', 'mzkalfarisi@gmail.com', 'a@a', 'default-avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `masmarketplace`
--

CREATE TABLE `masmarketplace` (
  `id_marketplace` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `masproduct`
--

CREATE TABLE `masproduct` (
  `id_product` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` decimal(10,0) NOT NULL,
  `selling_price` decimal(10,0) NOT NULL,
  `actual_weight` double NOT NULL,
  `vol_weight` double NOT NULL,
  `panjang` double NOT NULL,
  `lebar` double NOT NULL,
  `tinggi` double NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `expired_date` datetime DEFAULT NULL,
  `minimum_stock` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_productunit` int(11) NOT NULL,
  `id_productcategory` int(11) NOT NULL,
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `masproductcategory`
--

CREATE TABLE `masproductcategory` (
  `id_productcategory` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `masproductunit`
--

CREATE TABLE `masproductunit` (
  `id_productunit` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mastenant`
--

CREATE TABLE `mastenant` (
  `email_tenant` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mastenant`
--

INSERT INTO `mastenant` (`email_tenant`, `name`, `address`, `phone_number`, `photo`) VALUES
('a@a', 'Faris', '', '6285329981115', 'default-avatar.png'),
('anggaagustira@gmail.com', 'Angga', '', '6281395145194', 'default-avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `mastoko`
--

CREATE TABLE `mastoko` (
  `id_toko` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `komisi` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `id_marketplace` int(255) NOT NULL,
  `email_tenant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mastoko`
--

INSERT INTO `mastoko` (`id_toko`, `name`, `phone_number`, `komisi`, `photo`, `id_marketplace`, `email_tenant`) VALUES
(1, 'Danggakom', 2133123, 12, 'default-avatar.png', 1, 'anggaagustira@gmail.com'),
(2, 'anggakom', 8888888, 10, 'default-avatar.png', 2, 'anggaagustira@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `masutang`
--

CREATE TABLE `masutang` (
  `id_utang` int(11) NOT NULL,
  `invoice_po` varchar(255) NOT NULL,
  `total_utang` decimal(10,0) NOT NULL,
  `total_bayar` decimal(10,0) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maswarehouse`
--

INSERT INTO `maswarehouse` (`id_warehouse`, `name`, `address`, `picture`, `email_tenant`) VALUES
('0000001', 'Faris', 'a', 'default-warehouse.png', 'a@a');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `outsalesordercustomer`
--

CREATE TABLE `outsalesordercustomer` (
  `invoice_so` varchar(255) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `discount` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('1.2.4', '1.2', 'Product', 9, '-', '-', 'fa-archive', 'Parent', 'Produts', '1', 1, 0),
('1.2.4.1', '1.2.4', 'Product Item', 10, 'UnderConstructions', 'Index', '-', 'Child', 'Products', '1', 0, 0),
('1.2.4.2', '1.2.4', 'Product Kategori', 11, 'UnderConstructions', 'Index', '-', 'Child', 'Products', '1', 1, 0),
('1.2.4.3', '1.2.4', 'Product Data', 12, 'UnderConstructions', 'Index', '-', 'Child', 'Products', '1', 1, 0),
('1.2.4.4', '1.2.4', 'Wholesale Products', 13, 'UnderConstructions', 'Index', '-', 'Child', 'Products', '1', 1, 0),
('1.2.5', '1.2', 'Stores', 14, 'Stores', 'Index', 'fa-city', 'Parent', 'Stores', '1', 1, 0),
('1.2.6', '1.2', 'Employees', 15, 'Employees', 'Index', 'fa-user-tie', 'Parent', 'Employees', '1', 1, 0),
('1.2.7', '1.2', 'Suppliers', 16, 'Suppliers', 'Index', 'fa-user-friends', 'Parent', 'Suppliers', '1', 1, 0),
('1.2.8', '1.2', 'Customer', 17, '-', '-', 'fa-users', 'Parent', 'Customers', '1', 1, 0),
('1.2.8.1', '1.2.8', 'Customer Type', 18, 'CustomersType', 'Index', '-', 'Child', 'Customers', '1', 0, 0),
('1.2.8.2', '1.2.8', 'Customers', 19, 'Customers', 'Index', '-', 'Child', 'Customers', '1', 1, 0),
('1.2.9', '1.2', 'Couriers', 20, 'UnderConstructions', 'Index', 'fa-shipping-fast', 'Parent', 'Couriers', '1', 0, 0),
('1.2.10', '1.2', 'Marketplaces', 21, 'UnderConstructions', 'Index', 'fa-store', 'Parent', 'Marketplaces', '1', 0, 0),
('1.3', '1', 'Incoming', 22, '-', '-', '-', 'Module', '-', '1', 1, 1),
('1.3.1', '1.3', 'Purchase Orders', 23, 'UnderConstructions', 'Index', 'fa-cart-plus', 'Parent', 'Purchase Orders', '1', 1, 1),
('1.3.2', '1.3', 'Arrival', 24, 'UnderConstructions', 'Index', 'fa-truck-loading', 'Parent', 'Arrival', '1', 1, 1),
('1.4', '1', 'Inventory', 25, '-', '-', '-', 'Module', '-', '1', 1, 1),
('1.4.1', '1.4', 'Put Away', 26, 'UnderConstructions', 'Index', 'fa-dolly-flatbed', 'Parent', 'Put Away', '1', 1, 1),
('1.4.2', '1.4', 'Stock Opname', 27, 'UnderConstructions', 'Index', 'fa-boxes', 'Parent', 'Stock Opname', '1', 1, 1),
('1.5', '1', 'Out Going', 28, '-', '-', '-', 'Module', '-', '1', 1, 1),
('1.5.1', '1.5', 'Sales Orders', 29, 'UnderConstructions', 'Index', 'fa-shopping-basket', 'Parent', 'Sales Orders', '1', 1, 1),
('1.6', '1', 'Transaction', 30, '-', '-', '-', 'Module', '-', '1', 1, 1),
('1.6.1', '1.6', 'Utang', 32, 'UnderConstructions', 'Index', '-', 'Parent', 'Utang', '1', 1, 1),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secuser`
--

INSERT INTO `secuser` (`email_user`, `password`, `token`, `email_confirmed`, `status`, `id_usertype`) VALUES
('a@a', '$2y$12$b1egvDFCXhccONpHttt.6O3S5Pd9Okjq5/dYJXeSRs3U4biSGFV9C', 'fd94aa907f620ba891bb63807108be9e', 0, 'active', 2),
('admin', '$2y$12$c4cd4a1f900f538b77e01un3qNM3mgZ5A.sZPfdawzeyCqwS0t2bC', 'c4cd4a1f900f538b77e0125ffa60099b', 1, 'active', 1),
('anggaagustira@gmail.com', '$2y$12$Lrlnf4Otw9E.E/eKGtIgTunV56T.EUhfpvemdW94O2xKkiGHzUTTy', '929d87dffe160fb12044a499f5d8eada', 0, 'active', 2),
('mzkalfarisi@gmail.com', '$2y$12$dhElONOGOA0RjhMuT8OghOG9hIeCcoBkY3gDnkbaJX0xQ1BnL.68C', 'b2cf4d777549785d69b19b4a7d82ee9b', 0, 'active', 3);

-- --------------------------------------------------------

--
-- Table structure for table `secuserrole`
--

CREATE TABLE `secuserrole` (
  `id_usertype` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`id_arrival`),
  ADD KEY `FK_IncomingArivalMasTenant` (`email_tenant`),
  ADD KEY `FK_IncArrivalIncPurchaseOrder` (`invoice_po`);

--
-- Indexes for table `incarrivalproduct`
--
ALTER TABLE `incarrivalproduct`
  ADD PRIMARY KEY (`id_arrivalproduct`),
  ADD KEY `FK_IncArrivalProductIncPurchaseOrderProduk` (`id_poproduct`),
  ADD KEY `FK_IncArrivalProductMasProduct` (`id_product`),
  ADD KEY `FK_IncArrivalProductIncArrival` (`id_arrival`);

--
-- Indexes for table `incpurchaseorder`
--
ALTER TABLE `incpurchaseorder`
  ADD PRIMARY KEY (`invoice_po`),
  ADD KEY `FK_MasTenantIncPurchaseOrder` (`email_tenant`);

--
-- Indexes for table `incpurchaseorderdelivery`
--
ALTER TABLE `incpurchaseorderdelivery`
  ADD PRIMARY KEY (`invoice_po`);

--
-- Indexes for table `incpurchaseorderpayment`
--
ALTER TABLE `incpurchaseorderpayment`
  ADD PRIMARY KEY (`invoice_po`);

--
-- Indexes for table `incpurchaseorderproduct`
--
ALTER TABLE `incpurchaseorderproduct`
  ADD PRIMARY KEY (`id_poproduct`),
  ADD KEY `FK_IncPurchaseOrderIncPurchaseOrderProduct` (`invoice_po`),
  ADD KEY `FK_MasProductIncPurchaseOrderProduct` (`id_product`);

--
-- Indexes for table `incpurchaseordersupplier`
--
ALTER TABLE `incpurchaseordersupplier`
  ADD PRIMARY KEY (`invoice_po`),
  ADD KEY `FK_MasSupplierIncPurchaseOrderSupplier` (`id_supplier`);

--
-- Indexes for table `invputaway`
--
ALTER TABLE `invputaway`
  ADD PRIMARY KEY (`id_putaway`),
  ADD KEY `FK_MasTenantInvPutAway` (`email_tenant`);

--
-- Indexes for table `invputawayproduct`
--
ALTER TABLE `invputawayproduct`
  ADD PRIMARY KEY (`id_putawayproduct`),
  ADD KEY `FK_MasProductInvPutAwayProduct` (`id_product`),
  ADD KEY `FK_InvPutAwayInvPutAwayProduct` (`id_putaway`);

--
-- Indexes for table `invstockopname`
--
ALTER TABLE `invstockopname`
  ADD PRIMARY KEY (`id_stockopname`),
  ADD KEY `FK_MasProductInvStockOpname` (`id_product`),
  ADD KEY `FK_MasTenantInvStockOpname` (`email_tenant`);

--
-- Indexes for table `mascourier`
--
ALTER TABLE `mascourier`
  ADD PRIMARY KEY (`id_courier`);

--
-- Indexes for table `mascustomer`
--
ALTER TABLE `mascustomer`
  ADD PRIMARY KEY (`id_customer`),
  ADD KEY `FK_MasCustomerMasTenant` (`email_tenant`),
  ADD KEY `FK_MasCustomerMasCustomerTyoe` (`id_customertype`);

--
-- Indexes for table `mascustomertype`
--
ALTER TABLE `mascustomertype`
  ADD PRIMARY KEY (`Id_CustomerType`);

--
-- Indexes for table `masemployee`
--
ALTER TABLE `masemployee`
  ADD PRIMARY KEY (`id_employee`),
  ADD KEY `FK_MasEmployeeMasTenant` (`email_tenant`);

--
-- Indexes for table `masmarketplace`
--
ALTER TABLE `masmarketplace`
  ADD PRIMARY KEY (`id_marketplace`);

--
-- Indexes for table `maspiutang`
--
ALTER TABLE `maspiutang`
  ADD PRIMARY KEY (`id_piutang`),
  ADD KEY `FK_OutSalesOrderMasPiutang` (`invoice_so`);

--
-- Indexes for table `masproduct`
--
ALTER TABLE `masproduct`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `FK_MasProductUnitMasProduct` (`id_productunit`),
  ADD KEY `FK_MasProductCategoryMasProduct` (`id_productcategory`),
  ADD KEY `FK_MasTenantMasProduct` (`email_tenant`);

--
-- Indexes for table `masproductcategory`
--
ALTER TABLE `masproductcategory`
  ADD PRIMARY KEY (`id_productcategory`),
  ADD KEY `FK_MasTenantMasProductCategory` (`email_tenant`);

--
-- Indexes for table `masproductgrosir`
--
ALTER TABLE `masproductgrosir`
  ADD PRIMARY KEY (`id_productgrosir`),
  ADD KEY `FK_MasProductMasProductGrosir` (`id_product`),
  ADD KEY `FK_MasTenantMasProductGrosir` (`email_tenant`);

--
-- Indexes for table `masproductunit`
--
ALTER TABLE `masproductunit`
  ADD PRIMARY KEY (`id_productunit`),
  ADD KEY `FK_MasTenantMasProductUnit` (`email_tenant`);

--
-- Indexes for table `massupplier`
--
ALTER TABLE `massupplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD KEY `FK_MasSupplierMasTenant` (`email_tenant`);

--
-- Indexes for table `mastenant`
--
ALTER TABLE `mastenant`
  ADD PRIMARY KEY (`email_tenant`);

--
-- Indexes for table `mastoko`
--
ALTER TABLE `mastoko`
  ADD PRIMARY KEY (`id_toko`),
  ADD KEY `FK_MasTokoMasTenant` (`email_tenant`),
  ADD KEY `FK_MasTokoMasMarketplace` (`id_marketplace`);

--
-- Indexes for table `masutang`
--
ALTER TABLE `masutang`
  ADD PRIMARY KEY (`id_utang`),
  ADD KEY `FK_IncPurchaseOrderMasUtang` (`invoice_po`);

--
-- Indexes for table `maswarehouse`
--
ALTER TABLE `maswarehouse`
  ADD PRIMARY KEY (`id_warehouse`),
  ADD KEY `FK_MasTenantMasWarehouse` (`email_tenant`);

--
-- Indexes for table `outsalesorder`
--
ALTER TABLE `outsalesorder`
  ADD PRIMARY KEY (`invoice_so`),
  ADD KEY `FK_MasMarketplaceOutSalesOrder` (`id_marketplace`),
  ADD KEY `FK_MasTokoOutSalesOrder` (`id_toko`),
  ADD KEY `FK_MasTenantOutSalesOrder` (`email_tenant`);

--
-- Indexes for table `outsalesordercustomer`
--
ALTER TABLE `outsalesordercustomer`
  ADD PRIMARY KEY (`invoice_so`),
  ADD KEY `FK_MasCustomerOutSalesOrderCustomer` (`id_customer`);

--
-- Indexes for table `outsalesorderdelivery`
--
ALTER TABLE `outsalesorderdelivery`
  ADD PRIMARY KEY (`invoice_so`),
  ADD KEY `FK_MasCourierOutSalesOrderDelivery` (`id_courier`);

--
-- Indexes for table `outsalesorderpayment`
--
ALTER TABLE `outsalesorderpayment`
  ADD PRIMARY KEY (`invoice_so`);

--
-- Indexes for table `outsalesorderproduct`
--
ALTER TABLE `outsalesorderproduct`
  ADD PRIMARY KEY (`id_soproduct`),
  ADD KEY `FK_OutSalesOrderOutSalesOrderProduct` (`invoice_so`),
  ADD KEY `FK_MasProductOutSalesOrderProduct` (`id_product`);

--
-- Indexes for table `secuser`
--
ALTER TABLE `secuser`
  ADD PRIMARY KEY (`email_user`) USING BTREE,
  ADD KEY `FK_SecUserRoleSecUser` (`id_usertype`);

--
-- Indexes for table `secuserrole`
--
ALTER TABLE `secuserrole`
  ADD PRIMARY KEY (`id_usertype`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incarrivalproduct`
--
ALTER TABLE `incarrivalproduct`
  MODIFY `id_arrivalproduct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incpurchaseorderproduct`
--
ALTER TABLE `incpurchaseorderproduct`
  MODIFY `id_poproduct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invputawayproduct`
--
ALTER TABLE `invputawayproduct`
  MODIFY `id_putawayproduct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mascourier`
--
ALTER TABLE `mascourier`
  MODIFY `id_courier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mascustomer`
--
ALTER TABLE `mascustomer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mascustomertype`
--
ALTER TABLE `mascustomertype`
  MODIFY `Id_CustomerType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `masemployee`
--
ALTER TABLE `masemployee`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masproductcategory`
--
ALTER TABLE `masproductcategory`
  MODIFY `id_productcategory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masproductgrosir`
--
ALTER TABLE `masproductgrosir`
  MODIFY `id_productgrosir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masproductunit`
--
ALTER TABLE `masproductunit`
  MODIFY `id_productunit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `massupplier`
--
ALTER TABLE `massupplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mastoko`
--
ALTER TABLE `mastoko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masutang`
--
ALTER TABLE `masutang`
  MODIFY `id_utang` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `FK_IncArrivalIncPurchaseOrder` FOREIGN KEY (`invoice_po`) REFERENCES `incpurchaseorder` (`invoice_po`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `FK_MasTenantIncPurchaseOrder` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incpurchaseorderdelivery`
--
ALTER TABLE `incpurchaseorderdelivery`
  ADD CONSTRAINT `FK_IncPurchaseOrderIncPurchaseOrderDelivery` FOREIGN KEY (`invoice_po`) REFERENCES `incpurchaseorder` (`invoice_po`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incpurchaseorderpayment`
--
ALTER TABLE `incpurchaseorderpayment`
  ADD CONSTRAINT `FK_IncPurchaseOrderIncIncPurchaseOrderPayment` FOREIGN KEY (`invoice_po`) REFERENCES `incpurchaseorder` (`invoice_po`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incpurchaseorderproduct`
--
ALTER TABLE `incpurchaseorderproduct`
  ADD CONSTRAINT `FK_IncPurchaseOrderIncPurchaseOrderProduct` FOREIGN KEY (`invoice_po`) REFERENCES `incpurchaseorder` (`invoice_po`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MasProductIncPurchaseOrderProduct` FOREIGN KEY (`id_product`) REFERENCES `masproduct` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incpurchaseordersupplier`
--
ALTER TABLE `incpurchaseordersupplier`
  ADD CONSTRAINT `FK_IncPurchaseOrderIncPurchaseOrderSupplier` FOREIGN KEY (`invoice_po`) REFERENCES `incpurchaseorder` (`invoice_po`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MasSupplierIncPurchaseOrderSupplier` FOREIGN KEY (`id_supplier`) REFERENCES `massupplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_IncPurchaseOrderMasUtang` FOREIGN KEY (`invoice_po`) REFERENCES `incpurchaseorder` (`invoice_po`) ON DELETE CASCADE ON UPDATE CASCADE;

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
