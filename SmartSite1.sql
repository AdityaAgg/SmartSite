/*
SQLyog Ultimate v9.63 
MySQL - 5.5.16-log : Database - SmartSite1
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*CREATE DATABASE /*!32312 IF NOT EXISTS*//*`SmartSite1` /*!40100 DEFAULT CHARACTER SET armscii8 */ /*;

USE `SmartSite1`;

/*Table structure for table `connections` */

DROP TABLE IF EXISTS `connections`;

CREATE TABLE `connections` (
  `ConnectionID` int(11) NOT NULL AUTO_INCREMENT,
  `MainUserID` int(11) NOT NULL,
  `ConnectedUserID` int(11) NOT NULL,
  `ConnectionTypeID` int(11) NOT NULL,
  PRIMARY KEY (`ConnectionID`),
  KEY `ConnectedProfileID` (`ConnectedUserID`),
  KEY `StudentProfileID` (`MainUserID`),
  KEY `ConnectionTypeID` (`ConnectionTypeID`),
  CONSTRAINT `connections_ibfk_3` FOREIGN KEY (`ConnectionTypeID`) REFERENCES `connectiontype` (`ConnectionTypeID`),
  CONSTRAINT `connections_ibfk_4` FOREIGN KEY (`MainUserID`) REFERENCES `users` (`UserID`),
  CONSTRAINT `connections_ibfk_5` FOREIGN KEY (`ConnectedUserID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=armscii8;

/*Data for the table `connections` */

insert  into `connections`(`ConnectionID`,`MainUserID`,`ConnectedUserID`,`ConnectionTypeID`) values (1,1,2,1);

/*Table structure for table `connectiontype` */

DROP TABLE IF EXISTS `connectiontype`;

CREATE TABLE `connectiontype` (
  `ConnectionTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `ConnectionDescription` varchar(255) NOT NULL,
  `ConnectionWay` varchar(255) NOT NULL,
  PRIMARY KEY (`ConnectionTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=armscii8;

/*Data for the table `connectiontype` */

insert  into `connectiontype`(`ConnectionTypeID`,`ConnectionDescription`,`ConnectionWay`) values (1,'Connection','2 way'),(2,'Connection Request','1 way'),(3,'Favorite Connections',''),(4,'Custom Shared To','1 way');

/*Table structure for table `interestcategory` */

DROP TABLE IF EXISTS `interestcategory`;

CREATE TABLE `interestcategory` (
  `InterestCategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `InterestCategoryDesc` varchar(50) NOT NULL,
  PRIMARY KEY (`InterestCategoryID`),
  KEY `InterestCategoryID` (`InterestCategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=armscii8;

/*Data for the table `interestcategory` */

insert  into `interestcategory`(`InterestCategoryID`,`InterestCategoryDesc`) values (1,'Academics'),(2,'Extra Curricular'),(3,'Sports'),(4,'Community Service');

/*Table structure for table `listofactivities` */

DROP TABLE IF EXISTS `listofactivities`;

CREATE TABLE `listofactivities` (
  `ActivityID` int(11) NOT NULL AUTO_INCREMENT,
  `ActivityDesc` varchar(255) NOT NULL,
  `ActivityCategoryID` int(11) NOT NULL,
  PRIMARY KEY (`ActivityID`),
  KEY `ActivityCategoryID` (`ActivityCategoryID`),
  KEY `ActivityCategoryID_2` (`ActivityCategoryID`),
  CONSTRAINT `listofactivities_ibfk_1` FOREIGN KEY (`ActivityCategoryID`) REFERENCES `interestcategory` (`InterestCategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=armscii8;

/*Data for the table `listofactivities` */

insert  into `listofactivities`(`ActivityID`,`ActivityDesc`,`ActivityCategoryID`) values (130,'Test',1),(131,'George Mason University',2),(132,'George Mason University',1),(133,'George Mason University',2),(134,'Harvard Forensics Invitational',2),(135,'GPA',1),(136,'George Mason University of Forensics',2);

/*Table structure for table `listofinterests` */

DROP TABLE IF EXISTS `listofinterests`;

CREATE TABLE `listofinterests` (
  `InterestID` int(11) NOT NULL AUTO_INCREMENT,
  `InterestDesc` varchar(255) NOT NULL COMMENT 'Description',
  `InterestCategoryID` int(11) DEFAULT NULL,
  PRIMARY KEY (`InterestID`),
  KEY `InterestID` (`InterestID`),
  KEY `InterestCategoryID` (`InterestCategoryID`),
  CONSTRAINT `listofinterests_ibfk_1` FOREIGN KEY (`InterestCategoryID`) REFERENCES `interestcategory` (`InterestCategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=638 DEFAULT CHARSET=armscii8;

/*Data for the table `listofinterests` */

insert  into `listofinterests`(`InterestID`,`InterestDesc`,`InterestCategoryID`) values (598,'',1),(599,'Computer Science',NULL),(600,'Business',NULL),(601,'Marketing',NULL),(602,'Animation',NULL),(603,'Design',NULL),(604,'Politics',2),(605,'Speech and Debate',2),(606,'Social Studies',2),(607,'Computer Science',NULL),(608,'Business',NULL),(609,'Marketing',NULL),(610,'Animation',NULL),(611,'Design',NULL),(612,'Politics',1),(613,'Politics',2),(614,'Speech and Debate',2),(615,'Owning Pros',2),(616,'Academics',1),(617,'Undecided',NULL),(618,'',NULL),(619,'',NULL),(620,'',NULL),(621,'',NULL),(622,'Undecided',NULL),(623,'',NULL),(624,'',NULL),(625,'',NULL),(626,'',NULL),(627,'Undecided',NULL),(628,'',NULL),(629,'',NULL),(630,'',NULL),(631,'',NULL),(632,'Computer Science',NULL),(633,'Business',NULL),(634,'Political Science',NULL),(635,'Digital Animation',NULL),(636,'',NULL),(637,'Political Science',2);

/*Table structure for table `postinfo` */

DROP TABLE IF EXISTS `postinfo`;

CREATE TABLE `postinfo` (
  `PostInfoID` int(11) NOT NULL AUTO_INCREMENT,
  `PostDesc` varchar(500) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `Promotions` int(11) NOT NULL,
  `TimeFrame` date DEFAULT NULL,
  `ProfileID` int(11) NOT NULL,
  `ProfileLevelID` int(11) NOT NULL,
  `File` varchar(255) DEFAULT NULL,
  `LastEdited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PostInfoID`),
  KEY `CategoryID` (`CategoryID`),
  KEY `ProfileID` (`ProfileID`),
  KEY `ProfileLevelID` (`ProfileLevelID`),
  CONSTRAINT `postinfo_ibfk_2` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ProfileID`),
  CONSTRAINT `postinfo_ibfk_3` FOREIGN KEY (`CategoryID`) REFERENCES `interestcategory` (`InterestCategoryID`),
  CONSTRAINT `postinfo_ibfk_4` FOREIGN KEY (`ProfileLevelID`) REFERENCES `profilelevels` (`ProfileLevelID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=armscii8;

/*Data for the table `postinfo` */

insert  into `postinfo`(`PostInfoID`,`PostDesc`,`CategoryID`,`Promotions`,`TimeFrame`,`ProfileID`,`ProfileLevelID`,`File`,`LastEdited`) values (1,'Speech and Debate Program for four weeks.',2,0,NULL,1,1,NULL,'2014-03-24 22:14:15');

/*Table structure for table `privacytable` */

DROP TABLE IF EXISTS `privacytable`;

CREATE TABLE `privacytable` (
  `PrivacyID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `FirstName` int(11) NOT NULL,
  `LastName` int(11) NOT NULL,
  `ProfilePic` int(11) NOT NULL,
  `DOB` int(11) NOT NULL,
  `Gender` int(11) NOT NULL,
  `School` int(11) NOT NULL,
  `CreatedDate` int(11) NOT NULL,
  `Grade` int(11) NOT NULL,
  `Background` int(11) NOT NULL,
  PRIMARY KEY (`PrivacyID`),
  KEY `UserID` (`UserID`),
  KEY `LastName` (`LastName`),
  KEY `FirstName` (`FirstName`),
  KEY `ProfilePic` (`ProfilePic`),
  KEY `DOB` (`DOB`),
  KEY `Gender` (`Gender`),
  KEY `School` (`School`),
  KEY `CreatedDate` (`CreatedDate`),
  KEY `Grade` (`Grade`),
  KEY `Background` (`Background`),
  CONSTRAINT `privacytable_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  CONSTRAINT `privacytable_ibfk_10` FOREIGN KEY (`Background`) REFERENCES `profilelevels` (`ProfileLevelID`),
  CONSTRAINT `privacytable_ibfk_2` FOREIGN KEY (`FirstName`) REFERENCES `profilelevels` (`ProfileLevelID`),
  CONSTRAINT `privacytable_ibfk_3` FOREIGN KEY (`LastName`) REFERENCES `profilelevels` (`ProfileLevelID`),
  CONSTRAINT `privacytable_ibfk_4` FOREIGN KEY (`ProfilePic`) REFERENCES `profilelevels` (`ProfileLevelID`),
  CONSTRAINT `privacytable_ibfk_5` FOREIGN KEY (`DOB`) REFERENCES `profilelevels` (`ProfileLevelID`),
  CONSTRAINT `privacytable_ibfk_6` FOREIGN KEY (`Gender`) REFERENCES `profilelevels` (`ProfileLevelID`),
  CONSTRAINT `privacytable_ibfk_7` FOREIGN KEY (`School`) REFERENCES `profilelevels` (`ProfileLevelID`),
  CONSTRAINT `privacytable_ibfk_8` FOREIGN KEY (`CreatedDate`) REFERENCES `profilelevels` (`ProfileLevelID`),
  CONSTRAINT `privacytable_ibfk_9` FOREIGN KEY (`Grade`) REFERENCES `profilelevels` (`ProfileLevelID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=armscii8;

/*Data for the table `privacytable` */

insert  into `privacytable`(`PrivacyID`,`UserID`,`FirstName`,`LastName`,`ProfilePic`,`DOB`,`Gender`,`School`,`CreatedDate`,`Grade`,`Background`) values (1,1,3,3,3,1,3,2,2,2,2),(2,2,3,3,3,1,3,2,2,2,2);

/*Table structure for table `profile` */

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `ProfileID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `ProfilePic` varchar(150) NOT NULL,
  `DOB` date DEFAULT NULL,
  `Gender` int(11) DEFAULT NULL,
  `School` varchar(50) NOT NULL,
  `LastEdited` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Grade` int(11) DEFAULT NULL,
  `Background` text NOT NULL,
  PRIMARY KEY (`ProfileID`),
  KEY `ProfileID` (`ProfileID`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

/*Data for the table `profile` */

insert  into `profile`(`ProfileID`,`UserID`,`FirstName`,`LastName`,`ProfilePic`,`DOB`,`Gender`,`School`,`LastEdited`,`Grade`,`Background`) values (1,1,'Aditya','Aggarwal','//Uploads','1997-08-04',0,'Saratoga High School','2014-03-24 22:12:33',11,''),(2,2,'Divya','Agarwal','//Uploads','2001-03-10',0,'Challenger Sunnyvale','2013-05-25 05:32:45',7,'                          Hello, my name is Divya. I have an interest in singing and tennis. I inspire in going to a strong medical school with good mathematics courses. I am well-qualified student with many different achievements.');

/*Table structure for table `profilelevels` */

DROP TABLE IF EXISTS `profilelevels`;

CREATE TABLE `profilelevels` (
  `ProfileLevelID` int(11) NOT NULL AUTO_INCREMENT,
  `ProfileLevelDesc` varchar(255) NOT NULL,
  PRIMARY KEY (`ProfileLevelID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=armscii8;

/*Data for the table `profilelevels` */

insert  into `profilelevels`(`ProfileLevelID`,`ProfileLevelDesc`) values (1,'Private and Custom Shared'),(2,'Connected'),(3,'Public');

/*Table structure for table `profiletypes` */

DROP TABLE IF EXISTS `profiletypes`;

CREATE TABLE `profiletypes` (
  `ProfileTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `ProfileDescType` varchar(255) NOT NULL,
  PRIMARY KEY (`ProfileTypeID`),
  KEY `ProfileTypeID` (`ProfileTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=armscii8;

/*Data for the table `profiletypes` */

insert  into `profiletypes`(`ProfileTypeID`,`ProfileDescType`) values (1,'Student');

/*Table structure for table `recsofstudent` */

DROP TABLE IF EXISTS `recsofstudent`;

CREATE TABLE `recsofstudent` (
  `RecsID` int(11) NOT NULL AUTO_INCREMENT,
  `PostInfoID` int(11) DEFAULT NULL,
  `RecsDesc` text NOT NULL,
  `RecPromotions` int(11) NOT NULL,
  `ProfileLevelID` int(11) NOT NULL,
  `LastEdited` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`RecsID`),
  KEY `ProfileInfoID` (`PostInfoID`),
  KEY `ProfileLevelID` (`ProfileLevelID`),
  CONSTRAINT `recsofstudent_ibfk_1` FOREIGN KEY (`PostInfoID`) REFERENCES `postinfo` (`PostInfoID`),
  CONSTRAINT `recsofstudent_ibfk_2` FOREIGN KEY (`ProfileLevelID`) REFERENCES `profilelevels` (`ProfileLevelID`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

/*Data for the table `recsofstudent` */

/*Table structure for table `studentactivities` */

DROP TABLE IF EXISTS `studentactivities`;

CREATE TABLE `studentactivities` (
  `ActivityIntID` int(11) NOT NULL AUTO_INCREMENT,
  `PostInfoID` int(11) NOT NULL,
  `ActivityID` int(11) NOT NULL,
  PRIMARY KEY (`ActivityIntID`),
  UNIQUE KEY `PostInfoID_2` (`PostInfoID`),
  KEY `ActivityID` (`ActivityID`),
  KEY `PostInfoID` (`PostInfoID`),
  CONSTRAINT `studentactivities_ibfk_1` FOREIGN KEY (`PostInfoID`) REFERENCES `postinfo` (`PostInfoID`),
  CONSTRAINT `studentactivities_ibfk_2` FOREIGN KEY (`ActivityID`) REFERENCES `listofactivities` (`ActivityID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=armscii8;

/*Data for the table `studentactivities` */

insert  into `studentactivities`(`ActivityIntID`,`PostInfoID`,`ActivityID`) values (1,1,136);

/*Table structure for table `studentinterests` */

DROP TABLE IF EXISTS `studentinterests`;

CREATE TABLE `studentinterests` (
  `StudentIntID` int(11) NOT NULL AUTO_INCREMENT,
  `ProfileID` int(11) NOT NULL,
  `InterestID` int(11) NOT NULL,
  `MajorMinor` int(11) DEFAULT NULL,
  `PostInfoID` int(11) DEFAULT NULL,
  PRIMARY KEY (`StudentIntID`),
  UNIQUE KEY `UniqueInterestVal` (`InterestID`,`PostInfoID`),
  KEY `ProfileID` (`ProfileID`),
  KEY `InterestID` (`InterestID`),
  KEY `PostInfoID` (`PostInfoID`),
  CONSTRAINT `studentinterests_ibfk_1` FOREIGN KEY (`ProfileID`) REFERENCES `profile` (`ProfileID`),
  CONSTRAINT `studentinterests_ibfk_2` FOREIGN KEY (`InterestID`) REFERENCES `listofinterests` (`InterestID`),
  CONSTRAINT `studentinterests_ibfk_3` FOREIGN KEY (`PostInfoID`) REFERENCES `postinfo` (`PostInfoID`)
) ENGINE=InnoDB AUTO_INCREMENT=602 DEFAULT CHARSET=armscii8;

/*Data for the table `studentinterests` */

insert  into `studentinterests`(`StudentIntID`,`ProfileID`,`InterestID`,`MajorMinor`,`PostInfoID`) values (566,1,599,NULL,NULL),(567,1,600,NULL,NULL),(568,1,601,NULL,NULL),(569,1,602,NULL,NULL),(570,1,603,NULL,NULL),(574,1,599,NULL,NULL),(575,1,600,NULL,NULL),(576,1,601,NULL,NULL),(577,1,602,NULL,NULL),(578,1,603,NULL,NULL),(581,1,617,NULL,NULL),(582,1,598,NULL,NULL),(583,1,598,NULL,NULL),(584,1,598,NULL,NULL),(585,1,598,NULL,NULL),(586,1,617,NULL,NULL),(587,1,598,NULL,NULL),(588,1,598,NULL,NULL),(589,1,598,NULL,NULL),(590,1,598,NULL,NULL),(591,1,617,NULL,NULL),(592,1,598,NULL,NULL),(593,1,598,NULL,NULL),(594,1,598,NULL,NULL),(595,1,598,NULL,NULL),(596,1,599,0,NULL),(597,1,600,1,NULL),(598,1,634,2,NULL),(599,1,635,2,NULL),(600,1,598,2,NULL),(601,1,634,NULL,1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Password` varchar(20) NOT NULL,
  `ProfileTypeID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Password` (`Password`),
  UNIQUE KEY `Email` (`Email`),
  KEY `ProfileTypeID` (`ProfileTypeID`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ProfileTypeID`) REFERENCES `profiletypes` (`ProfileTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=armscii8;

/*Data for the table `users` */

insert  into `users`(`UserID`,`Password`,`ProfileTypeID`,`Email`) values (1,'aaaa',1,'adityaaggarwalz200@gmail.com'),(2,'bbbb',1,'divya@gmail.com');

/* Procedure structure for procedure `ActivityInputer` */

/*!50003 DROP PROCEDURE IF EXISTS  `ActivityInputer` */;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `ActivityInputer`(In filterer varchar (255))
BEGIN
DROP table IF EXISTS TEMPA;
DROp TABLE IF EXISTS TEMPB;
Create table TEMPA (valsess INT);
CREATE table TEMPB (vals INT);
INSERT INTO TEMPA (SELECT MAX(PostInfoID) From PostInfo);
INSERT INTO TEMPB ( SELECT ActivityID FROM listofactivities WHERE ActivityDesc=filterer);     
SELECT * FROM TEMPA,TEMPB;
    DROP TABLE TEMPA;
    DROP TABLE TEMPB;
    END $$
DELIMITER ;

/* Procedure structure for procedure `BasicGetPostInfo` */

!50003 DROP PROCEDURE IF EXISTS  `BasicGetPostInfo` ;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `BasicGetPostInfo`(IN `prof` INT, IN `cat` INT )
BEGIN
SELECT PostInfo.ProfileID,
ListofActivities.ActivityDesc,
PostInfo.PostDesc, PostInfo.`PostInfoID`,
PostInfo.Promotions, 
PostInfo.TimeFrame,PostInfo.LastEdited
FROM PostInfo, ListofActivities,StudentActivities
WHERE StudentActivities.PostInfoID=PostInfo.PostInfoID
AND ListofActivities.ActivityID=StudentActivities.ActivityID
AND PostInfo.ProfileID=prof
AND PostInfo.CategoryID=cat;
    END $$
DELIMITER ;

/* Procedure structure for procedure `BasicGetPostInfoInner` */

!50003 DROP PROCEDURE IF EXISTS  `BasicGetPostInfoInner` ;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `BasicGetPostInfoInner`(IN `prof` INT, IN `cat` INT, IN postIDer INT)
BEGIN
SELECT PostInfo.ProfileID,
ListofActivities.ActivityDesc,
PostInfo.PostDesc, PostInfo.`PostInfoID`,
PostInfo.Promotions, 
PostInfo.TimeFrame,PostInfo.LastEdited
FROM PostInfo, ListofActivities,StudentActivities
WHERE StudentActivities.PostInfoID=PostInfo.PostInfoID
AND ListofActivities.ActivityID=StudentActivities.ActivityID
AND PostInfo.ProfileID=prof
AND PostInfo.CategoryID=cat
AND PostInfo.`PostInfoID`=postIDer;
    END $$
DELIMITER ;

/* Procedure structure for procedure `BasicRecsInfo` */

!50003 DROP PROCEDURE IF EXISTS  `BasicRecsInfo` ;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `BasicRecsInfo`(IN `post` INT)
BEGIN
SELECT RecsofStudent.RecsDesc, recsofstudent.RecPromotions, recsofstudent.`LastEdited`
FROM RecsofStudent
WHERE RecsofStudent.PostInfoID=post;
    END $$
DELIMITER ;

/* Procedure structure for procedure `BasicRecsNumber` */

!50003 DROP PROCEDURE IF EXISTS  `BasicRecsNumber` ;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `BasicRecsNumber`(IN post INT)
BEGIN
    DROP TABLE IF EXISTS TEMPB;
CREATE TABLE TEMPB(RecDesc varchar (255));
INSERT INTO TEMPB(SELECT RecsofStudent.RecsDesc
FROM RecsofStudent
WHERE RecsofStudent.PostInfoID=post
);
Drop Table IF EXISTS TEMPC;
CREATE TABLE TEMPC (RecsCount INT);
INSERT INTO TEMPC (
SELECT COUNT(*) FROM TEMPB
);
SELECT RecsCount FROM TEMPC;
DROP TABLE TEMPB;
DROP TABLE TEMPC;
  
    END $$
DELIMITER ;

/* Procedure structure for procedure `ConnectProfileInfo` */

!50003 DROP PROCEDURE IF EXISTS  `ConnectProfileInfo` ;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `ConnectProfileInfo`(IN `Emailer` VARCHAR(255), IN `Passworder` VARCHAR(255))
BEGIN
DROP TABLE IF EXISTS TEMPB;
DROP TABLE IF EXISTS TEMPC;
CREATE TABLE TEMPB (ProfileID INT, Major VARCHAR (255),MaCategory INT);
INSERT INTO TEMPB (SELECT  StudentInterests.ProfileID,
ListofInterests.InterestDesc, ListofInterests.InterestCategoryID
FROM ListofInterests, StudentInterests,Profile
WHERE ListofInterests.InterestID=StudentInterests.InterestID
AND StudentInterests.MajorMinor='0'
AND Profile.ProfileID=StudentInterests.ProfileID);
CREATE TABLE TEMPC (ProfileID INT, Minor VARCHAR (255),MiCategory INT);
INSERT INTO TEMPC (SELECT  StudentInterests.ProfileID,
ListofInterests.InterestDesc,  ListofInterests.InterestCategoryID
FROM ListofInterests, StudentInterests,Profile
WHERE ListofInterests.InterestID=StudentInterests.InterestID
AND StudentInterests.MajorMinor='1'
AND Profile.ProfileID=StudentInterests.ProfileID);
Select Users.UserID,Profile.`ProfileID`,Users.Email,Profile.FirstName,
Profile.LastName,Profile.ProfilePic,Profile.DOB,
Profile.Gender,Profile.School,Profile.LastEdited,
Profile.Grade,Profile.Background, 
TEMPB.Major,TEMPB.MaCategory, TEMPC.Minor, TEMPC.MiCategory
 From Users
 INNER JOIN Profile 
 on Users.UserID=Profile.UserID 
 AND Users.Email=Emailer 
 AND Users.Password=Passworder
LEFT OUTER JOIN TEMPB
on Profile.ProfileID=TEMPB.ProfileID
LEFT OUTER JOIN TEMPC
on Profile.ProfileID=TEMPC.ProfileID;
DROP TABLE TEMPB;
DROP TABLE TEMPC;
    END $$
DELIMITER ;

/* Procedure structure for procedure `FilterMajMinIntPostCat` */

!50003 DROP PROCEDURE IF EXISTS  `FilterMajMinIntPostCat` ;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `FilterMajMinIntPostCat`(IN `maj`  VARCHAR(255), IN `cat` INT, IN `prof` INT)
BEGIN
DROP TABLE IF EXISTS TEMPB;
CREATE TABLE TEMPB (InterestDesc Varchar (255));
INSERT INTO  TEMPB (
SELECT InterestDesc
FROM ListofInterests, PostInfo, studentinterests where InterestDesc=maj 
AND PostInfo.CategoryID=cat AND PostInfo.ProfileID=prof AND studentinterests.PostInfoID=PostInfo.`PostInfoID` AND 
listofinterests.`InterestID`=studentinterests.`InterestID`
);
 SELECT COUNT(*) FROM TEMPB;
 
 DROP TABLE TEMPB;
    END $$
DELIMITER ;

/* Procedure structure for procedure `FilterMajMinIntPostCatTable` */

!50003 DROP PROCEDURE IF EXISTS  `FilterMajMinIntPostCatTable` ;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `FilterMajMinIntPostCatTable`(IN `maj`  VARCHAR(255), IN `cat` INT, IN `prof` INT)
BEGIN
DROP TABLE IF EXISTS TEMPB;
CREATE TABLE TEMPB (PostInfoID INT);
INSERT INTO  TEMPB (
SELECT PostInfo.PostInfoID 
FROM ListofInterests, PostInfo, studentinterests WHERE InterestDesc=maj 
AND CategoryID=cat AND PostInfo.ProfileID=prof AND studentinterests.PostInfoID=PostInfo.`PostInfoID` AND 
listofinterests.`InterestID`=studentinterests.`InterestID`
);
 SELECT * FROM TEMPB;
 
 DROP TABLE TEMPB;
    END $$
DELIMITER ;

/* Procedure structure for procedure `FilterPostDateInfoCat` */

!50003 DROP PROCEDURE IF EXISTS  `FilterPostDateInfoCat` ;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `FilterPostDateInfoCat`(IN `prof` INT, IN `cat` INT )
BEGIN
DROP TABLE IF EXISTS TEMPB;
DROP TABLE IF EXISTS TEMPFINAL;
DROP TABLE IF EXISTS TEMPFINAL2;
CREATE TABLE TEMPB (Timeframe DATE, PostInfoID INT);
INSERT INTO TEMPB (SELECT PostInfo.TimeFrame, PostInfo.PostInfoID
FROM PostInfo
WHERE ProfileID=prof
AND CategoryID=cat);
Create TABLE TEMPFINAL(
SELECT SUM(PostInfoID) As sumID FROM TEMPB
);
CREATE TABLE TEMPFINAL2(
SELECT SUM(Timeframe) AS timer FROM TEMPB
);
SELECT * FROM TEMPFINAL INNER JOIN TEMPFINAL2;
DROP TABLE TEMPB;
DROP TABLE TEMPFINAL;
DROP TABLE TEMPFINAL2;
END $$
DELIMITER ;

/* Procedure structure for procedure `FilterPostDateInfoPost` */

!50003 DROP PROCEDURE IF EXISTS  `FilterPostDateInfoPost`;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `FilterPostDateInfoPost`(IN `prof` INT, IN `cat` INT, IN postIDer INT)
BEGIN
SELECT PostInfo.TimeFrame, PostInfo.PostInfoID
FROM PostInfo
WHERE ProfileID=prof
AND CategoryID=cat
AND PostInfoID=postIDer;
END $$
DELIMITER ;

/* Procedure structure for procedure `FilterPostInfoCat` */

!50003 DROP PROCEDURE IF EXISTS  `FilterPostInfoCat` ;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `FilterPostInfoCat`(IN `prof` INT, IN `cat` INT )
BEGIN

DROP TABLE IF EXISTS TEMPB;

CREATE TABLE TEMPB (PostInfoID INT);

INSERT INTO TEMPB (SELECT postinfo.PostInfoID

FROM postinfo

WHERE postinfo.ProfileID=prof

AND postinfo.CategoryID=cat);

 SELECT COUNT(*) FROM TEMPB;

DROP TABLE TEMPB;

END $$
DELIMITER ;

/* Procedure structure for procedure `FilterPostInfoCatTable` */

!50003 DROP PROCEDURE IF EXISTS  `FilterPostInfoCatTable` ;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `FilterPostInfoCatTable`(IN `prof` INT, IN `cat` INT )
BEGIN
DROP TABLE IF EXISTS TEMPB;
CREATE TABLE TEMPB (PostInfoID INT);
INSERT INTO TEMPB (SELECT postinfo.PostInfoID
FROM postinfo
WHERE postinfo.ProfileID=prof
AND postinfo.CategoryID=cat);
SELEct * FROM TEMPB;
DROP TABLE TEMPB;
END $$
DELIMITER ;

/* Procedure structure for procedure `FilterRecsCat` */

!50003 DROP PROCEDURE IF EXISTS  `FilterRecsCat` ;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `FilterRecsCat`(IN `cat` INT, IN `prof` INT)
BEGIN
DROP TABLE IF EXISTS TEMPB;
CREATE TABLE TEMPB (Rec TEXT);
INSERT INTO TEMPB (
SELECT RecsofStudent.RecsDesc
FROM RecsofStudent, PostInfo
where PostInfo.CategoryID=cat 
AND PostInfo.ProfileID=prof
AND RecsofStudent.PostInfoID=PostInfo.PostInfoID
);
SELECT COUNT(*) FROM TEMPB;
DROP TABLE TEMPB;
    END $$
DELIMITER ;

/* Procedure structure for procedure `FindInterestID` */

!50003 DROP PROCEDURE IF EXISTS  `FindInterestID` ;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `FindInterestID`(IN Interest Varchar (255))
BEGIN
SELECT InterestID FROM listofinterests WHERE listofinterests.InterestDesc=Interest;
    END $$
DELIMITER ;

/* Procedure structure for procedure `ShowAllMajorInterest` */

!50003 DROP PROCEDURE IF EXISTS  `ShowAllMajorInterest` ;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `ShowAllMajorInterest`(IN prof INT)
BEGIN
SELECT StudentInterests.ProfileID,ListofInterests.InterestDesc,ListofInterests.InterestCategoryID
FROM StudentInterests, ListofInterests
WHERE StudentInterests.MajorMinor='2' AND ProfileID=prof
AND ListofInterests.InterestID=StudentInterests.InterestID;
    END $$
DELIMITER ;

/* Procedure structure for procedure `ShowPostInterests` */

!50003 DROP PROCEDURE IF EXISTS  `ShowPostInterests`;

DELIMITER $$

!50003 CREATE DEFINER=`a4691985_SmartS`@`mysql7.000webhost.com` PROCEDURE `ShowPostInterests`(IN prof INT, IN post INT)
BEGIN
SELECT StudentInterests.ProfileID,ListofInterests.InterestDesc,ListofInterests.InterestCategoryID
FROM StudentInterests, ListofInterests
WHERE studentinterests.ProfileID=prof AND studentinterests.`PostInfoID`=post
AND ListofInterests.InterestID=StudentInterests.InterestID;
    END $$
DELIMITER ;

!40101 SET SQL_MODE=@OLD_SQL_MODE ;
!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS ;
!40111 SET SQL_NOTES=@OLD_SQL_NOTES;
