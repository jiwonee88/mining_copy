<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/css/login.css?ver='.time().'"  crossorigin="anonymous">');
add_javascript('<script src="'.G5_THEME_URL.'/js/login.js"></script>');
?>
  <!--iframe src="<?=G5_THEME_URL?>/images/bgm.mp3" allow="autoplay" style="display: none;" id="iframeAudio"></iframe-->
  <span class="shootingStar"></span>
  <span class="shootingStar pink"></span>
  <span class="shootingStar blue"></span>
  <span class="shootingStar yellow"></span>
  <div id="wrap">
   
	<!--form name='lang_change' class='form-inline' action='<?=$_SERVER[SCRIPT_NAME]?>' >
	<div  style='width:80%;position:absolute;top:100px;text-align:right;left:50%;transform:translateX(-50%);' >
	<select name='lng' class='form-control form-control-lg  d-inline w-auto '>
	<option value='kr' <?=get_cookie('lang_set')=='kr'?'selected':''?> >KOR</option>	
	<option value='us' <?=get_cookie('lang_set')=='us'?'selected':''?> >ENG</option>		
	<option value='vn' <?=get_cookie('lang_set')=='vn'?'selected':''?> >VNM</option>		
	</select>
	</div>
	</form-->
	<div  style='width:80%;position:absolute;top:100px;text-align:right;left:50%;transform:translateX(-50%);' class='flag-btn'>
	<div class="dropdown">
		  <button class="btn btn-lg btn-light dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
			<?
			$lang_set=get_cookie('lang_set');
			if($lang_set=='kr') echo 'KOR';
			else if($lang_set=='us') echo 'ENG';
			else if($lang_set=='vn') echo 'VNM';
			else if($lang_set=='jp') echo 'JPN';
			else if($lang_set=='cn') echo 'CHN';
			else if($lang_set=='th') echo 'THA';			
			?>
		  </button>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			<a class="dropdown-item text-dark flag flag-kr" data-lang='kr' href="javascript:lang_set('kr');" >KOR</a>	
			<a class="dropdown-item text-dark flag flag-us" data-lang='us' href="javascript:lang_set('us');"  >ENG</a>			
			<a class="dropdown-item text-dark flag flag-vn" data-lang='vn' href="javascript:lang_set('vn');"  >VNM</a>		
			<a class="dropdown-item text-dark flag flag-jp" data-lang='jp' href="javascript:lang_set('jp');"  >JPN</a>	
			<a class="dropdown-item text-dark flag flag-cn" data-lang='cn' href="javascript:lang_set('cn');"  >CHN</a>	
			<a class="dropdown-item text-dark flag flag-th" data-lang='th' href="javascript:lang_set('th');"  >THA</a>	

		  </div>
		</div>
		</div>
		
  <form class="form-horizontal"  name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
	
	
				
    <div class="starwars-demo">
      <img src="<?=G5_THEME_URL?>/images/star.svg" alt="Star" class="star" />
      <img src="<?=G5_THEME_URL?>/images/wars.svg" alt="Wars" class="wars" />
      <h2 class="byline" id="byline">BIG Plan</h2>
    </div>
    <div id="log" style="background: #000 url(<?=G5_THEME_URL?>/images/loginBg.jpg) no-repeat;">
      <div class="imgWraper">
        <img src="<?=G5_THEME_URL?>/images/star.svg" alt="Star" />
        <img src="<?=G5_THEME_URL?>/images/wars.svg" alt="Wars" />
      </div>
      <input name="mb_id" type="text" class="input-text" id="mb_id" required placeholder="<?=lng('회원 아이디')?>"  autocomplete='off' >
      <input name="mb_password" type="password" class="input-text" id="mb_password" required  placeholder="<?=lng('암호')?>"  autocomplete='off' >
      <div class="btnWraper">
        <button type='submit' class="login"  style="background: url(<?=G5_THEME_URL?>/images/loginBtn.png) no-repeat;"></button>
        <button type='button' onclick="location.href='/bbs/register_form.php'" class="signUp"
          style="background: url(<?=G5_THEME_URL?>/images/signUpBtn.png) no-repeat;"></button>
      </div>
      <div class="bottomComment">본 플랫폼은 개인과 개인간의 거래를 중계하는 플랫폼입니다. <br>어떤 플랫폼이든 맹목적인 참여는 좋지 않은 결과를 야기할 수 있습니다. </div>
    </div>
	!-- <br> 개인간거래에 대해서 회사에서는 관여하지 않으며 --!
	</form>
  </div>
  
 <script>
    setTimeout(function () {
      document.getElementById("log").style.display = "block"
    }, 5000)

$(function(){
	 $("select[name=lng]").change(function(){
	 	event.preventDefault();
        var v=$(this).val();
		lang_set(v);
    });
});


//로그인 스크립트
function flogin_submit(f)
{
	event.preventDefault();

	var formData = $(f).serialize();	
	
	$.ajax({
		type: "POST",
		url: $(f).attr('action'),
		data:formData,
		cache: false,
		/*async: false,*/
		dataType:"json",
		success: function(data) {
			
			if(data.result==true){				

				if(data.datas['goto_url']){
					document.location.href='/' //data.datas['goto_url'];
				}
				else  document.location.href='/';
				
				return;
				
			}
			else Swal.fire({title:"",text:data.message,icon: 'warning'
			,
			  onClose: () => {
				if(data.datas['goto_url']) document.location.href=data.datas['goto_url'];
			  }
			 });
			
		}
	});		

	
	return;
}
	
</script>