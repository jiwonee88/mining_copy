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
sum(if(tr_wdate>='$last_date' and tr_stats='3',1,0)) cnt_stats_3,
sum(if(tr_stats='9',1,0)) cnt_stats_9,
sum(if(	tr_buyer_claim='1' and tr_stats!='3' and tr_stats!='9',1,0)) buyer_claim,
sum(if(	tr_seller_claim='1'  and tr_stats!='3' and tr_stats!='9',1,0)) seller_claim,
sum(if(	(tr_buyer_claim='1' or tr_seller_claim='1')  and tr_stats!='3'  and tr_stats!='9',1,0)) all_claim
from {$g5['cn_item_trade']} where mb_id='$member[mb_id]'",1);

//판매내역 카운트
$seller_stats=sql_fetch("select 
sum(if(tr_stats='1',1,0)) cnt_stats_1,
sum(if(tr_stats='2',1,0)) cnt_stats_2,
sum(if(tr_wdate>='$last_date' and tr_stats='3',1,0)) cnt_stats_3,
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


  <div id="wrap">
    <div class="smenuWrap">
      <div class="smenu">
        <div class="profile">
          <img src="<?=G5_THEME_URL?>/images/p1.png" alt="profile" />
        </div>
        <div class="info" onclick="location.href='/for_common/sub08.html'">
          <p><?=$member[mb_id]?></p>
        </div>
        <div class="exitBtn">
          <img src="<?=G5_THEME_URL?>/images/exitBtn.png" alt="" />
        </div>
        <p class="bar"></p>

        <ul>
          <li>
		  	<a href='/for_common/sub12.html'  >
            <img src="<?=G5_THEME_URL?>/images/symbol1.png" alt="" />
            <p><?=lng('공지사항')?></p>
          </li>
          <li>
		  	<a href='http://pf.kakao.com/_RsZxkxb'  target='_blank' >
            <img src="<?=G5_THEME_URL?>/images/symbol2.png" alt="" />
            <p><?=lng('1대1 문의')?></p>
			</a>
          </li>
          <li>
            <a href='/bbs/logout.php' ><img src="<?=G5_THEME_URL?>/images/symbol3.png" alt="" />
            <p><?=lng('로그아웃')?></p>
			</a>
          </li>
		  
		
		 <li>
		
		<!--form name='lang_change' class='form-inline' action='<?=$_SERVER[SCRIPT_NAME]?>' >
		
		<select name='lng' class='form-control   d-inline w-auto '>
		<option value='kr' <?=get_cookie('lang_set')=='kr'?'selected':''?> >KOR</option>	
		<option value='us' <?=get_cookie('lang_set')=='us'?'selected':''?> >ENG</option>				
		<option value='vn' <?=get_cookie('lang_set')=='vn'?'selected':''?> >VNM</option>		
		<option value='jp' <?=get_cookie('lang_set')=='jp'?'selected':''?> >JPN</option>		
		<option value='cn' <?=get_cookie('lang_set')=='cn'?'selected':''?> >CHN</option>		
		<option value='th' <?=get_cookie('lang_set')=='th'?'selected':''?> >THA</option>		
		</select>		
		</form-->
		
		
		<div class="dropdown w-70">
		  <button class="btn btn-light dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<?
			$lang_set=get_cookie('lang_set');
			if($lang_set=='kr') echo 'KOR';
			else if($lang_set=='us') echo 'ENG';
			else if($lang_set=='vn') echo 'VNM';
			else if($lang_set=='jp') echo 'JPN';
			else if($lang_set=='cn') echo 'CHN';
			else if($lang_set=='th') echo 'THA';			
			?>
		  </button>
		  <div class="dropdown-menu  w-100" aria-labelledby="dropdownMenuButton">
			<a class="dropdown-item text-dark flag flag-kr" data-lang='kr' href="javascript:lang_set('kr');" >KOR</a>	
			<a class="dropdown-item text-dark flag flag-us" data-lang='us' href="javascript:lang_set('us');"  >ENG</a>			
			<a class="dropdown-item text-dark flag flag-vn" data-lang='vn' href="javascript:lang_set('vn');"  >VNM</a>		
			<a class="dropdown-item text-dark flag flag-jp" data-lang='jp' href="javascript:lang_set('jp');"  >JPN</a>	
			<a class="dropdown-item text-dark flag flag-cn" data-lang='cn' href="javascript:lang_set('cn');"  >CHN</a>	
			<a class="dropdown-item text-dark flag flag-th" data-lang='th' href="javascript:lang_set('th');"  >THA</a>	

		  </div>
		</div>


		</li>
	
  
        </ul>
      </div>
    </div>
    <header>
      <div class="menu">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div onclick="location.href='/'" class="logo">
        <img src="<?=G5_THEME_URL?>/images/logo.png" alt="logo" />
      </div>
      <div class="alarm">
        <!--img src="<?=G5_THEME_URL?>/images/bell.png" alt="bell" /-->
      </div>
    </header>