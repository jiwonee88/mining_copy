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

// 회원, 방문객 카운트
$sql = " select sum(IF(mb_id<>'',1,0)) as mb_cnt, count(*) as total_cnt from {$g5['login_table']}  where mb_id <> '{$config['cf_admin']}' ";
$connect = sql_fetch($sql,1);

// 회원
$sql = " select count(*) as total_cnt from {$g5['member_table']}  where mb_id <> '{$config['cf_admin']}' ";
$totmem = sql_fetch($sql,1);
?>
<?php
if(defined('_INDEX_')) { // index에서만 실행
	include G5_THEME_PATH.'/newwin.inc.php'; // 팝업레이어
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
  
	<div class="wrap">	
	 <div style='margin-top:-40px;font-weight:400;'>
    <div class='float-left text-left'>Dday : <?=(strtotime("+99 days",strtotime('2020-08-15')) - strtotime(date("Y-m-d"))) /86400?> days left.</div>
	<div class='float-right text-right'>Total Members :<?=$totmem[tot_cnt]+114?></div>
	
   </div>
   
        <div class="topCommon">   
            <div class="userInfo">
                <img src="<?=G5_THEME_URL?>/images/userBg.svg">
                <span><img src="<?=G5_THEME_URL?>/images/user.svg" alt="USER07" class="userImg"/></span>
                <span class="userName" onclick="document.location.href='/for_common/myPage.php'"><span><?=$member[mb_id]?>  <?=lng('님')?></span></span>
            </div>  
        </div>
        <div class="secList secList03 mainList">
            <ul>
                <li class="list02" onclick="document.location.href='/for_common/sendGold.php'" ><a href="/for_common/sendGold.php">Gold Transfer</a></li>
                <li class="list03"  onclick="document.location.href='/for_common/genology.php'" ><a href="/for_common/genology.php">Genealogy</a></li>
            </ul>    
        </div>
<br>
<li class="sec point text-center">
                    <h4><?=lng('레퍼럴 URL')?></h4>
		    <div class="btn-clipboard" data-clipboard-text="<?=G5_URL?>/?refid=<?=$member[mb_id]?>" ><span ><?=G5_URL?>/?refid=<?=$member[mb_id]?></span><span id="ref_copy" style="cursor:pointer" data-clipboard-text="<?=G5_URL?>/?refid=<?=$member[mb_id]?>" class="copy"></span></div>
                </li>

		 <div class="sec point text-center">
		 Current User : <?=$connect[total_cnt]+15?>
		 </div>
        <div class="sec point">
            <div class="longBtn Btn w_btn"><a  href='/for_common/buyGold.php'><span><?=number_format2($rpoint['i']['_enable'])?> GOLD(Buy Gold)</span></a></div>
        </div>
        <div class="sec secList">
            <h3><?=lng('구매')?></h3>
            <ul>
                <!--li onclick="document.location.href='/for_common/buySell.php?stats_stx=1-1'" ><span><?=$buyer_stats[cnt_stats_1]>99?'+99':($buyer_stats[cnt_stats_1]?$buyer_stats[cnt_stats_1]:0)?><?=lng('건')?></span><?=lng('미처리')?></li-->
                <!--li onclick="document.location.href='/for_common/buySell.php?stats_stx=1-2'" ><span><?=$buyer_stats[cnt_stats_2]>99?'+99':($buyer_stats[cnt_stats_2]?$buyer_stats[cnt_stats_2]:0)?><?=lng('건')?></span><?=lng('완료대기')?></li-->
                <!--li onclick="document.location.href='/for_common/buySell.php?stats_stx=1-bad'" ><span><?=$buyer_stats[cnt_stats_claim]>99?'+99':($buyer_stats[cnt_stats_claim]?$buyer_stats[cnt_stats_claim]:0)?><?=lng('건')?></span><?=lng('신고')?></li-->
                <li onclick="document.location.href='/for_common/buySell.php?stats_stx=1-3'" class="f_black"><span><?=$buyer_stats[cnt_stats_3]>99?'+99':($buyer_stats[cnt_stats_3]?$buyer_stats[cnt_stats_3]:0)?><?=lng('건')?></span><?=lng('완료')?></li>
            </ul>    
        </div>
        <div class="sec secList">
            <h3><?=lng('판매')?></h3>
            <ul>
                <!--li onclick="document.location.href='/for_common/buySell.php?stats_stx=2-1'"><span><?=$seller_stats[cnt_stats_1]>99?'+99':($seller_stats[cnt_stats_1]?$seller_stats[cnt_stats_1]:0)?><?=lng('건')?></span><?=lng('미처리')?></li-->
                <!--li onclick="document.location.href='/for_common/buySell.php?stats_stx=2-2'"><span><?=$seller_stats[cnt_stats_2]>99?'+99':($seller_stats[cnt_stats_2]?$seller_stats[cnt_stats_2]:0)?><?=lng('건')?></span><?=lng('완료대기')?></li-->
                <!--li onclick="document.location.href='/for_common/buySell.php?stats_stx=2-bad'" ><span><?=$seller_stats[cnt_stats_claim]>99?'+99':($seller_stats[cnt_stats_claim]?$seller_stats[cnt_stats_claim]:0)?><?=lng('건')?></span><?=lng('신고')?></li-->
                <li onclick="document.location.href='/for_common/buySell.php?stats_stx=2-3'" class="f_black"><span><?=$seller_stats[cnt_stats_3]>99?'+99':($seller_stats[cnt_stats_3]?$seller_stats[cnt_stats_3]:0)?><?=lng('건')?></span><?=lng('완료')?></li>
            </ul>    
        </div>
        <div class="sec secList secList02 secList03_02">
            <ul>
                <li class="settingBtn" onclick="document.location.href='/for_common/myPage.php'"><span>$<?=number_format2($member[mb_trade_amtlmt])?></span><?=lng('설정금액')?></li>
                <li class="f_black" onclick="document.location.href='/for_common/myItem.php'"><span>$<?=number_format2($isum[tot][price])?></span><?=lng('보유금액')?></li>
            </ul>    
        </div>
		  <?
		 //매도액
		$stemp=sql_fetch("select sum(if(ct_validdate <= date(now()),ct_sell_price,0)) ct_sell_price,sum(if(ct_validdate > date(now()),ct_buy_price,0)) ct_buy_price  from {$g5['cn_item_cart']} where is_soled != '1' and mb_id='$member[mb_id]'");
		?>
		
        <div class="longBtn Btn w_btn"><a><?=lng('오늘 매도액')?> : $<?=number_format2($stemp[ct_sell_price])?></a></div>
        <div class="longBtn Btn"><a href="/for_common/automaching.php">AUTOMACHING</a></div>
    </div>
	
    <div class="deal">
        <div class="wrap">
            <ul class="crown"  onclick="document.location.href='/for_common/myItem.php'">
				
				<?
			$cn_item=array();
			$re=sql_query("select *,count(*) cnt from {$g5[cn_item_cart]} where mb_id='$member[mb_id]' and is_soled!='1' group by cn_item",1);
			while($d=sql_fetch_array($re)){
			$cn_item[$d[cn_item]]+=$d[cnt];				
			}
				
				
			foreach($g5['cn_item'] as $k=>$v){?>
			
                <li>
                    <h3><?=lng($v[name_kr])?></h3>
                    <div class="clearfix">
                        <div class="f_left"><img src="<?=G5_THEME_URL?>/images/item/<?=$v[img]?>" alt="" class="itemImg"/></div>
                        <ul class="dealDesc f_left"> 
                            <li class='text-left'>
                                <span><?=lng('보유량')?> : <?=$cn_item[$k]?$cn_item[$k]:'0'?> <?=lng('개')?></span>
                                <span><?=lng('판매대기')?> : <?=$v[days]?><?=lng('일')?></span>
                                <span><?=lng('판매시수익')?> : <?=number_format2($v[interest])?>%</span>
                            </li>           
                        </ul>
                    </div>
                    <div class="longBtn Btn g_Btn"><a href="#"> <?=number_format2($v[price])?> ~ <?=number_format2($v[mxprice])?></a></div>
                </li>
				
			<? }?>	
             
            </ul>
        </div>        
    </div>
  
  

</div>


	
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
  
				<script>
				    var btn = document.getElementById('ref_copy');
			    var clipboard = new Clipboard(btn);
			    clipboard.on('success', function(e) {
				            
					        });
			        clipboard.on('error', function(e) {
					        console.log(e);
						    });
			        </script>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
