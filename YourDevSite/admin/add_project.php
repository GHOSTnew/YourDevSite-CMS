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
            {
        </style>
    </head>
    <body>
        <div class="page">
            <div class="gravatar"><?php get_avatar($email_gravatar); ?></div><div class="titre"><h1>Admin Panel</h1></div>
<?php
if (isset($_GET['modifier_projet'])) 
{
    $_GET['modifier_projet'] = mysql_real_escape_string(htmlspecialchars($_GET['modifier_projet']));
    $retour = mysql_query('SELECT * FROM projet WHERE id=\'' . $_GET['modifier_projet'] . '\'');
    $donnees = mysql_fetch_array($retour);
     
    $titre = stripslashes($donnees['project_name']);
    $contenu = stripslashes($donnees['description']);
    $id_news = $donnees['id'];
    $eta_projet = $donnees['etat'];
    $site_projet = $donnees['site'];
}
else 
{
    
    $titre = '';
    $contenu = '';
    $id_news = 0; 
}
?>
<form action="projet.php" method="post">
<p>Titre : <input type="text" size="30" name="titre" value="<?php echo $titre; ?>" /></p>
<p>
    Contenu :<br />
    <textarea name="contenu" cols="45" rows="10">
    <?php echo $contenu; ?>
    </textarea><br />
     site : <input type="url" size="30" name="site" value="<?php echo $site_projet; ?>" /><br/>
     etat : <select name="etat" id="etat">
           <option value="fini">Fini</option>
           <option value="indev">En cour</option>
           <option value="stopped">Abandonné</option>
       </select><br/>
    <input type="hidden" name="id_news" value="<?php echo $id_news; ?>" />
    <input type="submit" value="Envoyer" />
</p>
</form></div>
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
