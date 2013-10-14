<?php
$redirection='./page1.php';
?>


<html lang="fr">
	<head>
		<meta name=content="text/html" charset="UTF-8" />
	</head>

<body>


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


<?php

mysql_connect("localhost", "user_progweb", "web");
mysql_select_db("bddprogweb");


$sql_supprime=mysql_query('DELETE FROM isengon2_details_depenses where id='.$_GET["ID_depense"]);


echo "Mise à jour effectuer : "; ?> <br/><br/> <?php

echo 'Vous allez être redirigé vers la page d\'acceuil <div id="stopwatch"> </div>';
echo '<script> reste(5); </script>';
echo '<br/><br/>';



mysql_query($sql_supprime);

?>
