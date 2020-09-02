<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


//게시판
if($bo_table) $docu_title=$board['bo_subject'];
if($docu_title=='') $docu_title=$g5[title];

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');


//$last_date=date("Y-m-d",strtotime('-1 days'));
$last_date=date("Y-m-d");


//구매내역 카운트
$buyer_stats=sql_fetch("select 
sum(if(tr_stats='1',1,0)) cnt_stats_1,
sum(if(tr_stats='2',1,0)) cnt_stats_2,
sum(if( tr_stats='3',1,0)) cnt_stats_3,
sum(if(tr_stats='9',1,0)) cnt_stats_9,
sum(if(	tr_buyer_claim='1' and tr_stats!='3' and tr_stats!='9',1,0)) buyer_claim,
sum(if(	tr_seller_claim='1'  and tr_stats!='3' and tr_stats!='9',1,0)) seller_claim,
sum(if(	(tr_buyer_claim='1' or tr_seller_claim='1')  and tr_stats!='3'  and tr_stats!='9',1,0)) all_claim
from {$g5['cn_item_trade']} where mb_id='$member[mb_id]'",1);

//판매내역 카운트
$seller_stats=sql_fetch("select 
sum(if(tr_stats='1',1,0)) cnt_stats_1,
sum(if(tr_stats='2',1,0)) cnt_stats_2,
sum(if( tr_stats='3',1,0)) cnt_stats_3,
sum(if(tr_stats='9',1,0)) cnt_stats_9,
sum(if(	tr_buyer_claim='1' and tr_stats!='3' and tr_stats!='9',1,0)) buyer_claim,
sum(if(	tr_seller_claim='1' and tr_stats!='3'  and tr_stats!='9',1,0)) seller_claim,
sum(if(	(tr_buyer_claim='1' or tr_seller_claim='1')  and tr_stats!='3' and tr_stats!='9' ,1,0)) all_claim
from {$g5['cn_item_trade']} where fmb_id='$member[mb_id]'",1);



?>
<script>
$(function(){
	 $("select[name=lng]").change(function(){
	 	event.preventDefault();
        var v=$(this).val();
		lang_set(v);
    });
});
</script>


<div class="container main">    
    <div class="wrap">
       <h2 class="topTitle"><a href="/">MINING</a></h2>
        <div class="topUtil">
            <ul>
                <li><img src="<?=G5_THEME_URL?>/images/menu.svg" alt="메뉴버튼"  class="menuBtn"/></li>
               
            </ul>
        </div>
        <div class="menu">
            <div class="menuBg"></div>
            <div class="menuList">
                <div class="userInfo">
                    <span><img src="<?=G5_THEME_URL?>/images/user.svg" alt="USER07"  class="userImg"/></span>
                    <span class="userName"><?=$member[mb_id]?> 님</span>
                </div> 
                <div class="gnb">
                    <ul>
                        <li><a href="/for_common/notice.php"><?=lng('공지사항')?></a></li>
                        <li><a href="#"><?=lng('1대1문의')?></a></li>
                        <li><a href="/bbs/logout.php"><?=lng('로그아웃')?></a></li>
						
						<li>
						
						<div class="lang">
							<div>
							<span>

							<? 			
							if($lang_set=='us')  echo "<img src='".G5_THEME_URL."/img/flag/USA-flag.png' class='flag' >";
							else if($lang_set=='cn')  echo "<img src='".G5_THEME_URL."/img/flag/China-flag.png' class='flag' >";
							else  echo "<img src='".G5_THEME_URL."/img/flag/South-Korea-flag.png' class='flag' >";
							?>

				<?
				if($lang_set=='kr') echo 'KOR';
				else if($lang_set=='us') echo 'ENG';
				else if($lang_set=='cn') echo 'CHN';
				else echo 'KOR';
				?></span>
								<ul class="langGroup">
									<li><a  data-lang='kr' href="javascript:lang_set('kr');" ><img src='<?=G5_THEME_URL?>/img/flag/South-Korea-flag.png'  class='flag'> KOR</a></li>
									<li><a  data-lang='us' href="javascript:lang_set('us');" ><img src='<?=G5_THEME_URL?>/img/flag/USA-flag.png'  class='flag'>ENG</a></li>
									<li><a  data-lang='cn' href="javascript:lang_set('cn');" ><img src='<?=G5_THEME_URL?>/img/flag/China-flag.png'  class='flag'>CHN</a></li>
								</ul>
							</div>
						</div>
						</li>



                    </ul>
                </div>
            </div>                    
        </div>   
	</div>	
	