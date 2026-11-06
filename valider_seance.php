<html>
	<head>
		<meta charset ="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>Noter une séance</title>
	</head>
	<body>
		<h1>Noter une séance</h1>
        <?php
            $dbhost = '';
            $dbuser = '';
            $dbpass = '';
            $dbname = '';
            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
            mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
            
            $idseance=$_POST['idseance'];
            //echo "<br> La valeur de idseance est $idseance";

            $queryv= "SELECT eleves.ideleve , eleves.nom , eleves.prenom FROM eleves INNER JOIN inscription ON eleves.ideleve = inscription.ideleve WHERE inscription.idseance='$idseance'";
            //echo "<br> La requete est $queryv";

            $resultv= mysqli_query($connect,$queryv);
            // ATTENTION il manque les affichages et tests de debugage !!!!
            
            if (!$resultv)
            {
                echo "<br>pas bon  ".mysqli_error($connect);
                exit;
            } 

            echo "<form METHOD='POST' ACTION='noter_eleves.php'>";
            echo "<p> Vous notez les élèves pour la séance $idseance <br><br>";
            echo "<input type='hidden' name='idseance' value='$idseance'>";
            echo "<table border='1'> <tr> <th>Nom Prénom</th> <th>Fautes</th> </tr>";

            while ($row = mysqli_fetch_row($resultv)) 
            { 
                $ideleve = $row[0];
                echo "<tr> <td>$row[1] $row[2]</td> <td><input type='number' name='fautes[$ideleve]' max='40' min='0'></td> </tr>";
            }

            echo "</table>";
            echo "<input type='submit' value='VALIDER'>";
            echo "</form>";

            mysqli_close($connect);
        ?>
    </body>
</html>
