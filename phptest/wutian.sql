-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: localhost    Database: wutian
-- ------------------------------------------------------
-- Server version	5.6.24-log

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `CategoryId` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(100) NOT NULL,
  `ParentId` int(11) NOT NULL,
  `DeptList` varchar(255) DEFAULT 'All',
  `FilePath` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '1',
  `PAList` varchar(255) DEFAULT 'All',
  `ProductList` varchar(255) DEFAULT 'All',
  `CreatedUser` int(11) DEFAULT NULL,
  `CreatedTime` datetime DEFAULT NULL,
  `EditUser` int(11) DEFAULT NULL,
  `EditTime` datetime DEFAULT NULL,
  PRIMARY KEY (`CategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'总分类',0,'All','d:\\\\tmp\\\\file\\\\',1,'All','All',1,'2015-05-20 14:56:32',1,'2015-05-20 14:56:36'),(2,'分类1',1,'All','d:\\tmp\\file\\',1,',PAL3,',',PL3,',1,'2015-05-20 15:14:10',1,'2015-05-20 15:14:10');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `depts`
--

DROP TABLE IF EXISTS `depts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `depts` (
  `DeptId` int(11) NOT NULL AUTO_INCREMENT,
  `DeptName` varchar(100) NOT NULL,
  `DeptCode` varchar(20) DEFAULT NULL,
  `ParentId` int(11) NOT NULL DEFAULT '0',
  `Status` int(11) NOT NULL DEFAULT '0',
  `PAList` varchar(255) NOT NULL DEFAULT 'All',
  `ProductList` varchar(255) NOT NULL DEFAULT 'All',
  `CreatedUser` int(11) DEFAULT NULL,
  `CreatedTime` datetime DEFAULT NULL,
  `EditUser` int(11) DEFAULT NULL,
  `EditTime` datetime DEFAULT NULL,
  PRIMARY KEY (`DeptId`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `depts`
--

LOCK TABLES `depts` WRITE;
/*!40000 ALTER TABLE `depts` DISABLE KEYS */;
INSERT INTO `depts` VALUES (1,'总公司','HQ',0,1,'ALL','ALL',1,'2015-01-01 00:00:00',1,'2015-01-01 00:00:00'),(2,'北京分公司','Beijing',1,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(3,'上海分公司','Shanghai',1,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(4,'广州分公司','Guangzhou',1,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(5,'北京销售1','BJ_sales_1',2,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(6,'北京销售2','BJ_sales_2',2,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(7,'北京销售3','BJ_sales_3',2,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(8,'上海销售1','SH_sales_1',3,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(9,'上海销售2','SH_sales_2',3,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(10,'上海销售3','SH_sales_3',3,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(11,'广州销售1','GZ_sales_1',4,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(12,'广州销售2','GZ_sales_2',4,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(13,'广州销售3','GZ_sales_3',4,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(14,'总公司','HQ',0,1,'ALL','ALL',1,'2015-01-01 00:00:00',1,'2015-01-01 00:00:00'),(15,'北京分公司','Beijing',1,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(16,'上海分公司','Shanghai',1,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(17,'广州分公司','Guangzhou',1,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(18,'北京销售1','BJ_sales_1',2,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(19,'北京销售2','BJ_sales_2',2,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(20,'北京销售3','BJ_sales_3',2,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(21,'上海销售1','SH_sales_1',3,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(22,'上海销售2','SH_sales_2',3,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(23,'上海销售3','SH_sales_3',3,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(24,'广州销售1','GZ_sales_1',4,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(25,'广州销售2','GZ_sales_2',4,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00'),(26,'广州销售3','GZ_sales_3',4,1,'ALL','ALL',1,'2001-01-01 00:00:00',1,'2015-01-01 00:00:00');
/*!40000 ALTER TABLE `depts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `FileId` int(11) NOT NULL AUTO_INCREMENT,
  `FileName` varchar(255) NOT NULL,
  `FileTitle` varchar(255) DEFAULT NULL,
  `FileDesc` varchar(255) DEFAULT NULL,
  `CategeryId` int(11) NOT NULL,
  `FilePath` varchar(255) NOT NULL,
  `SmallGifPath` varchar(255) NOT NULL,
  `PageNo` int(11) NOT NULL,
  `FileType` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `CreatedUser` int(11) DEFAULT NULL,
  `CreatedTime` datetime DEFAULT NULL,
  `EditUser` int(11) DEFAULT NULL,
  `EditTime` datetime DEFAULT NULL,
  PRIMARY KEY (`FileId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `functions`
--

DROP TABLE IF EXISTS `functions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `functions` (
  `FunctionId` int(11) NOT NULL AUTO_INCREMENT,
  `FunctionName` varchar(50) NOT NULL,
  `FunctionType` int(11) NOT NULL DEFAULT '0',
  `CreatedTime` datetime DEFAULT NULL,
  PRIMARY KEY (`FunctionId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `functions`
--

LOCK TABLES `functions` WRITE;
/*!40000 ALTER TABLE `functions` DISABLE KEYS */;
INSERT INTO `functions` VALUES (1,'公告管理',0,'2015-05-21 15:57:45'),(2,'人员管理',0,'2015-05-21 15:57:45'),(3,'部门管理',0,'2015-05-21 15:57:45'),(4,'分类管理',0,'2015-05-21 15:57:45'),(5,'后台权限管理',0,'2015-05-21 17:04:20'), (6,'题目管理',0,'2015-05-21 17:04:20'),(7,'考卷管理',0,'2015-05-21 17:04:20');
INSERT INTO `functions` VALUES (50, '适应症1',1,'2015-05-21 15:57:45'),(51, '适应症2',1,'2015-05-21 15:57:45'),(52, '适应症3',1,'2015-05-21 15:57:45'), (53, '内科',1,'2015-05-21 15:57:45');
INSERT INTO `functions` VALUES (60, '产品名称1',2,'2015-05-21 15:57:45'),(61, '产品名称2',2,'2015-05-21 15:57:45'),(62, '产品名称3',2,'2015-05-21 15:57:45'), (63, '艾可拓',2,'2015-05-21 15:57:45'), (64, '倍欣',2,'2015-05-21 15:57:45');
INSERT INTO `functions` VALUES (70, '其他',3,'2015-05-21 15:57:45'), (71, '产品知识',3,'2015-05-21 15:57:45');
/*!40000 ALTER TABLE `functions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `NewId` int(11) NOT NULL AUTO_INCREMENT,
  `NewTitle` varchar(255) NOT NULL,
  `NewMsg` varchar(255) NOT NULL,
  `DeptList` varchar(255) NOT NULL DEFAULT 'All',
  `Status` int(11) NOT NULL DEFAULT '0',
  `CreatedUser` int(11) DEFAULT NULL,
  `CreatedTime` datetime DEFAULT NULL,
  `EditUser` int(11) DEFAULT NULL,
  `EditTime` datetime DEFAULT NULL,
  `OccurTime` datetime DEFAULT NULL,
  PRIMARY KEY (`NewId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `privileges` (
  `PrivilegeId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `FunctionId` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '0',
  `CreatedUser` int(11) DEFAULT NULL,
  `CreatedTime` datetime DEFAULT NULL,
  `EditUser` int(11) DEFAULT NULL,
  `EditTime` datetime DEFAULT NULL,
  PRIMARY KEY (`PrivilegeId`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privileges`
--

LOCK TABLES `privileges` WRITE;
/*!40000 ALTER TABLE `privileges` DISABLE KEYS */;
INSERT INTO `privileges` VALUES (5,2,2,1,1,'2015-05-21 16:01:48',1,'2015-05-21 16:01:48'),(6,2,4,1,1,'2015-05-21 16:01:48',1,'2015-05-21 16:01:48'),(20,1,1,0,1,'2015-05-21 18:22:57',1,'2015-05-21 18:22:57'),(21,1,2,0,1,'2015-05-21 18:22:57',1,'2015-05-21 18:22:57'),(22,1,3,0,1,'2015-05-21 18:22:57',1,'2015-05-21 18:22:57'),(23,1,4,0,1,'2015-05-21 18:22:57',1,'2015-05-21 18:22:57'),(24,1,5,0,1,'2015-05-21 18:22:57',1,'2015-05-21 18:22:57'),(25,1,6,0,1,'2015-05-21 18:22:57',1,'2015-05-21 18:22:57'),(26,1,7,0,1,'2015-05-21 18:22:57',1,'2015-05-21 18:22:57');
/*!40000 ALTER TABLE `privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `DeptId` int(11) DEFAULT '0',
  `Status` int(11) NOT NULL DEFAULT '1',
  `CanApprove` int(11) NOT NULL DEFAULT '0',
  `JobGrade` int(11) DEFAULT NULL,
  `CreatedUser` int(11) DEFAULT NULL,
  `CreatedTime` datetime DEFAULT NULL,
  `EditUser` int(11) DEFAULT NULL,
  `EditTime` datetime DEFAULT NULL,
  `EmployeeId` varchar(20) NOT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `EmployeeId` (`EmployeeId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Phantom','phantom@intF1ocus.com',10,0,1,1,1,'2015-05-19 16:10:44',1,'2015-05-20 19:43:50','1'),(2,'phantom2','phantom@163com',10,0,0,1,1,'2015-05-19 18:38:41',1,'2015-05-20 19:31:45','2'),(3,'姓名1','Email1',8,-1,0,0,1,'2015-05-20 17:55:40',1,'2015-05-20 17:55:40','工号1'),(4,'姓名2','Email2',8,-1,0,0,1,'2015-05-20 17:55:40',1,'2015-05-20 17:55:40','工号2'),(10,'姓名3','Email3',12,1,0,0,1,'2015-05-20 18:01:35',1,'2015-05-20 18:01:35','工号3'),(11,'姓名4','Email4',12,1,0,0,1,'2015-05-20 18:01:35',1,'2015-05-20 18:01:35','工号4'),(12,'Phantom100','phantom100@163.com',6,1,0,1,1,'2015-05-20 18:45:25',1,'2015-05-20 18:48:48','100'),(13,'Phantom101','phantom101@163.com',7,1,0,1,1,'2015-05-20 18:47:50',1,'2015-05-20 18:47:50','101'),(14,'姓名5','Email5@abc.com',18,1,0,1,1,'2015-05-20 19:59:08',1,'2015-05-20 19:59:08','工号5'),(15,'姓名6','Email6@ccc.com',18,1,0,1,1,'2015-05-20 19:59:08',1,'2015-05-20 19:59:08','工号6'),(16,'Phantom3','phantom3@163.com',6,1,0,1,1,'2015-05-21 14:46:46',1,'2015-05-21 14:46:46','p300');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-21 18:45:36

DROP TABLE IF EXISTS `problems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problems` (
  `ProblemId` int(11) NOT NULL AUTO_INCREMENT,
  `ProblemType` int(11),
  `ProblemDesc` varchar(255) NOT NULL,
  `ProblemSelectA` varchar(100),
  `ProblemSelectB` varchar(100),
  `ProblemSelectC` varchar(100),
  `ProblemSelectD` varchar(100),
  `ProblemSelectE` varchar(100),
  `ProblemSelectF` varchar(100),
  `ProblemSelectG` varchar(100),
  `ProblemSelectH` varchar(100),
  `ProblemSelectI` varchar(100),
  `ProblemAnswer` varchar(100),
  `Status` int(11) NOT NULL DEFAULT '0',
  `ProblemCategory` varchar(50) NOT NULL,
  `ProblemLevel` int(11) NOT NULL DEFAULT '1',
  `ProblemMemo` varchar(1000),
  PRIMARY KEY (`ProblemId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `problems` WRITE;
INSERT INTO `problems` (ProblemType,ProblemDesc,ProblemSelectA,ProblemSelectB,ProblemAnswer,Status,ProblemCategory,ProblemLevel,ProblemMemo) VALUES (1,'TestExample','TrueA','TrueB','A',0,',50,,61,,62,',1,'TestMemo');
INSERT INTO `problems` (ProblemType,ProblemDesc,ProblemSelectA, ProblemSelectB, ProblemAnswer,Status,ProblemCategory,ProblemLevel,ProblemMemo) VALUES (2,'ProbSinglessssssssssssssssssssssssssssssssssssssss','this is A','this is B','A',0,',52,,62,,70,',2,'TestMemo');
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;


DROP TABLE IF EXISTS `exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exams` (
  `ExamId` int(11) NOT NULL AUTO_INCREMENT,
  `ExamName` varchar(100) UNIQUE KEY NOT NULL,
  `ExamType` int(11) NOT NULL DEFAULT '0',
  `ExamLocation` int(11) NULL,
  `ExamBegin` Datetime DEFAULT NULL,
  `ExamEnd` Datetime DEFAULT NULL,
  `ExamAnsType` int(11) NOT NULL DEFAULT '2',
  `ExamPassword` varchar(100),
  `Status` int(11) NOT NULL DEFAULT '0',
  `ExamDesc` varchar(255),
  `ExamContent` varchar(255) NOT NULL,
  `ExpireTime` Datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  `CreatedTime` Datetime NOT NULL,
  `EditUser` int(11) NOT NULL,
  `EditTime` Datetime NOT NULL,
  PRIMARY KEY (`ExamId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `exams` WRITE;
/*!40000 ALTER TABLE `exams` DISABLE KEYS */;
INSERT INTO `exams` (ExamId,ExamName,ExamBegin,ExamEnd,ExamPassword, ExamDesc,ExamContent,CreatedUser,CreatedTime,EditUser,EditTime,ExpireTime) VALUES (1,'ExamExample','2015-05-20 19:00:00','2015-05-20 20:00:00','1234','exam description','examcontent',1,'2015-05-20 18:00:00',1,'2015-05-20 18:00:00','2015-05-20 19:00:00');
/*!40000 ALTER TABLE `exams` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;


DROP TABLE IF EXISTS `examroll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examroll` (
  `ExamId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  PRIMARY KEY (`ExamId`, `UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;





