<?php
$sub_menu = "700755";
include_once('./_common.php');

//check_admin_token();

if ( $_POST['act_button'] == "선택수정" || $_POST['act_button'] == "선택삭제" ){
	if (!count($_POST['chk'])) {
		alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
	}
}

$sql_search = " where (1) ";

if($date_start_stx) {
	$qstr.="&date_start_stx=$date_start_stx";
}
if($date_end_stx) {
	$qstr.="&date_end_stx=$date_end_stx";
}
if($date_stx) {	
	$qstr.="&date_stx=$date_stx";
}
if($item_stx) {
	$qstr.="&item_stx=$item_stx";
}
if($paytype_stx) {

	$qstr.="&paytype_stx=$paytype_stx";
}
if($distri_stx) {
	$qstr.="&distri_stx=$distri_stx";
}
if($stats_stx) {
	$qstr.="&stats_stx=$stats_stx";
}
if($claim_stx=='all') {	
	$qstr.="&claim_stx=$claim_stx";
}
if($claim_stx=='buyer') {	
	$qstr.="&claim_stx=$claim_stx";
}
if($claim_stx=='seller') {	
	$qstr.="&claim_stx=$claim_stx";
}


if ($stx) {
	if($sfl=='a.mb_id') $sql_search .= "and ($sfl = '$stx') ";
    else $sql_search .= "and ($sfl like '%$stx%') ";
}
if ($mb_stx) {
    $sql_search .= " and b.mb_id='$mb_stx' ";	
	$qstr.="&mb_stx=$mb_stx";
}

if ($_POST['act_button'] == "매칭결과승인처리") {

    auth_check($auth[$sub_menu], 'w'); 		
	
	//거래코드 생성
	$code= get_tradecode();		
		
	$cols="tr_code, cart_code, to_cart_code, lg_no, cn_item, mb_id, smb_id, fmb_id, fsmb_id, ct_buy_price, ct_sell_price, tr_buyer_claim, tr_seller_claim, tr_buyer_dun, tr_seller_dun, tr_buyer_note, tr_seller_note, tr_buyer_memo, tr_seller_memo, tr_price_org, tr_price, tr_discount, tr_payback, tr_price_cash, tr_discount_cash, tr_payback_cash, tr_class, tr_fee, tr_seller_fee, tr_paytype, tr_bank, tr_bank_num, tr_bank_user, tr_set_paytype, tr_wallet_addr, tr_balance, tr_balance_last, tr_txid, tr_deposit, tr_stats, tr_paydate, tr_distri, tr_penalty, tr_penalty_date, tr_wdate, tr_setdate, tr_rdate";
	$cols="tr_code, cart_code, lg_no, cn_item, mb_id, smb_id, fmb_id, fsmb_id, ct_buy_price, ct_sell_price, tr_buyer_claim, tr_seller_claim, tr_buyer_dun, tr_seller_dun, tr_buyer_note, tr_seller_note, tr_buyer_memo, tr_seller_memo, tr_price_org, tr_price, tr_discount, tr_payback, tr_price_cash, tr_discount_cash, tr_payback_cash, tr_class, tr_fee, tr_seller_fee, tr_paytype, tr_bank, tr_bank_num, tr_bank_user, tr_set_paytype, tr_wallet_addr, tr_balance, tr_balance_last, tr_txid, tr_deposit, tr_stats, tr_paydate, tr_distri, tr_penalty, tr_penalty_date, tr_wdate, tr_setdate, tr_rdate,tr_active";
		
	$re = sql_query("select *  from {$g5['cn_item_trade_test']} as a where not exists (select * from {$g5['cn_item_trade']} where tr_code=a.tr_code )");
	while($data=sql_fetch_array($re)){		
		
		//거래 정보 이전
		$result=sql_query("INSERT INTO  {$g5['cn_item_trade']} ($cols)  SELECT $cols from  {$g5['cn_item_trade_test']} where tr_code='$data[tr_code]' ",1);	
	
		if(!$result)  alert("작업을 진행 할 수 없습니다");
		
		$tr_fee_dept=$tr_seller_fee_dept=0;
		
		if($data[tr_seller_fee] > 0 ){
			
			$rpoint=get_mempoint($data[fmb_id]);
			
			//부족분
			$tr_seller_fee_dept=$data['tr_seller_fee']-$rpoint[$g5['cn_fee_coin']]['_enable'];		
			
			if($tr_seller_fee_dept > 0) $tr_seller_fee=$data['tr_seller_fee']-$tr_seller_fee_dept;
			else  $tr_seller_fee=$data[tr_seller_fee];
		
			//판매자 수수료 지출
			$content['link_no']=$data['tr_code'];				
			$content['pt_wallet']='free'; //지갑구
			$content['pt_coin']=$g5['cn_fee_coin']; //코인구분
			$content['amount']=$tr_seller_fee  * -1;
			$content['subject']='매칭수수료';

			$mb[mb_id]=$data[fmb_id];
			set_add_point('mfee2',$mb,$data[fmb_id],$member['mb_id'],$content);		

		}

		
		if($data[tr_fee] > 0 ){
		
			$rpoint=get_mempoint($data[mb_id]);		
			
			//부족분
			$tr_fee_dept=$data[tr_fee]-$rpoint[$g5['cn_fee_coin']]['_enable'];
		
			if($tr_fee_dept > 0) $tr_fee=$data[tr_fee]-$tr_fee_dept;
			else  $tr_fee=$data[tr_fee];
		
			//구매자 수수료 지출
			$content['link_no']=$data[tr_code];					
			$content['pt_wallet']='free'; //지갑구
			$content['pt_coin']=$g5[cn_fee_coin]; //코인구분
			$content['amount']=$tr_fee  * -1;
			$content['subject']='매칭수수료';

			$mb[mb_id]=$data[mb_id];
			set_add_point('mfee',$mb,$row[amb_id],$member['mb_id'],$content);						
			
		}

		$sql="update {$g5['cn_item_cart']} set  trade_cnt=trade_cnt+1 ,is_trade=if( trade_cnt >= div_cnt,1,if(trade_cnt > 0,2,is_trade))   where code='{$data[cart_code]}'" ;		
		$_result=sql_query($sql,1);	
		
		//부족분 저장
		if($tr_fee_dept > 0 || $tr_seller_fee_dept > 0){
			$set='';
			
			if($tr_fee_dept > 0) $set=" tr_fee_dept='$tr_fee_dept' ";
			if($tr_seller_fee_dept > 0) $set.=($set?",":"")." tr_seller_fee_dept='$tr_seller_fee_dept' ";
			
			$sql="update {$g5['cn_item_trade']} set $set  where tr_code='{$data[tr_code]}'" ;		
			
			echo $sql;
			$_result=sql_query($sql,1);	
		}
		
		
		//바로 승인 처리
		// set_trade_stat($data,3,1);
		 
		if(!$_result)  alert_json(false,"작업을 진행 할 수 없습니다");		
				

	} 	//while($data=sql_fetch_array($re)){		
	
	


} else if ($_POST['act_button'] == "선택삭제") {

    auth_check($auth[$sub_menu], 'd');
   
    for ($i=0; $i<count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        // include 전에 $bo_table 값을 반드시 넘겨야 함
        $tmp_tr_code = trim($_POST['tr_code'][$k]);
		
		sql_query("delete from  {$g5['cn_item_trade_test']} where tr_code='$tmp_tr_code' ");
		
       
    }


}

//goto_url('./item_trade_list.php?'.$qstr);
?>