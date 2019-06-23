<head>
<meta http-equiv="refresh" content="60" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

   <style type="text/css"> 
      /*div round cornor*/
      .rcorners1 {
          border-radius: 5px;
      }
      
      

    </style>
</head>
<body bgcolor='#1A2D42'>
<?php
date_default_timezone_set('Asia/Taipei');
$date = date("g:i (D)");



echo "<div style='float:left;'><font style='font-size:70px;color:#ffffff;font-family:impact; font-weight:500;font-variant: small-caps;'>$date</font></div>";
echo "<div class='rcorners1' style='float:right;border:2px #cccccc solid;width:80px;height:110px;text-align:center;color:#ffffff;background-color:green;font-size:20px;' onclick='parent.location.href=\"envirDashboard.php\";'>D<br>23&#8451;<br>74%<br><br></div>";
echo "<div class='rcorners1' style='float:right;border:2px #cccccc solid;width:80px;height:110px;text-align:center;color:#ffffff;background-color:red;font-size:20px;' onclick='parent.location.href=\"envirDashboard.php\";'>C<br>31&#8451;<br>84%<br>&#9730;</div>";
echo "<div class='rcorners1' style='float:right;border:2px #cccccc solid;width:80px;height:110px;text-align:center;color:#ffffff;background-color:red;font-size:20px;' onclick='parent.location.href=\"envirDashboard.php\";'>B<br>31&#8451;<br>80%<br>&#9730;</div>";
echo "<div class='rcorners1' style='float:right;border:2px #cccccc solid;width:80px;height:110px;text-align:center;color:#ffffff;background-color:green;font-size:20px;' onclick='parent.location.href=\"envirDashboard.php\";'>A<br>27&#8451;<br>74%<br><br></div>";
   

?>
</body>
