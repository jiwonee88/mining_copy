<?php
$sub_menu = "200100";

include_once('./_common.php');

$g5['title'] .= '회원 설정 엑셀 반영';
include_once('./admin.head.php');
    
?>

<form name="fmember" id="fmember" action="./member_excel_config_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<div class="tbl_frm01 tbl_wrap">
    <table>
        <tr>
            <th>설정파일 선택</th>
            <td><input type="file" name="excel_origin" id="" /></td>
            <td><button type="submit" class="btn_submit btn" style="height:30px;width:120px">저장</button></td>
        </tr>
    </table>
</div>

</form>

<script>


$(function(){

	//추천인 변경
	$(".change-recommend").on("click", function(e){
		$("input[name='w']").val('p');			
		
		 var f = document.fmember;
        var token = get_ajax_token();

        if(!token) {
            alert("토큰 정보가 올바르지 않습니다.");
            return false;
        }

        var $f = $(f);

        if(typeof f.token === "undefined")
            $f.prepend('<input type="hidden" name="token" value="">');

        $f.find("input[name=token]").val(token);

		$f.submit();
		return ;
	});
})
function fmember_submit(f)
{	
	/*
    if (!f.mb_icon.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_icon.value) {
        alert('아이콘은 이미지 파일만 가능합니다.');
        return false;
    }

    if (!f.mb_img.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_img.value) {
        alert('회원이미지는 이미지 파일만 가능합니다.');
        return false;
    }
	*/

    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>
