<?php
$sub_menu = "700560";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['cn_item_cart']} a left outer join  {$g5['member_table']} as b on(a.mb_id=b.mb_id) ";
$sql_search = " where a.is_soled!='1'   ";

if($date_start_stx) {
	$sql_search .= " and a.ct_wdate >= '$date_start_stx 00:00:00' ";
	$qstr.="&date_start_stx=$date_start_stx";
}
if($date_end_stx) {
	$sql_search .= " and a.ct_wdate <= '$date_end_stx 23:59:59' ";
	$qstr.="&date_end_stx=$date_end_stx";
}
if($item_stx) {
	$sql_search .= " and a.cn_item = '$item_stx' ";
	$qstr.="&item_stx=$item_stx";
}
if($code_stx) {
	$sql_search .= " and a.code like '%$code_stx%' ";
	$qstr.="&code_stx=$code_stx";
}
if($trade_stx!='') {
	$sql_search .= " and a.is_trade = '$trade_stx' ";
	$qstr.="&trade_stx=$trade_stx";
}
if ($stx) {
	if($sfl=='a.mb_id') $sql_search .= "and ($sfl = '$stx') ";
    else $sql_search .= "and ($sfl like '%$stx%') ";
}
if ($mb_stx) {
    $sql_search .= " and b.mb_id='$mb_stx' ";	
	$qstr.="&mb_stx=$mb_stx";
}
if ($manual_stx!='' ) {
    $sql_search .= " and a.ct_manual='$manual_stx' ";	
	$qstr.="&manual_stx=$manual_stx";
}


if (!$sst) {
    $sst  = "a.code ";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search}";
$row = sql_fetch($sql,1);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select a.* {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] =  ($g5['cn_item_name']).'-생성내역';

include_once(G5_ADMIN_PATH.'/admin.head.php');

$colspan = 16;
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

$temp1=sql_fetch("select count(*) cnt from {$g5['cn_item_cart']} where date(ct_validdate)=date(now())",1);
$temp2=sql_fetch("select count(*) cnt  from {$g5['cn_item_cart']} where date(ct_validdate) = ".(date("Y-m-d",time()+86400) ));
$temp3=sql_fetch("select count(*) cnt  from {$g5['cn_item_cart']} where date(ct_validdate) < date(now())");

?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">등록된 수</span><span class="ov_num"> <?php echo number_format($total_count) ?>개</span></span>
	<span class="btn_ov01"><span class="ov_txt">오늘보유마감</span><span class="ov_num"> <?php echo number_format($temp1[cnt]) ?>개</span></span>
	<span class="btn_ov01"><span class="ov_txt">내일보유마감</span><span class="ov_num"> <?php echo number_format($temp2[cnt]) ?>개</span></span>
	<span class="btn_ov01"><span class="ov_txt">보유기간경과</span><span class="ov_num"> <?php echo number_format($temp3[cnt]) ?>개</span></span>
</div>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">

<span class='nowrap'>구매일:
<input type="text" name="date_start_stx" value="<?php echo $date_start_stx?>" id="date_start_stx"  class="frm_input calendar-input" size="12" placeholder="시작일" />
~
<input type="text" name="date_end_stx" value="<?php echo $date_end_stx?>" id="date_end_stx"  class="frm_input calendar-input" size="12" placeholder="종료일" />
</span>


<input name="code_stx" type="text" class="frm_input" id="code_stx" placeholder="코드검색" value="<?php echo $code_stx ?>">

<select name='trade_stx' class="form-control input-sm  w-auto  mb-1" >
<option value=''>-거래상태-</option>
<option value='1' <?=$trade_stx==1?'selected':''?> >거래중</option>
<option value='0' <?=$trade_stx==1?'selected':''?> >미거래중</option>

</select>
<select name='item_stx' class="form-control input-sm  w-auto  mb-1" >
<option value=''>-상품검색-</option>
<?
foreach($g5['cn_item'] as $k=>$v){?>
<option value='<?=$k?>' <?=$item_stx==$k?'selected':''?> ><?=$v[name_kr]?></option>
<? }?>
</select>
<select name="sfl" id="sfl">
<option value="a.mb_id"<?php echo get_selected($_GET['sfl'], "a.mb_id"); ?>>현재소유아이디</option>
<option value="a.smb_id"<?php echo get_selected($_GET['sfl'], "a.smb_id"); ?>>현재</option>
<option value="a.ct_meta_owner"<?php echo get_selected($_GET['sfl'], "a.ct_meta_owner"); ?>>최초지급자아이디</option>
<option value="a.ct_meta_owner"<?php echo get_selected($_GET['sfl'], "a.ct_meta_owner"); ?>>지급사유</option>
<option value="a.fmb_id"<?php echo get_selected($_GET['sfl'], "a.fmb_id"); ?>>판매자아이디</option>
<option value="a.fsmb_id"<?php echo get_selected($_GET['sfl'], "a.fsmb_id"); ?>>판매자서브아이디</option>
</select>

<label for="code_stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
<input type="submit" value="검색" class="btn_submit">

</form>


<input type="hidden" name="token" value="<?php echo $token ?>">
<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">번호</a></th>
<th scope="col">코드</th>
<th scope="col"><?php echo subject_sort_link('a.cn_item',$qstr) ?>상품</a></th>
<th scope="col"><?php echo subject_sort_link('a.ct_meta_owner',$qstr) ?>최초지급자</a></th>
    <th scope="col">최초가격</th>
        <!--th scope="col">입금계좌</th-->
    <th scope="col"><?php echo subject_sort_link('a.ct_meta_sdate',$qstr) ?>최초날자</a></th>
<th scope="col">지급사유</th>
<th scope="col"><?php echo subject_sort_link('a.mb_id',$qstr) ?>현재보유자</a></th>
<th scope="col"><?php echo subject_sort_link('a.ct_buy_price',$qstr) ?>현재가격</a></th>
<th scope="col"><?php echo subject_sort_link('a.is_trade',$qstr) ?>상태</a></th>
</tr>
    </thead>
    <tbody>
    <?php
	
	$list_num = $total_count - ($page - 1) * $rows;
	
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
		
		
		//$past_day=ceil( (strtotime($row['ct_validdate'])-time() ) /86400 );
		
    ?>
	
<tr class="<?php echo $bg; ?>">
<td  class="td_num">
<?=$list_num?>
</td>
<td ><?php echo $row['code'] ?></td>
<td ><?php echo $g5['cn_item'][$row['cn_item']][name_kr] ?></td>
<td class='mb-info-open' data-id='<?php echo $row['ct_meta_owner'] ?>'><?php echo $row['ct_meta_owner'] ?></td>
<td class="td_datetime"><?php echo number_format($row['ct_meta_price'])?> </td>
    <td class="td_datetime"><?php echo $row['ct_meta_sdate']?></td>
<td class="td_datetime"><?php echo $row['ct_meta_memo']?></td>
<td class='mb-info-open' data-id='<?php echo $row['mb_id'] ?>'><?php echo $row['smb_id']?$row['smb_id'].' @ ':'' ?><?php echo $row['mb_id'] ?></td>
<td class="td_datetime"><?php echo number_format($row['ct_buy_price'])?></td>
<td class="td_right"><?php echo $g5['cn_cartstat'][$row['is_trade']]?></td>
</tr>

    <?php
	$list_num--;
    }
    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>



<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>

<script>
function set_dates(s,e){
	$("input[name='date_start_stx']","#fsearch").val(s);
	$("input[name='date_end_stx']","#fsearch").val(e);
}

function fboardlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }
	
    return true;
}

$(function(){
  
});
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');

?>
