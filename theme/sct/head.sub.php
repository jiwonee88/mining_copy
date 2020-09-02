<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$begin_time = get_microtime();

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    $g5_head_title = $g5['title']; // 상태바에 표시될 제목
    $g5_head_title .= " | ".$config['cf_title'];
}

$g5['title'] = strip_tags(get_text($g5['title']));
$g5_head_title = strip_tags(get_text($g5_head_title));

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?
if($config['cf_add_meta'])
echo $config['cf_add_meta'].PHP_EOL;

?>
<title><?php echo $g5_head_title; ?></title>
<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/extend/bootstrap.min.css"  crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/extend/all.css" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/extend/jquery-ui.css">
<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/css/ornament.css?ver=<?php echo G5_CSS_VER; ?>"  crossorigin="anonymous">
	
<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/css/common.css?ver=<?php echo G5_CSS_VER; ?>"  crossorigin="anonymous">

<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
</script>


<script src="<?php echo G5_THEME_URL ?>/extend/jquery-1.12.4.min.js" ></script>
<script src="<?php echo G5_THEME_URL ?>/extend/jquery-ui.js"></script>
<script src="<?php echo G5_THEME_URL ?>/extend/popper.min.js"  crossorigin="anonymous"></script>
<script src="<?php echo G5_THEME_URL ?>/extend/bootstrap.min.js"  crossorigin="anonymous"></script>

<script src="<?=G5_THEME_URL?>/extend/sweetalert2.all.min.js"></script>
<script src="<?=G5_THEME_URL?>/extend/promis_polyfil.js"></script>

<link rel="stylesheet" href="<?=G5_THEME_URL?>/extend/sweetalert2.css?ver=<?php echo G5_JS_VER; ?>">

<script src="<?=G5_THEME_URL?>/extend/jquery.modal.min.js"></script>
<link rel="stylesheet" href="<?=G5_THEME_URL?>/extend/jquery.modal.min.css?ver=<?php echo G5_JS_VER; ?>">

<script src="<?php echo G5_JS_URL ?>/common.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script src="<?php echo G5_JS_URL ?>/coin.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script src="<?=G5_THEME_URL?>/js/common.js?ver=<?php echo G5_JS_VER; ?>"></script>
</head>

<body  <?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?>>

