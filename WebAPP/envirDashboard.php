<head> 　
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <style type="text/css"> 
      /*div round cornor*/
      .rcorners1 {
          border-radius: 5px;
      }
      
      
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 100px;
  height: 54px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 46px;
  width: 46px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(46px);
  -ms-transform: translateX(46px);
  transform: translateX(46px);
}



/* Rounded sliders */
.slider.round {
  border-radius: 44px;
}

.slider.round:before {
  border-radius: 50%;
}

/*div round cornor*/
.rcorners1 {
    border-radius: 5px;
}
/*div round cornor*/
.rcorners_top {
    border-top-right-radius: 20px;
    border-top-left-radius: 20px;
    
}



      
   </style> 
 
 
 <script language="JavaScript">
   function autoSwitch(roomId){
      if(document.getElementById('autoSwitchBox'+roomId).checked){
         document.getElementById('autoFinishPanel'+roomId).style.display='block';
      }else{
         document.getElementById('autoFinishPanel'+roomId).style.display='none';
      }//end if   
   }//end function
 </script>
 
 
</head>
<!--<body onload='resize();'>-->
<body bgcolor='#1A2D42'>
<?php
include("dbConnect.php");

#echo time();

$conn = mysql_connect($dbhost, $dbuser, $dbpass) ; 
mysql_query("SET NAMES 'UTF8'"); 
mysql_query("SET time_zone = '+8:00';"); 
mysql_select_db($dbname); 

$today_minus3  = date('Y-m-d',strtotime("-3 days"));
$today_plus3  = date('Y-m-d',strtotime("+3 days"));

#$sql = "SELECT A1.roomId, A1.timestamp, A1.temperature, A1.humidity, A2.roomName, DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%m-%d') AS 'date_formatted', DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%m-%d %H:%i') AS 'date_formatted_disp' FROM `envirData` A1, `roomBasicInfo` A2 WHERE A1.roomId = A2.roomId and FROM_UNIXTIME(A1.timestamp) BETWEEN '$today_minus3' AND '$today_plus3' order by A1.timestamp DESC LIMIT 0, 300";
$sql = "SELECT A1.roomId, A1.timestamp, A1.temperature, A1.humidity, A2.roomName, DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%m-%d') AS 'date_formatted', DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%m-%d %H:%i') AS 'date_formatted_disp' FROM `envirData` A1, `roomBasicInfo` A2 WHERE A1.roomId = A2.roomId and FROM_UNIXTIME(A1.timestamp) order by A1.timestamp DESC LIMIT 0, 100";
$result = mysql_query($sql); 

$data = array();
$roomList = array();
while($row = mysql_fetch_array($result)){
   //print_R($row);
   $roomId = $row['roomId'];
   $temperature = $row['temperature'];
   $humidity = $row['humidity'];
   $roomName = $row['roomName'];
   $date_formatted_disp = $row['date_formatted_disp'];
   $date_formatted = $row['date_formatted'];
   $data[$roomId][] = array("roomName"=>$roomName, "temperature"=>$temperature, 'humidity'=>$humidity, 'date_formatted_disp'=>$date_formatted_disp);
   $roomList[$roomId] = $type;
}//end while
ksort($data);

mysql_close($conn); 
#echo "<pre>";print_R($data);exit;
#echo $key = array_search("Swapping", $roomList);
#echo "<pre>";print_R($roomList);exit;

date_default_timezone_set('Asia/Taipei');
$date = date("g:i (D)");
/*
echo "<table><tr>";
echo "<td width=50%><div class='rcorners1' style='padding-top:10px;margin-bottom:10px;width:300px;text-align:center;font-family:impact;font-size:60px;font-weight:700;background-color:#cccccc; height:80px; color:white;'' onclick='javascript:history.back()'>&lt;上一頁</div></td>";
echo "<td width=50%></td>";
echo "</tr></table>";
*/
echo "<iframe src='clock.php' width='1000' height='130' frameborder=0></iframe>";


echo "<table border='10' cellpadding='10' cellspacing='10' style='background-color:#ffffff;font-size:18px; font-family: impact; border-radius:6px;' bordercolor='#7EBC59' width='100%'>";

foreach($data as $roomId => $eachRoomData)
{
   echo "<tr><td>";
      
      echo "<table><tr>";
      echo "<td style='font-family:impact; font-size:30px;font-weight:500;'>Cowshed ".$eachRoomData[0]['roomName']." environmental control:<br>";
 
      
         echo "<table class='rcorners1' width='800' height='100' border=0 style='background-color:#eeeeee;'><tr>";
            echo "<td style='font-family:impact;font-size:24px;text-align:right;'>Auto</td>";
            echo"<td style='text-align:center;'>
            <label class='switch'>
              <input type='checkbox' id='autoSwitchBox$roomId' onchange='javascript:autoSwitch($roomId);'>
              <div class='slider round'></div>
            </label></td>";
            echo "<td style='font-family:impact;font-size:24px;text-align:left;'>Manual</td>";
         echo "</td><td colspan='3' style='width:300px;height:60px;' valign=middle>";
            echo "<div id='autoFinishPanel$roomId' style='font-size:28px;display:none;text-align:left;'><input type='checkbox' name='C1' value='ON' style='width:40px;height:40px;'>開啟風扇  <input type='checkbox' name='C1' value='ON' style='width:40px;height:40px;'>開啟灑水</div>";
         echo "</td></tr></table>";

      echo "</td>";
      echo "</tr></table>";
      
      echo "<div style='height:80px;width:720px;background-color:#fcfcfc;overflow:auto; direction: rtl;'>";
      echo "<table><tr>";
      echo "<td>";
         echo "<table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111'><tr>";
         echo "<td style='height:50px;width:30px;' valign='bottom'>溫度</td>";
         foreach($eachRoomData as $rows)
         {
            #print_R($rows);exit;
            $temperature = $rows['temperature'];        
            $temperature_height = 50*$temperature/50;
            
            if($temperature<=30) $color = "green";
            else if($temperature > 30) $color = "red";
            
            echo "<td valign='bottom' style='border-bottom:2px #000000 solid;width:30px;'>";
            echo "<div style='margin:2px; width:10px;height:".$temperature_height."px;background-color:$color;'> </div>";
            echo "</td>";
            
         }//end foreach
         echo "</tr></table>";
      echo "</td><td>";
         echo "<table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111'><tr>";
         echo "<td style='height:50px;width:30px;' valign='bottom'>濕度</td>";
         foreach($eachRoomData as $rows)
         {
            #print_R($rows);exit;
            $humidity = $rows['humidity'];
            $humidity_height = 50*$humidity/100;
            
            echo "<td valign='bottom' style='border-bottom:2px #000000 solid;width:30px;' title='$humidity'>";
            echo "<div style='margin:2px; width:10px;height:".$humidity_height."px;background-color:#7ABED1;'> </div>";
            echo "</td>";
            
         }//end foreach
         echo "</tr></table>";
      echo "</td></tr></table>";
      echo "</div>";
      
   
   echo "</td></tr>";
}//end foreach
echo "</table>";


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

beep2();
setTimeout(function(){ beep2(); }, 200);
setTimeout(function(){ beep2(); }, 400);
setTimeout(function(){ beep1(); }, 600);

</script>
