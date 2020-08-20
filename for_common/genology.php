<?php
include_once('./_common.php');

include_once('../_head.php');


if ($mb_id_stx) {
	$mbs = get_member($mb_id_stx);
	$temp = sql_fetch("select * from {$g5['cn_tree']} where mb_id='{$member['mb_id']}' and smb_id='$mb_id_stx'");
	if (!$temp['smb_id']) {
	    $mbs = $member;
    }
} else {
    $mbs = $member;
}

function prnt_rows($result, $list_num) {
	
	global $g5,$sql_common,$sql_search,$sql_order,$member,$_in_sql,$mbs,$lv_color; 
	
	$str = '';
	
    for ($i=0; $row=sql_fetch_array($result); $i++) {
       
        $mb = get_member($row['smb_id']);	
		if (!$mb['mb_id']) {
		    continue;
        }
		
//		if ($mb['mb_13'] == '1') $color='red';
//		else if($mb['mb_13'] == '2') $color='orange';
//		else if($mb['mb_13'] == '3') $color='green';
//		else if($mb['mb_13'] == '4') $color='blue';
//        else if($mb['mb_13'] == '5') $color='purple';
//		else $color='black';
		
		$color='black';
		$mbs[mb_datetime]=substr($mbs[mb_datetime],0,10);
		
		$str.=",{\"key\":$mb[mb_no],\"name\":\"$mb[mb_name]\",\"mb_id\":\"$mb[mb_id]\",\"mb_recommender\":\"$mb[mb_recommend]\",\"mb_name\":\"$mb[mb_name]\",\"mb_datetime\":\"$mb[mb_datetime]\",\"mb_level_name\":\"{$class_name}\",\"borderColor\":\"$color\",\"boss\":\"$row[mb_no]\"}";
		
		//제한이 넘은경우		
		$mbtree = explode(",",$mb[mb_tree]);
		$keys = array_search($mbs[mb_id],$mbtree);
		
		if (count($mbtree) - $keys >= $list_num) {
		    continue;
        }
       
		$sql = " select a.*,b.mb_id bmb_id,b.mb_name,b.mb_tree,b.mb_recommend,b.mb_datetime {$sql_common} where a.mb_id='{$row['smb_id']}' and a.step='1'  {$sql_order} ";
		
		//echo $sql.'<br>';
		$_result = sql_query($sql,1);
		
		if (sql_num_rows($_result)) {
			$str2 = prnt_rows($_result,$list_num);
			if ($str2) {
			    $str .= $str2;
            }
		}
    }
	return $str;
}

$sql_common = " from {$g5['cn_tree']} as a left outer join {$g5['member_table']} as b on(a.smb_id=b.mb_id) ";
$sql_search = " where a.mb_id = '{$mbs['mb_id']}' ";

$sql_order = " order by a.step ,a.no desc";

$sql = " select a.*,b.mb_id bmb_id,b.mb_name,b.mb_recommend,b.mb_datetime {$sql_common} {$sql_search}  and a.step='1'  {$sql_order} ";
$result = sql_query($sql,1);

$list_num = isset($_POST['list_num']) ? $_POST['list_num'] : 10;
$chart_str=prnt_rows($result,$list_num);
?>
    <div class="wrap">       
       
        
        <!--div class="sec">
            <div class="countBtns">
                <li>+</li>
                <li>-</li>
            </div>
        </div-->
		
		 <div class="sec">
		 <form name='stepform'>
		 <input type='hidden' name='mb_id_stx' value='<?=$mb_id_stx?>' >
		 
		 <select name="list_num" onchange='this.form.submit();' >
            <?php
            for ($i=20 ;$i > 0;$i--) {
                if ($_POST['list_num'] == $i) {
                    echo "<option value='$i' selected>$i STEP</option>";
                } else {
                    echo "<option value='$i' >$i STEP</option>";
                }

            }
            ?>
			
        </select>
		</form>
		</div> 
		<div id="sample" style="position: relative;">
			<div id="myDiagramDiv" style="width:100%; height:65vh; background-color:rgba(0,0,0,0.6);"></div>
			<div id="myOverviewDiv"></div>
		</div>
		
		
		
		
    </div>
	

<!--엘리먼트 -->
<script src="<?=G5_THEME_URL?>/extend/go.js" type="text/javascript"></script>
<link href="<?=G5_THEME_URL?>/extend/go.css?ver=200713" rel="stylesheet" />
<script type="text/javascript">   

	var memberList = '[{"key":<?=$mbs[mb_no]?>,"name":"<?=$mbs[mb_name]?>","mb_id":"<?=$mbs[mb_id]?>","mb_recommender":"<?=$mbs[mb_recommend]?>","mb_name":"<?=$mbs[mb_name]?>","mb_datetime":"<?=substr($mbs[mb_datetime],0,10)?>","mb_level_name":"<?=$class_name[$mb[mb_13]?$mb[mb_13]:'0']?>","borderColor":"<?=$lv_color[$mb[mb_13]?$mb[mb_13]:'0']?>"}<?=$chart_str?>]';
	memberList = $.parseJSON(memberList);
	
	function init() {
		
		var $ = go.GraphObject.make;

		myDiagram =
        $(go.Diagram, "myDiagramDiv",  // the DIV HTML element
          {
            // Put the diagram contents at the top center of the viewport
            initialDocumentSpot: go.Spot.TopCenter,
            initialViewportSpot: go.Spot.TopCenter,
			initialScale:1,
            // OR: Scroll to show a particular node, once the layout has determined where that node is
            //"InitialLayoutCompleted": function(e) {
            //  var node = e.diagram.findNodeForKey(28);
            //  if (node !== null) e.diagram.commandHandler.scrollToPart(node);
            //},
			layout:$(go.TreeLayout,
                { angle: 90, nodeSpacing: 10, layerSpacing: 40, layerStyle: go.TreeLayout.LayerUniform })
			/*
            layout:
              $(go.TreeLayout,  // use a TreeLayout to position all of the nodes
                {
                  treeStyle: go.TreeLayout.StyleLastParents,
                  // properties for most of the tree:
                  angle: 90,
                  layerSpacing: 80,
                  // properties for the "last parents":
                  alternateAngle: 0,
                  alternateAlignment: go.TreeLayout.AlignmentStart,
                  alternateNodeIndent: 20,
                  alternateNodeIndentPastParent: 1,
                  alternateNodeSpacing: 20,
                  alternateLayerSpacing: 40,
                  alternateLayerSpacingParentOverlap: 1,
                  alternatePortSpot: new go.Spot(0.001, 1, 20, 0),
                  alternateChildPortSpot: go.Spot.Left
                })*/
          });

	  //var part = myDiagram.findPartForKey("1");
      //myDiagram.centerRect(part.actualBounds);		  
	  //positionComputation(myDiagram, new go.Point(Math.floor(0), Math.floor(0)));

      // define Converters to be used for Bindings
      function theNationFlagConverter(nation) {
        return "https://www.nwoods.com/go/Flags/" + nation.toLowerCase().replace(/\s/g, "-") + "-flag.Png";
      }

      function theInfoTextConverter(info) {
        var str = "";		
		if (info.mb_name) str += "\n"+ '<?=lng('이름')?> : '+ info.mb_name+'';
		//if (info.mb_id) str += "\n"+ '<?=lng('Invest')?> :$ '+ info.stake+'';
		//if (info.mb_level_name) str += "\n"+ '<?=lng('Class')?> :'+ info.mb_level_name;
		if (info.mb_datetime) str += "\n"+ '<?=lng('Date')?> :'+ info.mb_datetime;
			
		/*
		if(!info.sell_point) info.sell_point = 0;
		//str += "\n매출 합계: " + number_format(info.sell_point) + "$";
		str += "\n"+ '본인 매출 :'+ number_format(info.sell_point) + "$"; 	

        //if (info.sell_point) str += "\n매출 합계: " + number_format(info.sell_point);        
		//if (info.mb_line) str += "\n라인: " + info.mb_line;        
		if (info.mb_line) str += "\n"+ '라인 :'+ info.mb_line;       
        if (typeof info.boss === "number") {
          var bossinfo = myDiagram.model.findNodeDataForKey(info.boss);
          if (bossinfo !== null) {
            str += "\n\nReporting to: " + bossinfo.name;
          }
        }*/
        return str;
      }

      // define the Node template
      myDiagram.nodeTemplate =
        $(go.Node, "Auto",
          // the outer shape for the node, surrounding the Table
          $(go.Shape, "RoundedRectangle",
            { stroke: null, strokeWidth: 5 },
			new go.Binding("stroke", "borderColor"),
            /* reddish if highlighted, blue otherwise */
            new go.Binding("fill", "isHighlighted", function(h) { return h ? "#2281D2" : "#fff"; }).ofObject()),
          // a table to contain the different parts of the node
          $(go.Panel, "Table",
            { margin: 2,	 maxSize: new go.Size(200, NaN) },
            // the two TextBlocks in column 0 both stretch in width
            // but align on the left side
            $(go.RowColumnDefinition,
              {
                column: 0,
                stretch: go.GraphObject.Horizontal,
                alignment: go.Spot.Left
              }),
            // the name
            $(go.TextBlock,
              {
                row: 0, column: 0,
                maxSize: new go.Size(110, NaN), margin:1,
                font: "bold 16px Roboto, sans-serif",
                alignment: go.Spot.Top,
				textAlign: "center"
              },
              new go.Binding("text", "mb_id"),
			  new go.Binding("stroke", "isH	ighlighted", function(h) { return h ? "#fff" : "#000"; }).ofObject()),
            // the country flag
            $(go.Picture,
              {
                row: 0, column: 1, margin: 2,
                imageStretch: go.GraphObject.Uniform,
                alignment: go.Spot.TopRight
              },
              // only set a desired size if a flag is also present:
              new go.Binding("desiredSize", "nation", function() { return new go.Size(34, 26) }),
              new go.Binding("source", "nation", theNationFlagConverter)),
            // the additional textual information
            $(go.TextBlock,
              {
                row: 1, column: 0, columnSpan: 2,
                //font: "12px Roboto, sans-serif"
				font: "12px Roboto, sans-serif"
              },
              new go.Binding("text", "", theInfoTextConverter),
			  new go.Binding("stroke", "isHighlighted", function(h) { return h ? "#fff" : "#000"; }).ofObject())
          ),  // end Table Panel,
		  {"click":function(e, obj){location.href = "<?=$_SERVER[SCRIPT_NAME]?>?list_num=<?=$list_num?>&mb_id_stx=" + obj.jb.mb_id;}},
		  { selectionAdorned: false },

        );  // end Node

      // define the Link template, a simple orthogonal line
      myDiagram.linkTemplate =
        $(go.Link, go.Link.Orthogonal,
          { corner: 5, selectable: false },
          $(go.Shape, { strokeWidth: 4, stroke: "#000000" }));  // dark gray, rounded corner links


      // set up the nodeDataArray, describing each person/position
      var nodeDataArray = memberList;

      // create the Model with data for the tree, and assign to the Diagram
      myDiagram.model =
        $(go.TreeModel,
          {
            nodeParentKeyProperty: "boss",  // this property refers to the parent node data
            nodeDataArray: nodeDataArray
          });

      // Overview
      myOverview =
        $(go.Overview, "myOverviewDiv",  // the HTML DIV element for the Overview
          { observed: myDiagram, contentAlignment: go.Spot.Center });   // tell it which Diagram to show and pan
	myDiagram.addDiagramListener("LayoutCompleted",
      function(e) {
        searchDiagram();
		myDiagram.toolManager.draggingTool.isEnabled = false;

      });
    }
// the Search functionality highlights all of the nodes that have at least one data property match a RegExp
    function searchDiagram() {  // called by button
      var input = document.getElementById("mySearch");
      if (!input) return;
      input.focus();

      myDiagram.startTransaction("highlight search");

      if (input.value) {
        // search four different data properties for the string, any of which may match for success
        // create a case insensitive RegExp from what the user typed
        var regex = new RegExp(input.value, "i");
        var results = myDiagram.findNodesByExample({ name: regex },
          { nation: regex },
          { title: regex },
          { headOf: regex });
        myDiagram.highlightCollection(results);
        // try to center the diagram at the first node that was found
        if (results.count > 0) myDiagram.centerRect(results.first().actualBounds);
      } else {  // empty string only clears highlighteds collection
        myDiagram.clearHighlighteds();
      }

      myDiagram.commitTransaction("highlight search");
	}
    
  
	
	$(document).ready(function(){

	   init();

        $("select[name=stepChange]").on('change',function () {
            let tmpurl = document.URL.split('?');
            window.location.href = tmpurl[0] + '?step=' + $(this).find("option:selected").val();
        });
	});
</script>



<?

include_once('../_tail.php');
?>