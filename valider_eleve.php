<html>
	<head>
		<meta charset ="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>Valider un élève</title>
	</head>
	<body>
		<h1>Page de traitement de l'ajout de l'élève</h1>
		<p>
		<?php
			$dbhost = '';
            $dbuser = '';
            $dbpass = '';
            $dbname = '';
			$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
			mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

			$valider=$_POST["valider"];
			//echo "<br> incrustation de code html";
			//echo "<br> La réponse est : ".$valider;

			date_default_timezone_set('Europe/Paris');
			$dateInscription = date("Y\-m\-d");
			$nom=$_POST["nom"];
			$prenom=$_POST["prenom"];
			$dateNaiss=$_POST["dateNaiss"];

			if($valider=="oui")
			{
				$query= "insert into eleves values (NULL, '$nom', '$prenom', '$dateNaiss','$dateInscription')";
				echo "<br>L'élève a été rajoutté(e). ";
				//echo "<br>$query<br>";
				// important echo a faire systematiquement, c'est impose !
				$result = mysqli_query($connect, $query);
				// $query utilise comme parametre de mysqli_query
				// le test ci-dessous est desormais impose pour chaque appel de :
				// mysqli_query($connect, $query);
				if (!$result)
				{
					echo "<br>pas bon  ".mysqli_error($connect);
					exit;
				}
			}
			else 
			{ 
				echo "<br>L'élève n'a pas été rajoutté(e). ";
			}
			mysqli_close($connect);
		
		?>
		</p>	
	</body>
</html>
