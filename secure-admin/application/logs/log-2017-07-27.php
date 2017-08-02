<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-07-27 11:29:51 --> Query error: Column 'id' in order clause is ambiguous - Invalid query: SELECT *
FROM `website`
JOIN `space` ON `space`.`website_id` = `website`.`id`
WHERE `space`.`is_deleted` =0
ORDER BY `id` DESC
ERROR - 2017-07-27 15:18:22 --> 404 Page Not Found: Website/addEdit67
