<?php
$sub_menu = "700750";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');
check_admin_token();

//서비스 블럭처리
if($w=='b'){
		
	$result=sql_query("update {$g5['cn_set']} set service_block ='$service_block' ");
	
	
	if($result) alert_json(true,'처리되었습니다');
	else  alert_json(false,'처리불가');
	
}