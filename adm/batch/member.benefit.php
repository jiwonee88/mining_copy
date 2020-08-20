<?php
include_once('./_common.php');


//회원 포인트 배치
if($is_admin!='super') die('권한 없음');

$arr=explode(",","Kyj63,Kyj64,Kyj65,Kyj66,Kyj67,Kyj68,Kyj69,Oyt1,Oyt2,Kck1,Kck2,Lbj8000,hh2222,Hh1425,Pss9175,Kso3362,Kjhkjh,You5134,Aq8400,Jkh9994,Jkh9999,Jkh8888,Jkh7557");

header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = total.xls" );   
header( "Content-Description: PHP4 Generated Data" );   



echo '<table border=1>

<tr>
<th scope="col">아이디</th>
<th scope="col">월</th>
<th scope="col">수익</th>
<th scope="col" >건수</th>
<th scope="col" >보유금액</th>
</tr>
';
foreach($arr as $mb_id){

//보유 금액
$isum=get_itemsum($mb_id);

$union_all='';
$re=sql_query("SELECT *  FROM information_schema.tables WHERE TABLE_NAME like '{$g5['cn_item_cart']}%' and TABLE_SCHEMA='".G5_MYSQL_DB."' ");
while($d=sql_fetch_array($re)){
	if($d['TABLE_NAME']!=$g5['cn_item_cart'] &&  !preg_match("/".$g5['cn_item_cart']."_[0-9]{4}/",$d['TABLE_NAME'])) continue;
	
	$union_all.=($union_all ? " union all ":"")." select date_format(soled_date,'%Y-%m') dates, sum(ct_sell_price - ct_buy_price) amt,count(code) cnt  from {$d['TABLE_NAME']} where mb_id='$mb_id' and is_soled='1' group by date_format(soled_date,'%Y-%m')";
}

$result=sql_query_ext("select dates ,sum(amt) amt,sum(cnt) cnt from ($union_all) as A group by dates",1);

$tot_amt=$tot_cnt=0;
$cnt=0;
while($ds=sql_fetch_array($result)) {
$cnt++;
 ?>
<tr >
<td  ><?=$mb_id?></td>
<td  ><?php echo $ds['dates'] ?></td>
<td  ><?php echo number_format2($ds['amt']) ?></td>
<td  ><?=number_format2($ds['cnt'])?>
<th scope="col" ><?= $cnt==1?$isum[tot][price]:''?></th>
</td>

</tr>

<? 
$tot_amt+=$ds['amt'];
$tot_cnt+=$ds['cnt'];
}?>
<!--tr >
<td  ></td>
<td  >총</td>
<td  ><strong><?php echo number_format2($tot_amt) ?></strong></td>
<td  ><strong>
<?=number_format2($tot_cnt)?>
</strong></td>
</tr-->


<?
}

?>
</table>