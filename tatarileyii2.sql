-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 14 2016 г., 11:22
-- Версия сервера: 5.6.31
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tatarileyii2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `group_code` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`, `group_code`) VALUES
('/*', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('//*', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('//controller', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('//crud', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('//extension', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('//form', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('//index', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('//model', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('//module', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/asset/*', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/asset/compress', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/asset/template', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/cache/*', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/cache/flush', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/cache/flush-all', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/cache/flush-schema', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/cache/index', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/fixture/*', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/fixture/load', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/fixture/unload', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/gii/*', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/gii/default/*', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/gii/default/action', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/gii/default/diff', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/gii/default/index', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/gii/default/preview', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/gii/default/view', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/hello/*', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/hello/index', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/help/*', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/help/index', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/message/*', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/message/config', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/message/config-template', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/message/extract', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/migrate/*', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/migrate/create', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/migrate/down', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/migrate/history', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/migrate/mark', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/migrate/new', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/migrate/redo', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/migrate/to', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/migrate/up', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/serve/*', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/serve/index', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/user-management/*', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/user-management/auth/change-own-password', 3, NULL, NULL, NULL, 1476031340, 1476031340, NULL),
('/user-management/user-permission/set', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/user-management/user-permission/set-roles', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/user-management/user/bulk-activate', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/user-management/user/bulk-deactivate', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/user-management/user/bulk-delete', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/user-management/user/change-password', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/user-management/user/create', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/user-management/user/delete', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/user-management/user/grid-page-size', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/user-management/user/index', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/user-management/user/update', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('/user-management/user/view', 3, NULL, NULL, NULL, 1476031339, 1476031339, NULL),
('Admin', 1, 'Admin', NULL, NULL, 1476031339, 1476031339, NULL),
('assignRolesToUsers', 2, 'Assign roles to users', NULL, NULL, 1476031339, 1476031339, 'userManagement'),
('bindUserToIp', 2, 'Bind user to IP', NULL, NULL, 1476031339, 1476031339, 'userManagement'),
('changeOwnPassword', 2, 'Change own password', NULL, NULL, 1476031339, 1476031339, 'userCommonPermissions'),
('changeUserPassword', 2, 'Change user password', NULL, NULL, 1476031339, 1476031339, 'userManagement'),
('commonPermission', 2, 'Common permission', NULL, NULL, 1476031337, 1476031337, NULL),
('createUsers', 2, 'Create users', NULL, NULL, 1476031339, 1476031339, 'userManagement'),
('deleteUsers', 2, 'Delete users', NULL, NULL, 1476031339, 1476031339, 'userManagement'),
('editUserEmail', 2, 'Edit user email', NULL, NULL, 1476031339, 1476031339, 'userManagement'),
('editUsers', 2, 'Edit users', NULL, NULL, 1476031339, 1476031339, 'userManagement'),
('viewRegistrationIp', 2, 'View registration IP', NULL, NULL, 1476031339, 1476031339, 'userManagement'),
('viewUserEmail', 2, 'View user email', NULL, NULL, 1476031339, 1476031339, 'userManagement'),
('viewUserRoles', 2, 'View user roles', NULL, NULL, 1476031339, 1476031339, 'userManagement'),
('viewUsers', 2, 'View users', NULL, NULL, 1476031339, 1476031339, 'userManagement'),
('viewVisitLog', 2, 'View visit log', NULL, NULL, 1476031339, 1476031339, 'userManagement');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('changeOwnPassword', '/user-management/auth/change-own-password'),
('assignRolesToUsers', '/user-management/user-permission/set'),
('assignRolesToUsers', '/user-management/user-permission/set-roles'),
('editUsers', '/user-management/user/bulk-activate'),
('editUsers', '/user-management/user/bulk-deactivate'),
('deleteUsers', '/user-management/user/bulk-delete'),
('changeUserPassword', '/user-management/user/change-password'),
('createUsers', '/user-management/user/create'),
('deleteUsers', '/user-management/user/delete'),
('viewUsers', '/user-management/user/grid-page-size'),
('viewUsers', '/user-management/user/index'),
('editUsers', '/user-management/user/update'),
('viewUsers', '/user-management/user/view'),
('Admin', 'assignRolesToUsers'),
('Admin', 'changeOwnPassword'),
('Admin', 'changeUserPassword'),
('Admin', 'createUsers'),
('Admin', 'deleteUsers'),
('Admin', 'editUsers'),
('editUserEmail', 'viewUserEmail'),
('assignRolesToUsers', 'viewUserRoles'),
('Admin', 'viewUsers'),
('assignRolesToUsers', 'viewUsers'),
('changeUserPassword', 'viewUsers'),
('createUsers', 'viewUsers'),
('deleteUsers', 'viewUsers'),
('editUsers', 'viewUsers');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_group`
--

CREATE TABLE IF NOT EXISTS `auth_item_group` (
  `code` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `auth_item_group`
--

INSERT INTO `auth_item_group` (`code`, `name`, `created_at`, `updated_at`) VALUES
('userCommonPermissions', 'User common permission', 1476031339, 1476031339),
('userManagement', 'User management', 1476031339, 1476031339);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `menu_group`
--

CREATE TABLE IF NOT EXISTS `menu_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `URL` varchar(255) DEFAULT NULL,
  `position` varchar(20) NOT NULL,
  `icon` varchar(100) NOT NULL DEFAULT 'fa fa-file-code-o',
  `seq` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu_group`
--

INSERT INTO `menu_group` (`id`, `name`, `type`, `URL`, `position`, `icon`, `seq`) VALUES
(1, 'Users and roles', 0, NULL, 'backend', 'fa fa-users', 9),
(2, 'Users', 1, '/user-management/user/index', 'backend', 'fa fa-user', 0),
(3, 'Site settings', 0, NULL, 'backend', 'fa fa-cog', 8),
(4, 'Menu', 3, '/admin/menu', 'backend', 'fa fa-bars', 0),
(5, 'Roles', 1, '/user-management/role/index', 'backend', 'fa fa-user-secret', 0),
(6, 'Permissions', 1, '/user-management/permission/index', 'backend', 'fa fa-key', 0),
(7, 'Permission Groups', 1, '/user-management/auth-item-group/index', 'backend', 'fa fa-object-ungroup', 0),
(8, 'Logs', 0, NULL, 'backend', 'fa fa-newspaper-o', 1),
(9, 'Visit log', 8, '/user-management/user-visit-log/index', 'backend', 'fa fa-history', 0),
(10, 'Main backend', 0, '/admin', 'backend', 'fa fa-home', 10),
(11, 'frontend', 0, '/', 'backend', 'fa fa-file-code-o', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1476031330),
('m140608_173539_create_user_table', 1476031334),
('m140611_133903_init_rbac', 1476031335),
('m140808_073114_create_auth_item_group_table', 1476031336),
('m140809_072112_insert_superadmin_to_user', 1476031336),
('m140809_073114_insert_common_permisison_to_auth_item', 1476031337),
('m141023_141535_create_user_visit_log', 1476031337),
('m141116_115804_add_bind_to_ip_and_registration_ip_to_user', 1476031338),
('m141121_194858_split_browser_and_os_column', 1476031339),
('m141201_220516_add_email_and_email_confirmed_to_user', 1476031339),
('m141207_001649_create_basic_user_permissions', 1476031340);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `superadmin` smallint(6) DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `registration_ip` varchar(15) DEFAULT NULL,
  `bind_to_ip` varchar(255) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `email_confirmed` smallint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `confirmation_token`, `status`, `superadmin`, `created_at`, `updated_at`, `registration_ip`, `bind_to_ip`, `email`, `email_confirmed`) VALUES
(1, 'superadmin', 'C02ET33nTAzc4oSJflCuBTl68gynT8w8', '$2y$13$rFh7yTVpodZLi85nfiIALe7fPXpXFjC6.a7h5h8vrtmu5LC1cB2g6', NULL, 1, 1, 1476031336, 1476031336, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user_visit_log`
--

CREATE TABLE IF NOT EXISTS `user_visit_log` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `language` char(2) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visit_time` int(11) NOT NULL,
  `browser` varchar(30) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_visit_log`
--

INSERT INTO `user_visit_log` (`id`, `token`, `ip`, `language`, `user_agent`, `user_id`, `visit_time`, `browser`, `os`) VALUES
(1, '57fa7697819ac', '127.0.0.1', 'ru', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36 OPR/40.0.2308.81', 1, 1476032151, 'Chrome', 'Windows'),
(2, '57fa76d715517', '127.0.0.1', 'ru', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36 OPR/40.0.2308.81', 1, 1476032215, 'Chrome', 'Windows'),
(3, '580ce0fb408ae', '127.0.0.1', 'ru', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36 OPR/40.0.2308.90', 1, 1477239035, 'Chrome', 'Windows'),
(4, '581dde99b8b56', '127.0.0.1', 'ru', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36 OPR/40.0.2308.90', 1, 1478352537, 'Chrome', 'Windows'),
(5, '581e358d9a213', '127.0.0.1', 'ru', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36 OPR/40.0.2308.90', 1, 1478374797, 'Chrome', 'Windows'),
(6, '581e41508c3cf', '127.0.0.1', 'ru', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36 OPR/40.0.2308.90', 1, 1478377808, 'Chrome', 'Windows'),
(7, '5829725d3821e', '127.0.0.1', 'ru', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1, 1479111261, 'Chrome', 'Windows');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`),
  ADD KEY `fk_auth_item_group_code` (`group_code`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_item_group`
--
ALTER TABLE `auth_item_group`
  ADD PRIMARY KEY (`code`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_visit_log`
--
ALTER TABLE `user_visit_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `menu_group`
--
ALTER TABLE `menu_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `user_visit_log`
--
ALTER TABLE `user_visit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_auth_item_group_code` FOREIGN KEY (`group_code`) REFERENCES `auth_item_group` (`code`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_visit_log`
--
ALTER TABLE `user_visit_log`
  ADD CONSTRAINT `user_visit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
