<?php
include_once ('../common.php');

if(!$is_member) goto_url("/bbs/login.php");

//회원 전체 포인트 정보
if($member) $rpoint=get_mempoint($member['mb_id']);
 
//시세 정보
$sise=get_sise();

//메인계정의 포인트
$mrpoint=get_mempoint($member['mb_id'],$member['mb_id']);
$isum=get_itemsum($member[mb_id]);

//이용약관 동의
//if($member[mb_13]=='') goto_url('/bbs/agree.php');
?>