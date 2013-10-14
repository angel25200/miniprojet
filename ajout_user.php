<?php
	mysql_connect("localhost", "user_progweb", "web");
	mysql_select_db("bddprogweb");
?>
<html>
	<head>
		<meta name=content="text/html" charset="UTF-8" />
			<style>
				div 
				{
					padding-top : 20px;
					padding-left : 200px;
					color : red;
				};
			</style>
	</head>
	<body>
	<form method="get" action="ajout_user.php">
		<div> Pages de création d'utilisateurs <br/> <br/> </div>
		<label> Identifiant : </label>
		<input type="text" id="Identifiant" name="Identifiant"> <br/>
	
		<label> Mot de Passe : </label>
		<input type="password" id="Pass" name="Pass"> <br/>
		
		<label> Confirmer Mot de Passe : </label>
		<input type="password" id="Pass_conf" name="Pass_conf"> <br/>
		
		<input type="submit" name="Creer" value="Creer" />
		
	</form>
	
<?php
	if( isset( $_GET["Identifiant"]) && ($_GET["Identifiant"] != "") &&
		isset( $_GET["Pass"]) && ($_GET["Pass"] != "") &&
		isset( $_GET["Pass_conf"]) && ($_GET["Pass_conf"] != ""))
	{
		if ($_GET["Pass_conf"] == $_GET["Pass"])
		{
			$idd="SELECT count(*) from isengon2_utilisateurs where Identifiant='" . $_GET["Identifiant"] ."' ;";
			
			if (mysql_query($idd) != 0)
			{
				$ajout="INSERT INTO isengon2_utilisateurs(Identifiant, Pass) VALUES('".$_GET["Identifiant"]."' , '".$_GET["Pass"]."');";
				mysql_query($ajout);
				header('location:session.php');
			}
			else
			{
			echo "Cet utilisateur (".$_GET["Identifiant"].") existe déja !";
			}
			
		}
		else
		{
			echo "Les mots de passes entrés sont différents !";
		}
	}
?>
				<br/><br/><a href='session.php'> Page de Connexion </a>
	</body>
</html>