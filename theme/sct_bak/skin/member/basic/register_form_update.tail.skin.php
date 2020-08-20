<?
//회원가입시
if($w==''){	
	
	$smb=get_member($mb_id);
	
	//추천인 있는 경우 
	if($mb_recommend){
		
		$pmb=get_member($mb_recommend);				
		if($pmb['mb_id']){
			//수당 지급용 회원 계보도 업데이트
			if($pmb['mb_tree']!='') $_mb_tree=implode(",",array_splice(explode(",",$pmb['mb_tree']),-40));
			else $_mb_tree='';
			
			$mb_tree=($_mb_tree?$_mb_tree.",":"").$mb_recommend;
			
			//계보디비  입력
			update_mb_treedb($mb_tree,$mb_id,'tree');
			
			//직접 추천인수
			$count1=sql_fetch("select count(*) cnt  from {$g5['member_table']} where mb_recommend='{$mb_recommend}' ");			
			
			sql_query("update {$g5['member_table']} set mb_servant_cnt = '{$count1['cnt']}' where mb_id = '$mb_recommend' ");
		}
	}

	//최초 등급 0
	sql_query("update {$g5['member_table']} set mb_servant_cnt = '0',mb_tree='$mb_tree' where mb_id = '$mb_id' ");
	
	
	//이전 휴대 전화 검색	
	$temp=sql_fetch("select cnt(*) cnt from {$g5['member_table']} where mb_hp='$mb_hp' ");		
	
	if($temp[cnt] < 5){
	
		//가입 축하 포인트 지급
		foreach($g5['cn_cointype'] as $k=>$k){
		
			if($cset['join_bonus_'.$k]==0) continue;
			$content['pt_wallet']='free'; //지갑구
			$content['pt_coin']=$k; //화폐구분
			$content['amount']=$cset['join_bonus_'.$k];			
			$content['subject']='가입 축하금';

			set_add_point('joinb',$smb,'',$mb_id,$content);		
		}
	}
	
	//기본 서브 계정 추가
	set_basic_account($mb_id,1);
	
	
}else{
	$smb=get_member($mb_id);
}

//입금 화폐 주소 발행
foreach($g5['cn_coin_in'] as $v){
	if($smb{'mb_wallet_addr_'.$v} =='') align_mb_wallet($mb_id,$v);
}
	
//exit;	
?>