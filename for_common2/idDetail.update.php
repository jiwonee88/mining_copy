<?php
include_once('./_common.php');

//alert_json(false,'점검중입니다');	

if ( $w == 'u1') {
	
	$mb_trade_amtlmt=round(only_number($_POST['mb_trade_amtlmt']),6);	
	

	if(!$mb_trade_amtlmt || $mb_trade_amtlmt==0) alert_json(false,'설정금액을 입력하세요');	
	
						
    $sql = " update {$g5['member_table']}
                set 				
				mb_trade_amtlmt		 = '{$mb_trade_amtlmt}'
				where mb_id='$member[mb_id]'";
				
	
	//echo $sql;				
   $result= sql_query($sql);	
	
	if($result) alert_json(true,'',array('mb_trade_amtlmt'=>$mb_trade_amtlmt,'mb_trade_amtenable'=>$mb_trade_amtenable));	
	else alert_json(false,'저장 할 수 없습니다');	
}
//결제방
else if ( $w == 'u2') {
	
	$mb_trade_paytype=trim($_POST[mb_trade_paytype]);
	
	if(!$mb_trade_paytype) alert_json(false,'결제방법을 입력하세요');		
						
    $sql = " update {$g5['member_table']}
                set 				
				mb_trade_paytype		 = '{$mb_trade_paytype}'
				where mb_id='$member[mb_id]'";
					
	//echo $sql;				
    $result= sql_query($sql,false);	
	
	if($result) alert_json(true,'',array('mb_trade_paytype'=>$mb_trade_paytype));	
	else alert_json(false,'저장 할 수 없습니다');	
}

//계정의 추가
else if ( $w == 'u3') {
	
	$mb_trade_paytype=trim($_POST[mb_trade_paytype]);	
	
	$tmp=sql_fetch("select count(*) cnt from {$g5['cn_sub_account']} where mb_id='{$member[mb_id]}' and ac_id != '{$member[mb_id]}' ");
	
	$accountCnt=$tmp[cnt];
	
	if($tmp[cnt] > $cset[max_account_lmt]) alert_json(false,'최대 추가 가능한 계정은  '.$cset[max_account_lmt].'개 이내 입니다');	
	
	$tmp=sql_fetch("select ac_id from {$g5['cn_sub_account']} where mb_id='{$member[mb_id]}'   and ac_id != '{$member[mb_id]}'  order by ac_id desc limit 1",1	);
	
	if($tmp['ac_id']){		
		$numbers=substr($tmp[ac_id],strrpos($tmp[ac_id], ".")+1);
		$ac_id=$member[mb_id].'.'.sprintf("%02d",$numbers*1+1);
		
	}else $ac_id=$member[mb_id].'.'.'01';	
	
	$data=get_submember($ac_id);
	
	if($data) alert_json(false,'계정을 생성 할 수 없습니다');	
	
    $sql = " insert into {$g5['cn_sub_account']}
                set
				mb_id='{$member[mb_id]}',
				ac_id='$ac_id',
				ac_wdate=now()
				";					
	//echo $sql;
    $result= sql_query($sql,false);	
	
	$data=get_submember($ac_id);
	 
	if($result) alert_json(true,'',$data,array('accountCnt'=>$accountCnt+1));	
	else alert_json(false,'계정을 생성 할 수 없습니다');	
}

//계좌정보
else if ( $w == 'u5') {
	
	$mb_bank=trim($_POST[mb_bank]);
	$mb_bank_num=only_numeric(trim($_POST[mb_bank_num]));
	$mb_bank_user=trim($_POST[mb_bank_user]);
	
	if(!$mb_bank) alert_json(false,'은행명을 입력하세요');		
	if(!$mb_bank_num) alert_json(false,'계좌번호를 입력하세요');		
	if(!$mb_bank_user) alert_json(false,'예금주를 입력하세요');		
	
	//지갑 주소 중복
	$data=sql_fetch_array("select count(*) cnt from {$g5['member_table']} where mb_Id!='$member[mb_id]' and mb_bank = '{$mb_bank}' and mb_bank_num = '{$mb_bank_num}' ");
	if($data[cnt] > 0) alert_json(false,'이미 사용중인 계좌번호 입니다');		
	
						
    $sql = " update {$g5['member_table']}
                set 				
				mb_bank		 = '{$mb_bank}',
				mb_bank_num		 = '{$mb_bank_num}',
				mb_bank_user		 = '{$mb_bank_user}'
				
				where mb_Id='$member[mb_id]'";
				
	
	//echo $sql;				
    $result= sql_query($sql,false);	
	
	if($result) alert_json(true,'',array('mb_bank'=>$mb_bank,'mb_bank_num'=>$mb_bank_num,'mb_bank_user'=>$mb_bank_user));	
	else alert_json(false,'저장 할 수 없습니다');	
}


//계정의 활성 비활성
else if ( $w == 'u6') {
	
	//부계정 계정		
	if($ac_id ){

		$srpoint=get_mempoint($member['mb_id'],$ac_id);
		if($srpoint['i']['_enable'] < $cset['staking_amt']) alert_json(false, '최소 보유금액이 부족합니다.');	

		$sql = " update {$g5['cn_sub_account']}
		set ac_active='1'
		where 	mb_id='{$member[mb_id]}' and ac_id='$ac_id'";
		$result=sql_query($sql,1);
		if(!$result) alert_json(false,'변경 할 수 없습니다');
		$ac=get_submember($ac_id);
		alert_json(true,'',$ac);	


	}
	/*
	if($mb_id ){	

		$mrpoint=get_mempoint($mb_id,$mb_id);
		if($mrpoint['i']['_enable'] < $cset['staking_amt']) alert_json(false,'최소 보유금액이 부족합니다.');	

	   $sql = " update  {$g5['member_table']}
		set mb_active ='1'
		where 	mb_id='{$member[mb_id]}'";

			$mb_active=1;

		$result=sql_query($sql,1);
		if(!$result) alert_json(false,'변경 할 수 없습니다');

		 alert_json(true,'',array('mb_no'=>$member[no],'mb_id'=>$mb_id,'mb_active'=>$mb_active));	
		
	 }
	 */
		
	
}

//테더정보 수
else if ( $w == 'u7') {
	
	$mb_wallet_addr_u=trim($_POST[mb_wallet_addr_u]);
	
	if(!$mb_wallet_addr_u) alert_json(false,'지갑 주소를 입력하세요');	
	
	//지갑 주소 중복
	$data=sql_fetch_array("select count(*) cnt from {$g5['member_table']} where mb_Id!='$member[mb_id]' and mb_wallet_addr_u = '{$mb_wallet_addr_u}' ");
	if($data[cnt] > 0) alert_json(false,'이미 사용중인 주소 입니다');		
	
	$rtn=balance_coin_usdt($mb_wallet_addr_u);
	if(!$rtn[0])  alert_json(false,'확인되지 않는 주소 입니다');	
	
    $sql = " update {$g5['member_table']}
                set 				
				mb_wallet_addr_u		 = '{$mb_wallet_addr_u}'
				where mb_Id='$member[mb_id]'";
				
	
	//echo $sql;				
    $result= sql_query($sql,false);	
	
	if($result) alert_json(true,'',array('mb_wallet_addr_u'=>$mb_wallet_addr_u));	
	else alert_json(false,'저장 할 수 없습니다');	
}



?>