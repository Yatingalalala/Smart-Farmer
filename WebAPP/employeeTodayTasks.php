<head>
<script language="javascript" src="http://tts.itri.org.tw/TTScript/Text2SpeechJsApiV2.php?key=5775*2133*2A*14*2A*3E7*3E7*3E7"></script>

   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <style type="text/css"> 
      /*div round cornor*/
      .rcorners1 {
          border-radius: 5px;
      }

      .calendarHeaderTD {
          color:white; 
          background-color:#5B9BD5;
          text-align:center;
          font-family:impact;
          font-size:32px;
          font-weight:900;
          
      }

      .cattleLabel {
          border-radius: 12px;
          border:#ffffff 1px dotted;
          padding-left:2px;
          padding-right:4px;
          background-color:#fcfcfc;
      }
      
    
      .todoEntry_unfinished {
          border-radius: 5px;
          background-color:#e2f0d9;
          border:2px red solid;
          margin:4px;
          padding:4px;
          font-size:32px;
          float:left;
      }
      .todoEntry_finished {
          border-radius: 5px;
          background-color:#C7D6EB;
          border:2px #bbbbbb dashed;
          margin:4px;
          padding:4px;
          color:#bbbbbb;
          font-size:32px;
          float:left;
      }
      
   </style> 
</head>
<body bgcolor='#1A2D42' onload='javascript:t2s();'>
<?php
include("dbConnect.php");
date_default_timezone_set('Asia/Taipei');


   #*******************
   $conn = mysql_connect($dbhost, $dbuser, $dbpass) ; 
   mysql_query("SET NAMES 'UTF8'"); 
   mysql_query("SET time_zone = '+8:00';"); 
   mysql_select_db($dbname); 
   $tastCounter = 0;
   $today  = date('Y-m-d',strtotime("+0 days"));
   $today_plus1  = date('Y-m-d',strtotime("+1 days"));

   $sql = "SELECT A1.tagID, A1.timestamp, A1.task, A1.caseOpenedBy, A1.caseClosedBy, A2.simpleID, DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%m-%d') AS 'date_formatted' FROM `cattleTodo` A1, `cattleBasicInfo` A2 WHERE A1.tagID = A2.tagID and FROM_UNIXTIME(A1.timestamp) BETWEEN '$today' AND '$today_plus1' LIMIT 0, 300";
   $result = mysql_query($sql); 
   
   $data_todo = array();
   while($row = mysql_fetch_assoc($result)){
      #print_R($row);
      $data_todo[$row['date_formatted']][] = $row;
      $tastCounter++;
   }//end while
   #print_R($data_todo);
   
   #*******************
   $sql = "SELECT A1.tagID, A1.timestamp, A1.task, A1.caseOpenedBy, A1.caseClosedBy, A2.simpleID, DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%m-%d') AS 'date_formatted' FROM `cattleTodo` A1, `cattleBasicInfo` A2 WHERE A1.tagID = A2.tagID and A1.caseClosedBy='' and FROM_UNIXTIME(A1.timestamp) < '$today' LIMIT 0, 300";
   $result = mysql_query($sql); 
   
   $data_todo_oldUnfinished = array();
   while($row = mysql_fetch_assoc($result)){
      #print_R($row);
      $data_todo_oldUnfinished[] = $row;
   }//end while
   #echo "<pre><p style='color:#ffffff;'>";print_R($data_todo_oldUnfinished);echo "</p></pre>";exit;
   
   #*******************
   mysql_close($conn);


#echo time()."\n\n";
$tastCounter += count($data_todo_oldUnfinished);
$tts_string = "總共有 $tastCounter 件工作，要在下班前完成。";



   $today        = date('n/j (D)');
   $today_plus1  = date('n/j (D)',strtotime("+1 days"));


   $today_index        = date('m-d');





#calendar dashboard
echo "<table border='3' cellpadding='0' cellspacing='0' style='height:100%;font-size:18px; font-family: impact; border-radius:6px;' bordercolor='#eeeeee' width='100%'>";
  
  echo "<tr style='height:140px;'>";
    echo "<td width='100%' class='calendarHeaderTD' style='background-color:#1A2D42;' colspan='2'>";
    echo "<iframe src='clock.php' width='1000' height='130' frameborder=0></iframe>";
    echo "</td>";
  echo '</tr>';


  echo "<tr style='height:60px;'>";
    //echo '<td width="1" style="color:white; background-color:#CCCCCC;"></td>';
    echo "<td width='50%' class='calendarHeaderTD' style='background-color:#aaaaaa;'>過期未完成</td>";
    echo "<td width='50%' class='calendarHeaderTD'>$today</td>";
  echo '</tr>';

  echo '<tr>';
    //echo "<td style='color:black; background-color:#CCCCCC;' valign='top'><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>";


    echo "<td style='color:black; background-color:#eeeeee;' valign='top' >";
      foreach($data_todo_oldUnfinished as $eachEntry){
         if($eachEntry['caseClosedBy']!='') $tmp = "todoEntry_finished";
         else $tmp = "todoEntry_unfinished";
         
         echo "<div class='$tmp'>";      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
         echo $eachEntry['task']; 
         echo "</div>"; 
      }//end foreach
    echo "</td>";
        
    
    
    echo "<td style='color:black; background-color:#FBE5D6;' valign='top'>";
    foreach($data_todo[$today_index] as $eachEntry){
      if($eachEntry['caseClosedBy']!='') $tmp = "todoEntry_finished";
      else $tmp = "todoEntry_unfinished";
      
      echo "<div class='$tmp'>";      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['task']; 
      echo "</div>";    }//end foreach
    echo "</td>";
    
    
    

  echo '</tr>';
echo '</table>';

?>
</body>


<script>
var snd1 = new Audio("beep-01a.wav");
var snd2 = new Audio("beep-07.wav");  

function beep1() {
  snd1.play();
}

function beep2() { 
  snd2.play();
}

//beep2();
//setTimeout(function(){ beep2(); }, 200);
//setTimeout(function(){ beep2(); }, 400);
//setTimeout(function(){ beep1(); }, 400);

//setInterval(beep2, 300);
</script>



<script>
document.write('<div style="background-color:#cccccc;display:none;"><div id="ttswrapper"><select id="ttsspeaker"><option value=0>---語者---</option><option value="Bruce">Bruce</option><option value="Theresa">Theresa</option><option value="Angela">Angela</option></select><select id="ttsvol"><option value=0>---音量---</option><option value="100">大</option><option value="50">中</option><option value="0">小</option></select><select id="ttsspeed"><option value=0>---速度---</option><option value="10">快</option><option value="0">普通</option><option value="-10">慢</option></select><select id="ttseffect" onchange="optionSelect(this);"><option value=0>---效果---</option><option value="0&0&5">正常韻律</option><option value="0&2&5">外國人</option><option value="0&1&5">機器人</option><option value="other">韻律調整</option></select>音高準位(-10~10)<input type="text" id="pitchLevel" name="pitchLevel" disabled value=0>音高方向(&emsp;0~ 2)<input type="text"  id="pitchSign" name="pitchSign" disabled value=0>音高振幅(&ensp; 0~20)<input type="text"  id="pitchScale" name="pitchScale" disabled value=5><textarea id="ttstext"><?php echo $tts_string;?></textarea><span id="ttsmedia"></span><button id="ttssubmit" type="button">送出</button></div></div>');
document.write('<style>#ttswrapper *{margin:0;padding:0;}#ttswrapper{position:relative;width:200px;height:255px;border:1px solid black;padding:5px;margin:0;}#ttswrapper textarea{width:190px;height:60px;}#ttswrapper button{float:left;width:40px;}#ttsmedia{width:160px;height:30px;overflow:hidden;float:left;}#ttsmedia audio{width:160px;clear:both;}#ttswrapper input{width:58px;margin:0 0 0 10px;} #ttswrapper select{width:195px;}</style>');


	document.getElementById("ttssubmit").onclick=t2s;
	function t2s(){
        document.getElementById("ttsmedia").innerHTML="";
	    document.getElementById("ttssubmit").disabled=true;
		var speaker=document.getElementById("ttsspeaker").value;
		var vol=document.getElementById("ttsvol").value;
		var speed=document.getElementById("ttsspeed").value;
		var effect=document.getElementById("ttseffect").value;
		var text=document.getElementById("ttstext").value;
		var pitchLevel=document.getElementById("pitchLevel").value;
		var pitchSign=document.getElementById("pitchSign").value;
		var pitchScale=document.getElementById("pitchScale").value;
        if(text.length>250){
            alert("字數請少於250字(含標點符號)!\n目前字數:"+text.length);
            return;
        }
		if(speaker==0){
			//alert("請選擇語者");
            document.getElementById("ttsspeaker").options[1].selected = true;
		}
		if(vol==0){
			document.getElementById("ttsvol").options[1].selected = true;
		}
		if(speed == 0){
			document.getElementById("ttsspeed").options[2].selected = true;
		}
        if(effect == 0){
            document.getElementById("ttseffect").options[1].selected = true;
        }
        if(pitchLevel<-10){
            document.getElementById("pitchLevel").value=-10;
            pitchLevel=-10;
        }
        if(pitchLevel>10){
            document.getElementById("pitchLevel").value=10;
            pitchLevel=10 
        }
        if(pitchSign<0){
            document.getElementById("pitchSign").value=0;
            pitchSign=0;
        }
        if(pitchSign>2){
            document.getElementById("pitchSign").value=2;
            pitchSign=2 
        }
        if(pitchScale<0){
            document.getElementById("pitchScale").value=0;
            pitchScale=0;
        }
        if(pitchScale>20){
            document.getElementById("pitchScale").value=20;
            pitchScale=20 
        } 
        //document.getElementById("ttsmedia").innerHTML="請稍等..";
        var itritts= new TTS();
        itritts.PlayerSet.hidden=false;
		if(!pitchLevel && !pitchSign && !pitchScale){
			itritts.ConvertCustom('id:ttstext','ttsmedia',speaker,vol,speed,0,0,5);
		}else{
			itritts.ConvertCustom('id:ttstext','ttsmedia',speaker,vol,speed,pitchLevel,pitchSign,pitchScale);
		}
        //document.getElementById("ttssubmit").disabled=false;
        interval = setInterval(
            function(){
                if(document.getElementById("ttsmedia").childNodes.length>0){
                    clearInterval(interval);
                    document.getElementById("ttssubmit").disabled=false;
                }
            
            }
            ,100
        );
		
	}
	function optionSelect(obj){
		if(obj.value=="other"){
			document.getElementById("pitchLevel").disabled=false;
			document.getElementById("pitchSign").disabled=false;
			document.getElementById("pitchScale").disabled=false;
		}else if(obj.value==0) {
            document.getElementById("pitchLevel").disabled=true;
			document.getElementById("pitchSign").disabled=true;
			document.getElementById("pitchScale").disabled=true;
		}else{
			document.getElementById("pitchLevel").disabled=true;
			document.getElementById("pitchSign").disabled=true;
			document.getElementById("pitchScale").disabled=true;
			var effectValueAry = obj.value.split("&");
			var pitchLevel = effectValueAry[0];
			var pitchSign = effectValueAry[1];
			var pitchScale = effectValueAry[2];
			document.getElementById("pitchLevel").value = pitchLevel;
			document.getElementById("pitchSign").value = pitchSign;
			document.getElementById("pitchScale").value = pitchScale;
		}
	}


</script>
