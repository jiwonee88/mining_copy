-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: mining
-- ------------------------------------------------------
-- Server version	5.7.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `mining`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `mining` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mining`;

--
-- Table structure for table `coin_draw_out`
--

DROP TABLE IF EXISTS `coin_draw_out`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_draw_out` (
  `dr_no` int(20) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL,
  `dr_token` varchar(10) NOT NULL,
  `dr_wallet_addr` varchar(300) NOT NULL,
  `dr_amt` double(30,8) NOT NULL,
  `dr_fee` double(30,8) NOT NULL,
  `dr_tamt` double(30,8) NOT NULL,
  `dr_set_token` varchar(10) NOT NULL,
  `dr_set_amt` double(30,8) NOT NULL,
  `dr_set_fee` double(30,8) NOT NULL,
  `dr_set_tamt` double(30,8) NOT NULL,
  `dr_set_date` datetime NOT NULL,
  `dr_stats` tinyint(1) NOT NULL,
  `dr_wdate` datetime NOT NULL,
  `dr_mdate` datetime NOT NULL,
  PRIMARY KEY (`dr_no`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_draw_out`
--

LOCK TABLES `coin_draw_out` WRITE;
/*!40000 ALTER TABLE `coin_draw_out` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_draw_out` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_hp_certi`
--

DROP TABLE IF EXISTS `coin_hp_certi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_hp_certi` (
  `mb_id` varchar(30) NOT NULL,
  `hp` varchar(30) DEFAULT NULL,
  `wdate` datetime DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  KEY `hp` (`hp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_hp_certi`
--

LOCK TABLES `coin_hp_certi` WRITE;
/*!40000 ALTER TABLE `coin_hp_certi` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_hp_certi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_in_purchase`
--

DROP TABLE IF EXISTS `coin_in_purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_in_purchase` (
  `in_no` int(20) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL,
  `smb_id` varchar(30) NOT NULL,
  `in_item` varchar(100) NOT NULL,
  `in_item_qty` int(11) NOT NULL,
  `in_token` varchar(10) NOT NULL,
  `in_wallet_addr` varchar(80) NOT NULL,
  `in_txn_id` varchar(300) NOT NULL,
  `in_rsv_amt` double(30,8) NOT NULL,
  `in_rsv_date` date NOT NULL,
  `in_set_amt` double(30,8) NOT NULL,
  `in_set_token` varchar(10) NOT NULL,
  `in_set_date` datetime NOT NULL,
  `in_stats` tinyint(1) NOT NULL DEFAULT '1',
  `in_wdate` datetime NOT NULL,
  `in_mdate` datetime NOT NULL,
  `in_balance` double(30,8) NOT NULL,
  `in_balance_last` double(30,8) NOT NULL,
  `in_logs` text NOT NULL,
  PRIMARY KEY (`in_no`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_in_purchase`
--

LOCK TABLES `coin_in_purchase` WRITE;
/*!40000 ALTER TABLE `coin_in_purchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_in_purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_in_reserve`
--

DROP TABLE IF EXISTS `coin_in_reserve`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_in_reserve` (
  `in_no` int(20) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL,
  `smb_id` varchar(30) NOT NULL,
  `in_token` varchar(10) NOT NULL,
  `in_wallet_addr` varchar(80) NOT NULL,
  `in_rsv_amt` double(30,8) NOT NULL,
  `in_rsv_date` date NOT NULL,
  `in_set_amt` double(30,8) NOT NULL,
  `in_set_token` varchar(10) NOT NULL,
  `in_set_date` datetime NOT NULL,
  `in_stats` tinyint(1) NOT NULL DEFAULT '1',
  `in_wdate` datetime NOT NULL,
  `in_mdate` datetime NOT NULL,
  `in_balance` double(30,8) NOT NULL,
  `in_balance_last` double(30,8) NOT NULL,
  `in_logs` text NOT NULL,
  PRIMARY KEY (`in_no`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_in_reserve`
--

LOCK TABLES `coin_in_reserve` WRITE;
/*!40000 ALTER TABLE `coin_in_reserve` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_in_reserve` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_item_cart`
--

DROP TABLE IF EXISTS `coin_item_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_item_cart` (
  `ct_id` double NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL COMMENT '지급코드',
  `tr_code` varchar(30) NOT NULL,
  `cn_item` varchar(5) DEFAULT NULL COMMENT '상품코드',
  `mb_id` varchar(30) DEFAULT NULL,
  `smb_id` varchar(30) DEFAULT NULL,
  `fmb_id` varchar(30) DEFAULT NULL,
  `fsmb_id` varchar(30) DEFAULT NULL,
  `ct_buy_price` double(12,1) DEFAULT NULL COMMENT '상품구매가격',
  `ct_sell_price` double(12,1) NOT NULL,
  `ct_class` int(2) DEFAULT NULL COMMENT '상품의 단계',
  `ct_interest` float(5,1) DEFAULT NULL COMMENT '판매시 수익율',
  `ct_days` int(10) NOT NULL,
  `ct_validdate` date DEFAULT NULL COMMENT '유효보유기간(일단위)',
  `ct_wdate` datetime DEFAULT NULL COMMENT '최초생성일',
  `is_soled` tinyint(1) NOT NULL,
  `soled_cnt` int(10) NOT NULL,
  `soled_date` datetime NOT NULL,
  `is_trade` tinyint(1) NOT NULL,
  `trade_cnt` int(10) NOT NULL,
  `div_cnt` int(10) NOT NULL,
  `tr_active` tinyint(30) NOT NULL,
  `ct_deldate` datetime NOT NULL,
  `ct_manual` tinyint(1) NOT NULL,
  `ct_rdate` datetime NOT NULL,
  `ct_logs` varchar(255) NOT NULL,
  `ct_backup` varchar(300) NOT NULL,
  PRIMARY KEY (`ct_id`),
  KEY `cn_item` (`cn_item`),
  KEY `smb_id` (`smb_id`),
  KEY `fmb_id` (`fmb_id`),
  KEY `fsmb_id` (`fsmb_id`),
  KEY `ct_validdate` (`ct_validdate`),
  KEY `is_soled` (`is_soled`),
  KEY `is_trade` (`is_trade`),
  KEY `tr_code` (`tr_code`),
  KEY `mb_id` (`mb_id`),
  KEY `ct_manual` (`ct_manual`),
  KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_item_cart`
--

LOCK TABLES `coin_item_cart` WRITE;
/*!40000 ALTER TABLE `coin_item_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_item_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_item_cart_trash`
--

DROP TABLE IF EXISTS `coin_item_cart_trash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_item_cart_trash` (
  `ct_id` double NOT NULL,
  `code` varchar(30) NOT NULL COMMENT '지급코드',
  `tr_code` varchar(30) NOT NULL,
  `cn_item` varchar(5) DEFAULT NULL COMMENT '상품코드',
  `mb_id` varchar(30) DEFAULT NULL,
  `smb_id` varchar(30) DEFAULT NULL,
  `fmb_id` varchar(30) DEFAULT NULL,
  `fsmb_id` varchar(30) DEFAULT NULL,
  `ct_buy_price` double(12,1) DEFAULT NULL COMMENT '상품구매가격',
  `ct_sell_price` double(12,1) NOT NULL,
  `ct_class` int(2) DEFAULT NULL COMMENT '상품의 단계',
  `ct_interest` float(5,1) DEFAULT NULL COMMENT '판매시 수익율',
  `ct_days` int(10) NOT NULL,
  `ct_validdate` date DEFAULT NULL COMMENT '유효보유기간(일단위)',
  `ct_wdate` datetime DEFAULT NULL COMMENT '최초생성일',
  `is_soled` tinyint(1) NOT NULL,
  `soled_cnt` int(10) NOT NULL,
  `soled_date` datetime NOT NULL,
  `is_trade` tinyint(1) NOT NULL,
  `trade_cnt` int(10) NOT NULL,
  `div_cnt` int(10) NOT NULL,
  `tr_active` tinyint(30) NOT NULL,
  `ct_deldate` datetime NOT NULL,
  `ct_manual` tinyint(1) NOT NULL,
  `ct_rdate` datetime NOT NULL,
  `ct_logs` varchar(255) NOT NULL,
  `ct_backup` varchar(300) NOT NULL,
  PRIMARY KEY (`ct_id`),
  KEY `cn_item` (`cn_item`),
  KEY `smb_id` (`smb_id`),
  KEY `fmb_id` (`fmb_id`),
  KEY `fsmb_id` (`fsmb_id`),
  KEY `ct_validdate` (`ct_validdate`),
  KEY `is_soled` (`is_soled`),
  KEY `is_trade` (`is_trade`),
  KEY `tr_code` (`tr_code`),
  KEY `mb_id` (`mb_id`),
  KEY `code` (`code`),
  KEY `ct_manual` (`ct_manual`),
  KEY `ct_id` (`ct_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_item_cart_trash`
--

LOCK TABLES `coin_item_cart_trash` WRITE;
/*!40000 ALTER TABLE `coin_item_cart_trash` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_item_cart_trash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_item_info`
--

DROP TABLE IF EXISTS `coin_item_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_item_info` (
  `cn_item` varchar(30) DEFAULT NULL,
  `name_kr` varchar(100) DEFAULT NULL,
  `days` int(10) DEFAULT NULL,
  `interest` float(5,1) DEFAULT NULL,
  `price` double(12,1) DEFAULT NULL,
  `mxprice` double(12,1) DEFAULT NULL,
  `fee` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_item_info`
--

LOCK TABLES `coin_item_info` WRITE;
/*!40000 ALTER TABLE `coin_item_info` DISABLE KEYS */;
INSERT INTO `coin_item_info` VALUES ('a','Mining-S3',3,10.0,50.0,500.0,1),('d','Mining-S5',5,15.0,100.0,1000.0,1);
/*!40000 ALTER TABLE `coin_item_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_item_purchase`
--

DROP TABLE IF EXISTS `coin_item_purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_item_purchase` (
  `it_no` int(10) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL,
  `smb_id` varchar(20) NOT NULL,
  `cn_item` varchar(5) NOT NULL,
  `cn_item_name` varchar(50) NOT NULL,
  `cart_code` text NOT NULL,
  `it_item_qty` int(11) NOT NULL,
  `it_token` varchar(10) NOT NULL,
  `it_wallet_addr` varchar(80) NOT NULL,
  `it_txn_id` varchar(300) NOT NULL,
  `it_rsv_amt` double(30,8) NOT NULL,
  `it_rsv_date` date NOT NULL,
  `it_set_amt` double(30,8) NOT NULL,
  `it_set_token` varchar(10) NOT NULL,
  `it_set_date` datetime NOT NULL,
  `it_stats` tinyint(1) NOT NULL DEFAULT '1',
  `it_wdate` datetime NOT NULL,
  `it_mdate` datetime NOT NULL,
  `it_balance` double(30,8) NOT NULL,
  `it_balance_last` double(30,8) NOT NULL,
  `it_logs` text NOT NULL,
  PRIMARY KEY (`it_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_item_purchase`
--

LOCK TABLES `coin_item_purchase` WRITE;
/*!40000 ALTER TABLE `coin_item_purchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_item_purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_item_trade`
--

DROP TABLE IF EXISTS `coin_item_trade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_item_trade` (
  `tr_code` varchar(30) NOT NULL COMMENT '거래코드',
  `cart_code` varchar(30) NOT NULL,
  `to_cart_code` varchar(30) NOT NULL,
  `lg_no` varchar(30) NOT NULL,
  `cn_item` varchar(5) DEFAULT NULL COMMENT '상품코드',
  `mb_id` varchar(30) DEFAULT NULL COMMENT '구매자',
  `smb_id` varchar(30) DEFAULT NULL COMMENT '구매자 서브계정',
  `fmb_id` varchar(30) DEFAULT NULL COMMENT '판매자',
  `fsmb_id` varchar(30) DEFAULT NULL COMMENT '판매자 서브계정',
  `ct_buy_price` double(12,1) NOT NULL,
  `ct_sell_price` double(12,1) NOT NULL,
  `tr_buyer_claim` tinyint(1) DEFAULT NULL COMMENT '구매자의 클레임',
  `tr_seller_claim` tinyint(1) DEFAULT NULL COMMENT '판매자의 클레임',
  `tr_buyer_dun` tinyint(1) DEFAULT NULL COMMENT '구매자의 독촉',
  `tr_seller_dun` tinyint(1) DEFAULT NULL COMMENT '판매자의  독촉',
  `tr_buyer_note` text COMMENT '구매자의 메모',
  `tr_seller_note` text COMMENT '구매자의 메모',
  `tr_buyer_memo` varchar(300) NOT NULL,
  `tr_seller_memo` varchar(300) NOT NULL,
  `tr_price_org` double(12,1) NOT NULL,
  `tr_price` double(12,1) DEFAULT NULL COMMENT '상품가격',
  `tr_discount` float(5,1) NOT NULL,
  `tr_payback` double(30,8) NOT NULL,
  `tr_price_cash` double(12,1) DEFAULT NULL COMMENT '상품가격',
  `tr_discount_cash` float(5,1) NOT NULL,
  `tr_payback_cash` double(30,8) NOT NULL,
  `tr_class` int(2) DEFAULT NULL COMMENT '상품의 단계',
  `tr_fee` float(10,2) DEFAULT NULL COMMENT '구매 수수료',
  `tr_seller_fee` float(10,2) NOT NULL,
  `tr_paytype` varchar(20) DEFAULT NULL,
  `tr_bank` varchar(50) NOT NULL,
  `tr_bank_num` varchar(50) NOT NULL,
  `tr_bank_user` varchar(50) NOT NULL,
  `tr_set_paytype` varchar(10) NOT NULL,
  `tr_wallet_addr` varchar(100) DEFAULT NULL,
  `tr_balance` double(30,8) NOT NULL,
  `tr_balance_last` double(30,8) NOT NULL,
  `tr_txid` varchar(100) DEFAULT NULL,
  `tr_deposit` varchar(30) NOT NULL,
  `tr_stats` varchar(20) DEFAULT NULL,
  `tr_paydate` datetime DEFAULT NULL,
  `tr_distri` varchar(10) NOT NULL,
  `tr_penalty` tinyint(1) NOT NULL,
  `tr_penalty_date` datetime NOT NULL,
  `tr_wdate` date DEFAULT NULL COMMENT '거래일',
  `tr_setdate` datetime NOT NULL,
  `tr_rdate` datetime DEFAULT NULL COMMENT '거래일',
  `tr_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`tr_code`),
  KEY `cart_code` (`cart_code`),
  KEY `cn_item` (`cn_item`),
  KEY `mb_id` (`mb_id`),
  KEY `fmb_id` (`fmb_id`),
  KEY `fsmb_id` (`fsmb_id`),
  KEY `smb_id` (`smb_id`),
  KEY `to_cart_code` (`to_cart_code`),
  KEY `tr_wdate` (`tr_wdate`),
  KEY `tr_stats` (`tr_stats`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_item_trade`
--

LOCK TABLES `coin_item_trade` WRITE;
/*!40000 ALTER TABLE `coin_item_trade` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_item_trade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_item_trade_test`
--

DROP TABLE IF EXISTS `coin_item_trade_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_item_trade_test` (
  `tr_code` varchar(30) NOT NULL COMMENT '거래코드',
  `cart_code` varchar(30) NOT NULL,
  `to_cart_code` varchar(30) NOT NULL,
  `lg_no` varchar(30) NOT NULL,
  `cn_item` varchar(5) DEFAULT NULL COMMENT '상품코드',
  `mb_id` varchar(30) DEFAULT NULL COMMENT '구매자',
  `smb_id` varchar(30) DEFAULT NULL COMMENT '구매자 서브계정',
  `fmb_id` varchar(30) DEFAULT NULL COMMENT '판매자',
  `fsmb_id` varchar(30) DEFAULT NULL COMMENT '판매자 서브계정',
  `ct_buy_price` double(12,1) NOT NULL,
  `ct_sell_price` double(12,1) NOT NULL,
  `tr_buyer_claim` tinyint(1) DEFAULT NULL COMMENT '구매자의 클레임',
  `tr_seller_claim` tinyint(1) DEFAULT NULL COMMENT '판매자의 클레임',
  `tr_buyer_dun` tinyint(1) DEFAULT NULL COMMENT '구매자의 독촉',
  `tr_seller_dun` tinyint(1) DEFAULT NULL COMMENT '판매자의  독촉',
  `tr_buyer_note` text COMMENT '구매자의 메모',
  `tr_seller_note` text COMMENT '구매자의 메모',
  `tr_buyer_memo` varchar(300) NOT NULL,
  `tr_seller_memo` varchar(300) NOT NULL,
  `tr_price_org` double(12,1) NOT NULL,
  `tr_price` double(12,1) DEFAULT NULL COMMENT '상품가격',
  `tr_discount` float(5,1) NOT NULL,
  `tr_payback` double(30,8) NOT NULL,
  `tr_price_cash` double(12,1) DEFAULT NULL COMMENT '상품가격',
  `tr_discount_cash` float(5,1) NOT NULL,
  `tr_payback_cash` double(30,8) NOT NULL,
  `tr_class` int(2) DEFAULT NULL COMMENT '상품의 단계',
  `tr_fee` float(10,2) DEFAULT NULL COMMENT '구매 수수료',
  `tr_seller_fee` float(10,2) NOT NULL,
  `tr_paytype` varchar(20) DEFAULT NULL,
  `tr_bank` varchar(50) NOT NULL,
  `tr_bank_num` varchar(50) NOT NULL,
  `tr_bank_user` varchar(50) NOT NULL,
  `tr_set_paytype` varchar(10) NOT NULL,
  `tr_wallet_addr` varchar(100) DEFAULT NULL,
  `tr_balance` double(30,8) NOT NULL,
  `tr_balance_last` double(30,8) NOT NULL,
  `tr_txid` varchar(100) DEFAULT NULL,
  `tr_deposit` varchar(30) NOT NULL,
  `tr_stats` varchar(20) DEFAULT NULL,
  `tr_paydate` datetime DEFAULT NULL,
  `tr_distri` varchar(10) NOT NULL,
  `tr_penalty` tinyint(1) NOT NULL,
  `tr_penalty_date` datetime NOT NULL,
  `tr_wdate` date DEFAULT NULL COMMENT '거래일',
  `tr_setdate` datetime NOT NULL,
  `tr_rdate` datetime DEFAULT NULL COMMENT '거래일',
  `tr_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`tr_code`),
  KEY `cart_code` (`cart_code`),
  KEY `cn_item` (`cn_item`),
  KEY `mb_id` (`mb_id`),
  KEY `fmb_id` (`fmb_id`),
  KEY `fsmb_id` (`fsmb_id`),
  KEY `smb_id` (`smb_id`),
  KEY `to_cart_code` (`to_cart_code`),
  KEY `tr_wdate` (`tr_wdate`),
  KEY `tr_stats` (`tr_stats`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_item_trade_test`
--

LOCK TABLES `coin_item_trade_test` WRITE;
/*!40000 ALTER TABLE `coin_item_trade_test` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_item_trade_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_point_2008`
--

DROP TABLE IF EXISTS `coin_point_2008`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_point_2008` (
  `pt_no` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
  `pt_wallet` varchar(20) NOT NULL,
  `pt_coin` varchar(20) NOT NULL,
  `pkind` varchar(30) NOT NULL COMMENT '수당구분(fee:수당,in:수당이전수입,out:수당이전지출,pay:수당지급)',
  `mb_id` varchar(30) NOT NULL COMMENT '수급 회원 아이디',
  `mb_grade` tinyint(2) NOT NULL COMMENT '지급당시 회원 등급',
  `smb_id` varchar(30) NOT NULL COMMENT '수급 회원 서브 아이디',
  `fmb_id` varchar(30) NOT NULL COMMENT '지급 회원 아이디(매출발생회원)',
  `fmb_step` tinyint(2) NOT NULL COMMENT '수급-지급 회원간 단계',
  `ratio` float(4,2) DEFAULT NULL COMMENT '매출대비 지급수당 율',
  `amount` double(30,8) DEFAULT NULL COMMENT '지급액',
  `usd` double(12,2) DEFAULT NULL COMMENT '지급액 USD',
  `f_coin` varchar(20) NOT NULL,
  `waddr_from` varchar(300) NOT NULL,
  `waddr_to` varchar(300) NOT NULL,
  `link_no` varchar(30) NOT NULL COMMENT '지급 사유 데이터 고유번호(참여테이블, 수당 이전테이블)',
  `link_data` varchar(255) NOT NULL COMMENT '지급 사유 데이터의 설명',
  `subject` varchar(500) NOT NULL COMMENT '비고',
  `pdate` date NOT NULL,
  `wdate` datetime DEFAULT NULL COMMENT '최초 등록일',
  `mdate` datetime DEFAULT NULL COMMENT '최근 수정일',
  PRIMARY KEY (`pt_no`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='수당 내역 테이블';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_point_2008`
--

LOCK TABLES `coin_point_2008` WRITE;
/*!40000 ALTER TABLE `coin_point_2008` DISABLE KEYS */;
INSERT INTO `coin_point_2008` VALUES (1,'free','i','Inherit','admin',0,'admin','admin',0,0.00,5455.00000000,0.00,'','','','admin.03','','서브 계정 포인트 이전','0000-00-00','2020-08-17 17:36:10','2020-08-17 17:36:10'),(2,'free','i','Inherit','admin',0,'admin','admin',0,0.00,200.00000000,0.00,'','','','admin.02','','서브 계정 포인트 이전','0000-00-00','2020-08-17 17:36:10','2020-08-17 17:36:10'),(3,'free','i','Inherit','admin',0,'admin','admin',0,0.00,400.00000000,0.00,'','','','admin.01','','서브 계정 포인트 이전','0000-00-00','2020-08-17 17:36:10','2020-08-17 17:36:10'),(4,'free','i','joinb','gold',0,'gold','gold',0,0.00,1000.00000000,0.00,'','','','','','가입 축하금','0000-00-00','2020-08-17 17:41:52','2020-08-17 17:41:52'),(5,'free','i','joinb','star',0,'star','star',0,0.00,1000.00000000,0.00,'','','','','','가입 축하금','0000-00-00','2020-08-17 18:06:53','2020-08-17 18:06:53'),(6,'free','i','joinb','medi',0,'medi','medi',0,0.00,1000.00000000,0.00,'','','','','','가입 축하금','0000-00-00','2020-08-17 18:09:34','2020-08-17 18:09:34'),(7,'free','i','joinb','zeit',0,'zeit','zeit',0,0.00,1000.00000000,0.00,'','','','','','가입 축하금','0000-00-00','2020-08-17 18:27:51','2020-08-17 18:27:51'),(8,'free','i','joinb','roland',0,'roland','roland',0,0.00,1000.00000000,0.00,'','','','','','가입 축하금','0000-00-00','2020-08-17 18:45:32','2020-08-17 18:45:32'),(9,'free','i','joinb','lacan',0,'lacan','lacan',0,0.00,1000.00000000,0.00,'','','','','','가입 축하금','0000-00-00','2020-08-17 19:42:20','2020-08-17 19:42:20'),(10,'free','i','joinb','2020',0,'2020','2020',0,0.00,1000.00000000,0.00,'','','','','','가입 축하금','0000-00-00','2020-08-17 19:47:28','2020-08-17 19:47:28'),(11,'free','i','joinb','Ohba',0,'Ohba','Ohba',0,0.00,1000.00000000,0.00,'','','','','','가입 축하금','0000-00-00','2020-08-17 20:59:16','2020-08-17 20:59:16'),(12,'free','i','joinb','gong',0,'gong','gong',0,0.00,1000.00000000,0.00,'','','','','','가입 축하금','0000-00-00','2020-08-17 21:03:35','2020-08-17 21:03:35'),(13,'free','i','joinb','lkj1186',0,'lkj1186','lkj1186',0,0.00,1000.00000000,0.00,'','','','','','가입 축하금','0000-00-00','2020-08-17 21:08:47','2020-08-17 21:08:47'),(14,'free','i','joinb','steven',0,'steven','steven',0,0.00,1000.00000000,0.00,'','','','','','가입 축하금','0000-00-00','2020-08-17 21:17:29','2020-08-17 21:17:29');
/*!40000 ALTER TABLE `coin_point_2008` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_pointsum`
--

DROP TABLE IF EXISTS `coin_pointsum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_pointsum` (
  `pt_no` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
  `pt_wallet` varchar(20) NOT NULL,
  `pt_coin` varchar(20) NOT NULL,
  `pkind` varchar(30) NOT NULL COMMENT '수당의 구분',
  `mb_id` varchar(30) NOT NULL COMMENT '회원 아이디',
  `smb_id` varchar(30) NOT NULL,
  `amount` double(30,8) DEFAULT NULL COMMENT '총액',
  `usd` double(12,2) DEFAULT NULL COMMENT '총액 USD',
  `cnt` int(10) NOT NULL COMMENT '합산된 건수',
  `wdate` datetime DEFAULT NULL COMMENT '최초 등록일',
  `mdate` datetime DEFAULT NULL COMMENT '최근 수정일',
  PRIMARY KEY (`pt_no`),
  KEY `pkind` (`pkind`),
  KEY `mb_id` (`mb_id`),
  KEY `pt_wallet` (`pt_wallet`),
  KEY `pt_coin` (`pt_coin`),
  KEY `smb_id` (`smb_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='수당 합산 테이블';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_pointsum`
--

LOCK TABLES `coin_pointsum` WRITE;
/*!40000 ALTER TABLE `coin_pointsum` DISABLE KEYS */;
INSERT INTO `coin_pointsum` VALUES (1,'free','i','Inherit','admin','admin',6055.00000000,NULL,3,NULL,'2020-08-17 17:36:10'),(2,'free','i','joinb','gold','gold',1000.00000000,NULL,1,NULL,'2020-08-17 17:41:52'),(3,'free','i','joinb','star','star',1000.00000000,NULL,1,NULL,'2020-08-17 18:06:53'),(4,'free','i','joinb','medi','medi',1000.00000000,NULL,1,NULL,'2020-08-17 18:09:34'),(5,'free','i','joinb','zeit','zeit',1000.00000000,NULL,1,NULL,'2020-08-17 18:27:51'),(6,'free','i','joinb','roland','roland',1000.00000000,NULL,1,NULL,'2020-08-17 18:45:32'),(7,'free','i','joinb','lacan','lacan',1000.00000000,NULL,1,NULL,'2020-08-17 19:42:20'),(8,'free','i','joinb','2020','2020',1000.00000000,NULL,1,NULL,'2020-08-17 19:47:28'),(9,'free','i','joinb','Ohba','Ohba',1000.00000000,NULL,1,NULL,'2020-08-17 20:59:16'),(10,'free','i','joinb','gong','gong',1000.00000000,NULL,1,NULL,'2020-08-17 21:03:35'),(11,'free','i','joinb','lkj1186','lkj1186',1000.00000000,NULL,1,NULL,'2020-08-17 21:08:47'),(12,'free','i','joinb','steven','steven',1000.00000000,NULL,1,NULL,'2020-08-17 21:17:29');
/*!40000 ALTER TABLE `coin_pointsum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_setting`
--

DROP TABLE IF EXISTS `coin_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_setting` (
  `deposite_reward_r` double(6,2) NOT NULL,
  `join_bonus_b` double(30,4) NOT NULL,
  `join_bonus_e` double(30,4) NOT NULL,
  `join_bonus_i` double(30,4) NOT NULL,
  `join_bonus_u` double(30,4) NOT NULL,
  `promote_bonus_b` double(30,4) NOT NULL,
  `promote_bonus_e` double(30,4) NOT NULL,
  `promote_bonus_i` double(30,4) NOT NULL,
  `promote_bonus_u` double(30,4) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_num` varchar(100) NOT NULL,
  `bank_user` varchar(100) NOT NULL,
  `max_account_lmt` int(10) NOT NULL,
  `in_div_r1` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '입금시 자유방 분배 비율',
  `in_div_r2` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '입금시 고정방 분배 비율',
  `trans_r` float(5,1) NOT NULL DEFAULT '0.0' COMMENT '자유방에서 고정방 전송시 변환 배율',
  `daily_bs_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '고정방 데일리 보너스',
  `daily_bs_min` int(11) NOT NULL DEFAULT '0' COMMENT '고정방 데일리 보너스 최소 조건 금액',
  `pr_bs_r` float(3,1) NOT NULL DEFAULT '0.0',
  `max_bs_r` int(10) NOT NULL,
  `max_out_b` double(10,7) NOT NULL,
  `max_out_e` double(10,2) NOT NULL,
  `max_out_i` double(30,8) NOT NULL,
  `max_out_u` float(10,2) NOT NULL,
  `max_out_s` float(10,2) NOT NULL,
  `min_out_b` double(30,8) NOT NULL,
  `min_out_e` double(30,8) NOT NULL,
  `min_out_i` double(30,8) NOT NULL,
  `min_out_u` double(30,8) NOT NULL,
  `min_trans_b` double(30,8) NOT NULL,
  `min_trans_e` double(30,8) NOT NULL,
  `min_trans_i` double(30,8) NOT NULL,
  `min_trans_u` double(30,8) NOT NULL,
  `out_r` float NOT NULL,
  `out_fee_b` double(30,8) NOT NULL,
  `out_fee_e` double(30,8) NOT NULL,
  `out_fee_i` double(30,8) NOT NULL,
  `out_fee_u` double(30,8) NOT NULL,
  `trans_fee_b` double(30,8) NOT NULL,
  `trans_fee_e` double(30,8) NOT NULL,
  `trans_fee_i` double(30,8) NOT NULL,
  `trans_fee_u` double(30,8) NOT NULL,
  `swap_fee_b` double(30,8) NOT NULL,
  `swap_fee_e` double(30,8) NOT NULL,
  `swap_fee_i` double(30,8) NOT NULL,
  `swap_fee_u` double(30,8) NOT NULL,
  `staking_amt` double(30,8) NOT NULL,
  `staking_reward` double(30,8) NOT NULL,
  `staking_ref_amt` double(30,8) NOT NULL,
  `staking_fee1` double(5,2) NOT NULL,
  `staking_fee2` double(5,2) NOT NULL,
  `staking_fee3` double(5,2) NOT NULL,
  `staking_fee4` double(5,2) NOT NULL,
  `staking_fee5` double(5,2) NOT NULL,
  `staking_fee6` double(5,2) NOT NULL,
  `staking_fee7` double(5,2) NOT NULL,
  `staking_fee8` double(5,2) NOT NULL,
  `max_sp_num` bigint(20) NOT NULL COMMENT '최대 가용금액',
  `min_sp_num` int(10) NOT NULL,
  `mtoken_min_r` float(3,1) NOT NULL,
  `wallet_in_b` varchar(300) NOT NULL,
  `wallet_out_b` varchar(300) NOT NULL,
  `wallet_in_e` varchar(300) NOT NULL,
  `wallet_out_e` varchar(300) NOT NULL,
  `wallet_in_i` varchar(300) NOT NULL,
  `wallet_out_i` varchar(300) NOT NULL,
  `wallet_in_u` varchar(300) NOT NULL,
  `wallet_out_u` varchar(300) NOT NULL,
  `pr_rup_bs1_step` int(11) NOT NULL DEFAULT '0' COMMENT '추천인 1명시 추천롤업 최대 단계',
  `pr_rup_bs1_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '추천인 1명시 추천롤업 비율',
  `pr_rup_bs2_step` int(11) NOT NULL DEFAULT '0',
  `pr_rup_bs2_r` float(3,1) NOT NULL DEFAULT '0.0',
  `pr_rup_bs3_step` int(11) NOT NULL DEFAULT '0',
  `pr_rup_bs3_r` float(3,1) NOT NULL DEFAULT '0.0',
  `pr_rup_bs4_step` int(11) NOT NULL DEFAULT '0',
  `pr_rup_bs4_r` float(3,1) NOT NULL DEFAULT '0.0',
  `pr_rup_bs5_step` int(11) NOT NULL DEFAULT '0',
  `pr_rup_bs5_r` float(3,1) NOT NULL DEFAULT '0.0',
  `pr_rup_bs6_step` int(10) NOT NULL,
  `pr_rup_bs6_r` float(3,1) NOT NULL,
  `pr_rup_bs7_step` int(10) NOT NULL,
  `pr_rup_bs7_r` float(3,1) NOT NULL,
  `pr_rup_bs8_step` int(10) NOT NULL,
  `pr_rup_bs8_r` float(3,1) NOT NULL,
  `pr_rup_bs9_step` int(10) NOT NULL,
  `pr_rup_bs9_r` float(3,1) NOT NULL,
  `pr_rup_bs10_step` int(10) NOT NULL,
  `pr_rup_bs10_r` float(3,1) NOT NULL,
  `pr_rup_bs11_step` int(10) NOT NULL,
  `pr_rup_bs11_r` float(3,1) NOT NULL,
  `pr_rup_bs12_step` int(10) NOT NULL,
  `pr_rup_bs12_r` float(3,1) NOT NULL,
  `pr_rup_bs13_step` int(10) NOT NULL,
  `pr_rup_bs13_r` float(3,1) NOT NULL,
  `pr_rup_bs14_step` int(10) NOT NULL,
  `pr_rup_bs14_r` float(3,1) NOT NULL,
  `pr_rup_bs15_step` int(10) NOT NULL,
  `pr_rup_bs15_r` float(3,1) NOT NULL,
  `pr_rup_bs_cls1_step` int(11) NOT NULL DEFAULT '0' COMMENT '직급1 추천롤업 최대 단계',
  `pr_rup_bs_cls1_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '직급1 추천롤업 비율',
  `pr_rup_bs_cls2_step` int(11) NOT NULL DEFAULT '0' COMMENT '직급2 추천롤업 최대 단계',
  `pr_rup_bs_cls2_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '직급2 추천롤업 비율',
  `pr_rup_bs_cls3_step` int(11) NOT NULL DEFAULT '0' COMMENT '직급3 추천롤업 최대 단계',
  `pr_rup_bs_cls3_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '직급3 추천롤업 비율',
  `pr_rup_bs_cls4_step` int(11) NOT NULL DEFAULT '0' COMMENT '직급4 추천롤업 최대 단계',
  `pr_rup_bs_cls4_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '직급4 추천롤업 비율',
  `pr_rup_bs_cls5_step` int(11) NOT NULL DEFAULT '0' COMMENT '직급5 추천롤업 최대 단계',
  `pr_rup_bs_cls5_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '직급5 추천롤업 비율',
  `pr_rup_bs_cls6_step` int(11) NOT NULL DEFAULT '0' COMMENT '직급6 추천롤업 최대 단계',
  `pr_rup_bs_cls6_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '직급6 추천롤업 비율',
  `pr_rup_bs_cls7_step` int(11) NOT NULL DEFAULT '0' COMMENT '직급7 추천롤업 최대 단계',
  `pr_rup_bs_cls7_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '직급7 추천롤업 비율',
  `pr_rup_bs_cls8_step` int(11) NOT NULL DEFAULT '0',
  `pr_rup_bs_cls8_r` float(3,1) NOT NULL DEFAULT '0.0',
  `pr_rup_bs_cls9_step` int(11) NOT NULL DEFAULT '0',
  `pr_rup_bs_cls9_r` float(3,1) NOT NULL DEFAULT '0.0',
  `sp_rup_bs1_step` int(11) NOT NULL DEFAULT '0' COMMENT '추천롤업 최대 단계',
  `sp_rup_bs1_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '추천롤업 비율',
  `sp_rup_bs2_step` int(11) NOT NULL DEFAULT '0',
  `sp_rup_bs2_r` float(3,1) NOT NULL DEFAULT '0.0',
  `sp_rup_bs3_step` int(11) NOT NULL DEFAULT '0',
  `sp_rup_bs3_r` float(3,1) NOT NULL DEFAULT '0.0',
  `sp_rup_bs4_step` int(11) NOT NULL DEFAULT '0',
  `sp_rup_bs4_r` float(3,1) NOT NULL DEFAULT '0.0',
  `sp_rup_bs5_step` int(11) NOT NULL DEFAULT '0',
  `sp_rup_bs5_r` float(3,1) NOT NULL DEFAULT '0.0',
  `sp_bs_cls1_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '직급1 추천롤업 매출액 대비 지급 비율',
  `sp_bs_cls2_r` float(3,1) NOT NULL DEFAULT '0.0',
  `sp_bs_cls3_r` float(3,1) NOT NULL DEFAULT '0.0',
  `sp_bs_cls4_r` float(3,1) NOT NULL DEFAULT '0.0',
  `sp_bs_cls5_r` float(3,1) NOT NULL DEFAULT '0.0',
  `sp_bs_cls6_r` float(3,1) NOT NULL DEFAULT '0.0',
  `sp_bs_cls7_r` float(3,1) NOT NULL DEFAULT '0.0',
  `sp_bs_cls8_r` float(3,1) NOT NULL DEFAULT '0.0',
  `sp_bs_cls9_r` float(3,1) NOT NULL DEFAULT '0.0',
  `cls_bs_cls1_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '직급1 총수익 대비 지급 비율',
  `cls_bs_cls2_r` float(3,1) NOT NULL DEFAULT '0.0',
  `cls_bs_cls3_r` float(3,1) NOT NULL DEFAULT '0.0',
  `cls_bs_cls4_r` float(3,1) NOT NULL DEFAULT '0.0',
  `cls_bs_cls5_r` float(3,1) NOT NULL DEFAULT '0.0',
  `cls_bs_cls6_r` float(3,1) NOT NULL DEFAULT '0.0',
  `cls_bs_cls7_r` float(3,1) NOT NULL DEFAULT '0.0',
  `cls_bs_cls8_r` float(3,1) NOT NULL DEFAULT '0.0',
  `cls_bs_cls9_r` float(3,1) NOT NULL DEFAULT '0.0',
  `lvup_cls1_sales1` int(11) NOT NULL DEFAULT '0',
  `lvup_cls1_sales2` int(11) NOT NULL DEFAULT '0',
  `lvup_cls1_sales3` bigint(20) NOT NULL,
  `lvup_cls1_subor` int(11) NOT NULL DEFAULT '0',
  `lvup_cls2_sales1` int(11) NOT NULL DEFAULT '0',
  `lvup_cls2_sales2` int(11) NOT NULL DEFAULT '0',
  `lvup_cls2_sales3` bigint(20) NOT NULL,
  `lvup_cls2_subor` int(11) NOT NULL DEFAULT '0',
  `lvup_cls3_sales1` int(11) NOT NULL DEFAULT '0',
  `lvup_cls3_sales2` int(11) NOT NULL DEFAULT '0',
  `lvup_cls3_sales3` bigint(20) NOT NULL,
  `lvup_cls3_subor` int(11) NOT NULL DEFAULT '0',
  `lvup_cls4_sales1` int(11) NOT NULL DEFAULT '0',
  `lvup_cls4_sales2` int(11) NOT NULL DEFAULT '0',
  `lvup_cls4_sales3` bigint(20) NOT NULL,
  `lvup_cls4_subor` int(11) NOT NULL DEFAULT '0',
  `lvup_cls5_sales1` int(11) NOT NULL DEFAULT '0',
  `lvup_cls5_sales2` int(11) NOT NULL DEFAULT '0',
  `lvup_cls5_sales3` bigint(20) NOT NULL,
  `lvup_cls5_subor` int(11) NOT NULL DEFAULT '0',
  `lvup_cls6_sales1` int(11) NOT NULL DEFAULT '0',
  `lvup_cls6_sales2` int(11) NOT NULL DEFAULT '0',
  `lvup_cls6_sales3` bigint(20) NOT NULL,
  `lvup_cls6_subor` int(11) NOT NULL DEFAULT '0',
  `lvup_cls7_sales1` int(11) NOT NULL DEFAULT '0',
  `lvup_cls7_sales2` int(11) NOT NULL DEFAULT '0',
  `lvup_cls7_sales3` bigint(20) NOT NULL,
  `lvup_cls7_subor` int(11) NOT NULL DEFAULT '0',
  `lvup_cls8_sales1` int(11) NOT NULL DEFAULT '0',
  `lvup_cls8_sales2` int(11) NOT NULL DEFAULT '0',
  `lvup_cls8_sales3` bigint(20) NOT NULL,
  `lvup_cls8_subor` int(11) NOT NULL DEFAULT '0',
  `lvup_cls9_sales1` int(11) NOT NULL DEFAULT '0',
  `lvup_cls9_sales2` int(11) NOT NULL DEFAULT '0',
  `lvup_cls9_sales3` bigint(20) NOT NULL,
  `lvup_cls9_subor` int(11) NOT NULL DEFAULT '0',
  `service_block` tinyint(1) NOT NULL,
  `ed_bs_jijum_sales` int(11) NOT NULL DEFAULT '0' COMMENT '지점 최소 매출액',
  `ed_bs_jijum_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '지점 교육수당',
  `ed_bs_jisa_sales` int(11) NOT NULL DEFAULT '0' COMMENT '지자 최소 매출액',
  `ed_bs_jisa_r` float(3,1) NOT NULL DEFAULT '0.0' COMMENT '지자 교육수당'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_setting`
--

LOCK TABLES `coin_setting` WRITE;
/*!40000 ALTER TABLE `coin_setting` DISABLE KEYS */;
INSERT INTO `coin_setting` VALUES (0.00,0.0000,0.0000,1000.0000,0.0000,0.0000,0.0000,0.0000,0.0000,'농협','12345-123-12345','마이닝',50,0.0,0.0,0.0,0.0,0,0.0,0,0.0000000,0.00,0.00000000,0.00,0.00,0.00000000,0.00000000,200.00000000,200.00000000,0.00000000,0.00000000,100.00000000,50.00000000,0,0.00000000,0.00000000,5.00000000,5.00000000,0.00000000,0.00000000,0.00000000,10.00000000,0.00000000,0.00000000,2.00000000,2.00000000,200.00000000,0.00000000,0.00000000,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,1200,500,0.0,'','','','','','','','',1,0.0,2,0.0,3,0.0,4,0.0,5,0.0,6,0.0,10,0.0,11,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,5.0,0.0,0.0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0.0,0,0.0);
/*!40000 ALTER TABLE `coin_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_settle`
--

DROP TABLE IF EXISTS `coin_settle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_settle` (
  `st_no` int(20) NOT NULL AUTO_INCREMENT,
  `st_pkind` varchar(10) NOT NULL,
  `st_token` varchar(10) NOT NULL,
  `st_amt` double(30,8) NOT NULL,
  `st_usd` double(30,8) NOT NULL,
  `st_amt_b` double(30,8) NOT NULL,
  `st_amt_e` double(30,8) NOT NULL,
  `st_amt_i` double(30,8) NOT NULL,
  `st_amt_u` double(30,8) NOT NULL,
  `st_cnt` int(10) NOT NULL,
  `st_log` varchar(500) NOT NULL,
  `st_date` date NOT NULL,
  `st_wdate` datetime NOT NULL,
  `st_result` tinyint(1) NOT NULL,
  PRIMARY KEY (`st_no`),
  KEY `st_date` (`st_date`),
  KEY `st_pkind` (`st_pkind`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_settle`
--

LOCK TABLES `coin_settle` WRITE;
/*!40000 ALTER TABLE `coin_settle` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_settle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_sise`
--

DROP TABLE IF EXISTS `coin_sise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_sise` (
  `is_flow` tinyint(1) NOT NULL,
  `data` text,
  `wdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_sise`
--

LOCK TABLES `coin_sise` WRITE;
/*!40000 ALTER TABLE `coin_sise` DISABLE KEYS */;
INSERT INTO `coin_sise` VALUES (2,'{\"sise_b\":\"0.1\",\"sise_e\":\"0\",\"sise_i\":\"0.1\",\"sise_u\":\"1\"}','2020-07-07 06:22:35');
/*!40000 ALTER TABLE `coin_sise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_stake`
--

DROP TABLE IF EXISTS `coin_stake`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_stake` (
  `sk_no` int(20) NOT NULL AUTO_INCREMENT,
  `sk_code` varchar(30) NOT NULL,
  `mb_id` varchar(20) NOT NULL,
  `sk_wallet` varchar(30) NOT NULL,
  `sk_token` varchar(10) NOT NULL,
  `sk_amt` double(30,8) NOT NULL,
  `sk_stats` tinyint(1) NOT NULL,
  `sk_wdate` datetime NOT NULL,
  `sk_sdate` datetime NOT NULL,
  `sk_edate` datetime NOT NULL,
  `logs` text NOT NULL,
  PRIMARY KEY (`sk_no`),
  KEY `mb_id` (`mb_id`),
  KEY `sk_wallet` (`sk_wallet`),
  KEY `sk_token` (`sk_token`),
  KEY `sk_stats` (`sk_stats`),
  KEY `sk_code` (`sk_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_stake`
--

LOCK TABLES `coin_stake` WRITE;
/*!40000 ALTER TABLE `coin_stake` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_stake` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_sub_account`
--

DROP TABLE IF EXISTS `coin_sub_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_sub_account` (
  `ac_no` int(20) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(30) DEFAULT NULL,
  `ac_id` varchar(35) NOT NULL,
  `ac_point_b` double(30,6) DEFAULT NULL,
  `ac_point_e` double(30,6) DEFAULT NULL,
  `ac_point_i` double(30,6) DEFAULT NULL,
  `ac_point_u` double(30,6) DEFAULT NULL,
  `ac_active` tinyint(1) DEFAULT NULL,
  `ac_auto_a` tinyint(1) NOT NULL,
  `ac_auto_b` tinyint(1) NOT NULL,
  `ac_auto_c` tinyint(1) NOT NULL,
  `ac_auto_d` tinyint(1) NOT NULL,
  `ac_auto_e` tinyint(1) NOT NULL,
  `ac_auto_f` tinyint(1) NOT NULL,
  `ac_auto_g` tinyint(1) NOT NULL,
  `ac_auto_h` tinyint(1) NOT NULL,
  `ac_mc_priority` tinyint(1) NOT NULL,
  `ac_mc_except` tinyint(1) NOT NULL,
  `ac_wdate` datetime DEFAULT NULL,
  PRIMARY KEY (`ac_no`),
  UNIQUE KEY `ac_id_2` (`ac_id`),
  KEY `mb_id` (`mb_id`),
  KEY `ac_active` (`ac_active`),
  KEY `ac_id` (`ac_id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_sub_account`
--

LOCK TABLES `coin_sub_account` WRITE;
/*!40000 ALTER TABLE `coin_sub_account` DISABLE KEYS */;
INSERT INTO `coin_sub_account` VALUES (1,'admin','admin',0.000000,0.000000,6055.000000,0.000000,0,0,0,0,0,0,0,0,0,0,0,'2020-07-27 04:40:05'),(48,'g','g',NULL,NULL,0.000000,NULL,0,0,0,0,0,0,0,0,0,0,0,'2020-08-17 17:41:52'),(49,'s','s',NULL,NULL,0.000000,NULL,0,0,0,0,0,0,0,0,0,0,0,'2020-08-17 18:06:53'),(50,'m','m',NULL,NULL,0.000000,NULL,0,0,0,0,0,0,0,0,0,0,0,'2020-08-17 18:09:34'),(51,'z','z',NULL,NULL,0.000000,NULL,0,0,0,0,0,0,0,0,0,0,0,'2020-08-17 18:27:51'),(52,'r','r',NULL,NULL,0.000000,NULL,0,0,0,0,0,0,0,0,0,0,0,'2020-08-17 18:45:32'),(53,'l','l',NULL,NULL,0.000000,NULL,0,0,0,0,0,0,0,0,0,0,0,'2020-08-17 19:42:20'),(54,'2','2',NULL,NULL,0.000000,NULL,2,0,0,0,0,0,0,0,0,0,0,'2020-08-17 19:47:28'),(55,'O','O',NULL,NULL,0.000000,NULL,0,0,0,0,0,0,0,0,0,0,0,'2020-08-17 20:59:16'),(56,'Ohba','Ohba',0.000000,0.000000,1000.000000,0.000000,0,0,0,0,0,0,0,0,0,0,0,'2020-08-17 20:59:24');
/*!40000 ALTER TABLE `coin_sub_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_swap`
--

DROP TABLE IF EXISTS `coin_swap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_swap` (
  `sw_no` int(20) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL,
  `sw_token` varchar(10) NOT NULL,
  `sw_wallet_addr` varchar(300) NOT NULL,
  `sw_amt` double(30,8) NOT NULL,
  `sw_fee` double(30,8) NOT NULL,
  `sw_tamt` double(30,8) NOT NULL,
  `sw_set_token` varchar(10) NOT NULL,
  `sw_set_amt` double(30,8) NOT NULL,
  `sw_set_date` datetime NOT NULL,
  `sw_stats` tinyint(1) NOT NULL,
  `sw_wdate` datetime NOT NULL,
  `sw_mdate` datetime NOT NULL,
  PRIMARY KEY (`sw_no`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_swap`
--

LOCK TABLES `coin_swap` WRITE;
/*!40000 ALTER TABLE `coin_swap` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_swap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_token_addr`
--

DROP TABLE IF EXISTS `coin_token_addr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_token_addr` (
  `token_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `token_name` varchar(20) NOT NULL,
  `token_addr` varchar(80) DEFAULT NULL,
  `mb_id` varchar(20) NOT NULL,
  `trade_no` int(11) NOT NULL,
  `token_wdate` datetime NOT NULL,
  PRIMARY KEY (`token_no`),
  UNIQUE KEY `token_addr` (`token_addr`),
  KEY `token_name` (`token_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_token_addr`
--

LOCK TABLES `coin_token_addr` WRITE;
/*!40000 ALTER TABLE `coin_token_addr` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_token_addr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_transfer`
--

DROP TABLE IF EXISTS `coin_transfer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_transfer` (
  `tr_no` int(20) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL,
  `tr_token` varchar(10) NOT NULL,
  `tr_site` varchar(20) NOT NULL,
  `tmb_id` varchar(20) NOT NULL,
  `stmb_id` varchar(30) NOT NULL,
  `tr_amt` double(30,8) NOT NULL,
  `tr_fee` double(30,8) NOT NULL,
  `tr_fee_token` varchar(10) NOT NULL,
  `tr_tamt` double(30,8) NOT NULL,
  `tr_set_token` varchar(10) NOT NULL,
  `tr_set_amt` double(30,8) NOT NULL,
  `tr_set_fee` double(30,8) NOT NULL,
  `tr_set_tamt` double(30,8) NOT NULL,
  `tr_set_date` datetime NOT NULL,
  `tr_stats` tinyint(1) NOT NULL,
  `tr_wdate` datetime NOT NULL,
  `tr_mdate` datetime NOT NULL,
  PRIMARY KEY (`tr_no`),
  KEY `mb_id` (`mb_id`),
  KEY `tmb_id` (`tmb_id`),
  KEY `stmb_id` (`stmb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_transfer`
--

LOCK TABLES `coin_transfer` WRITE;
/*!40000 ALTER TABLE `coin_transfer` DISABLE KEYS */;
/*!40000 ALTER TABLE `coin_transfer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coin_tree`
--

DROP TABLE IF EXISTS `coin_tree`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coin_tree` (
  `no` bigint(20) NOT NULL AUTO_INCREMENT,
  `mb_no` int(11) NOT NULL,
  `mb_id` varchar(20) NOT NULL COMMENT '부모 회원',
  `smb_id` varchar(20) NOT NULL COMMENT '자식 회원',
  `step` int(2) DEFAULT NULL COMMENT '부모-자식 회원간 단계',
  PRIMARY KEY (`no`),
  KEY `mb_no` (`mb_id`),
  KEY `smb_no` (`smb_id`),
  KEY `mb_id` (`mb_id`),
  KEY `smb_id` (`smb_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='회원간 후원 계보 정보';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coin_tree`
--

LOCK TABLES `coin_tree` WRITE;
/*!40000 ALTER TABLE `coin_tree` DISABLE KEYS */;
INSERT INTO `coin_tree` VALUES (1,1,'admin','gold',1),(2,1,'admin','star',1),(3,1,'admin','medi',1),(4,7719,'gold','zeit',1),(5,1,'admin','zeit',2),(6,7722,'zeit','roland',1),(7,7719,'gold','roland',2),(8,1,'admin','roland',3),(9,7723,'roland','lacan',1),(10,7722,'zeit','lacan',2),(11,7719,'gold','lacan',3),(12,1,'admin','lacan',4),(13,1,'admin','2020',1),(14,7725,'2020','Ohba',1),(15,1,'admin','Ohba',2),(16,7725,'2020','gong',1),(17,1,'admin','gong',2),(18,7726,'ohba','lkj1186',1),(19,7725,'2020','lkj1186',2),(20,1,'admin','lkj1186',3),(21,7728,'lkj1186','steven',1),(22,7726,'ohba','steven',2),(23,7725,'2020','steven',3),(24,1,'admin','steven',4);
/*!40000 ALTER TABLE `coin_tree` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_auth`
--

DROP TABLE IF EXISTS `g5_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_auth` (
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `au_menu` varchar(20) NOT NULL DEFAULT '',
  `au_auth` set('r','w','d') NOT NULL DEFAULT '',
  PRIMARY KEY (`mb_id`,`au_menu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_auth`
--

LOCK TABLES `g5_auth` WRITE;
/*!40000 ALTER TABLE `g5_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_autosave`
--

DROP TABLE IF EXISTS `g5_autosave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_autosave` (
  `as_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL,
  `as_uid` bigint(20) unsigned NOT NULL,
  `as_subject` varchar(255) NOT NULL,
  `as_content` text NOT NULL,
  `as_datetime` datetime NOT NULL,
  PRIMARY KEY (`as_id`),
  UNIQUE KEY `as_uid` (`as_uid`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_autosave`
--

LOCK TABLES `g5_autosave` WRITE;
/*!40000 ALTER TABLE `g5_autosave` DISABLE KEYS */;
INSERT INTO `g5_autosave` VALUES (1,'admin',2020061006594487,'c','g','2020-06-10 07:00:45');
/*!40000 ALTER TABLE `g5_autosave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_board`
--

DROP TABLE IF EXISTS `g5_board`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_board` (
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `gr_id` varchar(255) NOT NULL DEFAULT '',
  `bo_subject` varchar(255) NOT NULL DEFAULT '',
  `bo_mobile_subject` varchar(255) NOT NULL DEFAULT '',
  `bo_device` enum('both','pc','mobile') NOT NULL DEFAULT 'both',
  `bo_admin` varchar(255) NOT NULL DEFAULT '',
  `bo_list_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_read_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_write_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_reply_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_comment_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_upload_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_download_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_html_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_link_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_count_delete` tinyint(4) NOT NULL DEFAULT '0',
  `bo_count_modify` tinyint(4) NOT NULL DEFAULT '0',
  `bo_read_point` int(11) NOT NULL DEFAULT '0',
  `bo_write_point` int(11) NOT NULL DEFAULT '0',
  `bo_comment_point` int(11) NOT NULL DEFAULT '0',
  `bo_download_point` int(11) NOT NULL DEFAULT '0',
  `bo_use_category` tinyint(4) NOT NULL DEFAULT '0',
  `bo_category_list` text NOT NULL,
  `bo_use_sideview` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_file_content` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_secret` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_dhtml_editor` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_rss_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_good` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_nogood` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_name` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_signature` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_ip_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_file` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_content` tinyint(4) NOT NULL DEFAULT '0',
  `bo_table_width` int(11) NOT NULL DEFAULT '0',
  `bo_subject_len` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_subject_len` int(11) NOT NULL DEFAULT '0',
  `bo_page_rows` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_page_rows` int(11) NOT NULL DEFAULT '0',
  `bo_new` int(11) NOT NULL DEFAULT '0',
  `bo_hot` int(11) NOT NULL DEFAULT '0',
  `bo_image_width` int(11) NOT NULL DEFAULT '0',
  `bo_skin` varchar(255) NOT NULL DEFAULT '',
  `bo_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `bo_include_head` varchar(255) NOT NULL DEFAULT '',
  `bo_include_tail` varchar(255) NOT NULL DEFAULT '',
  `bo_content_head` text NOT NULL,
  `bo_mobile_content_head` text NOT NULL,
  `bo_content_tail` text NOT NULL,
  `bo_mobile_content_tail` text NOT NULL,
  `bo_insert_content` text NOT NULL,
  `bo_gallery_cols` int(11) NOT NULL DEFAULT '0',
  `bo_gallery_width` int(11) NOT NULL DEFAULT '0',
  `bo_gallery_height` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_gallery_width` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_gallery_height` int(11) NOT NULL DEFAULT '0',
  `bo_upload_size` int(11) NOT NULL DEFAULT '0',
  `bo_reply_order` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_search` tinyint(4) NOT NULL DEFAULT '0',
  `bo_order` int(11) NOT NULL DEFAULT '0',
  `bo_count_write` int(11) NOT NULL DEFAULT '0',
  `bo_count_comment` int(11) NOT NULL DEFAULT '0',
  `bo_write_min` int(11) NOT NULL DEFAULT '0',
  `bo_write_max` int(11) NOT NULL DEFAULT '0',
  `bo_comment_min` int(11) NOT NULL DEFAULT '0',
  `bo_comment_max` int(11) NOT NULL DEFAULT '0',
  `bo_notice` text NOT NULL,
  `bo_upload_count` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_email` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_cert` enum('','cert','adult','hp-cert','hp-adult') NOT NULL DEFAULT '',
  `bo_use_sns` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_captcha` tinyint(4) NOT NULL DEFAULT '0',
  `bo_sort_field` varchar(255) NOT NULL DEFAULT '',
  `bo_1_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_2_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_3_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_4_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_5_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_6_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_7_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_8_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_9_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_10_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_1` varchar(255) NOT NULL DEFAULT '',
  `bo_2` varchar(255) NOT NULL DEFAULT '',
  `bo_3` varchar(255) NOT NULL DEFAULT '',
  `bo_4` varchar(255) NOT NULL DEFAULT '',
  `bo_5` varchar(255) NOT NULL DEFAULT '',
  `bo_6` varchar(255) NOT NULL DEFAULT '',
  `bo_7` varchar(255) NOT NULL DEFAULT '',
  `bo_8` varchar(255) NOT NULL DEFAULT '',
  `bo_9` varchar(255) NOT NULL DEFAULT '',
  `bo_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`bo_table`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_board`
--

LOCK TABLES `g5_board` WRITE;
/*!40000 ALTER TABLE `g5_board` DISABLE KEYS */;
INSERT INTO `g5_board` VALUES ('notice','community','공지사항','','both','',1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,100,60,30,15,15,24,100,835,'theme/basic','basic','_head.php','_tail.php','','','','','',1,202,150,125,100,1048576,1,0,0,1,0,0,0,0,0,'',2,0,'',0,0,'','','','','','','','','','','','','','','','','','','','',''),('qna','community','문의하기','','both','',5,5,5,10,10,5,5,10,1,1,1,0,0,0,0,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,100,60,30,15,15,24,100,600,'theme/partner','basic','_head.php','_tail.php','','','','','',1,202,150,125,100,1048576,1,1,0,1,0,0,0,0,0,'',2,0,'',0,0,'','','','','','','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `g5_board` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_board_file`
--

DROP TABLE IF EXISTS `g5_board_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_board_file` (
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `bf_no` int(11) NOT NULL DEFAULT '0',
  `bf_source` varchar(255) NOT NULL DEFAULT '',
  `bf_file` varchar(255) NOT NULL DEFAULT '',
  `bf_download` int(11) NOT NULL,
  `bf_content` text NOT NULL,
  `bf_filesize` int(11) NOT NULL DEFAULT '0',
  `bf_width` int(11) NOT NULL DEFAULT '0',
  `bf_height` smallint(6) NOT NULL DEFAULT '0',
  `bf_type` tinyint(4) NOT NULL DEFAULT '0',
  `bf_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`bo_table`,`wr_id`,`bf_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_board_file`
--

LOCK TABLES `g5_board_file` WRITE;
/*!40000 ALTER TABLE `g5_board_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_board_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_board_good`
--

DROP TABLE IF EXISTS `g5_board_good`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_board_good` (
  `bg_id` int(11) NOT NULL AUTO_INCREMENT,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `bg_flag` varchar(255) NOT NULL DEFAULT '',
  `bg_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`bg_id`),
  UNIQUE KEY `fkey1` (`bo_table`,`wr_id`,`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_board_good`
--

LOCK TABLES `g5_board_good` WRITE;
/*!40000 ALTER TABLE `g5_board_good` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_board_good` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_board_new`
--

DROP TABLE IF EXISTS `g5_board_new`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_board_new` (
  `bn_id` int(11) NOT NULL AUTO_INCREMENT,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `bn_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`bn_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_board_new`
--

LOCK TABLES `g5_board_new` WRITE;
/*!40000 ALTER TABLE `g5_board_new` DISABLE KEYS */;
INSERT INTO `g5_board_new` VALUES (2,'notice',4,4,'2020-06-12 19:18:10','admin');
/*!40000 ALTER TABLE `g5_board_new` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_cert_history`
--

DROP TABLE IF EXISTS `g5_cert_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_cert_history` (
  `cr_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `cr_company` varchar(255) NOT NULL DEFAULT '',
  `cr_method` varchar(255) NOT NULL DEFAULT '',
  `cr_ip` varchar(255) NOT NULL DEFAULT '',
  `cr_date` date NOT NULL DEFAULT '0000-00-00',
  `cr_time` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`cr_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_cert_history`
--

LOCK TABLES `g5_cert_history` WRITE;
/*!40000 ALTER TABLE `g5_cert_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_cert_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_config`
--

DROP TABLE IF EXISTS `g5_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_config` (
  `cf_title` varchar(255) NOT NULL DEFAULT '',
  `cf_theme` varchar(255) NOT NULL DEFAULT '',
  `cf_admin` varchar(255) NOT NULL DEFAULT '',
  `cf_admin_email` varchar(255) NOT NULL DEFAULT '',
  `cf_admin_email_name` varchar(255) NOT NULL DEFAULT '',
  `cf_add_script` text NOT NULL,
  `cf_use_point` tinyint(4) NOT NULL DEFAULT '0',
  `cf_point_term` int(11) NOT NULL DEFAULT '0',
  `cf_use_copy_log` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_email_certify` tinyint(4) NOT NULL DEFAULT '0',
  `cf_login_point` int(11) NOT NULL DEFAULT '0',
  `cf_cut_name` tinyint(4) NOT NULL DEFAULT '0',
  `cf_nick_modify` int(11) NOT NULL DEFAULT '0',
  `cf_new_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_new_rows` int(11) NOT NULL DEFAULT '0',
  `cf_search_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_connect_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_faq_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_read_point` int(11) NOT NULL DEFAULT '0',
  `cf_write_point` int(11) NOT NULL DEFAULT '0',
  `cf_comment_point` int(11) NOT NULL DEFAULT '0',
  `cf_download_point` int(11) NOT NULL DEFAULT '0',
  `cf_write_pages` int(11) NOT NULL DEFAULT '0',
  `cf_mobile_pages` int(11) NOT NULL DEFAULT '0',
  `cf_link_target` varchar(255) NOT NULL DEFAULT '',
  `cf_delay_sec` int(11) NOT NULL DEFAULT '0',
  `cf_filter` text NOT NULL,
  `cf_possible_ip` text NOT NULL,
  `cf_intercept_ip` text NOT NULL,
  `cf_analytics` text NOT NULL,
  `cf_add_meta` text NOT NULL,
  `cf_syndi_token` varchar(255) NOT NULL,
  `cf_syndi_except` text NOT NULL,
  `cf_member_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_use_homepage` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_homepage` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_tel` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_tel` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_hp` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_hp` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_addr` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_addr` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_signature` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_signature` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_profile` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_profile` tinyint(4) NOT NULL DEFAULT '0',
  `cf_register_level` tinyint(4) NOT NULL DEFAULT '0',
  `cf_register_point` int(11) NOT NULL DEFAULT '0',
  `cf_icon_level` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_recommend` tinyint(4) NOT NULL DEFAULT '0',
  `cf_recommend_point` int(11) NOT NULL DEFAULT '0',
  `cf_leave_day` int(11) NOT NULL DEFAULT '0',
  `cf_search_part` int(11) NOT NULL DEFAULT '0',
  `cf_email_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_group_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_board_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_write` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_comment_all` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_mb_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_mb_member` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_po_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_prohibit_id` text NOT NULL,
  `cf_prohibit_email` text NOT NULL,
  `cf_new_del` int(11) NOT NULL DEFAULT '0',
  `cf_memo_del` int(11) NOT NULL DEFAULT '0',
  `cf_visit_del` int(11) NOT NULL DEFAULT '0',
  `cf_popular_del` int(11) NOT NULL DEFAULT '0',
  `cf_optimize_date` date NOT NULL DEFAULT '0000-00-00',
  `cf_use_member_icon` tinyint(4) NOT NULL DEFAULT '0',
  `cf_member_icon_size` int(11) NOT NULL DEFAULT '0',
  `cf_member_icon_width` int(11) NOT NULL DEFAULT '0',
  `cf_member_icon_height` int(11) NOT NULL DEFAULT '0',
  `cf_member_img_size` int(11) NOT NULL DEFAULT '0',
  `cf_member_img_width` int(11) NOT NULL DEFAULT '0',
  `cf_member_img_height` int(11) NOT NULL DEFAULT '0',
  `cf_login_minutes` int(11) NOT NULL DEFAULT '0',
  `cf_image_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_flash_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_movie_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_formmail_is_member` tinyint(4) NOT NULL DEFAULT '0',
  `cf_page_rows` int(11) NOT NULL DEFAULT '0',
  `cf_mobile_page_rows` int(11) NOT NULL DEFAULT '0',
  `cf_visit` varchar(255) NOT NULL DEFAULT '',
  `cf_max_po_id` int(11) NOT NULL DEFAULT '0',
  `cf_stipulation` text NOT NULL,
  `cf_privacy` text NOT NULL,
  `cf_open_modify` int(11) NOT NULL DEFAULT '0',
  `cf_memo_send_point` int(11) NOT NULL DEFAULT '0',
  `cf_mobile_new_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_mobile_search_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_mobile_connect_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_mobile_faq_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_mobile_member_skin` varchar(255) NOT NULL DEFAULT '',
  `cf_captcha_mp3` varchar(255) NOT NULL DEFAULT '',
  `cf_editor` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_cert_ipin` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_hp` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_kcb_cd` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_kcp_cd` varchar(255) NOT NULL DEFAULT '',
  `cf_lg_mid` varchar(255) NOT NULL DEFAULT '',
  `cf_lg_mert_key` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_limit` int(11) NOT NULL DEFAULT '0',
  `cf_cert_req` tinyint(4) NOT NULL DEFAULT '0',
  `cf_sms_use` varchar(255) NOT NULL DEFAULT '',
  `cf_sms_type` varchar(10) NOT NULL DEFAULT '',
  `cf_icode_id` varchar(255) NOT NULL DEFAULT '',
  `cf_icode_pw` varchar(255) NOT NULL DEFAULT '',
  `cf_icode_server_ip` varchar(255) NOT NULL DEFAULT '',
  `cf_icode_server_port` varchar(255) NOT NULL DEFAULT '',
  `cf_googl_shorturl_apikey` varchar(255) NOT NULL DEFAULT '',
  `cf_social_login_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_social_servicelist` varchar(255) NOT NULL DEFAULT '',
  `cf_payco_clientid` varchar(100) NOT NULL DEFAULT '',
  `cf_payco_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_facebook_appid` varchar(255) NOT NULL,
  `cf_facebook_secret` varchar(255) NOT NULL,
  `cf_twitter_key` varchar(255) NOT NULL,
  `cf_twitter_secret` varchar(255) NOT NULL,
  `cf_google_clientid` varchar(100) NOT NULL DEFAULT '',
  `cf_google_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_naver_clientid` varchar(100) NOT NULL DEFAULT '',
  `cf_naver_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_kakao_rest_key` varchar(100) NOT NULL DEFAULT '',
  `cf_kakao_client_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_kakao_js_apikey` varchar(255) NOT NULL,
  `cf_captcha` varchar(100) NOT NULL DEFAULT '',
  `cf_recaptcha_site_key` varchar(100) NOT NULL DEFAULT '',
  `cf_recaptcha_secret_key` varchar(100) NOT NULL DEFAULT '',
  `cf_1_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_2_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_3_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_4_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_5_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_6_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_7_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_8_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_9_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_10_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_1` varchar(255) NOT NULL DEFAULT '',
  `cf_2` varchar(255) NOT NULL DEFAULT '',
  `cf_3` varchar(255) NOT NULL DEFAULT '',
  `cf_4` varchar(255) NOT NULL DEFAULT '',
  `cf_5` varchar(255) NOT NULL DEFAULT '',
  `cf_6` varchar(255) NOT NULL DEFAULT '',
  `cf_7` varchar(255) NOT NULL DEFAULT '',
  `cf_8` varchar(255) NOT NULL DEFAULT '',
  `cf_9` varchar(255) NOT NULL DEFAULT '',
  `cf_10` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_config`
--

LOCK TABLES `g5_config` WRITE;
/*!40000 ALTER TABLE `g5_config` DISABLE KEYS */;
INSERT INTO `g5_config` VALUES ('MINING','sct','admin','admin@minings.pw','MINING','',0,0,1,0,0,0,0,'',15,'','','',0,0,0,0,10,5,'',0,'','','','','','','','theme/basic',0,0,0,0,0,0,0,0,0,0,0,0,5,1000,1,0,0,9999,0,1,0,0,0,0,0,0,0,0,'admin,administrator,관리자,운영자,어드민,주인장,webmaster,웹마스터,sysop,시삽,시샵,manager,매니저,메니저,root,루트,su,guest,방문객','',0,0,180,0,'2020-08-19',0,5000,22,22,50000,60,60,10,'','','',1,50,15,'오늘:40,어제:51,최대:51,전체:125',0,'고객은 웹 사이트에 열거된 모든 정보, 조건을 검토하고 이해하고 수락했음을 확인합니다. \r\n이 계약을 수락함으로써 고객은 본 계약서, 부속서 및 부록에 포함된 조건 및 웹 사이트에 게시된 기타 문서, 정보를 동의하고 취소 불가능하게 수락합니다. \r\n여기에는 개인 정보 취급 방침, 지불 방침, 철회 환불 정책, 행동 강령, 주문 집행 정책 및 자금 세탁 방지 정책. 고객은 웹 사이트에 계정을 등록하고 자금을 입금함으로써 본 계약을 수락합니다. \r\n계약을 수락하고 회사의 최종 승인을 조건으로 고객은 회사와 법적 구속력있는 계약을 체결합니다. \r\n본 계약의 조건은 고객이 증거금을 입금했을 때 고객이 무조건적으로 수락한 것으로 간주됩니다. \r\n회사가 고객의 선급금을 받자 마자 거래 플랫폼에서 고객이 수행한 모든 작업에는 본 계약 및 웹 사이트의 기타 문서, 정보가 적용됩니다. \r\n고객은 이로써 계정 및 웹 사이트를 통하여 제한없이 포함하여 거래 플랫폼에서 수행한 각각의 모든 운영, 활동, 거래, 주문 또는 의사 소통에 의해 통치되고 실행되어야 함을 인정합니다. \r\n본 계약의 조건 및 웹 사이트의 기타 문서, 정보에 따라 계약을 수락함으로써 고객은 이메일 또는 웹 사이트를 통해 본 계약의 수정을 포함하여 정보를 받을 수 있음을 확인합니다. \r\n당사 및 고객은 여기에 포함된 모든 계약 조건, 의무 및 권리를 준수해야합니다.\r\n\r\n\r\n계약 대상\r\n계약의 대상은 계약에 의거하여 회사가 거래 플랫폼을 통해 고객에게 제공하는 서비스입니다. \r\n회사는 본 계약에서 제공하는 모든 거래를 실행 전용으로 수행하며 계정을 관리하거나 고객에게 조언하지 않습니다. \r\n회사는 거래가 고객에게 이익이되지 않는 경우에도 본 계약에 명시된대로 고객이 요청한 거래를 실행할 수 있습니다. \r\n회사는 본 계약 및 웹 사이트의 기타 문서에서 달리 합의하지 않는 한 고객이 거래 상황을 모니터하거나 조언을 하거나, 증거금 전화를 하거나, 고객의 서비스를 종료할 의무가 없습니다. \r\n별도로 합의되지 않는 한, 회사는 거래 플랫폼을 통해 제공되는 견적보다 유리한 견적을 사용하여 고객의 주문을 시행할 의무가 없습니다. \r\n회사가 계약 조건에 따라 제공해야하는 투자 및 부수적 서비스는 아래에 명시되어 있으며, 회사는 본 계약의 조건에 따라 시장 제작자로서의 역량을 제공할 것입니다. \r\n회사는 별도의 계약으로 고객과 회사간에 명시되지 않는 한 투자, 세금 또는 거래 자문을 제공하지 않습니다. \r\n당사의 서비스에는 회사가 귀하의 지시에 따라 행동하고 어떤 거래에 대해서도 귀하에게 조언을 하지 않으며 거래 결정을 모니터링하여 귀하에게 적절한지 또는 귀하가 손실을 피할 수 있는지를 결정하는 정보만 포함됩니다. \r\n자신의 재정, 법률, 세금 및 기타 전문적인 조언을 받아야합니다. \r\n파생 상품 거래는 귀하에게 거래의 기본 도구에 대한 권리, 의결권, 소유권 또는 이권을 부여하지 않습니다. \r\n귀하는 귀하가 납품을 할 자격이 없으며 모든 기본 상품에 대한 소유권이 없음을 이해합니다. 파생 상품은 규제 대상 거래소에서 거래되지 않으며 중앙 정보 센터에서 처리되지 않습니다.\r\n이 교환 및 정보 센터 규칙 및 보호는 적용되지 않습니다. 회사는 단독 재량에 따라 모든 제품에 대해 만료 시간을 부과 할 수 있는 권한을 보유합니다.\r\n\r\n\r\n서비스\r\n고객, 분석, 뉴스 및 마케팅 정보 서비스를 포함하되 이에 국한되지 않는 회사의 거래 플랫폼을 통해 회사가 고객에게 제공하는 서비스. 회사는 고객의 거래 활동, 주문 및 거래의 실행을 용이하게 해야 하지만 고객은 언제든지 고객에게 신뢰 서비스 및 거래 자문 또는 자문 서비스를 제공해서는 안된다는 것을 인정하고 받아들입니다.\r\n회사는 본 계약의 조건 및 실행 전용 기준에 따라 고객의 모든 거래, 운영을 처리해야합니다.\r\n회사는 고객 계정을 관리하거나 고객에게 어떠한 방식으로든 조언하지 않습니다.\r\n회사는 주문, 거래가 고객에게 유익하지 않을 수 있는지 여부와 관계없이 본 계약에 의거 고객이 요청한 주문, 거래를 처리해야합니다. \r\n회사는 본 계약 및 웹 사이트의 기타 문서에서 달리 합의하지 않는 한 고객에게 거래, 주문 상태를 모니터하거나 조언하거나, 고객에게 증거금 전화를하거나, 거래를 종료할 의무가 없습니다.\r\n고객의 미결 위치를 별도로 합의되지 않는 한, 회사는 거래 플랫폼을 통해 제공되는 견적보다 유리한 견적을 사용하여 고객의 주문, 거래를 처리하거나 처리 할 의무가 없습니다.\r\n회사는 계정 및 거래 플랫폼을 통해 고객이 수행한 모든 작업에 대해 재정적으로 책임지지 않습니다. \r\n각각의 고객은 회사 서비스 및 해당 계정의 유일하게 허가된 사용자입니다. \r\n고객은 계정의 사용 및 액세스에 배타적이며 양도가 불가능한 권리가 부여되며 당사자에게 배정된 계좌를 통해 접속 및 거래를 해야합니다. \r\n고객은 그의 보안 정보를 통해 제공되는 모든 주문에 대해 책임을 지며 회사가 이 방식으로 수령한 주문은 고객이 제공한 것으로 간주됩니다. \r\n회사의 고객 계정을 통해 주문이 제출되는 한, 회사는 고객이 제출한 주문을 합리적으로 추측하며 회사는 이 문제에 대해 더 조사 할 의무가 없습니다. \r\n회사는 고객 이외의 제 3 자와 법적 관계를 맺거나 책임을 지지 않습니다. \r\n고객이 제 3자를 대신하여 또는 제 3 자의 이름을 대신하여 행동하는 경우, 회사는 이 사람을 고객으로 받아들이지 않으며, 그 사람이 확인되었는지 여부와 관계없이 이 사람보다 먼저 책임을 지지 않습니다.\r\n고객은 회사가 부과하는 수수료를 포함하되 이에 제한되지 않고 거래 플랫폼, 웹 사이트에 명시된 조건에 따라 거래 옵션을 사용할 수 있습니다.\r\n회사는 적용 가능한 비용을 포함하여 거래 조건에 관한 모든 필요한 정보를 제공해야 합니다. \r\n고객은 거래 플랫폼에 관한 그러한 정보의 제공이 충분하다는 것을 인정하고 수락하고 동의합니다. \r\n고객은 옵션의 사용이 시장 상황에 의존하는 경우 고객에게 큰 위험을 수반한다는 것을 인정하고 수락하고 동의합니다. \r\n고객은 거래에 대한 관련된 모든 위험을 부담한다는 것을 인정하고 수락하고 동의합니다.\r\n\r\n\r\n전자 거래\r\n이 계약을 수락함으로써 고객은 그가 본 계약의 모든 조항과 웹 사이트의 관련 정보를 읽고 이해했음을 인정합니다.\r\n고객은 수령한 모든 주문이 마켓 메이커의 역량으로 거래 상대방인 회사에 의해 수행되어야 함을 인정하고 이해합니다.\r\n회사의 주문 접수는 수락을 의미하지 않으며 수락은 회사의 주문집행으로만 구성됩니다. 회사는 고객의 주문을 신속하고 신속하게 이행해야합니다.\r\n고객은 전자적 수단의 기술적 또는 기계적 결함으로 인해 거래 플랫폼을 통해 전송 된 명령의 실수 나 오해의 위험, 지연이나 기타 문제의 위험뿐만 아니라 계정을 사용하거나 액세스하는 권한이 없는 사람이 주문을 할 수 있으며, 고객은 그러한 명령에 따라 행동한 결과로 발생한 손실에 대해 회사 전체를 면책하는 것에 동의합니다.\r\n고객은 거래 플랫폼과 같은 사전 결정된 전자 수단을 사용하여 전송된 명령 이외의 전자 수단으로 회사에 전송된 명령을 기반으로 조치를 취하지 않을 것이며, 회사는 고객에 대한 책임을 지지 않습니다.\r\n고객은 회사가 제공 할 수 있는 제품이나 서비스가 거래 목적으로 항상 사용할 수 있는 것은 아니며 고객이 이러한 제품을 사용할 수 있는지 여부를 결정하는 회사의 절대 재량에 동의합니다.\r\n언제든지 회사는 이 섹션과 관련하여 특정 시점에 제품을 제공하지 않는 것을 포함하되 이에 국한되지 않고 금전적 책임을 지지 않습니다.\r\n고객은 회사가 다음과 같은 경우를 포함하여 어떠한 이유로 든 정당한 이유없이 정당한 재량으로 명령 집행을 거부할 권리를 보유 함을 인정합니다.\r\n명령의 집행이 금융 상품의 시장 가격을 조작하거나 조준하려고하는 경우 (시장 조작)\r\n명령의 집행이 기밀 정보의 학대 착취를 구성하거나 구성하는 경우 (내부자 거래)\r\n해당 명령의 집행이 불법 활동 수익금 합법화에 기여하거나 기여할 수 있는 경우 (돈세탁)\r\n고객이 금융 상품 거래를 충당할 수 있는 자금이 충분하지 않거나 판매를 충당하기에 불충분한 금융 상품이 있는 경우\r\n고객이 본 계약에 따라 회사에 대한 의무를 이행하지 못하는 경우\r\n\r\n\r\n책임 한계\r\n회사는 고객의 컴퓨터 및 회사의 하드웨어, 소프트웨어, 통신 및 시스템의 손상, 오작동 또는 고장으로 인한 거래 사이트의 서버에 대한 무단 액세스 및 장애에 대한 중단없는 서비스, 안전하고 오류가 없는 보증 및 면제를 보증하지 않습니다.\r\n회사의 서비스 제공은 특히 제 3 자에 달려 있으며, 회사는 제 3 자의 행위, 태만에 대해 책임을 지지 않으며 고객 및 제 3 자에게 발생한 손해 및 비용에 대해 책임을 지지 않습니다.\r\n회사는 불가항력이나 회사가 통제할 수 없으며 거래 현장의 접근성에 영향을 미친 경우를 포함하여 고객에게 제기된 어떤 종류의 손해에 대해서도 책임을 지지 않습니다.\r\n어떠한 경우에도 회사 또는 그 대리인이 직접 또는 간접적인 피해에 대한 책임을 지지 않습니다.\r\n\r\n\r\n고객의 권리, 의무 및 보증\r\n회사와 함께 이 계약의 조건에 따라 웹 사이트에서 거래, 운영의 실행을 요청하는 명령을 제출하십시오.\r\n회사가 고객에 대한 클레임이 없고 고객에게 회사에 미결제 채무가 없다면 출금 및 환불을 요청할 수 있습니다.\r\n고객이 회사에 대해 혐의가 있다고 주장하거나 고객과 회사 사이에 분쟁이있는 경우 고객은 관련 불만 사항을 모든 관련 세부 사항과 세부 사항을 포함하여 불만 사항을 회사에 제출할 수 있습니다.\r\n회사는 불만 사항을 접수한 사실을 인정하고 문제에 대한 내부 조사를 시작하며 불만 사항을 접수한 날로부터 3 일 이내에 합리적인 기간 내에 고객에게 응답해야합니다.\r\n고객이 회사에 대해 채무가 없다는 조건하에 일방적으로 본 계약을 해지할 수 있습니다.\r\n자금 입금될 때 계좌가 활성화되어야 함을 인정합니다.\r\n서비스와 계정의 사용과 관련하여 회사가 허용한 사용자 아이디와 암호가 항상 그 사람에 의해서만 사용되며 다른 사람에게 공개되지 않을 것이라는 보증을 합니다\r\n고객이 보안 정보를 통해 제출된 모든 주문에 대해 책임을 져야하며 회사가 이 방식으로 수령한 주문은 고객이 제공한 것으로 간주됩니다.\r\n다른 국가의 다른 IP 주소를 통한 계정 액세스 또는 VPN의 사용을 통한 계정 액세스 및 로그인이 합리적으로 회사에 위반되었다.\r\n거래 전략 및 투자 결정 또는 계좌 및 거래 플랫폼을 통해 수행한 모든 활동이 관련된 모든 위험을 생각하고 해야 함을 전제로 합니다.\r\n회사가 수시로 고객에게 공개하거나 고객에게 제공할 수 있는 회사의 기밀 정보를 공개하지 않기 위해 필요한 모든 조치와 조치를 취해야한다는 보증.\r\n권한이 없는 당사자가 자신의 계정에 무단으로 액세스하고 조작하여 발생하는 재정적 손실 위험을 수용합니다.\r\n회사에 1 개의 계정만 등록해야합니다. 고객이 여러 계정을 소유하고있는 경우, 그러한 여러 계정을 통해 이루어진 거래, 운영 및 결과는 회사의 절대 재량으로 취소될 수 있습니다.\r\n복수 계정은 회사의 절대 재량에 따라 차단될 수 있으며, 그 안에 보관 및 유지되는 자금은 고객에 대한 회사의 재정적 의무로 간주되거나 취급되지 않습니다.\r\n고객의 개인 정보를 공개한 결과로 회사에 제기된 클레임 또는 법적 조치를 회사에 배상하고 해를 입히지 않아야합니다.\r\n서비스 제공은 개방형 네트워크를 통해 전송되는 정보를 포함할 수 있음을 인정합니다. 따라서 정보는 정기적으로 전송되며 국경을 넘어 제어할 필요가 없습니다.\r\n회사는 암호화와 같은 기술을 이용하여 제 3자가 정보를 가로채는 것을 방지하기 위해 합당한 조치를 취하지만 고객의 정보에 대한 제 3 자의 무단 액세스를 피할 수 있는 것은 아닙니다.\r\n고객은 이러한 위험을 인정하고 허가받지 않은 액세스가 의도적으로 이루어지지 않았으며 회사가 이러한 허가되지 않은 액세스를 방지하기 위해 모든 합당한 조치를 취한 것으로 동의합니다.\r\n회사가 모든 거래를 종결할 권리가 있음을 인정하고 동의합니다.\r\n\r\n\r\n면책 및 책임\r\n개인 정보\r\n본 계약의 조건에 동의함으로써 고객은 회사가 자동 통제를 사용하지 않고 회사의 개인 정보를 수집하고 처리하는 것을 취소할 수 없게 동의합니다.\r\n이 계약의 목적을 위한 개인 데이터라는 용어는 고객의 이름, 전화 번호, 금융 계좌, 전자 메일, IP 주소, 고객에 대한 서비스 제공과 관련된 쿠키 및 정보를 의미합니다.\r\n고객은 회사가 요청한대로 정확하고 완전한 개인 데이터(연락처)를 제공해야합니다. \r\n개인 데이터를 수집하고 처리하는 목적은 자금 세탁 방지 규정을 비롯하여 본 계약과 관련하여 모든 목적을 포함하여 적용 가능한 규제 법규 요구 사항을 준수하는 것입니다. \r\n고객은 위에서 설명된 목적을 위해 회사가 해당 정보를 수집, 기록, 체계화, 축적, 저장, 조정(업데이트, 변경), 추출, 사용, 전송(보급, 제공)할 권리가 있음을 인정하고 이에 동의합니다. \r\n익명화, 차단, 삭제, 그러한 개인 데이터의 파기 또는 현행 규제 법규에 따른 다른 행동을 수행할 수 있습니다. \r\n회사는 해당 법률 및 규정에 따라 요구되는 공개를 조건으로 다른 목적으로 개인 정보를 공개하거나 공개할 수 없습니다. \r\n회사는 개인 정보를 처리하는 동안 불법적 인 접근, 파괴, 변경, 차단, 복사, 제공 및 보급뿐만 아니라 기타 불법적인 행위로부터 개인 정보를 보호하기 위해 필요한 합법적, 조직적 및 기술적 조치를 취해야합니다.\r\n\r\n\r\n권리 양도\r\n계약은 고객에게 개인적이며 고객은 본 계약에 따라 자신의 권리 또는 의무를 양도할 수 없습니다. 회사는 언제든지 본 계약에 따른 권리 또는 의무를 제 3 자에게 양도하거나 양도할 수 있습니다. \r\n회사는 고객에게 그러한 양도 사실을 통보해야 합니다.\r\n\r\n\r\n위험성에 대한 경고\r\n고객은 웹 사이트를 통해 전자적으로 사용할 수 있으므로 웹 사이트의 서비스 사용과 관련된 위험에 대한 설명을 읽고, 이해하고 이에 따라 수락한다는 것을 확인합니다. \r\n본 계약을 수락함으로써 고객은 본 계약에 포함된 정보와 당사의 위험 공시에서 발견할 수 있는 다른 금융 상품 또는 서비스의 성격 및 위험에 대한 회사의 일반적인 설명을 읽고 이해했음을 인정합니다. \r\n회사가 제공한 금융 상품의 가치는 증가하거나 감소 할 수 있습니다. 고객은 모든 자금 손실의 위험을 포함하되 거래에 관련된 위험을 완전히 이해하고 있음을 인정합니다.\r\n트레이딩은 귀하에게 거래의 기본 수단에 대한 어떠한 권리도 주지 않습니다. 이것은 단지 명목상의 가치를 나타내기 때문에 어떠한 지분이나 주식을 구입할 권리가 없다는 것을 의미합니다. \r\n고객은 이러한 제품에 대해 필요한 지식과 전문 지식이 없는 경우 거래하지 않아야합니다. \r\n고객은 회사의 웹 사이트에있는 회사의 위험 공시 정보를 읽고 이해했으며 이를 수락했음을 인정합니다. \r\n회사는 웹 사이트의 부정확하거나 잘못된 정보에 의존하여 고객이 (또는 제 3 자에게) 발생할 수 있는 손실에 대해 책임지지 않습니다. \r\n고객은 다른 신뢰할 수 있는 정보원과 비교하여 웹 사이트 및 해당 정보의 정확성 및 신뢰성을 검증해야합니다. \r\n회사는 웹 사이트에서 제공한 정보 또는 웹 사이트에서 사용하는 정보 출처로 인해 발생한 모든 종류의 주장, 비용, 손실 또는 손해에 대해 책임을지지 않습니다. \r\n고객은 거래 계정과 관련하여 제공된 구두 정보가 부분적이고 확인되지 않았음을 승인하고 수락합니다. 고객은 앞서 말한 정보에 의존할 수 있는 유일한 위험과 책임을 지지합니다. \r\n회사는 거래 소프트웨어 또는 기타 형식을 통해 제공된 가격 또는 기타 정보가 정확하거나 현재 시장 상황을 반영하는 어떠한 보증도 제공하지 않습니다.\r\n\r\n거래 주문\r\n거래 및 주문시 추가 확인없이 매수(Buy,Call), 매도(Sell,Put) 버튼을 한 번만 클릭하면 플랫폼에서 거래 작업을 수행할 수 있습니다. \r\n주문을 철회할 수 없으며 정상적인 시장 조건 및 시스템 성능 하에서, 시장 주문은 제출 후 즉시 채워질 것이며 귀하는 구속력있는 거래를 체결하게됩니다. \r\n귀하는 주문과 관련된 모든 위험을 수락하는데 동의합니다. 주문을 제출할 때의 오류, 누락 또는 실수의 위험을 포함하되 이에 국한되지는 않습니다. \r\n귀하 또는 귀하를 대신하여 거래하는 다른 사람에 의한 그러한 오류, 누락 또는 실수로 인해 발생할 수 있는 모든 손실, 비용 및 비용으로부터 회사를 완전히 면제하고 무해한 것으로 간주합니다. \r\n처리시간은 시장 상황은 물론 거래 플랫폼과 회사 서버 간의 통신 품질에 따라 달라질 수 있습니다. 일반적인 시장 상황에서 처리시간은 보통 4 초 이내에서 달라집니다. \r\n보통과 다른 시장 조건에서는 고객 요청, 주문 처리 시간이 그보다 길 수 있습니다. 회사의 서버는 다음과 같은 경우 고객의 요청, 주문을 거절할 수 있습니다.\r\n- 고객의 계좌에 충분한 자금이없는 경우\r\n- 개장되지 않은 시장 상품에 대한 요청을 보내는 경우\r\n- 거래 세션이 시작되기 전에 클라이언트가 요청, 주문을 보내는 경우\r\n- 시장 상황이 불안정하거나 시장 전체, 산업 전반에 심각한 변동이 있는 경우와 같이 시장 상황이 정상과 다른 경우\r\n- 서비스 제공 업체로부터 우리가 데이터를 받지 못하는 경우를 포함하여 잘못된 데이터를 수신받는 경우\r\n- 거래 플랫폼을 사용할 때 브라우저의 탭 하나만 사용할 수 있습니다. 여러 브라우저 또는 한 브라우저의 여러 탭을 사용하는 경우 거래 결과를 수정하거나 취소할 수 있습니다.\r\n- 트레이딩 플랫폼과 트랜잭션 사이의 불안정한 연결의 경우 거래 플랫폼에 도달하지 않을 수 있으므로 그래프는 신뢰할 수 있는 정보 소스로 사용될 수 없습니다. 따라서 회사는 다른 고객 거래가 제출될 때 거래 플랫폼의 그래프에 지정된 동일한 가격으로 거래가 이루어지는 것을 보장하지 않습니다. 거래 포지션의 종결은 거래 종료 시점의 트레이딩 서버의 현재 가격으로 발생합니다.\r\n\r\n\r\nVIP 및 고객 등급별 혜택\r\n회사는 단독 재량에 따라 고객에게 등급별 상태 및 혜택을 설정, 부여할 수 있습니다. \r\n회사는 단독 재량으로 사전 통지없이 고객의 VIP 상태 및 혜택을 취소하고 VIP 고객에게 제공되는 혜택을 제거 또는 변경할 권한이 있습니다. \r\nVIP 지위 및 혜택을 부여받은 고객은 VIP 지위로 인해 제공되는 VIP 지위 또는 혜택의 변경 및 취소와 관련하여 보상을 받을 수 없으며 이에 대한 소송의 원인을 구성하지 않을 것에 동의합니다.\r\n\r\n\r\n불량거래자에 대한 제한 조치\r\np2p거래를 진행함에 있어 판매자에게 입금을 하지 않거나 입금을 완료한 구매자에게 플롯을 전송하지 않은 회원은 패널티를 부여 할수 있습니다.\r\n천재지변이나 부득이한 상황으로 인하여 거래를 진행할수 없었을때에는 합당한 사유서를 제출하여 패널티 부여를 유예 할 수 도 있습니다.\r\n- 패널티를 1회 부여 받은 경우 증거금 잔액을 전액 몰수하며 보유중인 플롯 50%를 회사가 소유권을 가져옵니다.\r\n- 패널티를 2회 부여 받은 경우 증거금 잔액을 전액 몰수하며 보유중인 플롯 100%를 회사가 소유권을 가져옵니다.\r\n\r\n\r\n\r\n출금 및 수수료\r\n증거금은 기본적으로 이용료로써 남은 잔액에 대해 출금하여 주지 않습니다\r\n고객은 조회 시점에 계정에서 사용할 수 있는 금액을 회사에 요구할 권리가 있습니다. 유일한 공식 입금,출금 방법은 회사의 공식 웹 사이트에 표시되는 방법입니다. \r\n고객이 회사의 파트너가 제공하거나 회사의 책임이 아니라면 지불 방법 사용과 관련된 모든 위험을 감수하고 있습니다. \r\n회사는 선택한 지불 시스템으로 인해 발생할 수 있는 금융 거래의 지연 또는 취소에 대해 책임을 지지 않습니다. \r\n고객이 지불 시스템과 관련된 클레임이 있는 경우 지불 시스템의 지원 서비스에 연락하고 클레임을 회사에 알리는 것은 그들의 책임입니다. \r\n회사는 고객이 입금, 출금을 위해 사용할 수 있는 제 3 자 서비스 제공 업체의 활동에 대해 책임을 지지 않습니다. \r\n고객의 자금에 대한 회사의 재정적 책임은 회사의 은행 계좌 또는 회사와 관련된 다른 계좌로 자금이 도착할 때 시작되며 이 사실은 웹 사이트의 지불 방법 페이지에 표시됩니다. \r\n금융 거래 중에 또는 사후에 사기가 나타난 경우, 회사는 거래를 취소하고 고객의 계정을 정지 할 권리를 보유합니다. \r\n고객의 자금에 대한 회사의 책임은 자금이 회사의 은행 계좌 또는 회사와 관련된 다른 계좌에서 나올 때 종료되며 이 사실은 웹 사이트의 지불 방법 페이지에 나타납니다. \r\n금융 거래를 처리 할 때 나타날 수 있는 기술적 인 오류가있는 경우 회사는 해당 거래 및 기타 모든 고객의 금융 활동을 회사 웹 사이트에서 취소할 권리를 보유합니다.\r\n확인된 계좌에서 자금을 인출하려면 고객은 요청서를 제출해야합니다. 고객이 인출 요청을 제출하면, 그러한 요청에는 \"요청\"상태가 지정됩니다. \r\n요청을 처리할 때 \"처리\"상태입니다. \'처리\'상태가 지정되면 요청된 금액이 고객의 계정 잔액에서 인출되고 요청된 금액이 고객 금융계좌로 이체됩니다. \r\n고객은 자신의 계좌에 입금하는 데 사용된 금융계좌로만 자금을 인출할 수 있습니다. \r\n자금을 예금하는 데 사용된 금융계좌로 인출하는 것이 기술적으로 불가능한 경우 고객의 희망에 따라 회사가 지불 방법을 선택해야합니다. \r\n이 경우, 지불 세부 사항은 고객의 개인 정보에 명시된 조건을 충족해야합니다. 고객은 인출 요청을 통해 회사에 제공한 정보에 대해 전적으로 책임이 있습니다.\r\n\r\n회사는 회사가 제공한 서비스와 관련하여 고객으로부터 수수료를 받을 자격이 있습니다. 회사는 비즈니스 소개자, 대행사 또는 기타 제 3 자에게 수수료를 지불할 수 있습니다. \r\n이 수수료는 거래 빈도 또는 기타 매개 변수와 관련이 있습니다. 해당 수수료는 회사 웹 사이트에서 확인할 수 있습니다. 회사는 수시로 수수료를 수정할 권리가 있습니다. \r\n거래 수수료는 고객의 계좌 잔액에서 부과됩니다. 고객의 계좌 잔고가 충분한 자금을 제공하지 못하는 경우 거래 비용은 관련 직위의 손익에서 직접 차감됩니다.\r\n\r\n\r\n계약 기간 및 해지\r\n본 계약은 무기한으로 체결됩니다. 이 계약은 고객이 계약을 수락하고 회사에 선급금을 지불할 때 발효됩니다. 각 당사자는 통지함으로써 언제든지 이 협정을 종료시킬 수 있다. \r\n회사는 고객이 이용할 수 있는 서비스를 제한할 수 있지만 고객이 나머지 잔액을 철회할 수 있도록 액세스 권한이 부여됩니다. \r\n회사는 본 계약을 해지하고 고객의 계정을 차단하고 남아있는 모든 자금을 다음 상황에서 사전 통지없이 즉시 반환할 수 있습니다.\r\n- 고객의 사망 또는 법적 무능력\r\n- 관계 기관에 의한 고객 단절 조치가 취해지면\r\n- 고객이 위반했거나 본 계약상의 의무 또는 조건 중 하나를 위반했다고 믿을 만한 타당한 근거가 있거나 이 계약서의 보증 및 진술을 위반한 경우\r\n- 고객이 거주하는 국가의 시민이 아니라고 믿을 만한 합리적인 근거가있는 경우.\r\n- 이 계약의 이행과 관련하여 사기성 수단을 사용하거나 사용했거나 사기성 계획에 관여.\r\n- 다른 고객 또는 회사를 불법적으로, 부적절하게, 부당하게, 또는 기타 다른 방식으로 불공정한 이득을 얻거나\r\n- 고의, 과실 또는 은닉 및 고객에게 사전에 회사에 공개되지 않은 정보를 부당하게 사용한 경우\r\n- 시장 및 회사의 거래 시스템을 조작, 남용하거나 회사를 속이거나 회사를 속인 의도, 행동을 수행한 경우\r\n- 본 계약에 따른 의무 수행 중 악의적인 행동을 한 경우\r\n- 고객이 유죄를 선고받고 있거나 회사가 해당 고객이 악의적인 행위, 중과실, 사기 또는 사기 수단의 사용에 유죄이거나 이 계약의 이행과 관련하여 사기 계획에 연루되어 있다는 의혹을 가지고 있을 경우\r\n- 고객이 회사의 직원에 대한 언어적 학대에 관한 경고를 받는 경우\r\n- 회사는 확인되지 않은 계정 또는 확인할 수 없는 계정에 대하여 사전 통보없이 즉시 본 계약을 해지 할 수 있습니다.\r\n- 고객이 거래를 통해 거래 및 거래를 수행하는 과정에서 다른 국가 또는 VPN 또는 VPS의 다른 IP 주소를 사용한다고 합리적으로 믿을 만한 징후가 있는 경우\r\n명시된 사유로 본 계약이 종료 된 경우 회사는 견인 책임을 지지 않습니다. 탈퇴 요청은 회사의 재무 부서에서 한 번에 하나씩 처리됩니다. 처리 시간은 3 영업일입니다. \r\n회사는 처리 시간을 늘릴 권리가 있습니다.\r\n\r\n\r\n저작권\r\n웹 사이트의 저작권 및 IP (지적 재산권)는 회사의 재산 또는 회사가 해당 IP를 웹 사이트 및 서비스에서 사용하도록 허가한 제 3 자입니다. \r\n복제, 배포, 복제, 공개 또는 저작권의 보호를 받는 자료의 전부 또는 일부를 제 3 자에게 제공하는 것은 금지되어 있습니다. \r\n회사의 사전 허락을 받은 경우를 제외하고는 저작물의 전부 또는 일부를 변경, 광고, 방송, 전송, 판매, 배포 또는 상업적 사용을 금합니다. \r\n명시적으로 달리 명시하지 않는 한 회사에 전달 된 아이디어, 지식, 기술, 마케팅 계획, 정보, 질문, 답변, 제안, 전자 메일 및 의견 (이하 \"정보\")을 포함하되 이에 국한하지 않는 모든 자료 및 메시지는 고객의 기밀 또는 독점권을 고려합니다. \r\n본 계약에 대한 동의는 고객의 추가 허가없이 고객의 전체 정보 (개인 식별 정보로 지정된 고객의 정보 제외)를 회사의 절대적 재량에 따라 사용할 수 있는 권한으로 간주됩니다. \r\n고객은 고객이 제공한 모든 통지, 메시지 또는 기타 자료가 적절하고 독점적 권리를 포함하여 다른 사람에게 해를 끼치지 않는다고 약속합니다. \r\n고객은 불법 또는 해를 끼치거나 다른 클라이언트에게 방해가되는 내용을 업로드하거나 보내지 말아야하며 회사를 손상시킬 수 있는 행동을 취하는 것을 엄격히 금지합니다.\r\n\r\n\r\n컨텐츠 및 제 3 자의 웹사이트\r\n웹 사이트에는 금융 시장 및 광고와 관련된 일반 정보, 뉴스, 의견, 견적 및 기타 정보가 포함될 수 있습니다. 제휴되지 않은 회사는 일부 정보를 웹 사이트에 제공합니다. \r\n회사는 투자 조사를 제공하지 않습니다. 회사가 발행한 금융 시장과 관련된 모든 뉴스, 의견, 견적 및 기타 정보는 판촉, 마케팅으로만 제공됩니다. \r\n회사는 비 제휴 회사가 제공한 정보, 링크 및 기타 정보를 준비, 편집 또는 홍보하지 않습니다. \r\n회사는 제 3 자 웹 사이트의 컨텐츠 또는 제 3 자 광고의 내용이나 해당 웹 사이트에 대한 후원에 대해 책임을 지지 않습니다. \r\n다른 웹 사이트에 대한 하이퍼 링크는 정보 제공의 목적으로만 제공됩니다. 모든 클라이언트 또는 잠재 고객은 자신의 위험 부담으로 그러한 링크를 사용합니다.\r\n\r\n장외 파생 상품\r\nOTC 자산은 정규 시장에서 거래되는 자산입니다. 자산의 가격은 회사가 접수한 고객의 거래 요청 및 주문에 대한 데이터로 구성됩니다. \r\n고객은 그러한 자산에 대한 거래 요청 및 주문을 함으로써 자산의 본질과 가격 결정 알고리즘을 이해하고 있음을 인정합니다. \r\n고객은 그러한 자산에 대한 거래 요청 및 주문을 함으로써 견적 정보의 유일한 신뢰할 수 있는 출처가 고객의 거래 주문에 대한 주 서버임을 인정합니다.\r\n\r\n\r\n사기\r\n회사가 다음과 같은 경우를 포함하여 계약의 대상과 관련하여 사기적으로 행동한 사실을 고객이 알았거나 주의를 끌기에 합당한 의심이 있는 경우\r\n- 거래 및 클라이언트에 속하지 않은 잔액을 채울 수 있는 다른 방법과 관련된 사기\r\n- 허위 거래 결과에 대한 소프트웨어 사용과 관련된 사기\r\n- 허위 거래 결과에 대한 오류 및 시스템 오류와 관련된 사기\r\n회사는 사전 통지없이 그리고 더 이상의 돈을 인출할 수 없으며, 비 합법적인 절차에서 일방적으로 이 계약을 해지할 자격이 없는 고객의 계정을 차단할 권한이 있습니다.\r\n\r\n','해당 홈페이지에 맞는 개인정보처리방침을 입력합니다.',0,0,'','','','','basic','basic','smarteditor2',0,'','','','','','',2,0,'','','','','211.172.232.124','7295','',0,'','','','','','','','','','','','','','','kcaptcha','','','','','','','','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `g5_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_content`
--

DROP TABLE IF EXISTS `g5_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_content` (
  `co_id` varchar(20) NOT NULL DEFAULT '',
  `co_html` tinyint(4) NOT NULL DEFAULT '0',
  `co_subject` varchar(255) NOT NULL DEFAULT '',
  `co_content` longtext NOT NULL,
  `co_mobile_content` longtext NOT NULL,
  `co_skin` varchar(255) NOT NULL DEFAULT '',
  `co_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `co_tag_filter_use` tinyint(4) NOT NULL DEFAULT '0',
  `co_hit` int(11) NOT NULL DEFAULT '0',
  `co_include_head` varchar(255) NOT NULL,
  `co_include_tail` varchar(255) NOT NULL,
  PRIMARY KEY (`co_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_content`
--

LOCK TABLES `g5_content` WRITE;
/*!40000 ALTER TABLE `g5_content` DISABLE KEYS */;
INSERT INTO `g5_content` VALUES ('company',1,'회사소개','<p align=center><b>회사소개에 대한 내용을 입력하십시오.</b></p>','','','',0,0,'',''),('privacy',1,'개인정보 처리방침','<p align=center><b>개인정보 처리방침에 대한 내용을 입력하십시오.</b></p>','','','',0,0,'',''),('provision',1,'서비스 이용약관','<p align=center><b>서비스 이용약관에 대한 내용을 입력하십시오.</b></p>','','','',0,0,'','');
/*!40000 ALTER TABLE `g5_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_faq`
--

DROP TABLE IF EXISTS `g5_faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_faq` (
  `fa_id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_id` int(11) NOT NULL DEFAULT '0',
  `fa_subject` text NOT NULL,
  `fa_content` text NOT NULL,
  `fa_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fa_id`),
  KEY `fm_id` (`fm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_faq`
--

LOCK TABLES `g5_faq` WRITE;
/*!40000 ALTER TABLE `g5_faq` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_faq_master`
--

DROP TABLE IF EXISTS `g5_faq_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_faq_master` (
  `fm_id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_subject` varchar(255) NOT NULL DEFAULT '',
  `fm_head_html` text NOT NULL,
  `fm_tail_html` text NOT NULL,
  `fm_mobile_head_html` text NOT NULL,
  `fm_mobile_tail_html` text NOT NULL,
  `fm_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_faq_master`
--

LOCK TABLES `g5_faq_master` WRITE;
/*!40000 ALTER TABLE `g5_faq_master` DISABLE KEYS */;
INSERT INTO `g5_faq_master` VALUES (1,'자주하시는 질문','','','','',0);
/*!40000 ALTER TABLE `g5_faq_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_group`
--

DROP TABLE IF EXISTS `g5_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_group` (
  `gr_id` varchar(10) NOT NULL DEFAULT '',
  `gr_subject` varchar(255) NOT NULL DEFAULT '',
  `gr_device` enum('both','pc','mobile') NOT NULL DEFAULT 'both',
  `gr_admin` varchar(255) NOT NULL DEFAULT '',
  `gr_use_access` tinyint(4) NOT NULL DEFAULT '0',
  `gr_order` int(11) NOT NULL DEFAULT '0',
  `gr_1_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_2_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_3_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_4_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_5_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_6_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_7_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_8_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_9_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_10_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_1` varchar(255) NOT NULL DEFAULT '',
  `gr_2` varchar(255) NOT NULL DEFAULT '',
  `gr_3` varchar(255) NOT NULL DEFAULT '',
  `gr_4` varchar(255) NOT NULL DEFAULT '',
  `gr_5` varchar(255) NOT NULL DEFAULT '',
  `gr_6` varchar(255) NOT NULL DEFAULT '',
  `gr_7` varchar(255) NOT NULL DEFAULT '',
  `gr_8` varchar(255) NOT NULL DEFAULT '',
  `gr_9` varchar(255) NOT NULL DEFAULT '',
  `gr_10` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`gr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_group`
--

LOCK TABLES `g5_group` WRITE;
/*!40000 ALTER TABLE `g5_group` DISABLE KEYS */;
INSERT INTO `g5_group` VALUES ('community','커뮤니티','both','',0,0,'','','','','','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `g5_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_group_member`
--

DROP TABLE IF EXISTS `g5_group_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_group_member` (
  `gm_id` int(11) NOT NULL AUTO_INCREMENT,
  `gr_id` varchar(255) NOT NULL DEFAULT '',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `gm_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`gm_id`),
  KEY `gr_id` (`gr_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_group_member`
--

LOCK TABLES `g5_group_member` WRITE;
/*!40000 ALTER TABLE `g5_group_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_group_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_login`
--

DROP TABLE IF EXISTS `g5_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_login` (
  `lo_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `lo_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lo_location` text NOT NULL,
  `lo_url` text NOT NULL,
  PRIMARY KEY (`lo_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_login`
--

LOCK TABLES `g5_login` WRITE;
/*!40000 ALTER TABLE `g5_login` DISABLE KEYS */;
INSERT INTO `g5_login` VALUES ('108.162.215.223','','2020-08-19 21:44:29','LOGIN','/bbs/login.php');
/*!40000 ALTER TABLE `g5_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_mail`
--

DROP TABLE IF EXISTS `g5_mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_mail` (
  `ma_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_subject` varchar(255) NOT NULL DEFAULT '',
  `ma_content` mediumtext NOT NULL,
  `ma_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ma_ip` varchar(255) NOT NULL DEFAULT '',
  `ma_last_option` text NOT NULL,
  PRIMARY KEY (`ma_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_mail`
--

LOCK TABLES `g5_mail` WRITE;
/*!40000 ALTER TABLE `g5_mail` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_mail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_member`
--

DROP TABLE IF EXISTS `g5_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_member` (
  `mb_no` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `mb_password` varchar(255) NOT NULL DEFAULT '',
  `mb_name` varchar(255) NOT NULL DEFAULT '',
  `mb_nick` varchar(255) NOT NULL DEFAULT '',
  `mb_nick_date` date NOT NULL DEFAULT '0000-00-00',
  `mb_email` varchar(255) NOT NULL DEFAULT '',
  `mb_homepage` varchar(255) NOT NULL DEFAULT '',
  `mb_level` tinyint(4) NOT NULL DEFAULT '0',
  `mb_sex` char(1) NOT NULL DEFAULT '',
  `mb_birth` varchar(255) NOT NULL DEFAULT '',
  `mb_tel` varchar(255) NOT NULL DEFAULT '',
  `mb_hp` varchar(255) NOT NULL DEFAULT '',
  `mb_certify` tinyint(4) NOT NULL DEFAULT '0',
  `mb_adult` tinyint(4) NOT NULL DEFAULT '0',
  `mb_dupinfo` varchar(255) NOT NULL DEFAULT '',
  `mb_zip1` char(3) NOT NULL DEFAULT '',
  `mb_zip2` char(3) NOT NULL DEFAULT '',
  `mb_addr1` varchar(255) NOT NULL DEFAULT '',
  `mb_addr2` varchar(255) NOT NULL DEFAULT '',
  `mb_addr3` varchar(255) NOT NULL DEFAULT '',
  `mb_addr_jibeon` varchar(255) NOT NULL DEFAULT '',
  `mb_signature` text NOT NULL,
  `mb_recommend` varchar(255) NOT NULL DEFAULT '',
  `mb_recommend2` varchar(20) DEFAULT NULL,
  `mb_point` int(11) NOT NULL DEFAULT '0',
  `mb_today_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_login_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_leave_date` varchar(8) NOT NULL DEFAULT '',
  `mb_intercept_date` varchar(8) NOT NULL DEFAULT '',
  `mb_email_certify` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_email_certify2` varchar(255) NOT NULL DEFAULT '',
  `mb_memo` text NOT NULL,
  `mb_lost_certify` varchar(255) NOT NULL,
  `mb_mailling` tinyint(4) NOT NULL DEFAULT '0',
  `mb_sms` tinyint(4) NOT NULL DEFAULT '0',
  `mb_open` tinyint(4) NOT NULL DEFAULT '0',
  `mb_open_date` date NOT NULL DEFAULT '0000-00-00',
  `mb_profile` text NOT NULL,
  `mb_memo_call` varchar(255) NOT NULL DEFAULT '',
  `mb_servant_cnt` int(11) NOT NULL,
  `mb_servant_cnt2` int(11) NOT NULL,
  `mb_grade` tinyint(4) NOT NULL,
  `mb_grade_date` datetime DEFAULT NULL,
  `mb_point_free_b` double(30,8) NOT NULL,
  `mb_point_free_e` double(30,8) NOT NULL,
  `mb_point_free_i` double(30,8) NOT NULL,
  `mb_point_free_u` double(30,8) NOT NULL,
  `mb_point_free_s` double NOT NULL,
  `mb_point_stable_b` double NOT NULL,
  `mb_point_stable_e` double(30,8) NOT NULL,
  `mb_point_stable_i` double NOT NULL,
  `mb_point_stable_u` double NOT NULL,
  `mb_point_stable_s` double NOT NULL,
  `mb_point_out_b` double(30,8) NOT NULL,
  `mb_point_out_e` double(30,8) NOT NULL,
  `mb_point_out_i` double(30,8) NOT NULL,
  `mb_point_out_u` double(30,8) NOT NULL,
  `mb_point_out_s` double NOT NULL,
  `mb_plan_b` float(3,1) DEFAULT NULL,
  `mb_plan_m` float(3,1) DEFAULT NULL,
  `mb_plan_t` float(3,1) DEFAULT NULL,
  `mb_plan_s` float(3,1) DEFAULT NULL,
  `mb_wallet_addr` varchar(80) DEFAULT NULL,
  `mb_wallet_addr_b` varchar(80) DEFAULT NULL,
  `mb_wallet_addr_e` varchar(255) NOT NULL,
  `mb_wallet_addr_i` varchar(100) NOT NULL,
  `mb_wallet_addr_u` varchar(100) NOT NULL,
  `mb_wallet_addr_s` varchar(100) NOT NULL,
  `mb_out_addr_e` varchar(300) NOT NULL,
  `mb_deposite_pass` varchar(60) NOT NULL,
  `mb_tree` text,
  `mb_tree2` text,
  `mb_nation` varchar(10) NOT NULL,
  `mb_trade_amtlmt` int(10) NOT NULL,
  `mb_trade_amtenable` int(10) NOT NULL,
  `mb_trade_paytype` varchar(20) NOT NULL DEFAULT 'cash',
  `mb_bank` varchar(100) NOT NULL,
  `mb_bank_num` varchar(100) NOT NULL,
  `mb_bank_user` varchar(100) NOT NULL,
  `mb_active` tinyint(1) NOT NULL,
  `mb_auto_all` tinyint(1) NOT NULL,
  `mb_auto_a` tinyint(1) NOT NULL,
  `mb_auto_b` tinyint(1) NOT NULL,
  `mb_auto_c` tinyint(1) NOT NULL,
  `mb_auto_d` tinyint(1) NOT NULL,
  `mb_auto_e` tinyint(1) NOT NULL,
  `mb_auto_f` tinyint(1) NOT NULL,
  `mb_auto_g` tinyint(1) NOT NULL,
  `mb_auto_h` tinyint(1) NOT NULL,
  `mb_1` varchar(255) NOT NULL DEFAULT 'both',
  `mb_2` varchar(255) NOT NULL DEFAULT '',
  `mb_3` varchar(255) NOT NULL DEFAULT '',
  `mb_4` varchar(255) NOT NULL DEFAULT '',
  `mb_5` varchar(255) NOT NULL DEFAULT '',
  `mb_6` varchar(255) NOT NULL DEFAULT '',
  `mb_7` varchar(255) NOT NULL DEFAULT '',
  `mb_8` varchar(255) NOT NULL DEFAULT '',
  `mb_9` varchar(255) NOT NULL DEFAULT '',
  `mb_10` varchar(255) NOT NULL DEFAULT '',
  `mb_11` varchar(255) NOT NULL DEFAULT '',
  `mb_12` varchar(255) NOT NULL DEFAULT '',
  `mb_13` varchar(255) NOT NULL DEFAULT '',
  `mb_14` varchar(10) NOT NULL DEFAULT '',
  `mb_15` varchar(255) NOT NULL DEFAULT '',
  `mb_trade_put_claim` int(10) NOT NULL COMMENT '클레임 제기 횟수',
  `mb_trade_get_claim` int(10) NOT NULL COMMENT '클레임 받은 횟수',
  `mb_trade_penalty` tinyint(1) NOT NULL COMMENT '패널티 받은 횟수',
  `mb_trade_penalty_date` datetime NOT NULL COMMENT '패널티 받은 일시',
  PRIMARY KEY (`mb_no`),
  UNIQUE KEY `mb_id` (`mb_id`),
  KEY `mb_today_login` (`mb_today_login`),
  KEY `mb_datetime` (`mb_datetime`),
  KEY `mb_14` (`mb_14`)
) ENGINE=MyISAM AUTO_INCREMENT=7730 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_member`
--

LOCK TABLES `g5_member` WRITE;
/*!40000 ALTER TABLE `g5_member` DISABLE KEYS */;
INSERT INTO `g5_member` VALUES (1,'admin','*00A51F3F48415C7D4E8908980D443C29C69B60C9','관리자','관리자','0000-00-00','admin@minings.pw','',10,'','-00-00','','01012341234',0,0,'','','','','','','','','',NULL,0,'2020-08-19 00:28:33','162.158.106.215','2019-07-16 09:40:02','59.28.52.143','','','2019-07-16 09:40:02','','','',1,0,0,'0000-00-00','','',4,3,0,NULL,0.00000000,0.00000000,6055.00000000,0.00000000,0,0,0.00000000,0,0,0,0.00000000,0.00000000,0.00000000,0.00000000,0,0.0,0.0,0.0,0.0,NULL,'','','','0x378a7d205c6ba71ed543b1d9f3f44ba1c3da58e6','','','',NULL,NULL,'82',1000,0,'usdt','농협','123456789','관리자',0,0,0,0,0,0,0,0,0,0,'','','','','','','','','','0','','','2020-07-17 04:02:33','','12345',0,0,0,'0000-00-00 00:00:00'),(7719,'gold','*B4ED24274654A59A9D0C639C4DA9EBA414B887D8','GOLD','GOLD','0000-00-00','','',5,'','-00-00','','01083055465',0,0,'','','','','','','','','admin',NULL,0,'0000-00-00 00:00:00','','2020-08-17 17:41:52','141.101.84.55','','','2020-08-17 17:41:52','','','',1,0,0,'0000-00-00','','',1,0,0,NULL,0.00000000,0.00000000,1000.00000000,0.00000000,0,0,0.00000000,0,0,0,0.00000000,0.00000000,0.00000000,0.00000000,0,0.0,0.0,0.0,0.0,NULL,NULL,'','','','','','','admin',NULL,'82',0,0,'cash','','','',0,0,0,0,0,0,0,0,0,0,'','','','','','','','','','0','','6809812','2020-08-17 17:36:47','','1212',0,0,0,'0000-00-00 00:00:00'),(7720,'star','*B4ED24274654A59A9D0C639C4DA9EBA414B887D8','STAR','STAR','0000-00-00','','',5,'','-00-00','','01052262346',0,0,'','','','','','','','','admin',NULL,0,'0000-00-00 00:00:00','','2020-08-17 18:06:53','141.101.84.55','','','2020-08-17 18:06:53','','','',1,0,0,'0000-00-00','','',0,0,0,NULL,0.00000000,0.00000000,1000.00000000,0.00000000,0,0,0.00000000,0,0,0,0.00000000,0.00000000,0.00000000,0.00000000,0,0.0,0.0,0.0,0.0,NULL,NULL,'','','','','','','admin',NULL,'82',0,0,'cash','','','',0,0,0,0,0,0,0,0,0,0,'','','','','','','','','','0','','6817698','2020-08-17 17:42:12','','1212',0,0,0,'0000-00-00 00:00:00'),(7721,'medi','*B4ED24274654A59A9D0C639C4DA9EBA414B887D8','MEDI','MEDI','0000-00-00','','',5,'','-00-00','','01042202346',0,0,'','','','','','','','','admin',NULL,0,'0000-00-00 00:00:00','','2020-08-17 18:09:34','141.101.84.55','','','2020-08-17 18:09:34','','','',1,0,0,'0000-00-00','','',0,0,0,NULL,0.00000000,0.00000000,1000.00000000,0.00000000,0,0,0.00000000,0,0,0,0.00000000,0.00000000,0.00000000,0.00000000,0,0.0,0.0,0.0,0.0,NULL,NULL,'','','','','','','admin',NULL,'82',0,0,'cash','','','',0,0,0,0,0,0,0,0,0,0,'','','','','','','','','','0','','6817708','2020-08-17 18:08:26','','1212',0,0,0,'0000-00-00 00:00:00'),(7722,'zeit','*A4B6157319038724E3560894F7F932C8886EBFCF','ZEIT','ZEIT','0000-00-00','','',5,'','-00-00','','01086035897',0,0,'','','','','','','','','gold',NULL,0,'0000-00-00 00:00:00','','2020-08-17 18:27:51','141.101.84.55','','','2020-08-17 18:27:51','','','',1,0,0,'0000-00-00','','',1,0,0,NULL,0.00000000,0.00000000,1000.00000000,0.00000000,0,0,0.00000000,0,0,0,0.00000000,0.00000000,0.00000000,0.00000000,0,0.0,0.0,0.0,0.0,NULL,NULL,'','','','','','','admin,gold',NULL,'82',0,0,'cash','','','',0,0,0,0,0,0,0,0,0,0,'','','','','','','','','','0','','6803980','2020-08-17 18:18:58','','1234',0,0,0,'0000-00-00 00:00:00'),(7723,'roland','*A4B6157319038724E3560894F7F932C8886EBFCF','ROLAND','ROLAND','0000-00-00','','',5,'','-00-00','','01086716793',0,0,'','','','','','','','','zeit',NULL,0,'0000-00-00 00:00:00','','2020-08-17 18:45:32','141.101.84.55','','','2020-08-17 18:45:32','','','',1,0,0,'0000-00-00','','',1,0,0,NULL,0.00000000,0.00000000,1000.00000000,0.00000000,0,0,0.00000000,0,0,0,0.00000000,0.00000000,0.00000000,0.00000000,0,0.0,0.0,0.0,0.0,NULL,NULL,'','','','','','','admin,gold,zeit',NULL,'82',0,0,'cash','','','',0,0,0,0,0,0,0,0,0,0,'','','','','','','','','','0','',' 6817737','2020-08-17 18:28:37','','1234',0,0,0,'0000-00-00 00:00:00'),(7724,'lacan','*A4B6157319038724E3560894F7F932C8886EBFCF','LACAN','LACAN','0000-00-00','','',5,'','-00-00','','01084953924',0,0,'','','','','','','','','roland',NULL,0,'0000-00-00 00:00:00','','2020-08-17 19:42:20','141.101.84.55','','','2020-08-17 19:42:20','','','',1,0,0,'0000-00-00','','',0,0,0,NULL,0.00000000,0.00000000,1000.00000000,0.00000000,0,0,0.00000000,0,0,0,0.00000000,0.00000000,0.00000000,0.00000000,0,0.0,0.0,0.0,0.0,NULL,NULL,'','','','','','','admin,gold,zeit,roland',NULL,'82',0,0,'cash','','','',0,0,0,0,0,0,0,0,0,0,'','','','','','','','','','0','','6817760','2020-08-17 19:40:35','','1234',0,0,0,'0000-00-00 00:00:00'),(7725,'2020','*0E98F05C5EE7E467B812C9F40C10AEDE4B48BA71','TT','TT','2020-08-17','','',5,'','','','3322336914',0,0,'','','','','','','','','admin','',0,'2020-08-17 19:47:28','108.162.215.239','2020-08-17 19:47:28','108.162.215.239','','','2020-08-17 19:47:28','','','',0,0,0,'2020-08-17','','',2,0,0,NULL,0.00000000,0.00000000,1000.00000000,0.00000000,0,0,0.00000000,0,0,0,0.00000000,0.00000000,0.00000000,0.00000000,0,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','admin',NULL,'1',0,0,'cash','','','',0,0,0,0,0,0,0,0,0,0,'','','','','','','','','','','','6813617','','','Mask2020M',0,0,0,'0000-00-00 00:00:00'),(7726,'Ohba','*0E98F05C5EE7E467B812C9F40C10AEDE4B48BA71','ㅇㅇ','ㅇㅇ','2020-08-17','','',5,'','','','87592933',0,0,'','','','','','','','','2020','',0,'2020-08-17 20:59:16','162.158.6.147','2020-08-17 20:59:16','162.158.6.147','','','2020-08-17 20:59:16','','','',0,0,0,'2020-08-17','','',1,0,0,NULL,0.00000000,0.00000000,1000.00000000,0.00000000,0,0,0.00000000,0,0,0,0.00000000,0.00000000,0.00000000,0.00000000,0,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','admin,2020',NULL,'855',0,0,'cash','','','',0,0,0,0,0,0,0,0,0,0,'','','','','','','','','','','','6779968','','','Mask2020M',0,0,0,'0000-00-00 00:00:00'),(7727,'gong','*0E98F05C5EE7E467B812C9F40C10AEDE4B48BA71','Gong','Gong','2020-08-17','','',5,'','','','00000000000',0,0,'','','','','','','','','2020','',0,'2020-08-19 00:24:37','162.158.6.147','2020-08-17 21:03:34','172.69.34.103','','','2020-08-17 21:03:34','','','',0,0,0,'2020-08-17','','',0,0,0,NULL,0.00000000,0.00000000,1000.00000000,0.00000000,0,0,0.00000000,0,0,0,0.00000000,0.00000000,0.00000000,0.00000000,0,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','admin,2020',NULL,'86',0,0,'cash','','','',0,0,0,0,0,0,0,0,0,0,'','','','','','','','','','','','6803832','','','Mask2020M',0,0,0,'0000-00-00 00:00:00'),(7728,'lkj1186','*70E5AE20B1611C97437AC9CD12D60E9F188480E1','곰돌','곰돌','2020-08-17','','',5,'','','','01057721186',0,0,'','','','','','','','','ohba','',0,'2020-08-17 21:08:47','172.69.34.123','2020-08-17 21:08:47','172.69.34.123','','','2020-08-17 21:08:47','','','',0,0,0,'2020-08-17','','',1,0,0,NULL,0.00000000,0.00000000,1000.00000000,0.00000000,0,0,0.00000000,0,0,0,0.00000000,0.00000000,0.00000000,0.00000000,0,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','admin,2020,ohba',NULL,'82',0,0,'cash','','','',0,0,0,0,0,0,0,0,0,0,'','','','','','','','','','','','6809140','','','lkj1186@',0,0,0,'0000-00-00 00:00:00'),(7729,'steven','*EC4D1C10A3745A906711C6F8839046022ECD1BB4','steven','steven','2020-08-17','','',5,'','','','01065169700',0,0,'','','','','','','','','lkj1186','',0,'2020-08-17 21:17:29','172.69.33.54','2020-08-17 21:17:29','172.69.33.54','','','2020-08-17 21:17:29','','','',0,0,0,'2020-08-17','','',0,0,0,NULL,0.00000000,0.00000000,1000.00000000,0.00000000,0,0,0.00000000,0,0,0,0.00000000,0.00000000,0.00000000,0.00000000,0,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','admin,2020,ohba,lkj1186',NULL,'82',0,0,'cash','','','',0,0,0,0,0,0,0,0,0,0,'','','','','','','','','','','','2342345','','','openmind@7',0,0,0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `g5_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_member_social_profiles`
--

DROP TABLE IF EXISTS `g5_member_social_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_member_social_profiles` (
  `mp_no` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `provider` varchar(50) NOT NULL DEFAULT '',
  `object_sha` varchar(45) NOT NULL DEFAULT '',
  `identifier` varchar(255) NOT NULL DEFAULT '',
  `profileurl` varchar(255) NOT NULL DEFAULT '',
  `photourl` varchar(255) NOT NULL DEFAULT '',
  `displayname` varchar(150) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `mp_register_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mp_latest_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `mp_no` (`mp_no`),
  KEY `mb_id` (`mb_id`),
  KEY `provider` (`provider`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_member_social_profiles`
--

LOCK TABLES `g5_member_social_profiles` WRITE;
/*!40000 ALTER TABLE `g5_member_social_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_member_social_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_memo`
--

DROP TABLE IF EXISTS `g5_memo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_memo` (
  `me_id` int(11) NOT NULL DEFAULT '0',
  `me_recv_mb_id` varchar(20) NOT NULL DEFAULT '',
  `me_send_mb_id` varchar(20) NOT NULL DEFAULT '',
  `me_send_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `me_read_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `me_memo` text NOT NULL,
  PRIMARY KEY (`me_id`),
  KEY `me_recv_mb_id` (`me_recv_mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_memo`
--

LOCK TABLES `g5_memo` WRITE;
/*!40000 ALTER TABLE `g5_memo` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_memo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_menu`
--

DROP TABLE IF EXISTS `g5_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_menu` (
  `me_id` int(11) NOT NULL AUTO_INCREMENT,
  `me_code` varchar(255) NOT NULL DEFAULT '',
  `me_name` varchar(255) NOT NULL DEFAULT '',
  `me_link` varchar(255) NOT NULL DEFAULT '',
  `me_target` varchar(255) NOT NULL DEFAULT '',
  `me_order` int(11) NOT NULL DEFAULT '0',
  `me_use` tinyint(4) NOT NULL DEFAULT '0',
  `me_mobile_use` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`me_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_menu`
--

LOCK TABLES `g5_menu` WRITE;
/*!40000 ALTER TABLE `g5_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_new_win`
--

DROP TABLE IF EXISTS `g5_new_win`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_new_win` (
  `nw_id` int(11) NOT NULL AUTO_INCREMENT,
  `nw_device` varchar(10) NOT NULL DEFAULT 'both',
  `nw_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nw_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nw_disable_hours` int(11) NOT NULL DEFAULT '0',
  `nw_left` int(11) NOT NULL DEFAULT '0',
  `nw_top` int(11) NOT NULL DEFAULT '0',
  `nw_height` int(11) NOT NULL DEFAULT '0',
  `nw_width` int(11) NOT NULL DEFAULT '0',
  `nw_subject` text NOT NULL,
  `nw_content` text NOT NULL,
  `nw_content_html` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nw_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_new_win`
--

LOCK TABLES `g5_new_win` WRITE;
/*!40000 ALTER TABLE `g5_new_win` DISABLE KEYS */;
INSERT INTO `g5_new_win` VALUES (52,'both','2020-06-27 00:00:00','2020-07-03 23:59:59',24,10,10,500,450,'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest','<p>tesattesttesttesttesttesttesttesttesttesttesttesttest</p>',0);
/*!40000 ALTER TABLE `g5_new_win` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_point`
--

DROP TABLE IF EXISTS `g5_point`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_point` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `po_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `po_content` varchar(255) NOT NULL DEFAULT '',
  `po_point` int(11) NOT NULL DEFAULT '0',
  `po_use_point` int(11) NOT NULL DEFAULT '0',
  `po_expired` tinyint(4) NOT NULL DEFAULT '0',
  `po_expire_date` date NOT NULL DEFAULT '0000-00-00',
  `po_mb_point` int(11) NOT NULL DEFAULT '0',
  `po_rel_table` varchar(20) NOT NULL DEFAULT '',
  `po_rel_id` varchar(20) NOT NULL DEFAULT '',
  `po_rel_action` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`po_id`),
  KEY `index1` (`mb_id`,`po_rel_table`,`po_rel_id`,`po_rel_action`),
  KEY `index2` (`po_expire_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_point`
--

LOCK TABLES `g5_point` WRITE;
/*!40000 ALTER TABLE `g5_point` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_poll`
--

DROP TABLE IF EXISTS `g5_poll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_poll` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_subject` varchar(255) NOT NULL DEFAULT '',
  `po_poll1` varchar(255) NOT NULL DEFAULT '',
  `po_poll2` varchar(255) NOT NULL DEFAULT '',
  `po_poll3` varchar(255) NOT NULL DEFAULT '',
  `po_poll4` varchar(255) NOT NULL DEFAULT '',
  `po_poll5` varchar(255) NOT NULL DEFAULT '',
  `po_poll6` varchar(255) NOT NULL DEFAULT '',
  `po_poll7` varchar(255) NOT NULL DEFAULT '',
  `po_poll8` varchar(255) NOT NULL DEFAULT '',
  `po_poll9` varchar(255) NOT NULL DEFAULT '',
  `po_cnt1` int(11) NOT NULL DEFAULT '0',
  `po_cnt2` int(11) NOT NULL DEFAULT '0',
  `po_cnt3` int(11) NOT NULL DEFAULT '0',
  `po_cnt4` int(11) NOT NULL DEFAULT '0',
  `po_cnt5` int(11) NOT NULL DEFAULT '0',
  `po_cnt6` int(11) NOT NULL DEFAULT '0',
  `po_cnt7` int(11) NOT NULL DEFAULT '0',
  `po_cnt8` int(11) NOT NULL DEFAULT '0',
  `po_cnt9` int(11) NOT NULL DEFAULT '0',
  `po_etc` varchar(255) NOT NULL DEFAULT '',
  `po_level` tinyint(4) NOT NULL DEFAULT '0',
  `po_point` int(11) NOT NULL DEFAULT '0',
  `po_date` date NOT NULL DEFAULT '0000-00-00',
  `po_ips` mediumtext NOT NULL,
  `mb_ids` text NOT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_poll`
--

LOCK TABLES `g5_poll` WRITE;
/*!40000 ALTER TABLE `g5_poll` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_poll` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_poll_etc`
--

DROP TABLE IF EXISTS `g5_poll_etc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_poll_etc` (
  `pc_id` int(11) NOT NULL DEFAULT '0',
  `po_id` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `pc_name` varchar(255) NOT NULL DEFAULT '',
  `pc_idea` varchar(255) NOT NULL DEFAULT '',
  `pc_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`pc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_poll_etc`
--

LOCK TABLES `g5_poll_etc` WRITE;
/*!40000 ALTER TABLE `g5_poll_etc` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_poll_etc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_popular`
--

DROP TABLE IF EXISTS `g5_popular`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_popular` (
  `pp_id` int(11) NOT NULL AUTO_INCREMENT,
  `pp_word` varchar(50) NOT NULL DEFAULT '',
  `pp_date` date NOT NULL DEFAULT '0000-00-00',
  `pp_ip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`pp_id`),
  UNIQUE KEY `index1` (`pp_date`,`pp_word`,`pp_ip`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_popular`
--

LOCK TABLES `g5_popular` WRITE;
/*!40000 ALTER TABLE `g5_popular` DISABLE KEYS */;
INSERT INTO `g5_popular` VALUES (1,'공지사항','2020-07-02','162.158.118.170');
/*!40000 ALTER TABLE `g5_popular` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_qa_config`
--

DROP TABLE IF EXISTS `g5_qa_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_qa_config` (
  `qa_title` varchar(255) NOT NULL DEFAULT '',
  `qa_category` varchar(255) NOT NULL DEFAULT '',
  `qa_skin` varchar(255) NOT NULL DEFAULT '',
  `qa_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `qa_use_email` tinyint(4) NOT NULL DEFAULT '0',
  `qa_req_email` tinyint(4) NOT NULL DEFAULT '0',
  `qa_use_hp` tinyint(4) NOT NULL DEFAULT '0',
  `qa_req_hp` tinyint(4) NOT NULL DEFAULT '0',
  `qa_use_sms` tinyint(4) NOT NULL DEFAULT '0',
  `qa_send_number` varchar(255) NOT NULL DEFAULT '0',
  `qa_admin_hp` varchar(255) NOT NULL DEFAULT '',
  `qa_admin_email` varchar(255) NOT NULL DEFAULT '',
  `qa_use_editor` tinyint(4) NOT NULL DEFAULT '0',
  `qa_subject_len` int(11) NOT NULL DEFAULT '0',
  `qa_mobile_subject_len` int(11) NOT NULL DEFAULT '0',
  `qa_page_rows` int(11) NOT NULL DEFAULT '0',
  `qa_mobile_page_rows` int(11) NOT NULL DEFAULT '0',
  `qa_image_width` int(11) NOT NULL DEFAULT '0',
  `qa_upload_size` int(11) NOT NULL DEFAULT '0',
  `qa_insert_content` text NOT NULL,
  `qa_include_head` varchar(255) NOT NULL DEFAULT '',
  `qa_include_tail` varchar(255) NOT NULL DEFAULT '',
  `qa_content_head` text NOT NULL,
  `qa_content_tail` text NOT NULL,
  `qa_mobile_content_head` text NOT NULL,
  `qa_mobile_content_tail` text NOT NULL,
  `qa_1_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_2_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_3_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_4_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_5_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_1` varchar(255) NOT NULL DEFAULT '',
  `qa_2` varchar(255) NOT NULL DEFAULT '',
  `qa_3` varchar(255) NOT NULL DEFAULT '',
  `qa_4` varchar(255) NOT NULL DEFAULT '',
  `qa_5` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_qa_config`
--

LOCK TABLES `g5_qa_config` WRITE;
/*!40000 ALTER TABLE `g5_qa_config` DISABLE KEYS */;
INSERT INTO `g5_qa_config` VALUES ('1:1문의','회원|포인트','basic','basic',1,0,1,0,0,'0','','',1,60,30,15,15,600,1048576,'','','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `g5_qa_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_qa_content`
--

DROP TABLE IF EXISTS `g5_qa_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_qa_content` (
  `qa_id` int(11) NOT NULL AUTO_INCREMENT,
  `qa_num` int(11) NOT NULL DEFAULT '0',
  `qa_parent` int(11) NOT NULL DEFAULT '0',
  `qa_related` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `qa_name` varchar(255) NOT NULL DEFAULT '',
  `qa_email` varchar(255) NOT NULL DEFAULT '',
  `qa_hp` varchar(255) NOT NULL DEFAULT '',
  `qa_type` tinyint(4) NOT NULL DEFAULT '0',
  `qa_category` varchar(255) NOT NULL DEFAULT '',
  `qa_email_recv` tinyint(4) NOT NULL DEFAULT '0',
  `qa_sms_recv` tinyint(4) NOT NULL DEFAULT '0',
  `qa_html` tinyint(4) NOT NULL DEFAULT '0',
  `qa_subject` varchar(255) NOT NULL DEFAULT '',
  `qa_content` text NOT NULL,
  `qa_status` tinyint(4) NOT NULL DEFAULT '0',
  `qa_file1` varchar(255) NOT NULL DEFAULT '',
  `qa_source1` varchar(255) NOT NULL DEFAULT '',
  `qa_file2` varchar(255) NOT NULL DEFAULT '',
  `qa_source2` varchar(255) NOT NULL DEFAULT '',
  `qa_ip` varchar(255) NOT NULL DEFAULT '',
  `qa_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `qa_1` varchar(255) NOT NULL DEFAULT '',
  `qa_2` varchar(255) NOT NULL DEFAULT '',
  `qa_3` varchar(255) NOT NULL DEFAULT '',
  `qa_4` varchar(255) NOT NULL DEFAULT '',
  `qa_5` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`qa_id`),
  KEY `qa_num_parent` (`qa_num`,`qa_parent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_qa_content`
--

LOCK TABLES `g5_qa_content` WRITE;
/*!40000 ALTER TABLE `g5_qa_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_qa_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_scrap`
--

DROP TABLE IF EXISTS `g5_scrap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_scrap` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` varchar(15) NOT NULL DEFAULT '',
  `ms_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ms_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_scrap`
--

LOCK TABLES `g5_scrap` WRITE;
/*!40000 ALTER TABLE `g5_scrap` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_scrap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_uniqid`
--

DROP TABLE IF EXISTS `g5_uniqid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_uniqid` (
  `uq_id` bigint(20) unsigned NOT NULL,
  `uq_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`uq_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_uniqid`
--

LOCK TABLES `g5_uniqid` WRITE;
/*!40000 ALTER TABLE `g5_uniqid` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_uniqid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_visit`
--

DROP TABLE IF EXISTS `g5_visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_visit` (
  `vi_id` int(11) NOT NULL DEFAULT '0',
  `vi_ip` varchar(255) NOT NULL DEFAULT '',
  `vi_date` date NOT NULL DEFAULT '0000-00-00',
  `vi_time` time NOT NULL DEFAULT '00:00:00',
  `vi_referer` text NOT NULL,
  `vi_agent` varchar(255) NOT NULL DEFAULT '',
  `vi_browser` varchar(255) NOT NULL DEFAULT '',
  `vi_os` varchar(255) NOT NULL DEFAULT '',
  `vi_device` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`vi_id`),
  UNIQUE KEY `index1` (`vi_ip`,`vi_date`),
  KEY `index2` (`vi_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_visit`
--

LOCK TABLES `g5_visit` WRITE;
/*!40000 ALTER TABLE `g5_visit` DISABLE KEYS */;
INSERT INTO `g5_visit` VALUES (1,'141.101.84.55','2020-08-17','17:26:46','https://minings.pw/adm/member_avatar_list.php','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36','','',''),(2,'106.12.117.138','2020-08-17','17:52:32','','Mozilla/5.0 (Windows; U; Windows NT 6.0;en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6)','','',''),(3,'95.214.11.231','2020-08-17','18:14:11','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','','',''),(4,'212.8.247.179','2020-08-17','18:14:12','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','','',''),(5,'162.158.190.119','2020-08-17','18:18:56','https://minings.pw/adm/member_form.php?sst=&sod=&sfl=&stx=&page=0&w=u&mb_id=medi','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36','','',''),(6,'141.101.84.9','2020-08-17','19:34:06','https://minings.pw/adm/member_list_partner.php','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36','','',''),(7,'108.162.215.239','2020-08-17','19:47:27','https://www.minings.pw/bbs/register_form.php','Mozilla/5.0 (Linux; Android 10; SM-N9600) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.89 Mobile Safari/537.36','','',''),(8,'95.215.108.217','2020-08-17','20:01:50','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','','',''),(9,'162.158.118.243','2020-08-17','20:30:48','','Mozilla/5.0 (Linux; Android 9; SM-N950N Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.125 Mobile Safari/537.36','','',''),(10,'162.158.7.194','2020-08-17','20:52:47','','Mozilla/5.0 (Linux; Android 10; SM-N9600) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.89 Mobile Safari/537.36','','',''),(11,'162.158.6.147','2020-08-17','20:59:16','https://www.minings.pw/bbs/register_form.php','Mozilla/5.0 (Linux; Android 10; SM-N9600) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.89 Mobile Safari/537.36','','',''),(12,'141.101.98.109','2020-08-17','21:00:11','','TelegramBot (like TwitterBot)','','',''),(13,'141.101.105.53','2020-08-17','21:00:14','','TelegramBot (like TwitterBot)','','',''),(14,'162.158.202.135','2020-08-17','21:01:00','','TelegramBot (like TwitterBot)','','',''),(15,'162.158.155.247','2020-08-17','21:01:03','','TelegramBot (like TwitterBot)','','',''),(16,'172.69.54.158','2020-08-17','21:01:05','','TelegramBot (like TwitterBot)','','',''),(17,'172.69.34.103','2020-08-17','21:01:44','https://www.minings.pw/for_common/myPage.php','Mozilla/5.0 (Linux; Android 10; SM-N9600) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.89 Mobile Safari/537.36','','',''),(18,'15.185.147.1','2020-08-17','21:01:52','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36','','',''),(19,'172.69.34.123','2020-08-17','21:06:22','','Mozilla/5.0 (Linux; Android 7.0; SM-G920K Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.163 Whale/1.0.0.0 Crosswalk/25.80.14.9 Mobile Safari/537.36 NAVER(inapp; search; 720; 10.25.0)','','',''),(20,'172.69.35.40','2020-08-17','21:09:58','','Mozilla/5.0 (Linux; Android 7.0; SM-G920K Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.125 Mobile Safari/537.36','','',''),(21,'141.101.85.166','2020-08-17','21:11:30','','Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko','','',''),(22,'162.158.190.135','2020-08-17','21:13:44','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(23,'141.101.85.4','2020-08-17','21:14:16','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(24,'162.158.202.177','2020-08-17','21:15:24','','TelegramBot (like TwitterBot)','','',''),(25,'172.69.33.54','2020-08-17','21:15:32','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36','','',''),(26,'162.158.190.133','2020-08-17','21:16:02','','Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko','','',''),(27,'162.158.7.200','2020-08-17','21:19:44','','Mozilla/5.0 (Linux; Android 7.0; SM-G920K Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.125 Mobile Safari/537.36','','',''),(28,'162.158.7.156','2020-08-17','21:22:51','','Mozilla/5.0 (Linux; Android 7.0; SM-G920K Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.125 Mobile Safari/537.36','','',''),(29,'162.158.7.58','2020-08-17','21:26:04','https://www.minings.pw/','Mozilla/5.0 (Linux; Android 10; SM-N9600) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.89 Mobile Safari/537.36','','',''),(30,'162.158.202.175','2020-08-17','21:26:45','','TelegramBot (like TwitterBot)','','',''),(31,'162.158.190.95','2020-08-17','21:27:22','','Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko','','',''),(32,'128.14.134.134','2020-08-17','21:28:57','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36','','',''),(33,'162.158.107.166','2020-08-17','22:08:50','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36','','',''),(34,'24.139.90.226','2020-08-17','22:20:42','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/601.7.7 (KHTML, like Gecko) Version/9.1.2 Safari/601.7.7','','',''),(35,'95.214.11.231','2020-08-18','00:08:12','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','','',''),(36,'121.122.165.206','2020-08-18','00:53:11','','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36','','',''),(37,'185.38.208.85','2020-08-18','01:07:32','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36','','',''),(38,'95.215.108.217','2020-08-18','01:08:01','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','','',''),(39,'212.8.247.179','2020-08-18','01:08:03','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','','',''),(40,'71.6.146.185','2020-08-18','01:54:43','','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36','','',''),(41,'34.76.17.151','2020-08-18','01:54:55','','python-requests/2.24.0','','',''),(42,'141.101.84.55','2020-08-18','02:03:15','https://minings.pw/adm/coin_admin/recommender_list.php','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36','','',''),(43,'89.187.174.158','2020-08-18','03:28:53','','Mozilla/5.0 (Windows NT 10.0; WOW64; rv:69.2.1) Gecko/20100101 Firefox/69.2','','',''),(44,'128.14.136.18','2020-08-18','03:34:32','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36','','',''),(45,'211.159.164.170','2020-08-18','03:50:43','','Mozilla/5.0 (Windows; U; Windows NT 6.0;en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6)','','',''),(46,'103.217.154.16','2020-08-18','04:22:51','','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36','','',''),(47,'172.104.108.109','2020-08-18','04:56:07','','Mozilla/5.0','','',''),(48,'102.165.30.25','2020-08-18','06:06:25','','NetSystemsResearch studies the availability of various services across the internet. Our website is netsystemsresearch.com','','',''),(49,'83.97.20.31','2020-08-18','06:45:41','','','','',''),(50,'177.67.8.37','2020-08-18','06:59:52','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36','','',''),(51,'209.17.97.50','2020-08-18','07:26:12','','Mozilla/5.0 (compatible; Nimbostratus-Bot/v1.3.2; http://cloudsystemnetworks.com)','','',''),(52,'128.14.209.242','2020-08-18','07:59:42','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36','','',''),(53,'209.17.97.74','2020-08-18','08:36:56','','Mozilla/5.0 (compatible; Nimbostratus-Bot/v1.3.2; http://cloudsystemnetworks.com)','','',''),(54,'177.223.58.33','2020-08-18','08:55:46','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36','','',''),(55,'192.35.168.200','2020-08-18','09:06:21','','','','',''),(56,'172.69.34.233','2020-08-18','09:35:34','','Mozilla/5.0 (Linux; Android 8.0.0; SM-N950N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Mobile Safari/537.36','','',''),(57,'37.194.223.167','2020-08-18','10:20:33','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36','','',''),(58,'177.200.90.94','2020-08-18','10:22:03','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36','','',''),(59,'162.158.7.200','2020-08-18','10:33:39','','Mozilla/5.0 (Linux; Android 8.0.0; SM-N950N Build/R16NW; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.125 Mobile Safari/537.36','','',''),(60,'185.75.204.137','2020-08-18','11:47:18','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36','','',''),(61,'5.1.51.193','2020-08-18','12:13:45','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36','','',''),(62,'185.131.109.14','2020-08-18','13:17:59','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/601.7.7 (KHTML, like Gecko) Version/9.1.2 Safari/601.7.7','','',''),(63,'181.115.239.186','2020-08-18','14:16:57','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36','','',''),(64,'195.54.160.21','2020-08-18','14:34:15','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','','',''),(65,'162.158.190.105','2020-08-18','15:52:30','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(66,'45.146.242.78','2020-08-18','16:01:38','','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36','','',''),(67,'162.158.7.162','2020-08-18','16:18:08','','Mozilla/5.0 (Linux; Android 8.0.0; SM-N950N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Mobile Safari/537.36','','',''),(68,'2.237.1.144','2020-08-18','17:39:39','','','','',''),(69,'172.69.35.40','2020-08-18','17:46:34','','Mozilla/5.0 (Linux; Android 10; SM-N976N Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.163 Whale/1.0.0.0 Crosswalk/25.80.14.7 Mobile Safari/537.36 NAVER(inapp; search; 710; 10.23.5)','','',''),(70,'108.162.245.161','2020-08-18','17:47:00','','Mozilla/5.0 (Linux; Android 10; SM-N976N Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.163 Whale/1.0.0.0 Crosswalk/25.80.14.7 Mobile Safari/537.36 NAVER(inapp; search; 710; 10.23.5)','','',''),(71,'162.158.107.196','2020-08-18','17:47:08','','Mozilla/5.0 (Linux; Android 10; SM-N976N Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.163 Whale/1.0.0.0 Crosswalk/25.80.14.7 Mobile Safari/537.36 NAVER(inapp; search; 710; 10.23.5)','','',''),(72,'185.39.11.105','2020-08-18','17:49:14','','Go-http-client/1.1','','',''),(73,'139.162.106.181','2020-08-18','17:54:04','','HTTP Banner Detection (https://security.ipip.net)','','',''),(74,'125.163.216.172','2020-08-18','18:10:14','','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36','','',''),(75,'122.200.22.115','2020-08-18','18:18:06','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36','','',''),(76,'80.82.78.85','2020-08-18','18:21:17','','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:76.0) Gecko/20100101 Firefox/76.0','','',''),(77,'162.158.119.52','2020-08-18','18:40:15','','Mozilla/5.0 (Linux; Android 9; SM-N950N Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.125 Mobile Safari/537.36','','',''),(78,'162.158.119.130','2020-08-18','18:43:01','','Mozilla/5.0 (Linux; Android 9; SM-N950N Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.125 Mobile Safari/537.36','','',''),(79,'162.158.7.166','2020-08-18','21:10:49','','Mozilla/5.0 (Linux; Android 9; SM-G955N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Mobile Safari/537.36','','',''),(80,'138.122.20.75','2020-08-18','21:45:43','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36','','',''),(81,'185.142.236.43','2020-08-18','22:29:34','','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36','','',''),(82,'178.73.215.171','2020-08-18','23:33:44','','','','',''),(83,'91.227.191.62','2020-08-18','23:46:02','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36','','',''),(84,'23.90.145.42','2020-08-18','23:47:09','','','','',''),(85,'58.208.45.92','2020-08-18','23:48:25','','Mozilla/4.0 (compatible; Win32; WinHttp.WinHttpRequest.5)','','',''),(86,'162.158.6.147','2020-08-19','00:24:00','','Mozilla/5.0 (Linux; Android 10; SM-N9600 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.89 Mobile Safari/537.36','','',''),(87,'162.158.106.215','2020-08-19','00:28:22','','Mozilla/5.0 (Linux; Android 10; SM-G977N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.162 Mobile Safari/537.36','','',''),(88,'193.118.53.194','2020-08-19','00:53:26','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36','','',''),(89,'80.82.78.85','2020-08-19','01:09:46','','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:76.0) Gecko/20100101 Firefox/76.0','','',''),(90,'95.215.108.217','2020-08-19','01:17:45','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','','',''),(91,'95.214.11.231','2020-08-19','01:17:46','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','','',''),(92,'125.163.216.172','2020-08-19','01:26:57','','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36','','',''),(93,'185.173.35.9','2020-08-19','01:40:54','','NetSystemsResearch studies the availability of various services across the internet. Our website is netsystemsresearch.com','','',''),(94,'142.93.104.240','2020-08-19','02:11:01','','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36','','',''),(95,'212.8.247.179','2020-08-19','02:23:37','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','','',''),(96,'102.165.30.37','2020-08-19','02:55:32','','NetSystemsResearch studies the availability of various services across the internet. Our website is netsystemsresearch.com','','',''),(97,'193.118.53.218','2020-08-19','03:12:43','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36','','',''),(98,'83.97.20.130','2020-08-19','04:37:52','','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:76.0) Gecko/20100101 Firefox/76.0','','',''),(99,'200.58.178.162','2020-08-19','05:46:01','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36','','',''),(100,'149.0.64.67','2020-08-19','07:37:27','','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36','','',''),(101,'141.101.84.55','2020-08-19','08:32:08','','facebookexternalhit/1.1; kakaotalk-scrap/1.0; +https://devtalk.kakao.com/t/scrap/33984','','',''),(102,'209.17.96.186','2020-08-19','08:59:53','','Mozilla/5.0 (compatible; Nimbostratus-Bot/v1.3.2; http://cloudsystemnetworks.com)','','',''),(103,'188.119.54.9','2020-08-19','08:59:55','','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36','','',''),(104,'201.159.155.172','2020-08-19','10:36:34','','','','',''),(105,'200.105.240.202','2020-08-19','11:38:09','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/601.7.7 (KHTML, like Gecko) Version/9.1.2 Safari/601.7.7','','',''),(106,'192.35.168.128','2020-08-19','11:39:24','','Mozilla/5.0 zgrab/0.x','','',''),(107,'172.69.34.209','2020-08-19','12:28:57','','Mozilla/5.0 (Linux; Android 10; SM-A908N Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.96 Mobile Safari/537.36;KAKAOTALK 1908930','','',''),(108,'172.69.33.164','2020-08-19','12:30:06','','Mozilla/5.0 (Linux; Android 10; SM-A908N Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.96 Mobile Safari/537.36;KAKAOTALK 1908930','','',''),(109,'195.54.160.21','2020-08-19','12:40:06','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','','',''),(110,'2.57.122.167','2020-08-19','12:48:56','','','','',''),(111,'209.17.96.98','2020-08-19','13:01:57','','Mozilla/5.0 (compatible; Nimbostratus-Bot/v1.3.2; http://cloudsystemnetworks.com)','','',''),(112,'162.158.7.88','2020-08-19','13:11:32','','Mozilla/5.0 (Linux; Android 8.0.0; SM-N950N Build/R16NW; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.125 Mobile Safari/537.36','','',''),(113,'83.97.20.31','2020-08-19','14:40:54','','','','',''),(114,'212.69.18.21','2020-08-19','14:42:15','','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/601.7.7 (KHTML, like Gecko) Version/9.1.2 Safari/601.7.7','','',''),(115,'128.14.134.170','2020-08-19','14:49:54','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36','','',''),(116,'44.224.22.196','2020-08-19','15:44:49','','AWS Security Scanner','','',''),(117,'92.118.160.33','2020-08-19','15:54:57','','NetSystemsResearch studies the availability of various services across the internet. Our website is netsystemsresearch.com','','',''),(118,'180.149.125.163','2020-08-19','16:20:03','','Mozilla/5.0 (Windows NT 5.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36','','',''),(119,'172.104.247.137','2020-08-19','16:32:57','','','','',''),(120,'176.58.105.46','2020-08-19','16:33:19','','','','',''),(121,'49.232.64.97','2020-08-19','17:04:18','','Mozilla/5.0 (Windows; U; Windows NT 6.0;en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6)','','',''),(122,'106.53.88.252','2020-08-19','17:34:43','','Mozilla/5.0 (Windows; U; Windows NT 6.0;en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6)','','',''),(123,'162.158.118.243','2020-08-19','20:14:38','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36','','',''),(124,'162.158.119.230','2020-08-19','20:21:11','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36','','',''),(125,'108.162.215.223','2020-08-19','21:44:29','','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36','','','');
/*!40000 ALTER TABLE `g5_visit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_visit_sum`
--

DROP TABLE IF EXISTS `g5_visit_sum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_visit_sum` (
  `vs_date` date NOT NULL DEFAULT '0000-00-00',
  `vs_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vs_date`),
  KEY `index1` (`vs_count`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_visit_sum`
--

LOCK TABLES `g5_visit_sum` WRITE;
/*!40000 ALTER TABLE `g5_visit_sum` DISABLE KEYS */;
INSERT INTO `g5_visit_sum` VALUES ('2020-08-17',34),('2020-08-18',51),('2020-08-19',40);
/*!40000 ALTER TABLE `g5_visit_sum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_write_notice`
--

DROP TABLE IF EXISTS `g5_write_notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_write_notice` (
  `wr_id` int(11) NOT NULL AUTO_INCREMENT,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_file` tinyint(4) NOT NULL DEFAULT '0',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_facebook_user` varchar(255) NOT NULL,
  `wr_twitter_user` varchar(255) NOT NULL,
  `wr_1` varchar(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL,
  PRIMARY KEY (`wr_id`),
  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_write_notice`
--

LOCK TABLES `g5_write_notice` WRITE;
/*!40000 ALTER TABLE `g5_write_notice` DISABLE KEYS */;
INSERT INTO `g5_write_notice` VALUES (4,-1,'',4,0,0,'','','','d','dfdfdfdfdf','','',0,0,7,0,0,'admin','*06E6CECA10E3336078C6A73B7427A32EFAA23EC9','박춘희','admin@starwars.city','','2020-06-12 19:18:10',0,'2020-06-12 19:18:10','172.69.33.237','','','','','','','','','','','','');
/*!40000 ALTER TABLE `g5_write_notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g5_write_qna`
--

DROP TABLE IF EXISTS `g5_write_qna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g5_write_qna` (
  `wr_id` int(11) NOT NULL AUTO_INCREMENT,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_file` tinyint(4) NOT NULL DEFAULT '0',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_facebook_user` varchar(255) NOT NULL,
  `wr_twitter_user` varchar(255) NOT NULL,
  `wr_1` varchar(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL,
  PRIMARY KEY (`wr_id`),
  KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  KEY `wr_is_comment` (`wr_is_comment`,`wr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g5_write_qna`
--

LOCK TABLES `g5_write_qna` WRITE;
/*!40000 ALTER TABLE `g5_write_qna` DISABLE KEYS */;
/*!40000 ALTER TABLE `g5_write_qna` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-19 21:52:41
