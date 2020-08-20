<?php

include_once('./_common.php');

$outer_css=' store holdItem ';

include_once('../_head.php');

?>
  
        <div class="wrap">
            <div class="area">
                <h3><span>my store</span></h3>

                <ul class="stoneList">
				
					<?
					$re=sql_query("select * from {$g5['cn_item_cart']} where mb_id='$member[mb_id]'  and is_soled!='1'  ",1);
					while($data=sql_fetch_array($re)){
					?>
                    <li class="squareWB">
                        <div class="clearfix">
                            <div class="stoneImg f_left">
                                <img src="<?=G5_THEME_URL?>/images/stone/<?=$g5[cn_item][$data[cn_item]]['img']?>" alt="<?=$g5[cn_item][$data[cn_item]]['name_kr']?>">
                            </div>
                            <div class="stoneDesc f_left">
                                <h4>내역</h4>
                                <ul>
                                    <li class="goldInfo">
									<span class="howlong"><?=ceil((time()-strtotime($data[ct_wdate]))/86400)?>일</span><span class="percent"><?=$data[ct_interest]?>%</span>
                                    </li>
                                    <li class="holdDate">
                                        <div>· <?=substr($data[ct_wdate],5,5)?> $<?=$data[ct_buy_price]?></div>
                                        <div>· <?=substr($data[ct_validdate],5)?> $<?=$data[ct_sell_price]?></div>
                                    </li>
                                    <li class="holdVol"><span>보유수량:1</span></li>
                                </ul>
                            </div>
                        </div>
                    </li>
					<? }?>

					
					
                </ul>
            </div>
        </div>

   
   
<?	
include_once('../_tail.php');
?>
