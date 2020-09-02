<?php
include_once('./_common.php');
add_javascript('<script src="'.G5_THEME_URL.'/extend/clipboard.min.js"></script>', 1);

include_once('../_head.php');

//서브 계정 없으면 추가
$subadd=set_basic_account($member);

?>
    <div class="wrap">       
        <div class="topCommon">   
            <div class="userInfo">
                <img src="<?=G5_THEME_URL?>/images/userBg.svg">
                <span><img src="<?=G5_THEME_URL?>/images/user.svg" alt="USER07" class="userImg"/></span>
                <span class="userName"  onclick="document.location.href='/for_common/myPage.php'"><span><?=$member[mb_id]?> <?=lng('님')?></span></span>
            </div>  
        </div>
        
		
        <div class="sec secList secList02 secList03_02">
           <div class="longBtn Btn w_btn"><a>GOLD : $<?=number_format2($mrpoint[i]['_enable'])?></a></div>
            <ul>
                <li class="settingBtn"  onclick="document.location.href='/for_common/myPage.php'"><span>$<?=number_format2($member[mb_trade_amtlmt])?></span><?=lng('설정금액')?></li>
                <li class="f_black"><span>$<?=number_format2($isum[tot][price])?></span><?=lng('보유금액')?></li>
            </ul>    
        </div>
        <div class="bar"></div>
    </div>
	<?php
            $is_auto=sql_fetch(" select count(*) cnt  from  {$g5['cn_sub_account']} where mb_id='{$member['mb_id']}' and (ac_auto_a='1' or ac_auto_b='1' or ac_auto_c='1' or ac_auto_d='1' or ac_auto_e='1' or ac_auto_g='1' or ac_auto_g='1' or ac_auto_h='1' ) ");
            ?>
			
			
    <div class="deal">
        <div class="wrap">
            <h3>AUTO MATCHING</h3>
			<form name='autoform' id='autoform' onsubmit='autoform_all_submit(this);' >
				<input type='hidden' name='w' value='al' >
            <span class="check top-check">                               
               <input type="checkbox" name="mb_auto_all"  id="selc-m"  <?=$is_auto[cnt] > 0 ?'checked':''?> value='1' >
               <label for="selc-m"></label>
           </span>
		   </form>
            <ul class="crown">
				  <?php
                //서브 계정
                $accresult=sql_query("select * from  {$g5['cn_sub_account']} where mb_id='$member[mb_id]' order by ac_id asc");
                while ($ac=sql_fetch_array($accresult)) {?>

			
               	 <li>
				<form name='autoform<?=$ac[ac_no]?>' id='autoform<?=$ac[ac_no]?>' onsubmit='autoform_submit(this);' >
				<input type='hidden' name='w' value='au' >
				<input type='hidden' name='ac_id' value='<?=$ac[ac_id]?>' >	
				
                    <h3><?=lng('계정')?> : <?=$ac[ac_id]?></h3>
                    <span class="check crown-check"> 
                      <input type="checkbox" id="selc-1-<?=$ac[ac_no]?>" class='toggle-all' data-class='toggle-<?=$ac[ac_no]?>' <?=$ac[ac_auto_a]||$ac[ac_auto_a]||$ac[ac_auto_c]||$ac[ac_auto_d]?'checked':''?> >
                       <label for="selc-1-<?=$ac[ac_no]?>"></label>
                    </span>
                    <div class="secList secList04">
                        <ul class="bitSelect">
							<?php
                            foreach ($g5['cn_item'] as $k=>$v) {?>
                           <li>                           
                               <span class="check sel-check">                               
                                   <input type="checkbox" name="ac_auto_<?=$k?>" id="selc-<?=$k?>-<?=$ac[ac_no]?>"  class='toggle-<?=$ac[ac_no]?>' value='1' <?=$ac['ac_auto_'.$k]?'checked':''?> >
                                   <label for="selc-<?=$k?>-<?=$ac[ac_no]?>">
                                       <img src="<?=G5_THEME_URL?>/images/item/<?=$v[img]?>">
                                       <span class="selc-<?=$k?>-<?=$ac[ac_no]?>"><?=lng('선택')?></span>
                                   </label>
                               </span>
                           </li>
						   <?php } ?>
						   
                           
                       </ul> 
                    </div>
					</form>
                </li>
				<?php }?>
				
            </ul>
        </div>        
    </div>
    

  <script>
  
  $("input.toggle-all").change(function () {
		var cn=$(this).attr('data-class');
		//console.log(cn);
		var chk = $(this).is(":checked");
		if (chk) {
			$("input[type=checkbox]."+cn).prop("checked", true);
		} else {
			 $("input[type=checkbox]."+cn).prop("checked", false);
		}

		var f=$(this).closest('form');

		autoform_submit(f.get(0));
	});
	 $("input[type=checkbox][name^=ac_auto]").change(function () {

		var f=$(this).closest('form');			
		autoform_submit(f.get(0));
	 });
	 $("input[type=checkbox][name=mb_auto_all]").change(function () {

		var f=$(this).closest('form');			
		autoform_all_submit(f.get(0));
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
	
	
		
	// 오토 스위칭 변
	function autoform_all_submit(f)
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
					$("input[type=checkbox][name^=ac_auto],input[type=checkbox].toggle-all").prop('checked',false);

					for (var ac_no in data.datas) {
						var d=data.datas[ac_no];
						
						if(d.length > 0) $("input[type=checkbox]#selc-1-"+ac_no).prop('checked',true);
						
						for (var c in d) {
							if(d[c]=='a') $("input[type=checkbox]#selc-2-"+ac_no).prop('checked',true);
							if(d[c]=='b') $("input[type=checkbox]#selc-3-"+ac_no).prop('checked',true);
							if(d[c]=='c') $("input[type=checkbox]#selc-4-"+ac_no).prop('checked',true);
							if(d[c]=='d') $("input[type=checkbox]#selc-5-"+ac_no).prop('checked',true);							
							
							//console.log(d[c]);
						}
					}
					
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
<?php
include_once('../_tail.php');
?>
