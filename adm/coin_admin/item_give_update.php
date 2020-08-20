<?php
$sub_menu = "700250";
include_once('./_common.php');


auth_check($auth[$sub_menu], 'w');

check_admin_token();


if ($w == 'u') {
	
	if($buy_date=='') $buy_date=date("Y-m-d"); 
	else $buy_date.=' '.$buy_time;
	
	$mb=get_member($mb_id);
	if($mb[mb_id]=='') alert('지급될 회원을 찾을 수 없습니다');
	
	if($smb_id){
		$smb=get_submember($smb_id);
		if($smb[ac_id]=='' || $smb[mb_id]!=$mb_id) alert('지급될 서브계정이 없거나 다른 회원의 서브계정입니다');
		
		$npoint=get_mempoint($mb_id,$smb_id);
	}else{
	
		$npoint=get_mempoint($mb_id,$mb_id);
	}
	
	//echo $npoint[$g5['cn_fee_coin']]['_enable'];
	//if(only_number($tot_fee) > $npoint[$g5['cn_fee_coin']]['_enable']) alert('수수료가 부족합니다');
	
	
	if($smb_id=='' ) $smb_id=$mb_id;
	
	//상품지급
	foreach($g5['cn_item'] as $k=> $v) { 
	
		$qty=$item_qty[$k];		
		$org_price_val=only_number($org_price[$k]);
		$org_days_val= only_number($org_days[$k]);
		$validdate=date("Y-m-d",strtotime("+ {$org_days_val} days",strtotime($buy_date)));
		//예정가격
		$sell_price_val=floor( ($org_price_val + ($org_price_val*$v['interest']/100))*10 )/10;
		
		
		$ct_logs="직접지급 by {$member[mb_id]} / {$_SERVER[REMOTE_ADDR]} / 총 $qty개 지급";
		
		for($i=1;$i <= $qty;$i++){
	
			//지급코드			
			$ct_logs_val=addslashes($ct_logs. " ({$i}/{$qty})");			
			
			$sql="insert into {$g5['cn_item_cart']}
			set 
			cn_item='$k',
			mb_id='$mb_id',
			smb_id='$smb_id',
			fmb_id='$member[mb_id]',
			fsmb_id='$member[mb_id]',

			ct_buy_price='$org_price_val',
			ct_sell_price='$sell_price_val',

			ct_class='1',
			ct_interest='$v[interest]',
			ct_days='$org_days_val',
			ct_validdate='$validdate',

			ct_wdate='$buy_date',
			
			ct_manual='1',
			ct_logs='$ct_logs_val',
			
			ct_rdate=now()
						
			";
			
			sql_query($sql);
			
			$ct_id=sql_insert_id();
			$code= get_itemcode($k,$ct_id);	
			
			// 코드 업데이트
			sql_query("update {$g5['cn_item_cart']} set code='$code' where ct_id='$ct_id' " );			
			
			
			
		}
	
	}	
	
	if(!$neverend) goto_url("./item_cart_list.php");
	else  goto_url("./item_give_form.php");
	
}
	
?>