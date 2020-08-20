<?php

include_once('./_common.php');

$outer_css=' store';

add_javascript('<script src="'.G5_THEME_URL.'/extend/clipboard.min.js"></script>',1);
include_once('../_head.php');

?>
      
    <style>
        .store .wrap .area ul.tabs {
            margin: 0px;
            padding: 0px;
            list-style: none;
            text-align: center;
            font-size: 0;
            padding: 10px 5px;
            border-radius: 3px;
            border: 1px solid #ffe25c;
        }

        .store .wrap .area ul.tabs li {
            width: 25%;
            background: none;
            color: #fff;
            display: inline-block;
            cursor: pointer;
            font-size: 14px;
            background: url(../images/staticBtn2.png) no-repeat;
            background-size: 100% 100%;
            min-height: 1rem;
            letter-spacing: 1px;
        }

        .store .wrap .area ul.tabs li.current {
            background: url(../images/staticBtn.png) no-repeat;
            background-size: 100% 100%;
            color: #ffe25c;
        }

        .store .wrap .area .tab-content {
            width: 100%;
            border-radius: 10px;
            margin: 0 auto;
            display: none;
            background: #ededed;
            background: #000;
            border: #fff 1px solid;
            margin-top: 30px;
            min-height: 400px;
        }

        .store .wrap .area .tab-content.current {
            display: inherit;
        }

        .store .wrap .area .tab-content table {
            width: 100%;
            text-align: center;
            font-size: 13px;

        }

        .store .wrap .area .tab-content table th {
            padding: 10px 0;
            font-size: 14px;
        }

        .store .wrap .area .tab-content table td {
            padding: 5px 0;
        }
    </style>

        <div class="wrap">

            <div class="area">
                <ul class="tabs">
                    <li class="tab-link current" data-tab="tab-1">골드내역</li>
                    <li class="tab-link" data-tab="tab-2">스톤내역</li>
                    <li class="tab-link" data-tab="tab-3">상점내역</li>
                    <li class="tab-link" data-tab="tab-4">포인트내역</li>
                </ul>

                <div id="tab-1" class="tab-content current">
                    <table>
                        <thead>
                            <tr>
                                <th width="25%">날짜</th>
                                <th width="30%">종류</th>
                                <th width="25%">수량</th>
                                <th width="20%">내용</th>
                            </tr>
                        </thead>
                        <!--tbody>
                            <tr>
                                <td>2020-05-09</td>
                                <td>사파이어</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                            <tr>
                                <td>2020-05-09</td>
                                <td>루비</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                            <tr>
                                <td>2020-05-09</td>
                                <td>에메랄드</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr-->
                        </tbody>
                    </table>
                </div>
				
				
                <div id="tab-2" class="tab-content">
                    <table>
                        <thead>
                            <tr>
                                <th width="25%">날짜</th>
                                <th width="30%">종류</th>
                                <th width="25%">수량</th>
                                <th width="20%">내용</th>
                            </tr>
                        </thead>
                        <!--tbody>
                            <tr>
                                <td>2020-05-09</td>
                                <td>사파이어</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                            <tr>
                                <td>2020-05-09</td>
                                <td>루비</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                            <tr>
                                <td>2020-05-09</td>
                                <td>에메랄드</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                            <tr>
                                <td>2020-05-09</td>
                                <td>에메랄드</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                            <tr>
                                <td>2020-05-09</td>
                                <td>에메랄드</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                            <tr>
                                <td>2020-05-09</td>
                                <td>에메랄드</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                        </tbody-->
                    </table>
                </div>
				
				
                <div id="tab-3" class="tab-content">
                    <table>
                        <thead>
                            <tr>
                                <th width="25%">날짜</th>
                                <th width="30%">종류</th>
                                <th width="25%">수량</th>
                                <th width="20%">내용</th>
                            </tr>
                        </thead>
                        <!--tbody>
                            <tr>
                                <td>2020-05-09</td>
                                <td>사파이어</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                            <tr>
                                <td>2020-05-09</td>
                                <td>루비</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                            <tr>
                                <td>2020-05-09</td>
                                <td>에메랄드</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                            <tr>
                                <td>2020-05-09</td>
                                <td>에메랄드</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                        </tbody-->
                    </table>
                </div>
				
				
                <div id="tab-4" class="tab-content">
                    <table>
                        <thead>
                            <tr>
                                <th width="25%">날짜</th>
                                <th width="30%">종류</th>
                                <th width="25%">수량</th>
                                <th width="20%">내용</th>
                            </tr>
                        </thead>
                        <!--tbody>
                            <tr>
                                <td>2020-05-09</td>
                                <td>사파이어</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                            <tr>
                                <td>2020-05-09</td>
                                <td>루비</td>
                                <td>123</td>
                                <td>매도</td>
                            </tr>
                        </tbody-->
                    </table>
                </div>
				
				
            </div>
        </div>
		
    <script>
        $(document).ready(function () {

            $('ul.tabs li').click(function () {
                var tab_id = $(this).attr('data-tab');

                $('ul.tabs li').removeClass('current');
                $('.tab-content').removeClass('current');

                $(this).addClass('current');
                $("#" + tab_id).addClass('current');
            })

        })
    </script>

<?	
include_once('../_tail.php');
?>
