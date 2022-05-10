/*
 Navicat Premium Data Transfer

 Source Server         : MYSQL
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : sms

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 10/05/2022 17:16:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for incarrival
-- ----------------------------
DROP TABLE IF EXISTS `incarrival`;
CREATE TABLE `incarrival`  (
  `id_arrival` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_arrived` datetime(0) NOT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_po` int(11) NOT NULL,
  PRIMARY KEY (`id_arrival`) USING BTREE,
  INDEX `FK_IncomingArivalMasTenant`(`email_tenant`) USING BTREE,
  INDEX `FK_IncArrivalIncPurchaseOrder`(`id_po`) USING BTREE,
  CONSTRAINT `FK_IncArrivalIncPurchaseOrder` FOREIGN KEY (`id_po`) REFERENCES `incpurchaseorder` (`id_po`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_IncomingArivalMasTenant` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for incarrivalproduct
-- ----------------------------
DROP TABLE IF EXISTS `incarrivalproduct`;
CREATE TABLE `incarrivalproduct`  (
  `id_arrivalproduct` int(11) NOT NULL AUTO_INCREMENT,
  `id_poproduct` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_arrival` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_arrivalproduct`) USING BTREE,
  INDEX `FK_IncArrivalProductIncPurchaseOrderProduk`(`id_poproduct`) USING BTREE,
  INDEX `FK_IncArrivalProductMasProduct`(`id_product`) USING BTREE,
  INDEX `FK_IncArrivalProductIncArrival`(`id_arrival`) USING BTREE,
  CONSTRAINT `FK_IncArrivalProductIncArrival` FOREIGN KEY (`id_arrival`) REFERENCES `incarrival` (`id_arrival`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_IncArrivalProductIncPurchaseOrderProduk` FOREIGN KEY (`id_poproduct`) REFERENCES `incpurchaseorderproduct` (`id_poproduct`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_IncArrivalProductMasProduct` FOREIGN KEY (`id_product`) REFERENCES `masproduct` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for incpurchaseorder
-- ----------------------------
DROP TABLE IF EXISTS `incpurchaseorder`;
CREATE TABLE `incpurchaseorder`  (
  `invoice_po` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_created` datetime(0) NULL DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_po` int(11) NOT NULL,
  PRIMARY KEY (`id_po`) USING BTREE,
  INDEX `FK_MasTenantIncPurchaseOrder`(`email_tenant`) USING BTREE,
  INDEX `id_po`(`id_po`) USING BTREE,
  CONSTRAINT `FK_MasTenantIncPurchaseOrder` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for incpurchaseorderdelivery
-- ----------------------------
DROP TABLE IF EXISTS `incpurchaseorderdelivery`;
CREATE TABLE `incpurchaseorderdelivery`  (
  `id_po` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `shipping_cost` decimal(10, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_po`) USING BTREE,
  INDEX `id_po`(`id_po`) USING BTREE,
  CONSTRAINT `FK_IncPurchaseOrderIncPurchaseOrderDelivery` FOREIGN KEY (`id_po`) REFERENCES `incpurchaseorder` (`id_po`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for incpurchaseorderpayment
-- ----------------------------
DROP TABLE IF EXISTS `incpurchaseorderpayment`;
CREATE TABLE `incpurchaseorderpayment`  (
  `id_po` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_due` datetime(0) NULL DEFAULT NULL,
  `payment_price` decimal(10, 0) NOT NULL,
  PRIMARY KEY (`id_po`) USING BTREE,
  CONSTRAINT `FK_IncPurchaseOrderIncIncPurchaseOrderPayment` FOREIGN KEY (`id_po`) REFERENCES `incpurchaseorder` (`id_po`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for incpurchaseorderproduct
-- ----------------------------
DROP TABLE IF EXISTS `incpurchaseorderproduct`;
CREATE TABLE `incpurchaseorderproduct`  (
  `id_poproduct` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime(0) NOT NULL DEFAULT current_timestamp(0),
  `id_po` int(11) NULL DEFAULT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` decimal(10, 0) NOT NULL,
  `subtotal` decimal(10, 0) NOT NULL,
  `expired_date` datetime(0) NULL DEFAULT NULL,
  `storage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_poproduct`) USING BTREE,
  INDEX `FK_IncPurchaseOrderIncPurchaseOrderProduct`(`id_po`) USING BTREE,
  INDEX `FK_MasProductIncPurchaseOrderProduct`(`id_product`) USING BTREE,
  CONSTRAINT `FK_IncPurchaseOrderIncPurchaseOrderProduct` FOREIGN KEY (`id_po`) REFERENCES `incpurchaseorder` (`id_po`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_MasProductIncPurchaseOrderProduct` FOREIGN KEY (`id_product`) REFERENCES `masproduct` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for incpurchaseordersupplier
-- ----------------------------
DROP TABLE IF EXISTS `incpurchaseordersupplier`;
CREATE TABLE `incpurchaseordersupplier`  (
  `id_po` int(11) NOT NULL,
  `id_supplier` int(11) NULL DEFAULT NULL,
  `tax_cost` decimal(10, 0) NULL DEFAULT NULL,
  INDEX `FK_MasSupplierIncPurchaseOrderSupplier`(`id_supplier`) USING BTREE,
  INDEX `FK_IncPurchaseOrderIncPurchaseOrderSupplier`(`id_po`) USING BTREE,
  CONSTRAINT `FK_IncPurchaseOrderIncPurchaseOrderSupplier` FOREIGN KEY (`id_po`) REFERENCES `incpurchaseorder` (`id_po`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_MasSupplierIncPurchaseOrderSupplier` FOREIGN KEY (`id_supplier`) REFERENCES `massupplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for invputaway
-- ----------------------------
DROP TABLE IF EXISTS `invputaway`;
CREATE TABLE `invputaway`  (
  `id_putaway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` datetime(0) NOT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_putaway`) USING BTREE,
  INDEX `FK_MasTenantInvPutAway`(`email_tenant`) USING BTREE,
  CONSTRAINT `FK_MasTenantInvPutAway` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for invputawayproduct
-- ----------------------------
DROP TABLE IF EXISTS `invputawayproduct`;
CREATE TABLE `invputawayproduct`  (
  `id_putawayproduct` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_expired` datetime(0) NULL DEFAULT NULL,
  `id_putaway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_putawayproduct`) USING BTREE,
  INDEX `FK_MasProductInvPutAwayProduct`(`id_product`) USING BTREE,
  INDEX `FK_InvPutAwayInvPutAwayProduct`(`id_putaway`) USING BTREE,
  CONSTRAINT `FK_InvPutAwayInvPutAwayProduct` FOREIGN KEY (`id_putaway`) REFERENCES `invputaway` (`id_putaway`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_MasProductInvPutAwayProduct` FOREIGN KEY (`id_product`) REFERENCES `masproduct` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for invstockopname
-- ----------------------------
DROP TABLE IF EXISTS `invstockopname`;
CREATE TABLE `invstockopname`  (
  `id_stockopname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` datetime(0) NOT NULL,
  `createdby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_stockopname`) USING BTREE,
  INDEX `FK_MasProductInvStockOpname`(`id_product`) USING BTREE,
  INDEX `FK_MasTenantInvStockOpname`(`email_tenant`) USING BTREE,
  CONSTRAINT `FK_MasProductInvStockOpname` FOREIGN KEY (`id_product`) REFERENCES `masproduct` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_MasTenantInvStockOpname` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mascourier
-- ----------------------------
DROP TABLE IF EXISTS `mascourier`;
CREATE TABLE `mascourier`  (
  `id_courier` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_courier`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mascustomer
-- ----------------------------
DROP TABLE IF EXISTS `mascustomer`;
CREATE TABLE `mascustomer`  (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_customertype` int(11) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_customer`) USING BTREE,
  INDEX `FK_MasCustomerMasTenant`(`email_tenant`) USING BTREE,
  INDEX `FK_MasCustomerMasCustomerTyoe`(`id_customertype`) USING BTREE,
  CONSTRAINT `FK_MasCustomerMasCustomerTyoe` FOREIGN KEY (`id_customertype`) REFERENCES `mascustomertype` (`Id_CustomerType`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_MasCustomerMasTenant` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mascustomer
-- ----------------------------
INSERT INTO `mascustomer` VALUES (1, 'dangga', 1, 'bojong\r\n', '079897987', 'dangga@gmail.com', 'anggaagustira@gmail.com', '');

-- ----------------------------
-- Table structure for mascustomertype
-- ----------------------------
DROP TABLE IF EXISTS `mascustomertype`;
CREATE TABLE `mascustomertype`  (
  `Id_CustomerType` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id_CustomerType`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mascustomertype
-- ----------------------------
INSERT INTO `mascustomertype` VALUES (1, 'Reguler');
INSERT INTO `mascustomertype` VALUES (2, 'Dropshipper');
INSERT INTO `mascustomertype` VALUES (3, 'Distributor');

-- ----------------------------
-- Table structure for masemployee
-- ----------------------------
DROP TABLE IF EXISTS `masemployee`;
CREATE TABLE `masemployee`  (
  `id_employee` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_employee`) USING BTREE,
  INDEX `FK_MasEmployeeMasTenant`(`email_tenant`) USING BTREE,
  CONSTRAINT `FK_MasEmployeeMasTenant` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of masemployee
-- ----------------------------
INSERT INTO `masemployee` VALUES (1, 'Dangga', 'anggaagustiraEmp@gmail.com', 'anggaagustira@gmail.com', 'default-avatar.png', '', NULL, NULL);
INSERT INTO `masemployee` VALUES (2, 'Angga Agustira', 'anggaagustiraEmp2@gmail.com', 'anggaagustira@gmail.com', 'default-avatar.png', '', NULL, NULL);
INSERT INTO `masemployee` VALUES (6, 'Faris', 'mzkalfarisi@gmail.com', 'a@a', 'default-avatar.png', '', NULL, NULL);

-- ----------------------------
-- Table structure for masmarketplace
-- ----------------------------
DROP TABLE IF EXISTS `masmarketplace`;
CREATE TABLE `masmarketplace`  (
  `id_marketplace` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_marketplace`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of masmarketplace
-- ----------------------------
INSERT INTO `masmarketplace` VALUES (1, 'Tokopedia');
INSERT INTO `masmarketplace` VALUES (2, 'Bukalapak');

-- ----------------------------
-- Table structure for maspiutang
-- ----------------------------
DROP TABLE IF EXISTS `maspiutang`;
CREATE TABLE `maspiutang`  (
  `id_piutang` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_so` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_utang` decimal(10, 0) NOT NULL,
  `total_bayar` decimal(10, 0) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_piutang`) USING BTREE,
  INDEX `FK_OutSalesOrderMasPiutang`(`invoice_so`) USING BTREE,
  CONSTRAINT `FK_OutSalesOrderMasPiutang` FOREIGN KEY (`invoice_so`) REFERENCES `outsalesorder` (`invoice_so`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for masproduct
-- ----------------------------
DROP TABLE IF EXISTS `masproduct`;
CREATE TABLE `masproduct`  (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` decimal(10, 0) NOT NULL,
  `selling_price` decimal(10, 0) NOT NULL,
  `actual_weight` double NULL DEFAULT NULL,
  `panjang` double NULL DEFAULT NULL,
  `lebar` double NULL DEFAULT NULL,
  `tinggi` double NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `minimum_stock` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_productunit` int(11) NOT NULL,
  `id_productcategory` int(11) NOT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_product`) USING BTREE,
  INDEX `FK_MasProductUnitMasProduct`(`id_productunit`) USING BTREE,
  INDEX `FK_MasProductCategoryMasProduct`(`id_productcategory`) USING BTREE,
  INDEX `FK_MasTenantMasProduct`(`email_tenant`) USING BTREE,
  CONSTRAINT `FK_MasProductCategoryMasProduct` FOREIGN KEY (`id_productcategory`) REFERENCES `masproductcategory` (`id_productcategory`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_MasProductUnitMasProduct` FOREIGN KEY (`id_productunit`) REFERENCES `masproductunit` (`id_productunit`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_MasTenantMasProduct` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of masproduct
-- ----------------------------
INSERT INTO `masproduct` VALUES (8, '001', 'EA507EDF-8D98-4F2B-9478-B55CB68D442C', 'EA507EDF-8D98-4F2B-9478-B55CB68D442C.png', 'Minum Makanan Bergizi', 2, 10000, 10000, 0, 0, 0, 0, '', 2, 'Active', 3, 4, 'a@a', 'default-product.png');
INSERT INTO `masproduct` VALUES (9, '002', '34E09EA2-DAA0-4351-BCF9-792F9A69967C', '34E09EA2-DAA0-4351-BCF9-792F9A69967C.png', 'Siapa Yang Pantas', 3, 3000, 1, 0, 0, 0, 0, '', 0, 'Active', 3, 4, 'a@a', 'default-product.png');
INSERT INTO `masproduct` VALUES (10, '003', '4C30CB7C-2A62-4D32-AF67-5CA979592C95', '4C30CB7C-2A62-4D32-AF67-5CA979592C95.png', 'Yang Mana Saja', 0, 10000, 1000, 0, 0, 0, 0, '', 0, 'Active', 3, 4, 'a@a', 'default-product.png');
INSERT INTO `masproduct` VALUES (11, '004', 'CE6B639A-E57C-4AB6-8FFA-7D6FDFFABC74', 'CE6B639A-E57C-4AB6-8FFA-7D6FDFFABC74.png', 'Coba Yang ke 4', 1, 10000, 3000, 0, 0, 0, 0, '', 2, 'Active', 3, 4, 'a@a', 'default-product.png');
INSERT INTO `masproduct` VALUES (12, 'Auto Generated', 'A01D040C-4110-40AF-99BA-5782C17527C5', 'A01D040C-4110-40AF-99BA-5782C17527C5.png', 'Ini percobaan ke 5', 0, 12, 12000, 0, 0, 0, 0, '', 3, 'Active', 4, 4, 'a@a', 'default-product.png');
INSERT INTO `masproduct` VALUES (13, '220505', '80883ECF-A1E0-4870-BE19-6BA7E4199237', '80883ECF-A1E0-4870-BE19-6BA7E4199237.png', '6', 6, 6, 6000, 6, 6, 6, 6, '6', 3, 'Active', 3, 4, 'a@a', 'default-product.png');
INSERT INTO `masproduct` VALUES (14, '220505-071043', '88966618-207A-4632-9C50-98957A7974CD', '88966618-207A-4632-9C50-98957A7974CD.png', 'faris', 1, 1, 1000, 0, 0, 0, 0, '', 3, 'Active', 3, 4, 'a@a', 'default-product.png');
INSERT INTO `masproduct` VALUES (15, '0', 'DDA3285E-248D-47C9-9D41-0AE9EDF72EC6', 'DDA3285E-248D-47C9-9D41-0AE9EDF72EC6.png', 'fafa', 100, 100, 100, 0, 0, 0, 0, '', 3, 'Active', 3, 4, 'a@a', 'default-product.png');

-- ----------------------------
-- Table structure for masproductcategory
-- ----------------------------
DROP TABLE IF EXISTS `masproductcategory`;
CREATE TABLE `masproductcategory`  (
  `id_productcategory` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_productcategory`) USING BTREE,
  INDEX `FK_MasTenantMasProductCategory`(`email_tenant`) USING BTREE,
  CONSTRAINT `FK_MasTenantMasProductCategory` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of masproductcategory
-- ----------------------------
INSERT INTO `masproductcategory` VALUES (4, 'Makanan', 'a@a', '');
INSERT INTO `masproductcategory` VALUES (5, 'Minuman', 'a@a', '');

-- ----------------------------
-- Table structure for masproductgrosir
-- ----------------------------
DROP TABLE IF EXISTS `masproductgrosir`;
CREATE TABLE `masproductgrosir`  (
  `id_productgrosir` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `minimum_quantity` int(11) NOT NULL,
  `selling_price` decimal(10, 0) NOT NULL,
  `id_product` int(11) NOT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_productgrosir`) USING BTREE,
  INDEX `FK_MasProductMasProductGrosir`(`id_product`) USING BTREE,
  INDEX `FK_MasTenantMasProductGrosir`(`email_tenant`) USING BTREE,
  CONSTRAINT `FK_MasProductMasProductGrosir` FOREIGN KEY (`id_product`) REFERENCES `masproduct` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_MasTenantMasProductGrosir` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for masproductunit
-- ----------------------------
DROP TABLE IF EXISTS `masproductunit`;
CREATE TABLE `masproductunit`  (
  `id_productunit` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_productunit`) USING BTREE,
  INDEX `FK_MasTenantMasProductUnit`(`email_tenant`) USING BTREE,
  CONSTRAINT `FK_MasTenantMasProductUnit` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of masproductunit
-- ----------------------------
INSERT INTO `masproductunit` VALUES (3, 'Pcs', 'a@a');
INSERT INTO `masproductunit` VALUES (4, 'Box', 'a@a');
INSERT INTO `masproductunit` VALUES (5, 'Galon', 'a@a');

-- ----------------------------
-- Table structure for massupplier
-- ----------------------------
DROP TABLE IF EXISTS `massupplier`;
CREATE TABLE `massupplier`  (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone_number` int(11) NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_supplier`) USING BTREE,
  INDEX `FK_MasSupplierMasTenant`(`email_tenant`) USING BTREE,
  CONSTRAINT `FK_MasSupplierMasTenant` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of massupplier
-- ----------------------------
INSERT INTO `massupplier` VALUES (1, 'Faris', 'nsdjsad\r\n', 8, 'asa@sas', 'a@a', 'active');

-- ----------------------------
-- Table structure for mastenant
-- ----------------------------
DROP TABLE IF EXISTS `mastenant`;
CREATE TABLE `mastenant`  (
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`email_tenant`, `id_tenant`) USING BTREE,
  INDEX `email_tenant`(`email_tenant`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mastenant
-- ----------------------------
INSERT INTO `mastenant` VALUES ('a@a', 'Faris', '', '6285329981115', 'default-avatar.png', '');
INSERT INTO `mastenant` VALUES ('anggaagustira@gmail.com', 'Angga', '', '6281395145194', 'default-avatar.png', '');
INSERT INTO `mastenant` VALUES ('s@s', 'Makanan', '', '62121212121', 'default-avatar.png', '');

-- ----------------------------
-- Table structure for mastoko
-- ----------------------------
DROP TABLE IF EXISTS `mastoko`;
CREATE TABLE `mastoko`  (
  `id_toko` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` int(11) NULL DEFAULT NULL,
  `komisi` int(11) NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_marketplace` int(255) NOT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_toko`) USING BTREE,
  INDEX `FK_MasTokoMasTenant`(`email_tenant`) USING BTREE,
  INDEX `FK_MasTokoMasMarketplace`(`id_marketplace`) USING BTREE,
  CONSTRAINT `FK_MasTokoMasMarketplace` FOREIGN KEY (`id_marketplace`) REFERENCES `masmarketplace` (`id_marketplace`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_MasTokoMasTenant` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mastoko
-- ----------------------------
INSERT INTO `mastoko` VALUES (1, 'Danggakom', 2133123, 12, 'default-store.png', 1, 'anggaagustira@gmail.com', '');
INSERT INTO `mastoko` VALUES (2, 'anggakom', 8888888, 10, 'default-store.png', 2, 'anggaagustira@gmail.com', '');

-- ----------------------------
-- Table structure for masutang
-- ----------------------------
DROP TABLE IF EXISTS `masutang`;
CREATE TABLE `masutang`  (
  `id_utang` int(11) NOT NULL AUTO_INCREMENT,
  `id_po` int(11) NULL DEFAULT NULL,
  `total_utang` decimal(10, 0) NOT NULL,
  `total_bayar` decimal(10, 0) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_utang`) USING BTREE,
  INDEX `FK_IncPurchaseOrderMasUtang`(`id_po`) USING BTREE,
  CONSTRAINT `FK_IncPurchaseOrderMasUtang` FOREIGN KEY (`id_po`) REFERENCES `incpurchaseorder` (`id_po`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for maswarehouse
-- ----------------------------
DROP TABLE IF EXISTS `maswarehouse`;
CREATE TABLE `maswarehouse`  (
  `id_warehouse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_warehouse`) USING BTREE,
  INDEX `FK_MasTenantMasWarehouse`(`email_tenant`) USING BTREE,
  CONSTRAINT `FK_MasTenantMasWarehouse` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of maswarehouse
-- ----------------------------
INSERT INTO `maswarehouse` VALUES ('0000001', 'FarisOk', 'Jalan Arbei Raya', 'default-warehouse.png', 'a@a');

-- ----------------------------
-- Table structure for outsalesorder
-- ----------------------------
DROP TABLE IF EXISTS `outsalesorder`;
CREATE TABLE `outsalesorder`  (
  `invoice_so` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `airway_bill` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_marketplace` int(11) NULL DEFAULT NULL,
  `id_toko` int(11) NULL DEFAULT NULL,
  `date_created` datetime(0) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_tenant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`invoice_so`) USING BTREE,
  INDEX `FK_MasMarketplaceOutSalesOrder`(`id_marketplace`) USING BTREE,
  INDEX `FK_MasTokoOutSalesOrder`(`id_toko`) USING BTREE,
  INDEX `FK_MasTenantOutSalesOrder`(`email_tenant`) USING BTREE,
  CONSTRAINT `FK_MasMarketplaceOutSalesOrder` FOREIGN KEY (`id_marketplace`) REFERENCES `masmarketplace` (`id_marketplace`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_MasTenantOutSalesOrder` FOREIGN KEY (`email_tenant`) REFERENCES `mastenant` (`email_tenant`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_MasTokoOutSalesOrder` FOREIGN KEY (`id_toko`) REFERENCES `mastoko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for outsalesordercustomer
-- ----------------------------
DROP TABLE IF EXISTS `outsalesordercustomer`;
CREATE TABLE `outsalesordercustomer`  (
  `invoice_so` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_customer` int(11) NOT NULL,
  `discount` decimal(10, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`invoice_so`) USING BTREE,
  INDEX `FK_MasCustomerOutSalesOrderCustomer`(`id_customer`) USING BTREE,
  CONSTRAINT `FK_MasCustomerOutSalesOrderCustomer` FOREIGN KEY (`id_customer`) REFERENCES `mascustomer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_OutSalesOrderOutSalesOrderCustomer` FOREIGN KEY (`invoice_so`) REFERENCES `outsalesorder` (`invoice_so`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for outsalesorderdelivery
-- ----------------------------
DROP TABLE IF EXISTS `outsalesorderdelivery`;
CREATE TABLE `outsalesorderdelivery`  (
  `invoice_so` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_courier` int(11) NOT NULL,
  `shipping_cost` decimal(10, 0) NOT NULL,
  `airway_bill` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`invoice_so`) USING BTREE,
  INDEX `FK_MasCourierOutSalesOrderDelivery`(`id_courier`) USING BTREE,
  CONSTRAINT `FK_MasCourierOutSalesOrderDelivery` FOREIGN KEY (`id_courier`) REFERENCES `mascourier` (`id_courier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_OutSalesOrderOutSalesOrderDelivery` FOREIGN KEY (`invoice_so`) REFERENCES `outsalesorder` (`invoice_so`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for outsalesorderpayment
-- ----------------------------
DROP TABLE IF EXISTS `outsalesorderpayment`;
CREATE TABLE `outsalesorderpayment`  (
  `invoice_so` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment_price` decimal(10, 0) NOT NULL,
  `rek_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `discount` decimal(10, 0) NULL DEFAULT NULL,
  `date_due` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`invoice_so`) USING BTREE,
  CONSTRAINT `FK_OutSalesOrderOutSalesOrderPayment` FOREIGN KEY (`invoice_so`) REFERENCES `outsalesorder` (`invoice_so`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for outsalesorderproduct
-- ----------------------------
DROP TABLE IF EXISTS `outsalesorderproduct`;
CREATE TABLE `outsalesorderproduct`  (
  `id_soproduct` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_so` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `selling_price` decimal(10, 0) NOT NULL,
  `discount` decimal(10, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_soproduct`) USING BTREE,
  INDEX `FK_OutSalesOrderOutSalesOrderProduct`(`invoice_so`) USING BTREE,
  INDEX `FK_MasProductOutSalesOrderProduct`(`id_product`) USING BTREE,
  CONSTRAINT `FK_MasProductOutSalesOrderProduct` FOREIGN KEY (`id_product`) REFERENCES `masproduct` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_OutSalesOrderOutSalesOrderProduct` FOREIGN KEY (`invoice_so`) REFERENCES `outsalesorder` (`invoice_so`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for secmenu
-- ----------------------------
DROP TABLE IF EXISTS `secmenu`;
CREATE TABLE `secmenu`  (
  `menuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `parentid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `menuname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `menusort` int(11) NOT NULL,
  `controller` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `iconclass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `menugroup` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `menukey` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tenant` int(11) NULL DEFAULT NULL,
  `employee` int(11) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of secmenu
-- ----------------------------
INSERT INTO `secmenu` VALUES ('1.1', '1', 'Main', 1, '-', '-', '-\r\nfa-chart-pie\r\n-\r\nfa-shield-alt\r\n-\r\n-\r\nfa-user\r\nfa-warehouse\r\nfa-archive\r\n-\r\n-\r\n-\r\n-\r\nfa-store\r\nfa-user-tie\r\nfa-user-friends\r\nfa-users\r\n-\r\n-\r\nfa-shipping-fast\r\nfa-users\r\n-\r\nfa-cart-plus\r\nfa-truck-loading\r\n-\r\nfa-dolly-flatbed\r\nfa-boxes\r\n-\r\nfa-shopping-ba', 'Module', '-', '1', 1, 1);
INSERT INTO `secmenu` VALUES ('1.1.1', '1.1', 'Dashboard', 2, 'Dashboards', 'Index', 'fa-chart-pie', 'Parent', 'Dashboards', '1', 1, 1);
INSERT INTO `secmenu` VALUES ('1.2', '1', 'Maintenance', 3, '-', '-', '-', 'Module', '-', '1', 1, 0);
INSERT INTO `secmenu` VALUES ('1.2.1', '1.2', 'Security', 4, '-', '-', 'fa-shield-alt', 'Parent', 'Security', '1', 0, 0);
INSERT INTO `secmenu` VALUES ('1.2.1.1', '1.2.1', 'User Roles', 5, 'UserRoles', 'Index', '-', 'Child', 'Security', '1', 0, 0);
INSERT INTO `secmenu` VALUES ('1.2.1.2', '1.2.1', 'Users', 6, 'Users', 'Index', '-', 'Child', 'Security', '1', 0, 0);
INSERT INTO `secmenu` VALUES ('1.2.2', '1.2', 'Tenant', 7, 'Tenants', 'Index', 'fa-user', 'Parent', 'Tenants', '1', 0, 0);
INSERT INTO `secmenu` VALUES ('1.2.3', '1.2', 'Warehouse', 8, 'Warehouses', 'Index', 'fa-warehouse', 'Parent', 'Warehouses', '1', 1, 0);
INSERT INTO `secmenu` VALUES ('1.2.4', '1.2', 'Product', 9, '-', '-', 'fa-archive', 'Parent', 'Products', '1', 1, 0);
INSERT INTO `secmenu` VALUES ('1.2.4.1', '1.2.4', 'Product Item', 10, 'ProductUnits', 'Index', '-', 'Child', 'Products', '1', 1, 0);
INSERT INTO `secmenu` VALUES ('1.2.4.2', '1.2.4', 'Product Kategori', 11, 'ProductCategories', 'Index', '-', 'Child', 'Products', '1', 1, 0);
INSERT INTO `secmenu` VALUES ('1.2.4.3', '1.2.4', 'Product Data', 12, 'Products', 'Index', '-', 'Child', 'Products', '1', 1, 0);
INSERT INTO `secmenu` VALUES ('1.2.4.4', '1.2.4', 'Wholesale Products', 13, 'UnderConstructions', 'Index', '-', 'Child', 'Products', '1', 1, 0);
INSERT INTO `secmenu` VALUES ('1.2.5', '1.2', 'Stores', 14, 'Stores', 'Index', 'fa-city', 'Parent', 'Stores', '1', 1, 0);
INSERT INTO `secmenu` VALUES ('1.2.6', '1.2', 'Employees', 15, 'Employees', 'Index', 'fa-user-tie', 'Parent', 'Employees', '1', 1, 0);
INSERT INTO `secmenu` VALUES ('1.2.7', '1.2', 'Suppliers', 16, 'Suppliers', 'Index', 'fa-user-friends', 'Parent', 'Suppliers', '1', 1, 0);
INSERT INTO `secmenu` VALUES ('1.2.8', '1.2', 'Customer', 17, '-', '-', 'fa-users', 'Parent', 'Customers', '1', 1, 0);
INSERT INTO `secmenu` VALUES ('1.2.8.1', '1.2.8', 'Customer Type', 18, 'CustomersType', 'Index', '-', 'Child', 'Customers', '1', 0, 0);
INSERT INTO `secmenu` VALUES ('1.2.8.2', '1.2.8', 'Customers', 19, 'Customers', 'Index', '-', 'Child', 'Customers', '1', 1, 0);
INSERT INTO `secmenu` VALUES ('1.2.9', '1.2', 'Couriers', 20, 'UnderConstructions', 'Index', 'fa-shipping-fast', 'Parent', 'Couriers', '1', 0, 0);
INSERT INTO `secmenu` VALUES ('1.2.10', '1.2', 'Marketplaces', 21, 'UnderConstructions', 'Index', 'fa-store', 'Parent', 'Marketplaces', '1', 0, 0);
INSERT INTO `secmenu` VALUES ('1.3', '1', 'Incoming', 22, '-', '-', '-', 'Module', '-', '1', 1, 1);
INSERT INTO `secmenu` VALUES ('1.3.1', '1.3', 'Purchase Orders', 23, 'PurchaseOrders', 'Index', 'fa-cart-plus', 'Parent', 'Purchase Orders', '1', 1, 1);
INSERT INTO `secmenu` VALUES ('1.4', '1', 'Inventory', 25, '-', '-', '-', 'Module', '-', '1', 1, 1);
INSERT INTO `secmenu` VALUES ('1.4.2', '1.4', 'Stock Opname', 27, 'UnderConstructions', 'Index', 'fa-boxes', 'Parent', 'Stock Opname', '1', 1, 1);
INSERT INTO `secmenu` VALUES ('1.5', '1', 'Out Going', 28, '-', '-', '-', 'Module', '-', '1', 1, 1);
INSERT INTO `secmenu` VALUES ('1.5.1', '1.5', 'Sales Orders', 29, 'UnderConstructions', 'Index', 'fa-shopping-basket', 'Parent', 'Sales Orders', '1', 1, 1);
INSERT INTO `secmenu` VALUES ('1.6', '1', 'Transaction', 30, '-', '-', '-', 'Module', '-', '1', 1, 1);
INSERT INTO `secmenu` VALUES ('1.6.1', '1.6', 'Utang', 32, 'UnderConstructions', 'Index', '-', 'Parent', 'Utang', '1', 1, 1);
INSERT INTO `secmenu` VALUES ('1.6.2', '1.6', 'Piutang', 33, 'UnderConstructions', 'Index', '-', 'Parent', 'Piutang', '1', 1, 1);

-- ----------------------------
-- Table structure for secuser
-- ----------------------------
DROP TABLE IF EXISTS `secuser`;
CREATE TABLE `secuser`  (
  `email_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_confirmed` tinyint(1) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_usertype` int(11) NOT NULL,
  PRIMARY KEY (`email_user`) USING BTREE,
  INDEX `FK_SecUserRoleSecUser`(`id_usertype`) USING BTREE,
  CONSTRAINT `FK_SecUserRoleSecUser` FOREIGN KEY (`id_usertype`) REFERENCES `secuserrole` (`id_usertype`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of secuser
-- ----------------------------
INSERT INTO `secuser` VALUES ('a@a', '$2y$12$b1egvDFCXhccONpHttt.6O3S5Pd9Okjq5/dYJXeSRs3U4biSGFV9C', 'fd94aa907f620ba891bb63807108be9e', 0, 'active', 2);
INSERT INTO `secuser` VALUES ('admin', '$2y$12$c4cd4a1f900f538b77e01un3qNM3mgZ5A.sZPfdawzeyCqwS0t2bC', 'c4cd4a1f900f538b77e0125ffa60099b', 1, 'active', 1);
INSERT INTO `secuser` VALUES ('anggaagustira@gmail.com', '$2y$12$Lrlnf4Otw9E.E/eKGtIgTunV56T.EUhfpvemdW94O2xKkiGHzUTTy', '929d87dffe160fb12044a499f5d8eada', 0, 'active', 2);
INSERT INTO `secuser` VALUES ('mzkalfarisi@gmail.com', '$2y$12$dhElONOGOA0RjhMuT8OghOG9hIeCcoBkY3gDnkbaJX0xQ1BnL.68C', 'b2cf4d777549785d69b19b4a7d82ee9b', 0, 'active', 3);
INSERT INTO `secuser` VALUES ('s@s', '$2y$12$XDduvQXHS8kyztcVKe0vxeBTxwudVUx17BQqUAMXvjS16LOJ.KHrO', '932ca1a4def25706fa3659477a39ba45', 0, 'active', 2);

-- ----------------------------
-- Table structure for secuserrole
-- ----------------------------
DROP TABLE IF EXISTS `secuserrole`;
CREATE TABLE `secuserrole`  (
  `id_usertype` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_usertype`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of secuserrole
-- ----------------------------
INSERT INTO `secuserrole` VALUES (1, 'Admin', 'admin', 'active');
INSERT INTO `secuserrole` VALUES (2, 'Tenant', 'tenant', 'active');
INSERT INTO `secuserrole` VALUES (3, 'Employee', 'employee', 'active');

SET FOREIGN_KEY_CHECKS = 1;
