<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

	
	
    </div>


<style>
.mobile-nav .member-info{padding:20px 0 20px 20px;}
.mobile-nav .member-info .member-img div{width:40px;height:40px;border-radius:50%;overflow:hidden;}
.mobile-nav .member-info .member-img img{width:100%;}
.mobile-nav .member-info .member-img .torso {font-size:40px;color:#adadad;}
.mobile-nav .member-info p.name {margin-top:20px;line-height:1.4em;color:#9a9a9a;font-size:0.925em;font-weight:normal;}
.mobile-nav .member-info p.email {line-height:1.4em;color:#9a9a9a;font-size:0.825em;font-weight:normal;}
.mobile-nav .member-info p.login {margin-top:20px;line-height:1.4em;color:#9a9a9a;font-size:1em;font-weight:normal;}
.mobile-nav .member-info p.btns {position:absolute;top:20px;right:20px;}

.mobile-nav-active .mobile-nav {
    left: 0;
	font-weight:normal;
}
.mobile-nav {
	display: block;
    position: fixed;
    top: 0;
    bottom: 0;
    z-index: 9999;
    overflow-y: auto;
    left: -80vw;
    width: 80vw;
    background: rgba(0,0,0,0.5);
    transition: 0.4s;
	z-index:1000;
}
.mobile-nav > ul > li{
	/*border-bottom:1px solid #dddddd;	*/
}
.mobile-nav > ul > li > a {
	padding:1rem 2	rem;
}

.mobile-nav > ul > li.sub{
	border-bottom:none;	
}
.mobile-nav > ul > li.sub.sub-border{
	border-bottom:1px solid #dddddd;	
}
.mobile-nav > ul > li.sub a{
	padding:5px 20px;
}
.mobile-nav > ul > li a.active{
	color:#ff0000;
	font-weight:bold;
}
.mobile-nav * {
    margin: 0;
    list-style: none;
}
.mobile-nav .h5 {
    padding: 20px 20px 10px 20px;
}
.mobile-nav .drop-down > a {
    padding-right: 35px;
}
.mobile-nav .drop-down > a > i {
    padding-left: 10px;
    position: absolute;
    right: 15px;
}

.mobile-nav .drop-down ul {
    display: none;
    overflow: hidden;
}
.mobile-nav ul a {
    display: block;
    position: relative;   
    padding: 10px 20px;
}

.mobile-nav-overly {
	display: block;	
    width: 100%;
    height: 100%;
    z-index: 9997;
    top: 0;
    left: 0;
    position: fixed;
    background: rgba(40, 38, 70, 0.8);
    overflow: hidden;
    display: none;
	z-index:999;
}
.mobile-nav-overly i {
position:absolute;
top:20px;right:20px;	
color:#ffffff;
font-size:1.4em;	
}

</style> 
<nav class="mobile-nav">	
    <div class='member-info '>
    <?
	if($is_member){?>    
    
    <div class="member-img  border-line" >
      <a href="<?=$_my_page?>"  >
      <?php			  
		  //$mb_img_path = G5_DATA_PATH.'/member_image/'.substr($member['mb_id'],0,2)."/".$member['mb_id'].'.gif';
		  //$mb_img_url = G5_DATA_URL.'/member_image/'.substr($member['mb_id'],0,2)."/".$member['mb_id'].'.gif';
         if ( file_exists($mb_img_path)) {  ?>
        <div><img src="<?php echo $mb_img_url ?>" alt="회원이미지"></div>
        <? }else{?>
        <i class="torso fas fa-user-circle fgray"></i>
        <? }?>        
        </a>
        <p class='btns'>
        <a href="#" class='btn btn-sm btn-light' >마이페이지</a>
		<a href='/bbs/logout.php' class='btn btn-sm btn-danger'>로그아웃</a></p>
        <p class='name' ><?=$member['mb_name']?> [<?=$g5['member_level_name'][$member['mb_level']]?>]</p> 
        <p class='email' ><?=$member['mb_email']?></p> 
        
    </div>
    
   <? }else{?>
   <div class="member-img" >
      <a  href="/bbs/login.php"  >
        <i class="torso fas fa-user-circle fgray"></i>        
       <p class='login' >회원로그인이 필요합니다 <span class='text-danger'>로그인</span></p> 
       </a>
    </div>   
   <? }
   ?> 
   </div>  
          
    <ul>
	 <li ><a class="<?=preg_match("/^estate_/",basename($_SERVER[SCRIPT_NAME]))?"active":""?>" href="/estate/estate_list.php">공지사항</a></li>
	 <li ><a class="<?=preg_match("/^estate_/",basename($_SERVER[SCRIPT_NAME]))?"active":""?>" href="/estate/estate_list.php">1:1문의</a></li>
	 <li><a href='/bbs/logout.php'>로그아웃</a></li>
	 <li><a class="<?=preg_match("/usage_web\.php/",basename($_SERVER[SCRIPT_NAME]))?"active":""?>" href="/estate/usage_web.php">이용안내</a></li>
	 <li><a class="<?=$bo_table=='faq_web'?"active":""?>" href="/bbs/board.php?bo_table=faq_web">FAQ</a></li>	 
	 
	</ul>
	
	
  </nav> 	
  
<div class="mobile-nav-overly" style="display:none;"><i class="fa fa-times"></i></div>  

<script>
(function ($) {
  "use strict";
	
	$(document).on('click', '.menuBtn', function(e) {
      $('body').toggleClass('mobile-nav-active');
      $('.mobile-nav-overly').toggle();
    });
    
    $(document).on('click', '.mobile-nav .drop-down > a', function(e) {
      e.preventDefault();
      $(this).next('ul').slideToggle(300);
      $(this).parent().toggleClass('active');
    });

    $(document).click(function(e) {
      var container = $(".mobile-nav, .menuBtn");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('.mobile-nav-overly').fadeOut();
        }
      }
    });
	
	$(".navbar-back").on('click',  function(e) {
      	history.go(-1);	  
    });
    

})(jQuery);


</script>

	
<?
if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
include_once(G5_THEME_PATH."/tail.sub.php");
?>