ALTER TABLE `phpshop_modules_avito_system` ADD `address` varchar(255) default '';

INSERT INTO `phpshop_modules_avito_xml_prices` (`id`, `name`) VALUES (3, '�������� � ����������');

INSERT INTO `phpshop_modules_avito_categories` (`id`, `name`, `xml_price_id`) VALUES
(16, '�������� � ����������', 3);

INSERT INTO `phpshop_modules_avito_types` (`id`, `name`, `category_id`) VALUES
(145, '[11-618] �������� / ��� ����������� / ��������', 16),
(146, '[19-2855] �������� / ��� ����������� / ���������� �� ��������', 16),
(147, '[11-619] �������� / ��� ����������� / ������������', 16),
(148, '[16-827] �������� / ��� ����������� / ��������� / ���� ���������, �������, ������', 16),
(149, '[16-828] �������� / ��� ����������� / ��������� / ��������� �������', 16),
(150, '[16-829] �������� / ��� ����������� / ��������� / ����������, ��������', 16),
(151, '[16-830] �������� / ��� ����������� / ��������� / ��������� � �����', 16),
(152, '[16-831] �������� / ��� ����������� / ��������� / ������� ���������, �����, ���������', 16),
(153, '[16-832] �������� / ��� ����������� / ��������� / ��������� ������', 16),
(154, '[16-833] �������� / ��� ����������� / ��������� / ��������, �������', 16),
(155, '[16-834] �������� / ��� ����������� / ��������� / ����������', 16),
(156, '[16-835] �������� / ��� ����������� / ��������� / ��������� ���������', 16),
(157, '[16-836] �������� / ��� ����������� / ��������� / �������� �����, ������� ������', 16),
(158, '[16-837] �������� / ��� ����������� / ��������� / �������� ����������', 16),
(159, '[16-838] �������� / ��� ����������� / ��������� / ������, ������, ������', 16),
(160, '[16-839] �������� / ��� ����������� / ��������� / ��������� �����, ����������', 16),
(161, '[16-840] �������� / ��� ����������� / ��������� / ��������� � ������������', 16),
(162, '[16-841] �������� / ��� ����������� / ��������� / �����, ����, �������� ���', 16),
(163, '[16-842] �������� / ��� ����������� / ��������� / �������, �����������', 16),
(164, '[16-843] �������� / ��� ����������� / ��������� / ���������������� � ����������', 16),
(165, '[11-621] �������� / ��� ����������� / �������� ��� ��', 16),
(166, '[16-805] �������� / ��� ����������� / ����� / �����, ���������', 16),
(167, '[16-806] �������� / ��� ����������� / ����� / �������', 16),
(168, '[16-807] �������� / ��� ����������� / ����� / ����������', 16),
(169, '[16-808] �������� / ��� ����������� / ����� / �����', 16),
(170, '[16-809] �������� / ��� ����������� / ����� / ��������', 16),
(171, '[16-810] �������� / ��� ����������� / ����� / �����', 16),
(172, '[16-811] �������� / ��� ����������� / ����� / ������', 16),
(173, '[16-812] �������� / ��� ����������� / ����� / �������', 16),
(174, '[16-813] �������� / ��� ����������� / ����� / ������', 16),
(175, '[16-814] �������� / ��� ����������� / ����� / �����', 16),
(176, '[16-815] �������� / ��� ����������� / ����� / ���������', 16),
(177, '[16-816] �������� / ��� ����������� / ����� / ������', 16),
(178, '[16-817] �������� / ��� ����������� / ����� / �����', 16),
(179, '[16-818] �������� / ��� ����������� / ����� / ������, ����� ���������', 16),
(180, '[16-819] �������� / ��� ����������� / ����� / ����� �� ������', 16),
(181, '[16-820] �������� / ��� ����������� / ����� / ����� �������', 16),
(182, '[16-821] �������� / ��� ����������� / ����� / ����� ���������', 16),
(183, '[16-822] �������� / ��� ����������� / ����� / ��������, ��������', 16),
(184, '[16-823] �������� / ��� ����������� / ����� / ������', 16),
(185, '[16-824] �������� / ��� ����������� / ����� / ����', 16),
(186, '[16-825] �������� / ��� ����������� / ����� / ������� ���������', 16),
(187, '[16-826] �������� / ��� ����������� / ����� / ������ ������', 16),
(188, '[11-623] �������� / ��� ����������� / ��������', 16),
(189, '[11-624] �������� / ��� ����������� / ������� ����������', 16),
(190, '[11-625] �������� / ��� ����������� / �����', 16),
(191, '[16-521] �������� / ��� ����������� / ������� ����������', 16),
(192, '[11-626] �������� / ��� ����������� / ������', 16),
(193, '[11-627] �������� / ��� ����������� / ��������� � ��������� �������', 16),
(194, '[11-628] �������� / ��� ����������� / ��������� �������', 16),
(195, '[11-629] �������� / ��� ����������� / ����������� � ������', 16),
(196, '[11-630] �������� / ��� ����������� / �������������������', 16),
(197, '[6-401] �������� / ��� �����������', 16),
(198, '[6-406] �������� / ��� �����������', 16),
(199, '[6-411] �������� / ��� ������� ����������', 16),
(200, '[4-943] ����������', 16),
(201, '[21] GPS-����������', 16),
(202, '[4-942] ������������� � ���������', 16),
(203, '[20] �����- � ������������', 16),
(204, '[4-964] ��������� � �������', 16),
(205, '[4-963] �����������', 16),
(206, '[4-965] �������', 16),
(207, '[11-631] �������������� ���������� / ����������������', 16),
(208, '[11-632] �������������� ���������� / �������������', 16),
(209, '[11-633] �������������� ���������� / ������������ �����������', 16),
(210, '[11-634] �������������� ���������� / ����������� �������', 16),
(211, '[22] ������', 16),
(212, '[10-048] ����, ����� � ����� / ����', 16),
(213, '[10-047] ����, ����� � ����� / ��������', 16),
(214, '[10-045] ����, ����� � ����� / �����', 16),
(215, '[10-044] ����, ����� � ����� / �������', 16),
(216, '[6-416] ����������', 16);

ALTER TABLE `phpshop_products` ADD `oem_avito` varchar(255) DEFAULT '';
ALTER TABLE `phpshop_products` ADD `tiers_avito` text;