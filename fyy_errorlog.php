<?php
/*
Plugin Name: 错误信息记录
Version: 1.0
Plugin URL: http://fyy.l19l.com
Description: 记录程序出现的错误
Author: FYY
Author Email: fyy@l19l.com
Author URL: http://fyy.l19l.com
For:V3.9+
*/
if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); } 

function fyy_errorlog_take1($errno,$errstr,$errfile,$errline,$errnoo) {
	global $m;
	$errfile = sqladds($errfile);
	$m->query('INSERT INTO `'.DB_NAME.'`.`'.DB_PREFIX.'fyy_errorlog` (`error`,`time`,`type`,`file`,`line`) VALUES ("'.$errstr.'","'.date("Y-m-d H:m:s").'","'.$errnoo.'","'.$errfile.'","'.$errline.'")');
}

//iconv('utf-8','gb2312',$内容);

function fyy_errorlog_take2($code,$message,$file,$line,$trace) {
	global $m;
	$file = sqladds($file);
	$m->query('INSERT INTO `'.DB_NAME.'`.`'.DB_PREFIX.'fyy_errorlog` (`error`,`time`,`type`,`file`,`line`) VALUES ("'.$message.'","'.date("Y-m-d H:m:s").'","致命","'.$file.'","'.$line.'")');
}

/*



line:哪行产生了错误
file:产生错误的文件
type:错误类型
*/

function fyy_errorlog_tool() {
?>
	<br/><br/><input type="button" onclick="location = '<?php echo SYSTEM_URL ?>index.php?pri_plugin=fyy_errorlog&d'" class="btn btn-primary" value="导出所有错误信息" style="width:170px">
	<br/><br/><input type="button" onclick="location = '<?php echo SYSTEM_URL ?>index.php?pri_plugin=fyy_errorlog&e'" class="btn btn-primary" value="清空错误信息" style="width:170px">
<?php
}

addAction('error','fyy_errorlog_take1');
addAction('error_2','fyy_errorlog_take2');
addAction('admin_tools_3','fyy_errorlog_tool');
?>