DROP TABLE IF EXISTS `phpshop_modules_thumbnailimages_system`;
CREATE TABLE IF NOT EXISTS `phpshop_modules_thumbnailimages_system` (
  `id` int(11) NOT NULL auto_increment,
  `limit` int(11) NOT NULL default '1000',
  `processed` int(11) NOT NULL default '0',
  `last_operation` varchar(64) default 'thumb',
  `version` varchar(64) default '1.0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

INSERT INTO `phpshop_modules_thumbnailimages_system` VALUES (1, 1000, 0, 'thumb', '1.0');