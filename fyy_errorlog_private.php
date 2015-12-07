<?php
if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); } 

function export_csv($filename,$data){
	header("Content-type:text/csv");   
	header("Content-Disposition:attachment;filename=".$filename);   
	header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
	header('Expires:0');   
	header('Pragma:public');   
	echo $data;   
}
if(isset($_REQUEST['e'])){
	global $m;
	$m->query('TRUNCATE TABLE `'.DB_NAME.'`.`'.DB_PREFIX.'fyy_errorlog`');
	Redirect(SYSTEM_URL.'index.php?mod=admin:tools&ok');
}
elseif(isset($_REQUEST['d'])){
global $m;
$csv = $m->query('SELECT * FROM `'.DB_NAME.'`.`'.DB_PREFIX.'fyy_errorlog` ORDER BY `time`'); 
$str = "错误信息,时间,种类,路径,行数\n";   
$str = iconv('utf-8','gb2312',$str);   
while($row=$m->fetch_array($csv)){   
		$row['error'] = iconv('utf-8','gb2312',$row['error']);
		$row['type'] = iconv('utf-8','gb2312',$row['type']);
		$row['file'] = iconv('utf-8','gb2312',$row['file']);
		$row['line'] = iconv('utf-8','gb2312',$row['line']);
		$str .= $row['error'].",".$row['time'].",".$row['type'].",".$row['file'].",".$row['line']."\n";
	}   
	$filename = '错误信息'.date('Ymd').'.csv';
	export_csv($filename,$str);
}