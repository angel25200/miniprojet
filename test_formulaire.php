<?php
$redirection='./session.php';
mysql_connect("localhost", "user_progweb", "web");
mysql_select_db("bddprogweb");
?>

<html>

	<head>
		<meta name=content="text/html" charset="UTF-8" />
<script language="JavaScript">

function reste(seconde)
{
	if (seconde > 0)
	{
		document.getElementById("stopwatch").innerHTML=seconde;
		compte=setTimeout("chrono()",1000);
		seconde=seconde-1;
		setTimeout("reste(" + seconde + ")",1000);
	}
	else
	{
		url="<?php echo $redirection; ?>";
		setTimeout("window.location=url", -10);
	}
}
</script> 

	</head>

<body>



<?php

	$query="select Pass FROM isengon2_utilisateurs where Identifiant='".$_POST["Identifiant"]."';";
	
	$resultat=mysql_query($query);
	
	if ($row = mysql_fetch_array($resultat))
	{
		if ($row["Pass"] == $_POST["Pass"])
		{
			session_start();
			$_SESSION["user"]=$_POST["Identifiant"];
			$_SESSION["password"]=$_POST["Pass"];
			header('location:page1.php'); //redirection vers page d'accueil
		}
		else
		{
			echo "Mot de passe incorrect <br/>";
			echo 'Vous allez être redirigé vers la page de connexion <div id="stopwatch"> </div>';
			echo '<script> reste(2); </script>';
		}
	}
	else
	{
		echo "L'utilisateur ".$_POST["Identifiant"]." n'existe pas !"; ?>
		<br/><a href='ajout_user.php'> Creer utilisateur </a> <br/>;
		<a href='session.php'> Page de connexion </a>
		<?php
	}

?>
	
</body>

</html>