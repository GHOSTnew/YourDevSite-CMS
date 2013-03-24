<?php
include('../YDS_Config.php');
      $fh_db = mysql_connect($host, $user, $pass); 
      $Erreur = mysql_error(); 
      $sel = mysql_select_db($database, $fh_db); 
      $Erreur = mysql_error(); 
     //////////////////////////////////////////////////////////////////
      $sql_query="INSERT INTO `page`  values ('','".$_POST['desc']."')  ";    
      $result_query=mysql_query($sql_query);     
      $Erreur = mysql_error(); 
      //////////////////////////////////////////////////////////////////  
      mysql_close($fh_db);  
header("Location: index.php");
?>
