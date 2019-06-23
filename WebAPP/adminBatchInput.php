<head> 

   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <style type="text/css"> 
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 80px;
  height: 44px;
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
  height: 36px;
  width: 36px;
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
  -webkit-transform: translateX(36px);
  -ms-transform: translateX(36px);
  transform: translateX(36px);
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

.id_button {
   border-radius: 5px;
   background-color:#e2f0d9;
   font-size:40px;
   font-family:impact;
   text-align:center;
   font-weight:900;
   width:70px; 
   height:50px; 
}

 </style> 
 
 <script language="JavaScript">
   function taskSwitch(){
      if(document.getElementById('taskSwitchBox').checked){
         document.getElementById('taskFinishPanel').style.display='block';
      }else{
         document.getElementById('taskFinishPanel').style.display='none';
      }//end if   
   }//end function
 </script>
 
</head>
<body bgcolor='#1A2D42' onload='javascript:document.getElementById("shortID1").focus();'>
<form id='form01' method='post' action='adminBatchInput_act.php'>
<?php

#echo "<pre>";print_R($_GET);


date_default_timezone_set('Asia/Taipei');
$day = date('n/j (D)');



   
   echo "<table border=0 width=100% style='margin-top:10px;'><tr>";
      echo "<td style='height:120px;width:360px;font-family:impact;font-size:40px;font-weight:900;color:#ffffff;'>批次輸入待辦事項:</td>";
      echo "<td style='font-family:impact;font-size:50px;font-weight:900;color:#ffffff;text-align:center;'>";
         echo "<input type='radio' value='today' checked name='day' style='height:50px;width:50px;'>今天 &nbsp;&nbsp;";
         echo "<input type='radio' value='today'  name='day' style='height:50px;width:50px;'>明天 &nbsp;&nbsp;";
         echo "<input type='radio' value='today'  name='day' style='height:50px;width:50px;'>後天 &nbsp;&nbsp;";         
      echo "</td>";

   echo "</tr><tr>";
   echo "<td style='height:50px;font-family:impact;font-size:40px;font-weight:900;color:#ffffff;text-align:center;' colspan=2>";
   
      echo "<table></tr><td valign='middle' style='font-family:impact;font-size:40px;font-weight:900;color:#ffffff;text-align:center;'>";
      echo "牛<br>編<br>號";
      echo "</td><td>";
      echo "<input class='rcorners1' id='shortID1' tabindex='1' type='text' name='shortID1' size='20' style='margin:5px;height:70px;width:170px;background-color:#fff;font-size:40px; border:3px #cccccc solid;'>";
      echo "<input class='rcorners1' id='shortID2' tabindex='2' type='text' name='shortID2' size='20' style='margin:5px;height:70px;width:170px;background-color:#fff;font-size:40px; border:3px #cccccc solid;'>";
      echo "<input class='rcorners1' id='shortID3' tabindex='3' type='text' name='shortID3' size='20' style='margin:5px;height:70px;width:170px;background-color:#fff;font-size:40px; border:3px #cccccc solid;'>";
      echo "<input class='rcorners1' id='shortID4' tabindex='4' type='text' name='shortID4' size='20' style='margin:5px;height:70px;width:170px;background-color:#fff;font-size:40px; border:3px #cccccc solid;'>";
      echo "<input class='rcorners1' id='shortID5' tabindex='5' type='text' name='shortID5' size='20' style='margin:5px;height:70px;width:170px;background-color:#fff;font-size:40px; border:3px #cccccc solid;'>";
      echo "<br>";
      echo "<input class='rcorners1' id='shortID6' tabindex='6' type='text' name='shortID6' size='20' style='margin:5px;height:70px;width:170px;background-color:#fff;font-size:40px; border:3px #cccccc solid;'>";
      echo "<input class='rcorners1' id='shortID7' tabindex='7' type='text' name='shortID7' size='20' style='margin:5px;height:70px;width:170px;background-color:#fff;font-size:40px; border:3px #cccccc solid;'>";
      echo "<input class='rcorners1' id='shortID8' tabindex='8' type='text' name='shortID8' size='20' style='margin:5px;height:70px;width:170px;background-color:#fff;font-size:40px; border:3px #cccccc solid;'>";
      echo "<input class='rcorners1' id='shortID9' tabindex='9' type='text' name='shortID9' size='20' style='margin:5px;height:70px;width:170px;background-color:#fff;font-size:40px; border:3px #cccccc solid;'>";
      echo "<input class='rcorners1' id='shortID10' tabindex='10' type='text' name='shortID10' size='20' style='margin:5px;height:70px;width:170px;background-color:#fff;font-size:40px; border:3px #cccccc solid;'>";
      echo "</td></tr></table>";
      
   echo "</td></tr></table>";
   


   
echo "<textarea class='rcorners1' id='note' name='text' tabindex='11' size='20' rows='3' style='margin-top:10px;width:100%;background-color:#fff;height:120px;font-size:40px; border:3px #cccccc solid;'></textarea>";
echo "<iframe id='actionCards_iframe' width='100%' height='620' frameborder=0 src='actionCards.php'></iframe>";

/*
echo "<table width=100% border=0><tr>";
echo "<td width=260><div class='rcorners1' style='padding-top:10px;margin-top:10px;width:200px;text-align:center;font-family:impact;font-size:40px;font-weight:700;background-color:#cccccc; height:60px; color:white;'' onclick='javascript:history.back()'>&larr;</div></td>";
echo "<td><div class='rcorners1' style='padding-top:10px;margin-top:10px;width:700px;;text-align:center;font-family:impact;font-size:40px;font-weight:700;background-color:#00B050; height:60px; color:white;' onclick='javascript:document.getElementById(\"form01\").submit();'>儲存</div></td>";
echo "</tr></table>";
*/

echo "<div class='rcorners1' style='padding-top:10px;margin-top:10px;width:100%;text-align:center;font-family:impact;font-size:40px;font-weight:700;background-color:#00B050; height:60px; color:white;' onclick='javascript:document.getElementById(\"form01\").submit();'>儲存</div>";
?>
</form>
</body>