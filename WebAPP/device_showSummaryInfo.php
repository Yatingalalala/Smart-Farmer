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
          border-radius: 10px;
          border:#ffffff 1px dotted;
          padding-top:10px;
          padding-left:2px;
          padding-right:4px;
          background-color:#fcfcfc;
          height:100px;
          color:#000000;
          width:400px;
          text-align:center;
          font-family:impact;
          font-size:70px;
          font-weight:900;
          border:3px #aaaaaa solid;
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
          
      }      
      .todoEntry_unfinished {
          border-radius: 5px;
          background-color:#e2f0d9;
          border:0px red solid;
          margin:4px;
          margin-top:30px;
          margin-bottom:20px;
          padding:4px;
          padding-top:20px;
          /*font-family:impact;*/
          font-size:80px;
          font-weight:900;
          height:240px;
      }
      .todoEntry_unfinished_old {
          border-radius: 5px;
          background-color:#e2f0d9;
          border:2px black solid;
          margin:4px;
          margin-top:30px;
          margin-bottom:20px;
          padding:4px;
          padding-top:20px;
          /*font-family:impact;*/
          font-size:80px;
          font-weight:900;
          color:black;
          height:240px;

      }
      .todoEntry_finished {
          border-radius: 5px;
          background-color:#e2f0d9;
          border:2px #bbbbbb dashed;
          margin:4px;
          margin-top:30px;
          margin-bottom:20px;
          padding:4px;
          padding-top:20px;
          color:#bbbbbb;
          /*font-family:impact;*/
          font-size:80px;
          font-weight:900;
          height:240px;

      }
      .taskText {
          margin:4px;
          margin-top:30px;
          margin-bottom:20px;
          padding:4px;
          padding-top:20px;
          /*font-family:impact;*/
          font-size:80px;
          font-weight:900;
          color:black;
          height:240px;
      }
   </style> 
   
   
   <script>
      //var snd1 = new Audio("beep-01a.wav");
      //var snd2 = new Audio("beep-07.wav");  

      //function beep1() { snd1.play(); }
      //function beep2() { snd2.play(); }
      
      //function playSound(){
         //beep2();
         //setTimeout(function(){ beep2(); }, 200);
         //setTimeout(function(){ beep2(); }, 400);
      //}//end function
      
      function screenFlash(color, mode){
         
         document.getElementById('div_flash').style.backgroundColor=color;
         
         
         if(mode==1){
            document.getElementById('div_flash').innerHTML=' ';
            document.getElementById('div_flash').style.display='block';
            setTimeout(function(){ document.getElementById('div_flash').style.display='block'; }, 400);
            setTimeout(function(){ document.getElementById('div_flash').style.display='none'; }, 800);

         }else{
            document.getElementById('div_flash').innerHTML=' ';
            document.getElementById('div_flash').style.display='block';
            setTimeout(function(){ document.getElementById('div_flash').style.display='block'; }, 400);
            //setTimeout(function(){ document.getElementById('div_flash').style.display='none'; }, 500);
            setTimeout(function(){javascript:history.back();}, 700);
            
         }
         
      }//end function
      
      
   </script>
   
</head>
<?php
include("dbConnect.php");
date_default_timezone_set('Asia/Taipei');

$tagID = $_GET['tagID'];
#$tagID = "982 000420104595";
//$simpleID = $_GET['simpleID'];

/*
if(trim($simpleID)==''){
   //O
   $simpleID = "607";
   $tagID = "1";

   //X
   $simpleID = "999";
   $tagID = "2";
   
}//end if
*/



   #*******************
   $conn = mysql_connect($dbhost, $dbuser, $dbpass) ; 
   mysql_query("SET NAMES 'UTF8'"); 
   mysql_query("SET time_zone = '+8:00';"); 
   mysql_select_db($dbname); 

   $today  = date('Y-m-d');
   $today_minus365  = date('Y-m-d',strtotime("-365 days"));
   $today_plus1  = date('Y-m-d',strtotime("+1 days"));
   $today_index     = date('Y-m-d');
   
   /*
   $sql = "SELECT A1.tagID, A1.timestamp, A1.text, A1.who, A2.simpleID, DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%Y-%m-%d') AS 'date_formatted' FROM `cattleHealthStatus` A1, `cattleBasicInfo` A2 WHERE A1.tagID = A2.tagID and FROM_UNIXTIME(A1.timestamp) <= '$today_plus1'  LIMIT 0, 300";
   $result = mysql_query($sql); 

   $data_healthLog = array();
   while($row = mysql_fetch_assoc($result)){
      #print_R($row);
      $data_healthLog[$row['date_formatted']][] = $row;
   }//end while
   #print_R($data_healthLog);exit;
   */
   #*******************


   #*******************
   $sql = "SELECT A1.tagID, A1.timestamp, A1.task, A1.caseOpenedBy, A1.caseClosedBy, A2.simpleID, DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%Y-%m-%d') AS 'date_formatted', DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%m/%d') AS 'date_formatted_short' FROM `cattleTodo` A1, `cattleBasicInfo` A2 WHERE A1.tagID = A2.tagID and ( A1.tagID='$tagID' and A1.caseClosedBy = '' and FROM_UNIXTIME(A1.timestamp) BETWEEN '$today_minus365' AND '$today') order by A1.timestamp LIMIT 0, 300 ";
   $result = mysql_query($sql); 
   
   $data_todo = array();
   while($row = mysql_fetch_assoc($result)){
      #print_R($row);
      $data_todo['old'][] = $row;
   }//end while
   
   $sql = "SELECT A1.tagID, A1.timestamp, A1.task, A1.caseOpenedBy, A1.caseClosedBy, A2.simpleID, DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%Y-%m-%d') AS 'date_formatted', DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%m/%d') AS 'date_formatted_short' FROM `cattleTodo` A1, `cattleBasicInfo` A2 WHERE A1.tagID = A2.tagID and ( A1.tagID='$tagID' and FROM_UNIXTIME(A1.timestamp) BETWEEN '$today' AND '$today_plus1') LIMIT 0, 300";
   $result = mysql_query($sql); 
   
   while($row = mysql_fetch_assoc($result)){
      #print_R($row);
      $data_todo['today'][] = $row;
   }//end while
   
   //echo "<pre><p style='color:#000;'>";print_R($data_todo);exit;
   #*******************
   mysql_close($conn);
   

   
   
   
   
if(count($data_todo) > 0) {
   $color = '#7fff00'; 
   $mode=1;
   echo "<body bgcolor='#1A2D42' onload='screenFlash(\"$color\", $mode);'>";
   $simpleID = $data_todo['old'][0]['simpleID'];
   if($simpleID=='') $data_todo['today'][0]['simpleID'];
}else{
   $color = 'red'; 
   $mode=0;
   echo "<body bgcolor='#1A2D42' onload='screenFlash(\"$color\", $mode);'>";
}//end if


#echo "<hr><hr><hr><hr><hr><hr><hr><br><br><br><br><br>".time()."<hr><hr><hr><hr><hr><hr><hr>";


echo "<div id='div_flash' style='width:100%;height:100%;background-color:yellow;z-index:10; position:fixed;top:0px;left:0px;display:none;font-family:impact;font-size:500px;font-weight:500;color:red;text-align:center;'></div>";

echo "<div style='position:fixed;top:0px;background-color:#1A2D42;width:100%'>";
   echo "<table width='100%'><tr>";
   echo "<td style='font-family:impact;font-size:70px;font-weight:900;color:#ffffff;'>牛隻編號:</td>";
   echo "<td><div class='cattleLabel'>$simpleID</div></td>";
   echo "</tr></table>";
echo "</div>";

echo "<div style='padding-top:130px;'>";
   echo "<table width='100%'><tr><td style='width:80px; font-family:impact;font-size:70px;font-weight:900;color:#ffffff;border-right:2px #ffffff solid;'>";
      echo "過<br>期";
   echo "</td><td valign='middle'>";
      foreach($data_todo['old'] as $eachEntry){
         echo "<div class='todoEntry_unfinished_old'>";
            echo "<table><tr>";
            echo "<td><input type='checkbox' style='width:200px;height:200px;'></td>";
            echo "<td class='taskText'>";
            echo $eachEntry['task'];
            echo " (".$eachEntry['date_formatted_short'].")";
            echo "</td>";
            echo "</tr></table>";
         echo "</div>";
      }//end foreach
   echo "</td></tr></table>";

   echo "<br>";

   echo "<table width='100%'><tr><td style='width:80px; font-family:impact;font-size:70px;font-weight:900;color:#ffffff;border-right:2px #ffffff solid;'>";
      echo "今<br>日";
   echo "</td><td>";
      foreach($data_todo['today'] as $eachEntry){
         if($eachEntry['caseClosedBy']!=''){ $tmp = "todoEntry_finished"; $checked='checked';}
         else{ $tmp = "todoEntry_unfinished"; $checked='';}
         
         echo "<div class='$tmp'>";
         
            echo "<table><tr>";
            echo "<td><input type='checkbox' style='width:200px;height:200px;' $checked></td>";
            echo "<td class='taskText'>";
            echo $eachEntry['task'];
            echo "</td>";
            echo "</tr></table>";
            
         echo "</div>";
      }//end foreach
   echo "</td></tr></table>";

   echo "<br><br><br>";
   echo "<table width=100% border=0><tr>";
   echo "<td width=50%><div class='rcorners1' style='padding-top:10px;margin-top:10px;width:300px;text-align:center;font-family:impact;font-size:70px;font-weight:700;background-color:#cccccc; height:100px; color:white;' onclick='javascript:history.back()'>&lt;上一頁</div></td>";
   echo "<td width=50%><div class='rcorners1' style='padding-top:10px;margin-top:10px;width:100%;text-align:center;font-family:impact;font-size:70px;font-weight:700;background-color:#00B050; height:100px; color:white;' onclick='javascript:location.href=\"device_editRecord.php?tagID=$tagID&simpleID=$simpleID\"'>新增紀錄</div></td>";
   echo "</tr></table>";
echo "</div>";















?>
<script>
var snd1 = new Audio("beep-01a.wav");
var snd2 = new Audio("beep-07.wav");  

function beep1() {
  snd1.play();
}

function beep2() { 
  snd2.play();
}


<?php
   $s1= "
   beep2();
   setTimeout(function(){ beep2(); }, 200);
   setTimeout(function(){ beep2(); }, 400);
   setTimeout(function(){ beep1(); }, 600);
   ";

   $s2= "
   beep2();
   //setTimeout(function(){ beep2(); }, 200);
   ";
   
   if(count($data_todo) > 0) {
      echo $s1;
   }else{
      echo $s2;
   }//end if
?>
</script>
