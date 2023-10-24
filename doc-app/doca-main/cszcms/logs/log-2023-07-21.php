<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-07-21 10:17:56 --> Unable to connect to the database
ERROR - 2023-07-21 10:18:04 --> Unable to connect to the database
ERROR - 2023-07-21 10:18:08 --> Unable to connect to the database
ERROR - 2023-07-21 10:18:12 --> Unable to connect to the database
ERROR - 2023-07-21 10:18:16 --> Unable to connect to the database
ERROR - 2023-07-21 10:18:16 --> Query error: No connection could be made because the target machine actively refused it - Invalid query: SELECT *
FROM `lang_iso`
WHERE `active` = 1
ORDER BY `arrange` ASC
 LIMIT 1
ERROR - 2023-07-21 10:18:20 --> Unable to connect to the database
ERROR - 2023-07-21 10:18:20 --> Query error: No connection could be made because the target machine actively refused it - Invalid query: SELECT *
FROM `lang_iso`
WHERE `lang_iso` IS NULL
AND `active` = 1
ERROR - 2023-07-21 10:18:25 --> Unable to connect to the database
ERROR - 2023-07-21 10:18:25 --> Query error: No connection could be made because the target machine actively refused it - Invalid query: SELECT *
FROM `lang_iso`
WHERE `active` = 1
ORDER BY `arrange` ASC
 LIMIT 1
ERROR - 2023-07-21 10:18:29 --> Unable to connect to the database
ERROR - 2023-07-21 10:18:29 --> Query error: No connection could be made because the target machine actively refused it - Invalid query: SELECT *
FROM `lang_iso`
WHERE `active` = 1
ORDER BY `arrange` ASC
 LIMIT 1
ERROR - 2023-07-21 10:18:33 --> Unable to connect to the database
ERROR - 2023-07-21 10:18:33 --> Query error: No connection could be made because the target machine actively refused it - Invalid query: SELECT *
FROM `page_menu`
WHERE `lang_iso` = '' AND `active` = '1' AND `drop_page_menu_id` = '0' AND `position` = '0'
ORDER BY `arrange` ASC
 LIMIT 1
ERROR - 2023-07-21 10:18:33 --> Severity: error --> Exception: Call to a member function real_escape_string() on bool C:\xampp\htdocs\appdata\system\database\drivers\mysqli\mysqli_driver.php 393
