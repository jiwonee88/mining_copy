<?php
include_once('./_common.php');

if ( $w == 'm') {
	
						
    $sql = " update {$g5['member_table']}
                set 				
				mb_auto_all		 = '{$_POST[mb_auto_all]}'
				where mb_id='$member[mb_id]'";
				
	
	//echo $sql;				
   $result= sql_query($sql);	
	
	if($result) alert_json(true,'ok');	
	else alert_json(false,'저장 할 수 없습니다');	
}
//오토매칭
if ( $w == 'mu') {
	
						
    $sql = " update {$g5['member_table']}
                set 				
				mb_auto_a		 = '{$_POST[mb_auto_a]}',
				mb_auto_b		 = '{$_POST[mb_auto_b]}',
				mb_auto_c		 = '{$_POST[mb_auto_c]}',
				mb_auto_d		 = '{$_POST[mb_auto_d]}',
				mb_auto_e		 = '{$_POST[mb_auto_e]}',
				mb_auto_f		 = '{$_POST[mb_auto_f]}',
				mb_auto_g		 = '{$_POST[mb_auto_g]}',
				mb_auto_h		 = '{$_POST[mb_auto_h]}'
				
				where mb_id='$member[mb_id]'";
				
	
	//echo $sql;				
   $result= sql_query($sql);	
	
	if($result) alert_json(true,'ok');	
	else alert_json(false,'저장 할 수 없습니다');	
}
//오토매칭
if ( $w == 'au') {
	
	$srpoint=get_mempoint($member['mb_id'],$_POST[ac_id]);
	if($srpoint['i']['_enable'] < $cset[staking_amt]) alert_json(false,'최소 보유금액이 부족합니다.');	
			
						
    $sql = " update {$g5['cn_sub_account']}
                set 				
				ac_auto_a		 = '{$_POST[ac_auto_a]}',
				ac_auto_b		 = '{$_POST[ac_auto_b]}',
				ac_auto_c		 = '{$_POST[ac_auto_c]}',
				ac_auto_d		 = '{$_POST[ac_auto_d]}',
				ac_auto_e		 = '{$_POST[ac_auto_e]}',
				ac_auto_f		 = '{$_POST[ac_auto_f]}',
				ac_auto_g		 = '{$_POST[ac_auto_g]}',
				ac_auto_h		 = '{$_POST[ac_auto_h]}'
				
				where ac_id='$_POST[ac_id]'";
				
	
	echo $sql;				
   $result= sql_query($sql);	
	
	if($result) alert_json(true,'ok');	
	else alert_json(false,'저장 할 수 없습니다');	
}
?>