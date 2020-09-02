<?php
include_once('./_common.php');
require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';

if($w=='u'){

	//전체회원 초기화 
	$query = "update g5_member set mb_trade_amtlmt = '0' '";
	sql_query($query);

	$path = "./excel/";
	$old_file = $_FILES['excel_origin']['tmp_name'];
	$new_file = $path.strtotime(date("Y-m-d H:i:s")).$_FILES['excel_origin']['name'];
	@move_uploaded_file($old_file, $new_file);
	$callStartTime = microtime(true);

	$inputFileName = $new_file;


	try {
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
	} catch (Exception $e) {
		die('Error loading file "'.pathinfo($inputFileName, PATHINFO_BASENAME).'": '.$e->getMessage());
	}

	$sheet = $objPHPExcel->getSheet(0);
	$highestRow = $sheet->getHighestRow();
	$highestColumn = $sheet->getHighestColumn();

	for ($row = 2; $row <= $highestRow; $row++) {
		$rowData = $sheet->rangeToArray(
			'A' . $row . ':' . $highestColumn . $row,
			null,
			true,
			false
		);
		$user_id = $rowData[0][0];
		$price_pure = $rowData[0][1];
		$price = preg_replace("/[^0-9]*/s", "", $price_pure);
		if ($user_id) {
		   $query = "update g5_member set mb_trade_amtlmt = {$price} where mb_12 = '{$user_id}'";
			sql_query($query);
		}
	}

	unlink($new_file);

	alert("파일처리가 완료되었습니다.","member_excel_config_form.php");
}
