<?php
include_once('./_common.php');
add_javascript('<script src="'.G5_THEME_URL.'/extend/clipboard.min.js"></script>',1);

include_once('../_head.php');
?>
    <div class="wrap">       
        
        
        <div class="topCommon">   
            <div class="userInfo">
                <img src="<?=G5_THEME_URL?>/images/historyBg.svg">
                <ul class="btnGroup">
                    <li class="Btn active"><a href="#">골드내역</a></li>
                    <li class="Btn"><a href="#">상점내역</a></li>
                </ul>                
            </div>  
        </div>
        
        <div class="sec">
            <div class="longBtn Btn w_btn"><a><span>2020 - 06</span></a></div>
            <div>
                <table>
                    <tr>
                        <th>날짜</th>
                        <th>수량</th>
                        <th>내용</th>
                    </tr>
                    <tr>
                        <td class="w1">2020-06-28</td>
                        <td class="w2">200</td>
                        <td class="w3">Transfer deposit</td>
                    </tr>
                    <tr>
                        <td class="w1">2020-06-28</td>
                        <td class="w2">-200</td>
                        <td class="w3">Transfer withdrawal</td>
                    </tr>
                    <tr>
                        <td class="w1">2020-06-28</td>
                        <td class="w2">1,000</td>
                        <td class="w3">JoinBonus</td>
                    </tr>
                </table>
            </div>            
        </div>
        <div class="pagination">
            <li class="active">1</li>
            <li>2</li>
            <li>3</li>
        </div>
    </div>
 
<?	
include_once('../_tail.php');
?>