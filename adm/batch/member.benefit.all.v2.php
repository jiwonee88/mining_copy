<?php
include_once('./_common.php');


//회원 포인트 배치
if($is_admin!='super') die('권한 없음');


header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = total.xls" );   
header( "Content-Description: PHP4 Generated Data" );   


//이름 / 아이디 / 회원가입일 /연락처 / 현재 총 보유금액 / 이때까지 총 구매금액 /이때까지 총 판매금액 / 총 수익금 / 은행 / 계좌명 / 계좌번호

echo '<table border=1>

<tr>
<th scope="col">이름</th>
<th scope="col">아이디</th>
<th scope="col">연락처</th>
<th scope="col" >현재 총 보유금액</th>
<th scope="col">이때까지 총 판매금액</th>
<th scope="col">총 수익</th>
<th scope="col">은행</th>
<th scope="col">계좌명</th>
<th scope="col">계좌번호</th>
</tr>
';

$re=sql_query("select * from $g5[member_table]");

while($mb=sql_fetch_array($re)){

//구매 내역
//$buy=sql_fetch("select sum(ct_sell_price) ct_sell_price from coin_item_trade where tr_stats='3' and mb_id='$mb[mb_id]' " ,1);

//판매 내역
$re2=sql_query("select cn_item,sum(ct_buy_price) ct_buy_price,sum(ct_sell_price) ct_sell_price, sum(ct_sell_price - ct_buy_price) amt from coin_item_trade where tr_stats='3' and fmb_id='$mb[mb_id]' group by cn_item " ,1);

$amt=0;
$ct_sell_price=0;
while($sell=sql_fetch_array($re2)){
	if($sell[cn_item]=='a') $r=1.12;
	else if($sell[cn_item]=='b') $r=1.15;
	else if($sell[cn_item]=='c') $r=1.18;
	else if($sell[cn_item]=='d') $r=1.21;
	
	
	$amt+=($sell['ct_sell_price']-$sell['ct_sell_price'] / $r);
	
	//echo "$amt+={$sell['ct_sell_price']} - {$sell['ct_sell_price']} / $r <br>";
	
	$ct_sell_price+=$sell['ct_sell_price'];
}

//if( $sell['ct_sell_price']==0) continue;
//보유 금액
$isum=get_itemsum($mb[mb_id]);

?>
 
<tr >

 <td ><?=$mb[mb_name]?></td>
<td  ><?=$mb[mb_id]?></td>
<td  ><?=$mb[mb_hp]?></td>
<th ><?= $isum[tot]['price']?></th>
<td ><? echo number_format2($ct_sell_price,1) ?></td>
<td  ><?php echo number_format2($amt,1) ?></td>
<td ><?=$mb[mb_bank]?></td>
<td ><?=$mb[mb_bank_user]?></td>
<td ><?=$mb[mb_bank_num]?></td>
</tr>

<? 
//$tot_amt+=$ds['amt'];
//$tot_cnt+=$ds['cnt'];
}?>

</table>