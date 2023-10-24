<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-07-12 15:07:42 --> Unable to connect to the database
ERROR - 2023-07-12 15:07:50 --> Unable to connect to the database
ERROR - 2023-07-12 15:07:54 --> Unable to connect to the database
ERROR - 2023-07-12 15:07:59 --> Unable to connect to the database
ERROR - 2023-07-12 15:08:03 --> Unable to connect to the database
ERROR - 2023-07-12 15:08:03 --> Query error: No connection could be made because the target machine actively refused it - Invalid query: SELECT *
FROM `lang_iso`
WHERE `active` = 1
ORDER BY `arrange` ASC
 LIMIT 1
ERROR - 2023-07-12 15:08:07 --> Unable to connect to the database
ERROR - 2023-07-12 15:08:07 --> Query error: No connection could be made because the target machine actively refused it - Invalid query: SELECT *
FROM `lang_iso`
WHERE `lang_iso` IS NULL
AND `active` = 1
ERROR - 2023-07-12 15:08:11 --> Unable to connect to the database
ERROR - 2023-07-12 15:08:11 --> Query error: No connection could be made because the target machine actively refused it - Invalid query: SELECT *
FROM `lang_iso`
WHERE `active` = 1
ORDER BY `arrange` ASC
 LIMIT 1
ERROR - 2023-07-12 15:08:15 --> Unable to connect to the database
ERROR - 2023-07-12 15:08:15 --> Query error: No connection could be made because the target machine actively refused it - Invalid query: SELECT *
FROM `lang_iso`
WHERE `active` = 1
ORDER BY `arrange` ASC
 LIMIT 1
ERROR - 2023-07-12 15:08:19 --> Unable to connect to the database
ERROR - 2023-07-12 15:08:19 --> Query error: No connection could be made because the target machine actively refused it - Invalid query: SELECT *
FROM `page_menu`
WHERE `lang_iso` = '' AND `active` = '1' AND `drop_page_menu_id` = '0' AND `position` = '0'
ORDER BY `arrange` ASC
 LIMIT 1
ERROR - 2023-07-12 15:08:19 --> Severity: error --> Exception: Call to a member function real_escape_string() on bool C:\xampp\htdocs\appdata\system\database\drivers\mysqli\mysqli_driver.php 393
