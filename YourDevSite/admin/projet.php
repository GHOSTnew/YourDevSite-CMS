<?php
session_start();
if(!isset($_SESSION['id'])){
   header("Location: login.php");
   exit;
}
if (file_exists("../YDS_Config.php")) { 
include('../YDS_Config.php');
$fh_db = mysql_connect($host, $user, $pass); 
$Erreur = mysql_error(); 
$sel = mysql_select_db($database, $fh_db); 
$Erreur = mysql_error(); 
$query = "SELECT * FROM Config";
$result = mysql_query($query);	
while ($enregistrement = mysql_fetch_array($result))
{
$email_gravatar = $enregistrement[email];
$site = $enregistrement[site_name];
}
$query = "SELECT * FROM page";
$result = mysql_query($query);	
while ($enregistrement = mysql_fetch_array($result))
{
$desc = $enregistrement[contenu];
}

function get_avatar($email,$taille = null){
 $email_g = md5(strtolower(trim($email)));
 echo "<img src='http://www.gravatar.com/avatar/$email_g?s=$taille' alt='avatar'>";
 }
 
?>
<html>
    <head>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/interface.js"></script>
        <link href="../style/style.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 7]>
 <style type="text/css">
 .dock img { behavior: url(iepngfix.htc) }
 </style>
<![endif]-->
        <title><?php echo $site ?></title>
        <style>
            .page
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
            .gravatar
            {
                display: inline-block;
            }
            .titre
            {
               position: absolute;
               right: 35%;
               top: 15%;
               font-size: 20px;
            }
            h2, th, td
            {
                text-align:center;
            }
            table
            {
                border-collapse:collapse;
                border:2px solid black;
                margin:auto;
            }
            th, td
            {
                border:1px solid black;
            }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="gravatar"><?php get_avatar($email_gravatar); ?></div><div class="titre"><h1>Admin Panel</h1></div>
<h2><a href="add_project.php">Ajouter un projet</a></h2>
<?php
if (isset($_POST['titre']) AND isset($_POST['contenu']))
{
    $titre = addslashes($_POST['titre']);
    $contenu = addslashes($_POST['contenu']);
    // On vérifie si c'est une modification de news ou non.
    if ($_POST['id_news'] == 0)
    {
        // Ce n'est pas une modification, on crée une nouvelle entrée dans la table.
        mysql_query("INSERT INTO projet VALUES('', '" . $titre . "', '" . $contenu . "', '".$_POST['site']."', '".$_POST['etat']."')");
    }
    else
    {
        // On protège la variable "id_news" pour éviter une faille SQL.
        $_POST['id_news'] = addslashes($_POST['id_news']);
        // C'est une modification, on met juste à jour le titre et le contenu.
        mysql_query("UPDATE projet SET project_name='" . $titre . "', description='" . $contenu . "',site='".$_POST['site']."',etat='".$_POST['etat']."' WHERE id='" . $_POST['id_news'] . "'");
    }
}
if (isset($_GET['supprimer_projet'])) // Si l'on demande de supprimer une news.
{
    // Alors on supprime la news correspondante.
    // On protège la variable « id_news » pour éviter une faille SQL.
    $_GET['supprimer_projet'] = addslashes($_GET['supprimer_projet']);
    mysql_query('DELETE FROM projet WHERE id=\'' . $_GET['supprimer_projet'] . '\'');
}?>
          <p>Les projets :<br/>
<?php if (isset($_GET['supprimer_projet'])) 
{

    $_GET['supprimer_projet'] = addslashes($_GET['supprimer_projet']);
    mysql_query('DELETE FROM news WHERE id=\'' . $_GET['supprimer_projet'] . '\'');
}?>
             <table><tr>
<th>Modifier</th>
<th>Supprimer</th>
<th>Titre</th>
<th>Etat</th>
</tr>
<?php
$retour = mysql_query('SELECT * FROM projet ORDER BY id DESC');
while ($donnees = mysql_fetch_array($retour)) // On fait une boucle pour lister les news.
{
?>
<tr>
<td><?php echo '<a href="add_project.php?modifier_projet=' . $donnees['id'] . '">'; ?>Modifier</a></td>
<td><?php echo '<a href="projet.php?supprimer_projet=' . $donnees['id'] . '">'; ?>Supprimer</a></td>
<td><?php echo stripslashes($donnees['project_name']); ?></td>
<?php if($donnees[etat] == "fini") { $color = "<font color=green>";} else if($donnees[etat] == "indev") { $color = "<font color=orange>";} else { $color = "<font color=red>"; }?>
<td><?php echo $color."".stripslashes($donnees['etat'])."</font>"; ?></td>
</tr>
<?php
} // Fin de la boucle qui liste les news.
?>
</table>

      </p></div>
<div class="dock" id="dock2">
  <div class="dock-container2">
  <a class="dock-item2" href="index.php"><span>Home</span><img src="../images/home.png" alt="home" /></a>
<a class="dock-item2" href="projet.php"><span>Mes projets</span><img src="../images/dev.png" alt="Mes projets" /></a>
<a class="dock-item2" href="description.php"><span>Description</span><img src="../images/help.png" alt="Description" /></a>
<a class="dock-item2" href="logout.php"><span>Logout</span><img src="../images/logout.png" alt="Logout" /></a>
  </div>

</div>
<!--dock menu JS options -->
<script type="text/javascript">
	
	$(document).ready(
		function()
		{
			$('#dock2').Fisheye(
				{
					maxWidth: 80,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container2',
					itemWidth: 60,
					proximity: 80,
					alignment : 'left',
					valign: 'bottom',
					halign : 'center'
				}
			)
		}
	);

</script>

    </body>
</html>
<?php
} else { 
     header("Location: ../install/index.php");
} 
?> 
