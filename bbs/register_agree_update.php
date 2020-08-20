<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 리퍼러 체크
referer_check();

if (!($w == 'u')) {
    alert_json(false,'접근이 옳바르지 않습니다');
}
// 로그인중인 경우 회원가입 할 수 없습니다.
if (!$is_member) {
   alert_json(false,'로그인 하셔야 동의가 가능합니다');
}


$sql = " update {$g5['member_table']}
			set mb_13= now()   where mb_id = '$member[mb_id]' ";
			  
sql_query($sql);

alert_json(true,'서비스 이용 약관에 동의하셨습니다');
?>
