<?php

//error_reporting(E_ALL);

//ini_set("display_errors", 1);




include_once('./_common.php');

$outer_css='  stoneDetail fee';

include_once('../_head.php');

$isum=get_itemsum($member[mb_id]);

?>


        <div class="wrap">
            <div class="area area01">
                <h3><span><?=$stats_stx=='1'?'구매내역':'판매내역'?></span></h3>
                <ul class="common">
                    <li class="squareWB hero w50" onclick="location.href='/for_common/idDetail.php'"><span><?=$member[mb_id]?></span></li>
                    <li class="squareWB stone w50"><span class="stoneBg confirm"
                            onclick="location.href='/for_common/fee.php'"> <?=number_format2($rpoint['i']['_enable'])?></span></li>
                </ul>
            </div>
            <div class="area area02">
				 <h5 class='mb-1'>구매</h5>
                <ul class="buy">
                   
				   <li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=1'><span class="f_yellow"><?=$buyer_stats[cnt_stats_1]>99?'+99':($buyer_stats[cnt_stats_1]?$buyer_stats[cnt_stats_1]:0)?>건</span><span class="condition">미처리</span></a></li>
                    <li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=1'><span class="f_yellow"><?=$buyer_stats[cnt_stats_3]>99?'+99':($buyer_stats[cnt_stats_3]?$buyer_stats[cnt_stats_3]:0)?>건</span><span class="condition">완료대기</span></a></li>
                    <li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=1'><span class="f_yellow"><?=$buyer_stats[all_claim]>99?'+99':($buyer_stats[all_claim]?$buyer_stats[all_claim]:0)?>건</span><span class="condition">신고</span></a></li>
                    <li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=1'><span class="f_yellow"><?=$buyer_stats[cnt_stats_4]>99?'+99':($buyer_stats[cnt_stats_4]?$buyer_stats[cnt_stats_4]:0)?>건</span><span class="condition confirm">완료</span></a>
                    </li>
                </ul>
				
				<h5 class='mt-3'>판매</h5>
                <ul class="buy sell">                    
				<li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=2'><span class="f_yellow"><?=$seller_stats[cnt_stats_1]>99?'+99':($seller_stats[cnt_stats_1]?$seller_stats[cnt_stats_1]:0)?>건</span><span class="condition">미처리</span></a></li>
                    <li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=2'><span class="f_yellow"><?=$seller_stats[cnt_stats_3]>99?'+99':($seller_stats[cnt_stats_3]?$seller_stats[cnt_stats_3]:0)?>건</span><span class="condition">완료대기</span></a></li>
                    <li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=2'><span class="f_yellow"><?=$seller_stats[cnt_stats_4]>99?'+99':($seller_stats[cnt_stats_4]?$seller_stats[cnt_stats_4]:0)?>건</span><span class="condition confirm">완료</span></a>
                    </li>
                </ul>
            </div>
            <div class="area area02">
                <ul class="buy sell">
                    <li class="squareWB" onclick="location.href='i/for_common/idDetail.php'"><span class="f_yellow">$<?=number_format2($member[mb_trade_amtlmt])?></span><span
                            class="condition">설정금액</span></li>
                    <li class="squareWB" onclick="location.href='/for_common/idDetail.php'"><span class="f_yellow">$<?=number_format2($isum[tot][price]>$member[mb_trade_amtlmt]?0:$member[mb_trade_amtlmt]-$isum[tot][price])?></span><span
                            class="condition">가용금액</span></li>
                    <li class="squareWB" onclick="location.href='/for_common/stonedetail.php'"><span
                            class="f_yellow">$<?=number_format2($isum[tot][price])?></span><span class="condition confirm">보유금액</span>
                    </li>
                </ul>
            </div>
<? 
//구매
if($stats_stx=='1'){

	$sql_common = " from {$g5['cn_item_trade']} a 
	left outer join  {$g5['member_table']} as b on(a.fmb_id=b.mb_id) ";
	$sql_search = " where (1) and a.mb_id='{$member[mb_id]}' ";
	if (!$sst) {
		$sst  = "a.tr_code ";
		$sod = "desc";
	}
	$sql_order = " order by $sst $sod ";
	
	$sql = " select count(*) as cnt {$sql_common} {$sql_search}";
	$row = sql_fetch($sql,1);
	$total_count = $row['cnt'];

	$rows = $config['cf_page_rows'];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	

	$sql = " select a.*,b.mb_id bmb_id,b.mb_hp bmb_hp,b.mb_bank,b.mb_bank_num, b.mb_bank_user  {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
	$result = sql_query($sql,1);

	$list_num = $total_count - ($page - 1) * $rows;


for ($i=0; $row=sql_fetch_array($result); $i++) {

	$info=$g5[cn_item][$row[cn_item]];
?>
			
            <div class="area area03 squareWB">
				<form name='form_<?=$row[tr_code]?>' id='form_<?=$row[tr_code]?>'  >
				<input type='hidden' name='tr_code' value='<?=$row[tr_code]?>' >	
				<input type='hidden' name='w' value='txin' >	
			
				
                <div class="feeImg"><img src="<?=G5_THEME_URL?>/images/stone/<?=$info[img]?>" alt=""></div>
                <div class="orderTxt"><?=$info[name_kr]?></div>
                <ul>
                    <li>거래번호 : <?=$row[tr_code]?></li>
                    <li>계정 : <?=$row[smb_id]?></li>                    
					<?
					if($row[tr_discount] > 0){?>					
					<li>가격 : $ <?=number_format2($info[price])?></li>	
					<li>할인가격 : $ <?=number_format2($row[tr_price])?></li>
					<li>할인율 : <?=number_format2($row[tr_discount])?>%</li>
					
					<? }else{?>
					<li>가격 : $ <?=number_format2($row[tr_price])?></li>
					<? }?>
					<li>원화가격 : ￦ <?=number_format2($info[price]*$g5['cn_won_usd'])?></li>
					
                    <li>수수료 : <?=number_format2($row[tr_fee])?> <?=$g5[cn_cointype][$row[cn_fee_coin]]?></li>
                    <li>상태 : <?=$g5['tr_stat'][$row[tr_stats]]?></li>
                    <li>주문일 : <?=$row[tr_wdate]?></li>
                    <li>결제일 : <?=!preg_match("/^00/",$row[tr_paydate])?$row[tr_paydate]:'-'?></li>
                    <li>확정일 : <?=!preg_match("/^00/",$row[tr_setdate])?$row[tr_setdate]:'-'?></li>
                </ul>
				
				<ul class='deposit-bank d-none'>
					
					<?
					if($row[tr_paytype]=='both' || $row[tr_paytype]=='cash'){?>
						<?
						//회사직영
						if($row[tr_distri]=='hq'){?>

						<li>은행명 : 신협</li>
						<li>계좌번호 : 132 086 163765</li>
						<li>예금주 : 최상준</li>								
						<?}else{?>					
						<li>은행명 : <?=$row[mb_bank]?></li>
						<li>계좌번호 : <?=$row[mb_bank_num]?></li>
						<li>예금주 : <?=$row[mb_bank_user]?></li>			
						<? }?>
					<? }?>	
						<?
						if($row[tr_paytype]=='both'){?>
						 <li>USDT 지갑주소 : <?=$row[tr_wallet_addr]?></li>
						 <? }?>
						 <?
						if($row[bmb_hp]!=''){?>
						<li>연락처 : <?=$row[bmb_hp]?></li>                    
						<? }?>
                </ul>
				
                <input name="tr_txid" type="text" class="orderCopy" id="tr_txid" value="<?=$row[tr_txid]?>" placeholder="TXN HASH 복사 후 붙여넣기">
                <div class="orderCopyNum">* Transaction Hash : 테더 전송 거래 번호</div>
                <div class="storeBuy">
                    <ul>
                        <li>
                            <button class='btn-bank' data-code='<?=$row[tr_code]?>' >입금정보</button>
                        </li>
                        <!--li>
                            <button>독촉</button>
                        </li>
                        <li>
                            <button>신고</button>
                        </li-->
                        <li>
                            <button class='btn-deposit' data-code='<?=$row[tr_code]?>' >결제확인</button>
                        </li>
                    </ul>
                </div>
				</form>
            </div>
			
	<?}?>

<div class='w-100 d-block'>
 <?=com_pager_print($total_page,$page,G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'],$qstr."&page=");?>
 </div>

<? }?>


<? 
//판매
if($stats_stx=='2'){

	$sql_common = " from {$g5['cn_item_trade']} a 
	left outer join  {$g5['member_table']} as b on(a.mb_id=b.mb_id) ";
	$sql_search = " where (1) and a.fmb_id='{$member[mb_id]}' ";
	if (!$sst) {
		$sst  = "a.tr_code ";
		$sod = "desc";
	}
	$sql_order = " order by $sst $sod ";
	
	$sql = " select count(*) as cnt {$sql_common} {$sql_search}";
	$row = sql_fetch($sql,1);
	$total_count = $row['cnt'];

	$rows = $config['cf_page_rows'];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	

	$sql = " select a.*,b.mb_id bmb_id,b.mb_hp bmb_hp,b.mb_bank,b.mb_bank_num, b.mb_bank_user  {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
	$result = sql_query($sql,1);

	$list_num = $total_count - ($page - 1) * $rows;


for ($i=0; $row=sql_fetch_array($result); $i++) {

	$info=$g5[cn_item][$row[cn_item]];
?>
			
            <div class="area area03 squareWB">
				<form name='form_<?=$row[tr_code]?>' id='form_<?=$row[tr_code]?>'  >
				<input type='hidden' name='tr_code' value='<?=$row[tr_code]?>' >	
				<input type='hidden' name='w' value='complete' >	
			
				
                <div class="feeImg"><img src="<?=G5_THEME_URL?>/images/stone/<?=$info[img]?>" alt=""></div>
                <div class="orderTxt"><?=$info[name_kr]?></div>
                <ul>
                    <li>거래번호 : <?=$row[tr_code]?></li>
                    <li>계정 : <?=$row[fsmb_id]?></li>                    
					<?
					if($row[tr_discount] > 0){?>					
					<li>가격 : $ <?=number_format2($info[price])?></li>	
					<li>할인가격 : $ <?=number_format2($row[tr_price])?></li>
					<li>할인율 : $ <?=number_format2($row[tr_discount])?>%</li>
					
					<? }else{?>
					<li>가격 : $<?=number_format2($row[tr_price])?></li>
					<? }?>
					<li>원화가격 : ￦ <?=number_format2($info[price]*$g5['cn_won_usd'])?></li>
					
					<li>연락처 : <?=$row[bmb_hp]?></li>                    
					
                    <li>수수료 : <?=number_format2($row[tr_fee])?> <?=$g5[cn_cointype][$row[cn_fee_coin]]?></li>
                    <li>상태 : <?=$g5['tr_stat'][$row[tr_stats]]?></li>
                    <li>주문일 : <?=$row[tr_wdate]?></li>
                    <li>결제일 : <?=!preg_match("/^00/",$row[tr_paydate])?$row[tr_paydate]:'-'?></li>
                    <li>확정일 : <?=!preg_match("/^00/",$row[tr_setdate])?$row[tr_setdate]:'-'?></li>
                </ul>
				
				<ul class='deposit-bank d-none'>
					<?
					if($row[tr_paytype]=='both' && $member[mb_bank_num]){?>
                    <li>은행명 : <?=$row[mb_bank]?></li>
					<li>계좌번호 : <?=$row[mb_bank_num]?></li>
					<li>예금주 : <?=$row[mb_bank_user]?></li>			
					<? }?>
					<?
					if($row[tr_paytype]!='cash'){?>
           			 <li>USDT 지갑주소 : <?=$row[tr_wallet_addr]?></li>
					 <? }?>
					 
                </ul>
				
                <input name="tr_txid" type="text" class="orderCopy" id="tr_txid"  value='<?=$row[tr_txid]?>'>
                <div class="orderCopyNum">* Transaction Hash : 테더 전송 거래 번호</div>
                <div class="storeBuy">
                    <ul>
                        <li>
                            <button class='btn-bank' data-code='<?=$row[tr_code]?>' >입금정보</button>
                        </li>
                        <!--li>
                            <button>독촉</button>
                        </li>
                        <li>
                            <button>신고</button>
                        </li-->
                        <li>
                            <button class='btn-complete' data-code='<?=$row[tr_code]?>' >거래완료</button>
                        </li>
                    </ul>
                </div>
				</form>
            </div>
			
	<?}?>

<div class='w-100 d-block'>
 <?=com_pager_print($total_page,$page,G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'],$qstr."&page=");?>
 </div>

<? }?>
<script>
	$(document).ready(function () {
		$('.btn-bank').click(function () {
			event.preventDefault();
			var c=$(this).attr('data-code');
			 $('#form_'+c+" .deposit-bank").toggleClass('d-none');
			 
		});
		$('.btn-deposit').click(function () {
			
			
			var c=$(this).attr('data-code');
			form_submit(c);
		});
		$('.btn-complete').click(function () {			
			
			var c=$(this).attr('data-code');
			trade_end(c);
		});
		
		

	});
	
	//  테더지갑주소변경
	function form_submit(c)
	{

		event.preventDefault();
		var formData = $('#form_'+c).serialize();	

		$.ajax({
			type: "POST",
			url: "./incomplete.update.php",
			data:formData,
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {

				if(data.result==true){					

					Swal.fire({text:'입금 확인 신청이 접수되었습니다',timer:2000});   
				}
				else Swal.fire(data.message);       
			}
		});		
		return;
	}
	
	//  거래 종료
	function trade_end(c)
	{

		event.preventDefault();
		var formData = $('#form_'+c).serialize();	

		$.ajax({
			type: "POST",
			url: "./incomplete.update.php",
			data:formData,
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {

				if(data.result==true){					

					Swal.fire({text:'거래를 종료하였습니다',timer:2000});   
				}
				else Swal.fire(data.message);       
			}
		});		
		return;
	}
	
	
</script>

<?	
include_once('../_tail.php');