<?php

include_once('./_common.php');

$outer_css=' automaching ';

add_javascript('<script src="'.G5_THEME_URL.'/extend/clipboard.min.js"></script>',1);
include_once('../_head.php');

$mrpoint=get_mempoint($member[mb_id],$member[mb_id]);
$isum=get_itemsum($member[mb_id]);

?>
    
        <div class="wrap">
            <div class="area area01">
                <h3><span>my gold</span></h3>
                <ul class="common">
                    <li class="squareWB w100" onclick="location.href='/for_common/idDetail.php'"><span class="spointTitle">gold :
                        </span><span><?=number_format2($rpoint['i'][_enable])?></span></li>
                </ul>
                <ul class="buy  sell">
                    <li class="squareWB" onclick="location.href='/for_common/idDetail.php'"><span
                            class="f_yellow price">$<?=number_format2($member[mb_trade_amtlmt])?></span><span class="condition">설정금액</span>
                    </li>
                    <li class="squareWB" onclick="location.href='/for_common/idDetail.php'"><span
                            class="f_yellow price">$<?=number_format2($isum[tot][price]>$member[mb_trade_amtlmt]?0:$member[mb_trade_amtlmt]-$isum[tot][price])?></span><span class="condition f_pink">가용금액</span></li>
                    <li class="squareWB" onclick="location.href='/for_common/stonedetail.php'"><span
                            class="f_yellow price">$<?=number_format2($isum[tot][price])?></span><span class="condition confirm">보유금액</span></li>
                </ul>
            </div>
            <div class="area area02 area90">
				<form name='autoform' id='autoform' onsubmit='autoform_submit(this);' >
				<input type='hidden' name='w' value='m' >
				
                <h3><span>AUTO SHINING</span></h3>
                <ul class="common">
                    <li class="squareWB w100"><span class="spointTitle">auto shinning</span>
                        <span class="sel-check"><input type="checkbox" name="mb_auto_all"  id="selc-m"  <?=$member[mb_auto_all]?'checked':''?> value='1'  /><label for="selc-m"><span
                                    class="blind">선택</span></label></span>
                </ul>
				</form>
            </div>
			
			<?/*
			<div class="area area03 area90">
				<form name='autoformmain' id='autoformmain' onsubmit='autoform_submit(this);' >
				<input type='hidden' name='w' value='mu' >
				
                <div class="idInfo clearfix"><span class="idInfoDesc f_left">ID : <?=$member[mb_id]?></span><span
                        class="idInfoselect f_right"><span> <?=number_format2($mrpoint['i']['_enable'])?><span class="sel-check">
						<input type="checkbox" <?=$member[mb_auto_a]||$member[mb_auto_a]||$member[mb_auto_c]||$member[mb_auto_d]?'checked':''?>
                                    id="selc-1"  class='toggle-all' data-class='toggle-m' /><label for="selc-1"><span
                                        class="blind">선택</span></label></span></span></span></div>
                <ul class="buy">
                    <li >
                        <div class="squareWB"><img src="<?=G5_THEME_URL?>/images/ministone/stone01.gif" alt="" /></div>
                        <span class="sel-check "><input type="checkbox" name="mb_auto_a" id="selc-2" <?=$member[mb_auto_a]?'checked':''?> class='toggle-m'  value='1'  /><label
                                for="selc-2"><span class="blind">선택</span></label></span>
                    </li>
                    <li>
                        <div class="squareWB"><img src="<?=G5_THEME_URL?>/images/ministone/stone02.gif" alt="" /></div>
                        <span class="sel-check"><input type="checkbox" name="mb_auto_b" id="selc-3"  <?=$member[mb_auto_b]?'checked':''?> class='toggle-m' value='1'    /><label
                                for="selc-3"><span class="blind">선택</span></label></span>
                    </li>
                    <li>
                        <div class="squareWB"><img src="<?=G5_THEME_URL?>/images/ministone/stone03.gif" alt="" /></div>
                        <span class="sel-check"><input type="checkbox" name="mb_auto_c"  id="selc-4" <?=$member[mb_auto_c]?'checked':''?> class='toggle-m'  value='1'  /><label
                                for="selc-4"><span class="blind">선택</span></label></span>
                    </li>
                    <li>
                        <div class="squareWB"><img src="<?=G5_THEME_URL?>/images/ministone/stone04.gif" alt="" /></div>
                        <span class="sel-check"><input type="checkbox" name="mb_auto_d"  id="selc-5"  <?=$member[mb_auto_d]?'checked':''?>  class='toggle-m'  value='1'  /><label
                                for="selc-5"><span class="blind">선택</span></label></span>
                    </li>
                </ul>
				</form>
            </div>
			*/?>
			
			
			<?
			//서브 계정
			$accresult=sql_query("select * from  {$g5['cn_sub_account']} where mb_id='$member[mb_id]' order by ac_id asc");
			while($ac=sql_fetch_array($accresult)){?>
            <div class="area area03 area90">
				<form name='autoform<?=$ac[ac_no]?>' id='autoform<?=$ac[ac_no]?>' onsubmit='autoform_submit(this);' >
				<input type='hidden' name='w' value='au' >
				<input type='hidden' name='ac_id' value='<?=$ac[ac_id]?>' >	
				
                <div class="idInfo clearfix"><span class="idInfoDesc f_left">ID : <?=$ac[ac_id]?></span><span
                        class="idInfoselect f_right"><span> <?=number_format2($ac[ac_point_i])?><span class="sel-check">
						<input type="checkbox" 
                                    id="selc-1-<?=$ac[ac_no]?>" class='toggle-all' data-class='toggle-<?=$ac[ac_no]?>' <?=$ac[ac_auto_a]||$ac[ac_auto_a]||$ac[ac_auto_c]||$ac[ac_auto_d]?'checked':''?> /><label for="selc-1-<?=$ac[ac_no]?>"><span
                                        class="blind">선택</span></label></span></span></span></div>
                <ul class="buy">
                    <li >
                        <div class="squareWB"><img src="<?=G5_THEME_URL?>/images/ministone/stone01.gif" alt="" /></div>
                        <span class="sel-check "><input type="checkbox" name="ac_auto_a" id="selc-2-<?=$ac[ac_no]?>"  class='toggle-<?=$ac[ac_no]?>' value='1' <?=$ac[ac_auto_a]?'checked':''?> /><label
                                for="selc-2-<?=$ac[ac_no]?>"><span class="blind">선택</span></label></span>
                    </li>
                    <li>
                        <div class="squareWB"><img src="<?=G5_THEME_URL?>/images/ministone/stone02.gif" alt="" /></div>
                        <span class="sel-check"><input type="checkbox" name="ac_auto_b" id="selc-3-<?=$ac[ac_no]?>"  class='toggle-<?=$ac[ac_no]?>' value='1'  <?=$ac[ac_auto_b]?'checked':''?> /><label
                                for="selc-3-<?=$ac[ac_no]?>"><span class="blind">선택</span></label></span>
                    </li>
                    <li>
                        <div class="squareWB"><img src="<?=G5_THEME_URL?>/images/ministone/stone03.gif" alt="" /></div>
                        <span class="sel-check"><input type="checkbox" name="ac_auto_c"  id="selc-4-<?=$ac[ac_no]?>"  class='toggle-<?=$ac[ac_no]?>' value='1'  <?=$ac[ac_auto_c]?'checked':''?> /><label
                                for="selc-4-<?=$ac[ac_no]?>"><span class="blind">선택</span></label></span>
                    </li>
                    <li>
                        <div class="squareWB"><img src="<?=G5_THEME_URL?>/images/ministone/stone04.gif" alt="" /></div>
                        <span class="sel-check"><input type="checkbox" name="ac_auto_d"  id="selc-5-<?=$ac[ac_no]?>"  class='toggle-<?=$ac[ac_no]?>'  value='1' <?=$ac[ac_auto_d]?'checked':''?> /><label
                                for="selc-5-<?=$ac[ac_no]?>"><span class="blind">선택</span></label></span>
                    </li>
                </ul>
				</form>
            </div>
			<? }?>
			
        </div>
    </div>

    <script>
        $("input.toggle-all").change(function () {
			var cn=$(this).attr('data-class');
			console.log(cn);
            var chk = $(this).is(":checked");
            if (chk) {
                $("input[type=checkbox]."+cn).prop("checked", true);
            } else {
                 $("input[type=checkbox]."+cn).prop("checked", false);
            }
			
			var f=$(this).closest('form');
			
			autoform_submit(f.get(0));
        });
		 $("input[type=checkbox][name^=mb_auto],input[type=checkbox][name^=ac_auto]").change(function () {
		 
		 	var f=$(this).closest('form');			
			autoform_submit(f.get(0));
		 });
       
	   
	   
	// 오토 스위칭 변
	function autoform_submit(f)
	{

		event.preventDefault();
		var formData = $(f).serialize();	

		$.ajax({
			type: "POST",
			url: "./automatching.update.php",
			data:formData,
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {

				if(data.result==true){					

					var mb_bank=	data.datas['mb_bank'];
					
					$('.mb_bank').html(mb_bank);
					$('input[name=mb_bank]').val(mb_bank);
					
					//Swal.fire({text:'적용되었습니다',timer:1000});   
				}
				else{	
					f.reset();
					Swal.fire(data.message);       
				}
			}	
		});		
		return;
	}
    </script>

<?	
include_once('../_tail.php');
?>
