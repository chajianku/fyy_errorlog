<?php
if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); }

function callback_init() {
	global $m;
	$m->query("DROP TABLE IF EXISTS `".DB_NAME."`.`".DB_PREFIX."fyy_errorlog`");
	$m->query('CREATE TABLE `'.DB_NAME.'`.`'.DB_PREFIX.'fyy_errorlog` (
		`error`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
		`time`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
		`type`  varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT "错误类型" ,
		`file`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
		`line`  int(10) NOT NULL ,
		PRIMARY KEY (`time`),
		)
	ENGINE=CSV
	DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
	ROW_FORMAT=DYNAMIC
	;');
}

function callback_remove() {
	global $m;
	$m->query("DROP TABLE IF EXISTS `".DB_NAME."`.`".DB_PREFIX."fyy_errorlog`");
}
?>