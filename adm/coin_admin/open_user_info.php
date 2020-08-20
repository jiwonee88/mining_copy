<?php
error_reporting(E_ALL);

ini_set("display_errors", 1);



$sub_menu = "200000";
include_once('./_common.php');

$mb=get_member($mb_id);


//보유 금액
$isum=get_itemsum($mb_id);

if($mb[mb_id]) $g5['title'] = $mb[mb_id]." [".$mb[mb_name].'] 거래정보';
else  $g5['title'] = '회원을 찾을수 없습니다';

include_once(G5_ADMIN_PATH.'/admin.head.pop.php');

$search_date=date("Y-m-d",strtotime('-1 months'));

if($mb[mb_id]){
?>
<form name="fcommonform" id="fcommonform" action="<?=$_SERVER[SCRIPT_NAME]?>" onsubmit="return fcommonform_submit(this)" method="post" enctype="multipart/form-data">
 <input type="text" name="mb_id" value="<?php echo get_text($mb['mb_id']) ?>" id="mb_id" required class="required frm_input" size="30">
<input type="submit" value="회원변경" class="btn btn_03" />
<input type="button" value="회원찾기" id="openMSearchBtn" class="btn btn_02" />     
</form>
<h2 class="h2_frm">기본정보</h2>

<h3>설정금액 : <?=number_format2($mb[mb_trade_amtlmt])?> / 보유금액 : <?=number_format2($isum[tot][price])?> / 가용금액 : <?=number_format2($isum[tot][price]>$mb[mb_trade_amtlmt]?0:$mb[mb_trade_amtlmt]-$isum[tot][price])?></h3>
<h3>입금계좌정보 : 은행명 : <?=$mb[mb_bank]?$mb[mb_bank]:'-'?> / 계좌번호 : <?=$mb[mb_bank_num]?$mb[mb_bank_num]:'-'?> / 예금주 : <?=$mb[mb_bank_user]?$mb[mb_bank_user]:'-'?></h3>


<div class="tbl_head01 tbl_wrap">
<table>
<thead>
<tr>
<th id="mb_list_id" scope="col">아이디</a></th>
<th id="mb_list_id" scope="col">이름</a></th>
<th scope="col" >이메일</a></th>
<th scope="col" id="mb_list_cert">권한</th>
<th id="mb_list_id" scope="col">추천인</th>
<th id="mb_list_id" scope="col">하위추천인</th>
<?
		//계정별
		foreach($g5['cn_cointype'] as $k=> $v){ ?>
<th id="mb_list_id" scope="col">총
<?=$v?>
수량</th>
<? }?>
<th scope="col" id="mb_list_cert"><!--이메일/-->
지갑</th>
<th scope="col" id="mb_list_cert">연락처</th>
<th class="w-auto" id="mb_list_cert" scope="col">패널티횟수</a></th>
<th class="w-auto" id="mb_list_cert" scope="col">최근패널티 일시</th>
<th id="mb_list_lastcall" scope="col">최종접속</a></th>
<th scope="col" >가입일</th>
</tr>
</thead>
<tbody>
<?php

$leave_date = $mb['mb_leave_date'] ? $mb['mb_leave_date'] : date('Ymd', G5_SERVER_TIME);
$intercept_date = $mb['mb_intercept_date'] ? $mb['mb_intercept_date'] : date('Ymd', G5_SERVER_TIME);

$mb_nick = get_sideview($mb['mb_id'], get_text($mb['mb_nick']), $mb['mb_email'], $mb['mb_homepage']);

$mb_id = $mb['mb_id'];
$leave_msg = '';
$intercept_msg = '';
$intercept_title = '';
if ($mb['mb_leave_date']) {
	$mb_id = $mb_id;
	$leave_msg = '<span class="mb_leave_msg">탈퇴함</span>';
}
else if ($mb['mb_intercept_date']) {
	$mb_id = $mb_id;
	$intercept_msg = '<span class="mb_intercept_msg">차단됨</span>';
	$intercept_title = '차단해제';
}
if ($intercept_title == '')
	$intercept_title = '차단하기';

$address = $mb['mb_zip1'] ? print_address($mb['mb_addr1'], $mb['mb_addr2'], $mb['mb_addr3'], $mb['mb_addr_jibeon']) : '';

$bg = 'bg'.($i%2);

$count=sql_fetch("select count(*) cnt  from {$g5['cn_tree']} where mb_id='{$mb[mb_id]}'");			

//서브 계정
$temp=sql_fetch("select count(*) cnt  from  {$g5['cn_sub_account']} where mb_id='{$mb[mb_id]}' and ac_id != '{$mb[mb_id]}'");
 ?>
<tr class="<?php echo $bg; ?>">
<td  ><?php echo $mb_id ?></td>
<td  ><?php echo $mb[mb_name] ?></td>
<td  >
<?=$mb['mb_email']?>
</td>
<td><strong>
<?php echo $mb['mb_14']=='vip'?"[<strong style='color:red'>VIP</strong>]<br>":'' ?>
<?php echo $g5['member_level_name'][$mb['mb_level']] ?></strong></td>
<td  ><?php echo $mb['mb_recommend']?$mb['mb_recommend']:'-'?></td>
<td  >
<?php echo $count['cnt']?>
</td>
<?
    //계정별
    foreach($g5['cn_cointype'] as $k=> $v){ ?>
<td  ><?php echo number_format2($mb['mb_point_free_'.$k],8)?></td>
<? }?>
<td class='td_left' ><?//=$mb['mb_email']?>
<!--(인증 : <?php echo preg_match('/[1-9]/', $mb['mb_email_certify'])?'<span class="txt_true">Yes</span>':'<span class="txt_false">No</span>'; ?>)-->
<?
    //계정별
    foreach($g5['cn_coin_in'] as $v){?>
<p>
<?=$g5['cn_cointype'][$v]?>
: <?php echo $mb['mb_wallet_addr_'.$v]?$mb['mb_wallet_addr_'.$v]:'-'?></p>
<? }?></td>
<td><?=$mb['mb_hp']?></td>
<td class='td_date'><?php echo $row[mb_trade_penalty] ?></td>
<td class='td_datetime2'><?php echo $row[mb_trade_penalty_date] ?></td>
<td class="td_datetime fred"><?php echo substr($mb['mb_today_login'],2,14); ?></td>
<td class="td_date"><?php echo substr($mb['mb_datetime'],2,8); ?></td>
</tr>

</tbody>
</table>
</div>

<?
$month_arr=array();

//구매 내역
$re=sql_query("select  date_format(tr_wdate,'%Y-%m')dates, sum(ct_sell_price) ct_sell_price from coin_item_trade where tr_stats='3' and mb_id='$mb[mb_id]' group by date_format(tr_wdate,'%Y-%m') " ,1);
while($ds=sql_fetch_array($re)) {
	$month_arr[$ds[dates]]['ct_sell_price1']=$ds[ct_sell_price];
}

//판매 내역
$re=sql_query("select  date_format(tr_wdate,'%Y-%m') dates,  sum(ct_buy_price) ct_buy_price, sum(ct_sell_price) ct_sell_price, sum(ct_sell_price - ct_buy_price) amt from coin_item_trade where tr_stats='3' and fmb_id='$mb[mb_id]' group by date_format(tr_wdate,'%Y-%m') " ,1);
while($ds=sql_fetch_array($re)) {

	$month_arr[$ds[dates]]['ct_sell_price2']=$ds[ct_sell_price];
	$month_arr[$ds[dates]]['amt']=$ds[amt];
}

?>

<h2 class="h2_frm">수익내역 </h2>
<div class="tbl_head01 tbl_wrap">
<table>
<thead>
<tr>
<th id="mb_list_id" scope="col">월</th>
<th id="mb_list_id" scope="col">총구매</th>
<th id="mb_list_id" scope="col">총판매</th>
<th id="mb_list_id" scope="col">수익</th>

</tr>
</thead>
<tbody>
<?php

$tot_price1=$tot_price2=$tot_amt=$tot_cnt=0;

foreach($month_arr as $dates => $ds) {
 ?>
<tr class="<?php echo $bg; ?>">
<td  ><?php echo $dates ?></td>
<td  ><?php echo number_format2($ds['ct_sell_price1']) ?></td>
<td  ><?php echo number_format2($ds['ct_sell_price2']) ?></td>
<td  ><?php echo number_format2($ds['amt']) ?></td>

</tr>

<? 
$tot_price1+=$ds['amt'];
$tot_price2+=$ds['amt'];
$tot_amt+=$ds['amt'];
$tot_cnt+=$ds['cnt'];
}

?>
<tr class="<?php echo $bg; ?>">
<td  >총</td>
<td  ><?php echo number_format2($tot_price1) ?></td>
<td  ><?php echo number_format2($tot_price2) ?></td>
<td  ><strong><?php echo number_format2($tot_amt) ?></strong></td>

</tr>
</tbody>
</table>
</div>



<?

$sql_common = " from {$g5['cn_sub_account']} as a 
left outer join  {$g5['member_table']} as b on(a.mb_id=b.mb_id) 
left outer join  (select mb_id,count(*) ct_cnt,sum(ct_buy_price) ct_buy_price  from {$g5['cn_item_cart']} where  is_soled != '1' group by mb_id)  as c on(c.mb_id=b.mb_id) 
left outer join  (select mb_id,count(*) tr_cnt,sum(tr_price_org) tr_price_org  from {$g5['cn_item_trade']} where  tr_stats in ('1','2')  group by mb_id)  as t on(t.mb_id=b.mb_id) 	
		";

$sql_search = " where a.mb_id='$mb_id' ";


$sql_order = " order by a.ac_id asc ";


$sql = " select * {$sql_common} {$sql_search} {$sql_order}  ";
$result = sql_query($sql);

$colspan = 12 + sizeof($g5['cn_item'])+sizeof($g5['cn_cointype']);
?>
<h2 class="h2_frm">서브계정</h2>


<div class="tbl_head01 tbl_wrap">
<table>
<thead>
<tr>
<th id="mb_list_id2" scope="col">서브아이디</a></th>
<th scope="col" id="mb_list_cert2">설정금액</th>
<th scope="col" id="mb_list_cert2">보유금액</th>
<th scope="col" id="mb_list_cert2">거래(구매중)</th>
<th scope="col" id="mb_list_cert2">가용금액</th>
<th scope="col" id="mb_list_cert2">연락처</th>
<th scope="col" >활성화</a></th>
<?
		//계정별
		foreach($g5['cn_item'] as $k=> $v){ ?>
<th  scope="col"><?=$v[name_kr]?>
auto</th>
<? }?>
<?
		//계정별
		foreach($g5['cn_cointype'] as $k=> $v){ ?>
<th id="mb_list_id2" scope="col">총
<?=$v?>
수량</th>
<? }?>
<th scope="col" >보유
<?=$g5[cn_item_name]?></th>
<th scope="col" >결제</th>
<th scope="col" >우선매칭</th>
<th scope="col" >매칭제외</th>
<th scope="col" >생성일</th>
</tr>
</thead>
<tbody>
<?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
           
        $bg = 'bg'.($i%2);
		
		//스톤 물량
		$temp=sql_fetch("select count(*) cnt  from  {$g5['cn_item_cart']} where smb_id='{$row[ac_id]}' and is_soled!='1' ",1);
    ?>
<tr class="<?php echo $bg; ?>">
<td  ><?php echo $row[ac_id] ?></td>
<td><?=number_format2($mb['mb_trade_amtlmt'])?></td>
<td><?=number_format2($row['ct_buy_price'])?></td>
<td><?=number_format2($row['mtr_price_org'])?></td>
<td><?=number_format2($mb['mb_trade_amtlmt']-$row['ct_buy_price']-$row['mtr_price_org'])?></td>
<td><?=$row['mb_hp']?></td>
<td class='td_center'><?=$row['ac_active']?'Y':''?></td>
<?
    //오토매칭
    foreach($g5['cn_item'] as $k=> $v){ ?>
<td  ><?=$row['ac_auto_'.$k]?'Y':''?> </td>
<? }?>
<?
    //계정별
    foreach($g5['cn_cointype'] as $k=> $v){ ?>
<td  ><?php echo number_format2($row['ac_point_'.$k],8)?></td>
<? }?>
<td class="td_datetime"><?php echo $temp[cnt]; ?></td>
<td class="td_date"><?=$row[mb_trade_paytype]?></td>
<td class="td_date"><?=$row[ac_mc_priority]=='1'?'Y':''?> </td>
<td class="td_date"><?=$row[ac_mc_except]==1?'Y':''?> </td>
<td class="td_datetime"><?php echo $row['ac_wdate']; ?></td>
</tr>
<?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">서브계정이 없습니다.</td></tr>";
    ?>
</tbody>
</table>
</div>

<div class="btn_fixed_top"></div>
</form>


<?
$sql_common = " from {$g5['cn_item_cart']} a ";
$sql_search = " where a.is_soled!='1' and mb_id='$mb_id'";

if (!$sst) {
    $sst  = "a.code ";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select a.* {$sql_common} {$sql_search} {$sql_order}";
$result = sql_query($sql);

$total_count=sql_num_rows($result);
$colspan = 15;
?>

<h2 class="h2_frm">보유상품</h2>
<div class="tbl_head01 tbl_wrap">
<table>

<thead>
<tr>
<th rowspan="2" scope="col">번호</a></th>
<th rowspan="2" scope="col">코드</th>
<th rowspan="2" scope="col">소유아이디</th>
<th rowspan="2" scope="col">상품</a></th>
<th rowspan="2" scope="col">판매/지급</th>
<!--th scope="col">입금계좌</th-->
<th rowspan="2" scope="col">현재단계</th>
<th colspan="4" scope="col">스케쥴</th>
<th colspan="3" scope="col">가격</th>
<th rowspan="2" scope="col">상태</th>
<th rowspan="2" scope="col">분할<br>
판매</th>
</tr>
<tr>
<th scope="col">구매일</th>
<th scope="col">보유마감</th>
<th scope="col">기본보유일</th>
<th scope="col">경과일</th>
<th scope="col">구매가격</th>
<th scope="col">예정가격</th>
<th scope="col">이율</th>
</tr>
</thead>
<tbody>
<?php
	$list_num = 1 ;
	
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
		
		
		$past_day=ceil( (strtotime($row['ct_validdate'])-time() ) /86400 );
		
    ?>
<tr class="<?php echo $bg; ?>">
<td  class="td_num"><?=$list_num?></td>
<td ><?php echo $row['code'] ?></td>
<td ><?php echo $row['smb_id']?$row['smb_id'].' @ ':'' ?><?php echo $row['mb_id'] ?></td>
<td ><?php echo $g5['cn_item'][$row['cn_item']][name_kr] ?></td>
<td class="td_datetime"><?php echo $row['fsmb_id']&& $row['fsmb_id']!=$row['fmb_id']?$row['fsmb_id'].' @ ':'' ?> <?php echo $row['fmb_id']?></td>
<td class="td_datetime"><?php echo $row['ct_class']?></td>
<td class="td_right"><span class="td_datetime"><?php echo $row['ct_wdate']?></span></td>
<td class="td_right"><span class="td_datetime"><?php echo $row['ct_validdate']?></span></td>
<td class="td_right"><span class="td_datetime"><?php echo $row['ct_days']?></span></td>
<td class="td_right"><?php echo !$past_day?'0':$past_day?> day</td>
<td class="td_right"><?php echo number_format2($row['ct_buy_price'])?></td>
<td class="td_right"><?php echo number_format2($row['ct_sell_price'])?></td>
<td class="td_right"><?php echo $row['ct_interest']?>%</td>
<td class="td_right"><?php echo $g5['cn_cartstat'][$row['is_trade']]?></td>
<td class="td_right"><?php echo $row['trade_cnt']?>/<?php echo $row['div_cnt']?></td>
</tr>
<?php
	$list_num++;
    }
    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
</tbody>
</table>

</div>



<?

$sql_common = " from {$g5['cn_item_cart']} a ";
$sql_search = " where a.is_soled='1' and mb_id='$mb_id' and soled_date >= '$search_date' ";

$sql_order = " order by a.code desc ";

$sql = " select a.* {$sql_common} {$sql_search} {$sql_order}";
$result = sql_query($sql,1);

$total_count=sql_num_rows($result);
$colspan = 15;
?>

<h2 class="h2_frm">최근 1개월 매도상품</h2>
<div class="tbl_head01 tbl_wrap">
<table>

<thead>
<tr>
<th rowspan="2" scope="col">번호</a></th>
<th rowspan="2" scope="col">코드</th>
<th rowspan="2" scope="col">소유아이디</th>
<th rowspan="2" scope="col">상품</a></th>
<th rowspan="2" scope="col">판매/지급</th>
<!--th scope="col">입금계좌</th-->
<th rowspan="2" scope="col">현재단계</th>
<th colspan="4" scope="col">스케쥴</th>
<th colspan="3" scope="col">가격</th>
<th rowspan="2" scope="col">상태</th>
<th rowspan="2" scope="col">분할<br>
판매</th>
</tr>
<tr>
<th scope="col">구매일</th>
<th scope="col">보유마감</th>
<th scope="col">기본보유일</th>
<th scope="col">경과일</th>
<th scope="col">구매가격</th>
<th scope="col">예정가격</th>
<th scope="col">이율</th>
</tr>
</thead>
<tbody>
<?php
	$list_num = 1 ;
	
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
		
		
		$past_day=ceil( (strtotime($row['ct_validdate'])-time() ) /86400 );
		
    ?>
<tr class="<?php echo $bg; ?>">
<td  class="td_num"><?=$list_num?></td>
<td ><?php echo $row['code'] ?></td>
<td ><?php echo $row['smb_id']?$row['smb_id'].' @ ':'' ?><?php echo $row['mb_id'] ?></td>
<td ><?php echo $g5['cn_item'][$row['cn_item']][name_kr] ?></td>
<td class="td_datetime"><?php echo $row['fsmb_id']&& $row['fsmb_id']!=$row['fmb_id']?$row['fsmb_id'].' @ ':'' ?> <?php echo $row['fmb_id']?></td>
<td class="td_datetime"><?php echo $row['ct_class']?></td>
<td class="td_right"><span class="td_datetime"><?php echo $row['ct_wdate']?></span></td>
<td class="td_right"><span class="td_datetime"><?php echo $row['ct_validdate']?></span></td>
<td class="td_right"><span class="td_datetime"><?php echo $row['ct_days']?></span></td>
<td class="td_right"><?php echo !$past_day?'0':$past_day?> day</td>
<td class="td_right"><?php echo number_format2($row['ct_buy_price'])?></td>
<td class="td_right"><?php echo number_format2($row['ct_sell_price'])?></td>
<td class="td_right"><?php echo $row['ct_interest']?>%</td>
<td class="td_right"><?php echo $g5['cn_cartstat'][$row['is_trade']]?></td>
<td class="td_right"><?php echo $row['trade_cnt']?>/<?php echo $row['div_cnt']?></td>
</tr>
<?php
	$list_num++;
    }
    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
</tbody>
</table>

</div>

<?

$sql_common = " from {$g5['cn_item_trade']} as a 
left outer join  {$g5['cn_item_cart']} as c on(a.cart_code=c.code) 
left outer join  {$g5['member_table']} as b on(a.mb_id=b.mb_id) 
";
$sql_search = " where a.mb_id='$mb_id' and a.tr_rdate >= '$search_date' ";

$sql_order = " order by a.tr_code  desc";

$sql = " select a.*,
c.ct_class, c.ct_wdate,c.ct_validdate,c.ct_buy_price,c.ct_sell_price,c.ct_class,c.ct_interest,c.ct_days,
b.mb_id,b.mb_email,b.mb_name,b.mb_trade_get_claim,b.mb_trade_put_claim,b.mb_trade_penalty,b.mb_trade_penalty_date 
{$sql_common} {$sql_search} {$sql_order} ";
$result = sql_query($sql,1);

$total_count=sql_num_rows($result);
?>
<h2 class="h2_frm">최근 1개월 매도 거래</h2>
<div class="tbl_head01 tbl_wrap">
<table>
<thead>
<tr>
<th rowspan="2" scope="col">번호</a></th>
<th rowspan="2" scope="col">구매자/판매자</th>
<th rowspan="2" scope="col"><?=$g5[cn_item_name]?>
</a></th>
<th colspan="7" scope="col">매도
<?=$g5['cn_item_name']?></th>
<th colspan="2" scope="col">거래정보</th>
<th rowspan="2" scope="col">결재방법</a></th>
<!--th scope="col">입금계좌</th-->
<th rowspan="2" scope="col">입금완료<br>
최송변경</th>
<th rowspan="2" scope="col">거래구분</th>
<th colspan="3" scope="col">신고정보</th>
<th rowspan="2" scope="col">생성일</th>
<th rowspan="2" scope="col">상태</a></th>
</tr>
<tr>
<th scope="col">Class</th>
<th scope="col">액면가</th>
<th scope="col">판매가</th>
<th scope="col">이율</th>
<th scope="col">구매일</th>
<th scope="col">보유마감</th>
<th scope="col">기본보유일</th>
<th scope="col">액면가</th>
<th scope="col">실구매가</th>
<th scope="col">구매자</th>
<th scope="col">판매자</th>
<th scope="col">패널티</th>
</tr>
</thead>
<tbody>
<?php
	$list_num = 1;
	
    for ($i=0; $row=sql_fetch_array($result); $i++) {
		
        $one_update = '<a href="./item_trade_form.php?w=u&amp;tr_no='.$row['tr_no'].'&amp;'.$qstr.'" class="btn btn_03">상세</a>';

        $bg = 'bg'.($i%2);
		
    ?>
<tr class="<?php echo $bg; ?>">
<td rowspan="2"  class="td_num"><?=$list_num?></td>
<td ><?php echo $row['smb_id'] ?> @<?php echo $row['mb_id'] ?><br>
<!--p><?=$row[mb_trade_put_claim]?'보낸신고:'.$row[mb_trade_put_claim]:''?> <?=$row[mb_trade_get_claim]?'받은신고:'.$row[mb_trade_get_claim]:''?> <?=$row[mb_trade_penalty]?'패널티중'. $row[mb_trade_penalty_date]:''?></p--></td>
<td ><?php echo $g5['cn_item'][$row['cn_item']][name_kr] ?><br></td>
<td class="td_right"><?php echo $row['ct_class']?$row['ct_class']:'-'?></td>
<td class="td_right"><?php echo $row['ct_buy_price']?number_format2($row['ct_buy_price']):'-'?></td>
<td class="td_right"><?php echo $row['ct_sell_price']?number_format2($row['ct_sell_price']):'-'?></td>
<td class="td_right"><?php echo $row['ct_interest']?></td>
<td class="td_right"><span class="td_datetime"><?php echo str_replace(" ","<br>",$row['ct_wdate'])?></span></td>
<td class="td_right"><span class="td_datetime"><?php echo $row['ct_validdate']?></span></td>
<td class="td_right"><span class="td_datetime"><?php echo $row['ct_days']?><br>
<?php echo !$past_day?'0':$past_day?>day</span></td>
<td class="td_right"><?php echo number_format2($row['tr_price_org'])?></td>
<td class="td_right"><?php echo number_format2($row['tr_price'])?></td>
<td ><?=$g5['cn_paytype'][$row['tr_paytype']]?></td>
<!--td  class="td_num_c3"><?php echo $row['account'] ?></td-->
<td class="td_datetime"><?php echo !preg_match("/^00/",$row['tr_paydate'])?$row['tr_paydate']:'-'?><br>
<?php echo !preg_match("/^00/",$row['tr_setdate'])?$row['tr_setdate']:'-'?></td>
<td class="td_num"><?php echo strtoupper($row['tr_distri'])?></td>
<td class='fred'><?php echo $row['tr_buyer_claim']? str_replace(" ","<br>",$row['tr_buyer_note']):'-'?></td>
<td class='fred'><?php echo $row['tr_seller_claim']? str_replace(" ","<br>",$row['tr_seller_note']):'-'?></td>
<td class='fred'><?php echo $row['tr_penalty']? str_replace(" ","<br>",$row['tr_penalty_date']):'-'?></td>
<td class="td_date2"><?php echo str_replace(" ","<br>", $row['tr_rdate'])?></td>
<td class="td_num_c3"><label for="deposit_status<?php echo $i; ?>" class="sound_only">상태</label>
<?=$g5['tr_stat'][$row['tr_stats']]?>
</td>
</tr>
<tr class="<?php echo $bg; ?>">
<td ><?php echo $row['fsmb_id'] ?> @<?php echo $row['fmb_id'] ?></td>
<td colspan="18" class='td_left'  > 거래번호: <?php echo $row['tr_code'] ?> /
판매
<?=$g5[cn_item_name]?>
: <a href='./item_cart_list.php?code_stx=<?=$row[cart_code]?>' target='_blank'>
<?=$row[cart_code]?>
</a>
<?=$row[to_cart_code]?' &gt; 지급'.$g5[cn_item_name].": <a href='./item_cart_list.php?code_stx={$row[to_cart_code]}' target='_blank'>". $row[to_cart_code]."</a>":''?>
<?
echo " / 구매수수료:<span class='fblue'>".$row[tr_fee]."</span>";
echo " / 판매수수료:<span class='fblue'>".$row[tr_seller_fee]."</span>";
?>
<?
if($row[tr_buyer_memo]) echo "<br/>구매자 신고:<span class='fred'>".$row[tr_buyer_memo]."</span>";
if($row[tr_seller_memo]) echo "<br/>판매자 신고:<span class='fred'>".$row[tr_seller_memo]."</span>";
?></td>
</tr>
<?php
	$list_num++;
    }
    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
</tbody>
</table>
</div>

<?

$sql_common = " from {$g5['cn_item_trade']} as a 
left outer join  {$g5['cn_item_cart']} as c on(a.cart_code=c.code) 
left outer join  {$g5['member_table']} as b on(a.mb_id=b.mb_id) 
";
$sql_search = " where a.fmb_id='$mb_id' and a.tr_rdate >= '$search_date' ";

$sql_order = " order by a.tr_code  desc";

$sql = " select a.*,
c.ct_class, c.ct_wdate,c.ct_validdate,c.ct_buy_price,c.ct_sell_price,c.ct_class,c.ct_interest,c.ct_days,
b.mb_id,b.mb_email,b.mb_name,b.mb_trade_get_claim,b.mb_trade_put_claim,b.mb_trade_penalty,b.mb_trade_penalty_date 
{$sql_common} {$sql_search} {$sql_order} ";
$result = sql_query($sql,1);

$total_count=sql_num_rows($result);
?>
<h2 class="h2_frm">최근 1개월 매수 거래</h2>
<div class="tbl_head01 tbl_wrap">
<table>
<thead>
<tr>
<th rowspan="2" scope="col">번호</a></th>
<th rowspan="2" scope="col">구매자/판매자</th>
<th rowspan="2" scope="col"><?=$g5[cn_item_name]?>
</a></th>
<th colspan="7" scope="col">매도
<?=$g5['cn_item_name']?></th>
<th colspan="2" scope="col">거래정보</th>
<th rowspan="2" scope="col">결재방법</a></th>
<!--th scope="col">입금계좌</th-->
<th rowspan="2" scope="col">입금완료<br>
최송변경</th>
<th rowspan="2" scope="col">거래구분</th>
<th colspan="3" scope="col">신고정보</th>
<th rowspan="2" scope="col">생성일</th>
<th rowspan="2" scope="col">상태</a></th>
</tr>
<tr>
<th scope="col">Class</th>
<th scope="col">액면가</th>
<th scope="col">판매가</th>
<th scope="col">이율</th>
<th scope="col">구매일</th>
<th scope="col">보유마감</th>
<th scope="col">기본보유일</th>
<th scope="col">액면가</th>
<th scope="col">실구매가</th>
<th scope="col">구매자</th>
<th scope="col">판매자</th>
<th scope="col">패널티</th>
</tr>
</thead>
<tbody>
<?php
	$list_num = 1 ;
	
    for ($i=0; $row=sql_fetch_array($result); $i++) {
		
        $one_update = '<a href="./item_trade_form.php?w=u&amp;tr_no='.$row['tr_no'].'&amp;'.$qstr.'" class="btn btn_03">상세</a>';

        $bg = 'bg'.($i%2);
		
    ?>
<tr class="<?php echo $bg; ?>">
<td rowspan="2"  class="td_num"><?=$list_num?></td>
<td ><?php echo $row['smb_id'] ?> @<?php echo $row['mb_id'] ?><br>
<!--p><?=$row[mb_trade_put_claim]?'보낸신고:'.$row[mb_trade_put_claim]:''?> <?=$row[mb_trade_get_claim]?'받은신고:'.$row[mb_trade_get_claim]:''?> <?=$row[mb_trade_penalty]?'패널티중'. $row[mb_trade_penalty_date]:''?></p--></td>
<td ><?php echo $g5['cn_item'][$row['cn_item']][name_kr] ?><br></td>
<td class="td_right"><?php echo $row['ct_class']?$row['ct_class']:'-'?></td>
<td class="td_right"><?php echo $row['ct_buy_price']?number_format2($row['ct_buy_price']):'-'?></td>
<td class="td_right"><?php echo $row['ct_sell_price']?number_format2($row['ct_sell_price']):'-'?></td>
<td class="td_right"><?php echo $row['ct_interest']?></td>
<td class="td_right"><span class="td_datetime"><?php echo str_replace(" ","<br>",$row['ct_wdate'])?></span></td>
<td class="td_right"><span class="td_datetime"><?php echo $row['ct_validdate']?></span></td>
<td class="td_right"><span class="td_datetime"><?php echo $row['ct_days']?><br>
<?php echo !$past_day?'0':$past_day?>day</span></td>
<td class="td_right"><?php echo number_format2($row['tr_price_org'])?></td>
<td class="td_right"><?php echo number_format2($row['tr_price'])?></td>
<td ><?=$g5['cn_paytype'][$row['tr_paytype']]?></td>
<!--td  class="td_num_c3"><?php echo $row['account'] ?></td-->
<td class="td_datetime"><?php echo !preg_match("/^00/",$row['tr_paydate'])?$row['tr_paydate']:'-'?><br>
<?php echo !preg_match("/^00/",$row['tr_setdate'])?$row['tr_setdate']:'-'?></td>
<td class="td_num"><?php echo strtoupper($row['tr_distri'])?></td>
<td class='fred'><?php echo $row['tr_buyer_claim']? str_replace(" ","<br>",$row['tr_buyer_note']):'-'?></td>
<td class='fred'><?php echo $row['tr_seller_claim']? str_replace(" ","<br>",$row['tr_seller_note']):'-'?></td>
<td class='fred'><?php echo $row['tr_penalty']? str_replace(" ","<br>",$row['tr_penalty_date']):'-'?></td>
<td class="td_date2"><?php echo str_replace(" ","<br>", $row['tr_rdate'])?></td>
<td class="td_num_c3"><label for="deposit_status<?php echo $i; ?>" class="sound_only">상태</label>
<?=$g5['tr_stat'][$row['tr_stats']]?>
</td>
</tr>
<tr class="<?php echo $bg; ?>">
<td ><?php echo $row['fsmb_id'] ?> @<?php echo $row['fmb_id'] ?></td>
<td colspan="18" class='td_left'  > 거래번호: <?php echo $row['tr_code'] ?> /
판매
<?=$g5[cn_item_name]?>
: <a href='./item_cart_list.php?code_stx=<?=$row[cart_code]?>' target='_blank'>
<?=$row[cart_code]?>
</a>
<?=$row[to_cart_code]?' &gt; 지급'.$g5[cn_item_name].": <a href='./item_cart_list.php?code_stx={$row[to_cart_code]}' target='_blank'>". $row[to_cart_code]."</a>":''?>
<?
echo " / 구매수수료:<span class='fblue'>".$row[tr_fee]."</span>";
echo " / 판매수수료:<span class='fblue'>".$row[tr_seller_fee]."</span>";
?>
<?
if($row[tr_buyer_memo]) echo "<br/>구매자 신고:<span class='fred'>".$row[tr_buyer_memo]."</span>";
if($row[tr_seller_memo]) echo "<br/>판매자 신고:<span class='fred'>".$row[tr_seller_memo]."</span>";
?></td>
</tr>
<?php
	$list_num++;
    }
    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
</tbody>
</table>
</div>
<?php

}else{
	
	echo "<center>회원을 찾을수 없습니다</center>";


}



include "./member_search_modal.php";
?>
<script>  
var reg_mb_exist_check = function() {
    var result = "";
    $.ajax({
        type: "POST",
        url: g5_bbs_url+"/ajax.mb_exist.php",
        data: {
            "reg_mb_exist": encodeURIComponent($("#reg_mb_exist").val())
        },
        cache: false,
        async: false,
        success: function(data) {
            result = data;
        }
    });
    return result;
}

function member_select(tg,datas){
	var ov=$('#'+tg).val();
	//$('#'+tg).val(ov+(ov?',':'')+datas.mb_id);
	$('#'+tg).val(datas.mb_id);
	
	$('#member_search').hide();
}

$(document).ready(function(e) {
    $('#openMSearchBtn').click(function(){
	
		$('#myModalLabel').html('회원 검색')
		$("input[name='mb_id']").val('');
		
		search_member_open('mb_id');
	});

});

</script>
<?
include_once(G5_ADMIN_PATH.'/admin.tail.pop.php');

?>
