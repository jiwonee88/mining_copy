<?php
include_once('./_common.php');


//alert_json(false,'서비스 준비중입니다');
$it_token=$_POST['it_token'];

$smb_id=$_POST['smb_id'];


$cn_item=$_POST['cn_item'];

$item_data=$g5['cn_item'][$cn_item];

if(!$item_data[price]) alert_json(false,'구매가 불가능한 상품입니다');

$it_item_qty=only_number($_POST['qty']);		

//상품 원가 구매액
$it_rsv_amt=only_number($item_data[price] * $it_item_qty);		

if(!$it_rsv_amt) alert_json(false,'구매 수량이 없습니다');	

$cn_item_name=$item_data['name_kr'];

$it_set_token=$_POST['it_set_token'];

if($it_set_token=='' ) alert_json(false,'구매 수단이 없습니다');	


//결제액
$it_set_amt=swap_coin($it_rsv_amt,$it_token,$it_set_token,$sise);

if(!$it_set_amt) alert_json(false,'구매액을 설정 할 수 없습니다');	

if($rpoint[$it_set_token]['_enable']*1 < $it_set_amt) alert_json(false,$g5['cn_cointype'][$it_set_token].'가 부족합니다');	

//입금 계좌 생성
//$it_wallet_addr  =  align_mb_wallet($mb_id,$it_token);		
//if($it_wallet_addr=='') alert_json(false,'입금 계좌를 발급 할 수 없습니다');	

//$data=sql_fetch("select * from {$g5['cn_item_purchase']} where mb_id = '{$member['mb_id']}' and it_stats in ('1','2')");
//if($data) alert_json('false','진행대기중인 구매건이 있습니다t.');


//현재 이더지갑 잔액
/*
if($it_token=='e'){
	$rtn=balance_coin_eth($it_wallet_addr);
}else if($it_token=='u'){
	$rtn=balance_coin_usdt($it_wallet_addr);	
}
*/

$it_balance=0;

//if(!$rtn[0]) alert_json('false','지갑 잔액을 알수 없습니다');
//$in_balance=$rtn[1];


$sql = " insert into {$g5['cn_item_purchase']}
	set 
	
	mb_id		 = '{$member['mb_id']}',	
	smb_id		 = '{$smb_id}',	
	cn_item='".addslashes($cn_item)."',
	cn_item_name='".addslashes($cn_item_name)."',
	
	it_item_qty='$it_item_qty',
	it_token='$it_token',
	
	it_wallet_addr  = '{$it_wallet_addr}',	
	it_rsv_amt  = '{$it_rsv_amt}',	
	it_rsv_date  = now(),

	it_set_amt  = '{$it_set_amt}',	
	it_set_token  = '{$it_set_token}'	,

	it_stats  = '1'	,
	it_balance='$it_balance',
	it_balance_last='$it_balance',
	it_mdate = now(),

	it_wdate = now()
	
	";

//echo $sql;				
$result=sql_query($sql,1);	
$it_no=sql_insert_id();

if(!$result) alert_json(true,'등록 할 수 없습니다');

//잔액이 맞는 경우 바로 처리
$data=sql_fetch("select * from {$g5['cn_item_purchase']}  where it_no='$it_no' ") ;

$result=set_purchase_item($data,3,1);

$rpoint=get_mempoint($member['mb_id']);
 
if(!$result[0]){

	sql_query("delete  from {$g5['cn_item_purchase']}  where it_no='$it_no' ") ;
	alert_json(false,$result[1]);
	 
}else alert_json(true,'구매가 완료 되었습니다',array('remainAmt'=>$rpoint[$it_set_token]['_enable']) );



?>