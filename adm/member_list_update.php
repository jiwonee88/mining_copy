<?php
$sub_menu = "200100";
include_once('./_common.php');

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

auth_check($auth[$sub_menu], 'w');

check_admin_token();

if ($_POST['act_button'] == "선택수정") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb = get_member($_POST['mb_id'][$k]);

        if (!$mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.\\n';
        } else if ($member['mb_id'] == $mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 수정 할 수 없습니다.\\n';
        } else {
            if($_POST['mb_certify'][$k])
                $mb_adult = (int) $_POST['mb_adult'][$k];
            else
                $mb_adult = 0;

            $sql = " update {$g5['member_table']}
                        set mb_level = '".sql_real_escape_string($_POST['mb_level'][$k])."',
                            mb_intercept_date = '".sql_real_escape_string($_POST['mb_intercept_date'][$k])."',
                            mb_mailling = '".sql_real_escape_string($_POST['mb_mailling'][$k])."',
                            mb_sms = '".sql_real_escape_string($_POST['mb_sms'][$k])."',
                            mb_open = '".sql_real_escape_string($_POST['mb_open'][$k])."',
                            mb_certify = '".sql_real_escape_string($_POST['mb_certify'][$k])."',
                            mb_adult = '{$mb_adult}'
                        where mb_id = '".sql_real_escape_string($_POST['mb_id'][$k])."' ";
            sql_query($sql);
        }
    }

} else if ($_POST['act_button'] == "선택삭제" || $_POST['act_button'] == "완전삭제") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb = get_member($_POST['mb_id'][$k]);

        if (!$mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($member['mb_id'] == $mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 삭제 할 수 없습니다.\\n';
        } else if (is_admin($mb['mb_id']) == 'super') {
            $msg .= $mb['mb_id'].' : 최고 관리자는 삭제할 수 없습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 삭제할 수 없습니다.\\n';
        } else {
            // 회원자료 삭제
            member_delete($mb['mb_id'],$_POST['act_button'] == "완전삭제"?1:0);
        }
    }


} else if ($_POST['act_button'] == "VIP선정") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb = get_member($_POST['mb_id'][$k]);
		$tot_amt=only_number($_POST['tot_amt']);		
		$amt_lmt=only_number($_POST['amt_lmt']);
		$tot_amt=$tot_amt?$tot_amt:0;
		$amt_lmt=$amt_lmt?$amt_lmt:0;
		$user_tot[amt]=0;
		
		if ($tot_amt > 0) $user_tot=sql_fetch("SELECT  sum(ct_buy_price) amt from `coin_item_cart` where mb_id='$mb[mb_id]' and is_soled!='1' ");
		
        if (!$mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ( $tot_amt > 0 && $tot_amt > $user_tot[amt]) {
            $msg .= $mb['mb_id'].' : 보유금액이 부족합니다.\\n';
       
        } else {
            //vip 변경
            //sql_query("update $g5[member_table] set mb_14='vip',mb_trade_amtlmt= if(mb_trade_amtlmt < $amt_lmt,$amt_lmt,mb_trade_amtlmt)  where mb_id='{$mb['mb_id']}' ",1);
			sql_query("update $g5[member_table] set mb_14='vip',mb_trade_amtlmt=  $amt_lmt where mb_id='{$mb['mb_id']}' ",1);
        }
    }

} else if ($_POST['act_button'] == "VIP해제") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb = get_member($_POST['mb_id'][$k]);
		
		
        if (!$mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
      
        } else {
            //vip 변경
            sql_query("update $g5[member_table] set mb_14='' where mb_id='{$mb['mb_id']}' ");
        }
    }
}

if ($msg)
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);

goto_url('./'.($return_page ? $return_page:"member_list.php").'?'.$qstr);
?>