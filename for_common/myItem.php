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
                <span class="userName"  onclick="document.location.href='/for_common/myPage.php'"><span><?=$member[mb_id]?> <?=lng('님')?></span></span>
            </div>  
        </div>
        
    </div>
    <div class="deal" style='min-height:50vh;'>
        <div class="wrap">
           <h3>MY ITEM</h3>
		   
		   <?
			$temp=sql_fetch("select count(*) cnt from {$g5['cn_item_cart']} where mb_id='$member[mb_id]'  and is_soled!='1'  ",1);
			$re=sql_query("select * from {$g5['cn_item_cart']} where mb_id='$member[mb_id]' and is_soled!='1'  group by cn_item order by cn_item ",1);
			
			if(sql_num_rows($re) > 0){
			?>	
			
            <ul class="crown">
			
			<? 
			while($data=sql_fetch_array($re)){
			
				$item=$g5[cn_item][$data[cn_item]];
			?>
			
			
                <li>
                    <div class="clearfix">
                        <div class="f_left"><img src="<?=G5_THEME_URL?>/images/item/<?=$item[imgm]?>" alt="" class="itemImg"/></div>
                        <ul class="dealDesc f_left">
                            <li>
                                <span><?=lng($item[name_kr])?></span>
                                <span><?=$data[ct_days]?><?=lng('일')?> <?=$data[ct_interest]?>%</span>
                                <span><?=sql_num_rows($re2)*1?><?=lng('개')?></span>
                            </li>           
                        </ul>                        
                    </div>
                    <div class="detail">
                        <ul>
						<?
					while($data2=sql_fetch_array($re2)){?>
					 <li><?=substr($data2[ct_wdate],5,5)?> <span>$ <?=number_format2($data2[ct_buy_price])?></span> / <?=substr($data2[ct_validdate],5,5)?><span>$<?=number_format2($data2[ct_sell_price])?> (￦<?=number_format2($data2[ct_sell_price]*$g5['cn_won_usd'])?>)</span></li>

					<? }?>					
                        </ul>
                    </div>
                </li>
			
			<?
			}?>
			
            
            </ul>
			
			<? }else{?>
			<p class='text-center'><br>

			<?=lng('보유한 상품이 없습니다')?>
			</p>
			<? }?>
        </div>        
    </div>

<?	
include_once('../_tail.php');
?>