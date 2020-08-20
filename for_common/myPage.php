<?php
include_once('./_common.php');
add_javascript('<script src="'.G5_THEME_URL.'/extend/clipboard.min.js"></script>', 1);

include_once('../_head.php');
?>
<style>
.activeId .IdSelect > input +  label:after{ content: '<?=lng('비활성화')?>' !important;}
.activeId .IdSelect > input:checked +  label:after{ content: '<?=lng('활성화')?>' !important;}
</style>
    <div class="wrap">       
        <div class="topCommon">   
            <div class="userInfo">
                <img src="<?=G5_THEME_URL?>/images/userBg.svg">
                <span><img src="<?=G5_THEME_URL?>/images/user.svg" alt="USER07" class="userImg"/></span>
                <span class="userName"  onclick="document.location.href='/for_common/myPage.php'"><span><?=$member[mb_id]?> <?=lng('님')?></span></span>
            </div>  
        </div>
        
        <div class="sec myPageList">
            <h3><?=lng('프로필')?></h3>
            <ul>
                <li>
                    <h4><?=lng('휴대폰번호')?></h4>
                    <div><?=$member[mb_nation]?'+'.$member[mb_nation]:''?> <?=only_number($member[mb_hp])?></div>
                </li>
                <li>
                    <h4><?=lng('계좌번호')?></h4>
                    <div class='mb_bank'><?=$member[mb_bank]?$member[mb_bank]:'-'?> <?=$member[mb_bank_num]?$member[mb_bank_num]:'-'?> <?=$member[mb_bank_user]?$member[mb_bank_user]:'-'?></div>
                    <button type="submit" class="smallBtn changeAcc"><?=lng('계좌정보 등록')?></button> 
                </li>
                <li>
                    <h4>USDT</h4>
                    <div class='mb_wallet_addr_u' style='word-break:break-all;word-wrap:break-word;' ><?=$member[mb_wallet_addr_u]?$member[mb_wallet_addr_u]:'-'?></div>
                    <button type="submit" class="smallBtn changeWal"><?=lng('주소등록')?></button> 
                </li>
                <li>
                    <h4><?=lng('로그인 암호 변경')?></h4>
                    <button type="submit" class="smallBtn changePwd"><?=lng('암호변경')?></button> 
                </li>
                <li>
                    <h4><?=lng('레퍼럴 URL')?></h4>
                    <div class="btn-clipboard" data-clipboard-text="<?=G5_URL?>/?refid=<?=$member[mb_id]?>" ><span ><?=G5_URL?>/?refid=<?=$member[mb_id]?></span><span class="copy"></span></div>
                </li>
            </ul>
        </div>
		  <?php
         //매도액
        $stemp=sql_fetch("select sum(if(ct_validdate <= date(now()),ct_sell_price,0)) ct_sell_price,sum(if(ct_validdate > date(now()),ct_buy_price,0)) ct_buy_price  from {$g5['cn_item_cart']} where is_soled != '1' and mb_id='$member[mb_id]'");
        ?>
		
        <div class="sec setting">
		<div class="longBtn Btn w_btn settingBtn"><a><span><?=lng('설정금액')?> : <is class="mb_trade_amtlmt">$<?=number_format2($member[mb_trade_amtlmt])?></is></span></a></div>
            <div class="secList secList02">
                <ul>
                    <li><div class="longBtn Btn w_btn"><a><?=lng('보유금액')?> : $<?=number_format2($isum[tot][price])?></a></div></li>
                    <li><div class="longBtn Btn w_btn"><a><?=lng('오늘매도액')?> : $<?=number_format2($stemp[ct_sell_price])?></a></div></li>
                </ul>    
            </div>
            <div class="longBtn Btn payPopBtn"><a><span><?=lng('결제방법')?> : 
			<is class="mb_trade_paytype">					
			<?php if ($member[mb_trade_paytype]=='cash') {
            echo lng('현금');
        } elseif ($member[mb_trade_paytype]=='both') {
                echo lng('현금 또는 테더');
            } elseif ($member[mb_trade_paytype]=='usdt') {
                echo lng('테더');
            }
            ?>
			</is></span></a></div>
        </div>
		
		 <?php
            //서브 계정 없으면 추가
            $subadd=set_basic_account($member);
            
            //서브 계정
            $accresult=sql_query("select * from  {$g5['cn_sub_account']} where mb_id='$member[mb_id]'  order by ac_id asc", 1);
            ?> 
        <div class="sec setting pb0">
            <div class="position">
                <div class="longBtn Btn w_btn dollar"><a><span>$<?=number_format2($rpoint['i']['_enable'])?> </span></a></div>
                <div class="Btn go buyPopBtn"><a href='/for_common/buyGold.php'><span><?=lng('구매')?></span></a></div>
            </div>
           <div class="position">
		   <form name='form3'  id='form3' action='./idDetail.update.php' >
			<input type='hidden' name='w' value='u3' >	
			
                <div class="longBtn Btn w_btn align_l mb0 pl20"><a><?=lng('보유계정')?> <is class='account-cnt'><?=sql_num_rows($accresult)-1?>/1<!--?=$cset[max_account_lmt]?--></is></a></div>
                <!--div class="Btn go addAccountBtn"><a><span><?=lng('계정추가')?></span></a></div-->
				</form>
            </div>
             <div class="bar" style="margin-top: 2.24rem;"></div>   
        </div>        
    </div>	
	
	
    <div class="checkBox">
       <div class="wrap">
	   <form name='formaccount' id='formaccount' onsubmit='formaccount_submit(this);' >
			<input type='hidden' name='w' value='u6' >	
			<input type='hidden' name='mb_id' value='' >
			<input type='hidden' name='ac_id' value='' > 
            <ul class="crown activeId">
               
				<?php
            while ($ac=sql_fetch_array($accresult)) {?>			
				
				<li class="<?=!$ac[ac_active]?'IdDisable':''?>"   data-id="<?=$ac[ac_id]?>"   >
                    <div class="IdSelect">
                       <input type="checkbox"  name='active_sub[]' id="acc-<?=$ac[ac_no]?>"  <?=$ac[ac_active]?' checked disabled ':''?> value="<?=$ac[ac_id]?>"  />
                       <label for="acc-<?=$ac[ac_no]?>"  data-id="<?=$ac[ac_id]?>" data-no="<?=$ac[ac_no]?>" ><?=$ac[ac_id]?>
                           <!--div class="Btn go able"><a class="idDetailActive sub-id" data-id="<?=$ac[ac_id]?>"  data-no="<?=$ac[ac_no]?>" ><span><?=lng('비활성화')?></span></a></div-->
                           <div class="Btn go disable"><a class="idDetailActive sub-id" data-id="<?=$ac[ac_id]?>"  data-no="<?=$ac[ac_no]?>"><span><?=lng('활성화')?></span></a></div>
                       </label>
                    </div>
                    <div class="position">
                        <div class="dollar">
						<span>$<is class='gold-enable-<?=$ac[ac_id]!=$ac[mb_id]?$ac[ac_no]:$ac[ac_id]?>' ><?=number_format2($ac['ac_point_i'])?></is></span>
                        </div>
						 <?php
                if ($ac[ac_id]!=$ac[mb_id]) {?>
                        <div class="Btn go sendPopBtn"  data-id="<?=$ac[ac_id]?>" data-no="<?=$ac[ac_no]?>" ><a class='btn-send-gold'  data-id="<?=$ac[ac_id]?>" data-no="<?=$ac[ac_no]?>"><span><?=lng('전송')?></span></a></div>
				<?php }?>		
                    </div>
                </li> 
				
			  <?php }?>
			  	
           
            </ul> 
			</form>		
			
        </div>  
    </div>
	
	
<!-- 계좌번호 팝업 -->  
<div class="modals pop2_1">
	<form name='form5' onsubmit='form5_submit(this);' >
				<input type='hidden' name='w' value='u5' >	
    <div class="modals_bg pop2_1_bg"></div>
    <div class="wrap closeWrap longTop">
        <div class="closeBtn pop2_1_CloseBtn"><img src="<?=G5_THEME_URL?>/images/closeBtn.svg" alt="닫기" /></div>
    </div>
    <div class="modals-content">        
        <h2 class="topTitle"><?=lng('주의사항')?></h2>
        <div class="wrap">
            <div class="sec">
                <div class="modalsNotice">은행정보를 정확하게 입력하지 않으면 거래가 지연되는
                    <span>등의 불이익을 당하실 수도 있습니다.</span></div>
                <h2 class="topTitle"><?=lng('은행정보')?></h2> 
                <input type="text" value="<?=$member[mb_bank]?>"  name="mb_bank" id="mb_bank"  placeholder="">
                <h2 class="topTitle"><?=lng('계좌번호')?></h2> 
                <input type="text" value="<?=$member[mb_bank_num]?>" name="mb_bank_num" id="mb_bank_num" placeholder="">
                <h2 class="topTitle"><?=lng('예금주')?></h2> 
                <input type="text" value="<?=$member[mb_bank_user]?>" name="mb_bank_user" id="mb_bank_user" placeholder="">
                <button type="submit"><?=lng('저장')?></button> 
            </div>   
        </div>
    </div>
	</form>	
</div>
<!--// 계좌번호 팝업 -->

<!-- 주소변경 팝업 -->  
<div class="modals pop2_2">
<form name='form7' onsubmit='form7_submit(this);' >
				<input type='hidden' name='w' value='u7' >	
    <div class="modals_bg pop2_2_bg"></div>
    <div class="wrap closeWrap longTop">
        <div class="closeBtn pop2_2_CloseBtn"><img src="<?=G5_THEME_URL?>/images/closeBtn.svg" alt="닫기" alt=""/></div>
    </div>
    <div class="modals-content">        
        <h2 class="topTitle"><?=lng('주의사항')?></h2>
        <div class="wrap">
            <div class="sec">
                <div class="modalsNotice"><?=lng('정확한 ERC20 지갑 주소를 입력하지 않으시면 입금액을 분실하게 됩니다.')?> <?=lng('ERC20 형식 지갑주소 오입력으로 발생한 모든 피해는 본인의 책임입니다.')?> </div>
                <h2 class="topTitle"><?=lng('지갑주소')?></h2> 
                <input type="text" value=""  name='mb_wallet_addr_u' placeholder="USDT <?=lng('지갑주소')?>">
                <button type="submit"><?=lng('저장')?></button> 
            </div>   
        </div>
    </div>
	</form>	
</div>
<!--// 주소변경 팝업 -->

<!-- 암호변경 팝업 -->  
<div class="modals pop2_3">
<form name='form8' onsubmit='form8_submit(this);' >
				<input type='hidden' name='w' value='u8' >	
    <div class="modals_bg pop2_3_bg"></div>
    <div class="wrap closeWrap longTop">
        <div class="closeBtn pop2_3_CloseBtn"><img src="<?=G5_THEME_URL?>/images/closeBtn.svg" alt="닫기" alt=""/></div>
    </div>
    <div class="modals-content">        
        <h2 class="topTitle"><?=lng('로그인 암호 변경')?></h2>
        <div class="wrap">
            <div class="sec">
                <div class="modalsNotice"><?=lng('새로운 암호를 입력하세요')?></div>
                <h2 class="topTitle"><?=lng('암호입력')?></h2> 
                <input type="passwoord" value="" name='mb_password'  placeholder="<?=lng('암호를입력하세요')?>">
                <h2 class="topTitle"><?=lng('암호확인')?></h2> 
                <input type="password" value="" name='mb_password_re'  placeholder="<?=lng('암호를입력하세요')?>">
                <button type="submit"><?=lng('저장')?></button> 
            </div>   
        </div>
    </div>
	</form>
</div>
<!--// 암호변경 팝업 -->

<!-- 전송 팝업 -->  
<div class="modals pop1">
<form name='form4' id='form4' onsubmit='form4_submit(this);' >
				<input type='hidden' name='w' value='u' >	
				<input type='hidden' name='mb_id' value='<?=$member[mb_id]?>' >
				<!--input type='hidden' name='stmb_id' value='' -->
				<input type='hidden' name='stmb_no' value='' >
				<input type='hidden' name='tr_token' value='i' >
				<input type='hidden' name='tr_fee_token' value='i' >	
    <div class="modals_bg pop1_bg"></div>
    <div class="wrap closeWrap">
        <div class="closeBtn pop1_CloseBtn"><img src="<?=G5_THEME_URL?>/images/closeBtn.svg" alt="닫기" /></div>
    </div>
    <div class="modals-content">
        <h2 class="topTitle"><?=lng('GOLD전송')?></h2>
        <div class="wrap">
            <div class="sec">
                <h2 class="topTitle"><?=lng('받는 계정')?></h2> 
                <input type="text" value=""  name='stmb_id'  id='stmb_id'  placeholder="<?=lng('회원아이디')?>">
                <h2 class="topTitle"><?=lng('보낼 GOLD')?></h2> 
                <input type="text" value="" name='tr_amt'  id='tr_amt' placeholder="<?=lng('전송수량')?>">
            </div>
            <div class="sec sendList">
                <ul>
                    <li><?=lng('보유금액')?> : $<?=number_format2($mrpoint[i]['_hold'])?></li>
                    <li><?=lng('전송가능금액')?> : $<is class='gold-enable-<?=$member[mb_id]?>' ><?=number_format2($mrpoint[i]['_enable'])?></is> </li>
                    <li><?=lng('최소전송금액')?> : $<?=number_format2($cset[min_trans_i])?> </li>
                </ul>
            </div>
            <button type="submit"><?=lng('전송')?></button> 
        </div>   

    </div>
	</form>	
</div>
<!--// 전송 팝업 -->

<!-- 결제방법 팝업 -->  
<div class="modals pop1_2">
<form name='form2' onsubmit='form2_submit(this);' >
				<input type='hidden' name='w' value='u2' >	
    <div class="modals_bg pop1_2_bg"></div>
    <div class="wrap closeWrap longTop">
        <div class="closeBtn pop1_2_CloseBtn"><img src="<?=G5_THEME_URL?>/images/closeBtn.svg" alt="닫기"/></div>
    </div>
    <div class="modals-content">        
        <h2 class="topTitle"><?=lng('주의사항')?></h2>
        <div class="wrap">
            <div class="sec">
                <div class="modalsNotice"><?=lng('현금 + 테더를 선택하시면 더 많은 매칭이 이루어질 수 있습니다')?>
                    <div class="modalsNotice01"><?=lng('국가의 결제 환경에 따라 제한이 있을 수 있습니다')?></div>
                
                </div>
                
                
                <div class='mt-3'>
                    <div class="matching-check w-50 mx-auto text-left mb-1">
                       <input type="radio"  name="mb_trade_paytype"  id="mb_trade_paytype1"   value='usdt' <?=$member[mb_trade_paytype]=='usdt' ?'checked="checked"':''?> />
                       <label for="mb_trade_paytype1"><?=lng('테더 매칭')?></label> 
                    </div>
                                   </div>
                <button type="submit"><?=lng('저장')?></button> 
            </div>   
        </div>
    </div>
	</form>
</div>
<!--// 결제방법 팝업 -->

<!--설정금액 팝업 -->  
<div class="modals pop2_4">
<form name='form1' onsubmit='form1_submit(this);' >
				<input type='hidden' name='w' value='u1' >	
    <div class="modals_bg pop2_4_bg"></div>
    <div class="wrap closeWrap longTop">
        <div class="closeBtn pop2_4_CloseBtn"><img src="<?=G5_THEME_URL?>/images/closeBtn.svg" alt="닫기" /></div>
    </div>
    <div class="modals-content">        
        <h2 class="topTitle"><?=lng('주의사항')?></h2>
        <div class="wrap">
            <div class="sec">
                <div class="modalsNotice"><?=lng('한도 금액을 설정하지 않으면 <span>매칭이 이루어 지지 않습니다.</span>')?></div>
                <div class="modalsNotice"><?=lng('한도 금액은 달러 기준입니다')?></div>
                <h2 class="topTitle"><?=lng('설정금액')?></h2> 
                <input type="text" name='mb_trade_amtlmt' value='<?=number_format2($member[mb_trade_amtlmt])?>' placeholder="$">
            </div>   
            <div class="sec sendList">
                <ul>
				<li><?=lng('보유금액')?> : $<is class=" mb_trade_amtenable"><?=number_format2($isum[tot][price])?></is></li>
                <!--li><?=lng('가용금액')?> : $<is class=" mb_trade_amtenable"><?=number_format2($isum[tot][price]>$member[mb_trade_amtlmt]?0:$member[mb_trade_amtlmt]-$isum[tot][price])?></is></li-->
                </ul>
            </div>            
        </div>
    </div>
	</form>
</div>
<!--//설정금액 팝업 -->

<script>
    
    $(document).ready(function () {
	
	 /* 암호변경 팝업*/
    $('.changePwd').click(function(){
         $('.pop2_3_bg').show();
         $('.pop2_3').show();
    });
    $('.pop2_3_bg, .pop2_3_CloseBtn').click(function(){
         $('.pop2_3_bg').hide();
         $('.pop2_3').hide();
    });
    
    /* 계좌변경 팝업*/
    $('.changeAcc').click(function(){
         $('.pop2_1_bg').show();
         $('.pop2_1').show();
    });
    $('.pop2_1_bg, .pop2_1_CloseBtn').click(function(){
         $('.pop2_1_bg').hide();
         $('.pop2_1').hide();
    });
	
    /* 주소변경 팝업*/
    $('.changeWal').click(function(){
         $('.pop2_2_bg').show();
         $('.pop2_2').show();
    });
    $('.pop2_2_bg, .pop2_2_CloseBtn').click(function(){
         $('.pop2_2_bg').hide();
         $('.pop2_2').hide();
    });
    
    /* 전송하기 팝업*/
    $('.sendPopBtn').click(function(){
		var ac_id=$(this).attr('data-id');
		var ac_no=$(this).attr('data-no');

		//$('.stmb_id').html(ac_id);
		$('input[name=stmb_id]','#form4').val(ac_id);
		$('input[name=stmb_no]','#form4').val(ac_no);

         $('.pop1_bg').show();
         $('.pop1').show();
    });
    $('.pop1_bg, .pop1_CloseBtn').click(function(){
         $('.pop1_bg').hide();
         $('.pop1').hide();
    });
   
    /* 결제방법 팝업*/
    $('.payPopBtn').click(function(){
         $('.pop1_2_bg').show();
         $('.pop1_2').show();
    });
    $('.pop1_2_bg, .pop1_2_CloseBtn').click(function(){
         $('.pop1_2_bg').hide();
         $('.pop1_2').hide();
    });
    /* 설정금액 팝업*/
    $('.settingBtn').click(function(){
         $('.pop2_4_bg').show();
         $('.pop2_4').show();
    });
    $('.pop2_4_bg, .pop2_4_CloseBtn').click(function(){
         $('.pop2_4_bg').hide();
         $('.pop2_4').hide();
    });	
	/* 계정의 추가*/
	$('.addAccountBtn').click(function(){
		 form3_submit();
    });
	
	//골드 전송
	  $('#subAccount  .btn-send-gold').click(function () {
		var ac_id=$(this).attr('data-id');
		var ac_no=$(this).attr('data-no');

		 $('.stmb_id').html(ac_id);
		 $('input[name=stmb_id]','#form4').val(ac_id);
		 $('input[name=stmb_no]','#form4').val(ac_no);
		 
		$('.sendGold').addClass('on').center();
	});
	
	//계정 활성
	/*$('.idDetailActive.sub-id').click(function () {
		var ac_id=$(this).attr('data-id');	
		$('input[name=ac_id]','#formaccount').val(ac_id);
		formaccount_submit();
	});
	*/
			
	
	$(".IdSelect > label").click(function () {
		var ac_id=$(this).attr('data-id');	
		$('input[name=ac_id]','#formaccount').val(ac_id);
		formaccount_submit();
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



//  입금은행변경
	function form5_submit(f)
	{

		event.preventDefault();
		var formData = $(f).serialize();	

		$.ajax({
			type: "POST",
			url: "./idDetail.update.php",
			data:formData,
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {

				if(data.result==true){					

					var mb_bank=	data.datas['mb_bank'];
					var mb_bank_num=	data.datas['mb_bank_num'];
					var mb_bank_user=	data.datas['mb_bank_user'];
					
					$('.mb_bank').html(mb_bank +' '+mb_bank_num +' '+mb_bank_user);
					//$('.mb_bank_num').html(mb_bank_num);
					//$('.mb_bank_use').html(mb_bank_user);
					
					$('.setPopup').removeClass('on');
					Swal.fire({html:'<?=lng('적용되었습니다')?>',timer:1000});   
					
					$('.pop2_1_bg').hide();
        			$('.pop2_1').hide();		
				}
				else Swal.fire({html:data.message});          
			}
		});	
		
		return;
	}
	
	//  테더지갑주소변경
	function form7_submit(f)
	{

		event.preventDefault();
		var formData = $(f).serialize();	

		$.ajax({
			type: "POST",
			url: "./idDetail.update.php",
			data:formData,
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {

				if(data.result==true){					

					var mb_wallet_addr_u=	data.datas['mb_wallet_addr_u'];
					
					$('.mb_wallet_addr_u').html(mb_wallet_addr_u);					
			
					Swal.fire({html:'<?=lng('적용되었습니다')?>',timer:1000});   
					
					$('.pop2_2_bg').hide();
         			$('.pop2_2').hide();
				}
				else Swal.fire({html:data.message});          
			}
		});		
		return;
	}
		
	//  암호변경
	function form8_submit(f)
	{
		event.preventDefault();
		var formData = $(f).serialize();	

		$.ajax({
			type: "POST",
			url: "./idDetail.update.php",
			data:formData,
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {

				if(data.result==true){					

					document.form8.reset();
					Swal.fire({html:'<?=lng('변경되었습니다')?>',timer:1000});   
					
					$('.pop2_3_bg').hide();
         			$('.pop2_3').hide();
				}
				else Swal.fire({html:data.message});       
			}
		});		
		return;
	}
	
		


	// 한도금액 설정
	function form1_submit(f)
	{

		event.preventDefault();
		var formData = $(f).serialize();	

		$.ajax({
			type: "POST",
			url: "./idDetail.update.php",
			data:formData,
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {

				if(data.result==true){					


					$('.mb_trade_amtlmt').html('$'+inputNumberFormat(data.datas['mb_trade_amtlmt']));
					$('.mb_trade_amtlenable').html('$'+inputNumberFormat(data.datas['mb_trade_amtenable']));
					$('.pop2_4_bg').hide();
					$('.pop2_4').hide();
					
					Swal.fire({html:'<?=lng('적용되었습니다')?>',timer:1000});
				}
				else Swal.fire({html:data.message});          
			}
		});	

		return;
	}
		
		
		
	//  결제방법선택
	function form2_submit(f)
	{

		event.preventDefault();
		var formData = $(f).serialize();	

		$.ajax({
			type: "POST",
			url: "./idDetail.update.php",
			data:formData,
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {

				if(data.result==true){					
					
					var pt=	data.datas['mb_trade_paytype'];
					var ptstr='';
					if(pt=='both') ptstr='<?=lng('현금 또는 테더')?>';
					else if(pt=='cash') ptstr='<?=lng('현금')?>';
					else if(pt=='usdt') ptstr='<?=lng('테더')?>';
					
					$('.mb_trade_paytype').html(ptstr);
					
					Swal.fire({html:'<?=lng('적용되었습니다')?>',timer:1000});
					
					 $('.pop1_2_bg').hide();
         			$('.pop1_2').hide();
				}
				else Swal.fire({html:data.message});          
			}
		});		
		
		return;
	}
	
	
	//  계정추가
	function form3_submit(f)
	{
		event.preventDefault();
		var rtn=false;
		Swal.fire({
		  title: '',
		  text: "<?=lng('계정을 추가하시겠습니까')?>",
		  icon: 'info',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: '<?=lng('추가합니다')?>'
		}).then((result) => {
		
		  if (result.value) {		
				
				var formData = $('#form3').serialize();
				$.ajax({
					type: "POST",
					url: "./idDetail.update.php",
					data:formData,
					cache: false,
					async: false,
					dataType:"json",
					success: function(data) {

						if(data.result==true){					

							document.location.href='./myPage.php';
						}
						else Swal.fire({html:data.message});          
					}
				});		



		  } //if (result.value) {
		})
		return rtn;
	}
	
	//  계정 활성
	function formaccount_submit()
	{

		var ac_id=$('input[name=ac_id]','#formaccount').val();
		
		var formData = $('#formaccount').serialize();	

		$.ajax({
			type: "POST",
			url: "./idDetail.update.php",
			data:formData,
			cache: false,
			async: true,
			dataType:"json",
			success: function(data) {

				if(data.result==true){													
					
					if(ac_id){
						if(data.datas['ac_active']=='1'){
							$('.is-active-'+data.datas['ac_no']).html('<?=lng('활성화됨')?>');
							$('button.idDetailActive[data-id="'+data.datas['ac_id']+'"]').html('<?=lng('비활성화')?>');			
							$('input#acc-'+data.datas['ac_no']).prop('checked',true);						
							$("li[data-id='"+data.datas['ac_id']+"']").removeClass('IdDisable');

						}else{
							$('button.idDetailActive[data-id="'+data.datas['ac_id']+'"]').html('<?=lng('활성화')?>');			
							$('input#acc-'+data.datas['ac_no']).prop('checked',false);						
							$("li[data-id='"+data.datas['ac_id']+"']").addClass('IdDisable');						
						
						}
					}					
					Swal.fire({html:'<?=lng('적용되었습니다')?>',timer:1000});   
				}
				else{
					document.formaccount.reset();
					Swal.fire({html:data.message});   
				}
			}
		});	
		
		return;
	}	
	
	
	//  골드 이체
	function form4_submit(f)
	{
		event.preventDefault();
		var formData = $(f).serialize();	
		var mb_id=$('input[name=mb_id]','#form4').val();
		var stmb_id=$('input[name=stmb_id]','#form4').val();
		var stmb_no=$('input[name=stmb_no]','#form4').val();
		
		
		$.ajax({
			type: "POST",
			url: "./coin_transfer_update.php",
			data:formData,
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {

				if(data.result==true){				

					var mb_bank=	data.datas['mb_bank'];
					console.log($('.gold-enable-' + stmb_id))
					$('.gold-enable').html(inputNumberFormat(data.datas['i']['_enable']));
					$('.gold-enable-' + mb_id).html(inputNumberFormat(data.datas2['i']['_enable']));
					$('.gold-enable-' + stmb_no).html(inputNumberFormat(data.datas3['i']['_enable']));
					
					
					
					$('.pop1_bg').hide();
         			$('.pop1').hide();
		 
					Swal.fire({html:'<?=lng('이체 되었습니다')?>',timer:1000});   
				}
				else Swal.fire({html:data.message});          
			}
		});	
		return;
	}
	
	
	
	

  </script>

<?php
include_once('../_tail.php');
?>
