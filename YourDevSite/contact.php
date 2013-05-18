<?php
if (file_exists("YDS_Config.php")) { 
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
$email_gravatar = $enregistrement[email];
$site = $enregistrement[site_name];
}

function get_avatar($email,$taille = null){
 $email_g = md5(strtolower(trim($email)));
 echo "<img src='http://www.gravatar.com/avatar/$email_g?s=$taille' alt='avatar'>";
 }
 
?>
<html>
    <head>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/interface.js"></script>
        <link href="style/style.css" rel="stylesheet" type="text/css" />
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
                background-image:url('images/back.png');
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
            <div class="gravatar"><?php get_avatar($email_gravatar); ?></div><div class="titre"><h1>Contact</h1></div>
        <p><form method="post" action="send.php">
            <label for="pseudo">Votre pseudo</label> : <input type="text" name="pseudo" id="pseudo" /><br/>
            <label for="email">email</label> : <input type="text" name="email" id="email" /><br/>
            <label for="msg">votre m&eacutessage</label> : <textarea name="msg" id="msg" rows="10" cols="45"></textarea><br/>
            <input type="submit" value="envoyer" />
        </form></p></div>
<div class="dock" id="dock2">
  <div class="dock-container2">
  <a class="dock-item2" href="<?php echo $url; ?>"><span>Home</span><img src="images/home.png" alt="home" /></a>
<a class="dock-item2" href="projet.php"><span>Mes projets</span><img src="images/dev.png" alt="Mes projets" /></a>
<a class="dock-item2" href="help.php"><span>M'aider</span><img src="images/help.png" alt="M'aider" /></a>
<a class="dock-item2" href="contact.php"><span>Contact</span><img src="images/contact.png" alt="Contact" /></a>
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
     header("Location: install/index.php");
} 
?> 
