<?php
include_once('./_common.php');

//재화 구매 신
if ($w == '' ) {	
	
	service_block();
	
	//$in_token=$_POST['tr_token'];
	$in_token='u';
	$in_set_token=$_POST['tr_set_token'];
	
	if($in_set_token=='i')	$item_data=$g5['cn_golditem'][$_POST['item']];
	else if($in_set_token=='b')	$item_data=$g5['cn_gasitem'][$_POST['item']];
	else  alert_json(false,'구매할 상품을 찾을수 없습니다');
	
	$in_rsv_amt=only_number($item_data[price] * $_POST['qty']);		
	if(!$in_rsv_amt) alert_json(false,'입금액이 없습니다');
		
	$in_set_amt=only_number($item_data[amt] * $_POST['qty']);		
	if(!$in_set_amt) alert_json(false,'구매수량이 없습니다');	
	
	$in_item=$item_data['name_kr'];
	$in_item_qty=$_POST['qty'];
	
	
	//입금 계좌 생성
	$in_wallet_addr  =  align_mb_wallet($mb_id,$in_token);	
	
	//if($in_wallet_addr=='') alert_json(false,'입금 계좌를 발급 할 수 없습니다');	
	
	//$data=sql_fetch("select * from {$g5['cn_purchase_table']} where mb_id = '{$member['mb_id']}' and in_stats in ('1','2')");
	//if($data) alert_json('false','진행대기중인 구매건이 있습니다t.');
	
	
	//현재 이더지갑 잔액
	/*
	if($in_token=='e'){
		$rtn=balance_coin_eth($in_wallet_addr);
	}else{
		$rtn=balance_coin_usdt($in_wallet_addr);	
	}
	*/
	
	//if(!$rtn[0]) alert_json('false','지갑 잔액을 알수 없습니다');
	//$in_balance=$rtn[1];
	
	$sql_common .= " 
			in_item='".addslashes($in_item)."',
			in_item_qty='$in_item_qty',
			
			in_wallet_addr  = '{$in_wallet_addr}',	
			in_rsv_amt  = '{$in_rsv_amt}',	
			in_rsv_date  = now(),
			in_set_amt  = '{$in_set_amt}',	
			in_set_token  = '$in_set_token',	
			in_stats  = '1'	,
			in_balance='$in_balance',
			in_balance_last='$in_balance',
			in_mdate = now()
			";
					
    $sql = " insert into {$g5['cn_purchase_table']}
                set 
				in_token='$in_token',
				mb_id		 = '{$member['mb_id']}',
				smb_id		 = '{$_POST['smb_id']}',
				in_wdate = now(),
				$sql_common ";
	
	//echo $sql;				
    $result=sql_query($sql,1);	
	$in_no=sql_insert_id();
	
	if($result) alert_json(true,'');
	else alert_json(false,'등록 할 수 없습니다');

//입금 정보 등록
} else if ($w == 'u') {
	
    $sql = " update  {$g5['cn_purchase_table']} set 
			 
	         in_txn_id  = '{$_POST['in_txn_id']}'
              where in_no = '{$_POST[in_no]}' and mb_id='{$member[mb_id]}' ";
   $result= sql_query($sql,1);
   
   if($result) alert_json(true,'');
	else alert_json(false,'등록 할 수 없습니다');
	
}
	
//goto_url("./item_part_form.php?in_no={$in_no}&{$qstr}");
//goto_url("./insert_reserve_list.php?page=$page&{$qstr}");
?>