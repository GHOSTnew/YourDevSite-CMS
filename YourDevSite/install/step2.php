<?php
include('../YDS_Config.php');
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
<?php 

      /////////////////////////////////////////////////////////////
      $fh_db = mysql_connect($host, $user, $pass); 
      $Erreur = mysql_error(); 
      $sel = mysql_select_db($database, $fh_db); 
      $Erreur = mysql_error(); 
      $sql_query="DROP TABLE IF EXISTS `config` ";
      $result_query=mysql_query($sql_query);
      $Erreur = mysql_error(); 
      $sql_query="DROP TABLE IF EXISTS `projet` "; 
      $result_query=mysql_query($sql_query);
      $Erreur = mysql_error(); 
      $sql_query="DROP TABLE IF EXISTS `page` ";
      $result_query=mysql_query($sql_query);
      $Erreur = mysql_error(); 
      ////////////////////////////////////////////////////////////////
      $sql_query="CREATE TABLE  `".$database."`.`Config` (
`id` INT( 1 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`site_name` VARCHAR( 30 ) NOT NULL ,
`url` VARCHAR( 30 ) NOT NULL ,
`login` VARCHAR( 30 ) NOT NULL ,
`password` VARCHAR( 30 ) NOT NULL ,
`email` VARCHAR( 30 ) NOT NULL
) ENGINE = MYISAM ;";     
      $result_query=mysql_query($sql_query);     
      $Erreur = mysql_error(); 
      $sql_query="CREATE TABLE  `".$database."`.`page` (
`id` INT( 1 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`contenu` TEXT NOT NULL
) ENGINE = MYISAM ;";     
      $result_query=mysql_query($sql_query);     
      $Erreur = mysql_error(); 
      $sql_query="CREATE TABLE  `".$database."`.`projet` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`project_name` VARCHAR( 30 ) NOT NULL ,
`description` TEXT NOT NULL ,
`site` VARCHAR( 140 ) NOT NULL ,
`etat` VARCHAR( 10 ) NOT NULL
) ENGINE = MYISAM ;";    
      $result_query=mysql_query($sql_query);    
      $Erreur = mysql_error(); 
      //////////////////////////////////////////////////////////////////
      $sql_query="INSERT INTO `page`  values ('','Cuius acerbitati uxor grave accesserat incentivum, germanitate Augusti turgida supra modum, quam Hannibaliano regi fratris filio antehac Constantinus iunxerat pater, Megaera quaedam mortalis, inflammatrix saevientis adsidua, humani cruoris avida nihil mitius quam maritus; qui paulatim eruditiores facti processu temporis ad nocendum per clandestinos versutosque rumigerulos conpertis leviter addere quaedam male suetos falsa et placentia sibi discentes, adfectati regni vel artium nefandarum calumnias insontibus adfligebant.')  ";    
      $result_query=mysql_query($sql_query);     
      $Erreur = mysql_error(); 
      //////////////////////////////////////////////////////////////////  
      mysql_close($fh_db);                                  

?>
        <div class="install">
            <form method="post" action="fin.php">
                <h1>Step 2</h1>
                <label>nom de votre site</label> : <input type="text" name="name_site" id="name_site"><br/>
                <label>url</label> :               <input type="text" name="url" id="url"><br/>
                <label>username</label> : <input type="text" name="login" id="login"><br/>
                <label>password</label> : <input type="password" name="password" id="password"><br/>
                <label>email</label> : <input type="email" name="mail" id="mail"><br/>
                <input type="submit" value="suivant" />
            </form>
        </div>
    </body>
</html>
