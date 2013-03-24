<?php
$login = addslashes($_POST['login']);
$pass =  addslashes($_POST['pass']);
include('../YDS_Config.php');
$fh_db = mysql_connect($host, $user, $pass); 
$Erreur = mysql_error(); 
$sel = mysql_select_db($database, $fh_db); 
$Erreur = mysql_error(); 
$query = "SELECT * FROM Config";
$result = mysql_query($query);	

while ($enregistrement = mysql_fetch_array($result))
{
$password = $enregistrement[password];
$pseudo = $enregistrement[login];
$id = $enregistrement[id];
}

if ($login == $pseudo)
{
    if ($pass == $password){
	session_start();
	$_SESSION['login'] = $login;
	$_SESSION['id'] = $id;
	  //echo 'Vous êtes connecté !';
	header("Location: index.php");
     }else {
        echo 'Mauvais identifiant ou mot de passe !';
     }
}
else
{
    echo 'Mauvais identifiant ou mot de passe !';
}
