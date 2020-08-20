<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_javascript('<script src="'.G5_JS_URL.'/jquery.register_form.js"></script>');
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/css/login.css"  crossorigin="anonymous">');

?>

<style>
    #wrap {
      height: 2400px;
    }

    #log {
      display: block;
      color: #fff;
      font-size: 30px;
      font-weight: 600;
      top: 5%;
      padding-bottom: 50px;
    }

    #log h2 {
      font-size: 60px;
      margin-bottom: 60px;
    }

    #log button {
      width: auto;
      height: auto;
      line-height: auto;
      font-family: "ITC Serif Gothic", Lato;
      display: inline-block;
      background: url(<?=G5_THEME_URL?>/images/staticBtn.png) no-repeat;
      font-weight: 600;
      background-size: 100% 100%;
      padding: 10px 40px;
      font-size: 35px;
      color: #fff;
      margin: 0 5px;
      margin-bottom: 30px;
    }

    #log .btns {
      margin-top: 50px;
    }

    #log .btns button {
      width: auto;
      height: auto;
      line-height: auto;
      font-family: "ITC Serif Gothic", Lato;
      display: inline-block;
      background: url(<?=G5_THEME_URL?>/images/staticBtn.png) no-repeat;
      font-weight: 600;
      background-size: 100% 100%;
      padding: 10px 40px;
      font-size: 30px;
      color: #fff;
      margin: 0 5px;
      margin-bottom: 60px;
    }
  </style>
  
  	
<form class='form-horizontal' id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off"  >
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="url" value="<?php echo $urlencode ?>">
<input type="hidden" name="mb_id" value="<?php echo $mb_id ?>">


<!--iframe src="<?=G5_THEME_URL?>/images/bgm.mp3" allow="autoplay" style="display: none;" id="iframeAudio"></iframe-->
  <span class="shootingStar"></span>
  <span class="shootingStar pink"></span>
  <span class="shootingStar blue"></span>
  <span class="shootingStar yellow"></span>
  <div id="wrap">
    <div class=""></div>
    <div id="log" style="background: #000 url(<?=G5_THEME_URL?>/images/loginBg.jpg) no-repeat;">
      <div class="imgWraper">
        <img src="<?=G5_THEME_URL?>/images/star.svg" alt="Star" />
        <img src="<?=G5_THEME_URL?>/images/wars.svg" alt="Wars" />
      </div>
      <h2><?=lng('회원가입')?></h2>
      <h3><?=lng('아이디')?></h3>
     <input name="mb_id" type="text"  id="reg_mb_id" placeholder="Member ID" required >
      <h3><?=lng('비밀번호')?></h3>
      <input name="mb_password" type="password" class="input-text password-input" id="register-password" placeholder="Password" required autocomplete='off'  >
      <h3><?=lng('비밀번호 확인')?></h3>
      <input name="mb_password_re" type="password" class="input-text password-input" id="register-password2" placeholder="confirm Password" required autocomplete='off' >
      <h3><?=lng('국가번호')?></h3>
      <select name='mb_nation' id="reg_mb_nation"  >
		<?=$g5['cn_nation_tel']?>
	</select>
	 <h3><?=lng('이름')?></h3>
     <input name="mb_name" type="text"  id="reg_mb_name" placeholder="Member Name" required >
	 
      <h3><?=lng('휴대폰 번호')?></h3>
      <input name="mb_hp" type="text"  id="reg_mb_hp" placeholder="Mobile Phone" required class='' >
      <button class="phone" id='hp_certi_btn'>
        <?=lng('인증하기')?>
      </button>
      <h3><?=lng('인증번호')?></h3>
      <input name="mb_hp_certi" type="text"  id="reg_mb_hp_certi" placeholder="Certification Number" required class='' >
      <button class="phone" id='hp_comfirm_btn' >
        <?=lng('인증 확인')?>
      </button>
      <h3><?=lng('추천인 코드')?></h3>
      <input name="mb_recommend" type="text"  id="reg_mb_recommend" placeholder="Referral Code" autocomplete='off' value="<?=get_cookie('refid')?>"  >
      <div class="btns" type='submit'>
        <button type='submit' id='sign_up_btn' ><?=lng('확인')?></button>
        <button type='button' class="exit" onclick="document.location.href='/bbs/login.php';"><?=lng('취소')?></button>
      </div>
    </div>
  </div>
  
  </form>


<script>		

$(document).ready(function() {
	
 		
 	$('#hp_certi_btn').on('click',function(){
		event.preventDefault();
		
		var mb_id= $('#reg_mb_id').val();
		var nation_val= $('#reg_mb_nation').val();
		var hp_val=$('#reg_mb_hp').val();
		
		if(hp_val=='') Swal.fire('<?=lng('휴대전화 번호를 입력하세요')?>');
		
			$.ajax({
			type: "POST",
			url: './ajax.mb_hp_certi.php',
			data:{mb_id:mb_id,nation:nation_val ,hp:hp_val,mode:'create'},
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {
				if(data.result==true){				
					Swal.fire('<?=lng('인증번호를 전송하였습니다.\n전송받은 인증번호를 입력하세요')?>');
				}
				else Swal.fire("",data.message,"warning");
			}
		});				
	
	});	
	
	
	$('#hp_comfirm_btn').on('click',function(){
		event.preventDefault();
		
		var mb_id= $('#reg_mb_id').val();
		var hp_val=$('#reg_mb_hp').val();
		var nation_val=$('#reg_mb_nation').val();
		var pass_val=$('#reg_mb_hp_certi').val()
		
			$.ajax({
			type: "POST",
			url: './ajax.mb_hp_certi.php',
			data:{mb_id:mb_id,nation:nation_val ,hp:hp_val,mode:'check',pass:pass_val},
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {
				if(data.result){				
					$('#reg_mb_hp_certi,#mb_reg_hp').attr('readonly',true);
					$('#hp_comfirm_btn,#hp_certi_btn').attr('disabled',true);
					
					Swal.fire("",'<?=lng('인증번호가 확인되었습니다')?>',"warning");
					
				}
				else Swal.fire("",data.message,"warning");
			}
		});					
	
	});	
			
});
	
    // submit 최종 폼체크
    function fregisterform_submit(f)
    {
		 
		 event.preventDefault();
       
	   // E-mail 검사
		if($("#reg_mb_id").val()!=''){
			var msg = reg_mb_id_check();
			if (msg) {
				Swal.fire("",msg,"warning");
				f.reg_mb_id.select();
				return false;
			}
		}		       
		// 휴대폰
		if($("#reg_mb_hp").val()!=''){
			var msg = reg_mb_hp_check();
			if (msg) {
				Swal.fire("",msg,"warning");
				f.reg_mb_hp.select();
				return false;
			}
		}		
		
		/*
        // E-mail 검사
		if($("#reg_mb_email").val()!=''){
			var msg = reg_mb_email_check();
			if (msg) {
				Swal.fire("",msg,"warning");
				f.reg_mb_email.select();
				return false;
			}
		}
		*/

        if (f.w.value == "") {
            if (f.mb_password.value.length < 3) {
				Swal.fire("","<?=lng('비밀번호는 3자 이상 입력하십시오.')?>","warning");
                f.mb_password.focus();
                return false;
            }
        }

        if (f.mb_password.value != f.mb_password_re.value) {
            Swal.fire("","<?=lng('비밀번호가 동일하지 않습니다')?>","warning");
            f.mb_password_re.focus();
            return false;
        }

        if (f.mb_password.value.length > 0) {
            if (f.mb_password_re.value.length < 3) {
               Swal.fire("","<?=lng('비밀번호는 3자 이상 입력하십시오.')?>","warning");
                f.mb_password_re.focus();
                return false;
            }
        }	
		
		if (f.mb_recommend.value.length < 1) {
			Swal.fire("","<?=lng('추천인 코드를 입력하세요')?>","warning");
			f.mb_recommend.focus();
			return false;
		}
		
        if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
            if (f.mb_id.value == f.mb_recommend.value) {
               Swal.fire("","<?=lng('당신의 아이디를 추천인 코드로 입력 할 수 없습니다.')?>","warning");
                f.mb_recommend.focus();
                return false;
            }

            var msg = reg_mb_recommend_check();
            if (msg) {
               Swal.fire("",msg,"warning");
                f.mb_recommend.select();
                return false;
            }
        }
		
		/*
		 if (f.mb_deposite_pass.value.length < 3) {
			Swal.fire("","<?=lng('이체 암호는 3자이상 입력하세요')?>","warning");
			f.mb_deposite_pass.focus();
			return false;           
        }
		*/
	
		
		var formData = $(f).serialize();	
		document.getElementById("sign_up_btn").disabled = "disabled";
		
		$.ajax({
			type: "POST",
			url: $(f).attr('action'),
			data:formData,
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {
				if(data.result==true){									
					Swal.fire({title:"",text:"Congratulations on joining",icon:'success',
				  	onClose: () => {					
					if(data.datas['goto_url']) document.location.href=data.datas['goto_url'];
					else  document.location.href='/';
				  }
				 });	
				}
				else Swal.fire("",data.message,"error");
			}
		});		
		
		document.getElementById("sign_up_btn").disabled = false;
		
		

    }
    </script>

<!-- } 회원정보 입력/수정 끝 -->