<?php
$sub_menu = "700600";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

include_once(G5_CN_ADMIN_PATH.'/item_trade_list.inc.php');

include_once(G5_ADMIN_PATH.'/admin.tail.php');

?>
