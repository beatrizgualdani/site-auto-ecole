<html>
	<head>
		<meta charset ="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>Ajouter un thème</title>
	</head>
	<body>
		<h1>Page traitement de thème</h1>
		<?php

			$nom=$_POST["nom"];
			$descriptif=$_POST["descriptif"];
			
			//echo "<br> incrustation de code html";
			echo "<p> Le <strong>nom</strong> du thème est : ".$nom."<p>";
			echo "<p class='long-text'>Le <strong>descriptif</strong> du thème est : ".$descriptif."</p>";
			$dbhost = '';
            $dbuser = '';
            $dbpass = '';
            $dbname = '';

			$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
			
			//la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
			mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
			
			$query = "insert into themes values (NULL, '$nom', 0, '$descriptif')";
			
			//echo "<br>$query<br>";
			// important echo a faire systematiquement, c'est impose !

			$result = mysqli_query($connect, $query);
			// $query utilise comme parametre de mysqli_query
			// le test ci-dessous est desormais impose pour chaque appel de :
			// mysqli_query($connect, $query);
			if (!$result)
			{
				echo "<br><p>pas bon  ".mysqli_error($connect);
			}
			mysqli_close($connect);

		?>	
	</body>
</html>
