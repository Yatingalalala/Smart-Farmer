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
<body bgcolor='#1A2D42'>
<?php

#echo "<pre>";print_R($_GET);


date_default_timezone_set('Asia/Taipei');
$datePointer = $_GET['datePointer'];
$day = date('Y/n/j (D)',strtotime($datePointer." days"));


   #echo "<table border=0><tr><td>";
   #echo "</td><td>";
   #   echo "<div style='color:#ffffff;font-size:20px;font-family:impact;font-weight:700;margin-left:2px;margin-top:8px;margin-bottom:6px;'> $day</div>";
   #echo "</td></tr></table>";
   
   
   echo "<table border=0 width=100% style='margin-top:10px;'><tr>";
   echo "<td style='height:50px;width:240px;font-family:impact;font-size:40px;font-weight:900;color:#ffffff;'>";
      echo "牛編號: ";
      echo "<input class='rcorners1' id='shortID' type='text' name='T1' size='20' style='height:100%;width:300px;background-color:#fff;font-size:40px; border:3px #cccccc solid;'>";
   echo "</td></tr></table>";
   
   

   echo "<table border=0 width='100%' height='40' style='margin-top:10px;'>";
   echo "<tr style='height:50px;'>";
   echo "<td><div class='id_button' onclick='document.getElementById(\"shortID\").value = document.getElementById(\"shortID\").value + \"1\";'>1</div></td>";
   echo "<td><div class='id_button' onclick='document.getElementById(\"shortID\").value = document.getElementById(\"shortID\").value + \"2\";'>2</div></td>";
   echo "<td><div class='id_button' onclick='document.getElementById(\"shortID\").value = document.getElementById(\"shortID\").value + \"3\";'>3</div></td>";
   echo "<td> </td>";
   echo "<td><div class='id_button' onclick='document.getElementById(\"shortID\").value = document.getElementById(\"shortID\").value + \"4\";'>4</div></td>";
   echo "<td><div class='id_button' onclick='document.getElementById(\"shortID\").value = document.getElementById(\"shortID\").value + \"5\";'>5</div></td>";
   echo "<td><div class='id_button' onclick='document.getElementById(\"shortID\").value = document.getElementById(\"shortID\").value + \"6\";'>6</div></td>";
   echo "<td> </td>";
   echo "<td><div class='id_button' onclick='document.getElementById(\"shortID\").value = document.getElementById(\"shortID\").value + \"7\";'>7</div></td>";
   echo "<td><div class='id_button' onclick='document.getElementById(\"shortID\").value = document.getElementById(\"shortID\").value + \"8\";'>8</div></td>";
   echo "<td><div class='id_button' onclick='document.getElementById(\"shortID\").value = document.getElementById(\"shortID\").value + \"9\";'>9</div></td>";
   echo "<td> </td>";
   echo "<td><div class='id_button' onclick='document.getElementById(\"shortID\").value = document.getElementById(\"shortID\").value + \"0\";'>0</div></td>";
   echo "<td><div class='id_button' onclick='document.getElementById(\"shortID\").value = document.getElementById(\"shortID\").value + \"M\";'>M</div></td>";
   echo "<td><div class='id_button' onclick='document.getElementById(\"shortID\").value = document.getElementById(\"shortID\").value + \"-\";'>-</div></td>";
   echo "<td><div class='id_button' style='background-color:#cccccc;' onclick='document.getElementById(\"shortID\").value = document.getElementById(\"shortID\").value.substr(0,document.getElementById(\"shortID\").value.length - 1);'>&lt;</td>";
   echo "</tr>";
   echo "</table>";

   
   echo "<br>";
   echo "<table border=0 style='border-bottom:10px #ffffff solid;'><tr>";
   echo "<td style='width:500px;'><div class='rcorners_top' style='background-color:#eeeeee;color:#black;font-size:40px;font-family:impact;font-weight:900;text-align:center;'>Add entry</div></td>";
   echo "<td style='width:500px;'><div class='rcorners_top' style='background-color:#aaaaaa;color:#cccccc;font-size:40px;font-family:impact;font-weight:900;text-align:center;'>Health log</div></td>";
   echo "<td style='width:500px;'><div class='rcorners_top' style='background-color:#aaaaaa;color:#cccccc;font-size:40px;font-family:impact;font-weight:900;text-align:center;'>Todo list</div></td>";
   echo "</tr></table>";
   
   
echo "<textarea id='note' name='T1' class='rcorners1' size='20' rows='3' style='margin-top:10px;width:100%;background-color:#fff;height:120px;font-size:40px; border:3px #cccccc solid;'></textarea>";
echo "<iframe id='actionCards_iframe' width='100%' height='850' frameborder=0 src='actionCards.php'></iframe>";

/*
echo "<table width=100% border=0><tr>";
echo "<td width=50%><div class='rcorners1' style='padding-top:10px;margin-top:10px;width:300px;text-align:center;font-family:impact;font-size:40px;font-weight:700;background-color:#cccccc; height:60px; color:white;'' onclick='javascript:history.back()'>&lt;上一頁</div></td>";
echo "<td width=50%><div class='rcorners1' style='padding-top:10px;margin-top:10px;width:100%;text-align:center;font-family:impact;font-size:40px;font-weight:700;background-color:#00B050; height:60px; color:white;'>儲存</div></td>";
echo "</tr></table>";
*/

echo "<table width=100% border=0 style='padding-top:5px;margin-top:5px'><tr>";
   echo "<td width=50%>";
      echo "<table class='rcorners1' border=0 style='width:100%;height:70px;background-color:#eeeeee;'><tr>";
         echo "<td style='font-family:impact;font-size:32px;text-align:right;'>Health log</td>";
         echo"<td style='text-align:center;'>
         <label class='switch'>
           <input type='checkbox' id='taskSwitchBox' onchange='javascript:taskSwitch();'>
           <div class='slider round'></div>
         </label></td>";
         echo "<td style='font-family:impact;font-size:32px;text-align:left;'>Todo</td>";
      echo "</td><td colspan='3' style='width:80px;height:60px;' valign=middle>";
         echo "<div id='taskFinishPanel' style='display:none;text-align:left;'><input type='checkbox' name='C1' value='ON' style='width:40px;height:40px;'></div>";
      echo "</td></tr></table>";
   echo "</td>";
echo "<td width=50%>";
   echo "<div class='rcorners1' style=';width:100%;text-align:center;font-family:impact;font-size:50px;font-weight:700;background-color:#00B050; height:70px; color:white;'>儲存</div>";
echo "</td></tr></table>";

#echo "<div class='rcorners1' style='padding-top:10px;margin-top:10px;width:100%;text-align:center;font-family:impact;font-size:40px;font-weight:700;background-color:#00B050; height:60px; color:white;'>儲存</div>";

?>
