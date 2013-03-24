<?php

include('../YDS_Config.php');
$fh_db = mysql_connect($host, $user, $pass); 
$Erreur = mysql_error(); 
$sel = mysql_select_db($database, $fh_db); 
$sql_query="INSERT INTO `Config`  values ('','".$_POST['name_site']."', '".$_POST['url']."', '".$_POST['login']."', '".$_POST['password']."', '".$_POST['mail']."')  ";    
$result_query=mysql_query($sql_query);
mysql_close($serveur);      

?>
<html>
    <head>
        <title>YourDevSite install</title>
        <style>
            .install
            {
                background:rgba(255,255,255,0.5);
                border-radius: 10px;
                border: 1px black solid;
                margin-left: 30%;
                margin-right: 30%;
                margin-top: 10%;
                margin-bottom: 20%;
                padding: 12px;
            }
            body
            {
                background-image:url('../images/back.png');
            }
        </style>
    </head>
    <body>
        <div class="install">
            <h1>Fin</h1>
            <p>L'installation s'est termin&eacute avec succes<br/>
            esseyez de vous connecter <a href="../admin">au panel d'administration</a> et de supprimer le dossier "install"</p>  
        </div>
    </body>
</html>
