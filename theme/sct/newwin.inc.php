<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$sql = " select * from {$g5['new_win_table']}
          where '".G5_TIME_YMDHIS."' between nw_begin_time and nw_end_time
            and nw_device IN ( 'both', 'pc' )
          order by nw_id asc ";
$result = sql_query($sql, false);
?>


<?php
$script_str='';
for ($i=0; $nw=sql_fetch_array($result); $i++)
{
    // 이미 체크 되었다면 Continue
    if ($_COOKIE["hd_pops_{$nw['nw_id']}"])
        continue;
?>
	<div id="hd_pops_<?php echo $nw['nw_id'] ?>" class="p-3  modal shadow-lg"  style=" max-width:100%; width:<?php echo $nw['nw_width'] ?>px;height:<?php echo $nw['nw_height'] ?>px;" >
		
		<div style='position:relative; width:100%;height:100%;overflow-y:auto;paddding:0;margin:0;'>       
            <?php echo conv_content($nw['nw_content'], 1); ?>
        </div>
        <div class='w-100 text-center' style='position:absolute;bottom:5px;' >
            <a class="hd_pops_<?php echo $nw['nw_id']; ?>  <?php echo $nw['nw_disable_hours']; ?> btn btn-sm btn-dark hd_pops_reject " rel="modal:close"><strong><?php echo $nw['nw_disable_hours']; ?></strong>시간 동안 다시 열람하지 않습니다.</a>
            <a  class='hd_pops_<?php echo $nw['nw_id']; ?> btn btn-sm btn-dark hd_pops_close ' rel="modal:close" >닫기</a>
        </div>
	
	</div>
<?php 
$script_str.="$('#hd_pops_{$nw['nw_id']}').modal('show');\n";

}
//if ($i == 0) echo '<span class="sound_only">팝업레이어 알림이 없습니다.</span>';
?>

<?
//패널티 알림
if($member[mb_trade_penalty]  > 0 && !$_COOKIE["hd_pops_penalty"] ){
?>

<div id="hd_pops_penalty" class="p-2  modal shadow-lg"  style="width:600px;height:500px" >

	<div>
	 <?
	 if($member[mb_trade_penalty]  ==1 ){?>
	 회원님은 불량거래 회원으로 신고되었으며, 모든 증거금이 몰수 되었습니다.
	 <?}else  if($member[mb_trade_penalty] > 1 ){?>
	  불량거래 회원으로써 누적 2회 신고되었으며, 계정 삭제 및 접속 차단 되었습니다

	 <? }?>
	</div>
	<div class='w-100 text-center' style='position:absolute;bottom:5px;' >
		<button class="hd_pops_penalty  <?php echo $nw['nw_disable_hours']; ?> btn btn-sm btn-dark hd_pops_reject " rel="modal:close"><strong>12</strong>시간 동안 다시 열람하지 않습니다.</button>
		<button  class='hd_pops_penalty btn btn-sm btn-dark hd_pops_close ' rel="modal:close" >닫기</button>
	</div>
</div>
<?
$script_str.="$('#hd_pops_penalty').modal('show');\n";

}?>

<script>

$(function() {
 	
 	<?=$script_str?>
	
    $(".hd_pops_reject").click(function() {
        var id = $(this).attr('class').split(' ');
        var ck_name = id[0];
        var exp_time = parseInt(id[1]);
       // $("#"+id[0]).css("display", "none");		
        set_cookie(ck_name, 1, exp_time, g5_cookie_domain);
		$.modal.close();
    });
    $('.hd_pops_close').click(function() {
        var idb = $(this).attr('class').split(' ');
		$.modal.close();
        //$('#'+idb[0]).css('display','none');
    });
    $("#hd").css("z-index", 1000);
});
</script>
<!-- } 팝업레이어 끝 -->