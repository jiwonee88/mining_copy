<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/css/login.css?ver='.time().'"  crossorigin="anonymous">');
//add_javascript('<script src="'.G5_THEME_URL.'/js/login.js"></script>');


$lang_set=get_cookie('lang_set');
		
?>

 <div class="login">
	<div class="wrap">
		<div class="lang">
			<div>
			<span>
			
			<? 			
			if($lang_set=='us')  echo "<img src='".G5_THEME_URL."/img/flag/USA-flag.png' class='flag' >";
			else if($lang_set=='cn')  echo "<img src='".G5_THEME_URL."/img/flag/China-flag.png' class='flag' >";
			else  echo "<img src='".G5_THEME_URL."/img/flag/South-Korea-flag.png' class='flag' >";
			?>
			
<?
if($lang_set=='kr') echo 'KOR';
else if($lang_set=='us') echo 'ENG';
else if($lang_set=='cn') echo 'CHN';
else echo 'KOR';
?></span>
				<ul class="langGroup">
					<li><a  data-lang='kr' href="javascript:lang_set('kr');" ><img src='<?=G5_THEME_URL?>/img/flag/South-Korea-flag.png'  class='flag'> KOR</a></li>
					<li><a  data-lang='us' href="javascript:lang_set('us');" ><img src='<?=G5_THEME_URL?>/img/flag/USA-flag.png'  class='flag'>ENG</a></li>
					<li><a  data-lang='cn' href="javascript:lang_set('cn');" ><img src='<?=G5_THEME_URL?>/img/flag/China-flag.png'  class='flag'>CHN</a></li>
				</ul>
			</div>
		</div>
	   <div><img src="<?=G5_THEME_URL?>/images/user.svg" alt="" class="userImg"/></div>
		<div class="sec overflow-hidden">
		  <form class="form-horizontal"  name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">

		  <h1>Mining</h1>    
			<div class="box id">
				<input type="text" value="" name="mb_id" placeholder="<?=lng('회원 아이디')?>"  autocomplete='off' id="mb_id">
			</div>
			<div class="box pswd">
				<input type="password" value="" name="mb_password"  placeholder="<?=lng('암호')?>" id="mb_password">
			</div>
			<button type="submit"><?=lng('로그인')?></button>
			<div class="joinBtn"><a href="/bbs/register_form.php"><?=lng('회원가입하기')?></a></div>
		</form>
		</div>
	</div>
</div>

 <script>

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
			else Swal.fire({title:"",html:data.message,icon: 'warning'
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