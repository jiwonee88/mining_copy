<?php
include_once('./_common.php');
add_javascript('<script src="'.G5_THEME_URL.'/extend/clipboard.min.js"></script>',1);

include_once('../_head.php');

if($stats_stx=='') $stats_stx='1-1';

//$last_date=date("Y-m-d",strtotime('-1 days'));
$last_date=date("Y-m-d");

include_once('./trade_tab.php');
?>

 <div class="wrap">       
        <div class="topCommon">   
            <div class="userInfo">
                <img src="<?=G5_THEME_URL?>/images/userBg.svg">
                <span><img src="<?=G5_THEME_URL?>/images/user.svg" alt="USER07" class="userImg"/></span>
                <span class="userName"  onclick="document.location.href='/for_common/myPage.php'"><span><?=$member[mb_id]?> <?=lng('님')?></span></span>
            </div>  
        </div>
        
        <div class="sec secList">
            <h3><?=lng('구매')?></h3>
            <ul>
				<li onclick="document.location.href='/for_common/buySell.php?stats_stx=1-1'" ><span><?=$buyer_stats[cnt_stats_1]>99?'+99':($buyer_stats[cnt_stats_1]?$buyer_stats[cnt_stats_1]:0)?><?=lng('건')?></span><?=lng('미처리')?></li>
                <!--li onclick="document.location.href='/for_common/buySell.php?stats_stx=1-2'" ><span><?=$buyer_stats[cnt_stats_2]>99?'+99':($buyer_stats[cnt_stats_2]?$buyer_stats[cnt_stats_2]:0)?><?=lng('건')?></span><?=lng('완료대기')?></li-->
                <!--li onclick="document.location.href='/for_common/buySell.php?stats_stx=1-bad'" ><span><?=$buyer_stats[cnt_stats_claim]>99?'+99':($buyer_stats[cnt_stats_claim]?$buyer_stats[cnt_stats_claim]:0)?><?=lng('건')?></span><?=lng('신고')?></li-->
                <li onclick="document.location.href='/for_common/buySell.php?stats_stx=1-3'" class="f_black"><span><?=$buyer_stats[cnt_stats_3]>99?'+99':($buyer_stats[cnt_stats_3]?$buyer_stats[cnt_stats_3]:0)?><?=lng('건')?></span><?=lng('완료')?></li>
				
            </ul>    
        </div>
        <div class="sec secList">
            <h3><?=lng('판매')?></h3>
            <ul>
                <li onclick="document.location.href='/for_common/buySell.php?stats_stx=2-1'"><span><?=$seller_stats[cnt_stats_1]>99?'+99':($seller_stats[cnt_stats_1]?$seller_stats[cnt_stats_1]:0)?><?=lng('건')?></span><?=lng('미처리')?></li>
                <!--li onclick="document.location.href='/for_common/buySell.php?stats_stx=2-2'"><span><?=$seller_stats[cnt_stats_2]>99?'+99':($seller_stats[cnt_stats_2]?$seller_stats[cnt_stats_2]:0)?><?=lng('건')?></span><?=lng('완료대기')?></li-->
                <!--li onclick="document.location.href='/for_common/buySell.php?stats_stx=2-bad'" ><span><?=$seller_stats[cnt_stats_claim]>99?'+99':($seller_stats[cnt_stats_claim]?$seller_stats[cnt_stats_claim]:0)?><?=lng('건')?></span><?=lng('신고')?></li-->
                <li onclick="document.location.href='/for_common/buySell.php?stats_stx=2-3'" class="f_black"><span><?=$seller_stats[cnt_stats_3]>99?'+99':($seller_stats[cnt_stats_3]?$seller_stats[cnt_stats_3]:0)?><?=lng('건')?></span><?=lng('완료')?></li>
            </ul>    
        </div>
        <div class="sec secList secList02 secList03_02">
            <ul>
                <li class="settingBtn" onclick="document.location.href='./myPage.php';"><span>$<?=number_format2($member[mb_trade_amtlmt])?></span><?=lng('설정금액')?></li>
                <li class="f_black"><span>$<?=number_format2($isum[tot][price])?></span><?=lng('보유금액')?></li>
            </ul>    
        </div>
        <div class="longBtn Btn"><a href="./automaching.php">AUTOMACHING</a></div>
        <div class="bar"></div>
    </div>

<?
if($cset[service_block]!='1'){
//매수 거래
if(preg_match("/^1/",$stats_stx)){

	if($cset[service_block]!='1'){

	$sql_common = " from {$g5['cn_item_trade']} a 
	left outer join  {$g5['member_table']} as b on(a.fmb_id=b.mb_id) ";
	$sql_search = " where a.mb_id='{$member[mb_id]}' ";
	if (!$sst) {
		$sst  = "a.tr_code ";
		$sod = "desc";
	}
	
	if($stats_stx=='1-1') $sql_search.=" and tr_stats='1' ";
	else if($stats_stx=='1-2') $sql_search.=" and tr_stats='2' ";
	else if($stats_stx=='1-bad') $sql_search.=" and (tr_buyer_claim='1' or tr_seller_claim='1' ) and tr_stats!='9' and tr_stats!='3'  ";
	else if($stats_stx=='1-3') $sql_search.=" and tr_wdate>='$last_date' and  tr_stats='3' ";
	
	$sql_order = " order by $sst $sod ";
	
	$sql = " select count(*) as cnt {$sql_common} {$sql_search}";
	$row = sql_fetch($sql,1);
	$total_count = $row['cnt'];

	$rows = $config['cf_mobile_page_rows'];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함
	

	$sql = " select a.*,b.mb_id bmb_id,b.mb_hp bmb_hp,b.mb_bank,b.mb_bank_num, b.mb_bank_user, b.mb_trade_paytype ,b.mb_name bmb_name,b.mb_level {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
	$result = sql_query($sql,1);

	$list_num = $total_count - ($page - 1) * $rows;
	 
	}

?>
    <div class="deal">
        <div class="wrap">
            <ul class="crown">

<? 

for ($i=0; $row=sql_fetch_array($result); $i++) {

	$info=$g5[cn_item][$row[cn_item]];	
	
?>
   
 <li>
 	<form name='form_<?=$row[tr_code]?>' id='form_<?=$row[tr_code]?>'  >
			<input type='hidden' name='tr_code' value='<?=$row[tr_code]?>' >	
			<input type='hidden' name='w' value='txin' >	
			
                    <h3><?=lng('매수')?></h3>
                    <div class='text-center'><img src="<?=G5_THEME_URL?>/images/item/<?=$g5[cn_item][$row[cn_item]][img]?>" alt="" /></div>
                    <ul class="w-100">
                        <li>
                            <p><?=lng('구분')?> : <?=$info[name_kr]?></p>
							<p><?=lng('코드')?> : <?=$row[cart_code]?></p>
							<!--p><?=lng('주문번호')?> : <?=$row[tr_code]?></p-->
                            <p><?=lng('구매자')?> : <?=$row[mb_id]?></p>
                            <p><?=lng('판매자')?> : <?=$row[bmb_id]?></p>
                        </li>
                        <li>
                            <p><?=lng('판매자 이름')?> : <?=$row[bmb_name]?></p>
                            <p><?=lng('판매자 연락처')?> : <?=$row[bmb_nation]?'+'.$row[bmb_nation]:$row[bmb_nation];?>
<?=$row[bmb_hp]?></p>
                        </li>
                        <li>
                            <p><?=lng('가격')?> : $<?=number_format2($row[tr_price])?></p>
                        </li>
                        <li>
                            <p><?=lng('수수료')?> : <?=number_format2($row[tr_fee])?></p>
                        </li>
                        <li>
                            <p><?=lng('상태')?> : <?=$g5[tr_stat][$row[tr_stats]]?>
						
							</p>
                        </li>
                        <li>
                            <p><?=lng('주문일')?> : <?=$row[tr_rdate]?></p>
                           <p><?=lng('확정일')?> : <?=!preg_match("/^00/",$row[tr_setdate])?$row[tr_setdate]:'-'?></p>
                        </li> 
						
					
                    </ul>
					
					 <div class='mt-3'>				
                    <div  class="Btn  btn-deposit w-100 mx-auto" data-code='<?=$row[tr_code]?>' ><a href="#"><?=lng('거래완료')?></a></div>
					</div>
					
										
					
		
				</form>
                </li>	 
					 

	<? }
	?>
	
	
				
            </ul>
        </div>        
    </div>
    


<?	
	
	}
	
	
	?>


<? 
//매도
if(preg_match("/^2/",$stats_stx)){

	if($cset[service_block]!='1'){
	
	
	$sql_common = " from {$g5['cn_item_trade']} a 
	left outer join  {$g5['member_table']} as b on(a.mb_id=b.mb_id) ";
	$sql_search = " where  a.fmb_id='{$member[mb_id]}' ";
	if (!$sst) {
		$sst  = "a.tr_code ";
		$sod = "desc";
	}
	
	if($stats_stx=='2-1') $sql_search.=" and a.tr_stats='1' ";
	else if($stats_stx=='2-2') $sql_search.=" and a.tr_stats='2' ";
	else if($stats_stx=='2-bad') $sql_search.=" and (a.tr_buyer_claim='1' or tr_seller_claim='1' ) and a.tr_stats!='9' and a.tr_stats!='3'  ";
	else if($stats_stx=='2-3') $sql_search.="  and  a.tr_stats='3' ";
	
	
	$sql_order = " order by $sst $sod ";
	
	$sql = " select count(*) as cnt {$sql_common} {$sql_search}";
	$row = sql_fetch($sql,1);
	$total_count = $row['cnt'];

	$rows = $config['cf_mobile_page_rows'];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	

	$sql = " select a.*,b.mb_id bmb_id,b.mb_hp bmb_hp,b.mb_nation bmb_nation,b.mb_level,b.mb_name bmb_name  {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
	$result = sql_query($sql,1);

	$list_num = $total_count - ($page - 1) * $rows;

	}
?>

    <div class="deal">
        <div class="wrap">
            <ul class="crown">


<?

for ($i=0; $row=sql_fetch_array($result); $i++) {

	$info=$g5[cn_item][$row[cn_item]];
	
?>	

            <li>
			
			
			 	<form name='form_<?=$row[tr_code]?>' id='form_<?=$row[tr_code]?>'  >
			<input type='hidden' name='tr_code' value='<?=$row[tr_code]?>' >	
			<input type='hidden' name='w' value='complete' >	
			
			
            <h3>매도</h3>
                    <div ><img src="<?=G5_THEME_URL?>/images/item/<?=$g5[cn_item][$row[cn_item]][img]?>" alt="" /></div>
              		<ul class="w-100">
                        <li>
                            <p><?=lng('구분')?> : <?=$info[name_kr]?></p>
							<p><?=lng('코드')?> : <?=$row[cart_code]?></p>
							<!--p><?=lng('주문번호')?> : <?=$row[tr_code]?></p-->
                            <p>구매자 : <?=$row[bmb_id]?></p>
                            <p>구매자 연락처 : <?=$row[bmb_nation]?'+'.$row[bmb_nation]:$row[bmb_nation];?>
		<?=$row[bmb_hp]?></p>
                        </li>
                        <li>
                            <p>판매자 : <?=$row[fsmb_id]?></p>
                        </li>
                        <li>
                            <p>가격 : $<?=number_format2(floor($row[ct_sell_price]/10)*10)?></p>
                        </li>
                        <li>
                            <p>수수료 : <?=number_format2($row[tr_seller_fee])?></p>
                        </li>
                        <li>
                            <p>상태 : <?=$g5[tr_stat][$row[tr_stats]]?>
						
							</p>
                        </li>
                        <li>
                            <p>매도일 : <?=$row[tr_rdate]?></p>
                            <p>확정일 : <?=!preg_match("/^00/",$row[tr_setdate])?$row[tr_setdate]:'-'?></p>
                        </li>      
					
						</ul>
					
                   	<div class='mt-3'>                  
                    <div  class="Btn btn-complete w-100 mx-auto" data-code='<?=$row[tr_code]?>' ><a href="#">거래완료</a></div>
					</div> 
					
			</form>	
          	  </li>
			<?}
			?>
			  
  
            </ul>
        </div>        
    </div>
    
	
<?
}
?>

<?
if(sql_num_rows($result)==0){?>
    <div class="deal">
        <div class="wrap ">
         <p class='text-center py-5'>
<?=lng('검색된 거래가 없습니다')?><br>
<br>
<br>

</p>
        </div>        
    </div>
<? }else{?>

<div class='w-100 d-block mt-2'>
 <?=com_pager_print($total_page,$page,is_mobile() ? $config['cf_mobile_pages'] : $config['cf_write_pages'],"&stats_stx=$stats_stx&page=");?>
 </div>


<?
}

}
?>
<br>
<br>
<?
//아이폰의 경우
if($is_ios==true ){ ?>


<script>
	$(document).ready(function () {
	
		$('.btn-bank').click(function () {
			event.preventDefault();
			var c=$(this).attr('data-code');
			 $('#form_'+c+" .deposit-bank").toggleClass('d-none');
		});
		
		$("button.txid-btn").click(function(){
			var c = $(this).attr('data-code');
			var txid=$("input[name='tr_txid']","#form_"+c).val();
			
			if(txid=='' || txid.length() < 5) {
				alert('<?=lng('TXID가 입력되지 않았습니다')?>');   
				return 
			}

			window.open("https://etherscan.io/tx/"+txid);
		});
		
		$('.btn-deposit').click(function () {			
			event.preventDefault();
			var c=$(this).attr('data-code');
			
			//if(confirm("결제확인을 하셨습니까?\n입금하지 않고 결제확인 처리 하시면 기망행위로 간주하여 \n패널티가 주어질수 있습니다")){
			if(confirm("정말 거래 완료를 진행하시겠습니까?")){
			
				var formData = $('#form_'+c).serialize();	
				
				$.ajax({
					type: "POST",
					url: "./incomplete.update.php",
					data:formData,
					cache: false,
					async: false,
					dataType:"json",			
					success: function(data) {
					
						//alert('입금 확인 신청이 접수되었습니다');					
						alert('거래를 종료하였습니다');
						page_reload();
					}
				});				
			}
		});
		
		
		$('.btn-complete').click(function () {			
			event.preventDefault();
			var c=$(this).attr('data-code');
			
			//if(confirm("정말 거래 완료를 진행하시겠습니까?\n완료된 거래는 재진행이 불가능합니다")){
			if(confirm("정말 거래 완료를 진행하시겠습니까?")){
			
				var formData = $('#form_'+c).serialize();	
				$.ajax({
					type: "POST",
					url: "./incomplete.update.php",
					data:formData,
					//cache: false,
					//async: false,
					dataType:"json",
					success: function(data) {
						alert('거래를 종료하였습니다');					
						page_reload();

					}
				});
	
			}		
			
		});
		
		
		var clipboard = new ClipboardJS('.btn-clipboard');
		clipboard.on('success', function(e) {
			alert('<?=lng('복사완료')?>')
			var selection = window.getSelection();
			selection.removeAllRanges();
		});

		clipboard.on('error', function(e) {
			alert('<?=lng('복사실패')?>')
		});
		
	
		
		$('textarea.text-limit').on('keyup keypress',function () {			
			var limit=$(this).attr('text-limit-len');	
		 	var lng=$(this).val().length;
			if (lng > limit) {
				$(this).val($(this).val().substring(0, limit));
				return false;
			}
			$(this).next('p').find('.text-legnth-val').html(lng);			
		});
		
		//구매자 신고
		$('.btn-buyer-claim').click(function () {			
			event.preventDefault();
			var c=$(this).attr('data-code');
			var memos=$('#form_'+c+' textarea[name=tr_buyer_memo]').val() ;
			if(memos=='' ){
				alert('신고사유를 입력하세요');
				return;
			}
			
			if(confirm("<?=lng('신고를 진행 하시겠습니까')?>")){
				insert_claim(c,'buyer',memos );
			}
			
		});
		
		//판매자 신고
		$('.btn-seller-claim').click(function () {			
			event.preventDefault();
			var c=$(this).attr('data-code');
			var memos=$('#form_'+c+' textarea[name=tr_seller_memo]').val() ;
			if(memos=='' ){
				alert('신고사유를 입력하세요');
				return;
			}
			
			if(confirm("<?=lng('신고를 진행 하시겠습니까')?>")){
				insert_claim(c,'seller',memos);
			}
			
		});
			
	

	});
	
			
	//  신고
	function insert_claim(c,f,m)
	{

		event.preventDefault();
		
		$.ajax({
			type: "POST",
			url: "./incomplete.update.php",
			data:{w:'claim',tr_code:c,from:f,memo:m},
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {

				if(data.result==true){	
					if(f=='buyer'){
						$('#form_'+c +' .buyer-claim').html('<?=lng('구매자 신고중')?> : '+data.datas['tr_note']).removeClass('d-none');					
					}
					if(f=='seller'){
						$('#form_'+c +' .seller-claim').html('<?=lng('판매자 신고중')?> : '+data.datas['tr_note']).removeClass('d-none');						
					}
					alert("<?=lng('신고되었습니다')?>");   
				}
				else alert(data.message);       
			}
		});	
		
		return;
	}
	
	function page_reload(){
		window.location.href='./buySell.php?stats_stx=<?=$stats_stx?>';
	}
	
</script>



<? }else{?>

<script>
	$(document).ready(function () {
	
		$('.btn-bank').click(function () {
			event.preventDefault();
			var c=$(this).attr('data-code');
			 $('#form_'+c+" .deposit-bank").toggleClass('d-none');
			 
			 console.log(c);
			 
		});
		
		$("button.txid-btn").click(function(){
			var c = $(this).attr('data-code');
			var txid=$("input[name='tr_txid']","#form_"+c).val();
			
			if(txid=='' || txid.length < 5) {
				Swal.fire({html:'<?=lng('TXID가 입력되지 않았습니다')?>',timer:2000});   
				return 
			}

			window.open("https://etherscan.io/tx/"+txid);
		});
		
		$('.btn-deposit').click(function () {			
			event.preventDefault();
			var c=$(this).attr('data-code');
			
			Swal.fire({
			  title: '<?=lng('주의')?>',
			  //html: "<?=lng('결제확인을 하셨습니까?<br>입금하지 않고 결제확인 처리 하시면 기망행위로 간주하여 <br>패널티가 주어질수 있습니다')?>",
			  html:"<?=lng('정말 거래 완료를 진행하시겠습니까?')?>",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: '<?=lng('진행합니다')?>'
			}).then(function(result){
			  if (result.value) {	
			  
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
							//$('#form_'+c +' .btn-deposit').hide();	
							//$('#form_'+c +' .btn-deposit-info').hide();	
							//$('#form_'+c +' .stats-str').html('<?=$g5['tr_stat'][2]?>');
							
							/*
							Swal.fire({html:'<?=lng('입금 확인 신청이 접수되었습니다')?>',timer:2000,
								onClose: () => {page_reload()}
									
							  });
							*/
							Swal.fire({
							html:'<?=lng('거래를 종료하였습니다')?>',timer:2000
							}).then(function(result){
							
							  if (result.value) {
								page_reload();
							  }
							})
							
							
							

						}
						else Swal.fire({html:data.message});
							
						
					}
				});	
				
			  }
			})
			
			
		});
		
		
		$('.btn-complete').click(function () {			
			event.preventDefault();
			var c=$(this).attr('data-code');
			
			
			
			Swal.fire({
			  title: '<?=lng('주의')?>',
			  //html: "<?=lng('정말 거래 완료를 진행하시겠습니까?<br>완료된 거래는 재진행이 불가능합니다')?>",
			  html:"<?=lng('정말 거래 완료를 진행하시겠습니까?')?>",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: '<?=lng('진행합니다')?>'
			}).then(function(result){
			  
			  if (result.value) {					
					var formData = $('#form_'+c).serialize();	
					console.log(formData);
					
					$.ajax({
					
						type: "POST",
						url: "./incomplete.update.php",
						data:formData,
						cache: false,
						async: false,
						dataType:"json",
						success: function(data) {
							
							if(data.result==true){					
								//$('#form_'+c +' .stats-str').html(data.datas['stats']);
								//$('#form_'+c +' .setdate-str').html(data.datas['setdate']);
								//$('#form_'+c +' .btn-complete').hide();
								//$('#form_'+c +' .btn-complete-info').hide();					
								
								Swal.fire({
								html:'<?=lng('거래를 종료하였습니다')?>',timer:2000
							   }).then(function(result){
								  if (result.value) {

									page_reload();

								  }
								})
							  
							}
							else Swal.fire({html:data.message});       
							
						
							
						}
					});
					
				
			  }
			})
			
			
		});
		
		
		var clipboard = new ClipboardJS('.btn-clipboard');
		clipboard.on('success', function(e) {
			Swal.fire({html:'<?=lng('복사완료')?>',timer:1000});

			var selection = window.getSelection();
			selection.removeAllRanges();
		});

		clipboard.on('error', function(e) {
			Swal.fire({html:'<?=lng('복사실패')?>',timer:1000});
		});
		
	
		
		$('textarea.text-limit').on('keyup keypress',function () {			
			var limit=$(this).attr('text-limit-len');	
		 	var lng=$(this).val().length;
			if (lng > limit) {
				$(this).val($(this).val().substring(0, limit));
				return false;
			}
			$(this).next('p').find('.text-legnth-val').html(lng);			
		});
		
		//구매자 신고
		$('.btn-buyer-claim').click(function () {			
			event.preventDefault();
			var c=$(this).attr('data-code');
			var memos=$('#form_'+c+' textarea[name=tr_buyer_memo]').val() ;
			if(memos=='' ) Swal.fire({test:'신고사유를 입력하세요'});
			
			 Swal.fire({
			  title: '<?=lng('주의')?>',
			  html: '<?=lng('신고를 진행 하시겠습니까')?>',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: '<?=lng('진행합니다')?>'
			}).then(function(result){
			  if (result.value) {				
				insert_claim(c,'buyer',memos );
			  }
			})
		});
		
		//판매자 신고
		$('.btn-seller-claim').click(function () {			
			event.preventDefault();
			var c=$(this).attr('data-code');
			var memos=$('#form_'+c+' textarea[name=tr_seller_memo]').val() ;
			if(memos=='' ) Swal.fire({test:'신고사유를 입력하세요'});
			
			
			Swal.fire({
			  title: '<?=lng('주의')?>',
			  html: '<?=lng('신고를 진행 하시겠습니까')?>',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: '<?=lng('진행합니다')?>'
			}).then(function(result){
			  if (result.value) {
				
				insert_claim(c,'seller',memos);
			  }
			})
		});
			
	

	});
	
	
	//  신고
	function insert_claim(c,f,m)
	{

		event.preventDefault();
		
		$.ajax({
			type: "POST",
			url: "./incomplete.update.php",
			data:{w:'claim',tr_code:c,from:f,memo:m},
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {

				if(data.result==true){	
					if(f=='buyer'){
						$('#form_'+c +' .buyer-claim').html('<?=lng('구매자 신고중')?> : '+data.datas['tr_note']).removeClass('d-none');					
					}
					if(f=='seller'){
						$('#form_'+c +' .seller-claim').html('<?=lng('판매자 신고중')?> : '+data.datas['tr_note']).removeClass('d-none');						
					}
					Swal.fire({html:'<?=lng('신고되었습니다')?>',timer:2000});   
				}
				else Swal.fire({html:data.message});       
			}
		});	
		
		return;
	}
	
	function page_reload(){
		window.location.href='./buySell.php?stats_stx=<?=$stats_stx?>';
	}
	
</script>
<? 
}?>


<?	
include_once('../_tail.php');
?>
