ALTER TABLE `NetMenu` MODIFY COLUMN `NetMenuId` mediumint(25) NOT NULL auto_increment;

ALTER TABLE `NetMenu` ADD COLUMN `groupid` mediumint(25) NOT NULL DEFAULT '1';

ALTER TABLE `addresses` MODIFY COLUMN `id` mediumint(25) NOT NULL auto_increment;

ALTER TABLE `addresses` ADD COLUMN `groupid` mediumint(25) NOT NULL DEFAULT '1';

ALTER TABLE `addresses` MODIFY COLUMN `email` varchar(255);

ALTER TABLE `addresses` ADD PRIMARY KEY (`id`);

ALTER TABLE `addresses` DROP KEY `mykey`;

ALTER TABLE `addresses` DROP KEY `id`;

CREATE TABLE `groups` (
  `id` mediumint(25) NOT NULL auto_increment,
  `group` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `history` MODIFY COLUMN `id` mediumint(25) DEFAULT '0';

ALTER TABLE `ldap` DROP COLUMN `ldapRead`;

ALTER TABLE `ldap` DROP COLUMN `ldapWrite`;

ALTER TABLE `ldap` DROP COLUMN `ldapAdmin`;

ALTER TABLE `net_ips` MODIFY COLUMN `AddressId` mediumint(25) NOT NULL auto_increment;

ALTER TABLE `net_ips` ADD COLUMN `view` mediumint(10) NOT NULL DEFAULT '0';

ALTER TABLE `net_ips` ADD COLUMN `groupid` mediumint(25) NOT NULL DEFAULT '1';

CREATE TABLE `preference` (
  `id` mediumint(25) NOT NULL auto_increment,
  `uid` mediumint(25) NOT NULL default '0',
  `showCidr` mediumint(25) NOT NULL default '0',
  `showPrefix` mediumint(25) NOT NULL default '0',
  `style` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 PACK_KEYS=0 COMMENT='Preference ';

CREATE TABLE `style` (
  `styleID` mediumint(25) NOT NULL auto_increment,
  `styleType` varchar(255) NOT NULL default '',
  `styleName` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`styleID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='css style ';

ALTER TABLE `users` ADD COLUMN `uid` mediumint(25) NOT NULL auto_increment;

ALTER TABLE `users` MODIFY COLUMN `username` varchar(255) NOT NULL;

ALTER TABLE `users` ADD COLUMN `groupid` mediumint(25) NOT NULL DEFAULT '1';

ALTER TABLE `users` DROP KEY `PRIMARY`, ADD PRIMARY KEY (`uid`);

ALTER TABLE `users` ADD INDEX `type` (`type`);

CREATE TABLE `version` (
  `phpip` char(20) NOT NULL default '',
  KEY `phpip` (`phpip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE `bookmarks`;

DROP TABLE `settings`;

INSERT INTO `version` (`phpip`) VALUES ('4.2');