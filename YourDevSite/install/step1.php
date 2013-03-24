<?php
if(!mysql_connect($_POST['SQLhost'], $_POST['SQLuser'], $_POST['SQLpass'])) {
die('Mauvais paramètres de connexion.');
}
  
if(!mysql_select_db($_POST['SQLdatabase'])) {
die('Mauvais nom de base.');
}   
   $contenu = '<?php $host = "'.$_POST['SQLhost'].'";
               $user = "'.$_POST['SQLuser'].'";
               $pass = "'.$_POST['SQLpass'].'";
               $database = "'.$_POST['SQLdatabase'].'"; ?>';
   file_put_contents('../YDS_Config.php', $contenu);
   header("Location: step2.php");
?>
