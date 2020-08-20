<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>


  </div>	

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