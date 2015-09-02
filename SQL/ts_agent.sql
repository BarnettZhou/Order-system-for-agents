-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-09-02 02:47:09
-- 服务器版本： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ts_agent`
--

-- --------------------------------------------------------

--
-- 表的结构 `ts_account`
--

CREATE TABLE IF NOT EXISTS `ts_account` (
`id` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `mid` int(11) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `operate` int(1) NOT NULL,
  `amount` decimal(9,2) NOT NULL,
  `last_account` decimal(9,2) NOT NULL,
  `new_account` decimal(9,2) NOT NULL,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ts_account`
--

INSERT INTO `ts_account` (`id`, `aid`, `mid`, `time`, `operate`, `amount`, `last_account`, `new_account`, `remark`) VALUES
(1, 2, 1, 1434251606, 1, '524.00', '30000.00', '30524.00', NULL),
(2, 6, NULL, 1434608197, 2, '610.80', '50000.00', '49389.20', NULL),
(3, 6, 1, 1434612221, 3, '598.80', '49389.20', '49988.00', '订单退款'),
(4, 6, NULL, 1434978455, 2, '603.80', '49988.00', '49384.20', NULL),
(5, 6, NULL, 1434986457, 2, '101.00', '49384.20', '49283.20', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ts_agent`
--

CREATE TABLE IF NOT EXISTS `ts_agent` (
  `id` int(11) NOT NULL,
  `wechat_id` char(25) NOT NULL,
  `level` int(1) NOT NULL,
  `auth_time` int(10) NOT NULL,
  `account` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ts_agent`
--

INSERT INTO `ts_agent` (`id`, `wechat_id`, `level`, `auth_time`, `account`) VALUES
(2, 'allen_wx', 3, 1462377600, '49988.00'),
(5, 'bake_wechat', 1, 1462377600, '49988.00'),
(6, 'cooper_wx', 2, 1485446400, '49283.20');

-- --------------------------------------------------------

--
-- 表的结构 `ts_agent_rule`
--

CREATE TABLE IF NOT EXISTS `ts_agent_rule` (
`id` int(11) NOT NULL,
  `rulename` char(12) NOT NULL,
  `level` int(1) NOT NULL,
  `discount` decimal(3,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ts_agent_rule`
--

INSERT INTO `ts_agent_rule` (`id`, `rulename`, `level`, `discount`) VALUES
(1, '一级代理', 1, '0.50'),
(2, '二级代理', 2, '0.60'),
(3, '三级代理', 3, '0.65'),
(4, '四级代理', 4, '0.70');

-- --------------------------------------------------------

--
-- 表的结构 `ts_cart`
--

CREATE TABLE IF NOT EXISTS `ts_cart` (
`id` int(11) NOT NULL,
  `aid` int(11) NOT NULL COMMENT '代理ID',
  `pid` int(11) NOT NULL COMMENT '商品ID',
  `num` int(11) NOT NULL DEFAULT '1' COMMENT '商品数量'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='购物车';

--
-- 转存表中的数据 `ts_cart`
--

INSERT INTO `ts_cart` (`id`, `aid`, `pid`, `num`) VALUES
(12, 6, 6, 1),
(13, 6, 2, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ts_cate`
--

CREATE TABLE IF NOT EXISTS `ts_cate` (
`id` int(11) NOT NULL,
  `title` char(25) NOT NULL,
  `pid` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '10'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ts_cate`
--

INSERT INTO `ts_cate` (`id`, `title`, `pid`, `sort`) VALUES
(1, 'TS颂戒指系列', 0, 1),
(2, 'TS颂耳钉系列', 0, 2),
(3, 'TS颂手链系列', 0, 3),
(4, 'TS颂项链系列', 0, 4);

-- --------------------------------------------------------

--
-- 表的结构 `ts_express`
--

CREATE TABLE IF NOT EXISTS `ts_express` (
`id` int(11) NOT NULL,
  `title` char(10) NOT NULL,
  `type` int(1) NOT NULL,
  `area` int(2) NOT NULL,
  `areaname` char(10) NOT NULL,
  `start_weight` decimal(4,2) NOT NULL,
  `start_price` decimal(4,2) NOT NULL,
  `step_weight` decimal(4,2) NOT NULL,
  `step_price` decimal(4,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ts_express`
--

INSERT INTO `ts_express` (`id`, `title`, `type`, `area`, `areaname`, `start_weight`, `start_price`, `step_weight`, `step_price`) VALUES
(1, '浙江-韵达', 1, 33, '浙江省', '2.00', '5.00', '1.00', '2.00'),
(2, '浙江-顺丰', 2, 33, '浙江省', '2.00', '12.00', '1.00', '3.00'),
(3, '安徽-韵达', 1, 34, '安徽省', '2.00', '8.00', '1.00', '2.00'),
(4, '安徽-顺丰', 2, 34, '安徽省', '2.00', '15.00', '1.00', '5.00');

-- --------------------------------------------------------

--
-- 表的结构 `ts_order`
--

CREATE TABLE IF NOT EXISTS `ts_order` (
`id` int(11) NOT NULL COMMENT 'ID',
  `order_id` char(10) NOT NULL COMMENT '订单号',
  `time` int(10) NOT NULL COMMENT '时间',
  `aid` int(11) NOT NULL COMMENT '代理ID',
  `weight` decimal(4,2) NOT NULL COMMENT '配送重量',
  `express` int(1) NOT NULL COMMENT '快递公司',
  `address` char(25) NOT NULL COMMENT '地址',
  `price` decimal(9,2) NOT NULL COMMENT '商品总价',
  `discount_price` decimal(9,2) NOT NULL COMMENT '折扣后价格',
  `tot_price` decimal(9,2) NOT NULL COMMENT '订单总价',
  `express_price` decimal(9,2) NOT NULL COMMENT '配送费用',
  `pay_type` int(1) NOT NULL COMMENT '支付方式',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='订单表';

--
-- 转存表中的数据 `ts_order`
--

INSERT INTO `ts_order` (`id`, `order_id`, `time`, `aid`, `weight`, `express`, `address`, `price`, `discount_price`, `tot_price`, `express_price`, `pay_type`, `status`) VALUES
(1, '1434373615', 1434373615, 2, '3.40', 1, '金华市浙江师范大学', '1479.00', '961.35', '970.35', '9.00', 1, 2),
(2, '1434418803', 1434418803, 6, '0.00', 0, '浙江师范大学', '998.00', '598.80', '598.80', '0.00', 1, 3),
(3, '1434420659', 1434420659, 6, '0.80', 2, '浙师大', '998.00', '598.80', '610.80', '12.00', 1, 3),
(4, '1434608197', 1434608197, 6, '0.60', 2, '杏园CBD', '998.00', '598.80', '610.80', '12.00', 1, 5),
(5, '1434978455', 1434978455, 6, '0.60', 1, '随便', '998.00', '598.80', '603.80', '5.00', 1, 6),
(6, '1434986457', 1434986457, 6, '0.20', 1, '', '160.00', '96.00', '101.00', '5.00', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ts_order_products`
--

CREATE TABLE IF NOT EXISTS `ts_order_products` (
`id` int(11) NOT NULL COMMENT 'ID',
  `oid` int(11) NOT NULL COMMENT '订单号',
  `pid` int(11) NOT NULL COMMENT '商品编号',
  `num` int(11) NOT NULL COMMENT '数量',
  `exchange` int(1) NOT NULL DEFAULT '0' COMMENT '商品换货状态'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='订单_商品表';

--
-- 转存表中的数据 `ts_order_products`
--

INSERT INTO `ts_order_products` (`id`, `oid`, `pid`, `num`, `exchange`) VALUES
(1, 1, 6, 1, 0),
(2, 1, 4, 1, 0),
(3, 1, 1, 3, 0),
(4, 2, 5, 1, 0),
(5, 3, 2, 1, 0),
(6, 4, 3, 1, 0),
(7, 5, 3, 1, 2),
(8, 6, 1, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ts_order_remarks`
--

CREATE TABLE IF NOT EXISTS `ts_order_remarks` (
`id` int(11) NOT NULL COMMENT 'ID',
  `oid` int(11) NOT NULL COMMENT '订单ID',
  `text` varchar(255) NOT NULL COMMENT '备注内容',
  `time` int(11) NOT NULL COMMENT '时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单备注表';

-- --------------------------------------------------------

--
-- 表的结构 `ts_product`
--

CREATE TABLE IF NOT EXISTS `ts_product` (
`id` int(11) NOT NULL,
  `title` char(25) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `image` char(255) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `remainder` int(11) NOT NULL DEFAULT '0',
  `weight` decimal(4,2) NOT NULL,
  `time` int(10) NOT NULL,
  `cid` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ts_product`
--

INSERT INTO `ts_product` (`id`, `title`, `remark`, `image`, `price`, `remainder`, `weight`, `time`, `cid`) VALUES
(1, '麋鹿', '', NULL, '160.00', 16, '0.20', 1434092537, 4),
(2, '福特野马', '', './Uploads/2015-06-12/557ae4665b48e.jpg', '998.00', 20, '0.80', 1434095067, 1),
(3, '道奇挑战者', '还是不要在意这些细节', NULL, '998.00', 30, '0.60', 1434095067, 2),
(4, '魔戒远征队', '鲜嫩多汁', NULL, '998.00', 0, '2.00', 1434095374, 3),
(5, '大白', '鲜嫩多汁', './Uploads/2015-06-12/', '998.00', 0, '0.00', 1434095374, 3),
(6, '作者', '白送要不要', './Uploads/2015-06-12/557ae4bf3055e.jpg', '1.00', 40, '0.80', 1434115215, 4);

-- --------------------------------------------------------

--
-- 表的结构 `ts_remainder`
--

CREATE TABLE IF NOT EXISTS `ts_remainder` (
`id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `operate` int(1) NOT NULL DEFAULT '1',
  `remark` varchar(150) DEFAULT NULL,
  `last_remainder` int(11) NOT NULL,
  `new_remainder` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ts_remainder`
--

INSERT INTO `ts_remainder` (`id`, `uid`, `pid`, `operate`, `remark`, `last_remainder`, `new_remainder`) VALUES
(1, 1, 1, 1, '', 20, 40),
(2, 1, 2, 1, '', 1, 3),
(3, 1, 2, 0, '', 3, 1),
(4, 1, 2, 1, '', 0, 20),
(5, 1, 3, 1, '', 0, 30),
(6, 1, 6, 1, '', 0, 40);

-- --------------------------------------------------------

--
-- 表的结构 `ts_remark`
--

CREATE TABLE IF NOT EXISTS `ts_remark` (
`id` int(11) NOT NULL COMMENT 'ID',
  `oid` int(11) NOT NULL COMMENT '相应订单ID',
  `uid` int(11) NOT NULL COMMENT '添加备注的用户ID',
  `text` varchar(255) NOT NULL COMMENT '备注内容',
  `time` int(11) NOT NULL COMMENT '添加备注的时间'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='订单备注';

--
-- 转存表中的数据 `ts_remark`
--

INSERT INTO `ts_remark` (`id`, `oid`, `uid`, `text`, `time`) VALUES
(1, 1, 1, '订单已发货<br>快递公司：韵达快递<br>快递单号：1234567890', 1434556665),
(2, 1, 1, '你的快递炸了！', 0),
(3, 2, 1, '订单已发货<br>快递公司：自提<br>快递单号：', 1434593478),
(4, 2, 1, '快递员被狗咬了', 1434593504),
(5, 2, 6, '代理已确认收货，订单完成', 1434595362),
(6, 3, 1, '订单已发货<br>快递公司：顺丰快递<br>快递单号：1234567890', 1434608130),
(7, 3, 6, '代理已确认收货，订单完成', 1434608161),
(8, 4, 6, '订单1434608197已成功提交，待客服审核。', 1434608197),
(9, 4, 1, '订单已发货<br>快递公司：韵达快递<br>快递单号：9876543210', 1434608226),
(10, 4, 6, '代理已提交退货申请', 1434608608),
(11, 4, 1, '退款598.80至代理账户<br>说明:', 1434612221),
(12, 5, 6, '订单1434978455已成功提交，待客服审核。', 1434978455),
(13, 6, 6, '订单1434986457已成功提交，待客服审核。', 1434986457),
(14, 5, 1, '订单已发货<br>快递公司：汇通快递<br>快递单号：1122334455', 1435841358),
(15, 5, 6, '代理已提交退货申请', 1435841362),
(16, 5, 1, '退货申请未通过，请联系客服人员', 1435841395),
(17, 5, 6, '代理对商品道奇挑战者提交了换货申请', 1435981767),
(18, 5, 1, '', 1435991357);

-- --------------------------------------------------------

--
-- 表的结构 `ts_user`
--

CREATE TABLE IF NOT EXISTS `ts_user` (
`id` int(11) NOT NULL,
  `username` char(25) NOT NULL,
  `password` char(36) NOT NULL,
  `nickname` char(10) DEFAULT NULL,
  `role` int(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ts_user`
--

INSERT INTO `ts_user` (`id`, `username`, `password`, `nickname`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '管理员', 0),
(2, 'agent_allen', 'a34c3d45b6018d3fd5560b103c2a00e2', '艾伦-代理', 2),
(3, 'manager01', 'a6fb09317477cd074b8830e54b8c4931', 'Manager01', 1),
(4, 'manager02', 'a45ce0f8cc211649738cd53367f01c76', 'Manager02', 1),
(5, 'agent-bake', 'a6ecfad3e0f9a51c6335848449a91bed', 'bake-代理', 2),
(6, 'cooper', 'cd21b93cfd8d6824dc2bce1a19decaf7', 'Cooper', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ts_account`
--
ALTER TABLE `ts_account`
 ADD PRIMARY KEY (`id`), ADD KEY `aid` (`aid`);

--
-- Indexes for table `ts_agent`
--
ALTER TABLE `ts_agent`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_agent_rule`
--
ALTER TABLE `ts_agent_rule`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_cart`
--
ALTER TABLE `ts_cart`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_cate`
--
ALTER TABLE `ts_cate`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `ts_express`
--
ALTER TABLE `ts_express`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_order`
--
ALTER TABLE `ts_order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_order_products`
--
ALTER TABLE `ts_order_products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_order_remarks`
--
ALTER TABLE `ts_order_remarks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_product`
--
ALTER TABLE `ts_product`
 ADD PRIMARY KEY (`id`), ADD KEY `cid` (`cid`);

--
-- Indexes for table `ts_remainder`
--
ALTER TABLE `ts_remainder`
 ADD PRIMARY KEY (`id`), ADD KEY `pid` (`pid`);

--
-- Indexes for table `ts_remark`
--
ALTER TABLE `ts_remark`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_user`
--
ALTER TABLE `ts_user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ts_account`
--
ALTER TABLE `ts_account`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ts_agent_rule`
--
ALTER TABLE `ts_agent_rule`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ts_cart`
--
ALTER TABLE `ts_cart`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ts_cate`
--
ALTER TABLE `ts_cate`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ts_express`
--
ALTER TABLE `ts_express`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ts_order`
--
ALTER TABLE `ts_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ts_order_products`
--
ALTER TABLE `ts_order_products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ts_order_remarks`
--
ALTER TABLE `ts_order_remarks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- AUTO_INCREMENT for table `ts_product`
--
ALTER TABLE `ts_product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ts_remainder`
--
ALTER TABLE `ts_remainder`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ts_remark`
--
ALTER TABLE `ts_remark`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ts_user`
--
ALTER TABLE `ts_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- 限制导出的表
--

--
-- 限制表 `ts_account`
--
ALTER TABLE `ts_account`
ADD CONSTRAINT `ts_account_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `ts_agent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `ts_agent`
--
ALTER TABLE `ts_agent`
ADD CONSTRAINT `ts_agent_ibfk_1` FOREIGN KEY (`id`) REFERENCES `ts_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `ts_product`
--
ALTER TABLE `ts_product`
ADD CONSTRAINT `ts_product_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `ts_cate` (`id`);

--
-- 限制表 `ts_remainder`
--
ALTER TABLE `ts_remainder`
ADD CONSTRAINT `ts_remainder_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `ts_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
