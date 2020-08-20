<?php
include_once('./_common.php');


//회원 포인트 배치
if($is_admin!='super') die('권한 없음');


header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = total.xls" );   
header( "Content-Description: PHP4 Generated Data" );   



echo '<table border=1>

<tr>
<th scope="col">아이디</th>
<th scope="col">수익</th>
<th scope="col" >건수</th>
<th scope="col" >보유금액</th>
</tr>
';




$union_all='';
$re=sql_query("SELECT *  FROM information_schema.tables WHERE TABLE_NAME like '{$g5['cn_item_cart']}%' and TABLE_SCHEMA='".G5_MYSQL_DB."' ");
while($d=sql_fetch_array($re)){
	if($d['TABLE_NAME']!=$g5['cn_item_cart'] &&  !preg_match("/".$g5['cn_item_cart']."_[0-9]{4}/",$d['TABLE_NAME'])) continue;
	
	$union_all.=($union_all ? " union all ":"")." select mb_id, sum(ct_sell_price - ct_buy_price) amt,count(code) cnt  from {$d['TABLE_NAME']} as a where is_soled='1' group by mb_id ";
}


//echo "select mb_id ,sum(amt) amt,sum(cnt) cnt from ($union_all) as A group by mb_id";
$result=sql_query_ext("select mb_id ,sum(amt) amt,sum(cnt) cnt from ($union_all) as A group by mb_id",1);

$tot_amt=$tot_cnt=0;
$cnt=0;
while($ds=sql_fetch_array($result)) {
$cnt++;

//보유 금액
$isum=get_itemsum($ds[mb_id]);

 ?>
<tr >
<td  ><?=$ds[mb_id]?></td>
<td  ><?php echo number_format2($ds['amt']) ?></td>
<td  ><?=number_format2($ds['cnt'])?>
<th scope="col" ><?= $isum[tot][price]?></th>
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

</table>