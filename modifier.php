<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta name=content="text/html" charset="UTF-8" />
	</head>

<body>


<?php

mysql_connect("localhost", "user_progweb", "web");
mysql_select_db("bddprogweb");




function affiche_formulaire($categorie, $montant, $description, $date)
{


?>
<form method="post" action="traitement_modifier.php">

		<input type="hidden" id="ID_depense" name = "ID_depense" value="<?php echo $_GET['ID_depense']?>"> <br/>

		<label> nouvelle catégorie </label>
		<select name="new_categorie"> 
		
			<?php
			$nouvelle_cat=mysql_query("SELECT * FROM isengon2_categorie_depenses;");
			
			while ($row = mysql_fetch_array($nouvelle_cat))
			{
				if ($row["Id_categorie"] == $categorie)
				{
			?>
				<option selected value="<?php echo $row['Id_categorie']; ?>"> <?php echo $row['Libelle'] ?> </option>
			<?php 
				}
				else
				{
				?>
				<option value="<?php echo $row['Id_categorie']; ?>"> <?php echo $row['Libelle'] ?> </option>
				<?php
				}
			}
			?>
	</select> <br/>
		<label> nouveau montant </label>
		<input type="text" id="new_montant" name="new_montant" value="<?php echo $montant; ?>"> <br/>

		<label> nouvelle description </label>
		<input type="text" id="new_description" name="new_description" value="<?php echo $description;?>"> <br/>

		<label> nouvelle date </label>
		<input type="text" id="new_date" name="new_date" value = "<?php echo $date ?>"><br/>

		<input type="submit" name="valider" value="valider" />
		
</form>

<?php
}






function affiche_formulaire_table1_modifier()
{
	$req="SELECT Id_categorie FROM isengon2_details_depenses WHERE id=".$_GET["ID_depense"];
	$recup_cat=mysql_query($req);
	$sql_modifie=mysql_query('SELECT * FROM isengon2_details_depenses where id='.$_GET["ID_depense"]);
	
	
	
	$row=mysql_fetch_array($recup_cat);


	if ($donnees = mysql_fetch_array($sql_modifie)) 
	{

		$tab_date=explode('-', $donnees['Date_depense']);
		$date=$tab_date[2]."/".$tab_date[1]."/".$tab_date[0];
		
		affiche_formulaire($row["Id_categorie"], $donnees['Montant'], $donnees['Description'], $date);
	}
}



function affiche_formulaire_table1_inserer()
{
	affiche_formulaire("","","","".date('d/m/Y'));
}








if ($_GET['ID_depense'] != '')
{
	affiche_formulaire_table1_modifier();
}
else
{
	affiche_formulaire_table1_inserer();
}

?>

</body>

</html>










