<?php
include_once('./_common.php');


//스테이킹 종료 
if ( $w == 't' ) {
	
	$data=sql_fetch("select * from {$g5['cn_stake_table']}  where sk_no='$sk_no'");		
	
	if(!$data[sk_no]) alert_json(true,'Staking history not found');
	if( $data['sk_stats']=='3' )  alert_json(false,'Already terminated');
	
	//스테이킹 포인트 지정
	set_staking_add($data,3,1);
	
	//잔액 조회
	$rpoint=get_mempoint($member['mb_id']);	
	
	alert_json(true,'',array('sk_no'=>$sk_no,'max_enable'=>number_format2($rpoint[$sw_token]['_enable'],6),'max_enable_usd'=>number_format2(swap_usd($rpoint[$sw_token]['_enable'],$sw_token),2) ));	
	
}


//스테이킹 시작
if ( $w == 's') {
	
	$data=sql_fetch("select * from {$g5['cn_stake_table']}  where sk_no='$sk_no'");		
	
	if(!$data[sk_no]) alert_json(true,'Staking history not found');
	
	//잔액 조회
	$rpoint=get_mempoint($member['mb_id']);	
	
	if($rpoint[$data['sk_token']]['_enable']  < $data['sk_amt'])  alert_json(false,'Not enough quantity to stake');
	if( $data['sk_stats']=='2' )  alert_json(false,'Already in progress');
	
	//스테이킹 포인트 지정
	set_staking_add($data,2,1);	
	
	alert_json(true,'',array('sk_no'=>$sk_no,'max_enable'=>number_format2($rpoint[$sw_token]['_enable'],6),'max_enable_usd'=>number_format2(swap_usd($rpoint[$sw_token]['_enable'],$sw_token),2) ));	
	
}


if ( $w == 'u') {
	$sk_token=trim($_POST['sk_token']);
	$sk_amt=only_number($_POST['sk_amt']);	
	
	if($sk_token=='') alert_json(false,'ERROR!');
	
	$sum=$rpoint[$sk_token]['_enable']*1;
	
	if($sum < $sk_amt)  alert_json(false,'Not enough quantity to stake');
	
	if( $sk_amt == 0) alert_json(false,'Enter the quantity to be staked');
	
	//if ($member['mb_password'] != get_encrypt_string(trim($_POST['pass'])) ) alert_json(false,'Password is wrong');
	
	
	$sk_code=get_stakecode();
	
	//스테이킹 내역 기록
	$sql_common .= " 
			sk_token='$sk_token',
			sk_amt  = '{$sk_amt}',			
			sk_stats  = '1'			
			";
					
    $sql = " insert into {$g5['cn_stake_table']}
                set 				
				mb_id		 = '{$member['mb_id']}',
				sk_code='$sk_code',
				sk_wallet='free',
				sk_wdate = now(),
				$sql_common ";
	
	//echo $sql;				
    sql_query($sql,1);	
	$sk_no=sql_insert_id();	
	
	$data=sql_fetch("select * from {$g5['cn_stake_table']}  where sk_no='$sk_no'");				
	$data['sk_stats']='0';
	
	//스테이킹 포인트 지정
	set_staking_add($data,2,1);
	
	//잔액 조회
	$rpoint=get_mempoint($member['mb_id']);	
	
	alert_json(true,'',array('sk_no'=>$sk_no,'max_enable'=>number_format2($rpoint[$sk_token]['_enable'],6),'max_enable_usd'=>number_format2(swap_usd($rpoint[$sk_token]['_enable'],$sk_token),2) ));	
}
/* else if ($w == 'u') {
	
    $sql = " update  {$g5['cn_staking_table']} set 
			 
	         {$sql_common}
              where sk_no = '{$sk_no}' ";
   // sql_query($sql,1);
	
}
*/


	
//goto_url("./coin_draw_out_list.php?page=$page&{$qstr}");
?>