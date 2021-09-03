/*
 Navicat Premium Data Transfer

 Source Server         : localhost-wamp64
 Source Server Type    : MySQL
 Source Server Version : 50731
 Source Host           : localhost:3306
 Source Schema         : db_productos

 Target Server Type    : MySQL
 Target Server Version : 50731
 File Encoding         : 65001

 Date: 03/09/2021 12:23:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categoria
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria`  (
  `categoria_id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoria_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`categoria_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO `categoria` VALUES (1, 'CELULARES');
INSERT INTO `categoria` VALUES (2, 'LAPTOPS');
INSERT INTO `categoria` VALUES (3, 'TABLETS');
INSERT INTO `categoria` VALUES (6, 'REFRIGERADORAS');
INSERT INTO `categoria` VALUES (7, 'CATEGORIA 1');
INSERT INTO `categoria` VALUES (8, 'CATEGORÍA 2');
INSERT INTO `categoria` VALUES (9, 'CATEGORÍA 3');
INSERT INTO `categoria` VALUES (10, 'COCINA');

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto`  (
  `producto_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `producto_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `producto_referencia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `producto_precio` mediumint(255) NOT NULL,
  `categoria_id` int(255) UNSIGNED NOT NULL,
  `producto_stock` int(255) NOT NULL,
  `fecha_creacion` datetime(0) NOT NULL,
  `fecha_ult_venta` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`producto_id`) USING BTREE,
  INDEX `categoria_fk`(`categoria_id`) USING BTREE,
  CONSTRAINT `categoria_fk` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES (1, 'LAPTOP HP', 'HP CORE I7 10MA', 5000, 2, 10, '2021-09-03 10:52:05', NULL);
INSERT INTO `producto` VALUES (2, 'REFRI LG', 'MARCA LG', 1000, 6, 100, '2021-09-03 16:35:04', NULL);
INSERT INTO `producto` VALUES (3, 'TABLET LENOVO S50', 'LENOVO', 1000, 3, 18, '2021-09-03 16:36:40', NULL);
INSERT INTO `producto` VALUES (5, 'PRODUCTO52223', '5FEFE2223', 1203, 9, 12003, '2021-09-03 17:01:06', NULL);

SET FOREIGN_KEY_CHECKS = 1;
