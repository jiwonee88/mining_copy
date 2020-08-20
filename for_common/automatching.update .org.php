<?php
include_once('./_common.php');

if($member[mb_trade_penalty] > 0 ) alert_json(false,"해당 계정은 거래 매칭 미참여로 인해 동결 처리되었습니다");

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
	
	$smb=get_submember($_POST[ac_id]);
	$added=0;
	foreach(array('a','b','c','d','e','f','g','h') as $v){
		if($smb['ac_auto_'.$v]==0 && $_POST['ac_auto_'.$v]=='1' ) $added++;
	}
	
	$srpoint=get_mempoint($member['mb_id'],$_POST[ac_id]);
	
	//if($added > 0 && $srpoint['i']['_enable'] < $cset[staking_amt]) alert_json(false,'최소 보유금액이 부족합니다.');	
	if($added > 0 && $smb[ac_active]!='1' ) alert_json(false,'활성화되지 않은 계정입니다');				
	
	//일시적으로 강제 조정
	foreach(array('a','b','c','d') as $v){
		$_POST['ac_auto_'.$v]='1';
	}
	
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
				
	
	//echo $sql;				
   $result= sql_query($sql);	
	
	if($result) alert_json(true,'ok');	
	else alert_json(false,'저장 할 수 없습니다');	
}

//전체오토매칭
if ( $w == 'al') {
			
	
	//전체 선택
	if($mb_auto_all=='1'){
		
		$isum=get_itemsum($member[mb_id]);
		
		$enable_amt=$member[mb_trade_amtlmt]-$isum[tot][price];
		
		$paid=0;
		
		$chkarr=array();
		
		$cn_item=array_reverse($g5[cn_item]);
		
		//서브계정 전체 취소
		sql_query("update {$g5['cn_sub_account']} 
		set 				
		ac_auto_a		 = '0',
		ac_auto_b		 = '0',
		ac_auto_c		 = '0',
		ac_auto_d		 = '0',
		ac_auto_e		 = '0',
		ac_auto_f		 = '0',
		ac_auto_g		 = '0',
		ac_auto_h		 = '0'

		where mb_id='{$member[mb_id]}'  ",1);
		
		$result=sql_query(" select *  from  {$g5['cn_sub_account']} where mb_id='{$member['mb_id']}' and ac_active='1'  order by ac_id asc",1);
		
		while($data=sql_fetch_array($result)){
		
			$set='';
			$chkarr[$data[ac_no]]=array();
			
			foreach($cn_item as $k => $v){
				
				$paid+=$v[price];
				//echo $enable_amt.'/'.$v[price].'/'. $paid."<br>";
				
				if($enable_amt <= $paid ) break;								
				
				$set.=($set?",":"")." ac_auto_".$k." = '1' ";
				
				$chkarr[$data[ac_no]][]=$k;				
			}
			
			$sql="update {$g5['cn_sub_account']}
				set 				
				$set				
				where ac_no='{$data[ac_no]}' ";
			
			if($set!='') $re=sql_query($sql,1);
			
			//echo $sql;		
		}
			
		if($enable_amt<=0) alert_json(false,'가용금액을 확인하세요');	
	
	//전체 취소
	}else if($mb_auto_all!='1'){
		
		$sql="update {$g5['cn_sub_account']} 
				set 				
				ac_auto_a		 = '0',
				ac_auto_b		 = '0',
				ac_auto_c		 = '0',
				ac_auto_d		 = '0',
				ac_auto_e		 = '0',
				ac_auto_f		 = '0',
				ac_auto_g		 = '0',
				ac_auto_h		 = '0'
				
				where mb_id='{$member[mb_id]}'  ";
		
		//서브계정 전체 취소
		$result=sql_query($sql,1);		
		//echo $sql;
	
	}
		
	
	alert_json(true,'ok',$chkarr);	
	//else alert_json(false,'저장 할 수 없습니다');	
}
?>