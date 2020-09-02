<?php
$sub_menu = "700750";
include_once( './_common.php' );

//error_reporting(E_ALL);
//ini_set("display_errors", 1);


auth_check( $auth[ $sub_menu ], 'w' );
//check_admin_token();

//print_r($_POST);

//exit;

//오늘 이외 매칭은 지우기
sql_query( "delete from {$g5['cn_item_trade_test']} where tr_wdate !='$start_date'" );

if ( $w == 's' )$limit = 20;
else $limit = 10;

if ( !$page )$page = 1;

$start = ( $page - 1 ) * $limit;
$limit_sql = "limit $start ,$limit";

//오늘 매칭 비우기
if ( $w == 'd' && $page == '1' )sql_query( "truncate table {$g5['cn_item_trade_test']} " );

$add_sql = '';
$lines = '';

//첫 상품 지급
if ( count( $item_exe ) == 0 )alert_json( false, "매칭 할 {$g5[cn_item_name]}이 없습니다" );


//설정금액 조건
for($i=1;$i<=4;$i++){
	${'amt_lmt_start'.$i}=only_number(${'amt_lmt_start'.$i});
	${'amt_lmt_end'.$i}=only_number(${'amt_lmt_end'.$i});
	${'amt_lmt_max'.$i}=only_number(${'amt_lmt_max'.$i});
		
	if(!${'amt_lmt_start'.$i}) ${'amt_lmt_start'.$i}=0;
	if(!${'amt_lmt_end'.$i}) ${'amt_lmt_end'.$i}=0;
	if(!${'amt_lmt_max'.$i}) ${'amt_lmt_max'.$i}=0;
}

//상품 가격대로 정열
$cn_item_arr = array();
$cn_item_order = array();
foreach ( $g5[ cn_item ] as $k => $v ) {

  $cn_item_order[ $k ] = $v[ price ];
  if ( $v[ price ] == 0 ) continue;
  $cn_item_arr[ $k ] = $v[ price ];
}
$cn_price_arr = array_values( $cn_item_arr );
$cn_min_price = min( $cn_price_arr );
$cn_max_price = max( $cn_price_arr );
arsort( $cn_item_arr );
arsort( $cn_item_order );

if ( !$cn_item_arr || $cn_min_price == 0 || $cn_max_price == 0 ) {
  if ( !$_result )alert_json( false, "상품 정보에 문제가 있습니다. 상품이 없거나 가격이 0인 상품이 있습니다" );
}

//로그인 시간 제한시
if ( $login_day_seller != '' && $login_day_seller > 0 ) {
  $logdate = date( "Y-m-d H:i:s", strtotime( "- $login_day_seller days" ) );
  $login_seller_sql = " and b.mb_today_login >= '$logdate' ";
} else $login_seller_sql = '';

//지정 상품이 있는 경우
$target_code = preg_replace( "/\n+/", ",", $target_code );
$target_code = preg_replace( "/\s+/", "", $target_code );
$target_code = preg_replace( "/,/", "','", $target_code );
if ( $target_code != '' )$target_code_search = " and a.code in ('$target_code') ";
else $target_code_search = '';


//지정 회원이 있는 경우 품이 있는 경우
$target_seller = preg_replace( "/\n+/", ",", $target_seller );
$target_seller = preg_replace( "/\s+/", "", $target_seller );
$target_seller = preg_replace( "/,/", "','", $target_seller );
if ( $target_seller != '' )$target_seller_search = " and a.mb_id in ('$target_seller') ";
else $target_seller_search = '';


//제외 회원이 있는 경우 품이 있는 경우
$except_seller = preg_replace( "/\n+/", ",", $except_seller );
$except_seller = preg_replace( "/\s+/", "", $except_seller );
$except_seller = preg_replace( "/,/", "','", $except_seller );
if ( $except_seller != '' )$except_seller_search = " and a.mb_id not in ('$except_seller') ";
else $except_seller_search = '';


//지정일자 미거리
if ( $miss_date_seller != '' ) {

  $target_cnt = count( explode( ",", $miss_date_seller ) );
  $miss_date_seller = preg_replace( "/\n+/", ",", $miss_date_seller );
  $miss_date_seller = preg_replace( "/\s+/", "", $miss_date_seller );
  $miss_date_seller = preg_replace( "/,/", "','", $miss_date_seller );
  if ( $miss_date_seller != '' )$miss_date_seller_search = " and tr_wdate in ('$miss_date_seller') ";
  else $miss_date_seller_search = '';

  $miss_date_seller_search = " and (select count(tr_code) from {$g5['cn_item_trade']}  where cart_code=a.code  $miss_date_seller_search and tr_stats in ('1','2','9') ) >= $target_cnt ";

} else $miss_date_seller_search = '';


//미거래 판매 회원		
if ( $miss_cnt_seller > 0 ) {
  $miss_date = date( "Y-m-d", strtotime( "-" . ( $miss_cnt_seller - 1 ) . " days" ) );
  $miss_seller_search = " and (select count(tr_code) from {$g5['cn_item_trade']}  where cart_code=a.code and tr_wdate >= '$miss_date' and tr_stats in ('1','2','9') ) >= $miss_cnt_seller ";

  //$miss_sql=",(select count(tr_code) from {$g5['cn_item_trade']}  where smb_id=a.ac_id and tr_wdate='$start_date') as miss_cnt";

} else $miss_seller_search = '';


//지정 구매회원이 있는 경우 품이 있는 경우
$target_buyer = preg_replace( "/\n+/", ",", $target_buyer );
$target_buyer = preg_replace( "/\s+/", "", $target_buyer );
$target_buyer = preg_replace( "/,/", "','", $target_buyer );
if ( $target_buyer != '' )$target_buyer_search = " and a.mb_id in ('$target_buyer') ";
else $target_buyer_search = '';


//제외 회원이 있는 경우 품이 있는 경우
$except_buyer = preg_replace( "/\n+/", ",", $except_buyer );
$except_buyer = preg_replace( "/\s+/", "", $except_buyer );
$except_buyer = preg_replace( "/,/", "','", $except_buyer );
if ( $except_buyer != '' )$except_buyer_search = " and a.mb_id  not in ('$except_buyer') ";
else $except_buyer_search = '';


//미거래 구매 회원		
if ( $miss_cnt > 0 ) {
  $miss_date = date( "Y-m-d", strtotime( "-" . ( $miss_cnt - 1 ) . " days" ) );
  $miss_search = " and (select count(tr_code) from {$g5['cn_item_trade']}  where cart_code=a.code and tr_wdate >= '$miss_date' and tr_stats in ('1','2','9') ) >= $miss_cnt ";

  //$miss_sql=",(select count(tr_code) from {$g5['cn_item_trade']}  where smb_id=a.ac_id and tr_wdate='$start_date') as miss_cnt";

} else $miss_search = '';


if ( $login_day != '' && $login_day > 0 ) {
  $logdate = date( "Y-m-d H:i:s", strtotime( "- $login_day days" ) );
  $login_sql = " and b.mb_today_login >= '$logdate' ";
} else $login_sql = '';

//회원구분 여부
if ( $is_vip == 'y' ) {
  $vip_search = " and a.tr_active='1' and b.mb_14='vip' ";
} else {
  $vip_search = " and ( b.mb_14!='vip') ";
}


if ( $page == 1 ) {

  if ( $w == 's' ) {
    $lines = "<p>================" . $g5[ 'cn_item_name' ] . " 매도 상품 검토 시작  ================<p>";

  } else {

    $lines = "<p>================" . $g5[ 'cn_item_name' ] . " 매칭 시작  ================<p>";

  }
}


//중복방지
if ( $w != 's' ) {

  //$add_sql.=" and not exists(select code from {$g5['cn_item_trade_test']} where cart_code=a.code) 	";
}


$tot_cnt = ( $page - 1 ) * $limit;

//$lines="<p>================$tot_cnt  ================<p>";		

/* 판매 대기중 상품 가격/결제 그룹 */
$sql = " select  a.*,b.*,c.ac_point_b,c.ac_point_e,c.ac_point_i,c.ac_point_u
from {$g5['cn_item_cart']} as a 
left outer join  {$g5['member_table']} as b on(a.mb_id=b.mb_id)  
left outer join  {$g5['cn_sub_account']} as c on(c.ac_id=a.mb_id)  
where a.cn_item in ('" . implode( "','", $item_exe ) . "') and a.is_soled != '1'  and a.is_trade != '1' and (a.ct_validdate <= '$start_date 23-59-59' or a.cn_item='e')
and b.mb_trade_penalty <= 1 $vip_search $login_seller_sql  $target_code_search $target_seller_search  $except_seller_search $miss_seller_search $miss_date_seller_search $add_sql order by  field(a.cn_item,'" . implode( "','", array_keys( $cn_item_order ) ) . "') asc,  ct_sell_price desc $limit_sql ";
$re = sql_query( $sql, 1 );

//$lines.=$sql;

//종료
if ( sql_num_rows( $re ) == 0 ) {


  //금일 총 기간 만료 수량
  $temp1 = sql_fetch( "select count(*) cnt from {$g5['cn_item_cart']} as a left outer join  {$g5['member_table']} as b on(a.mb_id=b.mb_id)   where  a.cn_item in ('" . implode( "','", $item_exe ) . "') and a.is_soled != '1'  and a.is_trade != '1' and (a.ct_validdate <= '$start_date 23-59-59' or a.cn_item='e')  $vip_search $tot_search ", 1 );

  if ( $w == 's' ) {
    $lines .= "<br ><br >" . $g5[ 'cn_item_name' ] . " 매도 상품 검토 종료 => 총 매도 대상 : " . number_format2( $temp1[ cnt ] ) . "건  ";

  } else {

    //금일 총 매칭 결과	
    $temp2 = sql_fetch( "select count(*) cnt,sum(ct_sell_price) ct_sell_price,sum(tr_fee) tr_fee,sum(tr_seller_fee) tr_seller_fee from {$g5['cn_item_trade_test']} as a where  a.cn_item in ('" . implode( "','", $item_exe ) . "') " );

    $lines .= "<br ><br >" . " $start_date {$g5['cn_item_name']}  매칭 종합 => 총 매도 대상 : " . number_format2( $temp1[ cnt ] ) . "건 / 담겨진 총 매칭 거래 수량 : " . number_format2( $temp2[ cnt ] ) . "개 / 총금액 : " . number_format2( $temp2[ ct_sell_price ] ) . " / 총 매수 수수료 : " . number_format2( $temp2[ tr_fee ] ) . " / 총 매도 수수료 : " . number_format2( $temp[ tr_seller_fee ] );

  }

  $lines .= "<p>============================================= 종료 ==================================================</p>";
  alert_json( true, '', array( 'htmls' => $lines, 'page' => $page + 1, 'total' => $tot_cnt, 'next' => 'n' ) );
}

$skip_seller_cnt = 0;
$skip_buyer_cnt = 0;

while ( $sdata = sql_fetch_array( $re ) ) {

  $_sdata = $sdata;

  $multidata = array();

  //오늘 매도액 
  $_traded_amt = 0;

  //지금까지 누적 발행액
  $_traded_amt_sum = $sdata[ trade_amt ];

  //일반 최고다 도달 상품 가격쪼개기	
  if ( $sdata[ ct_sell_price ] > $g5[ 'cn_item' ][ $sdata[ cn_item ] ][ mxprice ] ) {

    $_sdata[ item_price ] = floor( $sdata[ ct_sell_price ] / 3 * 10 ) / 10;
    for ( $x = 3 - $sdata[ trade_cnt ]; $x > 0; $x-- ) {
      $multidata[] = $_sdata;
      $_traded_amt += $_sdata[ item_price ];
    }

    $div_cnt = 3;
    $is_traded = $sdata[ trade_cnt ];
    $is_traded_amt = $sdata[ trade_amt ] + $_traded_amt;

    //단일 상품
  } else {

    $_sdata[ item_price ] = $sdata[ ct_sell_price ];
    $multidata[ 0 ] = $_sdata;
    $div_cnt = 1;
    $is_traded = 0;
    $is_traded_amt = $sdata[ trade_amt ] + $sdata[ sell_price_sum ] + $_traded_amt;
  }

  //입금 계좌 정보 없으면 스킵	
  if ( $sdata[ 'mb_bank' ] == '' || $sdata[ 'mb_bank_num' ] == '' || $sdata[ 'mb_bank_user' ] == '' ) {
    $lines .= "<p class='fred'>" . ( $tot_cnt + 1 ) . ".  ERR. 판매자 : {$sdata[smb_id]} @ {$sdata[mb_id]} =>  <strong>입급 계좌 미설정</strong>  ----- SKIP ";
    $lines .= "</p>";
    $skip_seller_cnt++;
    $tot_cnt++;
    continue;
  }

  //판매자 수수료 재검사
  if ( $seller_item_fee > 0 && !array_key_exists( $sdata[ smb_id ], $enable_seller_fee ) ) {

    $temp = sql_fetch( "select sum(tr_seller_fee) tr_seller_fee from {$g5['cn_item_trade_test']} where fmb_id='$sdata[mb_id]' " );
    $enable_seller_fee[ $sdata[ smb_id ] ] = $sdata[ "ac_point_" . $g5[ cn_fee_coin ] ] - $temp[ tr_seller_fee ];
  }

  //판매자 수수료 재검사
  if ( $seller_item_fee > 0 && $enable_seller_fee[ $sdata[ smb_id ] ] < $seller_item_fee ) {
    $lines .= "<p class='fred'>" . ( $tot_cnt + 1 ) . ".  ERR. 판매자 : {$sdata[smb_id]} @ {$sdata[mb_id]} => " . $g5[ 'cn_item' ][ $sdata[ cn_item ] ][ name_kr ] . " 매칭 / 매칭수수료 : <strong>" . number_format2( $enable_seller_fee[ $sdata[ smb_id ] ] ) . "</strong> 부족  ----- SKIP ";
    $lines .= "</p>";
    $skip_seller_cnt++;
    $tot_cnt++;
    continue;
  }

  //매도 상품 정보
  if ( $w == 's' ) {
    $lines .= "<p>" . ( $tot_cnt + 1 ) . ".   판매자 : {$sdata[smb_id]} @ {$sdata[mb_id]} => " . $g5[ 'cn_item' ][ $sdata[ cn_item ] ][ name_kr ] . " 매칭 / 액면가 : " . number_format2( $sdata[ ct_buy_price ] );

    if ( $div_cnt > 1 )$lines .= " / 분할매도여부 : {$div_cnt}분할 / 매도금액 :" . number_format2( $sdata[ item_price ] );
    else $lines .= " /  매도금액 :" . number_format2( $sdata[ ct_sell_price ] );

    $lines .= " ----- OK ";

    $lines .= "</p>";

    $tot_cnt++;
    continue;
  }

  //분할수량 업데이트
  $sql = "update {$g5['cn_item_cart']} set div_cnt='$div_cnt' where code = '{$sdata[code]}'";
  sql_query( $sql, 1 );

  $sub_tot_cnt = 0;
  foreach ( $multidata as $data ) {

    //구매자 수수료
    if ( $_POST[ fee_free ] == 'free' )$item_fee = 0;
    else $item_fee = floor( $data[ item_price ] * $g5[ 'cn_item' ][ $data[ cn_item ] ][ fee ] / 100 * 100 ) / 100;

    //판매자 수수료
    if ( $_POST[ seller_fee_free ] == 'free' )$seller_item_fee = 0;
    else $seller_item_fee = floor( $data[ item_price ] * $g5[ 'cn_item' ][ $data[ cn_item ] ][ fee ] / 100 * 100 ) / 100;


    if ( $w != 's' ) {

      $sub_tot_cnt++;

      /* 맞는 가격대의 매수 회원 찾기 */
      $sql_common = " from {$g5['cn_sub_account']} as a 
			left outer join  {$g5['member_table']} as b on(a.mb_id=b.mb_id)  
			left outer join  {$g5['cn_sub_account']} as s on (s.ac_id=b.mb_id)  
			left outer join  (select mb_id,count(*) ct_cnt,sum(ct_buy_price) ct_buy_price  from {$g5['cn_item_cart']} where  is_soled != '1' and tr_active='1' and date(ct_wdate) = '$start_date' group by mb_id)  as c on(c.mb_id=b.mb_id) 
			left outer join  (select mb_id,count(*) tr_cnt,sum(tr_price_org) tr_price_org ,sum(tr_fee) tr_fee from {$g5['cn_item_trade_test']} group by mb_id )  as t on(t.mb_id=b.mb_id)
			";

      $sql_search = " where   a.mb_id!='$sdata[mb_id]' and mb_10 not in ('1','2')  $target_buyer_search  $except_buyer_search";

      //구매자 레벨 제한
      if ( $target_buyer_search == '' )$sql_search .= " and mb_level='5'  ";

      //활성
      if ( $active_chk == 'y' )$sql_search .= " and a.ac_active ='1' and a.ac_auto_" . $data[ cn_item ] . " = '1' ";

      //패널티 없는 회원
      $sql_search .= " and b.mb_trade_penalty <= 1 ";

      //로그인 시간 제한시
      if ( $login_day != '' && $login_day > 0 ) {
        $logdate = date( "Y-m-d H:i:s", strtotime( "- $login_day days" ) );
        $sql_search .= " and b.mb_today_login >= '$logdate' ";
      }

      //구매대기에서 매칭 제외 여부
      $sql_search .= " and a.ac_mc_except!='1' ";

      //결제 방식의 차이 - 현금일 경우만 구분
      if ( $sdata[ mb_trade_paytype ] == 'cash' ) {
        //$sql_search .=" and (b.mb_trade_paytype='cash' or b.mb_trade_paytype='both') ";
      }
      if ( $sdata[ mb_trade_paytype ] == 'usdt' ) {
        //$sql_search .=" and (b.mb_trade_paytype='usdt'  or b.mb_trade_paytype='both')  ";
      }

      //매칭 횟수 제한이 있는경우
      if ( $match_cnt_seller > 0 ) {
        $sql_search .= " and (select count(tr_code) cnt from {$g5['cn_item_trade_test']}  where smb_id=a.ac_id ) < $match_cnt_seller";
        $select_sql = ",(select count(tr_code) from {$g5['cn_item_trade_test']}  where smb_id=a.ac_id) as  match_cnt";

      } else $select_sql = '';

      if ( $enable_amt_check == 'y' ) {
        //설정금액이 상품 가격보다 큰 회원
        //$sql_search .=" and (b.mb_trade_amtlmt - if(c.ct_buy_price,c.ct_buy_price,0)  - if(t.tr_price_org,t.tr_price_org,0) ) >= '$data[item_price]' ";
        $sql_search .= " and (b.mb_trade_amtlmt  - if(t.tr_price_org,t.tr_price_org,0) ) >= '$data[item_price]' ";
      }

      //동일스톤 여부
      if ( $posess_item == 'same' )$posess_sql = " and cn_item='$data[cn_item]'";
      else $posess_sql = "";

      //보유 회원 제외
      if ( $posess_disable == 'member' ) {
        $sql_search .= " and  not exists  (select code from {$g5['cn_item_cart']} where is_soled!='1' and mb_id=a.mb_id $posess_sql)";
      }
      //보유 계정 제외
      if ( $posess_disable == 'account' ) {
        $sql_search .= " and  not exists  (select code from {$g5['cn_item_cart']} where  is_soled!='1' and smb_id=a.ac_id $posess_sql)";
      }

      //수수료가 충분한 매수자
      if ( $item_fee > 0 && !$ignore_fee ) {
        $sql_search .= " and (s.ac_point_{$g5[cn_fee_coin]} - if(t.tr_fee,t.tr_fee,0))  >= $item_fee ";
      }

      //1계정당 매칭 횟수의 제한
      if ( $match_cnt > 0 ) {
        //$sql_search .=" and t.tr_cnt <= match_cnt_seller ";
      }

      $sql = " select a.* ,a.mb_id amb_id, a.ac_id aac_id, t.tr_cnt,b.mb_trade_amtlmt,
			s.ac_point_b sac_point_b,s.ac_point_e sac_point_e,s.ac_point_i sac_point_i,s.ac_point_u sac_point_u,
			(if(c.ct_buy_price,c.ct_buy_price,0) - if(t.tr_price_org,t.tr_price_org,0) ) enable_paid 

			{$sql_common} {$sql_search} {$login_sql} group by a.ac_id 
			
			order by 
			if(
			if(b.mb_trade_amtlmt between '$amt_lmt_start1' and '$amt_lmt_end1',$amt_lmt_max1,
			if(b.mb_trade_amtlmt between '$amt_lmt_start2' and '$amt_lmt_end2',$amt_lmt_max2,
			if(b.mb_trade_amtlmt between '$amt_lmt_start3' and '$amt_lmt_end3',$amt_lmt_max3,			
			if(b.mb_trade_amtlmt between '$amt_lmt_start4' and '$amt_lmt_end4',$amt_lmt_max4,0)			
			)
			)
			) >  (if(t.tr_price_org,t.tr_price_org,0) + $data[item_price] )
			,1,0) desc,
			
			/*if((select count(*) cnt from {$g5['cn_item_trade_test']} where mb_id=a.mb_id ) = 0,0,1) asc*/
			(select count(*) cnt from {$g5['cn_item_trade_test']} where mb_id=a.mb_id ) asc
			, rand() limit 1";

      //$lines.=$sql;

      $row = sql_fetch( $sql, 1 );

      //구매자 리스팅 종료시
      if ( $row[ amb_id ] == '' ) {
        $lines .= "<p>" . ( $tot_cnt + 1 ) . "-{$sub_tot_cnt}.  판매자 : {$data[smb_id]} @ {$data[mb_id]} => " . $g5[ 'cn_item' ][ $sdata[ cn_item ] ][ name_kr ] . " / 판매상품 : " . $g5[ 'cn_item' ][ $data[ cn_item ] ][ name_kr ] . " / " . ( $div_cnt > 1 ? "<span class='fblue'>({$is_traded}/{$div_cnt} 등분)</span>" : "" );
        $lines .= "<p> ERR. 구매자를 매칭 할 수 없습니다 ----- SKIP ";
        $lines .= "</p>";

        continue;
      }

      //거래코드 생성
      $code = get_tradecode();

      //판매자 입금 주소
      $tr_wallet_addr = $data[ 'mb_wallet_addr_' . $g5[ 'cn_pay_coin' ] ];

      $sql = "insert into {$g5['cn_item_trade_test']}
			set  
			tr_code = '$code',
			cart_code = '$sdata[code]',
			lg_no='$lg_no',
			cn_item = '$data[cn_item]',
			mb_id = '$row[amb_id]',
			smb_id = '$row[aac_id]',
			fmb_id = '$sdata[mb_id]',
			fsmb_id = '$sdata[smb_id]',
			
			ct_buy_price='$data[ct_buy_price]',
			ct_sell_price='$data[item_price]',
			
			tr_buyer_claim = '0',
			tr_seller_claim = '0',
			tr_buyer_dun = '0',
			tr_seller_dun = '0',
			tr_buyer_note = '',
			tr_seller_note = '',

			tr_price_org = '$data[item_price]',
			tr_price = '$data[item_price]',
			tr_discount = '$item_discount',
			tr_payback = '$item_payback',

			tr_price_cash = '$item_price_cash',
			tr_discount_cash = '$item_discount_cash',
			tr_payback_cash = '$item_payback_cash',

			tr_class = '1',
			tr_fee = '$item_fee',
			tr_seller_fee = '$seller_item_fee',
			tr_paytype = '$data[mb_trade_paytype]',

			tr_bank='$data[mb_bank]',
			tr_bank_num='$data[mb_bank_num]', 
			tr_bank_user='$data[mb_bank_user]',

			tr_wallet_addr = '$tr_wallet_addr',
			tr_balance = '0',
			tr_balance_last = '0',
			tr_txid = '',
			tr_stats = '1',
			tr_paydate = '',
			tr_distri='p2p',
			tr_wdate = now(),
			tr_rdate = now(),
			tr_active = $data[tr_active]
			
			
			";

      $result = sql_query( $sql, 1 );

      $is_traded++;


      $lines .= "<p>" . ( $tot_cnt + 1 ) . "-{$sub_tot_cnt}.  판매자 : {$data[smb_id]} @ {$data[mb_id]} => " . $g5[ 'cn_item' ][ $sdata[ cn_item ] ][ name_kr ] . " / 구매자 (" . ( $row[ tr_cnt ] + 1 ) . ") 회차 : {$row[aac_id]} @ {$row[amb_id]}  => " . $g5[ 'cn_item' ][ $data[ cn_item ] ][ name_kr ];

      //배당상품 정보
      $lines .= " / " . ( $div_cnt > 1 ? "<span class='fblue'>({$is_traded}/{$div_cnt} 등분)</span>" : "<span class='fblue'>1/{$div_cnt} 등분)</span>" );


      $lines .=   " /  상품금액 :  <strong>" . number_format2( $data[ item_price ] ) . "</strong> / 설정금액잔액 : <strong>" . number_format2( $row[ mb_trade_amtlmt ]-$data[ item_price ]- $row[enable_paid ]  ) . "</strong> = " . number_format2( $row[ mb_trade_amtlmt ] ) . " - " . number_format2( $data[ item_price ]) ;
      $lines .= "/ $g5[cn_item_name]" . '코드 :' . $data[ code ] . " / 거래코드 : $code";

      if ( $data[ mb_bank_num ] )$lines .= " / 계좌정보 : $data[mb_bank] $data[mb_bank_num] $data[mb_bank_user]";

      $lines .= " / 매도수수료 : $seller_item_fee  / 매수수수료 : $item_fee";
      $lines .= " / {$g5[cn_cointype][$g5['cn_fee_coin']]} 잔액 :  " . number_format2( $row[ "sac_point_" . $g5[ cn_fee_coin ] ] - $row[ tr_fee ] - $item_fee, 2 );
      $lines .= "</p>";


    } else {
      //$tot_cnt++;

    }

  } //foreach

  $tot_cnt++;


} //while


alert_json( true, '', array( 'htmls' => $lines, 'page' => $page + 1, 'total' => $tot_cnt, 'next' => 'y' ) );