<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>


<!-- 페이지 리로딩용 폼-->
<form name='_langsetForm' id='_langsetForm' action="<?=$_SERVER['REQUEST_URI']?>" method='post'>
<? 
foreach($_POST as $k => $v){
		$k=trim($k);		
		
		if(is_array($v)){
			foreach($v as $k2 => $v2){
				echo "<input type=\"hidden\" name=\"".$v['$k2']."\" value=\"".$v2."\" />";						
			}
		}
		else echo "<input type=\"hidden\" name=\"$k\" value=\"".$v."\" />";						
	}
	?>
</form>

<script>
//언어변경
function lang_set(lng){
	
	$.ajax({	
		   type: "POST",
		   url: "<?=G5_URL?>/lang/lang.ajax.php",
		   data:{lang_set:lng},
		   success: function(d)	
		   {
			 	console.log('d');
				document._langsetForm.submit(); 
			   	
		   },error:function(msg,status,e)
		   {
			   console.log('a');
		   }
	});
	
	
}

</script>
<!---

<?
foreach( $g5['lng_history'] as $langs){
echo $langs."\n";
}?>

---->
</body>
</html><?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>