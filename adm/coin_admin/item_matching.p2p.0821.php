 <?php
$sub_menu = "700750";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$html_title = $g5[cn_item_name].'-매칭실행-P2P';

//$lg_code=get_cookie('lg_code');
//$//lg_data=sql_fetch("select * from  {$g5['cn_item_log']} where lg_code='$lg_code' ",1);


$g5['title'] = $html_title;
include_once(G5_ADMIN_PATH.'/admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

if($steps=='') $steps='ready';

?>

<form name="fcommonform1" id="fcommonform1" action="./item_matching.block.php" method="post"  onsubmit="return fcommonform1_ajax(this);" enctype="multipart/form-data">
<input type="hidden" name="w" value="b">

<input type="hidden" name="token" value="">

<section id="anc_rt_basic">
<h2 class="h2_frm">매칭 사전 조치</h2>

<div class="tbl_frm01 tbl_wrap">


<table>

<colgroup>
		<col class="grid_4">
		<col>
		<col class="grid_3">
</colgroup>

       
<tr>
<th scope="row"><label for="in_set_amt2">사용자 서비스 중지</label></th>
<td>
<label><input name="service_block" type="checkbox" id="service_block" value="1" <?=$cset[service_block]=='1'?'checked':''?> >
서비스를 중지합니다.</label><br>
로그인/로그아웃을 제외한  모드 서비스를 중지합니다.<br>
매칭 종료후에 다시 해제 하세요.<br>
<span class="text-center">
<input type="submit" name="act_button" value="서비스 중지 설정" class="btn_submi btn btn_01" accesskey="s">
</span></td>
</tr>
</table>
</div>

<div class="text-center"></div>

</section>
</form>


<script>

// 서비스 블럭 설정
function fcommonform1_ajax(f)
{

	event.preventDefault();
	var formData = $(f).serialize();		
	
	$.ajax({
		type: "POST",
		url: f.action,
		data:formData,
		cache: false,
		async: false,
		dataType:"json",
		success: function(data) {

			if(data.result==true){
				
				alert('처리되었습니다');
			}
			else alert(data.message);          
		}
	});	
	return;
}

</script>




<form name="fcommonform2" id="fcommonform2" action="./item_matching.p2p.update.php" method="post"  onsubmit="return fcommonform2_ajax(this);" enctype="multipart/form-data">
<input type="hidden" name="w" value="p">
<input type="hidden" name="page" value="1">
<input type="hidden" name="prev_total" value="0">

<input type="hidden" name="token" value="">
<section id="anc_rt_basic">
<h2 class="h2_frm">매도자 매칭조건 생성</h2>
<div class="tbl_frm01 tbl_wrap">
<table>

<tr>
<th scope="row"><label for="in_set_amt2">매칭기준일자</label></th>
<td><input name="start_date" type="text"  class="frm_input calendar-input " id="start_date" value="<?=date("Y-m-d")?>" size="20" /></td>
</tr>
 <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_3">
        </colgroup>
<tr>
<th scope="row">지정코드</th>
<td>
<?=help('지정한 코드의 '.$g5[cn_item_name].'만을 매칭에 포함합니다.  1개/1라인 또는 콤마로 구분하여 입력하세요. 유효일 미경과 되거나 거래가 진행중인 상품은 매칭되지 않습니다')?>
<?=help('100개 이내')?>
<textarea name='target_code' class='' id="target_code"></textarea></td>
</tr>
<tr>
<th scope="row">지정회원</th>
<td><?=help('지정한 회원만 매칭에 포함합니다.  1개/1라인 또는 콤마로 구분하여 입력하세요. ')?>
<textarea name='target_seller' class='' id="target_seller"></textarea></td>
</tr>
<tr>
<th scope="row">제외될 아이디</th>
<td><?=help('제외될 아이디를 1인/1라인 또는 콤마로 구분하여 입력하세요')?>
<textarea name='except_seller' class=''></textarea></td>
</tr>
<tr>
<th scope="row">지정일 미거래</th>
<td><input name="miss_date_seller" type="text"  class="frm_input " id="miss_date" size="50" placeholder="2020-01-02 형태로 입력"/>
<br>
매도자 중 해당일자에 거래가 불발된 회원(매수자 원인 제공).
콤마로 구분하여 입력</td>
</tr>
<tr>
<th scope="row"><label for="in_set_amt2">연속 미거래</label></th>
<td>오늘을 포함한 이전거래에서 
<input name="miss_cnt_seller" type="text"  class="frm_input " id="miss_cnt_seller" value="0" size="5"/>
회 이상 연속 미거래 상품만 매칭<br>
(0 이면 제한없음, 미거래건을 모두 취소로 변경후 실행)</td>
</tr>
<tr>
<th scope="row"><label for="in_set_amt2">미시용자 제한</label></th>
<td><input name="login_day_seller" type="text"  class="frm_input " id="login_day_seller" value="0" size="5"/>
일 이내  로그인 기록이 없는 사용자 제외 (0 이면 제한없음)</td>
</tr>
<tr>
<th scope="row"><label for="in_set_amt2">판매자수수료</label></th>
<td><label>
<?=help('지불할 수수료가 부족한 매도자는 지불 가능 수수료 한도내에서만 매칭에 참여 됩니다. 금액이 큰 '.$g5['cn_item_name'].' 매칭부터 우선 사용됩니다')?>
<input name="seller_fee_free" type="radio"  value="free" checked="checked"  >
수수료 없이 매칭 진행</label>
&nbsp;&nbsp;
<label>
<input name="seller_fee_free" type="radio"  value="pay"   >
<?=$g5['cn_item_name']?>
별 지정 수수료 부과</label></td>
</tr>
</table>

<div class="text-center " style='margin-top:10px;'></div>
</div>
</section>

<section id="anc_rt_basic">

<h2 class="h2_frm">매수자 매칭 목록 생성</h2>
    <div class="tbl_frm01 tbl_wrap">
	

 
        <table>

 <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_3">
        </colgroup>
<tr>
<th scope="row">지정회원</th>
<td><?=help('지정한 회원만 매칭에 포함합니다.  1개/1라인 또는 콤마로 구분하여 입력하세요. 회원이 지정되는 경우 회원레벨(구분)에 상관없이 매칭에 참여 됩니다.')?>
<textarea name='target_buyer' class='' id="target_buyer"></textarea></td>
</tr>
<tr>
<th scope="row">제외될 아이디</th>
<td><?=help('제외될 아이디를 1인/1라인 또는 콤마로 구분하여 입력하세요')?>
<textarea name='except_buyer' class='' id="except_buyer"></textarea></td>
</tr>
<tr>
<th scope="row"><label for="in_set_amt2">지정일 미거래</label></th>
<td><input name="miss_date_buyer" type="text"  class="frm_input " id="miss_date_buyer" size="50" />
<br>
매수장 중 해당일자에 거래가 불발된 회원(매도자 원인 제공).
콤마로 구분하여 입력</td>
</tr>
<tr>
<th scope="row"><label for="in_set_amt2">매칭횟수제한</label></th>
<td>동일 상품
<input name="match_cnt_seller" type="text"  class="frm_input " id="match_cnt_seller" value="0" size="5"/>
건 이내 /
1계정 이내로 제한 합니다</td>
</tr>
<tr>
<th scope="row"><label for="in_set_amt2">미시용자 제한</label></th>
<td><input name="login_day" type="text"  class="frm_input " id="login_day" value="0" size="5"/>
일 이내  로그인 기록이 없는 사용자  제외 (0 이면 제한없음)</td>
</tr>
<tr>
<th scope="row"><label for="in_set_amt2">설정금액 제한</label></th>
<td>
<label>
<input name="enable_amt_check" type="radio"  value="y" checked="checked"  >
설정금액 제한 있음</label>
&nbsp;&nbsp;
<label>
<input name="enable_amt_check" type="radio"  value="n"  >
설정금액 제한 없음</label></td>
</tr>
<tr>
<th scope="row"><label for="in_set_amt2">구매자수수료</label></th>
<td>
<?=help('지불할 수수료가 부족한 매수자는 지불 가능 수수료 한도내에서만 매칭에 참여 됩니다. 금액이 큰 '.$g5['cn_item_name'].' 매칭부터 우선 사용됩니다')?>
<label>
<input name="fee_free" type="radio"  value="pay" checked="checked"  >
<?=$g5['cn_item_name']?>별 지정 수수료 부과</label>
&nbsp;&nbsp;&nbsp;

<label>
<input name="fee_free" type="radio"  value="free" <?=$fee_free=='free'?'checked':''?> >
수수료 없이 매칭 진행</label>&nbsp;&nbsp;



</td>
</tr>
<tr>
<th scope="row"><label for="in_set_amt2">계정활성화</label></th>
<td>
<label>
<input name="active_chk" type="radio"  value="y" checked="checked"  >
비활성화 계정은 매칭 제외</label>
&nbsp;&nbsp;&nbsp;
<label>
<input name="active_chk" type="radio"  value="n"  >
활성화 여부 관계 없이 매칭</label>
</td>
</tr>
<tr>
<th scope="row">보유회원제외</th>
<td>
<label>
(
<input name="posess_item" type="radio" id="posess_item" value="same" checked="checked"    >
동일 <?=$g5['cn_item_name']?>을</label>&nbsp;&nbsp;
<label><input name="posess_item" type="radio" id="posess_item" value="any" >
어떤 <?=$g5['cn_item_name']?>이라도</label>
) 
<br>
<label>
<input name="posess_disable" type="radio" id="posess_disable" value="member"   >
보유한 회원 제외(서브계정포함)</label>
<label>
<input name="posess_disable" type="radio" id="posess_disable" value="account" >
보유한 계정만 제외</label>
<label>
<input name="posess_disable" type="radio" id="posess_disable" value="none" checked="checked" >
조건없음</label>

</td>
</tr>
</table>
</div>
</section>

<section id="anc_rt_basic">

<h2 class="h2_frm">매칭실행</h2>
    <div class="tbl_frm01 tbl_wrap">
	

 
        <table>

 <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_3">
        </colgroup>
<tr>
<th scope="row">매칭 실행</th>
<td>

<?
$i=0;
$cn_item_arr=array_reverse($g5['cn_item']);
foreach($cn_item_arr as $k=> $v) {    
?>
<label>
<input name="item_exe[]" type="checkbox" id="item_exe_<?=$k?>" value="<?=$k?>" checked >
<?=$v[name_kr]?></label>&nbsp;&nbsp;
<? }?>
</td>
</tr>
<tr>
<th scope="row">실행상태</th>
<td>
<span id='statsw' style='font-size:16px;line-height:20px;white-space:normal;'><i class="fa fa-ban  fa-2x" aria-hidden="true"></i> 없음</span>
<span id='statsp'></span> 
</td>
</tr>
</table>
</div>


</section>

<div class="text-center">
<input type="button" name="act_button" value="담겨진 매칭 관리" onclick="window.open('./item_matching.p2p.list.php');" class="btn_prev btn btn_03 " style='float:left;' accesskey="s">
<input type="submit" name="act_button" value="매도 상품 검토" onclick="document.fcommonform2.w.value='s';document.pressed=this.value;" class="btn_prev btn btn_02" accesskey="s">
<input type="submit" name="act_button" value="비우고 다시 매칭 생성" onclick="document.fcommonform2.w.value='d';document.pressed=this.value; "class="btn_submi btn btn_01" accesskey="s">
</div>


</form>


<div id='result_window' style='width:100%;height:900px;padding:10px;overflow-y:auto;background:#efefef;border:1px solid;#787878;margin-top:10px;'>

</div>


<script>  
$(document).ready(function(e) {
	
});

function fcommonform2_ajax(f)
{
		 
	event.preventDefault();	
	var	qty=0;

	$("input[name^=item_exe]").each(function(){		
		if($(this).is(":checked")==true )  qty++;
	
	});
	
	if (qty < 1) {
	  alert("진행할 <?=$g['cn_item_name']?>을 선택하세요.");          
	  return false;
	}
	
	var nowp=$("input[name=page]","#fcommonform2").val();
	
	if(document.pressed == "매칭실행") {
       if(!confirm("매칭을 진행하시겠습니까?")) {
           return false;
        }
    }	
	
	if(nowp==1){
		$('#statsw').html('<i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"> </i> 진행중');
		$('#statsp').html('..1' );
	}
	
	if($("input[name=page]","#fcommonform2").val()=='1') $('#result_window').html('');	
		
	var rtn=true;

	var formData = $(f).serialize();	

	$.ajax({
		type: "POST",
		url: "./item_matching.p2p.update.php",
		data:formData,
		cache: false,
		async: true,
		dataType:"json",
		success: function(data) {

			if(data.result==true){					
				$('#result_window').html($('#result_window').html() + data.datas['htmls']);
				//console.log(data.datas['htmls']);
				
				if(data.datas['next']=='y'){
					$("input[name=page]","#fcommonform2").val(data.datas['page']);
					$("input[name=prev_total]","#fcommonform2").val(data.datas['total']);
					
					$('#statsp').html($('#statsp').html()+'..' + data.datas['page'] );
					
					setTimeout(fcommonform2_ajax(document.fcommonform2),1000);					
				}else{
					$("input[name=page]","#fcommonform2").val(1);
					$("input[name=prev_total]","#fcommonform2").val(0);
					
					$('#statsw').html('<i class="fa fa-stop-circle   fa-2x" aria-hidden="true"></i>  완료');		
				
				}
								
			}
			else{
				alert(data.message);      
				
				$('#statsw').html('<i class="fa fa-stop-circle  fa-2x" aria-hidden="true"></i>  완료');
				
				rtn=false;
			}
		}
	});		

	if(rtn==false) return false;;

	
	alert_loading2('매칭종료','close');	
	
	return false;;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
?>
