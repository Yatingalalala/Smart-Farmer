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
          height:80px;
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
      .healthLog {
          border-radius: 5px;
          background-color:#e2f0d9;
          border:2px #cccccc solid;
          margin:4px;
          margin-top:20px;
          margin-bottom:20px;
          padding:4px;
          font-family:impact;
          font-size:70px;
          font-weight:500;
      }
      /*div round cornor*/
      .rcorners_top {
          border-top-right-radius: 20px;
          border-top-left-radius: 20px;
      }

      
   </style> 
   
   
   <script>

      
   </script>
   
</head>
<?php
include("dbConnect.php");
date_default_timezone_set('Asia/Taipei');

$tagID = $_GET['tagID'];
#$simpleID = $_GET['simpleID'];
#$tagID = "1";
#$simpleID = "607";
#$tagID = "2";



   #*******************
   $conn = mysql_connect($dbhost, $dbuser, $dbpass) ; 
   mysql_query("SET NAMES 'UTF8'"); 
   mysql_query("SET time_zone = '+8:00';"); 
   mysql_select_db($dbname); 

   $today  = date('Y-m-d');
   $today_minus365  = date('Y-m-d',strtotime("-365 days"));
   $today_plus1  = date('Y-m-d',strtotime("+1 days"));
   $today_index     = date('Y-m-d');
   
   
   $sql = "SELECT A1.tagID, A1.timestamp, A1.text, A1.who, A2.simpleID, DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%Y-%m-%d') AS 'date_formatted', DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%m-%d') AS 'date_formatted_short' FROM `cattleHealthStatus` A1, `cattleBasicInfo` A2 WHERE A1.tagID = A2.tagID and FROM_UNIXTIME(A1.timestamp) <= '$today_plus1'  order by A1.timestamp LIMIT 0, 300";
   $result = mysql_query($sql); 

   $data_healthLog = array();
   while($row = mysql_fetch_assoc($result)){
      #print_R($row);
      $data_healthLog[] = $row;
   }//end while
   #echo "<pre>";print_R($data_healthLog);exit;
   
   #*******************

   mysql_close($conn);

   
   $simpleID = $data_healthLog[0]['simpleID'];
/*
if(count($data_todo) > 0) {
   $color = '#7fff00'; 
   $mode=1;
   echo "<body bgcolor='#1A2D42' onload='screenFlash(\"$color\", $mode);'>";
   $simpleID = $data_todo[0]['simpleID'];
}else{
   $color = 'red'; 
   $mode=0;
   echo "<body bgcolor='#1A2D42' onload='screenFlash(\"$color\", $mode);'>";
}//end if
*/



#echo time()."\n\n";

echo "<body bgcolor='#1A2D42' onload=''>";


echo "<div style='position:fixed;top:0px;background-color:#1A2D42;'>";
   echo "<table><tr>";
      echo "<td style='font-family:impact;font-size:70px;font-weight:900;color:#ffffff;'>牛隻編號:</td>";
      echo "<td><div class='cattleLabel'>$simpleID</div></td>";
   echo "</tr></table>";


echo "<table border=0 style='border-bottom:10px #ffffff solid;padding-top:10px;'><tr>";
   echo "<td style='width:500px;'><div class='rcorners_top' style='height:150px;background-color:#eeeeee;color:#black;font-size:60px;font-family:impact;font-weight:900;text-align:center;'>Health log</div></td>";
   echo "<td style='width:500px;'><div class='rcorners_top' style='height:150px;background-color:#aaaaaa;color:#cccccc;font-size:60px;font-family:impact;font-weight:900;text-align:center;'>Todo list</div></td>";
echo "</tr></table>";
echo "</div>";



echo "<div style='padding-top:300px;'>";
   foreach($data_healthLog as $eachEntry){
      echo "<div class='healthLog'>";
         echo "[".$eachEntry['date_formatted']."] ";
         echo $eachEntry['text'];
         echo " &nbsp;by ".$eachEntry['who'];
         $tts_string = "時間: ".$eachEntry['date_formatted']."健康紀錄: ".$eachEntry['text']."紀錄人".$eachEntry['who'];
      echo "</div>";
   }//end foreach

   echo "<br><br><br>";
   
   
   echo "<div style='position:fixed;bottom:0px;width:100%;background-color:#1A2D42;'>";
   echo "<table width=100% border=0><tr>";
   echo "<td width=300><div class='rcorners1' style='padding-top:10px;margin-top:10px;width:300px;text-align:center;font-family:impact;font-size:80px;font-weight:700;background-color:#cccccc; height:120px; color:white;'' onclick='javascript:history.back()'>&larr;</div></td>";
   echo "<td width=50%><div class='rcorners1' style='padding-top:10px;margin-top:10px;width:100%;text-align:center;font-family:impact;font-size:80px;font-weight:700;background-color:#00B050; height:120px; color:white;' onclick='javascript:location.href=\"device_editRecord.php?tagID=$tagID&simpleID=$simpleID\"'>新增紀錄</div></td>";
   echo "</tr></table>";
   echo "</div>";
echo "</div>";
?>