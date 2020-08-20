<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_javascript('<script src="'.G5_JS_URL.'/jquery.register_form.js"></script>');

?>
  	
<form class='form-horizontal' id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off"  >
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="url" value="<?php echo $urlencode ?>">
<input type="hidden" name="mb_id" value="<?php echo $mb_id ?>">



<div class="join">
    <div class="wrap">
        <h2 class="topTitle">MINING <?=lng('회원가입')?></h2>
        <div class="back"><img src="<?=G5_THEME_URL?>/images/back.svg" alt="뒤로" /></div>    
    <div class="sec">
    <h2 class="topTitle"><?=lng('회원가입 정보입력')?></h2> 
            <input name="mb_name" type="text" id="reg_mb_name" placeholder="<?=lng('이름')?>" value="">
            <input name="mb_id" type="text" id="reg_mb_id" placeholder="<?=lng('아이디')?>" value="">
        <input name="mb_password" type="password" id="mb_password" placeholder=" <?=lng('비밀번호')?>"  value="">
    <input name="mb_password_re" type="password" id="mb_password_re" placeholder=" <?=lng('비밀번호 확인')?>"  value="">   
    </div>
        <div class="sec">
         <select name='mb_nation' id="reg_mb_nation"  >
		<?=$g5['cn_nation_tel']?>
		</select>
        <input name="mb_hp" type="text" id="reg_mb_hp" placeholder="<?=lng('휴대폰번호 입력')?>"  value="">  
        <!--button type="submit" class="smallBtn"  id='hp_certi_btn'><?=lng('인증하기')?></button>   
        <input name="mb_hp_certi" type="text" id="reg_mb_hp_certi" placeholder="<?=lng('인증번호 입력')?>" value="">   
        <button type="submit" class="smallBtn" id='hp_comfirm_btn' ><?=lng('인증확인')?></button> 
		-->
        </div>   
        <div class="sec">
			<input name="mb_12" type="text" id="reg_mb_12" placeholder="<?=lng('UID')?>" value="<?=$member[mb_12]?>" > 
            <input name="mb_recommend" type="text" id="reg_mb_recommend" placeholder="<?=lng('추천인코드')?>" value="<?=get_cookie('refid')?>">   
        </div>
		
		<div class="sec">
		 <h6>회원가입동의</h63>
		  <div class='border w-100 mx-auto text-left p-1' style='font-size:0.925rem;'>
		  마이닝 p2p는 회원간의 약속거래이므로 본 플랫폼은 회원간의 거래에 대하여 책임을 지지 않으며 본인은 회사에게 책임을 묻지 않을것입니다.	  
		  </div >
		  <label class='w-100 text-center mt-1'>
			<input type="checkbox"   name="agree"  id="agree" value='y' class='d-inline mt-0' style='width:1rem;height:1rem;'>	동의합니다.
		</label>
		</div>
	
	
        <button type="submit"  id='sign_up_btn' ><?=lng('가입하기')?></button> 
    </div>   





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
       
	   if (f.w.value == "") {
            if (f.mb_name.value.length < 2) {
				Swal.fire("","<?=lng('이름을 입력하세요')?>","warning");
                f.mb_name.focus();
                return false;
            }
        }
	   // E-mail 검사
		if($("#reg_mb_id").val()!=''){
			var msg = reg_mb_id_check();
			if (msg) {
				Swal.fire("",msg,"warning");
				f.reg_mb_id.select();
				return false;
			}
		}		      
		/*
		// 휴대폰
		if($("#reg_mb_hp").val()!=''){
			var msg = reg_mb_hp_check();
			if (msg) {
				Swal.fire("",msg,"warning");
				f.reg_mb_hp.select();
				return false;
			}
		}
		*/
		
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
		
		
        if (f.mb_12.value == "") {
			Swal.fire("","<?=lng('UID를 입력하세요')?>","warning");
			f.mb_12.focus();
			return false;
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
		
		if ($("input[name=agree]").prop('checked') == false ) {
			Swal.fire("","회원가입에 동의하셔야 가입이 가능합니다","warning");
			return false;
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