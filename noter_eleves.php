<html>
	<head>
		<meta charset ="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>Noter une séance</title>
	</head>
	<body>
		<h1>Noter une séance</h1>
        <?php
            $dbhost = 'tuxa.sme.utc';
            $dbuser = 'nf92a029';
            $dbpass = 'fhO30ICrrpvU';
            $dbname = 'nf92a029';
            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
            mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

            $idseance = $_POST['idseance'];

            $queryv = "SELECT eleves.ideleve, eleves.nom, eleves.prenom FROM eleves INNER JOIN inscription ON eleves.ideleve = inscription.ideleve WHERE inscription.idseance = '$idseance'";
            //echo "<br> La requete est $queryv";
            $resultv = mysqli_query($connect, $queryv);

            if (!$resultv) {
                echo "<br><p>pas bon " . mysqli_error($connect);
                exit;
            }

            if (isset($_POST['fautes'])) 
            {
                foreach ($_POST['fautes'] as $ideleve => $fautes) 
                {//$_POST['fautes'] = [
                //   1 => 5,   L'élève avec l'ID 1 a 5 fautes
                //   2 => 3,   L'élève avec l'ID 2 a 3 fautes
                //  ]
                    if ($fautes !== '') 
                    {
                        $fautes = intval($fautes);
                        $note = 40 - $fautes;
                        $queryUpdate = "UPDATE inscription SET note = '$note' WHERE ideleve = '$ideleve' AND idseance = '$idseance'";
                    if (!mysqli_query($connect, $queryUpdate)) 
                    {
                        echo "Erreur de mise à jour pour l'élève $ideleve : " . mysqli_error($connect);
                    }
                    }
                }
            echo "<br><p>Les notes ont été mises à jour!</p>";
            }

            $queryv = "SELECT eleves.ideleve, eleves.nom, eleves.prenom, inscription.note FROM eleves INNER JOIN inscription ON eleves.ideleve = inscription.ideleve WHERE inscription.idseance = '$idseance'";
            //echo "<br> La requete est $queryv";
            $resultv = mysqli_query($connect, $queryv);

            echo "<form method='POST' action='noter_eleves.php'>";
            echo "<input type='hidden' name='idseance' value='$idseance'>";
            echo "<table border='1'>";
            echo "<tr><th>Nom Prénom</th><th>Fautes</th><th>Note actuelle</th></tr>";

            while ($row = mysqli_fetch_row($resultv)) 
            {
                $ideleve = $row[0];
                $nom = $row[1];
                $prenom = $row[2];
                $note = $row[3];
                echo "<tr> <td>$nom $prenom</td> <td><input type='number' name='fautes[$ideleve]' value='' max='40' min='0'></td> <td>$note</td> </tr>";
            }

            echo "</table>";
            echo "<input type='submit' value='VALIDER'>";
            echo "</form>";

            mysqli_close($connect);

            // $idseance = $_POST['idseance'];
            //echo "<br> La valeur de idseance est $idseance";

            //$queryv= "SELECT eleves.ideleve , eleves.nom , eleves.prenom FROM eleves INNER JOIN inscription ON eleves.ideleve = inscription.ideleve WHERE inscription.idseance='$idseance'";
            //echo "<br> La requete est $queryv";

            //$resultv = mysqli_query($connect, $queryv);

            //if (!$resultv) {
            //    echo "<br><p>Pas bon " . mysqli_error($connect);
            //    exit;
            //}


            //while ($row = mysqli_fetch_row($resultv)) {
            //    $ideleve = $row[0];
            //    if (isset($_POST['fautes']) ) 
            //   {
            //       $note = 40 - intval($_POST['fautes']);
            //        $queryUpdate = "UPDATE inscription SET note = '$note' WHERE ideleve = '$ideleve' AND idseance = '$idseance'";

            //       if (!mysqli_query($connect, $queryUpdate)) {
            //           echo "Erreur de mise à jour pour l'élève $ideleve : " . mysqli_error($connect);
            //        }
            //    }
            //}

            //while ($row = mysqli_fetch_row($resultv)) {
            //    $ideleve = $row[0];
            //    if (isset($_POST['nouvellenote']) ) 
            //    {
            //        $note =$_POST['nouvellenote'];
            //        $queryUpdate = "UPDATE inscription SET note = '$note' WHERE ideleve = '$ideleve' AND idseance = '$idseance'";

            //       if (!mysqli_query($connect, $queryUpdate)) {
            //           echo "Erreur de mise à jour pour l'élève $ideleve : " . mysqli_error($connect);
            //        }
            //   }
            //}
            // 
            //echo "<br><p>Les fautes ont été mises à jour !";


            //$queryv= "SELECT eleves.ideleve , eleves.nom , eleves.prenom FROM eleves INNER JOIN inscription ON eleves.ideleve = inscription.ideleve WHERE inscription.idseance='$idseance'";
            //echo "<br> La requete est $queryv";

            //while ($row = mysqli_fetch_row($resultv)) {
            //    $ideleve = $row[0];

            //    $queryNote = "SELECT note FROM inscription WHERE ideleve = '$ideleve' AND idseance = '$idseance'";
            //   $resultNote = mysqli_query($connect, $queryNote);
            //    $note = 0;
            //  if ($rowNote = mysqli_fetch_row($resultNote)) {
            //      $note = $rowNote[0]; // Recuperer la valeur actuelle de la note
            //  }

            //  echo "<tr><td>$row[1] $row[2]</td><td>$note</td></tr>";
            // }

            // echo "</table>";

            // $queryv= "SELECT eleves.ideleve , eleves.nom , eleves.prenom FROM eleves INNER JOIN inscription ON eleves.ideleve = inscription.ideleve WHERE inscription.idseance='$idseance'";
            //echo "<br> La requete est $queryv";
            //$resultv = mysqli_query($connect, $queryv);

            //echo "<form METHOD='POST' ACTION='noter_eleves.php'>";
            //echo "<p> Vous notez les élèves pour la séance $idseance <br><br>";
            //echo "<input type='hidden' name='idseance' value='$idseance'>";
            //echo "<table border='1'> <tr> <th>Nom Prénom</th> <th>Note</th> </tr>";
            //while ($row = mysqli_fetch_row($resultv)) 
            // { 
            //    $ideleve = $row[0];
            //     echo "<tr> <td>$row[1] $row[2]</td> <td><input type='number' name='nouvellenote' placeholder='$note' max='40' min='0'></td> </tr>";
            //}
            //echo "</table>";
            //echo "<input type='submit' value='VALIDER'>";
            //echo "</form>";

            // mysqli_close($connect);

        ?>
    </body>
</html>
