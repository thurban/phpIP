-- Generation Time: Oct 04, 2006 at 11:49 AM

-- 
-- Table structure for table `NetMenu`
-- 

CREATE TABLE `NetMenu` (  `NetMenuId` mediumint(25) NOT NULL auto_increment,  `NetMenuCidr` varchar(36) NOT NULL default '',  `NetCidrDescription` varchar(255) NOT NULL default '',  `groupid` mediumint(25) NOT NULL default '1',  PRIMARY KEY  (`NetMenuId`),  KEY `NetMenuCidr` (`NetMenuCidr`)) TYPE=MyISAM;

-- 
-- Table structure for table `addresses`
-- 

CREATE TABLE `addresses` (  `id` mediumint(25) NOT NULL auto_increment,  `groupid` mediumint(25) NOT NULL default '1',  `NetID` mediumint(25) NOT NULL default '0',  `ip` varchar(36) default NULL,  `mask` varchar(16) default NULL,  `gateway` varchar(16) default NULL,  `description` varchar(255) default NULL,  `client` text,  `clientcontact` text,  `phone` varchar(12) default NULL,  `email` varchar(255) default NULL,  `deviceType` varchar(255) NOT NULL default '',  `deviceLocation` varchar(255) NOT NULL default '',  `deviceOwner` varchar(255) NOT NULL default '',  `deviceManufacturer` varchar(255) NOT NULL default '',  `deviceModel` varchar(255) NOT NULL default '',  `deviceCustom1` varchar(255) NOT NULL default '',  `deviceCustom2` varchar(255) NOT NULL default '',  `deviceCustom3` varchar(255) NOT NULL default '',  `notes` mediumtext,  PRIMARY KEY  (`id`),  KEY `ip` (`ip`),  KEY `mask` (`mask`),  KEY `gateway` (`gateway`),  KEY `description` (`description`),  KEY `phone` (`phone`),  KEY `email` (`email`),  KEY `deviceType` (`deviceType`),  KEY `deviceLocation` (`deviceLocation`),  KEY `deviceOwner` (`deviceOwner`),  KEY `device Model` (`deviceModel`),  KEY `deviceManufacturer` (`deviceManufacturer`),  KEY `deviceCustom2` (`deviceCustom2`),  KEY `deviceCustom3` (`deviceCustom3`),  KEY `deviceCustom1` (`deviceCustom1`)) TYPE=MyISAM;

-- 
-- Table structure for table `groups`
-- 

CREATE TABLE `groups` (  `id` mediumint(25) NOT NULL auto_increment,  `group` varchar(255) NOT NULL default '',  PRIMARY KEY  (`id`)) TYPE=MyISAM;

-- 
-- Dumping data for table `groups`
-- 

INSERT INTO `groups` (`id`, `group`) VALUES (1, 'Default Group');

-- --------------------------------------------------------

-- 
-- Table structure for table `history`
-- 

CREATE TABLE `history` (  `date` datetime default NULL,  `id` mediumint(25) default '0',  `ip` varchar(36) NOT NULL default '',  `username` varchar(16) NOT NULL default '',  `hostaddress` varchar(16) NOT NULL default '',  UNIQUE KEY `date` (`date`),  KEY `id` (`id`,`username`,`date`),  KEY `hostaddress` (`hostaddress`),  KEY `ip` (`ip`)) TYPE=MyISAM;

-- 
-- Table structure for table `ldap`
-- 

CREATE TABLE `ldap` (  `ldapId` mediumint(25) NOT NULL auto_increment,  `ldapConnect` varchar(255) NOT NULL default '',  `ldapPort` varchar(255) NOT NULL default '',  PRIMARY KEY  (`ldapId`)) TYPE=MyISAM COMMENT='Ldap Connect statement';

-- 
-- Table structure for table `net_ips`
-- 

CREATE TABLE `net_ips` (  `AddressId` mediumint(25) NOT NULL auto_increment,  `netaddress` varchar(36) NOT NULL default '',  `ip_description` varchar(255) NOT NULL default '',  `view` mediumint(10) NOT NULL default '0',  `NetCidr` mediumint(10) NOT NULL default '0',  `groupid` mediumint(25) NOT NULL default '1',  PRIMARY KEY  (`AddressId`),  KEY `ip_description` (`ip_description`)) TYPE=MyISAM;


-- 
-- Table structure for table `preference`
-- 

CREATE TABLE `preference` (  `id` mediumint(25) NOT NULL auto_increment,  `uid` mediumint(25) NOT NULL default '0',  `showCidr` mediumint(25) NOT NULL default '0',  `showPrefix` mediumint(25) NOT NULL default '0',  `style` varchar(255) NOT NULL default '',  `showDeviceData` mediumint(10) NOT NULL default '0',  `sorder1` varchar(255) NOT NULL default 'ip',  `sorder2` varchar(255) NOT NULL default 'mask',  `sorder3` varchar(255) NOT NULL default 'description',  `sorder4` varchar(255) NOT NULL default 'client',  `resolveDNS` mediumint(25) NOT NULL default '0',  PRIMARY KEY  (`id`)) TYPE=MyISAM COMMENT='Preference ';


-- 
-- Table structure for table `style`
-- 

CREATE TABLE `style` (  `styleID` mediumint(25) NOT NULL auto_increment,  `styleType` varchar(255) NOT NULL default '',  `styleName` varchar(255) NOT NULL default '',  PRIMARY KEY  (`styleID`)) TYPE=MyISAM COMMENT='css style ';

-- 
-- Dumping data for table `style`
-- 

INSERT INTO `style` (`styleID`, `styleType`, `styleName`) VALUES (1, 'default.css', 'default');
INSERT INTO `style` (`styleID`, `styleType`, `styleName`) VALUES (2, 'white.css', 'white');
INSERT INTO `style` (`styleID`, `styleType`, `styleName`) VALUES (3, 'green.css', 'green');
INSERT INTO `style` (`styleID`, `styleType`, `styleName`) VALUES (4, 'red.css', 'red');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (  `uid` mediumint(25) NOT NULL auto_increment,  `username` varchar(255) NOT NULL default '',  `access_level` varchar(16) NOT NULL default 'Guest',  `type` varchar(255) NOT NULL default '',  `name` varchar(255) NOT NULL default '',  `email` mediumtext NOT NULL,  `password` varchar(255) NOT NULL default '',  `groupid` mediumint(25) NOT NULL default '1',  PRIMARY KEY  (`uid`),  KEY `access_level` (`access_level`),  KEY `type` (`type`)) TYPE=MyISAM;

-- 
-- Table structure for table `version`
-- 

CREATE TABLE `version` (  `phpip` char(20) NOT NULL default '',  KEY `phpip` (`phpip`) ) TYPE=MyISAM;

-- 
-- Dumping data for table `version`
-- 

INSERT INTO `version` (`phpip`) VALUES ('4.3.2');
