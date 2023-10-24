#
# TABLE STRUCTURE FOR: actions_logs
#

DROP TABLE IF EXISTS `actions_logs`;

CREATE TABLE `actions_logs` (
  `actions_logs_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_login` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `note` text,
  `url` varchar(255) DEFAULT NULL,
  `actions` varchar(255) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  PRIMARY KEY (`actions_logs_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `actions_logs` (`actions_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `url`, `actions`, `timestamp_create`) VALUES (1, 'info@webdukes.com', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '119.42.59.246', 'save on [admin/category/edited/15]', 'http://webdukes.in/doca/admin/category/edited/15', 'save', '2021-02-26 17:16:25');
INSERT INTO `actions_logs` (`actions_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `url`, `actions`, `timestamp_create`) VALUES (2, 'info@webdukes.com', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '103.28.252.164', 'save on [admin/settings/update]', 'https://webdukes.in/doca/admin/settings/update', 'save', '2021-02-27 11:15:19');
INSERT INTO `actions_logs` (`actions_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `url`, `actions`, `timestamp_create`) VALUES (3, 'info@webdukes.com', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '103.28.252.164', 'save on [admin/upgrade/backup]', 'https://webdukes.in/doca/admin/upgrade/backup', 'save', '2021-02-27 11:17:07');


#
# TABLE STRUCTURE FOR: article_db
#

DROP TABLE IF EXISTS `article_db`;

CREATE TABLE `article_db` (
  `article_db_id` int(11) NOT NULL AUTO_INCREMENT,
  `url_rewrite` varchar(255) DEFAULT NULL,
  `is_category` int(11) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `main_cat_id` int(11) DEFAULT NULL,
  `main_picture` varchar(255) DEFAULT NULL,
  `file_upload` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `short_desc` varchar(255) DEFAULT NULL,
  `content` text,
  `user_admin_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `lang_iso` varchar(10) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `fb_comment_active` int(11) DEFAULT NULL,
  `fb_comment_limit` int(11) DEFAULT NULL,
  `fb_comment_sort` varchar(20) DEFAULT NULL,
  `arrange` int(11) DEFAULT NULL,
  `user_groups_idS` text,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`article_db_id`),
  KEY `url_rewrite` (`url_rewrite`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: article_db_downloadstat
#

DROP TABLE IF EXISTS `article_db_downloadstat`;

CREATE TABLE `article_db_downloadstat` (
  `article_db_downloadstat_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_db_id` int(11) DEFAULT NULL,
  `file_upload` varchar(255) DEFAULT NULL,
  `user_admin_id` int(11) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  PRIMARY KEY (`article_db_downloadstat_id`),
  KEY `article_db_id` (`article_db_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: banner_mgt
#

DROP TABLE IF EXISTS `banner_mgt`;

CREATE TABLE `banner_mgt` (
  `banner_mgt_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `width` int(5) DEFAULT NULL,
  `height` int(5) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `nofollow` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `note` text,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`banner_mgt_id`),
  KEY `link` (`link`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: banner_statistic
#

DROP TABLE IF EXISTS `banner_statistic`;

CREATE TABLE `banner_statistic` (
  `banner_statistic_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_mgt_id` int(11) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  PRIMARY KEY (`banner_statistic_id`),
  KEY `banner_mgt_id` (`banner_mgt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: blacklist_ip
#

DROP TABLE IF EXISTS `blacklist_ip`;

CREATE TABLE `blacklist_ip` (
  `blacklist_ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) DEFAULT NULL,
  `note` text,
  `timestamp_create` datetime DEFAULT NULL,
  PRIMARY KEY (`blacklist_ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: carousel_picture
#

DROP TABLE IF EXISTS `carousel_picture`;

CREATE TABLE `carousel_picture` (
  `carousel_picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `carousel_widget_id` int(11) DEFAULT NULL,
  `file_upload` varchar(255) DEFAULT NULL,
  `photo_url` varchar(512) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `arrange` int(11) DEFAULT NULL,
  `carousel_type` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`carousel_picture_id`),
  KEY `carousel_widget_id` (`carousel_widget_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `carousel_picture` (`carousel_picture_id`, `carousel_widget_id`, `file_upload`, `photo_url`, `caption`, `arrange`, `carousel_type`, `youtube_url`, `timestamp_create`, `timestamp_update`) VALUES (1, 1, NULL, 'https://placehold.it/1900x540&text=Slide%20One', 'Caption One', 1, 'multiimages', NULL, '2021-02-25 02:05:31', '2021-02-25 02:05:31');
INSERT INTO `carousel_picture` (`carousel_picture_id`, `carousel_widget_id`, `file_upload`, `photo_url`, `caption`, `arrange`, `carousel_type`, `youtube_url`, `timestamp_create`, `timestamp_update`) VALUES (2, 1, NULL, 'https://placehold.it/1900x540&text=Slide%20Two', 'Caption Two', 2, 'multiimages', NULL, '2021-02-25 02:05:31', '2021-02-25 02:05:31');
INSERT INTO `carousel_picture` (`carousel_picture_id`, `carousel_widget_id`, `file_upload`, `photo_url`, `caption`, `arrange`, `carousel_type`, `youtube_url`, `timestamp_create`, `timestamp_update`) VALUES (3, 1, NULL, 'https://placehold.it/1900x540&text=Slide%20Three', 'Caption Three', 3, 'multiimages', NULL, '2021-02-25 02:05:31', '2021-02-25 02:05:31');


#
# TABLE STRUCTURE FOR: carousel_widget
#

DROP TABLE IF EXISTS `carousel_widget`;

CREATE TABLE `carousel_widget` (
  `carousel_widget_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `custom_temp_active` int(11) DEFAULT NULL,
  `custom_template` text,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`carousel_widget_id`),
  KEY `carousel_widget_id` (`carousel_widget_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `carousel_widget` (`carousel_widget_id`, `name`, `active`, `custom_temp_active`, `custom_template`, `timestamp_create`, `timestamp_update`) VALUES (1, 'Home', 1, 0, '', '2021-02-25 02:05:31', '2021-02-25 02:05:31');


#
# TABLE STRUCTURE FOR: ci_sessions
#

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL DEFAULT '',
  `ip_address` varchar(45) DEFAULT NULL,
  `timestamp` int(10) unsigned DEFAULT '0',
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('833611690aed8afb0c51ab42d8c15fee8931f2f7', '119.42.59.120', 1614254680, '__ci_last_regenerate|i:1614254680;cszblogin_cururl|s:58:\"http://webdukes.in/doca/index.php/admin?nocache=1614240331\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('a089a9a1bec748195b047b2d3a2dbda5c98cec87', '119.42.59.120', 1614254732, '__ci_last_regenerate|i:1614254680;cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";fronlang_iso|s:2:\"en\";admin_logged_in|b:1;user_admin_id|s:1:\"1\";admin_name|s:10:\"Admin User\";admin_email|s:17:\"info@webdukes.com\";admin_type|s:5:\"admin\";pwd_change|s:1:\"1\";session_id|s:40:\"a089a9a1bec748195b047b2d3a2dbda5c98cec87\";user_agent|s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36\";referred_index|s:29:\"http://webdukes.in/doca/admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e6241804642026c8f21a80d23b6f28c61166cf12', '119.42.59.246', 1614339636, '__ci_last_regenerate|i:1614339636;fronlang_iso|s:2:\"en\";cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";admin_logged_in|b:1;user_admin_id|s:1:\"1\";admin_name|s:10:\"Admin User\";admin_email|s:17:\"info@webdukes.com\";admin_type|s:5:\"admin\";pwd_change|s:1:\"1\";session_id|s:40:\"e6241804642026c8f21a80d23b6f28c61166cf12\";user_agent|s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36\";referred_index|s:29:\"http://webdukes.in/doca/admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('2aad835770e50182bb20175091ad7ba9b423c2c8', '119.42.59.246', 1614339961, '__ci_last_regenerate|i:1614339961;fronlang_iso|s:2:\"en\";cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";admin_logged_in|b:1;user_admin_id|s:1:\"1\";admin_name|s:10:\"Admin User\";admin_email|s:17:\"info@webdukes.com\";admin_type|s:5:\"admin\";pwd_change|s:1:\"1\";session_id|s:40:\"e6241804642026c8f21a80d23b6f28c61166cf12\";user_agent|s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36\";referred_index|s:38:\"http://webdukes.in/doca/admin/category\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b1597f1c3abcc0acfc0a9c60effee2eaf1bec80b', '119.42.59.246', 1614340396, '__ci_last_regenerate|i:1614340396;fronlang_iso|s:2:\"en\";cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";admin_logged_in|b:1;user_admin_id|s:1:\"1\";admin_name|s:10:\"Admin User\";admin_email|s:17:\"info@webdukes.com\";admin_type|s:5:\"admin\";pwd_change|s:1:\"1\";session_id|s:40:\"e6241804642026c8f21a80d23b6f28c61166cf12\";user_agent|s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36\";referred_index|s:38:\"http://webdukes.in/doca/admin/category\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('2b25aefdbce11b739f1e67d62ac0524f2719d294', '119.42.59.246', 1614341708, '__ci_last_regenerate|i:1614341708;fronlang_iso|s:2:\"en\";cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";admin_logged_in|b:1;user_admin_id|s:1:\"1\";admin_name|s:10:\"Admin User\";admin_email|s:17:\"info@webdukes.com\";admin_type|s:5:\"admin\";pwd_change|s:1:\"1\";session_id|s:40:\"e6241804642026c8f21a80d23b6f28c61166cf12\";user_agent|s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36\";referred_index|s:38:\"http://webdukes.in/doca/admin/category\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('99a12c69f4d828e9a1a3b05531937fe66e15ba14', '119.42.59.246', 1614342526, '__ci_last_regenerate|i:1614342526;fronlang_iso|s:2:\"en\";cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";admin_logged_in|b:1;user_admin_id|s:1:\"1\";admin_name|s:10:\"Admin User\";admin_email|s:17:\"info@webdukes.com\";admin_type|s:5:\"admin\";pwd_change|s:1:\"1\";session_id|s:40:\"e6241804642026c8f21a80d23b6f28c61166cf12\";user_agent|s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36\";referred_index|s:38:\"http://webdukes.in/doca/admin/category\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('229eec3b3a50dc1981e53d41fa1d9cabcc3c5d3b', '119.42.59.246', 1614343034, '__ci_last_regenerate|i:1614343034;fronlang_iso|s:2:\"en\";cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";admin_logged_in|b:1;user_admin_id|s:1:\"1\";admin_name|s:10:\"Admin User\";admin_email|s:17:\"info@webdukes.com\";admin_type|s:5:\"admin\";pwd_change|s:1:\"1\";session_id|s:40:\"e6241804642026c8f21a80d23b6f28c61166cf12\";user_agent|s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36\";referred_index|s:38:\"http://webdukes.in/doca/admin/category\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('654da13df064db253af6f62163b79531b0a521fd', '119.42.59.246', 1614344303, '__ci_last_regenerate|i:1614344303;fronlang_iso|s:2:\"en\";cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";admin_logged_in|b:1;user_admin_id|s:1:\"1\";admin_name|s:10:\"Admin User\";admin_email|s:17:\"info@webdukes.com\";admin_type|s:5:\"admin\";pwd_change|s:1:\"1\";session_id|s:40:\"e6241804642026c8f21a80d23b6f28c61166cf12\";user_agent|s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36\";referred_index|s:38:\"http://webdukes.in/doca/admin/category\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('c1b4e4b7285c7d42e57a342eb5b90644a88cf7b8', '119.42.59.246', 1614344350, '__ci_last_regenerate|i:1614344263;fronlang_iso|s:2:\"en\";cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('c33f03460e5973dc6d855b11f9dd69a36f7c12b1', '119.42.59.246', 1614344303, '__ci_last_regenerate|i:1614344303;fronlang_iso|s:2:\"en\";cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";admin_logged_in|b:1;user_admin_id|s:1:\"1\";admin_name|s:10:\"Admin User\";admin_email|s:17:\"info@webdukes.com\";admin_type|s:5:\"admin\";pwd_change|s:1:\"1\";session_id|s:40:\"e6241804642026c8f21a80d23b6f28c61166cf12\";user_agent|s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36\";referred_index|s:38:\"http://webdukes.in/doca/admin/category\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('07762d85b61b26dafd0e15394dff72f44247b3af', '119.42.59.246', 1614344308, '__ci_last_regenerate|i:1614344308;cszblogin_cururl|s:43:\"http://webdukes.in/doca/admin/grant/edit/15\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('21503ed29ddfd47c2768193f3c65afcfdd1436a8', '119.42.59.246', 1614344309, '__ci_last_regenerate|i:1614344308;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('1b525d44c4b99d595cea54229cb2ccd33e3f14f6', '103.31.145.70', 1614344317, '__ci_last_regenerate|i:1614344317;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('a77d4c4a6de20ec9bb839606c2f196737824a8b3', '119.42.59.246', 1614344319, '__ci_last_regenerate|i:1614344318;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('bdebb30d3b49e9a4d5a0cc43ed0b2022f8604ad5', '119.42.59.246', 1614344338, '__ci_last_regenerate|i:1614344338;cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('d748a39f79eb52d0e6e4ccf454f3808e89095223', '119.42.59.246', 1614344339, '__ci_last_regenerate|i:1614344339;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('67b48177fd3446af2b01b247bf627113fb84cb91', '119.42.59.246', 1614344355, '__ci_last_regenerate|i:1614344354;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('754b8ff2b3c62d838ab4e61bac569555753d896e', '119.42.59.246', 1614344366, '__ci_last_regenerate|i:1614344365;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('0da6448ea9beff348825f83e8e3668cbdb63a44e', '119.42.59.246', 1614344393, '__ci_last_regenerate|i:1614344393;fronlang_iso|s:2:\"en\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('eea4cdfc51b87757779611d587406cd5cb9dc89c', '119.42.59.246', 1614344400, '__ci_last_regenerate|i:1614344400;fronlang_iso|s:2:\"en\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('79358be84855606a258209f65c17c29faf814492', '119.42.59.246', 1614344400, '__ci_last_regenerate|i:1614344400;fronlang_iso|s:2:\"en\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('c432b50bccff0f2a5b3013710445de3c8532fdd5', '119.42.59.246', 1614344401, '__ci_last_regenerate|i:1614344401;fronlang_iso|s:2:\"en\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('534beb09aefbf0d70f18c47f0ec38ac4f7f1f22a', '119.42.59.246', 1614344407, '__ci_last_regenerate|i:1614344407;cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('8d8c328bf5626149eb950674af68ab22a70f0954', '119.42.59.246', 1614344407, '__ci_last_regenerate|i:1614344407;cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('460239f875e7b33af4c1875b2638756cba2063e8', '119.42.59.246', 1614344409, '__ci_last_regenerate|i:1614344409;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6d33aae14f02304441e97753f8c24f09bb33a34e', '119.42.59.246', 1614344420, '__ci_last_regenerate|i:1614344419;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('109b947f40f19ced1c2a8550f64f6f94d99685fd', '119.42.59.246', 1614344439, '__ci_last_regenerate|i:1614344439;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('1fd878f336ba9001aee83c8b9a01e7fc98c01e30', '119.42.59.246', 1614344487, '__ci_last_regenerate|i:1614344487;fronlang_iso|s:2:\"en\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('0ae7e83acf3e861420914a606308fa5c9f5b11b8', '103.28.252.164', 1614403534, '__ci_last_regenerate|i:1614403532;fronlang_iso|s:2:\"en\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('aaa003a67c90ee42941bdcd341a07445d9e11bcd', '103.28.252.164', 1614403545, '__ci_last_regenerate|i:1614403545;fronlang_iso|s:2:\"en\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('9fb2160f840a6ec2c3004f3701f146dbc0ce2b51', '103.28.252.164', 1614403556, '__ci_last_regenerate|i:1614403556;cszblogin_cururl|s:33:\"http://www.webdukes.in/doca/admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('c9fe9074ffd4ddf3ee0026ea51446fc7b625a3a4', '103.28.252.164', 1614403558, '__ci_last_regenerate|i:1614403558;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('88f99de21bac0797b7360fea79d057409fde243b', '103.28.252.164', 1614403568, '__ci_last_regenerate|i:1614403567;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('d9fb00dbe55a4ff79aa56536564a5a1150510366', '103.28.252.164', 1614403571, '__ci_last_regenerate|i:1614403571;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('f540db185e07ab3f335cf514a33d96688c10d8e2', '103.28.252.164', 1614403603, '__ci_last_regenerate|i:1614403603;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b04e7be3b55c2590c75370b9d48aadb270e509e0', '103.28.252.164', 1614403613, '__ci_last_regenerate|i:1614403613;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('73f3f2b3aec39cc0d644db624ff8a1a43b342b27', '103.28.252.164', 1614403633, '__ci_last_regenerate|i:1614403633;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('9c4a2bb5e434f8abeff13ae714f476b67aeeebcc', '103.28.252.164', 1614403644, '__ci_last_regenerate|i:1614403644;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('4feb3eb9e58ef3cbde4df56b992f08e32ebeb14b', '103.28.252.164', 1614403894, '__ci_last_regenerate|i:1614403835;fronlang_iso|s:2:\"en\";cszblogin_cururl|s:29:\"http://webdukes.in/doca/admin\";admin_logged_in|b:1;user_admin_id|s:1:\"1\";admin_name|s:10:\"Admin User\";admin_email|s:17:\"info@webdukes.com\";admin_type|s:5:\"admin\";pwd_change|s:1:\"1\";session_id|s:40:\"4feb3eb9e58ef3cbde4df56b992f08e32ebeb14b\";user_agent|s:137:\"Mozilla/5.0 (iPhone; CPU iPhone OS 14_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0.3 Mobile/15E148 Safari/604.1\";referred_index|s:29:\"http://webdukes.in/doca/admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('76692dd0aef2c853e9daa3f5eecd51e6bdbcce1d', '103.28.252.164', 1614404604, '__ci_last_regenerate|i:1614404604;cszblogin_cururl|s:31:\"https://webdukes.in/doca/admin/\";admin_logged_in|b:1;user_admin_id|s:1:\"1\";admin_name|s:10:\"Admin User\";admin_email|s:17:\"info@webdukes.com\";admin_type|s:5:\"admin\";pwd_change|s:1:\"1\";session_id|s:40:\"76692dd0aef2c853e9daa3f5eecd51e6bdbcce1d\";user_agent|s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36\";referred_index|s:30:\"https://webdukes.in/doca/admin\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('648ca3f7b0b5757d6d23cdd48839996e6fd860ac', '103.28.252.164', 1614404151, '__ci_last_regenerate|i:1614404151;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('18b50deb30c95e43355e41f6d5c4407ff7cc3676', '103.28.252.164', 1614404799, '__ci_last_regenerate|i:1614404604;cszblogin_cururl|s:31:\"https://webdukes.in/doca/admin/\";admin_logged_in|b:1;user_admin_id|s:1:\"1\";admin_name|s:10:\"Admin User\";admin_email|s:17:\"info@webdukes.com\";admin_type|s:5:\"admin\";pwd_change|s:1:\"1\";session_id|s:40:\"76692dd0aef2c853e9daa3f5eecd51e6bdbcce1d\";user_agent|s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36\";referred_index|s:38:\"https://webdukes.in/doca/admin/upgrade\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('9fec15b7d2283db0cd8b4757659a5d79bc80feb3', '49.44.86.74', 1614404802, '__ci_last_regenerate|i:1614404795;cszblogin_cururl|s:38:\"https://webdukes.in/doca/admin/upgrade\";');


#
# TABLE STRUCTURE FOR: email_logs
#

DROP TABLE IF EXISTS `email_logs`;

CREATE TABLE `email_logs` (
  `email_logs_id` int(11) NOT NULL AUTO_INCREMENT,
  `to_email` varchar(255) DEFAULT NULL,
  `from_email` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `email_result` text,
  `user_agent` varchar(255) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  PRIMARY KEY (`email_logs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: footer_social
#

DROP TABLE IF EXISTS `footer_social`;

CREATE TABLE `footer_social` (
  `footer_social_id` int(11) NOT NULL AUTO_INCREMENT,
  `social_name` varchar(255) DEFAULT NULL,
  `social_url` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`footer_social_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (1, 'twitter', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (2, 'facebook', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (3, 'linkedin', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (4, 'youtube', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (5, 'google', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (6, 'pinterest', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (7, 'foursquare', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (8, 'myspace', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (9, 'soundcloud', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (10, 'spotify', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (11, 'lastfm', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (12, 'vimeo', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (13, 'dailymotion', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (14, 'vine', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (15, 'flickr', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (16, 'instagram', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (17, 'tumblr', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (18, 'reddit', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (19, 'envato', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (20, 'github', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (21, 'tripadvisor', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (22, 'stackoverflow', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (23, 'persona', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (24, 'odnoklassniki', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (25, 'vk', '', 0, '2016-05-06 15:50:59');
INSERT INTO `footer_social` (`footer_social_id`, `social_name`, `social_url`, `active`, `timestamp_update`) VALUES (26, 'gitlab', '', 0, '2016-05-06 15:50:59');


#
# TABLE STRUCTURE FOR: form_contactus_en
#

DROP TABLE IF EXISTS `form_contactus_en`;

CREATE TABLE `form_contactus_en` (
  `form_contactus_en_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_type` varchar(255) DEFAULT NULL,
  `message` text,
  `ip_address` varchar(255) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  PRIMARY KEY (`form_contactus_en_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: form_field
#

DROP TABLE IF EXISTS `form_field`;

CREATE TABLE `form_field` (
  `form_field_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_main_id` int(11) DEFAULT NULL,
  `field_type` varchar(100) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `field_id` varchar(255) DEFAULT NULL,
  `field_class` varchar(255) DEFAULT NULL,
  `field_placeholder` varchar(255) DEFAULT NULL,
  `field_value` varchar(255) DEFAULT NULL,
  `field_label` varchar(255) DEFAULT NULL,
  `sel_option_val` text,
  `field_required` int(11) DEFAULT NULL,
  `field_div_class` varchar(255) DEFAULT NULL,
  `arrange` int(11) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`form_field_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `form_field` (`form_field_id`, `form_main_id`, `field_type`, `field_name`, `field_id`, `field_class`, `field_placeholder`, `field_value`, `field_label`, `sel_option_val`, `field_required`, `field_div_class`, `arrange`, `timestamp_create`, `timestamp_update`) VALUES (1, 1, 'text', 'name', 'name', 'form-control', '', '', 'Name', '', 1, NULL, 1, '2016-05-02 19:15:50', '2016-05-02 19:15:50');
INSERT INTO `form_field` (`form_field_id`, `form_main_id`, `field_type`, `field_name`, `field_id`, `field_class`, `field_placeholder`, `field_value`, `field_label`, `sel_option_val`, `field_required`, `field_div_class`, `arrange`, `timestamp_create`, `timestamp_update`) VALUES (2, 1, 'email', 'email', 'email', 'form-control', '', '', 'Email Address', '', 1, NULL, 2, '2016-05-02 19:15:50', '2016-05-02 19:15:50');
INSERT INTO `form_field` (`form_field_id`, `form_main_id`, `field_type`, `field_name`, `field_id`, `field_class`, `field_placeholder`, `field_value`, `field_label`, `sel_option_val`, `field_required`, `field_div_class`, `arrange`, `timestamp_create`, `timestamp_update`) VALUES (3, 1, 'selectbox', 'contact_type', 'contact_type', 'form-control', '-- Choose Type --', '', 'Contact Type', 'question=>Question, contact us=>Contact Us, service=>Service', 1, NULL, 3, '2016-05-02 19:15:50', '2016-05-02 19:15:50');
INSERT INTO `form_field` (`form_field_id`, `form_main_id`, `field_type`, `field_name`, `field_id`, `field_class`, `field_placeholder`, `field_value`, `field_label`, `sel_option_val`, `field_required`, `field_div_class`, `arrange`, `timestamp_create`, `timestamp_update`) VALUES (4, 1, 'textarea', 'message', 'message', 'form-control', '', '', 'Message', '', 1, NULL, 4, '2016-05-02 19:15:50', '2016-05-02 19:15:50');
INSERT INTO `form_field` (`form_field_id`, `form_main_id`, `field_type`, `field_name`, `field_id`, `field_class`, `field_placeholder`, `field_value`, `field_label`, `sel_option_val`, `field_required`, `field_div_class`, `arrange`, `timestamp_create`, `timestamp_update`) VALUES (5, 1, 'submit', 'submit', 'submit', 'btn btn-primary', '', 'Send now', '', '', 0, NULL, 5, '2016-05-02 19:15:50', '2016-05-02 19:15:50');
INSERT INTO `form_field` (`form_field_id`, `form_main_id`, `field_type`, `field_name`, `field_id`, `field_class`, `field_placeholder`, `field_value`, `field_label`, `sel_option_val`, `field_required`, `field_div_class`, `arrange`, `timestamp_create`, `timestamp_update`) VALUES (6, 1, 'reset', 'reset', 'reset', 'btn btn-default', '', 'Reset', '', '', 0, NULL, 6, '2016-05-02 19:15:50', '2016-05-02 19:15:50');


#
# TABLE STRUCTURE FOR: form_main
#

DROP TABLE IF EXISTS `form_main`;

CREATE TABLE `form_main` (
  `form_main_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(255) DEFAULT NULL,
  `form_enctype` varchar(255) DEFAULT NULL,
  `form_method` varchar(255) DEFAULT NULL,
  `success_txt` varchar(255) DEFAULT NULL,
  `captchaerror_txt` varchar(255) DEFAULT NULL,
  `error_txt` varchar(255) DEFAULT NULL,
  `sendmail` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `send_to_visitor` int(11) DEFAULT NULL,
  `email_field_id` int(11) DEFAULT NULL,
  `visitor_subject` varchar(255) DEFAULT NULL,
  `visitor_body` text,
  `active` int(11) DEFAULT NULL,
  `captcha` int(11) DEFAULT NULL,
  `save_to_db` int(11) DEFAULT NULL,
  `dont_repeat_field` varchar(255) DEFAULT NULL,
  `repeat_txt` varchar(255) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`form_main_id`),
  KEY `form_name` (`form_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `form_main` (`form_main_id`, `form_name`, `form_enctype`, `form_method`, `success_txt`, `captchaerror_txt`, `error_txt`, `sendmail`, `email`, `subject`, `send_to_visitor`, `email_field_id`, `visitor_subject`, `visitor_body`, `active`, `captcha`, `save_to_db`, `dont_repeat_field`, `repeat_txt`, `timestamp_create`, `timestamp_update`) VALUES (1, 'contactus_en', '', 'post', 'Successfully!', 'The Security Check was not input correctly. Please try again.', 'Error! Please try again.', 1, '', 'Contact us from the CSZ-CMS website', 0, 0, '', '', 1, 1, 1, '', 'Your data is duplicated in the system.', '2021-02-25 02:05:30', '2021-02-25 02:05:30');


#
# TABLE STRUCTURE FOR: gallery_config
#

DROP TABLE IF EXISTS `gallery_config`;

CREATE TABLE `gallery_config` (
  `gallery_config_id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_sort` varchar(255) DEFAULT NULL,
  `user_admin_id` int(11) DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`gallery_config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `gallery_config` (`gallery_config_id`, `gallery_sort`, `user_admin_id`, `timestamp_update`) VALUES (1, 'manually', 1, '2021-02-25 02:05:31');


#
# TABLE STRUCTURE FOR: gallery_db
#

DROP TABLE IF EXISTS `gallery_db`;

CREATE TABLE `gallery_db` (
  `gallery_db_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_name` varchar(255) DEFAULT NULL,
  `url_rewrite` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `short_desc` text,
  `lang_iso` varchar(10) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `arrange` int(11) DEFAULT NULL,
  `user_groups_idS` text,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`gallery_db_id`),
  KEY `url_rewrite` (`url_rewrite`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: gallery_picture
#

DROP TABLE IF EXISTS `gallery_picture`;

CREATE TABLE `gallery_picture` (
  `gallery_picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_db_id` int(11) DEFAULT NULL,
  `file_upload` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `arrange` int(11) DEFAULT NULL,
  `gallery_type` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`gallery_picture_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: general_label
#

DROP TABLE IF EXISTS `general_label`;

CREATE TABLE `general_label` (
  `general_label_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `remark` text,
  `lang_en` text,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`general_label_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (1, 'login_heading', 'For member login Header text', 'Member Login', '2016-07-04 11:43:18');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (2, 'login_incorrect', 'For member login incorrect', 'Email address/Password is incorrect', '2016-07-04 11:44:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (3, 'captcha_wrong', 'For member login when wrong captcha', 'The Security Check was not input correctly. Please try again.', '2016-07-04 11:44:39');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (4, 'login_email', 'For email address label', 'Email Address', '2016-06-23 23:34:45');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (5, 'login_password', 'For password label', 'Your Password', '2016-06-23 23:35:22');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (6, 'login_signin', 'For member login button', 'Log in', '2016-06-23 23:35:53');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (7, 'login_forgetpwd', 'For member forget password button', 'Forgot Password', '2016-06-23 23:37:02');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (8, 'login_register', 'For member register label', 'Register', '2016-06-24 16:41:07');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (9, 'member_firstname', 'For member firstname label', 'First Name', '2016-06-24 16:58:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (10, 'member_lastname', 'For member lastname label', 'Last Name', '2016-06-24 16:58:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (11, 'member_address', 'For member address label', 'Address', '2016-06-24 16:58:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (12, 'confirm_password', 'For confirm password label', 'Confirm Password', '2016-06-24 16:58:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (13, 'member_forgot_complete', 'For forget password is successfully', 'Successfully! Your password has been reset', '2016-06-24 16:58:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (14, 'member_reset_btn', 'For reset button', 'Reset', '2016-06-24 17:48:32');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (15, 'member_forget_chkmail', 'For reset text email to inbox', 'Please check your email inbox and click the link to continue the process.', '2016-06-24 17:48:32');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (16, 'email_reset_subject', 'For email subject when member forget password', 'Reset your member password', '2016-06-26 15:43:39');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (17, 'email_reset_message', 'For email message when member forget password', 'Please click the link within 30 minutes to reset your password.', '2016-06-26 15:43:39');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (18, 'email_dear', 'For email header', 'Dear ', '2016-06-26 15:43:39');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (19, 'email_footer', 'For email footer', 'Regards,', '2016-06-26 15:43:39');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (20, 'email_check', 'For email does not exist text', 'This email address does not exist', '2016-06-26 15:47:01');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (21, 'btn_cancel', 'For cancel button', 'Cancel', '2016-06-26 15:52:28');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (22, 'btn_back', 'For back button', 'Back', '2016-06-26 15:53:59');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (23, 'email_already', 'For email has already', 'This email address has already', '2016-06-26 21:31:20');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (24, 'email_confirm_subject', 'For email confirm subject text', 'Confirm your member register', '2016-06-27 18:00:10');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (25, 'email_confirm_message', 'For email confirm message', 'Please click the link within 30 minutes to confirm your member.', '2016-06-28 10:28:20');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (26, 'log_out', 'For log out text', 'Log out', '2016-07-01 16:25:24');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (27, 'backend_system', 'For back-end system text', 'Admin System', '2016-07-01 16:25:24');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (28, 'edit_profile', 'For edit profile text', 'Edit Profile', '2016-07-01 16:25:24');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (29, 'member_dashboard_text', 'For member dashboard text', 'Welcome to Member Dashboard!', '2016-07-01 16:25:24');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (30, 'your_profile', 'For your profile text', 'Your Profile', '2016-07-01 16:29:30');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (31, 'member_menu', 'For member menu text', 'Member Menu', '2016-07-01 16:37:37');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (32, 'display_name', 'For display name text', 'Display Name', '2016-07-01 16:45:41');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (33, 'email_address', 'For email address text', 'Email Address', '2016-07-01 16:45:41');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (34, 'user_type', 'For permission type text', 'Permission Type', '2016-07-01 16:45:41');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (35, 'first_name', 'For first name text', 'First Name', '2016-07-01 16:45:41');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (36, 'last_name', 'For last name text', 'Last Name', '2016-07-01 16:45:41');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (37, 'birthday', 'For birthday text', 'Birth Day', '2016-07-01 16:45:41');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (38, 'gender', 'For gender text', 'Gender', '2016-07-01 16:45:41');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (39, 'phone', 'For phone text', 'Phone', '2016-07-01 16:45:41');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (40, 'address', 'For address text', 'Address', '2016-07-01 16:45:41');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (41, 'new_password', 'For new password text', 'New Password', '2016-07-02 18:01:57');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (42, 'change_password', 'For change password text', 'Change Password', '2016-07-02 18:04:49');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (43, 'picture', 'For picture text', 'Picture', '2016-07-02 18:18:58');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (44, 'save_btn', 'For save button text', 'Save', '2016-07-02 18:35:11');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (45, 'cancel_btn', 'For cancel button text', 'Cancel', '2016-07-02 18:35:11');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (46, 'article_index_header', 'For article index page', 'List of Article', '2016-07-12 17:08:16');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (47, 'article_category_menu', 'For category of article text', 'Category', '2016-07-12 17:23:40');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (48, 'article_readmore_text', 'For read more button of article text', 'Read More', '2016-07-12 17:23:40');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (49, 'article_not_found', 'For article not found text', 'Article not found!', '2016-07-12 17:33:20');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (50, 'article_cat_not_found', 'For category of article not found text', 'Category not found!', '2016-07-12 17:54:29');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (51, 'article_postdate', 'For date time of article text', 'Posted date', '2016-07-13 13:56:02');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (52, 'article_postby', 'For post by text', 'Posted by', '2016-07-13 13:56:02');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (53, 'gallery_header', 'For gallery header text', 'Gallery', '2016-07-15 13:47:17');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (54, 'gallery_albumlist', 'For album list text', 'List of Album', '2016-07-15 13:47:17');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (55, 'total_txt', 'For total text', 'Total:', '2016-07-15 15:24:11');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (56, 'records_txt', 'For records text', 'Records', '2016-07-15 15:23:54');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (57, 'gallery_not_found', 'for gallery not found text', 'Gallery not found!', '2016-07-15 15:33:35');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (58, 'picture_not_found', 'For picture not found text', 'Picture not found!', '2016-07-15 15:35:40');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (59, 'gellery_view_btn', 'For gallery view button', 'View Gallery', '2016-07-15 15:41:19');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (60, 'article_archive', 'For article archive text', 'Archive', '2016-07-21 10:39:19');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (61, 'article_updatedate', 'For article updatetime text', 'Updated date', '2016-07-21 10:39:19');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (62, 'article_search_txt', 'For article search text', 'Article Search', '2016-09-26 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (63, 'pm_txt', 'For private message header text', 'Private Message', '2017-02-27 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (64, 'pm_to_txt', 'For private message (To) text', 'To', '2017-02-27 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (65, 'pm_from_txt', 'For private message (From) text', 'From', '2017-02-27 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (66, 'pm_subject_txt', 'For private message subject text', 'Subject', '2017-02-27 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (67, 'pm_msg_txt', 'For private message text', 'Message', '2017-02-27 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (68, 'pm_send_txt', 'For private message send text', 'Send', '2017-02-27 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (69, 'pm_delete_txt', 'For private message delete text', 'Delete', '2017-02-27 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (70, 'pm_inbox_txt', 'For private message inbox text', 'Inbox', '2017-02-27 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (71, 'pm_newmsg_txt', 'For private message new message text', 'New Message', '2017-02-27 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (72, 'users_list_txt', 'For users list text', 'Users List', '2017-02-28 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (73, 'pm_datetime_txt', 'For date time text', 'Date/Time', '2017-02-28 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (74, 'not_permission_txt', 'For not have permission text', 'You might not have permission to access this section!', '2017-02-28 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (75, 'success_txt', 'For success text', 'Successfully!', '2017-03-02 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (76, 'error_txt', 'For error text', 'Data not found! / Error! Please try again.', '2017-03-02 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (77, 'plugin_member_menu', 'For plugin member menu text', 'Plugins Menu', '2017-03-02 10:53:09');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (78, 'article_filedownload_text', 'For file download label', 'File Download', '2021-02-25 02:05:30');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (79, 'article_download_link', 'For download label', 'Download', '2021-02-25 02:05:30');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (80, 'form_doublesubmit_alert', 'For form double submit alert text', 'The form is being submitted, please wait a moment...', '2021-02-25 02:05:30');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (81, 'form_submiting_btn', 'For form button been submitting text', 'Processing, Please wait...', '2021-02-25 02:05:30');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (82, 'site_error_404_title', 'For page not found error 404 title', 'Error 404, The requested page not Found!', '2021-02-25 02:05:30');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (83, 'site_error_404_text', 'For page not found error 404 text', 'Sorry! The page is broken or the page has been moved. Please back to home page.', '2021-02-25 02:05:30');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (84, 'site_maintenance_title', 'For site maintenance title', 'Maintenance!', '2021-02-25 02:05:30');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (85, 'site_maintenance_subtitle', 'For site maintenance sub title', 'We are undergoing a bit of scheduled maintenance.', '2021-02-25 02:05:30');
INSERT INTO `general_label` (`general_label_id`, `name`, `remark`, `lang_en`, `timestamp_update`) VALUES (86, 'site_maintenance_text', 'For site maintenance body text', 'Sorry for the inconvenience and will be back online shortly. Please check back soon.', '2021-02-25 02:05:30');


#
# TABLE STRUCTURE FOR: grant
#

DROP TABLE IF EXISTS `grant`;

CREATE TABLE `grant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `eligibility` text NOT NULL,
  `description` text NOT NULL,
  `grant_type` int(11) NOT NULL,
  `image` varchar(40) NOT NULL,
  `addon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO `grant` (`id`, `title`, `eligibility`, `description`, `grant_type`, `image`, `addon`, `active`) VALUES (11, 'ICAG Professional Qualification Examination  - Level 1 ', '', 'Are you now starting your journey to become a Business Leader? \r\n\r\nThen you are welcome ', 0, '', '2020-09-01 04:48:06', 1);
INSERT INTO `grant` (`id`, `title`, `eligibility`, `description`, `grant_type`, `image`, `addon`, `active`) VALUES (12, 'ICAG Professional Qualification Examination  - Level 2', '', 'Whether you are coming from level one or now starting with your first degree, MBA or MSc. We have you covered. ', 0, '', '2020-09-01 04:47:49', 1);
INSERT INTO `grant` (`id`, `title`, `eligibility`, `description`, `grant_type`, `image`, `addon`, `active`) VALUES (13, 'ICAG Professional Qualification Examination  - Level 3', '', 'Now that you are getting ready to become a Business Leader, let\'s assist you ', 0, '', '2020-09-01 04:47:27', 1);
INSERT INTO `grant` (`id`, `title`, `eligibility`, `description`, `grant_type`, `image`, `addon`, `active`) VALUES (14, 'ICAG Professional Qualification Examination  - MASTERCLASS ', '', 'Want to focus on specific topics of the syllabus?  \r\n\r\nWe have courses just for that. ', 0, '', '2020-09-01 04:47:10', 1);
INSERT INTO `grant` (`id`, `title`, `eligibility`, `description`, `grant_type`, `image`, `addon`, `active`) VALUES (15, 'ICAG Professional Qualification Examination  - Practice Questions Bank ', '', 'Are you looking for Practice Questions on specific subjects? \r\n\r\nCheck these ', 0, '2021/1614339985_1-org.png', '2021-02-26 05:46:25', 1);


#
# TABLE STRUCTURE FOR: lang_iso
#

DROP TABLE IF EXISTS `lang_iso`;

CREATE TABLE `lang_iso` (
  `lang_iso_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(255) DEFAULT NULL,
  `lang_iso` varchar(10) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `country_iso` varchar(10) DEFAULT NULL,
  `active` int(2) DEFAULT NULL,
  `arrange` int(11) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`lang_iso_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Language ISO';

INSERT INTO `lang_iso` (`lang_iso_id`, `lang_name`, `lang_iso`, `country`, `country_iso`, `active`, `arrange`, `timestamp_create`, `timestamp_update`) VALUES (1, 'English', 'en', 'United Kingdom', 'gb', 1, 1, '2016-03-29 15:16:23', '2016-03-31 15:28:58');


#
# TABLE STRUCTURE FOR: link_stat_mgt
#

DROP TABLE IF EXISTS `link_stat_mgt`;

CREATE TABLE `link_stat_mgt` (
  `link_stat_mgt_id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  PRIMARY KEY (`link_stat_mgt_id`),
  KEY `url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: link_statistic
#

DROP TABLE IF EXISTS `link_statistic`;

CREATE TABLE `link_statistic` (
  `link_statistic_id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  PRIMARY KEY (`link_statistic_id`),
  KEY `link` (`link`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: login_logs
#

DROP TABLE IF EXISTS `login_logs`;

CREATE TABLE `login_logs` (
  `login_logs_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_login` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `note` text,
  `result` varchar(255) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  PRIMARY KEY (`login_logs_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (1, 'info@webdukes.com', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36', '119.42.59.120', 'Backend Login Successful!', 'SUCCESS', '2021-02-25 17:35:29');
INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (2, 'info@webdukes.com', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '119.42.59.246', 'Backend Login Successful!', 'SUCCESS', '2021-02-26 16:46:38');
INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (3, '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '119.42.59.246', 'CSRF Protection Invalid', 'CSRF_INVALID', '2021-02-26 18:28:35');
INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (4, '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '119.42.59.246', 'CSRF Protection Invalid', 'CSRF_INVALID', '2021-02-26 18:28:35');
INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (5, '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '119.42.59.246', 'CSRF Protection Invalid', 'CSRF_INVALID', '2021-02-26 18:28:49');
INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (6, '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '119.42.59.246', 'CSRF Protection Invalid', 'CSRF_INVALID', '2021-02-26 18:29:02');
INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (7, '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '119.42.59.246', 'CSRF Protection Invalid', 'CSRF_INVALID', '2021-02-26 18:29:12');
INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (8, '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '119.42.59.246', 'CSRF Protection Invalid', 'CSRF_INVALID', '2021-02-26 18:30:17');
INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (9, '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '103.28.252.164', 'CSRF Protection Invalid', 'CSRF_INVALID', '2021-02-27 10:56:03');
INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (10, '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '103.28.252.164', 'CSRF Protection Invalid', 'CSRF_INVALID', '2021-02-27 10:56:50');
INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (11, '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '103.28.252.164', 'CSRF Protection Invalid', 'CSRF_INVALID', '2021-02-27 10:57:10');
INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (12, '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '103.28.252.164', 'CSRF Protection Invalid', 'CSRF_INVALID', '2021-02-27 10:57:20');
INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (13, 'info@webdukes.com', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0.3 Mobile/15E148 Safari/604.1', '103.28.252.164', 'Backend Login Successful!', 'SUCCESS', '2021-02-27 11:01:32');
INSERT INTO `login_logs` (`login_logs_id`, `email_login`, `user_agent`, `ip_address`, `note`, `result`, `timestamp_create`) VALUES (14, 'info@webdukes.com', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36', '103.28.252.164', 'Backend Login Successful!', 'SUCCESS', '2021-02-27 11:08:28');


#
# TABLE STRUCTURE FOR: login_security_config
#

DROP TABLE IF EXISTS `login_security_config`;

CREATE TABLE `login_security_config` (
  `login_security_config_id` int(11) NOT NULL AUTO_INCREMENT,
  `bf_protect_period` int(11) DEFAULT NULL,
  `max_failure` int(11) DEFAULT NULL,
  `bf_private_key` varchar(255) DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`login_security_config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `login_security_config` (`login_security_config_id`, `bf_protect_period`, `max_failure`, `bf_private_key`, `timestamp_update`) VALUES (1, 60, 20, '', '2021-02-25 02:05:31');


#
# TABLE STRUCTURE FOR: page_menu
#

DROP TABLE IF EXISTS `page_menu`;

CREATE TABLE `page_menu` (
  `page_menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) DEFAULT NULL,
  `lang_iso` varchar(10) DEFAULT NULL,
  `pages_id` int(11) DEFAULT NULL,
  `other_link` varchar(512) DEFAULT NULL,
  `plugin_menu` varchar(255) DEFAULT NULL,
  `drop_menu` int(11) DEFAULT NULL,
  `drop_page_menu_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `new_windows` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `arrange` int(11) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`page_menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `page_menu` (`page_menu_id`, `menu_name`, `lang_iso`, `pages_id`, `other_link`, `plugin_menu`, `drop_menu`, `drop_page_menu_id`, `position`, `new_windows`, `active`, `arrange`, `timestamp_create`, `timestamp_update`) VALUES (1, 'Home', 'en', 1, '', '', 0, 0, 0, 0, 1, 1, '2016-03-25 13:00:08', '2016-04-30 16:58:07');
INSERT INTO `page_menu` (`page_menu_id`, `menu_name`, `lang_iso`, `pages_id`, `other_link`, `plugin_menu`, `drop_menu`, `drop_page_menu_id`, `position`, `new_windows`, `active`, `arrange`, `timestamp_create`, `timestamp_update`) VALUES (2, 'Abouts Us', 'en', 2, '', '', 0, 0, 0, 0, 1, 2, '2016-04-11 15:01:03', '2016-04-30 16:58:07');
INSERT INTO `page_menu` (`page_menu_id`, `menu_name`, `lang_iso`, `pages_id`, `other_link`, `plugin_menu`, `drop_menu`, `drop_page_menu_id`, `position`, `new_windows`, `active`, `arrange`, `timestamp_create`, `timestamp_update`) VALUES (3, 'Contact Us', 'en', 3, '', '', 0, 0, 0, 0, 1, 3, '2016-04-30 16:58:02', '2016-04-30 16:58:07');
INSERT INTO `page_menu` (`page_menu_id`, `menu_name`, `lang_iso`, `pages_id`, `other_link`, `plugin_menu`, `drop_menu`, `drop_page_menu_id`, `position`, `new_windows`, `active`, `arrange`, `timestamp_create`, `timestamp_update`) VALUES (4, 'Drop Menu', 'en', 0, '', '', 1, 0, 0, 0, 1, 4, '2016-03-27 15:54:15', '2016-04-30 16:58:07');
INSERT INTO `page_menu` (`page_menu_id`, `menu_name`, `lang_iso`, `pages_id`, `other_link`, `plugin_menu`, `drop_menu`, `drop_page_menu_id`, `position`, `new_windows`, `active`, `arrange`, `timestamp_create`, `timestamp_update`) VALUES (5, 'CSZ CMS Website', 'en', 0, 'https://www.cszcms.com', '', 0, 4, 0, 1, 1, 1, '2016-03-28 15:22:12', '2016-04-30 16:58:07');


#
# TABLE STRUCTURE FOR: pages
#

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `pages_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) DEFAULT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `lang_iso` varchar(10) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `page_keywords` varchar(255) DEFAULT NULL,
  `page_desc` text,
  `content` text,
  `more_metatag` text,
  `custom_css` text,
  `custom_js` text,
  `user_groups_idS` text,
  `active` int(11) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`pages_id`),
  KEY `page_url` (`page_url`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `pages` (`pages_id`, `page_name`, `page_url`, `lang_iso`, `page_title`, `page_keywords`, `page_desc`, `content`, `more_metatag`, `custom_css`, `custom_js`, `user_groups_idS`, `active`, `timestamp_create`, `timestamp_update`) VALUES (1, 'Home', 'home', 'en', 'CSZ Home', 'CMS, Contact Management System, HTML, CSS, JS, JavaScript, framework, bootstrap, web development, thai, english, homepage', 'CSKAZA Template for Bootstrap with CSZ-CMS', '<header>[?]{=carousel:1}[?]</header><!-- Start Jumbotron -->\r\n<div class=\"jumbotron\">\r\n<div class=\"container\">\r\n<h1>Hello, world!</h1>\r\n<p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>\r\n<p><a class=\"btn btn-primary btn-lg\" href=\"#\" role=\"button\">Learn more »</a></p>\r\n</div>\r\n</div>\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-md-4\">\r\n<h2>Heading</h2>\r\n<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>\r\n<p><a class=\"btn btn-default\" href=\"#\" role=\"button\">View details »</a></p>\r\n</div>\r\n<div class=\"col-md-4\">\r\n<h2>Heading</h2>\r\n<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>\r\n<p><a class=\"btn btn-default\" href=\"#\" role=\"button\">View details »</a></p>\r\n</div>\r\n<div class=\"col-md-4\">\r\n<h2>Heading</h2>\r\n<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>\r\n<p><a class=\"btn btn-default\" href=\"#\" role=\"button\">View details »</a></p>\r\n</div>\r\n</div>\r\n</div>\r\n', NULL, '', '', NULL, 1, '2016-03-08 10:12:56', '2016-05-09 11:00:51');
INSERT INTO `pages` (`pages_id`, `page_name`, `page_url`, `lang_iso`, `page_title`, `page_keywords`, `page_desc`, `content`, `more_metatag`, `custom_css`, `custom_js`, `user_groups_idS`, `active`, `timestamp_create`, `timestamp_update`) VALUES (2, 'Abouts Us', 'abouts-us', 'en', 'CSZ-CMS About Us', 'CMS, Contact Management System, HTML, CSS, JS, JavaScript, framework, bootstrap, web development, thai, aboutus', 'CSKAZA Template for Bootstrap with CSZ-CMS', '<div class=\"jumbotron\">\r\n<div class=\"container\">\r\n<h1>About Us!</h1>\r\n<p>CSKAZA Template for Bootstrap with CSZ-CMS. CSZ-CMS build by CSKAZA.</p>\r\n<p><a class=\"btn btn-primary btn-lg\" href=\"#\" role=\"button\">Learn more »</a></p>\r\n</div>\r\n</div>\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-md-6\">\r\n<div class=\"panel panel-default\">\r\n<div class=\"panel-heading\">Panel heading</div>\r\n<div class=\"panel-body\">\r\n<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-md-6\">\r\n<div class=\"panel panel-default\">\r\n<div class=\"panel-heading\">Panel heading</div>\r\n<div class=\"panel-body\">\r\n<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"container\"></div>\r\n<p></p>', NULL, '', '', NULL, 1, '2016-04-11 15:17:18', '2016-05-01 15:16:13');
INSERT INTO `pages` (`pages_id`, `page_name`, `page_url`, `lang_iso`, `page_title`, `page_keywords`, `page_desc`, `content`, `more_metatag`, `custom_css`, `custom_js`, `user_groups_idS`, `active`, `timestamp_create`, `timestamp_update`) VALUES (3, 'Contact Us', 'contact-us', 'en', 'CSZ-CMS Contact us', 'CMS, Contact Management System, HTML, CSS, JS, JavaScript, framework, bootstrap, web development, thai, contact us', 'CSKAZA Template for Bootstrap with CSZ-CMS', '<div class=\"jumbotron\">\r\n<div class=\"container\">\r\n<h1>Contact us!</h1>\r\n<p>If you want to contact us please use this form below. Or send the email to <a href=\"mailto:info@cszcms.com\">info[at]cszcms.com</a></p>\r\n</div>\r\n</div>\r\n<div class=\"container\"></div>\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-md-6\">\r\n<h2>Google Map</h2>\r\n<p><iframe width=\"100%\" height=\"315\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.168282092751!2d98.37285931425068!3d7.877454308128998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0:0x0!2zN8KwNTInMzguOCJOIDk4wrAyMiczMC4yIkU!5e0!3m2!1sen!2sth!4v1462104596003\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\"></iframe></p>\r\n</div>\r\n<div class=\"col-md-6\">\r\n<h2>Contact Form</h2>\r\n<p>If you have any question please send this from.</p>\r\n<p>[?]{=forms:contactus_en}[?]</p>\r\n</div>\r\n</div>\r\n</div>\r\n<p></p>\r\n<p></p>', NULL, '', '', NULL, 1, '2016-04-30 16:57:16', '2016-05-12 17:59:41');


#
# TABLE STRUCTURE FOR: plugin_manager
#

DROP TABLE IF EXISTS `plugin_manager`;

CREATE TABLE `plugin_manager` (
  `plugin_manager_id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_config_filename` varchar(255) DEFAULT NULL,
  `plugin_active` int(11) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`plugin_manager_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `plugin_manager` (`plugin_manager_id`, `plugin_config_filename`, `plugin_active`, `timestamp_create`, `timestamp_update`) VALUES (1, 'article', 1, '2021-02-25 02:05:30', '2021-02-25 02:05:30');
INSERT INTO `plugin_manager` (`plugin_manager_id`, `plugin_config_filename`, `plugin_active`, `timestamp_create`, `timestamp_update`) VALUES (2, 'gallery', 1, '2021-02-25 02:05:30', '2021-02-25 02:05:30');


#
# TABLE STRUCTURE FOR: plugin_widget
#

DROP TABLE IF EXISTS `plugin_widget`;

CREATE TABLE `plugin_widget` (
  `plugin_widget_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `plugin_filename` varchar(255) DEFAULT NULL,
  `sort_by` varchar(255) DEFAULT NULL,
  `order_by` varchar(10) DEFAULT NULL,
  `data_limit` int(11) DEFAULT NULL,
  `view_id` int(11) DEFAULT NULL,
  `template_code` text,
  `lang_iso` varchar(10) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`plugin_widget_id`),
  KEY `plugin_widget_id` (`plugin_widget_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: save_formdraft
#

DROP TABLE IF EXISTS `save_formdraft`;

CREATE TABLE `save_formdraft` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_url` text,
  `submit_array` text,
  `user_admin_id` int(11) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: settings
#

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) DEFAULT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `fbapp_id` varchar(255) DEFAULT NULL,
  `site_footer` text,
  `default_email` varchar(255) DEFAULT NULL,
  `keywords` text,
  `themes_config` varchar(255) DEFAULT NULL,
  `admin_lang` varchar(255) DEFAULT NULL,
  `additional_js` text,
  `additional_metatag` text,
  `googlecapt_active` int(11) DEFAULT NULL,
  `googlecapt_sitekey` varchar(255) DEFAULT NULL,
  `googlecapt_secretkey` varchar(255) DEFAULT NULL,
  `pagecache_time` int(3) DEFAULT NULL,
  `email_protocal` varchar(20) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(5) DEFAULT NULL,
  `sendmail_path` varchar(255) DEFAULT NULL,
  `member_confirm_enable` int(11) DEFAULT NULL,
  `member_close_regist` int(11) DEFAULT NULL,
  `gmaps_key` varchar(255) DEFAULT NULL,
  `gmaps_lat` varchar(100) DEFAULT NULL,
  `gmaps_lng` varchar(100) DEFAULT NULL,
  `ga_client_id` varchar(255) DEFAULT NULL,
  `ga_view_id` varchar(255) DEFAULT NULL,
  `gsearch_active` int(11) DEFAULT NULL,
  `gsearch_cxid` varchar(255) DEFAULT NULL,
  `maintenance_active` int(11) DEFAULT NULL,
  `html_optimize_disable` int(11) DEFAULT NULL,
  `adobe_cc_apikey` varchar(255) DEFAULT NULL,
  `facebook_page_id` varchar(255) DEFAULT NULL,
  `assets_static_active` int(11) DEFAULT NULL,
  `assets_static_domain` varchar(255) DEFAULT NULL,
  `fb_messenger` int(11) DEFAULT NULL,
  `email_logs` int(11) DEFAULT NULL,
  `title_setting` int(11) DEFAULT NULL,
  `cookieinfo_active` int(11) DEFAULT NULL,
  `cookieinfo_bg` varchar(7) DEFAULT NULL,
  `cookieinfo_fg` varchar(7) DEFAULT NULL,
  `cookieinfo_link` varchar(7) DEFAULT NULL,
  `cookieinfo_msg` varchar(255) DEFAULT NULL,
  `cookieinfo_linkmsg` varchar(100) DEFAULT NULL,
  `cookieinfo_moreinfo` varchar(255) DEFAULT NULL,
  `cookieinfo_txtalign` varchar(30) DEFAULT NULL,
  `cookieinfo_close` varchar(100) DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`settings_id`, `site_name`, `site_logo`, `og_image`, `fbapp_id`, `site_footer`, `default_email`, `keywords`, `themes_config`, `admin_lang`, `additional_js`, `additional_metatag`, `googlecapt_active`, `googlecapt_sitekey`, `googlecapt_secretkey`, `pagecache_time`, `email_protocal`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `sendmail_path`, `member_confirm_enable`, `member_close_regist`, `gmaps_key`, `gmaps_lat`, `gmaps_lng`, `ga_client_id`, `ga_view_id`, `gsearch_active`, `gsearch_cxid`, `maintenance_active`, `html_optimize_disable`, `adobe_cc_apikey`, `facebook_page_id`, `assets_static_active`, `assets_static_domain`, `fb_messenger`, `email_logs`, `title_setting`, `cookieinfo_active`, `cookieinfo_bg`, `cookieinfo_fg`, `cookieinfo_link`, `cookieinfo_msg`, `cookieinfo_linkmsg`, `cookieinfo_moreinfo`, `cookieinfo_txtalign`, `cookieinfo_close`, `timestamp_update`) VALUES (1, 'DOCA', '2021/1614404719_logo-org.png', '2021/1614404719_og-org.png', '', '&copy; %Y% Doca', 'info@webdukes.com', 'CMS, Contact Management System, HTML, CSS, JS, JavaScript, framework, bootstrap, web development, thai, english', 'cszdefault', 'english', '', '', NULL, '', '', 0, 'mail', '', '', 'Admin@987', '', '', NULL, NULL, '', '-28.621975', '150.689082', '', '', NULL, '', NULL, 1, '', '', NULL, 'info@webdukes.com', NULL, 1, 2, NULL, '#645862', '#ffffff', '#f1d600', 'This website uses cookies to improve your user experience. By continuing to browse our site you accepted and agreed on our ', 'Privacy Policy and terms.', 'https://www.cszcms.com/LICENSE.md', 'left', 'Got it!', '2021-02-27 11:15:19');


#
# TABLE STRUCTURE FOR: upload_file
#

DROP TABLE IF EXISTS `upload_file`;

CREATE TABLE `upload_file` (
  `upload_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(10) DEFAULT NULL,
  `file_upload` varchar(255) DEFAULT NULL,
  `remark` text,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`upload_file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: user_admin
#

DROP TABLE IF EXISTS `user_admin`;

CREATE TABLE `user_admin` (
  `user_admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` text,
  `phone` varchar(100) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `md5_hash` varchar(255) DEFAULT NULL,
  `md5_lasttime` datetime DEFAULT NULL,
  `pm_sendmail` int(11) DEFAULT NULL,
  `timestamp_login` datetime DEFAULT NULL,
  `pass_change` int(11) DEFAULT NULL,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`user_admin_id`),
  KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `user_admin` (`user_admin_id`, `name`, `email`, `password`, `user_type`, `first_name`, `last_name`, `birthday`, `gender`, `address`, `phone`, `picture`, `active`, `session_id`, `md5_hash`, `md5_lasttime`, `pm_sendmail`, `timestamp_login`, `pass_change`, `timestamp_create`, `timestamp_update`) VALUES (1, 'Admin User', 'info@webdukes.com', '$2y$12$Lfn2hdeK2oiM/Ses1ddr9uOlmDQS/XQ6QO00lClJMprn1dQA2bJje', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '76692dd0aef2c853e9daa3f5eecd51e6bdbcce1d', '7d07188b771dd3620df5a9b32abc595c', '2021-02-25 02:05:31', 1, '2021-02-27 11:08:28', 1, '2021-02-25 02:05:31', '2021-02-25 02:05:31');


#
# TABLE STRUCTURE FOR: user_groups
#

DROP TABLE IF EXISTS `user_groups`;

CREATE TABLE `user_groups` (
  `user_groups_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  PRIMARY KEY (`user_groups_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `user_groups` (`user_groups_id`, `name`, `definition`) VALUES (1, 'Admin', 'Super Admin Group');
INSERT INTO `user_groups` (`user_groups_id`, `name`, `definition`) VALUES (2, 'Editor', 'Editor Access Group');
INSERT INTO `user_groups` (`user_groups_id`, `name`, `definition`) VALUES (3, 'Public', 'Public Access Group');
INSERT INTO `user_groups` (`user_groups_id`, `name`, `definition`) VALUES (4, 'Guest', 'Guest Access Group');


#
# TABLE STRUCTURE FOR: user_perm_to_group
#

DROP TABLE IF EXISTS `user_perm_to_group`;

CREATE TABLE `user_perm_to_group` (
  `user_perms_id` int(11) NOT NULL DEFAULT '0',
  `user_groups_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_perms_id`,`user_groups_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (1, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (3, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (3, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (4, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (4, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (5, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (5, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (6, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (6, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (7, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (7, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (8, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (8, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (9, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (9, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (10, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (10, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (11, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (11, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (12, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (13, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (13, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (14, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (21, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (21, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (22, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (22, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (23, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (23, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (24, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (24, 3);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (25, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (25, 3);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (25, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (26, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (26, 4);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (27, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (30, 2);
INSERT INTO `user_perm_to_group` (`user_perms_id`, `user_groups_id`) VALUES (31, 2);


#
# TABLE STRUCTURE FOR: user_perms
#

DROP TABLE IF EXISTS `user_perms`;

CREATE TABLE `user_perms` (
  `user_perms_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  `permstype` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_perms_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (1, 'save', 'For save permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (2, 'delete', 'For delete permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (3, 'analytics', 'For analytics access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (4, 'forms builder', 'For forms builder access permission', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (5, 'plugin widget', 'For plugin widget access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (6, 'file upload', 'For file upload access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (7, 'pages content', 'For pages content access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (8, 'navigation', 'For navigation access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (9, 'linkstats', 'For statistic for links access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (10, 'language', 'For language access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (11, 'general label', 'For general label access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (12, 'site settings', 'For site settings access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (13, 'maintenance', 'For maintenance system access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (14, 'plugin manager', 'For plugin manager access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (15, 'admin users', 'For admin users access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (16, 'member users', 'For member users access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (17, 'user groups', 'For user groups access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (18, 'email logs', 'For email logs access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (19, 'login logs', 'For login logs access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (20, 'protection settings', 'For protection settings access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (21, 'gallery', 'For gallery plugin access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (22, 'article', 'For article plugin access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (23, 'social', 'For social settings access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (24, 'profile save', 'For user profile save permission on frontend', 'frontend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (25, 'pm', 'For private message access permission on frontend', 'frontend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (26, 'banner', 'For banner manager access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (27, 'file manager', 'For file manager access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (28, 'pages cssjs additional', 'For pages content css js metatag additional access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (29, 'export', 'For Import Export CSV access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (30, 'pm', 'For PM access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (31, 'carousel', 'For carousel access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (32, 'old plugin widget', 'For old plugin widget access permission on backend', 'backend');
INSERT INTO `user_perms` (`user_perms_id`, `name`, `definition`, `permstype`) VALUES (33, 'server info', 'For server information access permission on backend', 'backend');


#
# TABLE STRUCTURE FOR: user_pms
#

DROP TABLE IF EXISTS `user_pms`;

CREATE TABLE `user_pms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: user_to_group
#

DROP TABLE IF EXISTS `user_to_group`;

CREATE TABLE `user_to_group` (
  `user_admin_id` int(11) NOT NULL DEFAULT '0',
  `user_groups_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_admin_id`,`user_groups_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `user_to_group` (`user_admin_id`, `user_groups_id`) VALUES (1, 1);


#
# TABLE STRUCTURE FOR: whitelist_ip
#

DROP TABLE IF EXISTS `whitelist_ip`;

CREATE TABLE `whitelist_ip` (
  `whitelist_ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) DEFAULT NULL,
  `note` text,
  `timestamp_create` datetime DEFAULT NULL,
  PRIMARY KEY (`whitelist_ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: widget_xml
#

DROP TABLE IF EXISTS `widget_xml`;

CREATE TABLE `widget_xml` (
  `widget_xml_id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_name` varchar(255) DEFAULT NULL,
  `xml_url` varchar(255) DEFAULT NULL,
  `limit_view` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `widget_open` text,
  `widget_content` text,
  `widget_seemore` text,
  `widget_close` text,
  `timestamp_create` datetime DEFAULT NULL,
  `timestamp_update` datetime DEFAULT NULL,
  PRIMARY KEY (`widget_xml_id`),
  KEY `widget_name` (`widget_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

