/*
Navicat MySQL Data Transfer

Source Server         : LOCALHOST
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : akh

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2014-05-26 16:53:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `master_provinsi`
-- ----------------------------
DROP TABLE IF EXISTS `master_provinsi`;
CREATE TABLE `master_provinsi` (
  `provinsi_id` int(10) NOT NULL AUTO_INCREMENT,
  `provinsi_nama` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`provinsi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_provinsi
-- ----------------------------
INSERT INTO `master_provinsi` VALUES ('1', 'Nanggroe Aceh Darussalam');
INSERT INTO `master_provinsi` VALUES ('2', 'Sumatera Utara');
INSERT INTO `master_provinsi` VALUES ('3', 'Sumatera Barat');
INSERT INTO `master_provinsi` VALUES ('4', 'Riau');
INSERT INTO `master_provinsi` VALUES ('5', 'Kepulauan Riau');
INSERT INTO `master_provinsi` VALUES ('6', 'Kepulauan Bangka-Belitung');
INSERT INTO `master_provinsi` VALUES ('7', 'Jambi');
INSERT INTO `master_provinsi` VALUES ('8', 'Bengkulu');
INSERT INTO `master_provinsi` VALUES ('9', 'Sumatera Selatan');
INSERT INTO `master_provinsi` VALUES ('10', 'Lampung');
INSERT INTO `master_provinsi` VALUES ('11', 'Banten');
INSERT INTO `master_provinsi` VALUES ('12', 'DKI Jakarta');
INSERT INTO `master_provinsi` VALUES ('13', 'Jawa Barat');
INSERT INTO `master_provinsi` VALUES ('14', 'Jawa Tengah');
INSERT INTO `master_provinsi` VALUES ('15', 'Daerah Istimewa Yogyakarta  ');
INSERT INTO `master_provinsi` VALUES ('16', 'Jawa Timur');
INSERT INTO `master_provinsi` VALUES ('17', 'Bali');
INSERT INTO `master_provinsi` VALUES ('18', 'Nusa Tenggara Barat');
INSERT INTO `master_provinsi` VALUES ('19', 'Nusa Tenggara Timur');
INSERT INTO `master_provinsi` VALUES ('20', 'Kalimantan Barat');
INSERT INTO `master_provinsi` VALUES ('21', 'Kalimantan Tengah');
INSERT INTO `master_provinsi` VALUES ('22', 'Kalimantan Selatan');
INSERT INTO `master_provinsi` VALUES ('23', 'Kalimantan Timur');
INSERT INTO `master_provinsi` VALUES ('24', 'Gorontalo');
INSERT INTO `master_provinsi` VALUES ('25', 'Sulawesi Selatan');
INSERT INTO `master_provinsi` VALUES ('26', 'Sulawesi Tenggara');
INSERT INTO `master_provinsi` VALUES ('27', 'Sulawesi Tengah');
INSERT INTO `master_provinsi` VALUES ('28', 'Sulawesi Utara');
INSERT INTO `master_provinsi` VALUES ('29', 'Sulawesi Barat');
INSERT INTO `master_provinsi` VALUES ('30', 'Maluku');
INSERT INTO `master_provinsi` VALUES ('31', 'Maluku Utara');
INSERT INTO `master_provinsi` VALUES ('32', 'Papua Barat');
INSERT INTO `master_provinsi` VALUES ('33', 'Papua');
INSERT INTO `master_provinsi` VALUES ('34', 'Kalimantan Utara');
