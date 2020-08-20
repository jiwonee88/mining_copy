<?php
include_once('./_common.php');

exit;
//회원 포인트 배치
if($is_admin!='super') die('권한 없음');


/*
header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = total.xls" );   
header( "Content-Description: PHP4 Generated Data" );   
*/

//가격 입력
  
 $re=sql_query("select * from coin_item_trade where tr_stats='3' "  ,1);
 while($d=sql_fetch_array($re)){
	 $cdata=sql_fetch("select * from coin_item_cart_backup where code='$d[cart_code]' "  ,1);
	 
	 $sql="update  coin_item_trade set ct_buy_price='{$cdata['ct_buy_price']}',ct_sell_price='{$cdata['ct_sell_price']}' where tr_code='{$d['tr_code']}'";
	 
	 if(!$cdata) echo  "<span style='color:red;'>".$sql."</span><br>";
	 else echo $sql."<br>";
	 sql_query($sql);
	 
	 

}
