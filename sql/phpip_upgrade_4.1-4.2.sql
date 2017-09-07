ALTER TABLE `addresses` MODIFY COLUMN `id` mediumint(25) NOT NULL auto_increment;

ALTER TABLE `addresses` ADD COLUMN `groupid` mediumint(25) NOT NULL DEFAULT '1';

ALTER TABLE `addresses` ADD COLUMN `NetID` mediumint(25) NOT NULL DEFAULT '0';

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

ALTER TABLE `net_ips` MODIFY COLUMN `AddressId` mediumint(25) NOT NULL auto_increment;

ALTER TABLE `net_ips` ADD COLUMN `view` mediumint(10) NOT NULL DEFAULT '0';

ALTER TABLE `net_ips` ADD COLUMN `groupid` mediumint(25) NOT NULL DEFAULT '1';

ALTER TABLE `net_ips` DROP KEY `netaddress`;

ALTER TABLE `netmenu` MODIFY COLUMN `NetMenuId` mediumint(25) NOT NULL auto_increment;

ALTER TABLE `netmenu` ADD COLUMN `groupid` mediumint(25) NOT NULL DEFAULT '1';

ALTER TABLE `preference` MODIFY COLUMN `id` mediumint(25) NOT NULL auto_increment;

ALTER TABLE `preference` MODIFY COLUMN `uid` mediumint(25) NOT NULL DEFAULT '0';

ALTER TABLE `preference` MODIFY COLUMN `showCidr` mediumint(25) NOT NULL DEFAULT '0';

ALTER TABLE `preference` MODIFY COLUMN `showPrefix` mediumint(25) NOT NULL DEFAULT '0';

ALTER TABLE `style` MODIFY COLUMN `styleID` mediumint(25) NOT NULL auto_increment;

ALTER TABLE `users` MODIFY COLUMN `username` varchar(255) NOT NULL;

ALTER TABLE `users` MODIFY COLUMN `access_level` varchar(16) NOT NULL DEFAULT 'Guest';

ALTER TABLE `users` ADD COLUMN `groupid` mediumint(25) NOT NULL DEFAULT '1';

ALTER TABLE `version` ADD INDEX `phpip` (`phpip`);

DROP TABLE `settings`;

UPDATE `version` SET `phpip` = '4.2' WHERE = '4.1';

