<?php
$redirection='./page1.php';
?>


<html lang="fr">
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

mysql_connect("localhost", "user_progweb", "web");
mysql_select_db("bddprogweb");



$tab_date=explode('/', $_POST['new_date']);
$date=$tab_date[2]."-".$tab_date[1]."-".$tab_date[0];


if ($_POST['ID_depense'] != '')
{
	$query=" UPDATE isengon2_details_depenses
	SET
		Id_categorie=".$_POST['new_categorie'].",
		Montant=".$_POST['new_montant'].",
		Description='".$_POST['new_description']."', 
		Date_depense='".$date."'

	WHERE

		id=".$_POST['ID_depense'];
}

else
{
	$query="insert into isengon2_details_depenses (id_Categorie, Montant, Description, Date_depense)".
		' values ("'.$_POST['new_categorie'].'",'.$_POST['new_montant'].',"'.$_POST['new_description'].'","'.$date.'")';
}




echo "Mise à jour effectué : </br>";

echo 'Vous allez être redirigé vers la page d\'acceuil <div id="stopwatch"> </div>';
echo '<script> reste(5); </script>';
echo '<br/><br/>';



mysql_query($query);

?>


</body>
</html>
