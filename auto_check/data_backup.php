<?php
/* 지난데이터 백업 */
$exe_path=dirname(__FILE__);
include $exe_path."/../common.php";

//이전 기준일
$movedate=date("Y-m-d",strtotime("-10 days"));

/************************************************************************************
//거래테이블 백업
************************************************************************************/

$re=sql_query("SELECT tr_wdate,date_format(tr_wdate,'%y%m') dates FROM {$g5['cn_item_trade']} where tr_wdate <= '$movedate'  and tr_stats in ('3','9') group by date_format(tr_wdate,'%y%m') ");

while($data=sql_fetch_array($re)){
	
	//if(preg_match('/^0000|197/',$data[tr_wdate])) continue;
	
	$date_search=date("ym",strtotime($data[tr_wdate]));
	$trade_table=$g5['cn_item_trade']."_".$date_search; 

	//echo $trade_table;
	//이달 테이블 검사후 갱신
	$table_chk=chk_table($trade_table);

	if(!$table_chk){
		$sql="CREATE TABLE $trade_table SELECT * FROM {$g5['cn_item_trade']} where tr_wdate <= '$movedate'  and tr_stats in ('3','9')  and  date_format(tr_wdate,'%y%m') = '$data[dates]' ";
	}else{
		$sql="insert into  $trade_table SELECT * FROM {$g5['cn_item_trade']} where tr_wdate <= '$movedate'  and tr_stats in ('3','9')  and  date_format(tr_wdate,'%y%m') = '$data[dates]'";		
	}
	
	//echo $sql."<br>";
	$result=sql_query($sql,1);
		
	if(!$result) die('거래 테이블 생성 & 데이터 복사 불가');	
	
	//데이터 삭제
	sql_query("delete FROM {$g5['cn_item_trade']} where tr_wdate <= '$movedate'  and tr_stats in ('3','9')   and  date_format(tr_wdate,'%y%m') = '$data[dates]' ");
}

/************************************************************************************
//판매된 상품 백업
************************************************************************************/

//이달 테이블 검사후 갱신
$table_chk=chk_table($trade_table);

$re=sql_query("SELECT soled_date, date_format(soled_date,'%y%m') dates FROM {$g5['cn_item_cart']} where soled_date <= '$movedate'  and is_soled='1' group by date_format(soled_date,'%y%m') ",1);

while($data=sql_fetch_array($re)){
	
	//if(preg_match('/^0000|197/',$data[soled_date])) continue;
	
	$date_search=date("ym",strtotime($data[soled_date]));
	$cart_table=$g5['cn_item_cart']."_".$date_search; 
	
	//echo $cart_table;
	
	
	//이달 테이블 검사후 갱신
	$table_chk=chk_table($cart_table);

	if(!$table_chk){
		$sql="CREATE TABLE $cart_table SELECT * FROM {$g5['cn_item_cart']} where soled_date <= '$movedate'   and is_soled='1' and  date_format(soled_date,'%y%m') = '$data[dates]' ";
	}else{
		$sql="insert into  $cart_table SELECT * FROM {$g5['cn_item_cart']} where soled_date <= '$movedate'  and is_soled='1' and date_format(soled_date,'%y%m') = '$data[dates]'";		
	}	
	//echo $sql."<br>";
	$result=sql_query($sql,1);
		
	if(!$result) die('거래 테이블 생성 & 데이터 복사 불가');	
	
	//데이터 삭제
	sql_query("delete FROM {$g5['cn_item_cart']} where soled_date <= '$movedate'  and is_soled='1' and  date_format(soled_date,'%y%m') = '$data[dates]' ");
}

