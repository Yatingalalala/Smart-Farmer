<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script>
// Shift 的鍵盤代碼是 16，Ctrl 的鍵盤代碼是 17，Alt 的鍵盤代碼是 18
function keyFunction() {
	document.getElementById('box').value += String.fromCharCode(event.keyCode);
	
	if (event.keyCode==13){	// enter
		//alert(document.getElementById('box').value);
      
      if(document.getElementById('mode_employee').checked) location.href = "device_showSummaryInfo.php?tagID="+document.getElementById('box').value;
      else if(document.getElementById('mode_doctor').checked) location.href = "device_showSummaryInfo_healthLog.php?tagID="+document.getElementById('box').value;
      document.getElementById('box').value="";
   }//end if
}
document.onkeydown=keyFunction;
</script>


<!--<body onload='document.getElementById("box_tagId").focus();' bgcolor='#1A2D42'>-->
<body onload='' bgcolor='#1A2D42'>
<div style='display:none;'><input type='text' id='box' ></div>


<input class='rcorners1' id='box_tagId' type='text' name='T1' size='20' style='height:40;width:100%;background-color:#1A2D42;font-size:40px; border:0px #1A2D42 solid;'>

<center>
<p style='font-size:60px;font-family:impact;font-weight:500;color:#ffffff;'> 請感應牛耳牌</p>
<p style='font-size:30px;font-family:impact;font-weight:500;color:#ffffff;'> <input id='mode_employee' type='radio' checked name='C1' value='ON' style='width:30px;height:30px;' > 待辦事項</p>
<p style='font-size:30px;font-family:impact;font-weight:500;color:#ffffff;'> <input id='mode_doctor' type='radio' name='C1' value='ON' style='width:30px;height:30px;'> 健康紀錄</p>
<!--<p style='font-size:80px;font-family:impact;font-weight:500;color:#ffffff;'> <input id='mode_input' type='radio' name='C1' value='ON' style='width:80px;height:80px;'> 輸入模式</p>-->
</center>




<script>
var snd = new Audio("149003205331992.wav");  
var snd_employee = new Audio("149003217825895.wav");  

function beep() {
  snd.play();
}

function beep_employee() {
  snd_employee.play();
}

<?php
if($_GET['sound']!='none') echo "beep();";
?>
</script>
