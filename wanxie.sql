/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : wanxie

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-11-15 09:05:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `addressid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `addressarea` varchar(255) DEFAULT NULL,
  `addressdetail` varchar(255) DEFAULT NULL,
  `postal` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`addressid`),
  KEY `userid` (`userid`),
  CONSTRAINT `address_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('4', '11', '福建省 厦门市 集美区', '后溪镇 软件园三期 D03公寓', '324323', '土豆', '15911111111');
INSERT INTO `address` VALUES ('5', '11', '个人股', '而王菲王菲', '23424', '个人股', '1546456887');

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `adminname` varchar(255) NOT NULL,
  `adminpwd` varchar(255) DEFAULT NULL,
  `adminnote` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');
INSERT INTO `admin` VALUES ('12', 'jj', 'bf2bc2545a4a5f5683d9ef3ed0d977e0', 'jj');
INSERT INTO `admin` VALUES ('13', '胜哥', '202cb962ac59075b964b07152d234b70', '123');

-- ----------------------------
-- Table structure for `admingroup`
-- ----------------------------
DROP TABLE IF EXISTS `admingroup`;
CREATE TABLE `admingroup` (
  `agid` int(11) NOT NULL AUTO_INCREMENT,
  `adminid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`agid`),
  KEY `adminid` (`adminid`),
  KEY `groupid` (`groupid`),
  CONSTRAINT `admingroup_ibfk_1` FOREIGN KEY (`adminid`) REFERENCES `admin` (`adminid`),
  CONSTRAINT `admingroup_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `group` (`groupid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of admingroup
-- ----------------------------
INSERT INTO `admingroup` VALUES ('1', '1', '1');
INSERT INTO `admingroup` VALUES ('12', '12', '7');
INSERT INTO `admingroup` VALUES ('13', '13', '2');

-- ----------------------------
-- Table structure for `belong`
-- ----------------------------
DROP TABLE IF EXISTS `belong`;
CREATE TABLE `belong` (
  `pttid` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(11) DEFAULT NULL,
  `typeid` int(11) DEFAULT NULL,
  `brandid` int(11) DEFAULT NULL,
  `colorid` int(11) DEFAULT NULL,
  `sizeid` int(11) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL COMMENT '1为男鞋,0为女鞋',
  PRIMARY KEY (`pttid`),
  KEY `productid` (`productid`),
  KEY `typeid` (`typeid`),
  KEY `brandid` (`brandid`),
  KEY `colorid` (`colorid`),
  KEY `sizeid` (`sizeid`),
  CONSTRAINT `belong_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`),
  CONSTRAINT `belong_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `type` (`typeid`),
  CONSTRAINT `belong_ibfk_3` FOREIGN KEY (`brandid`) REFERENCES `brand` (`brandid`),
  CONSTRAINT `belong_ibfk_4` FOREIGN KEY (`colorid`) REFERENCES `color` (`colorid`),
  CONSTRAINT `belong_ibfk_5` FOREIGN KEY (`sizeid`) REFERENCES `size` (`sizeid`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of belong
-- ----------------------------
INSERT INTO `belong` VALUES ('5', '27', '30', '3', '2', '2', '1');
INSERT INTO `belong` VALUES ('6', '28', '31', '1', '4', '1', '0');
INSERT INTO `belong` VALUES ('7', '29', '33', '2', '3', '1', '2');
INSERT INTO `belong` VALUES ('8', '33', '31', '4', '2', '12', '0');
INSERT INTO `belong` VALUES ('9', '34', '32', '3', '4', '12', '1');
INSERT INTO `belong` VALUES ('13', '38', '30', '2', '2', '3', '0');
INSERT INTO `belong` VALUES ('14', '39', '32', '5', '3', '9', '1');
INSERT INTO `belong` VALUES ('15', '40', '30', '4', '5', '4', '2');
INSERT INTO `belong` VALUES ('16', '41', '29', '2', '3', '4', '1');
INSERT INTO `belong` VALUES ('19', '44', '30', '2', '1', '3', '1');
INSERT INTO `belong` VALUES ('22', '47', '33', '3', '3', '11', '1');
INSERT INTO `belong` VALUES ('23', '48', '32', '3', '1', '10', '1');
INSERT INTO `belong` VALUES ('24', '49', '29', '6', '4', '17', '0');
INSERT INTO `belong` VALUES ('25', '50', '29', '1', '1', '4', '1');
INSERT INTO `belong` VALUES ('26', '51', '30', '3', '3', '3', '1');
INSERT INTO `belong` VALUES ('27', '52', '30', '2', '2', '4', '1');
INSERT INTO `belong` VALUES ('28', '53', '30', '4', '5', '2', '1');
INSERT INTO `belong` VALUES ('29', '54', '30', '1', '6', '4', '1');
INSERT INTO `belong` VALUES ('30', '55', '30', '4', '3', '5', '1');
INSERT INTO `belong` VALUES ('31', '56', '30', '3', '7', '2', '1');
INSERT INTO `belong` VALUES ('32', '57', '30', '1', '7', '6', '1');
INSERT INTO `belong` VALUES ('34', '59', '30', '1', '7', '6', '1');
INSERT INTO `belong` VALUES ('35', '60', '30', '2', '2', '6', '1');
INSERT INTO `belong` VALUES ('36', '61', '30', '3', '4', '5', '1');
INSERT INTO `belong` VALUES ('37', '62', '30', '3', '2', '4', '1');
INSERT INTO `belong` VALUES ('38', '63', '30', '4', '6', '3', '1');
INSERT INTO `belong` VALUES ('39', '64', '30', '2', '3', '6', '1');
INSERT INTO `belong` VALUES ('40', '65', '30', '4', '5', '2', '1');
INSERT INTO `belong` VALUES ('41', '66', '30', '5', '6', '2', '1');

-- ----------------------------
-- Table structure for `brand`
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `brandid` int(11) NOT NULL AUTO_INCREMENT,
  `brandname` varchar(255) DEFAULT NULL,
  `brandnote` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`brandid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES ('1', '耐克', 'NIKE');
INSERT INTO `brand` VALUES ('2', '阿迪达斯', '阿迪达斯');
INSERT INTO `brand` VALUES ('3', '彪马', '彪马');
INSERT INTO `brand` VALUES ('4', '李宁', '李宁');
INSERT INTO `brand` VALUES ('5', '361', '361');
INSERT INTO `brand` VALUES ('6', '乔丹', '乔丹');

-- ----------------------------
-- Table structure for `cart`
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `cartid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  `productnum` int(11) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`cartid`),
  KEY `userid` (`userid`),
  KEY `productid` (`productid`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES ('2', '11', '38', '4', '2018-11-12 10:32:03');
INSERT INTO `cart` VALUES ('3', null, '61', '1', '2018-11-13 18:49:58');
INSERT INTO `cart` VALUES ('4', null, '48', '1', '2018-11-13 18:50:16');
INSERT INTO `cart` VALUES ('5', null, '63', '1', '2018-11-13 18:50:21');

-- ----------------------------
-- Table structure for `color`
-- ----------------------------
DROP TABLE IF EXISTS `color`;
CREATE TABLE `color` (
  `colorid` int(11) NOT NULL AUTO_INCREMENT,
  `colorname` varchar(255) DEFAULT NULL,
  `colornote` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`colorid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of color
-- ----------------------------
INSERT INTO `color` VALUES ('1', '黑', '#000000');
INSERT INTO `color` VALUES ('2', '紫', '#000040');
INSERT INTO `color` VALUES ('3', '白', '#ffffff');
INSERT INTO `color` VALUES ('4', '红', '#ff0000');
INSERT INTO `color` VALUES ('5', '黄', '#ffff00');
INSERT INTO `color` VALUES ('6', '绿', '#00ff00');
INSERT INTO `color` VALUES ('7', '蓝', '#0000ff');
INSERT INTO `color` VALUES ('8', '棕', '#606060');
INSERT INTO `color` VALUES ('9', '灰', '#909090');
INSERT INTO `color` VALUES ('10', '粉', '#fe9d9a');

-- ----------------------------
-- Table structure for `group`
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pids` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=sjis;

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES ('1', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11');
INSERT INTO `group` VALUES ('2', '普通管理员', '1,2,3,5,6,7,9');
INSERT INTO `group` VALUES ('7', '渣渣管理员', '');

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `orderid` varchar(255) NOT NULL,
  `orderdate` varchar(255) DEFAULT NULL,
  `ordermoney` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `orderstate` int(1) DEFAULT '0' COMMENT '0未处理,1已处理',
  `ispay` int(1) DEFAULT '0' COMMENT '1为已支付,0为未支付',
  `payway` int(1) DEFAULT NULL COMMENT '1为支付宝,0为微信',
  `allproductnum` int(11) DEFAULT NULL,
  `addressid` int(11) DEFAULT NULL,
  PRIMARY KEY (`orderid`),
  KEY `userid` (`userid`),
  KEY `addressid` (`addressid`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`addressid`) REFERENCES `address` (`addressid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('000020181108125738', '2018-11-08 12:57:38', '14710', '11', '1', '1', '1', '5', '5');
INSERT INTO `order` VALUES ('000020181108125926', '2018-11-08 12:59:26', '666', '11', '0', '0', null, '2', '4');
INSERT INTO `order` VALUES ('000020181108130624', '2018-11-08 13:06:24', '999', '11', '0', '0', null, '3', '4');
INSERT INTO `order` VALUES ('000020181109171457', '2018-11-09 17:14:57', '666', '11', '0', '0', null, '2', '4');
INSERT INTO `order` VALUES ('000020181112085557', '2018-11-12 08:55:57', '888', '11', '0', '0', null, '2', null);

-- ----------------------------
-- Table structure for `orderdetail`
-- ----------------------------
DROP TABLE IF EXISTS `orderdetail`;
CREATE TABLE `orderdetail` (
  `odid` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` varchar(255) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  `buycount` int(11) DEFAULT NULL,
  PRIMARY KEY (`odid`),
  KEY `orderid` (`orderid`),
  KEY `productid` (`productid`),
  CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `order` (`orderid`),
  CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orderdetail
-- ----------------------------
INSERT INTO `orderdetail` VALUES ('54', '000020181108125738', '34', '2');
INSERT INTO `orderdetail` VALUES ('55', '000020181108125738', '39', '3');
INSERT INTO `orderdetail` VALUES ('56', '000020181108125926', '29', '2');
INSERT INTO `orderdetail` VALUES ('57', '000020181108130624', '29', '3');
INSERT INTO `orderdetail` VALUES ('66', '000020181109171457', '29', '2');
INSERT INTO `orderdetail` VALUES ('67', '000020181112085557', '27', '2');

-- ----------------------------
-- Table structure for `permission`
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(255) NOT NULL,
  `pnote` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES ('1', '商品类型查看', '商品类型查看');
INSERT INTO `permission` VALUES ('2', '商品类型添加', '商品类型添加');
INSERT INTO `permission` VALUES ('3', '商品类型修改', '商品类型修改');
INSERT INTO `permission` VALUES ('4', '商品类型删除', '商品类型删除');
INSERT INTO `permission` VALUES ('5', '商品查看', '商品查看');
INSERT INTO `permission` VALUES ('6', '商品添加', '商品添加');
INSERT INTO `permission` VALUES ('7', '商品修改', '商品修改');
INSERT INTO `permission` VALUES ('8', '商品删除', '商品删除');
INSERT INTO `permission` VALUES ('9', '订单查看', '查看订单');
INSERT INTO `permission` VALUES ('10', '订单处理', '处理订单');
INSERT INTO `permission` VALUES ('11', '权限管理', '权限、管理员、分组的所有操作');

-- ----------------------------
-- Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `productname` varchar(255) NOT NULL,
  `productprice` varchar(255) DEFAULT NULL,
  `productdetail` varchar(255) DEFAULT NULL,
  `productcount` int(11) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `isshow` int(1) DEFAULT NULL COMMENT '1显示,0不显示',
  `productsort` int(1) DEFAULT NULL,
  `sales` int(11) DEFAULT '0',
  PRIMARY KEY (`productid`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('27', '我的滑板鞋', '444', '呃呃呃呃呃', '323', '2018-11-01 11:52:11', '1', '111', '10');
INSERT INTO `product` VALUES ('28', '新滑板鞋', '333', 'evreve', '554', '2018-11-02 11:52:15', '1', '5', '12');
INSERT INTO `product` VALUES ('29', '滑板鞋', '333', 'evreve', '554', '2018-11-03 11:52:18', '1', '5', '22');
INSERT INTO `product` VALUES ('33', '哥哥我', '44411', '大好人让我分隔符的服务费', '32', '2018-11-02 11:52:41', '1', '342', '5');
INSERT INTO `product` VALUES ('34', '建议添加一条', '5555', '今天要几天', '55', '2018-11-03 11:52:10', '1', '5', '1');
INSERT INTO `product` VALUES ('38', '色', '34', '324', '23', '2018-11-03 11:52:41', '1', '234', '55');
INSERT INTO `product` VALUES ('39', '各位', '1200', '爱疯舞风Greg', '323', '2018-11-03 13:46:03', '1', '33', '111');
INSERT INTO `product` VALUES ('40', '好友推荐犹太人', '555', 'Greg', '20', '2018-11-03 13:46:30', '0', '4', '21');
INSERT INTO `product` VALUES ('41', '桃核仁', '34', '韩庚', '323', '2018-11-09 13:47:03', '1', '32', '14');
INSERT INTO `product` VALUES ('44', 'gsgre', '214', 'egwg', '32', '2018-11-03 14:15:48', '0', '32', '9');
INSERT INTO `product` VALUES ('47', '桃核仁', '555', '让他忽然', '45', '2018-11-07 09:19:17', '1', '45', '0');
INSERT INTO `product` VALUES ('48', '桃核仁', '434', '投入和', '344', '2018-11-07 09:20:02', '1', '54', '33');
INSERT INTO `product` VALUES ('49', '桃核仁', '435', '人员让他', '54', '2018-11-07 09:20:35', '1', '5', '0');
INSERT INTO `product` VALUES ('50', 'Greg', '546', '还要投入教育如何', '546', '2018-11-09 15:49:25', '1', '55', '0');
INSERT INTO `product` VALUES ('51', '桃核仁', '555', '爱疯舞风Greg', '23', '2018-11-02 13:46:30', '1', '34', '0');
INSERT INTO `product` VALUES ('52', 'Greg', '434', '今天要几天', '45', '2018-10-03 13:46:30', '1', '324', '5');
INSERT INTO `product` VALUES ('53', '桃核仁', '434', '核桃仁和他', '45', '2018-11-03 13:36:30', '1', '54', '0');
INSERT INTO `product` VALUES ('54', 'Greg', '555', '今天要几天', '23', '2018-11-03 13:44:30', '1', '6', '77');
INSERT INTO `product` VALUES ('55', '桃核仁', '214', '爱疯舞风Greg', '45', '2017-11-03 13:46:30', '1', '5', '88');
INSERT INTO `product` VALUES ('56', 'Greg', '555', '今天要几天', '23', '2018-11-03 12:46:30', '1', '6', '0');
INSERT INTO `product` VALUES ('57', '桃核仁', '214', '核桃仁和他', '45', '2018-11-03 13:46:39', '1', '7', '22');
INSERT INTO `product` VALUES ('59', '桃核仁', '214', '今天要几天', '23', '2018-11-03 18:46:30', '1', '3', '77');
INSERT INTO `product` VALUES ('60', '桃核仁', '555', '爱疯舞风Greg', '45', '2018-11-03 23:46:30', '1', '53', '11');
INSERT INTO `product` VALUES ('61', '桃核仁', '434', '今天要几天', '23', '2018-11-03 16:46:30', '1', '4', '9');
INSERT INTO `product` VALUES ('62', '桃核仁', '555', '核桃仁和他', '45', '2018-11-03 13:22:30', '1', '5', '0');
INSERT INTO `product` VALUES ('63', '桃核仁', '434', '爱疯舞风Greg', '45', '2018-11-03 13:12:30', '1', '4', '34');
INSERT INTO `product` VALUES ('64', '桃核仁', '555', '核桃仁和他', '23', '2018-11-03 13:45:30', '1', '4', '2');
INSERT INTO `product` VALUES ('65', 'Greg', '434', '今天要几天', '23', '2018-11-02 11:52:45', '1', '65', '8');
INSERT INTO `product` VALUES ('66', 'Greg', '214', '核桃仁和他', '45', '2018-11-02 11:52:20', '1', '6', '3');

-- ----------------------------
-- Table structure for `productimg`
-- ----------------------------
DROP TABLE IF EXISTS `productimg`;
CREATE TABLE `productimg` (
  `imgid` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(11) DEFAULT NULL,
  `imgurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`imgid`),
  KEY `productid` (`productid`),
  CONSTRAINT `productimg_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productimg
-- ----------------------------
INSERT INTO `productimg` VALUES ('5', '27', '/uploads/20181103/bcc2ec57df212945629019ddb2968b77.png');
INSERT INTO `productimg` VALUES ('6', '28', '/uploads/20181103/378b0f32ef250db7ad2ed2d80518f23b.png');
INSERT INTO `productimg` VALUES ('7', '29', '/uploads/20181103/bcc2ec57df212945629019ddb2968b77.png');
INSERT INTO `productimg` VALUES ('11', '33', '/uploads/20181103/a6ebdd7b61ab7c94e1e73bd5bfb411e2.png');
INSERT INTO `productimg` VALUES ('12', '34', '/uploads/20181103/378b0f32ef250db7ad2ed2d80518f23b.png');
INSERT INTO `productimg` VALUES ('16', '38', '/uploads/20181103/7fadf0b12f55150771a9ba5e9c0168ab.png');
INSERT INTO `productimg` VALUES ('17', '39', '/uploads/20181103/422318de8784cb7d6913a3f310c918c9.png');
INSERT INTO `productimg` VALUES ('18', '40', '/uploads/20181103/8af10364b2caf0bce8d34c51b5b72340.png');
INSERT INTO `productimg` VALUES ('19', '41', '/uploads/20181103/bcc2ec57df212945629019ddb2968b77.png');
INSERT INTO `productimg` VALUES ('22', '44', '/uploads/20181103/894b5020370722e95d815f06f7ad4fc0.png');
INSERT INTO `productimg` VALUES ('25', '47', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('26', '48', '/uploads/20181107/44886797cf660fd1bfd473d4593bc366.png');
INSERT INTO `productimg` VALUES ('27', '49', '/uploads/20181107/4a3e4de0c410850e7228c7082ebc93b7.png');
INSERT INTO `productimg` VALUES ('28', '50', '/uploads/20181109/b4cbc925a6b67925519da33c63cff7ba.png');
INSERT INTO `productimg` VALUES ('29', '51', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('30', '52', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('31', '53', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('32', '54', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('33', '55', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('34', '56', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('35', '57', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('37', '59', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('38', '60', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('39', '61', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('40', '62', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('41', '63', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('42', '64', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('43', '65', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');
INSERT INTO `productimg` VALUES ('44', '66', '/uploads/20181107/7c0ef7cf4d3deeb30f4c46eef8ef7cc9.png');

-- ----------------------------
-- Table structure for `size`
-- ----------------------------
DROP TABLE IF EXISTS `size`;
CREATE TABLE `size` (
  `sizeid` int(11) NOT NULL AUTO_INCREMENT,
  `sizename` varchar(255) DEFAULT NULL,
  `sizenote` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sizeid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of size
-- ----------------------------
INSERT INTO `size` VALUES ('1', '35.5', 'XL');
INSERT INTO `size` VALUES ('2', '36', '38');
INSERT INTO `size` VALUES ('3', '36.5', '36.5');
INSERT INTO `size` VALUES ('4', '37.5', '37.5');
INSERT INTO `size` VALUES ('5', '38', '38');
INSERT INTO `size` VALUES ('6', '38.5', '38.5');
INSERT INTO `size` VALUES ('7', '39', '39');
INSERT INTO `size` VALUES ('8', '40', '40');
INSERT INTO `size` VALUES ('9', '40.5', '40.5');
INSERT INTO `size` VALUES ('10', '41', '41');
INSERT INTO `size` VALUES ('11', '42', '42');
INSERT INTO `size` VALUES ('12', '42.5', '42.5');
INSERT INTO `size` VALUES ('13', '43', '43');
INSERT INTO `size` VALUES ('14', '44.5', '44.5');
INSERT INTO `size` VALUES ('15', 'XS', 'XS');
INSERT INTO `size` VALUES ('16', 'S', 'S');
INSERT INTO `size` VALUES ('17', 'M', 'M');
INSERT INTO `size` VALUES ('18', 'L', 'L');
INSERT INTO `size` VALUES ('19', 'XL', 'XL');
INSERT INTO `size` VALUES ('20', 'XXL', 'XXL');
INSERT INTO `size` VALUES ('21', 'XXXL', 'XXXL');

-- ----------------------------
-- Table structure for `type`
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `typeid` int(11) NOT NULL AUTO_INCREMENT,
  `typename` varchar(255) NOT NULL,
  `typenote` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type
-- ----------------------------
INSERT INTO `type` VALUES ('29', '休闲', '休闲');
INSERT INTO `type` VALUES ('30', '跑步', '跑步');
INSERT INTO `type` VALUES ('31', '高尔夫', '高尔夫');
INSERT INTO `type` VALUES ('32', '篮球', '篮球');
INSERT INTO `type` VALUES ('33', '足球', '足球');
INSERT INTO `type` VALUES ('36', '高跟', '高跟');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `userpwd` varchar(255) NOT NULL,
  `userphone` varchar(255) DEFAULT NULL,
  `usersex` int(1) DEFAULT '2' COMMENT '0为女,1为男,2不明',
  `useremail` varchar(255) DEFAULT NULL,
  `usernote` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('11', 'user', '202cb962ac59075b964b07152d234b70', 'sss', '1', 'ss', '11');
INSERT INTO `user` VALUES ('12', '胜哥', '202cb962ac59075b964b07152d234b70', '352241241', '0', '一个人', '22');
INSERT INTO `user` VALUES ('13', 'admin', '202cb962ac59075b964b07152d234b70', '3333333', '2', '3333333', '33');

-- ----------------------------
-- View structure for `admingroupview`
-- ----------------------------
DROP VIEW IF EXISTS `admingroupview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `admingroupview` AS select `admin`.`adminid` AS `adminid`,`admin`.`adminname` AS `adminname`,`admingroup`.`groupid` AS `groupid`,`g`.`groupname` AS `groupname`,`g`.`pids` AS `pids` from ((`admin` join `admingroup`) join `group` `g`) where ((`admin`.`adminid` = `admingroup`.`adminid`) and (`admingroup`.`groupid` = `g`.`groupid`)) ;

-- ----------------------------
-- View structure for `productalltype`
-- ----------------------------
DROP VIEW IF EXISTS `productalltype`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productalltype` AS select `product`.`productid` AS `productid`,`product`.`productname` AS `productname`,`product`.`productprice` AS `productprice`,`product`.`productdetail` AS `productdetail`,`product`.`productcount` AS `productcount`,`product`.`isshow` AS `isshow`,`product`.`productsort` AS `productsort`,`belong`.`sex` AS `sex`,`type`.`typename` AS `typename`,`brand`.`brandname` AS `brandname`,`color`.`colorname` AS `colorname`,`color`.`colornote` AS `colornote`,`size`.`sizename` AS `sizename`,`size`.`sizenote` AS `sizenote`,`productimg`.`imgurl` AS `imgurl`,`product`.`addtime` AS `addtime`,`product`.`sales` AS `sales` from ((((((`product` join `belong`) join `type`) join `brand`) join `color`) join `size`) join `productimg`) where ((`product`.`productid` = `belong`.`productid`) and (`belong`.`typeid` = `type`.`typeid`) and (`belong`.`brandid` = `brand`.`brandid`) and (`belong`.`colorid` = `color`.`colorid`) and (`belong`.`sizeid` = `size`.`sizeid`) and (`productimg`.`productid` = `product`.`productid`)) order by `product`.`productid` ;

-- ----------------------------
-- View structure for `usercart`
-- ----------------------------
DROP VIEW IF EXISTS `usercart`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usercart` AS select `cart`.`cartid` AS `cartid`,`cart`.`userid` AS `userid`,`cart`.`productid` AS `productid`,`cart`.`productnum` AS `productnum`,`cart`.`addtime` AS `addtime`,`productalltype`.`productname` AS `productname`,`productalltype`.`productprice` AS `productprice`,`productalltype`.`productdetail` AS `productdetail`,`productalltype`.`typename` AS `typename`,`productalltype`.`brandname` AS `brandname`,`productalltype`.`colorname` AS `colorname`,`productalltype`.`sizename` AS `sizename`,`productalltype`.`imgurl` AS `imgurl` from (`cart` join `productalltype`) where (`cart`.`productid` = `productalltype`.`productid`) ;

-- ----------------------------
-- View structure for `userorder`
-- ----------------------------
DROP VIEW IF EXISTS `userorder`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `userorder` AS select `o`.`orderid` AS `orderid`,`o`.`orderdate` AS `orderdate`,`o`.`ordermoney` AS `ordermoney`,`o`.`userid` AS `userid`,`o`.`orderstate` AS `orderstate`,`o`.`ispay` AS `ispay`,`o`.`payway` AS `payway`,`o`.`allproductnum` AS `allproductnum`,`o`.`addressid` AS `addressid`,`address`.`addressarea` AS `addressarea`,`address`.`nickname` AS `nickname` from (`order` `o` join `address`) where (`o`.`addressid` = `address`.`addressid`) ;
