<head>
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
          font-size:26px;
          font-weight:900;
          
      }

      .cattleLabel {
          border-radius: 12px;
          border:#ffffff 1px dotted;
          padding-left:2px;
          padding-right:4px;
          background-color:#fcfcfc;
      }
      
      .addEntry {
          border-radius: 5px;
          padding-top:10px;
          width:100%;
          text-align:center;
          height:40px;
          background-color:#fff2cc;
          color:#000000;
          font-family:impact;
          font-size:30px;
          font-weight:900;
      }
      
      .healthEntry {
          border-radius: 5px;
          background-color:#cccccc;
          border:2px #ffffff solid;
          margin:4px;
          padding:4px;
          font-size:32px;
          /*float:left;*/

      }      
      .todoEntry_unfinished {
          border-radius: 5px;
          background-color:#e2f0d9;
          border:2px red solid;
          margin:4px;
          padding:4px;
          font-size:32px;
          /*float:left;*/

      }
      .todoEntry_finished {
          border-radius: 5px;
          background-color:#C7D6EB;
          border:2px #bbbbbb dashed;
          margin:4px;
          padding:4px;
          color:#bbbbbb;
          font-size:32px;
          /*float:left;*/

      }
      
   </style> 
</head>
<body bgcolor='#1A2D42'>
<?php
include("dbConnect.php");
date_default_timezone_set('Asia/Taipei');


   #*******************
   $conn = mysql_connect($dbhost, $dbuser, $dbpass) ; 
   mysql_query("SET NAMES 'UTF8'"); 
   mysql_query("SET time_zone = '+8:00';"); 
   mysql_select_db($dbname); 

   $today  = date('Y-m-d',strtotime("+0 days"));
   $today_plus6  = date('Y-m-d',strtotime("+6 days"));

   $sql = "SELECT A1.tagID, A1.timestamp, A1.text, A1.who, A2.simpleID, DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%m-%d') AS 'date_formatted' FROM `cattleHealthStatus` A1, `cattleBasicInfo` A2 WHERE A1.tagID = A2.tagID and FROM_UNIXTIME(A1.timestamp) BETWEEN '$today' AND '$today_plus6' LIMIT 0, 300";
   $result = mysql_query($sql); 

   $data_healthLog = array();
   while($row = mysql_fetch_assoc($result)){
      #print_R($row);
      $data_healthLog[$row['date_formatted']][] = $row;
   }//end while
   #print_R($data_healthLog);
   #*******************


   #*******************
   $sql = "SELECT A1.tagID, A1.timestamp, A1.task, A1.caseOpenedBy, A1.caseClosedBy, A2.simpleID, DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%m-%d') AS 'date_formatted' FROM `cattleTodo` A1, `cattleBasicInfo` A2 WHERE A1.tagID = A2.tagID and FROM_UNIXTIME(A1.timestamp) BETWEEN '$today' AND '$today_plus6' LIMIT 0, 300";
   $result = mysql_query($sql); 
   
   $data_todo = array();
   while($row = mysql_fetch_assoc($result)){
      #print_R($row);
      $data_todo[$row['date_formatted']][] = $row;
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




   $today        = date('n/j (D)');
   $today_plus1  = date('n/j (D)',strtotime("+1 days"));
   $today_plus2  = date('n/j (D)',strtotime("+2 days"));
   $today_plus3  = date('n/j (D)',strtotime("+3 days"));
   $today_plus4  = date('n/j (D)',strtotime("+4 days"));
   $today_plus5  = date('n/j (D)',strtotime("+5 days"));
   $today_plus6  = date('n/j (D)',strtotime("+6 days"));

   $today_index        = date('m-d');
   $today_index_plus1  = date('m-d',strtotime("+1 days"));
   $today_index_plus2  = date('m-d',strtotime("+2 days"));
   $today_index_plus3  = date('m-d',strtotime("+3 days"));
   $today_index_plus4  = date('m-d',strtotime("+4 days"));
   $today_index_plus5  = date('m-d',strtotime("+5 days"));
   $today_index_plus6  = date('m-d',strtotime("+6 days"));


#clock and room status monitor
echo "<iframe src='clock.php' width='1000' height='130' frameborder=0></iframe>";



#calendar dashboard
echo "<div style='border:0px red solid; width:1000px;overflow:auto;'>";
echo "<table border='3' cellpadding='0' cellspacing='0' style='font-size:18px; font-family: impact; border-radius:6px;' bordercolor='#eeeeee' width='2500' height='800'>";
  echo "<tr height='50'>";
    echo '<td width="1" style="color:white; background-color:#CCCCCC;"></td>';
    echo "<td width='300' class='calendarHeaderTD' style='background-color:#aaaaaa;'>過期未完成</td>";
    echo "<td width='300' class='calendarHeaderTD'>今天 $today</td>";
    echo "<td width='300' class='calendarHeaderTD'>$today_plus1</td>";
    echo "<td width='300' class='calendarHeaderTD'>$today_plus2</td>";
    echo "<td width='300' class='calendarHeaderTD'>$today_plus3</td>";
    echo "<td width='300' class='calendarHeaderTD'>$today_plus4</td>";
    echo "<td width='300' class='calendarHeaderTD'>$today_plus5</td>";
    echo "<td width='300' class='calendarHeaderTD'>$today_plus6</td>";
    echo "<td width='100' class='calendarHeaderTD' rowspan='4' style='background-color:#aaaaaa;'>下<br>周</td>";
  echo '</tr>';

  echo "<tr height='400'>";
    echo "<td style='color:black; background-color:#CCCCCC;' valign='top'><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>";


    echo "<td style='color:black; background-color:#eeeeee;' valign='top' rowspan=3>";
      foreach($data_todo_oldUnfinished as $eachEntry){
         if($eachEntry['caseClosedBy']!='') $tmp = "todoEntry_finished";
         else $tmp = "todoEntry_unfinished";
         
         echo "<div class='$tmp'>";      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
         echo $eachEntry['task']; 
         echo "</div>"; 
      }//end foreach
    echo "</td>";
        


    echo "<td style='color:black; background-color:#FBE5D6;' valign='top'>";
    foreach($data_healthLog[$today_index] as $eachEntry){
      $query = "type=healthEntry&"."tagId=".$eachEntry['tagID'];
      echo "<div class='healthEntry' onclick='location.href=\"./editRecord.php?$query\"'>";
      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['text'];
      echo "</div>";    }//end foreach
    echo "</td>";
    
    
    
    echo "<td style='color:black; background-color:#D2DEEF;' valign='top'>";
    foreach($data_healthLog[$today_index_plus1] as $eachEntry){
      echo "<div class='healthEntry'>";
      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['text']; 
      echo "</div>";    }//end foreach
    echo "</td>";
    
    echo "<td style='color:black; background-color:#D2DEEF;' valign='top'>";
    foreach($data_healthLog[$today_index_plus2] as $eachEntry){
      echo "<div class='healthEntry'>";
      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['text']; 
      echo "</div>";    }//end foreach
    echo "</td>";
    
    echo "<td style='color:black; background-color:#D2DEEF;' valign='top'>";
    foreach($data_healthLog[$today_index_plus3] as $eachEntry){
      echo "<div class='healthEntry'>";
      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['text']; 
      echo "</div>";
    }//end foreach
    echo "</td>";


    echo "<td style='color:black; background-color:#D2DEEF;' valign='top'>";
    foreach($data_healthLog[$today_index_plus4] as $eachEntry){
      echo "<div class='healthEntry'>";
      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['text']; 
      echo "</div>";    }//end foreach
    echo "</td>";
    
    echo "<td style='color:black; background-color:#D2DEEF;' valign='top'>";
    foreach($data_healthLog[$today_index_plus5] as $eachEntry){
      echo "<div class='healthEntry'>";
      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['text']; 
      echo "</div>";    }//end foreach
    echo "</td>";
    
    echo "<td style='color:black; background-color:#D2DEEF;' valign='top'>";
    foreach($data_healthLog[$today_index_plus6] as $eachEntry){
      echo "<div class='healthEntry'>";
      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['text']; 
      echo "</div>";
    }//end foreach
    echo "</td>";
    
    
    
  echo '</tr>';


  echo "<tr height='400'>";
    echo "<td style='color:black; background-color:#CCCCCC;' valign='top'><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>";
    
    
    echo "<td style='color:black; background-color:#FBE5D6;' valign='top'>";
    foreach($data_todo[$today_index] as $eachEntry){
      if($eachEntry['caseClosedBy']!='') $tmp = "todoEntry_finished";
      else $tmp = "todoEntry_unfinished";
      
      echo "<div class='$tmp'>";      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['task']; 
      echo "</div>";    }//end foreach
    echo "</td>";
    
    
    
    echo "<td style='color:black; background-color:#D2DEEF;' valign='top'>";
    foreach($data_todo[$today_index_plus1] as $eachEntry){
      if($eachEntry['caseClosedBy']!='') $tmp = "todoEntry_finished";
      else $tmp = "todoEntry_unfinished";
      
      echo "<div class='$tmp'>";      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['task']; 
      echo "</div>";    }//end foreach
    echo "</td>";
    
    echo "<td style='color:black; background-color:#D2DEEF;' valign='top'>";
    foreach($data_todo[$today_index_plus2] as $eachEntry){
      if($eachEntry['caseClosedBy']!='') $tmp = "todoEntry_finished";
      else $tmp = "todoEntry_unfinished";
      
      echo "<div class='$tmp'>";      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['task']; 
      echo "</div>";    }//end foreach
    echo "</td>";
    
    echo "<td style='color:black; background-color:#D2DEEF;' valign='top'>";
    foreach($data_todo[$today_index_plus3] as $eachEntry){
      if($eachEntry['caseClosedBy']!='') $tmp = "todoEntry_finished";
      else $tmp = "todoEntry_unfinished";
      
      echo "<div class='$tmp'>";      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['task']; 
      echo "</div>";
    }//end foreach
    echo "</td>";
    
    
    echo "<td style='color:black; background-color:#D2DEEF;' valign='top'>";
    foreach($data_todo[$today_index_plus4] as $eachEntry){
      if($eachEntry['caseClosedBy']!='') $tmp = "todoEntry_finished";
      else $tmp = "todoEntry_unfinished";
      
      echo "<div class='$tmp'>";      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['task']; 
      echo "</div>";
    }//end foreach
    echo "</td>";
    
    echo "<td style='color:black; background-color:#D2DEEF;' valign='top'>";
    foreach($data_todo[$today_index_plus5] as $eachEntry){
      if($eachEntry['caseClosedBy']!='') $tmp = "todoEntry_finished";
      else $tmp = "todoEntry_unfinished";
      
      echo "<div class='$tmp'>";      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['task']; 
      echo "</div>";
    }//end foreach
    echo "</td>";

    echo "<td style='color:black; background-color:#D2DEEF;' valign='top'>";
    foreach($data_todo[$today_index_plus6] as $eachEntry){
      if($eachEntry['caseClosedBy']!='') $tmp = "todoEntry_finished";
      else $tmp = "todoEntry_unfinished";
      
      echo "<div class='$tmp'>";      echo "<font class='cattleLabel'>".$eachEntry['simpleID']."</font> ";
      echo $eachEntry['task']; 
      echo "</div>";
    }//end foreach
    echo "</td>";

    
    
  echo '</tr>';


  echo "<tr height='50'>";
    echo "<td style='color:black; background-color:#cccccc;'></td>";
    echo "<td style='color:black; background-color:#FBE5D6;font-weight:900;'><div class='addEntry' onclick='javascript:location.href=\"editRecord.php?datePointer=0\"'>Add</div></td>";
    echo "<td style='color:black; background-color:#D2DEEF;font-weight:900;'><div class='addEntry' onclick='javascript:location.href=\"editRecord.php?datePointer=1\"'>Add</div></td>";
    echo "<td style='color:black; background-color:#D2DEEF;font-weight:900;'><div class='addEntry' onclick='javascript:location.href=\"editRecord.php?datePointer=2\"'>Add</div></td>";
    echo "<td style='color:black; background-color:#D2DEEF;font-weight:900;'><div class='addEntry' onclick='javascript:location.href=\"editRecord.php?datePointer=3\"'>Add</div></td>";
    echo "<td style='color:black; background-color:#D2DEEF;font-weight:900;'><div class='addEntry' onclick='javascript:location.href=\"editRecord.php?datePointer=4\"'>Add</div></td>";
    echo "<td style='color:black; background-color:#D2DEEF;font-weight:900;'><div class='addEntry' onclick='javascript:location.href=\"editRecord.php?datePointer=5\"'>Add</div></td>";
    echo "<td style='color:black; background-color:#D2DEEF;font-weight:900;'><div class='addEntry' onclick='javascript:location.href=\"editRecord.php?datePointer=6\"'>Add</div></td>";
  echo '</tr>';
echo '</table>';
echo "</div>";

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
