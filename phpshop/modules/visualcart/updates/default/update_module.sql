ALTER TABLE `phpshop_modules_visualcart_system` ADD `nowbuy` enum('0','1') default '0';
ALTER TABLE `phpshop_modules_visualcart_system` ADD `version` varchar(64) DEFAULT '2.0';

DROP TABLE IF EXISTS `phpshop_modules_visualcart_log`;
CREATE TABLE `phpshop_modules_visualcart_log` (
  `id` int(11) NOT NULL auto_increment,
  `date` int(11) default '0',
  `user` varchar(255) default '',
  `ip` varchar(64) default '',
  `status` enum('1','2') DEFAULT '1',
  `content` varchar(64) default '',
  `num` TINYINT(11) default '0',
  `product_id` INT(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;