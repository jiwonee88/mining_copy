
$(document).ready(function() {   
	$('.back').click(function(){
		history.back();	
	});
    /* 모바일뷰메뉴 숨기기 */
    $('.menuBg').click(function(){
        $('.menu').css({display: 'none'}, 700);
        $('.menuBg').css({display: 'none'}, 700);
    });
    
    /* 모바일뷰메뉴 노출 */
   $('.menuBtn').click(function(){
        $('.menu').css({display: 'block'}, 700);
        $('.menuBg').css({display: 'block'}, 700);
     });
    
    /* 아이디 활성화 여부 체크시 전송버튼 토글 */
    //$('.activeId .IdSelect > label').click(function(){
       //  $(this).parent().parent().toggleClass('IdDisable');
   // });
    
    /* 언어 하위메뉴 노출*/
    $('.lang span').click(function(){
         $(this).next().stop().slideToggle();
    });
    
   
});   

