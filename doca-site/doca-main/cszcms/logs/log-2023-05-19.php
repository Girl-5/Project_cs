<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-05-19 16:07:39 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` IS NULL
ORDER BY `form_field_id` ASC
ERROR - 2023-05-19 16:07:39 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` IS NULL
ORDER BY `form_field_id` ASC
