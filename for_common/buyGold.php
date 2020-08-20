<?php
include_once('./_common.php');
add_javascript('<script src="'.G5_THEME_URL.'/extend/clipboard.min.js"></script>',1);
include_once('../_head.php');
?>

    <div class="wrap">       
        <div class="topCommon">   
            <div class="userInfo">
                <img src="<?=G5_THEME_URL?>/images/userBg.svg">
                <span><img src="<?=G5_THEME_URL?>/images/user.svg" alt="USER07" class="userImg"/></span>
                <span class="userName" onclick="document.location.href='/for_common/myPage.php'"><span><?=$member[mb_id]?> <?=lng('님')?></span></span>
            </div>  
        </div>
        

        <div class="sec setting pb0">
            <div class="position">
                <div class="longBtn Btn w_btn dollar"><a><span>$<?=number_format2($rpoint['i']['_enable'])?> </span></a></div>
                <div class="Btn go buyPopBtn"><a><span><?=lng('구매')?></span></a></div>
            </div>          
        </div>        
    </div>
	
	
	
    <div class="checkBox">
       <div class="wrap">
            <ul class="crown activeId">
                
				<?
			//신청내역 - 입금 준비중인 것만 표
			$result=sql_query("select * from  {$g5['cn_purchase_table']} where mb_id='$member[mb_id]' and in_stats='1' order by in_no desc");
			while($data=sql_fetch_array($result)){?>
				
				<li class='py-3' >
				<form name='depositform<?=$data[in_no]?>' id='depositform<?=$data[in_no]?>' onsubmit='depositform_submit(this);' >
			<input type='hidden' name='w' value='u' >	
			<input type='hidden' name='in_no' value='<?=$data[in_no]?>' >
			<p><?=lng('등록일')?> : <?=$data[in_wdate]?></p>
			<p><?=lng('상태')?> : <?=$g5[purchase_stat][$data[in_stats]]?></p>
			
              <p><?=lng('주문상품')?> :<?=$data[in_item]?> x <?=$data[in_item_qty]?></p>
            
              <p><?=lng('수량')?> : <?=number_format2($data[in_set_amt])?> <?=$g5[cn_cointype][$data[in_set_token]]?></p>
            
              <p><?=lng('가격')?> : $ <?=number_format2($data[in_rsv_amt])?> <?=$g5[cn_cointype][$data[in_token]]?></p>
            
              <p><?=lng('원화가격')?> : KRW <?=number_format2($data[in_rsv_amt])*1200?></p>
            
              
            <div class="position border-top py-2 my-2"> 
			 <p><?=lng('USDT 지갑주소')?></p>
                        
              <p class="d-block btn-clipboard w-90" data-clipboard-text="<?=$data[in_wallet_addr]?>" >
			  <span class="text-narrow025" style='word-break:break-all;' ><?=$data['in_wallet_addr']?$data['in_wallet_addr']:lng('미지정')?></span>
               <span class="copy"></span>
              </p>
			  </div> 
			<div class="position border-top py-2 my-2"> 
				<p><?=lng('은행정보')?></p>
					<p><?=lng('은행명')?> : <?=$cset[bank_name]?></p>
				  
					<p><?=lng('계좌번호')?> : <?=$cset[bank_num]?></p>
					<p><?=lng('예금주')?> : <?=$cset[bank_user]?></p>
			 </div> 
			<div class="position border-top py-2 my-2"> 
				<input type="text" name='in_txn_id' value='<?=$data[in_txn_id]?>' placeholder="<?=lng('계좌 입금자명 or Txid 붙여넣기')?>">
				  <p class="txn">* <?=lng('계좌 입금자명 또는 Transaction Hash (테더 전송 거래 번호)')?></p>
				<p class="txn">* <?=lng('반드시 입력해야합니다. 미 입력시 승인 불가능')?></p>
			  
				  <div class="bottomArea">
						<button type='submit' class="smallBtn" ><?=lng('결제 확인')?></button>

				  </div>
                   </div>
				
					
					</form>
                </li> 
				
			  <? }?>
            </ul> 
        </div>  
    </div>
	
	

<!-- 구매 팝업 -->  
<div class="modals pop1_1">
<form name='buyform' id='buyform' onsubmit='buyform_submit(this);' >
			<input type='hidden' name='w' value='' >	
			<input type='hidden' name='mb_id' value='<?=$member[mb_id]?>' >
			<input type='hidden' name='tr_token' value='u' >
			<input type='hidden' name='tr_set_token' value='i' >
				
    <div class="modals_bg pop1_1_bg"></div>
    <div class="wrap closeWrap">
        <div class="closeBtn pop1_1_CloseBtn"><img src="<?=G5_THEME_URL?>/images/closeBtn.svg" alt="닫기" /></div>
    </div>
    <div class="modals-content">
        <h2 class="topTitle"><?=lng('주의사항')?></h2>
        <div class="wrap">
            <div class="sec">
                <div class="modalsNotice"><?=lng('GOLD 구매시 선택 상품에 따라 할인 적용')?></div>
                <h2 class="topTitle"><?=lng('계정')?></h2> 
                
				<select name='smb_id'>
			 <option value=''  ><?=$member[mb_id]?></option>
			 <?
			 //서브 계정
			 $accresult=sql_query("select * from  {$g5['cn_sub_account']} where mb_id='$member[mb_id]' and ac_id != '{$member['mb_id']}' order by ac_id asc");
			 while($ac=sql_fetch_array($accresult)){?>
			 <option value='<?=$ac[ac_id]?>'  ><?=$ac[ac_id]?></option>
			 <? }?>
			 </select>
			 
			 
                <h2 class="topTitle">GOLD</h2> 
                <select name='item' >
					 <?
					 foreach($g5['cn_golditem'] as $k=>$v){?>
					 <option value='<?=$k?>' data-price='<?=$v[price]?>' data-amt='<?=$v[amt]?>' ><?=lng($v[name_kr])?></option>
					 <? }?>
					 
					 </select>
                <h2 class="topTitle"><?=lng('수량')?></h2> 
              <select name='qty' >
					<?
					for($i=1;$i <=10;$i++){?>
					 <option value='<?=$i?>'><?=$i?></option>
					 <? }?>
					 </select>
                
            </div>
            <div class="sec sendList">
                <ul>
                    <li><?=lng('최종지급수량')?> : <is id='gold_amt_str'>0</is><?=lng('개')?></li>
                    <li><?=lng('최종결제금액')?> : $<is id='gold_sum_str'>0</is></li>
                </ul>
                <button type="submit"><?=lng('저장')?></button> 
            </div>
            
        </div>   

    </div>
	</form>
</div>
<!--// 구매 팝업 -->


<script>
    
    $(document).ready(function () {
	
	
	sum()
	$('select[name=item],select[name=qty]','#buyform').change(function () {
		sum();
	});
	
	
    /* 구매 팝업*/
    $('.buyPopBtn').click(function(){
         $('.pop1_1_bg').show();
         $('.pop1_1').show();
    });
    $('.pop1_1_bg, .pop1_1_CloseBtn').click(function(){
         $('.pop1_1_bg').hide();
         $('.pop1_1').hide();
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

});



//  골드 구매 신
function buyform_submit(f)
{
	event.preventDefault();
	var formData = $(f).serialize();		

	$.ajax({
		type: "POST",
		url: "./coin_purchase_update.php",
		data:formData,
		cache: false,
		async: false,
		dataType:"json",
		success: function(data) {
			console.log(data);
			if(data.result==true){			
				//$('.popup.i02').removeClass('on');
				document.location.href='./buyGold.php';
				//document.location.href='./fee.php';Swal.fire({text:'접수되었습니다. 입금 확인후 처리 됩니다.',timer:1000});  
				
			}
			else Swal.fire({html:data.message}); 
		}
	});		
	return;
}
function sum(){
	var price=$('select[name=item] option:selected','#buyform').attr('data-price');
	var amt=$('select[name=item] option:selected','#buyform').attr('data-amt');
	var qty=$('select[name=qty] option:selected','#buyform').val();
	
	var sum=parseInt(price) * parseInt(qty);
	var tamt=parseInt(amt) * parseInt(qty);
	
	$('#gold_sum_str').html(inputNumberFormat(sum));
	$('#gold_amt_str').html(inputNumberFormat(tamt));
}



//  입금확인 신창
function depositform_submit(f)
{
	event.preventDefault();
	var formData = $(f).serialize();		
	
	var in_txn_id=$('input[name=in_txn_id]',$(f)).val();
	if(in_txn_id==''){
		Swal.fire({text:'<?=lng('Txn Hash를 입력하세요.')?>'});   
		return;
	}
	$.ajax({
		type: "POST",
		url: "./coin_purchase_update.php",
		data:formData,
		cache: false,
		async: false,
		dataType:"json",
		success: function(data) {

			if(data.result==true){
				Swal.fire({text:'<?=lng('등록되었습니다.')?>',timer:1000});   
			}
			else Swal.fire(data.message);       
		}
	});		
	return;
}





  </script>

<?	
include_once('../_tail.php');
?>