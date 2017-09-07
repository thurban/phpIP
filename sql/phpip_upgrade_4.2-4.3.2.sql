ALTER TABLE `addresses` ADD COLUMN `deviceType` varchar(255) NOT NULL;

ALTER TABLE `addresses` ADD COLUMN `deviceLocation` varchar(255) NOT NULL;

ALTER TABLE `addresses` ADD COLUMN `deviceOwner` varchar(255) NOT NULL;

ALTER TABLE `addresses` ADD COLUMN `deviceManufacturer` varchar(255) NOT NULL;

ALTER TABLE `addresses` ADD COLUMN `deviceModel` varchar(255) NOT NULL;

ALTER TABLE `addresses` ADD COLUMN `deviceCustom1` varchar(255) NOT NULL;

ALTER TABLE `addresses` ADD COLUMN `deviceCustom2` varchar(255) NOT NULL;

ALTER TABLE `addresses` ADD COLUMN `deviceCustom3` varchar(255) NOT NULL;

ALTER TABLE `addresses` ADD INDEX `deviceType` (`deviceType`);

ALTER TABLE `addresses` ADD INDEX `deviceLocation` (`deviceLocation`);

ALTER TABLE `addresses` ADD INDEX `deviceOwner` (`deviceOwner`);

ALTER TABLE `addresses` ADD INDEX `device Model` (`deviceModel`);

ALTER TABLE `addresses` ADD INDEX `deviceManufacturer` (`deviceManufacturer`);

ALTER TABLE `addresses` ADD INDEX `deviceCustom2` (`deviceCustom2`);

ALTER TABLE `addresses` ADD INDEX `deviceCustom3` (`deviceCustom3`);

ALTER TABLE `addresses` ADD INDEX `deviceCustom1` (`deviceCustom1`);

ALTER TABLE `preference` ADD COLUMN `showDeviceData` mediumint(10) NOT NULL DEFAULT '0';

ALTER TABLE `preference` ADD COLUMN `sorder1` varchar(255) NOT NULL DEFAULT 'ip';

ALTER TABLE `preference` ADD COLUMN `sorder2` varchar(255) NOT NULL DEFAULT 'mask';

ALTER TABLE `preference` ADD COLUMN `sorder3` varchar(255) NOT NULL DEFAULT 'description';

ALTER TABLE `preference` ADD COLUMN `sorder4` varchar(255) NOT NULL DEFAULT 'client';

ALTER TABLE `preference` ADD COLUMN `resolveDNS` mediumint(25) NOT NULL DEFAULT '0';

UPDATE `version` SET `phpip` = '4.3.2' WHERE = '4.2';

