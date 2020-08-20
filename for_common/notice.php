<?php
include_once('./_common.php');

include_once('../_head.php');


$sql_common = " from {$g5['new_win_table']} a ";
$sql_search = " where  (1) ";


$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_search_add}";
$row = sql_fetch($sql,1);
$total_count = $row['cnt'];

$rows =15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql_order = "  order by nw_id desc  ";

$sql = " select a.*  $fields {$sql_common} {$sql_search}  {$sql_search_add} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

?>

	
                <div  class="tab-content current">

                    <table class='table table-sm table-borderd' >
                        <thead>
                           <tr>
						<th style='width:35%;'><?=lng('날짜')?></th>
						<th style='width:65%;'><?=lng('내용')?></th>
						</tr>
                        </thead>
                        <tbody class='text-narrow0' >
						<?php
	$list_num = $total_count - ($page - 1) * $rows;
	
    for ($i=0; $row=sql_fetch_array($result); $i++) {


    ?>
                            <tr>
                                <td><?php echo substr($row['nw_begin_time'],2,8); ?></td>
                                <td >
								<a href='./notice.view.php?nw_id=<?=$row[nw_id]?>&<?=$qstr?>' style='display:inline-block;width:60vw;overflow:hidden;tex-overflow:ellipsis;' class='text-dark'><?php echo $row['nw_subject']; ?></a></td>
                            </tr>
	<?php
	$list_num--;
    }
    if ($i == 0)
        echo '<tr><td colspan="2" class="empty_table py-">'.lng("내역이 없습니다").'</td></tr>';
    ?>
     
                        </tbody>
                    </table>
					
<div class='w-100 my-3 d-block'>
 <?=com_pager_print($total_page,$page,5,"&year_stx=$year_stx&history_page=$history_page&page=");?>
 </div>		
        
		
                </div>


     

<?	
include_once('../_tail.php');
?>