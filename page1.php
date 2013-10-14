<?php

	mysql_connect("localhost", "user_progweb", "web");
	mysql_select_db("miniprojetBDD");


if ($_GET["type"]=="etu")
{
	$retour='SELECT * FROM etudiant e
			ORDER BY noEtudiant ASC ;';
	if (isset ($_POST["searchByName"]))
	{
		$retour="SELECT * FROM etudiant e
			WHERE e.nom like '%".$_POST["searchByName"]."%'
			ORDER BY noEtudiant ASC ;";
	}
}
elseif ($_GET["type"]=="epr")
{
	$retour='SELECT * FROM epreuve
			ORDER BY numEpreuve ASC ;';
	if (isset ($_POST["searchByName"]))
	{
		$retour="SELECT * FROM epreuve
			WHERE intitule LIKE '%".$_POST["searchByName"]."%'
			ORDER BY numEpreuve ASC;";
	}
}

elseif ($_GET["type"]=="iut")
{
	$retour='SELECT * FROM iut
				ORDER BY noIut ASC ;';
	if (isset ($_POST["searchByName"]))
	{
		$retour="SELECT * FROM iut
			WHERE nomIut like '%".$_POST["searchByName"]."%'
			ORDER BY noIut ASC ;";
	}
}

elseif ($_GET["type"]=="man")
{
	$retour='SELECT m.numMan, m.nomMan, m.dateMan, i.nomIut
			FROM manifestation m, iut i
			WHERE m.noIut=i.noIut
				ORDER BY numMan ASC ;';
	if (isset ($_POST["searchByName"]))
	{
		$retour="SELECT m.numMan, m.nomMan, m.dateMan, i.nomIut
			FROM manifestation m, iut i
			WHERE m.noIut=i.noIut
			AND nomMan like '%".$_POST["searchByName"]."%'
			ORDER BY numMan ASC ;";
	}

}
	$test1=mysql_query($retour) or die("ERROR QUERY test1: $retour");
	$test=mysql_query($retour) or die("ERROR QUERY test: $retour");
?>

<html>
	<head>
		<meta name=content="text/html" charset="UTF-8" />
		<link rel="stylesheet" media="screen" type="text/css" title="index" href="style2.css" />
		<link rel="shortcut icon" href="planete" type="image/x-icon" />
		<style>
    		div
    		{
				font-family : arial;
				padding-left:50px;
    			font-size :25px;
 				font-weight : bold; 
    		}
    		span
    		{
    			
    			font-size :15px;
    		}
    	</style>
		
	</head>
<body>

<ul id="menu">
	<li>
		<a href="page1.php?type=etu">Les Etudiants</a>
	</li>
	
	<li>
		<a href="page1.php?type=epr">Les Epreuves</a>
	</li>

	<li>
		<a href="page1.php?type=iut">Les IUTs</a>
	</li>

	<li>
		<a href="page1.php?type=man">Les Manifestations</a>
	</li>
	
	
</ul>


<div>
	<span>
		<br/><br/>Recherche par nom : 


		<form action="<?php echo 'page1.php?type='.$_GET['type'] ?>" method="post">
			<input name="searchByName" type="text" id="searchByName"/>
			<input type="submit" value="rechercher"/>
		</form>
	</span>
</div>


<?php
		//Affichage tableau des etudiants
	if($_GET["type"]=="etu")
	{
		if ($donnees = mysql_fetch_array($test1))
		{
?>
			<table id="tab_etudiant" name="tab_etudiant" class="tab" border="2">
			<tr>
				<th> ID </th>
				<th> Prénom </th>
				<th> Age </th>
				<th> Sexe </th>
				<th> N° IUT </th>
				<th> Modifier / Supprimer </th>
			</tr>
<?php
			while ($donnees = mysql_fetch_array($test))
			{
				echo "<tr>";
					echo "<td>".$donnees['noEtudiant']."</td>";
					echo "<td>".$donnees['nom']."</td>";
					echo "<td>".$donnees['age']."</td>";
					echo "<td>".$donnees['sexe']."</td>";
					echo "<td>".$donnees['noIut']."</td>";
					echo '<td>'.
								'<a href="modifier.php?type='.$_GET["type"].'&noEtudiant='.$donnees['noEtudiant'].'">
										<img style="margin-left:30px;" src="modifier.png" alt="modifier"></a>'.
								'<a  href="supprimer.php?type='.$_GET["type"].'&noEtudiant='.$donnees['noEtudiant'].'">
										<img style="margin-left:30px;" src="supprimer.png" alt="supprimer"></a>'.
						'</td>';
				echo "</tr>";
			}
		}
		else
		{
			echo "<br/>Désolé, aucun étudant a été trouvé !";
		}
				
	}
		// Affichage tableau des epreuves 
	else if($_GET["type"]=="epr")
	{				
		if ($donnees = mysql_fetch_array($test1))
		{
?>
			<table id="tab_epreuve" name="tab_epreuve" class="tab" border="2">
			<tr>
				<th> N° Epreuve </th>
				<th> Nom Epreuve </th>
				<th> Modifier / Supprimer </th>
			</tr>
<?php
			while ($donnees = mysql_fetch_array($test))
			{
				echo "<tr>";
					echo "<td>".$donnees['numEpreuve']."</td>";
					echo "<td>".$donnees['intitule']."</td>";
					echo '<td>'.
								'<a href="modifier.php?type='.$_GET["type"].'&numEpreuve='.$donnees['numEpreuve'].'">
										<img style="margin-left:30px;" src="modifier.png" alt="modifier"></a>'.
								'<a  href="supprimer.php?type='.$_GET["type"].'&numEpreuve='.$donnees['intitule'].'">
										<img style="margin-left:60px;" src="supprimer.png" alt="supprimer"></a>'.
						'</td>';
				echo "</tr>";
			}
		}
		else
		{
			echo "<br/>Désolé, aucune épreuve a dans son intutulé : ".$_POST["searchByName"];
		}
	}
		//Affichage tableau des IUTs
	else if($_GET["type"]=="iut")
	{
		//Debug
		//print("$test\n");
		$donnees = mysql_fetch_array($test1);
		if ($donnees)
		{
?>
			<table id="tab_iut" name="tab_iut" class="tab" border="2">
			<tr>
				<th> N° IUT </th>
				<th> Nom IUT </th>
				<th> Ville IUT </th>
				<th> Nombre Etudiants </th>
				<th> Modifier / Supprimer </th>
			</tr>
<?php
			while ($donnees = mysql_fetch_array($test))
			{
				echo "<tr>";
					echo "<td>".$donnees['noIut']."</td>";
					echo "<td>".$donnees['nomIut']."</td>";
					echo "<td>".$donnees['adresse']."</td>";
					echo "<td>".$donnees['nbEtudiant']."</td>";
					echo '<td>'.
								'<a href="modifier.php?type='.$_GET["type"].'&noIut='.$donnees['noIut'].'">
										<img style="margin-left:30px;" src="modifier.png" alt="modifier"></a>'.
								'<a  href="supprimer.php?type='.$_GET["type"].'&noIut='.$donnees['noIut'].'">
										<img style="margin-left:60px;" src="supprimer.png" alt="supprimer"></a>'.
						'</td>';
				echo "</tr>";

			}
		}
		else
		{
			echo "<br/>Désolé, aucun IUT a été trouvé !";
		}
				
	}
		//Affichage tableau des Manifestations
	else if($_GET["type"]=="man")
	{
		if ($donnees = mysql_fetch_array($test1))
		{
?>
			<table id="tab_man" name="tab_man" class="tab" border="2">
			<tr>
				<th> N° Manifestation </th>
				<th> Nom Manifestation </th>
				<th> Date Manifestation </th>
				<th> IUT concerne </th>
				<th> Modifier / Supprimer </th>
			</tr>
<?php
		
			while ($donnees = mysql_fetch_array($test))
			{
				echo "<tr>";
					echo "<td>".$donnees['numMan']."</td>";
					echo "<td>".$donnees['nomMan']."</td>";
					echo "<td>".$donnees['dateMan']."</td>";
					echo "<td>".$donnees['nomIut']."</td>";
					echo '<td>'.
								'<a href="modifier.php?type='.$_GET["type"].'&numMan='.$donnees['numMan'].'">
										<img style="margin-left:30px;" src="modifier.png" alt="modifier"></a>'.
								'<a  href="supprimer.php?type='.$_GET["type"].'&numMan='.$donnees['numMan'].'">
										<img style="margin-left:60px;" src="supprimer.png" alt="supprimer"></a>'.
						'</td>';
				echo "</tr>";
			}
		}
		else
		{
			echo "<br/>Désolé, aucune manifestation a été trouvé !";
		}
	}
?>
	</table>
	<br/><br/>
	<a name = "deco" href="deconnexion.php"> Deconnexion</a>

</body>
</html>
