<?php

//error_reporting(E_ALL);

//ini_set("display_errors", 1);



include_once('./_common.php');

$outer_css='  stoneDetail fee';
add_javascript('<script src="'.G5_THEME_URL.'/extend/clipboard.min.js"></script>',1);
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
                   
				   <li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=1-1'><span class="f_yellow"><?=$buyer_stats[cnt_stats_1]>999?'+999':($buyer_stats[cnt_stats_1]?$buyer_stats[cnt_stats_1]:0)?>건</span><span class="condition">미처리</span></a></li>
                    <li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=1-2'><span class="f_yellow"><?=$buyer_stats[cnt_stats_2]>999?'+999':($buyer_stats[cnt_stats_2]?$buyer_stats[cnt_stats_2]:0)?>건</span><span class="condition">완료대기</span></a></li>
                    <li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=1-bad'><span class="f_yellow"><?=$buyer_stats[all_claim]>999?'+999':($buyer_stats[all_claim]?$buyer_stats[all_claim]:0)?>건</span><span class="condition">신고</span></a></li>
                    <li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=1-3'><span class="f_yellow"><?=$buyer_stats[cnt_stats_4]>999?'+999':($buyer_stats[cnt_stats_3]?$buyer_stats[cnt_stats_3]:0)?>건</span><span class="condition confirm">완료</span></a>
                    </li>
                </ul>
				
				<h5 class='mt-3'>판매</h5>
                <ul class="buy sell">                    
				<li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=2-1'><span class="f_yellow"><?=$seller_stats[cnt_stats_1]>999?'+999':($seller_stats[cnt_stats_1]?$seller_stats[cnt_stats_1]:0)?>건</span><span class="condition">미처리</span></a></li>
                    <li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=2-2'><span class="f_yellow"><?=$seller_stats[cnt_stats_2]>999?'+999':($seller_stats[cnt_stats_2]?$seller_stats[cnt_stats_2]:0)?>건</span><span class="condition">완료대기</span></a></li>
                    <li class="squareWB"><a href='/for_common/incomplete.php?stats_stx=2-3'><span class="f_yellow"><?=$seller_stats[cnt_stats_4]>999?'+999':($seller_stats[cnt_stats_3]?$seller_stats[cnt_stats_3]:0)?>건</span><span class="condition confirm">완료</span></a>
                    </li>
                </ul>
            </div>
            <div class="area area02">
                <ul class="buy sell">
                    <li class="squareWB" onclick="location.href='/for_common/idDetail.php'"><span class="f_yellow">$<?=number_format2($member[mb_trade_amtlmt])?></span><span
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
if(preg_match("/^1/",$stats_stx)){

	$sql_common = " from {$g5['cn_item_trade']} a 
	left outer join  {$g5['member_table']} as b on(a.fmb_id=b.mb_id) ";
	$sql_search = " where (1) and a.mb_id='{$member[mb_id]}' ";
	if (!$sst) {
		$sst  = "a.tr_code ";
		$sod = "desc";
	}
	
	if($stats_stx=='1-1') $sql_search.=" and tr_stats='1' ";
	else if($stats_stx=='1-2') $sql_search.=" and tr_stats='2' ";
	else if($stats_stx=='1-bad') $sql_search.=" and (tr_buyer_claim='1' or tr_seller_claim='1' )  ";
	else if($stats_stx=='1-3') $sql_search.=" and tr_stats='3' ";
	
	$sql_order = " order by $sst $sod ";
	
	$sql = " select count(*) as cnt {$sql_common} {$sql_search}";
	$row = sql_fetch($sql,1);
	$total_count = $row['cnt'];

	$rows = $config['cf_mobile_page_rows'];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	

	$sql = " select a.*,b.mb_id bmb_id,b.mb_hp bmb_hp,b.mb_bank,b.mb_bank_num, b.mb_bank_user, b.mb_trade_paytype  {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
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
                    <li>내 계정 : <?=$row[smb_id]?></li>

<li>-------------------------------------------</li>
                    <li>거래번호 : <?=$row[tr_code]?></li>
                    <li>주문일 : <?=$row[tr_rdate]?>(싱가폴)</li>
                    <li>결제일 : <?=!preg_match("/^00/",$row[tr_paydate])?$row[tr_paydate]:'-'?></li>
                    <li>확정일 : <?=!preg_match("/^00/",$row[tr_setdate])?$row[tr_setdate]:'-'?></li>
			<li>상태 : <?=$g5['tr_stat'][$row[tr_stats]]?></li>


		           <li>-------------------------------------------</li>         
					<?
					if($row[tr_paytype]!='cash'){
					
					if($row[tr_discount] > 0){?>					
					<li>가격 : $ <?=number_format2($row[tr_price_org])?></li>	
					<? }else{?>
					<li>가격 : $ <?=number_format2($row[tr_price])?></li>
					<? }
					
					}
					?>
					<?
					if( $row[tr_paytype]=='cash' || $row[tr_paytype]=='both' ){?>
					<li>원화가격 : ￦ <?=number_format2($row[tr_price_org]*$g5['cn_won_usd'])?></li>
					<? }?>
					<li>할인가격 : $ <?=number_format2($row[tr_price])?>(<?=number_format2($row[tr_discount])?>%↓)</li>
					
                    <li>수수료 : <?=number_format2($row[tr_fee])?> <?=$g5[cn_cointype][$row[cn_fee_coin]]?></li>
                    
			<li>-------------------------------------------</li>
			<li>판매자 계정 : <?=$row[fsmb_id]?></li>
		    <li>판매자 연락처 : <?=$row[bmb_hp]?></li>  

                </ul>
				
				<ul class='deposit-bank d-none'>
					
					<?
					if( $row[tr_paytype]=='cash' || $row[tr_paytype]=='both' ){?>
						<?
						//회사직영
						if($row[tr_distri]=='hq'){?>

						<li>은행명 : 신협</li>
						<li>계좌번호 : 132 086 163765</li>
						<li>예금주 : 최상준</li>								
						<?}else{?>					
						<li>은행명 : <?=$row[tr_bank]?></li>
						<li class="btn-clipboard text-narrow0" data-clipboard-text="<?=$row[tr_bank_num]?>">계좌번호 : <?=$row[tr_bank_num]?></li>
						<li>예금주 : <?=$row[tr_bank_user]?></li>			
						<? }?>
					<? }?>
						
					<?
					if($row[tr_paytype]!='cash' && $row[tr_wallet_addr]!='' ){?>
					 <li class="btn-clipboard text-narrow0" data-clipboard-text="<?=$row[tr_wallet_addr]?>">USDT 지갑주소 : <?=$row[tr_wallet_addr]?></li>
					 <? }?>
					 
					 <?
					if($row[bmb_hp]!=''){?>
					                    
					<? }?>
                </ul>
				<?
				if($row[tr_paytype]!='cash' && $row[tr_wallet_addr]!='' ){?>
                <input name="tr_txid" type="text" class="orderCopy" id="tr_txid" value="<?=$row[tr_txid]?>" placeholder="Txid Hash 복사 후 붙여넣기">
                <div class="orderCopyNum">* 테더를 전송하는 경우에만 입력해주세요!</div>
                <div class="orderCopyNum">* 테더 구매시 txid를 입력치 않으면 구매완료 처리 되지 않습니다.</div>

				<? }?>
				
				<?
				if( $row[tr_bank_num]!='' || $row[tr_distri]=='hq'){?>
                <input name="tr_deposit" type="text" class="orderCopy" id="tr_deposit" value="<?=$row[tr_deposit]?>" placeholder="입금자명 + 아이디">
                <div class="orderCopyNum">* 계좌 전송하는 경우에만 입력해주세요!</div>
                <div class="orderCopyNum">* 계좌 이체 시 기입하지 않으면 구매완료 처리 되지 않습니다.</div>

				<? }?>
				
                <div class="storeBuy">
                    <ul>
                        <li>
                            <button type='button' class='btn-bank' data-code='<?=$row[tr_code]?>' >입금정보</button>
                        </li>
                        <!--li>
                            <button>독촉</button>
                        </li>
                        <li>
                            <button>신고</button>
                        </li-->
						<?
						if($row[tr_stats]!='3'){?>
                        <li>
                            <button type='button' class='btn-deposit' data-code='<?=$row[tr_code]?>' >결제확인</button>
                        </li>
						<? }?>
                    </ul>
                </div>
				</form>
				
            </div>
	<?}?>

<? }?>

<? 
//판매
if(preg_match("/^2/",$stats_stx)){

	$sql_common = " from {$g5['cn_item_trade']} a 
	left outer join  {$g5['member_table']} as b on(a.mb_id=b.mb_id) ";
	$sql_search = " where (1) and a.fmb_id='{$member[mb_id]}' ";
	if (!$sst) {
		$sst  = "a.tr_code ";
		$sod = "desc";
	}
	
	if($stats_stx=='2-1') $sql_search.=" and tr_stats='1' ";
	else if($stats_stx=='2-2') $sql_search.=" and tr_stats='2' ";
	else if($stats_stx=='2-bad') $sql_search.=" and (tr_buyer_claim='1' or tr_seller_claim='1' )  ";
	else if($stats_stx=='2-3') $sql_search.=" and tr_stats='3' ";
	
	
	$sql_order = " order by $sst $sod ";
	
	$sql = " select count(*) as cnt {$sql_common} {$sql_search}";
	$row = sql_fetch($sql,1);
	$total_count = $row['cnt'];

	$rows = $config['cf_mobile_page_rows'];
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
				<?if($stats_stx=='2-1'){?>
				<li>구매자 계정: <?=$row[smb_id]?></li> 
				<? }?>
<?if($stats_stx=='2-2'){?>
				<li>구매자 계정: <?=$row[smb_id]?></li> 
				<? }?>

<li>구매자 연락처 : <?=$row[bmb_hp]?></li> 
<li>-------------------------------------------</li>
                <li>거래번호 : <?=$row[tr_code]?></li>
<li>주문일 : <?=$row[tr_rdate]?></li>
                <li>결제일 : <?=!preg_match("/^00/",$row[tr_paydate])?$row[tr_paydate]:'-'?></li>
				<li class='setdate-str'>확정일 : <?=!preg_match("/^00/",$row[tr_setdate])?$row[tr_setdate]:'-'?></li>
<li class='stats-str'>상&nbsp;태 :
<?=$g5['tr_stat'][$row[tr_stats]]?></li>

                 <li>-------------------------------------------</li>

				<?
					if($row[tr_paytype]!='cash'){
					
					if($row[tr_discount] > 0){?>					
				<li>가격 : $ <?=number_format2($row[tr_price_org])?></li>	
				<li>할인가격 : $ <?=number_format2($row[tr_price])?></li>
				<li>할인율 :  <?=number_format2($row[tr_discount])?>%</li>
					
				<? }else{?>
				<li>팔릴가격 : $<?=number_format2($row[tr_price])?></li>
				<? }
				}
				
				if( $row[tr_paytype]=='cash' || $row[tr_paytype]=='both' ){?>
				<li>원화가격 : ￦ <?=number_format2($row[tr_price_org]*$g5['cn_won_usd'])?></li>
				<? }?>
          
					
                <li>수수료 : <?=number_format2($row[tr_fee])?> <?=$g5[cn_cointype][$row[cn_fee_coin]]?></li>
				
                <li>-------------------------------------------</li>

<li>판매자 계정(내 계정) : <?=$row[fsmb_id]?></li>


            </ul>
				
			<ul class='deposit-bank d-none'>
					
				<?
					if($row[tr_paytype]=='cash' ||  $row[tr_paytype]=='both') {?>
					<?
						//회사직영
						if($row[tr_distri]=='hq'){?>

			<li>은행명 : 신협</li>
						<li>계좌번호 : 132 086 163765</li>
						<li>예금주 : 최상준</li>								
						<?}else{?>					
						<li>은행명 : <?=$row[tr_bank]?></li>
						<li>계좌번호 : <?=$row[tr_bank_num]?></li>
						<li>예금주 : <?=$row[tr_bank_user]?></li>			
						<? }?>
					<? }?>	
					<?
					if($row[tr_paytype]!='cash'){?>
           			 <li class="btn-clipboard text-narrow0" data-clipboard-text="<?=$row[tr_wallet_addr]?>">USDT 지갑주소 : <?=$row[tr_wallet_addr]?></li>
					 <? }?>
					 
                </ul>
				<?
				if($row[tr_paytype]!='cash' && $row[tr_wallet_addr]!='' ){?>
                <input name="tr_txid" type="text" class="orderCopy" id="tr_txid"  value='<?=$row[tr_txid]?>' readonly >
                <div class="orderCopyNum">* Transaction Hash : 테더 전송 거래 번호</div>
				<? }?>
				<?
				if($row[tr_bank_num]!='' || $row[tr_distri]=='hq' ){?>
            <input name="tr_deposit" type="text" class="orderCopy" id="tr_deposit" value="<?=$row[tr_deposit]?>" placeholder="입금자명"  readonly >
                <div class="orderCopyNum">* 계좌 이체시 입금자명</div>
				<? }?>
				
				
            <div class="storeBuy">
                    <ul>
                        <li>
                            <button type='button' class='btn-bank' data-code="<?=$row[tr_code]?>" >입금정보</button>
                        </li>
                        <!--li>
                            <button>독촉</button>
                        </li>
                        <li>
                            <button>신고</button>
                        </li-->
						<?
						if($row[tr_stats]!='3'){?>
                        <li>
                            <button type='button' class='btn-complete' data-code='<?=$row[tr_code]?>' >입금확인</button>
                        </li>
						<? }?>
                    </ul>
                </div>
				</form>
            </div>
			
	<?}?>

<? }?>


<?
if(sql_num_rows($result)==0){?>
<div class='text-center mt-5'>
검색된 <?=$g5[cn_item_name]?>이 없습니다
</div>
<? }?>
<div class='w-100 d-block'>
 <?=com_pager_print($total_page,$page,is_mobile() ? $config['cf_mobile_pages'] : $config['cf_write_pages'],"&stats_stx=$stats_stx&page=");?>
 </div>

<script>
	$(document).ready(function () {
		$('.btn-bank').click(function () {
			event.preventDefault();
			var c=$(this).attr('data-code');
			 $('#form_'+c+" .deposit-bank").toggleClass('d-none');
			 
			 console.log(c);
			 
		});
		
		$('.btn-deposit').click(function () {			
			
			var c=$(this).attr('data-code');
			form_submit(c);
		});
		$('.btn-complete').click(function () {			
			event.preventDefault();
			Swal.fire({
			  title: '주의',
			  text: "정말 거래 완료를 진행하시겠습니까? 완료된 거래는 재진행이 불가능합니다",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: '진행합니다'
			}).then((result) => {
			  if (result.value) {
				var c=$(this).attr('data-code');
				trade_end(c);
			  }
			})
			
			
		});
		
		
		var clipboard = new ClipboardJS('.btn-clipboard');
		clipboard.on('success', function(e) {
			Swal.fire({text:'복사완료',timer:1000});

			var selection = window.getSelection();
			selection.removeAllRanges();
		});

		clipboard.on('error', function(e) {
			Swal.fire({text:'복사실패',timer:1000});
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
					$('#form_'+c +' .stats-str').html('상 태 : '+data.datas['stats']);
					$('#form_'+c +' .setdate-str').html('확정일 : '+data.datas['setdate']);
					$('#form_'+c +' .btn-complete').parent('li').hide();
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