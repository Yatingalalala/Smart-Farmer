<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<pre>
<?php
include("dbConnect.php");
#print_R($_POST);


$typeList = unserialize($_POST['typeList']);
$valList = array();
foreach($_POST as $key => $term){
   if(preg_match("/^(addNewCardTextBox_)/", $key)){
      $index = preg_replace("/^(addNewCardTextBox_)/", "", $key);
      $valList[$index] = $term;
   }//end if
}//end foreach
//print_r($valList);
//print_r($typeList);

$conn = mysql_connect($dbhost, $dbuser, $dbpass) ; 
mysql_query("SET NAMES 'UTF8'"); 
mysql_select_db($dbname); 



foreach($valList as $key => $card){
   $type = $typeList[$key];
   if(trim($card)=='') continue;
 
   $sql = "INSERT INTO `cattledb`.`actionCards` (`keyid`, `type`, `card`";
   $sql .= ") VALUES (NULL, '$type', '$card');";
   $result = mysql_query($sql); 

   //echo $sql."\n\n";
}//end foreach



mysql_close($conn); 


?>
<script>
location.href='actionCards.php';
</script>
