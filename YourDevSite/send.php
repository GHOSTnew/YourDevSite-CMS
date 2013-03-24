<?php
include('YDS_Config.php');
$fh_db = mysql_connect($host, $user, $pass); 
$Erreur = mysql_error(); 
$sel = mysql_select_db($database, $fh_db); 
$Erreur = mysql_error(); 
$query = "SELECT * FROM Config";
$result = mysql_query($query);	
while ($enregistrement = mysql_fetch_array($result))
{
$url = $enregistrement[url];
$email_cible = $enregistrement[email];
$site = $enregistrement[site_name];
}
$mail = $email_cible;
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
{
    $passage_ligne = "\r\n";
}
else
{
    $passage_ligne = "\n";
}

$message_txt = $_POST['msg'];

  
$boundary = "-----=".md5(rand());

$sujet = $site." Contact";
$header = "From: \"".$site."\"<".$_POST['email'].">".$passage_ligne;
$header.= "Reply-to: \"".$site."\"<".$_POST['email'].">".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

$message = $passage_ligne."--".$boundary.$passage_ligne;

$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;

$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

mail($mail,$sujet,$message,$header);
header("Location: index.php");
?>
