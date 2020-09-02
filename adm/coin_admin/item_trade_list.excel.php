<?php
$sub_menu = "700755";
include_once('./_common.php');

//ini_set("display_errors", 1);

//error_reporting(E_ALL);

auth_check($auth[$sub_menu], 'r');


$sql_common = " 
from {$g5['member_table']} as a
left outer join {$g5['cn_item_trade']} as t on(a.mb_id=t.mb_id) 
";
$sql_search = "where  t.tr_code is not null  group by a.mb_id  ";



if($date_start_stx) {
	$sql_search .= " and t.$date_stx >= '$date_start_stx 00:00:00' ";
	$qstr.="&date_start_stx=$date_start_stx";
}
if($date_end_stx) {
	$sql_search .= " and t.$date_stx <= '$date_end_stx 23:59:59' ";
	$qstr.="&date_end_stx=$date_end_stx";
}
if($date_stx) {	
	$qstr.="&date_stx=$date_stx";
}
if($item_stx) {
	$sql_search .= " and t.cn_item = '$item_stx' ";
	$qstr.="&item_stx=$item_stx";
}
if($paytype_stx) {
	$sql_search .= " and t.tr_paytype = '$paytype_stx' ";
	$qstr.="&paytype_stx=$paytype_stx";
}
if($distri_stx) {
	$sql_search .= " and t.tr_distri = '$distri_stx' ";
	$qstr.="&distri_stx=$distri_stx";
}
if($stats_stx) {
	$sql_search .= " and t.tr_stats = '$stats_stx' ";
	$qstr.="&stats_stx=$stats_stx";
}
if($claim_stx=='all') {	
	$sql_search .= " and ( t.tr_buyer_claim = '1' or t.tr_seller_claim = '1' ) ";
	$qstr.="&claim_stx=$claim_stx";
}
if($claim_stx=='buyer') {	
	$sql_search .= " and t.tr_buyer_claim = '1' ";
	$qstr.="&claim_stx=$claim_stx";
}
if($claim_stx=='seller') {	
	$sql_search .= " and t.tr_seller_claim = '1' ";
	$qstr.="&claim_stx=$claim_stx";
}


//패널티 대상 검색
if($penalty_stx=='ready'){
	$ldate=date("Y-m-d",strtotime("-1 days"));
	$sql_search .= " and t.tr_penalty = 0 and tr_wdate <= '$ldate' and tr_stats in ('1','2')";
	$qstr.="&penalty_stx=$penalty_stx";
}

if ($stx) {
	
	if($sfl=='buy_recommend') $sql_search .= "and t.mb_id in (select mb_id from $g5[member_table] where mb_recommend='$stx' ) ";
	else if($sfl=='sell_recommend') $sql_search .= "and t.fmb_id in (select mb_id from $g5[member_table] where mb_recommend='$stx' ) ";
	else if($sfl=='t.mb_id') $sql_search .= "and ($sfl = '$stx') ";
    else $sql_search .= "and ($sfl like '%$stx%') ";
}
if ($mb_stx) {
    $sql_search .= " and b.mb_id='$mb_stx' ";	
	$qstr.="&mb_stx=$mb_stx";
}




$sql_order = " order by a.mb_12 asc ";

$sql = " select a.*,sum(t.ct_sell_price) usdt, count(t.tr_code) cnt,sum(t.tr_fee) tr_fee, sum(t.tr_fee_dept) tr_fee_dept  {$sql_common} {$sql_search} {$sql_order} ";

$result = sql_query($sql,1);

function column_char($i) { return chr( 65 + $i ); }

include_once(G5_LIB_PATH.'/PHPExcel.php');

$headers = array('UID','USDT','COUNT',"ID","구매수수료","구매수수료 부족분");
$widths  = array(50, 30, 25, 25, 25, 25);

$header_bgcolor = 'FFABCDEF';
$last_char = column_char(count($headers) - 1);

for ($i=0; $row=sql_fetch_array($result); $i++) {

   $rows[] = 
		array(
			$row['mb_12'],
			number_format2($row['usdt']),
			number_format2($row['cnt']),
			$row['mb_id'],
			$row['tr_fee'],
			$row['tr_fee_dept']
			
		 );

}

$data = array_merge(array($headers), $rows);

$excel = new PHPExcel();
$excel->setActiveSheetIndex(0)->getStyle( "A1:${last_char}1" )->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($header_bgcolor);
//$excel->setActiveSheetIndex(0)->getStyle( "A:$last_char" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
//$excel->setActiveSheetIndex(0)->getStyle( "B" )->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
foreach($widths as $i => $w) $excel->setActiveSheetIndex(0)->getColumnDimension( column_char($i) )->setWidth($w);
$excel->getActiveSheet()->fromArray($data,NULL,'A1');

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"MatchingResult-".date("ymd", time()).".xls\"");
header("Cache-Control: max-age=0");

$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$writer->save('php://output');


