<?
if($mb_id_stx){
	$mbs=get_member($mb_id_stx);	
	$temp=sql_fetch("select * from {$g5['cn_tree']} where mb_id='{$member['mb_id']}' and smb_id='$mb_id_stx'");
	if(!$temp[smb_id]) $mbs=$member;
}
else $mbs=$member;


function prnt_rows($result,$list_num){
	
	global $g5,$sql_common,$sql_search,$sql_order,$member, $_tree_db,$_tree_fd,$_in_sql; 
	$list_num++;
	
	if($list_num > 100) return;
	$str='';
    for ($i=0; $row=sql_fetch_array($result); $i++) {
       
        $mb = get_member($row['smb_id']);
		
		//본인 하부가 아닌경우 중지
		$tree=explode(",",$mb[$_tree_fd]);
		//if(!in_array($member['mb_id'],$tree)) continue;
		
		//수당내역
		$point=sql_fetch("select sum(amount) amount from {$g5['cn_point']}  where mb_id='{$member['mb_id']}'  and smb_id='{$row['smb_id']}' $_in_sql ",1);
		
		$str.='
		<li>
		<div><i class="fas fa-user-circle fa-2x btn-reload-tree" data-id="'.$mb['mb_id'].'" ></i></div>
        <p class="btn-user-info" data-id="'.$mb['mb_id'].'" >'.$mb['mb_id'].'</p>
		';		
       
		$sql = " select a.*,b.mb_id bmb_id,b.mb_name {$sql_common} where a.mb_id='{$row['smb_id']}' and a.step='1'  {$sql_order} ";
		
		//echo $sql.'<br>';
		$_result = sql_query($sql,1);
		
		if(sql_num_rows($_result)){
			
			$str2=prnt_rows($_result,$list_num);			
			if($str2) $str.='<ul>'.$str2.'</ul>';

		}
		$str.='</li>';
		
	
    }	
	return $str;
}


$sql_common = " from $_tree_db as a left outer join {$g5['member_table']} as b on(a.smb_id=b.mb_id) ";
$sql_search = " where a.mb_id = '{$mbs['mb_id']}' ";


$sql_order = " order by a.step ,b.mb_no asc";

$sql = " select a.*,b.mb_id bmb_id,b.mb_name {$sql_common} {$sql_search}  and a.step='1'  {$sql_order} ";
$result = sql_query($sql,1);


?>

<style>

.layerpop {
    display: none;
    z-index: 1000;
    border: 2px solid #ccc;
    background: #fff;
    cursor: move; 
	font-size:14px;
}


.layerpop_area .layerpop_close {
    width: 25px;
    height: 25px;
    display: block;
    position: absolute;
    top: 10px;
    right: 10px;
	color: #242424;
   }

.layerpop_area .layerpop_close:hover {    
	color: #0000ff;
   }
.layerpop_area .layerpop_data {
    width: 96%;    
    margin: 2%;
    color: #424242; 
}

.layerpop_area .layerpop_data p span{
	font-weight:600;
    color: #4242ff; 
}

</style>


<!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before particle-background" id="particle-background" > </div>  
            <div class="content-header row">
            </div>
            <div class="content-body" >
          	
            <div id="user-profile" >           

             <div class="card">
                <div class="card-header pb-0">
                    <div class="card-title-wrap bar-primary">
                        <div class="card-title"><?=$docu_title?>
						
						

					<div class='button-group button-group-sm float-right mt-0'>
					<button class='btn btn-dark btn-sm' id='btnScaleDown'>-</button>
					<button class='btn btn-light btn-sm' id='btnScaleNone'>1X</button>
					<button class='btn btn-dark btn-sm' id='btnScaleUp'>+</button>
					</div>

					</div>
						
                        <hr>
                    </div>
                </div>
                <div class="card-body p-0 overflow-hidden">
                    <div class="card-block" style='width:100%;min-height:100%;'>                                               
<?
if($mb_id_stx && $mb_id_stx != $member[mb_id]){?>
<a href="<?=$_SERVER[SCRIPT_NAME]?>" class='btn btn-dark btn-sm m-1' style='position:absolute;top;10px;left:10px;z-index:1001;' >RESET</a>
<? }?>
<div class="tree" >

	<ul style='transform-origin:top center;'>
    <li>  
	<div><i class="fas fa-user-circle fa-2x btn-reload-tree" data-id='<?=$mbs['mb_id']?>' ></i></div>
	<p class='btn-user-info' data-id='<?=$mbs['mb_id']?>' ><?=$mbs['mb_id']?></p>
	
	<? if(sql_num_rows($result) > 0){ ?>        
		<ul>
	<?
	echo prnt_rows($result,1);
	?>
		  </ul>
	<? }?>    
  </li>
</ul>
</div>


            
                    </div>
                </div>
            </div>
            
            
            
                </div>
                </div>
        </div>
    </div>
    <!-- END: Content-->


<!--Popup Start -->
<div id="layerbox" class="layerpop"
	style="width: 350px; height: 250px;">
	<article class="layerpop_area">	
	<a href="javascript:popupClose();" class="layerpop_close"
		id="layerbox_close"><i class="fas fa-times fa-2x"></i></a> <br>
		<div class="layerpop_data mx-auto p-2">

		</div>
	</article>
</div>
<!--Popup End -->



<script>
var dragCheck = false;
$( ".tree > ul" ).draggable({
      revert:false,
      drag: function(){
               // On drag set that flag to true
            dragCheck = true;
      },
      stop: function(){
               // On stop of dragging reset the flag back to false
            dragCheck = false;
      }
});


function popupOpen(htmls) {
	$('.layerpop').css("position", "absolute");
	$('.layerpop').css("top",(($(window).height() - $('.layerpop').outerHeight()) / 2) + $(window).scrollTop());
	$('.layerpop').css("left",(($(window).width() - $('.layerpop').outerWidth()) / 2) + $(window).scrollLeft());
	$('#layerbox .layerpop_data').html(htmls);
	$('#layerbox').show();
}

function popupClose() {
	$('#layerbox').hide();
}


var scale=1;
function scale_update(amt){
	scale+=amt;
	$('.tree>ul').css('transform', 'scale('+scale.toPrecision()+')');
}
function scale_reset(){
	scale=1;
	$('.tree>ul').css('transform', 'scale(1)');
}

$(document).ready(function(){
	$(".tree").bind('wheel mousewheel', function(e){
	
	event.preventDefault();
	var delta;

	if (e.originalEvent.wheelDelta !== undefined)
		delta = e.originalEvent.wheelDelta;
	else
		delta = e.originalEvent.deltaY * -1;

		if(delta > 0) {
			scale_update(0.07);
		}
		else{
			scale_update(-0.07);
		}
	});
		
	
	$('#btnScaleUp').on('click ',function(){
		scale_update(0.02)
	});
	$('#btnScaleDown').on('click',function(){
		scale_update(-0.02)
	});
	$('#btnScaleNone').on('click',function(){
		scale_reset()
	});
	
	
	$(".btn-reload-tree").on('click mouseup',function(){
		var mb_id_val=$(this).attr('data-id');
		document.location.href='<?=$_SERVER[SCRIPT_NAME]?>?mb_id_stx='+mb_id_val;
	});
	
	//var formData = $(f).serialize();				
	$(".btn-user-info").on('click mouseup',function(){
		
		var mb_id_val=$(this).attr('data-id');
		
		$.ajax({
			type: "POST",
			url: "./ajax.user.info.php",
			data:{mb_id:mb_id_val},
			cache: false,
			async: false,
			dataType:"json",
			success: function(data) {
				
				var htmls='';
				if(data.result==true){	
					
						htmls+='<p><?=lng('Member name')?> : <span>'+data.datas['mb_name']+'</span></p>'
						+'<p><?=lng('Join Date')?> : <span>'+data.datas['mb_datetime']+'</span></p>'
						+'<p><?=lng('Order amount')?> : <span>'+data.datas['stake_usd']+'</span></p>'
						+'<p><?=lng('Order PV')?> : <span>'+data.datas['stake_usd']+'</span></p>'
						+'<p><?=lng('Affiliate order amount')?> : <span>'+data.datas['aff_usd']+'</p>'
	
						popupOpen(htmls);

				}
				else{
					swal(data.message);   
				}
			}
		});		
	});


		
});
</script>
<?php
include_once('../_tail.php');
?>
