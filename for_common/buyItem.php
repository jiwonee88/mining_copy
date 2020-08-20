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
        
    </div>
	
	
	 <div class="deal">
        <div class="wrap">
            <ul class="crown">
				
			<?			
				
			foreach($g5['cn_item'] as $k=>$v){?>
			
                <li>
                    <h3><?=lng($v[name_kr])?></h3>
                    <div class="clearfix">
                        <div class="f_left"><img src="<?=G5_THEME_URL?>/images/item/<?=$v[img]?>" alt="" class="itemImg"/></div>
                        <ul class="dealDesc f_left p-0">
                            <li class='text-left'>
                                <span><?=lng('보유량')?> : <?=$cn_item[$k]?$cn_item[$k]:'0'?> <?=lng('개')?></span>
                                <span><?=lng('판매대기')?> : <?=$v[days]?><?=lng('일')?></span>
                                <span><?=lng('판매시수익')?> : <?=number_format2($v[interest])?>%</span>
								<span><?=lng('가격')?> : $<?=number_format2($v[price])?></span>
                            </li>           
                        </ul>
                    </div>
                    <!--div class="longBtn Btn g_Btn buyPopBtn" data-item='<?=$k?>' data-price='<?=swap_coin($v[price],'u',$g5[cn_shop_coin],$sise)?>' data-itemname="<?=lng($v[name_kr])?>"><a href="#"><?=lng('구매하기')?></a></div-->
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
		<input type='hidden' name='it_token' value='u' >			
		<input type='hidden' name='it_set_token' value='<?=$g5[cn_shop_coin]?>' >			
		<input type='hidden' name='cn_item' value='' >				
		<input type='hidden' name='cn_price' value='' >			
				
    <div class="modals_bg pop1_1_bg"></div>
    <div class="wrap closeWrap">
        <div class="closeBtn pop1_1_CloseBtn"><img src="<?=G5_THEME_URL?>/images/closeBtn.svg" alt="닫기" /></div>
    </div>
    <div class="modals-content">
        <h2 class="topTitle"><?=lng('구매하기')?></h2>
        <div class="wrap">
            <div class="sec">
                
                <h2 class="topTitle"><?=lng('계정')?></h2> 
                
				 <select name='smb_id' class='common-select w-80' >
				 <option value='<?=$member[mb_id]?>'  ><?=$member[mb_id]?></option>
				 <?
				 //서브 계정
				 $accresult=sql_query("select * from  {$g5['cn_sub_account']} where mb_id='$member[mb_id]' and ac_id != '{$member['mb_id']}' order by ac_id asc");
				 while($ac=sql_fetch_array($accresult)){?>
				 <option value='<?=$ac[ac_id]?>'  ><?=$ac[ac_id]?></option>
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
                    <li><?=lng('최종결제금액')?> : <is id='sum_str'>0</is> <?=$g5[cn_cointype][$g5[cn_shop_coin]]?></li>
                </ul>
                <!--button type="submit"><?=lng('저장')?></button--> 
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
			
			$(".item-name").html($(this).attr('data-itemname'));
			$("input[name=cn_item]","#buyform").val($(this).attr('data-item'));
			$("input[name=cn_price]","#buyform").val($(this).attr('data-price'));

			$(".sendInfo.buyPopup").addClass("on");
			$(".mask").addClass("on");

			sum();
			
			
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


function sum(){
	var price=$('input[name=cn_price]','#buyform').val();	
	var qty=$('select[name=qty] option:selected','#buyform').val();
	
	var sum=parseInt(price) * parseInt(qty);
	
	$('#sum_str').html(inputNumberFormat(sum));
}

//  상품 구매

function buyform_submit(f)
{
	
		
	event.preventDefault();
	Swal.fire({
	  title: '',
	  text: "<?=lng('구매를 진행하시겠습니까')?>",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: '<?=lng('진행합니다')?>'
	}).then((result) => {
	  if (result.value) {		
	
			var formData = $(f).serialize();		

			$.ajax({
				type: "POST",
				url: "./coin_purchase_item.php",
				data:formData,
				cache: false,
				async: false,
				dataType:"json",
				success: function(data) {

					if(data.result==true){			
						$(".sendInfo.buyPopup").removeClass("on");
						$(".mask").removeClass("on");
						//document.location.href='./page04.html';
						//document.location.href='./fee.php';Swal.fire({text:'접수되었습니다. 입금 확인후 처리 됩니다.',timer:1000});  
						
						$('.enableAmt').html(inputNumberFormat(data.datas['remainAmt'].toFixed(0)));
						
						Swal.fire({text:data.message});

					}
					else Swal.fire({text:data.message});
				}
			});		
	
	
	  } //if (result.value) {
	})
	
	return;
	
	
}

  </script>

<?	
include_once('../_tail.php');
?>