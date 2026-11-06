<html>
	<head>
		<meta charset ="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>Ajouter un élève</title>
	</head>
	<body>
		<h1>Page de traitement de l'ajout de l'élève</h1>
		<?php

			$nom=$_POST["nom"];
			$prenom=$_POST["prenom"];
			$dateNaiss=$_POST["dateNaiss"];
			//echo "<br> incrustation de code html";
			echo "<p><strong>Nom : </strong>".$nom."</p>";
			echo "<p><strong>Prénom : </strong>".$prenom."</p>";
			echo "<p><strong>Date de naissance : </strong>".$dateNaiss."</p>";
			date_default_timezone_set('Europe/Paris');
			$dateInscription = date("Y\-m\-d");
			echo "<p><strong> Date d'inscription : </strong>"."'$dateInscription'"."</p><br>";

			$annee = substr($dateNaiss, 0, 4);
            if ($annee < "1914" || $annee > "2011") 
			{
                echo "<p>L'élève n'a <strong>pas</strong> été inscrit.</p>";
				echo "<p>L'âge minimum pour s'inscrire est <strong>15</strong> ans. L'âge maximal pour s'inscrire est <strong>110</strong> ans.</p>";
                exit();
            }

			$dbhost = '';
            $dbuser = '';
            $dbpass = '';
            $dbname = '';

			$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
			//la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
			mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8


			//$query = "insert into eleves values ('$nom')";
			// Est-ce que cela fonctionne ? Pourquoi ?
			// ci-dessous autre requete prete a etre testee ensuite voir sujet de TP
			
			$query_verif = "select * from eleves where nom='$nom' and prenom='$prenom'";
			$result_verif= mysqli_query($connect, $query_verif);
			$count= mysqli_num_rows($result_verif);

			if($count==0)
			{
				$query= "insert into eleves values (NULL, '$nom', '$prenom', '$dateNaiss','$dateInscription')";
				//echo "<br>$query<br>";
				// important echo a faire systematiquement, c'est impose !
				$result = mysqli_query($connect, $query);
				// $query utilise comme parametre de mysqli_query
				// le test ci-dessous est desormais impose pour chaque appel de :
				// mysqli_query($connect, $query);
				if (!$result)
				{
					echo "<p><br>pas bon  ".mysqli_error($connect)."</p>";
					exit;
				}
			}
			else 
			{ //homonyme trouves 
			//formulaire
				echo "<p><strong>Nous avons retrouvé $count élèves inscrits avec le même nom ET prénom</strong><p><br><br> ";
				echo "<form action='valider_eleve.php' method='post'>";
				echo "<p align='center'>Cet élève est déjà dans la base de données";
				echo "<p align='center'>Voulez vous encore l'ajouter ?<br>";
				echo "<INPUT type='radio' name='valider' value='oui'/> Oui";
				echo "<INPUT type='radio' name='valider' value='non'/> Non";
				echo "<input type='hidden' name='nom' value='$nom'/>";
				echo "<input type='hidden' name='prenom' value='$prenom' />";
				echo "<input type='hidden' name='dateNaiss' value='$dateNaiss'/>";
				echo "<br><br><input type='submit' name='boutonvalider' value='VALIDER'/>";
				echo "</form>";
			}
			mysqli_close($connect);
		?>
	</body>
</html>
