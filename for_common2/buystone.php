<!-- $(document).ready(function(){
/*
$('.notice_bg, .noticeCloseBtn').click(function(){
$('#notice').hide();
});
$('.login_join').click(function(){
$('#join').show();
$('#login').hide();
});
$('.joinCloseBtn').click(function(){
$('#join').hide();
});*/
});

/* 모바일뷰메뉴 노출 */
$(document).ready(function() {
$('.menuClose').click(function(){
$('.menu').animate({left: '-100%'}, 700);
});

$('.menuBtn').click(function(){
$('.menu').animate({left: '0'}, 700);

});
}); -->
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta http-equiv='content-type' content='text/html; charset=UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv='pragma' content='no-cache'>
    <meta http-equiv='cache-control' content='no-cache'>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Expires" content="0" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="naver-site-verification" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:title" content="" />

    <title></title>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:100,300,400,500,700,900&display=swap"
        rel="stylesheet">

    <!-- 공통 CSS -->
    <link href="./css/common.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

    <!-- 로그인 팝업 -->
    <div id="login" class="modal">
        <div class="modal_bg login_bg"></div>
        <div class="modal-content">
            <div class="closeBtn loginCloseBtn"><img src="./images/closeBtn.png" alt="닫기" alt="" /></div>
            <div class="modalTitle">GOLD전송</div>
            <div class="send">
                <div class="sendID"><label>보낼계정</label><input type="text" value="dd1004" /></div>
                <div><label>받는계정</label><input type="text" value="" placeholder="입력하세요" /></div>
                <div class="sendGold"><label>보낼GOLD</label><input type="text" value="" placeholder="입력하세요" /></div>
            </div>
            <ul class="record">
                <li>보유: 1,500개</li>
                <li>전송가능: 1,300개</li>
                <li>최소전송: 100개</li>
            </ul>
            <div class="do">전송하기</div>
        </div>
    </div>
    <!--// 로그인 팝업 -->

    <!-- 공통 Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- script-->
    <script src="./js/common.js"></script>


</body>

</html>