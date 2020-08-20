<?php
include_once('./_common.php');

// 로그인중인 경우 회원가입 할 수 없습니다.
if (!$is_member) {
    goto_url('/bbs/login.php');
}
if ($member[mb_13]!='') {
    goto_url('/');
}

$g5['title'] = '이용약관동의';
include_once('./_head.php');

$register_action_url = G5_BBS_URL.'/register_agree_update.php';
include_once($member_skin_path.'/agree.skin.php');

include_once('./_tail.php');
?>
