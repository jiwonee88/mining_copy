<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

add_javascript('<script src="'.G5_THEME_URL.'/js/main.js"></script>');
include_once(G5_THEME_PATH.'/head.php');

//회원 전체 포인트 정보
if($member) $rpoint=get_mempoint($member['mb_id']);
 
//시세 정보
$sise=get_sise();

//메인계정의 포인트
$mrpoint=get_mempoint($member['mb_id'],$member['mb_id']);
$isum=get_itemsum($member[mb_id]);
?>
<?php
if(defined('_INDEX_')) { // index에서만 실행
	include G5_THEME_PATH.'/newwin.inc.php'; // 팝업레이어
}
?>

  
    <section id="s01">
      <div class="s01_wraper">
        <div class="s01_01">
          <div class="myPage">
            <div class="profile">
              <img src="<?=G5_THEME_URL?>/images/p1.png" alt="profile" />
            </div>
			<div style='width:100%;padding-left:350px;'>
            <div class="info">
              <p onclick="location.href='/for_common/sub08.html'"><?=$member[mb_id]?><span><?=lng('님')?></span></p>
              <button onclick="location.href='/for_common/sub08.html'">&gt;&gt;</button>
            </div>
			</div>
          </div>
        </div>
        <div class="linkImg">
          <ul class="top">
            <li   onclick="location.href='/for_common/sub05.html'" >
              <img src="<?=G5_THEME_URL?>/images/linkImg1<?=get_cookie('lang_set')!='kr'?'_us':''?>.jpg?ver=20200617" alt="1" />
            </li>
            <li class='opensend'>
              <img src="<?=G5_THEME_URL?>/images/linkImg4<?=get_cookie('lang_set')!='kr'?'_us':''?>.jpg?ver=20200617" alt="2" />
            </li>
            <li onclick="location.href='/for_common/sub06.html'">
              <img src="<?=G5_THEME_URL?>/images/linkImg3<?=get_cookie('lang_set')!='kr'?'_us':''?>.jpg?ver=20200617" alt="3" />
            </li>
          </ul>
          <ul class="bottom">
            <li onclick="location.href='/for_common/sub04.html'">
              <img src="<?=G5_THEME_URL?>/images/linkImg2<?=get_cookie('lang_set')!='kr'?'_us':''?>.jpg?ver=20200617" alt="4" />
            </li>
            <li onclick="location.href='/for_common/sub07.html'">
              <img src="<?=G5_THEME_URL?>/images/linkImg5<?=get_cookie('lang_set')!='kr'?'_us':''?>.jpg?ver=20200617" alt="5" />
            </li>
          </ul>
         
		  
          <div class="send">
		  	<form id="transferform" name="transferform" action="/for_common/coin_transfer_others.php" onsubmit="return  transferform_submit(this);" method="post"  autocomplete="off" >                                                
			<input type="hidden" name="w" value="u">
			<input type="hidden" name="mb_id" value="<?=$member['mb_id']?>">
			<input type="hidden" name="tr_token" value="i">
			<?
			//전송 가능 금액
			$enable_sum=get_eanble_trans($member[mb_id],$rpoint,'i');
			?>
            <div class="exit"></div>
            <h2><?=lng('GOLD 전송')?></h2>
            
            <p><?=lng('받는 계정')?></p>
            <input name="tmb_id" type="text" id="tmb_id" class=' w-80' value="<?=$_POST['scanned_id']?>"  placeholder="<?=lng('회원 아이디')?>">
            <p><?=lng('보낼 GOLD')?></p>
             <input name="tr_amt" type="text" id="tr_amt" class=' number-comma w-80'  placeholder="<?=lng('전송수량')?>">  
            <ul>
              <li>
                <p><?=lng('보유','sendgold')?> :</p>
                <span class='balance-value'><?=number_format2($rpoint['i']['_enable'])?></span>
              </li>
              <li>
                <p><?=lng('전송가능','sendgold')?> :</p>
                <span class='balance-value-enable' ><?=number_format($enable_sum)?></span>
              </li>
              <li>
                <p><?=lng('최소전송','sendgold')?> :</p>
                <span><?=number_format($cset['min_trans_i'])?></span>
              </li>
            </ul>
            <button type='submit' ><?=lng('전송')?></button>
            <button type='button' class="closes"><?=lng('닫기')?></button>
			</form>
         
		  </div>
		 
        </div>
		
        <div class="s01_02">
		
		 <div class="gold" onclick="location.href='/for_common/sub09.html'">
            <p><?=number_format2($rpoint['b']['_enable'])?> <span>GAS</span>
              <button class="buyBtn">>></button></p>

            <button></button>
          </div>
		  
          <div class="gold" onclick="location.href='/for_common/sub09.html'">
            <p><?=number_format2($rpoint['i']['_enable'])?> <span>GOLD</span>
              <button class="buyBtn">>></button></p>

            <button></button>
          </div>
		  
		 
		  
          <!--div class="point" onclick="location.href='/for_common/sub05.html'">
            <p><?=number_format2($rpoint['e']['_enable'])?> <span>GQC GOLD</span>
              <button class="buyBtn">>></button></p>
            <button></button>
          </div-->
		   <div class="point" onclick="location.href='/for_common/sub05.html'">
            <p><?=number_format2($rpoint['b']['_enable'])?> <span>Point</span>
              <button class="buyBtn">>></button></p>
            <button></button>
          </div>
		  
          <!--div class="member">
            <div class="mInfo">
              <p>MEMBER</p>
              <p>0 / 0</p>
            </div>
            <ul>
              <li>광선검 0</li>
              <li>광선총 0</li>
              <li>우주선 0</li>
            </ul>
            <button></button>
          </div-->
        </div>
        <div class="s01_03">
          <div class="buy">
            <h4><?=lng('구매')?></h4>
            <ul>
              <li onclick="location.href='/for_common/sub04.html?stats_stx=1-1'">
                <p><?=$buyer_stats[cnt_stats_1]>99?'+99':($buyer_stats[cnt_stats_1]?$buyer_stats[cnt_stats_1]:0)?><?=lng('건')?></p>
                <span><?=lng('미처리')?></span>
              </li>
              <li onclick="location.href='/for_common/sub04.html?stats_stx=1-2'" >
                <p><?=$buyer_stats[cnt_stats_2]>99?'+99':($buyer_stats[cnt_stats_2]?$buyer_stats[cnt_stats_2]:0)?><?=lng('건')?></p>
                <span><?=lng('완료대기')?></span>
              </li>
              <li onclick="location.href='/for_common/sub04.html?stats_stx=1-bad'" >
                <p><?=$buyer_stats[cnt_stats_claim]>99?'+99':($buyer_stats[cnt_stats_claim]?$buyer_stats[cnt_stats_claim]:0)?><?=lng('건')?></p>
                <span><?=lng('신고')?></span>
              </li>
              <li onclick="location.href='/for_common/sub04.html?stats_stx=1-3'" >
                <p><?=$buyer_stats[cnt_stats_3]>99?'+99':($buyer_stats[cnt_stats_3]?$buyer_stats[cnt_stats_3]:0)?><?=lng('건')?></p>
                <span class="com"><?=lng('완료')?></span>
              </li>
            </ul>
          </div>
		  
          <div class="sell">
            <h4><?=lng('판매')?></h4>
            <ul>
              <li onclick="location.href='/for_common/sub04.html?stats_stx=2-1'">
                <p><?=$buyer_stats[cnt_stats_1]>99?'+99':($seller_stats[cnt_stats_1]?$seller_stats[cnt_stats_1]:0)?><?=lng('건')?></p>
                <span><?=lng('미처리')?></span>
              </li>
              <li onclick="location.href='/for_common/sub04.html?stats_stx=2-2'">
                <p><?=$seller_stats[cnt_stats_2]>99?'+99':($seller_stats[cnt_stats_2]?$seller_stats[cnt_stats_2]:0)?><?=lng('건')?></p>
                <span><?=lng('완료대기')?></span>
              </li>
              <li onclick="location.href='/for_common/sub04.html?stats_stx=2-3'">
                <p><?=$seller_stats[cnt_stats_3]>99?'+99':($seller_stats[cnt_stats_3]?$seller_stats[cnt_stats_3]:0)?><?=lng('건')?></p>
                <span class="com"><?=lng('완료')?></span>
              </li>
            </ul>
          </div>
        </div>
        <div class="s01_04">
          <ul>
            <li onclick="location.href='/for_common/sub08.html' " class='w-40'>
              <p class='text-narrow2 small'>$ <?=number_format2($member[mb_trade_amtlmt])?></p>
              <span><?=lng('설정금액')?></span>
            </li>            
            <li onclick="location.href='/for_common/sub03.html'"  class='w-40'>
              <p class='text-narrow2 small'>$ <?=number_format2($isum[tot][price])?></p>
              <span class="com"><?=lng('보유금액')?></span>
            </li>
          </ul>
		  
		    <?
		 //매도액
		$stemp=sql_fetch("select sum(if(ct_validdate <= date(now()),ct_sell_price,0)) ct_sell_price,sum(if(ct_validdate > date(now()),ct_buy_price,0)) ct_buy_price  from {$g5['cn_item_cart']} where is_soled != '1' and mb_id='$member[mb_id]'");
		?>
		
		  <ul >
            <li onclick="location.href='/for_common/sub08.html'" class='w-90' style='font-size:1.1em;'  >
              <p class='text-narrow2 small'>$ <?=number_format2($stemp[ct_sell_price])?></p>
              <span><?=lng('오늘 매도액')?></span>
            </li>           
          </ul>
		  
		  
          <button type='button' onclick="location.href='/for_common/sub02.html'" >AUTO MATCHING</button>
        </div>
      </div>
    </section>
	
	
    <section id="s02">
      <div class="s02_wraper">
        <div class="weapone">
          <ul>
		  
		  <?
			$cn_item=array();
			$re=sql_query("select *,count(*) cnt from {$g5[cn_item_cart]} where mb_id='$member[mb_id]' and is_soled!='1' group by cn_item",1);
			while($d=sql_fetch_array($re)){
			$cn_item[$d[cn_item]]+=$d[cnt];				
			}
				
				
			foreach($g5['cn_item'] as $k=>$v){?>
				
				
			<li onclick="location.href='/for_common/sub03.html'" class="mainBorder">
              <div class="weaponeWrap">
                <h3><?=lng($v[name_kr])?></h3>
                <div class="leftArea">
                  <div class="img" ><img src="<?=G5_THEME_URL?>/images/item/<?=$v[img]?>" alt="<?=$v[name_kr]?>" />
                  </div>
                </div>
                <ul class="rightArea">
                  <li>
                    <?=lng('보유량')?> : <?=$cn_item[$k]?$cn_item[$k]:'0'?><?=lng('개')?>
                  </li>
                  <li>
                    <?=lng('판매대기')?> : <?=$v[days]?><?=lng('일')?>
                  </li>
                  <li>
                    <?=lng('판매시수익')?> : <?=number_format2($v[interest])?>%
                  </li>
				  <li>
                    <?=lng('수수료')?> : <?=number_format2($v[fee])?><?=$g5['cn_cointype'][$g5['cn_fee_coin']]?>
                  </li>
                  <div class="buyBtn w-90 ">
                   <?=number_format2($v[price])?> ~ <?=number_format2($v[mxprice])?>
                  </div>
                </ul>
              </div>
            </li>
			
			<? }?>   


			
          </ul>
        </div>
      </div>
    </section>
    
	
<script>
$(document).ready(function () {
	$(".opensend").click(function () {
	  $(".send").addClass("on").css('opacity',1).center();
	  $(".mask").addClass("on");
	});

	$(".sendInfo .btns button:nth-child(2)").click(function () {
	  $(".sendInfo").removeClass("on");
	  $(".mask").removeClass("on");
	});

});

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
		url: "/for_common/coin_transfer_others.php",
		data:formData,
		cache: false,
		async: false,
		dataType:"json",
		success: function(data) {

			if(data.result){					

				f.reset();

				$('.balance-value').html(data.datas['enable_amt']);
				$('.balance-value-enable').html(data.datas['trans_enable_amt']);
				//$('.balance-value-usd').html(data.datas['max_enable_usd'])
				//$("input[name='max_enable']").val(data.datas['max_enable']);

				Swal.fire('<?=lng('전송이 완료 되었습니다')?>');   
			}
			else Swal.fire(data.message);       
		}
	});		
	$(f).find('button[type=submit]').attr('disabled',false);
	return;

}




  </script>
  
	

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>