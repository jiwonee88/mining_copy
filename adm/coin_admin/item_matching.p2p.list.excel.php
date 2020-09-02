<?php
$sub_menu = "700755";
include_once('./_common.php');

//ini_set("display_errors", 1);

//error_reporting(E_ALL);

auth_check($auth[$sub_menu], 'r');

$sql_common = " 
from {$g5['member_table']} as a
left outer join {$g5['cn_item_trade_test']} as t on(a.mb_id=t.mb_id) 
";
$sql_search = "where  t.tr_code is not null  group by a.mb_id  ";

$sql_order = " order by a.mb_12 asc ";

$sql = " select a.*,sum(t.ct_sell_price) usdt, count(t.tr_code) cnt  {$sql_common} {$sql_search} {$sql_order} ";

$result = sql_query($sql,1);

function column_char($i) { return chr( 65 + $i ); }

include_once(G5_LIB_PATH.'/PHPExcel.php');

$headers = array('UID','USDT','COUNT',"ID");
$widths  = array(50, 30, 25, 25);

$header_bgcolor = 'FFABCDEF';
$last_char = column_char(count($headers) - 1);

for ($i=0; $row=sql_fetch_array($result); $i++) {

   $rows[] = 
		array(
			$row['mb_12'],
			number_format2($row['usdt']),
			number_format2($row['cnt']),
			$row['mb_id']
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


