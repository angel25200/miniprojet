<?php
mysql_connect("localhost", "user_progweb", "web");
mysql_select_db("bddprogweb");
?>

<html>

	<head>
		<meta name=content="text/html" charset="UTF-8" />
		<style>
				div {
						padding-top : 20px;
						padding-left : 200px;
						color : red;
					};
		</style>
	</head>

<body>
<?php

session_start();   						//on demarre la session
session_unset();						//on detruit les variables de session
session_destroy();						//on detruit la session

?>

<form method="post" action="test_formulaire.php">

	<div> Pages de Connexion <br/> <br/> </div>
	
	<label> Identifiant : </label>
	<input type="text" id="Identifiant" name="Identifiant"> <br/>
	
	<label> Mot de Passe : </label>
	<input type="password" id="Pass" name="Pass"> <br/>
	<input type="submit" name="Connecter" value="Connecter" />
		
</form>

	<a href='ajout_user.php'> Creer Utilisateur </a>
	
</body>

</html>