<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
#fregister input[type=checkbox] {
    width: 40px;
    height: 40px;
}
#fregister textarea {
    height: 250px;
    
}
#fregister h2,#fregister p ,#fregister textarea ,#fregister_private div{background:transparent;}
#fregister_private table td{
    font-size:0.925em;
}


</style>
<!-- 회원가입약관 동의 시작 { -->
<div class='w-95 mx-auto'>


    <form  name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
	<input type=hidden name='w' value='u'>
    <p class='bg-warning' >서비스이용약관 및 개인정보처리방침 안내의 내용에 동의하셔야 서비스 이용이 가능합니다.</p>
    <div id="fregister_chkall">
        <label for="chk_all">전체동의</label>
        <input type="checkbox" name="chk_all"  value="1"  id="chk_all">

    </div>
    <section id="fregister_term">
        <h2 class='h6' ><i class="fa fa-check-square-o" aria-hidden="true"></i> 회원가입약관</h2>
        <textarea readonly class='text-white small' ><?php echo get_text($config['cf_stipulation']) ?></textarea>
        <fieldset class="fregister_agree">
            <label for="agree11">내용에 동의합니다.</label>
            <input type="checkbox" name="agree" value="1" id="agree11">
        </fieldset>
    </section>

    <section id="fregister_private">
        <h2  class='h6'><i class="fa fa-check-square-o" aria-hidden="true"></i> 개인정보처리방침안내</h2>
        <div>
            <table class='small' >
                <caption>개인정보처리방침안내</caption>
                <thead>
                <tr>
                    <th>목적</th>
                    <th>항목</th>
                    <th>보유기간</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>이용자 식별 및 본인여부 확인</td>
                    <td>아이디, 이름, 비밀번호</td>
                    <td>회원 탈퇴 시까지</td>
                </tr>
                <tr>
                    <td>고객서비스 이용에 관한 통지,<br>CS대응을 위한 이용자 식별</td>
                    <td>연락처 <br>
(휴대전화번호)</td>
                    <td>회원 탈퇴 시까지</td>
                </tr>
				<tr>
                    <td>서비스 이용에 필요한 결제 정보</td>
                    <td>입금계좌정보 <br>
(은행명,계좌번호,예금주)</td>
                    <td>회원 탈퇴 시까지</td>
                </tr>
                </tbody>
            </table>
        </div>

        <fieldset class="fregister_agree">
            <label for="agree21">내용에 동의합니다.</label>
            <input type="checkbox" name="agree2" value="1" id="agree21">
        </fieldset>
    </section>

    <div class="btn_confirm">
        <input type="submit" class="btn btn-light" value="서비스이용약관에 동의">
    </div>

    </form>

    <script>
	
	
	
	
    function fregister_submit(f)
    {
        if (!f.agree.checked) {
            swal.fire({html:"회원가입약관의 내용에 동의하셔야 서비스 이용이 가능합니다."});
            f.agree.focus();
            return false;
        }

        if (!f.agree2.checked) {
             swal.fire({html:"개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다."});
            f.agree2.focus();
            return false;
        }
		
		
		event.preventDefault();
		var formData = $(f).serialize();	

		$.ajax({
			type: "POST",
			url: $(f).attr('action'),
			data:formData,
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {

				if(data.result==true){			
					
					Swal.fire({html:data.message,timer:2000,
					onClose:() => { 
					page_reload()
					
					}
				  });						
							
				}
				else{	
					f.reset();
					Swal.fire(data.message);       
				}
			}	
		});		
		return;

        return true;
    }
    
    jQuery(function($){
        // 모두선택
        $("input[name=chk_all]").click(function() {
            if ($(this).prop('checked')) {
                $("input[name^=agree]").prop('checked', true);
            } else {
                $("input[name^=agree]").prop("checked", false);
            }
        });
    });
		
		
		function page_reload(){
		window.location.href='/';
	}
	
    </script>
</div>
<!-- } 회원가입 약관 동의 끝 -->
