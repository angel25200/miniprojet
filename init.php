<?php
$redirection='page1.php';
?>


<html lang="fr">
	<head>
		<meta name=content="text/html" charset="UTF-8" />

<script language="JavaScript">


function reste(seconde)
{
	if (seconde > -0)
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
mysql_select_db("miniprojetBDD");


// Les TABLES
$query5="drop database miniprojetBDD;";
$query6="create database miniprojetBDD;";
$query7="use miniprojetBDD";
	
$query8="CREATE TABLE if not exists iut
		(
			noIut INT NOT NULL auto_increment,
			nomIut  VARCHAR(50),
			adresse  VARCHAR(50),
			nbEtudiant INT,
			primary key (noIut)
		) ENGINE=InnoDb;"; 
		
$query9="CREATE TABLE if not exists manifestation
		(
			numMan INT not null auto_increment,
			nomMan  VARCHAR(50),
			dateMan DATE,
			noIut INT NOT NULL,
			CONSTRAINT fk_manifestation_iut 
						FOREIGN KEY (noIut)
						REFERENCES iut(noIut),
			primary key (numMan)
		) ENGINE=InnoDb;";

$query10="CREATE TABLE if not exists etudiant
		(
			noEtudiant INT not null auto_increment,
			nom  VARCHAR(50),
			age INT(2),
			sexe VARCHAR(10),
			noIut INT NOT NULL,
			CONSTRAINT fk_etudiant_iut 
						FOREIGN KEY (noIut)
						REFERENCES iut(noIut),
			primary key (noEtudiant)
		) ENGINE=InnoDb;";

$query11="CREATE TABLE if not exists reunie
			(
				numMan INT NOT NULL,
				CONSTRAINT fk_reunie_manifestation 
							FOREIGN KEY (numMan)
							REFERENCES manifestation(numMan), 
				noIut INT NOT NULL,
				CONSTRAINT fk_reunie_iut 
							FOREIGN KEY (noIut)
							REFERENCES iut(noIut),
				primary key (numMan, noIut)
			)ENGINE=InnoDb;";

$query12="CREATE TABLE if not exists epreuve
		(
			numEpreuve INT NOT NULL auto_increment,
			intitule VARCHAR(50),
			primary key (numEpreuve)
		) ENGINE=InnoDb;";

$query13="CREATE TABLE if not exists participe
		(
			numMan INT NOT NULL,
			CONSTRAINT fk_participe_manifestation 
						FOREIGN KEY (numMan)
						REFERENCES manifestation(numMan),
			numEpreuve INT NOT NULL,
			CONSTRAINT fk_participe_epreuve 
						FOREIGN KEY (numEpreuve)
						REFERENCES epreuve(numEpreuve),
			noEtudiant INT NOT NULL,
			CONSTRAINT fk_participe_etudiant 
						FOREIGN KEY (noEtudiant)
						REFERENCES etudiant(noEtudiant),
			resultat INT(3),
			primary key (numMan, numEpreuve, noEtudiant)
		) ENGINE=InnoDb;";

$query14="CREATE TABLE if not exists contenu
		(
			numMan INT NOT NULL,
			CONSTRAINT fk_contenu_manifestation 
						FOREIGN KEY (numMan)
						REFERENCES manifestation(numMan),
			numEpreuve INT NOT NULL,
			CONSTRAINT fk_contenu_epreuve 
						FOREIGN KEY (numEpreuve)
						REFERENCES epreuve(numEpreuve),
			primary key (numMan, numEpreuve)
		) ENGINE=InnoDb;";




// LES IUTs
$query15='INSERT INTO iut VALUES (null,"info", "belfort", 92);';
$query16='INSERT INTO iut VALUES (null,"geii", "belfort", 80);';
$query17='INSERT INTO iut VALUES (null,"SRC", "Montbeliard", 75);';
$query18='INSERT INTO iut VALUES (null,"GC", "vesoul", 87);';




// Les Manifestations
$query19='INSERT INTO manifestation VALUES (null,"Tous ensemble","2013-09-20",1)';
$query20='INSERT INTO manifestation VALUES (null,"Tous ensemble","2013-09-21",2)';
$query21='INSERT INTO manifestation VALUES (null,"Tous ensemble","2013-09-22",3);';
$query22='INSERT INTO manifestation VALUES (null,"Tous ensemble","2013-09-23",4);';
$query23='INSERT INTO manifestation VALUES (null,"Fous des Maths","2013-10-10",2);';
$query24='INSERT INTO manifestation VALUES (null,"Fous des Maths","2013-10-11",3);';
$query25='INSERT INTO manifestation VALUES (null,"Fous des Maths","2013-10-12",4);';
$query26='INSERT INTO manifestation VALUES (null,"Fous des Maths","2013-10-13",1);';
$query27='INSERT INTO manifestation VALUES (null,"Mariage pour tous","2013-12-22",1);';
$query28='INSERT INTO manifestation VALUES (null,"Mariage pour tous","2013-12-22",2);';
$query29='INSERT INTO manifestation VALUES (null,"Mariage pour tous","2013-12-22",3);';
$query30='INSERT INTO manifestation VALUES (null,"Mariage pour tous","2013-12-22",4);';




// Les Eleves
$query31='INSERT INTO etudiant VALUES (null,"julien",19,"masculin",1);';
$query32='INSERT INTO etudiant VALUES (null,"Manon",20,"feminin",1);';
$query33='INSERT INTO etudiant VALUES (null,"Pierre",19,"masculin", 1);';
$query34='INSERT INTO etudiant VALUES (null,"Franck",19,"masculin",1);';
$query35='INSERT INTO etudiant VALUES (null,"Thomas",20,"masculin",1);';
$query36='INSERT INTO etudiant VALUES (null,"Julie",19,"feminin",1);';
$query37='INSERT INTO etudiant VALUES (null,"Anne",19,"feminin",1);';
$query38='INSERT INTO etudiant VALUES (null,"mohammed",20,"masculin",1);';
$query39='INSERT INTO etudiant VALUES (null,"Francois",19,"masculin",1);';
$query40='INSERT INTO etudiant VALUES (null,"Anthoine",19,"masculin",1);';
$query41='INSERT INTO etudiant VALUES (null,"Amel",21,"feminin",1);';
$query42='INSERT INTO etudiant VALUES (null,"Hana",22,"feminin",1);';
$query43='INSERT INTO etudiant VALUES (null,"Sarah",24,"feminin",1);';
$query44='INSERT INTO etudiant VALUES (null,"Patrick",26,"masculin",1);';
$query45='INSERT INTO etudiant VALUES (null,"Antony",22,"masculin",1);';
$query46='INSERT INTO etudiant VALUES (null,"Jackie",20,"masculin",1);';
$query47='INSERT INTO etudiant VALUES (null,"Ismail",21,"masculin",1);';
$query48='INSERT INTO etudiant VALUES (null,"Israfil",20,"masculin",1);';
$query49='INSERT INTO etudiant VALUES (null,"Melane",22,"feminin",1);';
$query50='INSERT INTO etudiant VALUES (null,"Celine",24,"feminin",1);';

$query51='INSERT INTO etudiant VALUES (null,"julien",20,"masculin",2);';
$query52='INSERT INTO etudiant VALUES (null,"Manon",21,"feminin",2);';
$query53='INSERT INTO etudiant VALUES (null,"Pierre",18,"masculin", 2);';
$query54='INSERT INTO etudiant VALUES (null,"Franck",17,"masculin",2);';
$query55='INSERT INTO etudiant VALUES (null,"Thomas",21,"masculin",2);';
$query56='INSERT INTO etudiant VALUES (null,"Julie",18,"feminin",2);';
$query57='INSERT INTO etudiant VALUES (null,"Anne",18,"feminin",2);';
$query58='INSERT INTO etudiant VALUES (null,"mohammed",21,"masculin",2);';
$query59='INSERT INTO etudiant VALUES (null,"Francois",18,"masculin",2);';
$query60='INSERT INTO etudiant VALUES (null,"Anthoine",18,"masculin",2);';
$query61='INSERT INTO etudiant VALUES (null,"Amel",22,"feminin",2);';
$query62='INSERT INTO etudiant VALUES (null,"Hana",23,"feminin",2);';
$query63='INSERT INTO etudiant VALUES (null,"Sarah",25,"feminin",2);';
$query64='INSERT INTO etudiant VALUES (null,"Patrick",23,"masculin",2);';
$query65='INSERT INTO etudiant VALUES (null,"Antony",21,"masculin",2);';
$query66='INSERT INTO etudiant VALUES (null,"Jackie",23,"masculin",2);';
$query67='INSERT INTO etudiant VALUES (null,"Ismail",22,"masculin",2);';
$query68='INSERT INTO etudiant VALUES (null,"Israfil",21,"masculin",2);';
$query69='INSERT INTO etudiant VALUES (null,"Melane",23,"feminin",2);';
$query70='INSERT INTO etudiant VALUES (null,"Celine",23,"feminin",2);';

$query71='INSERT INTO etudiant VALUES (null,"julien",17,"masculin",3);';
$query72='INSERT INTO etudiant VALUES (null,"Manon",22,"feminin",3);';
$query73='INSERT INTO etudiant VALUES (null,"Pierre",29,"masculin", 3);';
$query74='INSERT INTO etudiant VALUES (null,"Franck",21,"masculin",3);';
$query75='INSERT INTO etudiant VALUES (null,"Thomas",23,"masculin",3);';
$query76='INSERT INTO etudiant VALUES (null,"Julie",18,"feminin",3);';
$query77='INSERT INTO etudiant VALUES (null,"Anne",27,"feminin",3);';
$query78='INSERT INTO etudiant VALUES (null,"mohammed",20,"masculin",3);';
$query79='INSERT INTO etudiant VALUES (null,"Francois",19,"masculin",3);';
$query80='INSERT INTO etudiant VALUES (null,"Anthoine",19,"masculin",3);';
$query81='INSERT INTO etudiant VALUES (null,"Amel",21,"feminin",3);';
$query82='INSERT INTO etudiant VALUES (null,"Hana",22,"feminin",3);';
$query83='INSERT INTO etudiant VALUES (null,"Sarah",24,"feminin",3);';
$query84='INSERT INTO etudiant VALUES (null,"Patrick",26,"masculin",3);';
$query85='INSERT INTO etudiant VALUES (null,"Antony",23,"masculin",3);';
$query86='INSERT INTO etudiant VALUES (null,"Jackie",24,"masculin",3);';
$query87='INSERT INTO etudiant VALUES (null,"Ismail",25,"masculin",3);';
$query88='INSERT INTO etudiant VALUES (null,"Israfil",19,"masculin",3);';
$query89='INSERT INTO etudiant VALUES (null,"Melane",20,"feminin",3);';

$query90='INSERT INTO etudiant VALUES (null,"Cecile",19,"Feminin",1);';
$query91='INSERT INTO etudiant VALUES (null,"Cecile",18,"Feminin",2);';
$query92='INSERT INTO etudiant VALUES (null,"Cecile",21,"Feminin",3);';
$query93='INSERT INTO etudiant VALUES (null,"Cecile",19,"Feminin",4);';
$query94='INSERT INTO etudiant VALUES (null,"Cecile",21,"Feminin",4);';

$query95='INSERT INTO etudiant VALUES (null,"Jean",23,"masculin",3);';
$query96='INSERT INTO etudiant VALUES (null,"Arnaud",24,"masculin",3);';
$query97='INSERT INTO etudiant VALUES (null,"Jean",25,"masculin",1);';
$query98='INSERT INTO etudiant VALUES (null,"Arnaud",21,"masculin",4);';
$query99='INSERT INTO etudiant VALUES (null,"Jean",23,"masculin",2);';
$query100='INSERT INTO etudiant VALUES (null,"Arnaud",24,"masculin",1);';



$query101='INSERT INTO etudiant VALUES (null,"julien",30,"masculin",4);';
$query102='INSERT INTO etudiant VALUES (null,"Manon",29,"feminin",4);';
$query103='INSERT INTO etudiant VALUES (null,"Pierre",31,"masculin", 4);';
$query104='INSERT INTO etudiant VALUES (null,"Franck",29,"masculin",4);';
$query105='INSERT INTO etudiant VALUES (null,"Thomas",30,"masculin",4);';
$query106='INSERT INTO etudiant VALUES (null,"Julie",29,"feminin",4);';
$query107='INSERT INTO etudiant VALUES (null,"Anne",29,"feminin",4);';
$query108='INSERT INTO etudiant VALUES (null,"mohammed",30,"masculin",4);';
$query109='INSERT INTO etudiant VALUES (null,"Francois",39,"masculin",4);';
$query110='INSERT INTO etudiant VALUES (null,"Anthoine",39,"masculin",4);';
$query111='INSERT INTO etudiant VALUES (null,"Amel",31,"feminin",4);';
$query112='INSERT INTO etudiant VALUES (null,"Hana",32,"feminin",4);';
$query113='INSERT INTO etudiant VALUES (null,"Sarah",34,"feminin",4);';
$query114='INSERT INTO etudiant VALUES (null,"Patrick",33,"masculin",4);';
$query115='INSERT INTO etudiant VALUES (null,"Antony",32,"masculin",4);';
$query116='INSERT INTO etudiant VALUES (null,"Jackie",30,"masculin",4);';
$query117='INSERT INTO etudiant VALUES (null,"Ismail",31,"masculin",4);';
$query118='INSERT INTO etudiant VALUES (null,"Israfil",30,"masculin",4);';
$query119='INSERT INTO etudiant VALUES (null,"Melane",32,"feminin",4);';
$query120='INSERT INTO etudiant VALUES (null,"Celine",34,"feminin",4);';




//Les Epreuves
$query121='INSERT INTO epreuve VALUES (null,"mathematiques");';
$query122='INSERT INTO epreuve VALUES (null,"Base De Donnees");';
$query123='INSERT INTO epreuve VALUES (null,"anglais");';
$query124='INSERT INTO epreuve VALUES (null,"algorithme");';



//Les Participations
$query125='INSERT INTO participe VALUES (1,1,1,5);';
$query126='INSERT INTO participe VALUES (1,1,2,2);';
$query127='INSERT INTO participe VALUES (1,1,3,4);';
$query128='INSERT INTO participe VALUES (1,1,4,3);';
$query129='INSERT INTO participe VALUES (1,1,5,1);';
$query130='INSERT INTO participe VALUES (1,1,6,7);';
$query131='INSERT INTO participe VALUES (1,1,7,10);';
$query132='INSERT INTO participe VALUES (1,1,8,9);';
$query133='INSERT INTO participe VALUES (1,1,9,6);';
$query134='INSERT INTO participe VALUES (1,1,10,8);';
$query135='INSERT INTO participe VALUES (1,2,11,5);';
$query136='INSERT INTO participe VALUES (1,2,12,2);';
$query137='INSERT INTO participe VALUES (1,2,13,4);';
$query138='INSERT INTO participe VALUES (1,2,14,3);';
$query139='INSERT INTO participe VALUES (1,2,15,1);';
$query140='INSERT INTO participe VALUES (1,2,16,7);';
$query141='INSERT INTO participe VALUES (1,2,17,10);';
$query142='INSERT INTO participe VALUES (1,2,18,9);';
$query143='INSERT INTO participe VALUES (1,2,19,6);';
$query144='INSERT INTO participe VALUES (1,2,20,8);';
$query145='INSERT INTO participe VALUES (1,3,21,5);';
$query146='INSERT INTO participe VALUES (1,3,22,2);';
$query147='INSERT INTO participe VALUES (1,3,23,4);';
$query148='INSERT INTO participe VALUES (1,3,24,3);';
$query149='INSERT INTO participe VALUES (1,3,25,1);';
$query150='INSERT INTO participe VALUES (1,3,26,7);';
$query151='INSERT INTO participe VALUES (1,3,27,10);';
$query152='INSERT INTO participe VALUES (1,3,28,9);';
$query153='INSERT INTO participe VALUES (1,3,29,6);';
$query154='INSERT INTO participe VALUES (1,3,30,8);';
$query155='INSERT INTO participe VALUES (1,4,31,5);';
$query156='INSERT INTO participe VALUES (1,4,32,2);';
$query157='INSERT INTO participe VALUES (1,4,33,4);';
$query158='INSERT INTO participe VALUES (1,4,34,3);';
$query159='INSERT INTO participe VALUES (1,4,35,1);';
$query160='INSERT INTO participe VALUES (1,4,36,7);';
$query161='INSERT INTO participe VALUES (1,4,37,10);';
$query162='INSERT INTO participe VALUES (1,4,38,9);';
$query163='INSERT INTO participe VALUES (1,4,39,6);';
$query164='INSERT INTO participe VALUES (1,4,40,8);';
$query165='INSERT INTO participe VALUES (2,1,1,5);';
$query166='INSERT INTO participe VALUES (2,1,2,2);';
$query167='INSERT INTO participe VALUES (2,1,3,4);';
$query168='INSERT INTO participe VALUES (2,1,4,3);';
$query169='INSERT INTO participe VALUES (2,1,5,1);';
$query170='INSERT INTO participe VALUES (2,1,6,7);';
$query171='INSERT INTO participe VALUES (2,1,7,10);';
$query172='INSERT INTO participe VALUES (2,1,8,9);';
$query173='INSERT INTO participe VALUES (2,1,9,6);';
$query174='INSERT INTO participe VALUES (2,1,10,8);';
$query175='INSERT INTO participe VALUES (2,2,11,5);';
$query176='INSERT INTO participe VALUES (2,2,12,2);';
$query177='INSERT INTO participe VALUES (2,2,13,4);';
$query178='INSERT INTO participe VALUES (2,2,14,3);';
$query179='INSERT INTO participe VALUES (2,2,15,1);';
$query180='INSERT INTO participe VALUES (2,2,16,7);';
$query181='INSERT INTO participe VALUES (2,2,17,10);';
$query182='INSERT INTO participe VALUES (2,2,18,9);';
$query183='INSERT INTO participe VALUES (2,2,19,6);';
$query184='INSERT INTO participe VALUES (2,2,20,8);';
$query185='INSERT INTO participe VALUES (2,3,21,5);';
$query186='INSERT INTO participe VALUES (2,3,22,2);';
$query187='INSERT INTO participe VALUES (2,3,23,4);';
$query188='INSERT INTO participe VALUES (2,3,24,3);';
$query189='INSERT INTO participe VALUES (2,3,25,1);';
$query190='INSERT INTO participe VALUES (2,3,26,7);';
$query191='INSERT INTO participe VALUES (2,3,27,10);';
$query192='INSERT INTO participe VALUES (2,3,28,9);';
$query193='INSERT INTO participe VALUES (2,3,29,6);';
$query194='INSERT INTO participe VALUES (2,3,30,8);';
$query195='INSERT INTO participe VALUES (2,4,31,5);';
$query196='INSERT INTO participe VALUES (2,4,32,2);';
$query197='INSERT INTO participe VALUES (2,4,33,4);';
$query198='INSERT INTO participe VALUES (2,4,34,3);';
$query199='INSERT INTO participe VALUES (2,4,35,1);';
$query200='INSERT INTO participe VALUES (2,4,36,7);';
$query201='INSERT INTO participe VALUES (4,3,29,6);';
$query202='INSERT INTO participe VALUES (4,3,30,8);';
$query203='INSERT INTO participe VALUES (4,4,31,5);';
$query204='INSERT INTO participe VALUES (4,4,32,2);';
$query205='INSERT INTO participe VALUES (4,4,33,4);';
$query206='INSERT INTO participe VALUES (4,4,34,3);';
$query207='INSERT INTO participe VALUES (4,4,35,1);';
$query208='INSERT INTO participe VALUES (4,4,36,7);';
$query209='INSERT INTO participe VALUES (4,4,37,10);';
$query210='INSERT INTO participe VALUES (4,4,38,9);';
$query211='INSERT INTO participe VALUES (2,4,37,10);';
$query212='INSERT INTO participe VALUES (2,4,38,9);';
$query213='INSERT INTO participe VALUES (2,4,39,6);';
$query214='INSERT INTO participe VALUES (2,4,40,8);';
$query215='INSERT INTO participe VALUES (3,1,1,5);';
$query216='INSERT INTO participe VALUES (3,1,2,2);';
$query217='INSERT INTO participe VALUES (3,1,3,4);';
$query218='INSERT INTO participe VALUES (3,1,4,3);';
$query219='INSERT INTO participe VALUES (3,1,5,1);';
$query220='INSERT INTO participe VALUES (3,1,6,7);';
$query221='INSERT INTO participe VALUES (3,1,7,10);';
$query222='INSERT INTO participe VALUES (3,1,8,9);';
$query223='INSERT INTO participe VALUES (3,1,9,6);';
$query224='INSERT INTO participe VALUES (3,1,10,8);';
$query225='INSERT INTO participe VALUES (3,2,11,5);';
$query226='INSERT INTO participe VALUES (3,2,12,2);';
$query227='INSERT INTO participe VALUES (3,2,13,4);';
$query228='INSERT INTO participe VALUES (3,2,14,3);';
$query229='INSERT INTO participe VALUES (3,2,15,1);';
$query230='INSERT INTO participe VALUES (3,2,16,7);';
$query231='INSERT INTO participe VALUES (3,2,17,10);';
$query232='INSERT INTO participe VALUES (3,2,18,9);';
$query233='INSERT INTO participe VALUES (3,2,19,6);';
$query234='INSERT INTO participe VALUES (3,2,20,8);';
$query235='INSERT INTO participe VALUES (3,3,21,5);';
$query236='INSERT INTO participe VALUES (3,3,22,2);';
$query237='INSERT INTO participe VALUES (3,3,23,4);';
$query238='INSERT INTO participe VALUES (3,3,24,3);';
$query239='INSERT INTO participe VALUES (3,3,25,1);';
$query240='INSERT INTO participe VALUES (3,3,26,7);';
$query241='INSERT INTO participe VALUES (3,3,27,10);';
$query242='INSERT INTO participe VALUES (3,3,28,9);';
$query243='INSERT INTO participe VALUES (3,3,29,6);';
$query244='INSERT INTO participe VALUES (3,3,30,8);';
$query245='INSERT INTO participe VALUES (3,4,31,5);';
$query246='INSERT INTO participe VALUES (3,4,32,2);';
$query247='INSERT INTO participe VALUES (3,4,33,4);';
$query248='INSERT INTO participe VALUES (3,4,34,3);';
$query249='INSERT INTO participe VALUES (3,4,35,1);';
$query250='INSERT INTO participe VALUES (3,4,36,7);';
$query251='INSERT INTO participe VALUES (3,4,37,10);';
$query252='INSERT INTO participe VALUES (3,4,38,9);';
$query253='INSERT INTO participe VALUES (3,4,39,6);';
$query254='INSERT INTO participe VALUES (3,4,40,8);';
$query255='INSERT INTO participe VALUES (4,1,1,5);';
$query256='INSERT INTO participe VALUES (4,1,2,2);';
$query257='INSERT INTO participe VALUES (4,1,3,4);';
$query258='INSERT INTO participe VALUES (4,1,5,1);';
$query259='INSERT INTO participe VALUES (4,1,6,7);';
$query260='INSERT INTO participe VALUES (4,1,7,10);';
$query261='INSERT INTO participe VALUES (4,1,8,9);';
$query262='INSERT INTO participe VALUES (4,1,9,6);';
$query263='INSERT INTO participe VALUES (4,1,10,8);';
$query264='INSERT INTO participe VALUES (4,2,11,5);';
$query265='INSERT INTO participe VALUES (4,2,12,2);';
$query266='INSERT INTO participe VALUES (4,2,13,4);';
$query267='INSERT INTO participe VALUES (4,2,14,3);';
$query268='INSERT INTO participe VALUES (4,2,15,1);';
$query269='INSERT INTO participe VALUES (4,2,16,7);';
$query270='INSERT INTO participe VALUES (4,2,17,10);';
$query271='INSERT INTO participe VALUES (4,2,18,9);';
$query272='INSERT INTO participe VALUES (4,2,19,6);';
$query273='INSERT INTO participe VALUES (4,2,20,8);';
$query274='INSERT INTO participe VALUES (4,3,21,5);';
$query275='INSERT INTO participe VALUES (4,3,22,2);';
$query275='INSERT INTO participe VALUES (4,3,23,4);';
$query276='INSERT INTO participe VALUES (4,3,24,3);';
$query277='INSERT INTO participe VALUES (4,3,25,1);';
$query278='INSERT INTO participe VALUES (4,3,26,7);';
$query279='INSERT INTO participe VALUES (4,3,27,10);';
$query280='INSERT INTO participe VALUES (4,3,28,9);';
$query281='INSERT INTO participe VALUES (4,4,39,6);';
$query282='INSERT INTO participe VALUES (4,4,40,8);';




echo "Votre base de données est en train de s'initialiser :";


for($i=6;$i<=282;$i++)
{
	$st="query".$i;
	echo'<br/>'.${$st};
	mysql_query(${"query".$i});
}
?>

<br/>

	Veuilez patienter, vous allez être automaiquement redirigé vers la page d'acceuil dans <span id="stopwatch"> </sapn>';
		<script> reste(2); </script>';


</body>
</html>

