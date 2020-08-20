<?php
include_once('./_common.php');
add_javascript('<script src="'.G5_THEME_URL.'/extend/clipboard.min.js"></script>',1);

include_once('../_head.php');


//전송 가능 금액
$enable_sum=get_eanble_trans($member[mb_id],$rpoint,'i');
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
                <div class="Btn go buyPopBtn" onclick="document.location.href='/for_common/myPage.php'"><a><span><?=lng('구매')?></span></a></div>
            </div>          
        </div>        
    </div>

	

<!-- 전송하기 -->  

<form id="transferform" name="transferform" action="./coin_transfer_others.php" onsubmit="return  transferform_submit(this);" method="post"  autocomplete="off" >                                                
			<input type="hidden" name="w" value="u">
			<input type="hidden" name="mb_id" value="<?=$member['mb_id']?>">
			<input type="hidden" name="tr_token" value="i">


    <div>
        <div class="wrap">
            <div class="sec">
               
			
				<h2  class="topTitle"><?=lng('전송가능금액')?></h2>
			<input name="enable_amt" type="text" id="enable_amt" class='common-input w-100' value="<?=number_format($enable_sum)?>"  placeholder="0" readonly>	
				
			<h2  class="topTitle"><?=lng('전송받을 회원 아이디')?></h2>
			 <input name="tmb_id" type="text" id="tmb_id" class='common-input w-100' value="<?=$_POST['scanned_id']?>"  placeholder="<?=lng('회원 아이디')?>">
                   
					
					
              <h2  class="topTitle" ><?=lng('전송할 GOLD수량')?></h2>
              <input name="tr_amt" type="text" id="tr_amt" class='common-input number-comma w-100'  placeholder="<?=lng('전송수량')?>">  	
			 
			 
                
            </div>
            <div class="sec sendList">                
                <button type="submit"><?=lng('전송')?></button> 
            </div>
            
        </div>   

    </div>
	</form>

<!--// 구매 팝업 -->


<script>
// submit 최종 폼체크
function transferform_submit(f){

	/*
	// 이체 비밀번호 검사
	var msg = mb_deposite_pass_check($("input[name=mb_id]").val(),$("input[name=pass]").val());
	if (msg) {
		Swal.fire(msg);
		f.pass.select();
		return false;
	}
	*/
	$(f).find('button[type=submit]').attr('disabled',true);
	event.preventDefault();
	var formData = $(f).serialize();	

	$.ajax({
		type: "POST",
		url: "./coin_transfer_others.php",
		data:formData,
		cache: false,
		async: false,
		dataType:"json",
		success: function(data) {

			if(data.result==true){					

				f.reset();

				$('.balance-value').html(data.datas['enable_amt']);
				$('.balance-value-enable').html(data.datas['trans_enable_amt']);
				$('input[name=enable_amt]').val(data.datas['trans_enable_amt']);
				
				
				//$('.balance-value-usd').html(data.datas['max_enable_usd'])
				//$("input[name='max_enable']").val(data.datas['max_enable']);

				Swal.fire('<?=lng('전송이 완료 되었습니다')?>');   
			}
			else Swal.fire({html:data.message});       
		}
	});		
	$(f).find('button[type=submit]').attr('disabled',false);
	return;

}           

  </script>

<?	
include_once('../_tail.php');
?>