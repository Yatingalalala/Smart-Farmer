<head> 　
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <style type="text/css"> 
      /*div round cornor*/
      .rcorners1 {
          border-radius: 5px;
      }
   </style> 


　　 <script>
　 　　　 function resize(){
　 　　　　 //parent.document.getElementById("actionCards_iframe").height=document.body.scrollHeight;
　 　　　　 parent.document.getElementById("actionCards_iframe").width= (document.body.scrollWidth);
　　　　 }

     </script>
</head>
<!--<body onload='resize();'>-->
<?php
include("dbConnect.php");


$conn = mysql_connect($dbhost, $dbuser, $dbpass) ; 
mysql_query("SET NAMES 'UTF8'"); 
mysql_select_db($dbname); 

$sql = "SELECT * FROM `actionCards` ";
$result = mysql_query($sql); 

$data = array();
$typeList = array();
while($row = mysql_fetch_array($result)){
   //print_R($row);
   $type = $row['type'];
   $card = $row['card'];
   $data[$type][] = $card;
   $typeList[$type] = $type;
}//end while
sort($typeList);

mysql_close($conn); 
ksort($data);
#echo "<pre>";print_R($data);exit;
#echo $key = array_search("Swapping", $typeList);
#echo "<pre>";print_R($typeList);exit;

echo "<body bgcolor='#eeeeee'>";
$width = 400*(count($data) + 1);
echo "<table  border='0' cellpadding='0' cellspacing='0' style='font-size:30px; font-family: impact;' bordercolor='#eeeeee' width='$width'>";
  echo "<tr valign='top'>";
  
    echo "<form method='POST' action='actionCards_edit.php'>";
    foreach($data as $eachType => $cardList){
       sort($cardList);
       echo "<td width='400' style='color:black; background-color:#f0f0f0; text-align:center;'><font style='font-weight:500;font-size:50px;font-family:impact;'>$eachType</font><br>";
       echo "<div width='400' style='border-top:2px #aaaaaa solid;'>";
       foreach($cardList as $eachCard){
          echo "<div class='rcorners1' style='height:80px;font-size:50px;font-family:impact; font-weight:500; margin:8px;padding:4px;padding-top:20px;background-color:#fff2cc;border:2px #ffffff solid;color:black; text-align:center;' onclick=\"javascript:parent.document.getElementById('note').value= parent.document.getElementById('note').value +'$eachCard';\">".$eachCard."</div>";
       }//end foreach
       $typeKey = array_search($eachType, $typeList);
       echo "<div class='rcorners1' id='addNewCardTextBox_$typeKey"."close' style='height:50px;font-size:40px; margin:5px;padding:2px;background-color:#cccccc;border:2px #ffffff solid;color:white; text-align:center;' onclick='javascript:addNewCard(\"addNewCardTextBox_$typeKey\");'>新增卡片</div>";
       echo "<br>";
       echo "<div class='rcorners1' id='addNewCardTextBox_$typeKey' style='margin:5px;padding:2px;background-color:#ccaacc;border:2px #ffffff solid;color:white; text-align:center;display:none;height:60px;'><table><tr><td><input style='height:50px; width:80px;font-size:40px;font-family:impact;'type='submit' value='OK'></input></td><td><input type='text' id='addNewCardTextBox_$typeKey"."textBox' style='font-size:38px;font-family:impact;background-color:#ccaacc;border:0px;' name='addNewCardTextBox_$typeKey'></input></td></tr></table></div>";
       echo "</div>";
       echo "<td>";
    }//end foreach
    
    foreach($typeList as $key => $eachType){
      echo "<input type='hidden' name='typeList' value='".serialize($typeList)."'>";
    }//end foreach
    echo "</form>";
   
   
    echo "<td width='400' style='color:black; background-color:#f0f0f0; text-align:center;'>";
    echo "<div class='rcorners1' style='height:40px;font-size:36px;padding-top:20px;width:400px;height:50px;border-bottom:4px #ffffff solid; background-color:#cccccc; color:white;'>新增分類</div>";
    echo "<td>";
  echo '</tr>';
echo '</table>';

?>
<script>
   function addNewCard(addNewCardTextBox_typeKey){
      
      if(document.getElementById(addNewCardTextBox_typeKey).style.display=='none')
      {
         document.getElementById(addNewCardTextBox_typeKey).style.display="block";
         document.getElementById(addNewCardTextBox_typeKey+"textBox").focus();
         document.getElementById(addNewCardTextBox_typeKey+"close").innerHTML='Cancel';
      }else{
         document.getElementById(addNewCardTextBox_typeKey+"textBox").value="";
         document.getElementById(addNewCardTextBox_typeKey).style.display="none";
         document.getElementById(addNewCardTextBox_typeKey+"close").innerHTML='新增卡片';
      }//end if
   }//end function

</script>
