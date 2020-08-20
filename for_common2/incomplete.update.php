<?php
include_once('./_common.php');

//alert_json(false,'점검중입니다');	
//error_reporting(E_ALL);

//ini_set("display_errors", 1);


//print_r($_POST);
if ( $_POST['w'] == 'txin') {
	
	$tr_code=trim($_POST['tr_code']);		

	$tr_txid=trim($_POST['tr_txid']);	
	
	$tr_deposit=trim($_POST['tr_deposit']);	
	
	$tdata=sql_fetch("select * from {$g5['cn_item_trade']} where tr_code='$tr_code'  and mb_id='{$member[mb_id]}' ");
	
	if($tdata[tr_stats]=='3' ) alert_json(false,"이미 완료된 거래입니다");
	if($tdata[tr_stats]=='4' ) alert_json(false,"이미 취소된 거래입니다");
	if($tdata[tr_paytype]=='cash' && $tr_deposit=='' ) alert_json(false,'입금자명을 입력하세요');	
	
	if($tdata[tr_paytype]=='both' && $tr_txid==''  && $tr_deposit=='' ) alert_json(false,'테더 입금시 Transaction hash 을, 계좌이체시 입금자명을 입력하세요');	
							
    $sql = " update {$g5['cn_item_trade']}
                set 		
				tr_paydate=now(),
				tr_txid	 = '{$tr_txid}',
				tr_deposit='$tr_deposit',
				tr_stats='2'
				where tr_code='$tr_code' and mb_id='{$member[mb_id]}'";
				
	
	//echo $sql;				
   $result= sql_query($sql,1);	
	
	if($result) alert_json(true,'');	
	else alert_json(false,'처리할수 없습니다');	
}

//거래의 종료
if ( $_POST['w'] == 'complete') {
		
	//alert_json(false,'준비중입니다');	
	
	//거래정보
	$tdata=sql_fetch("select * from {$g5['cn_item_trade']} where tr_code='$tr_code' and fmb_id='{$member[mb_id]}' ",1);
	if($tdata[tr_code]=='' ) alert_json(false,"거래정보를 찾을수 없습니다");
	
	//if($tdata[tr_stats]!='2' ) alert_json(false,"입금확인이 되지 않은 거래입니다");
	if($tdata[tr_stats]=='3' ) alert_json(false,"이미 완료된 거래입니다");	
	if($tdata[tr_stats]=='4' ) alert_json(false,"이미 취소된 거래입니다");
	$result=set_trade_stat($tdata,3);
	
	
	if($result[0]==false) alert_json(false,$result[1]);	
	else alert_json(true,'처리되었습니다',array('stats'=>'거래완료','setdate'=>date("Y-m-d H:i:s")));	
}