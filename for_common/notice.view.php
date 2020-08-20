<?php
include_once('./_common.php');

add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/css/sub07.css">',1);

include_once('../_head.php');


$sql = " select *  from {$g5['new_win_table']} where nw_id='$nw_id'";
$data = sql_fetch($sql);

?>
<style>
.tab-content img {max-width:100%;}
</style>
     
	
                <div  class="tab-content current w-95 mx-auto">

<p class='border-bottom py-2 text-dark' style='word-break:break-all;word-wrap:break-word;text-align:left;' ><?php echo $data['nw_subject']; ?></p>
        
<div style='width:100%;word-break:break-all;word-wrap:break-word;' class='text-dark' >		
<?php echo $data['nw_content']; ?>				
</div>

		
                </div>
<div class='w-100 my-3 d-block text-center'>
<a href='./notice.php?<?=$qstr?>' class='smallBtn'><?=lng('목록으로')?></a>
 </div>		
        

     

  </div>
  

<?	
include_once('../_tail.php');
?>