<html>
	<head>
		<meta charset ="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>Noter une séance</title>
	</head>
	<body>
		<h1>Consulter un élève</h1>
        <?php
            $dbhost = 'tuxa.sme.utc';
            $dbuser = 'nf92a029';
            $dbpass = 'fhO30ICrrpvU';
            $dbname = 'nf92a029';
            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
            mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
            
            $ideleve=$_POST['ideleve'];
            "<br> La valeur de ideleve est $ideleve";

            $queryv= "SELECT * FROM eleves WHERE ideleve='$ideleve'";
            //echo "<br> La requete est $queryv";

            $resultv= mysqli_query($connect,$queryv);
            // ATTENTION il manque les affichages et tests de debugage !!!!
            
            if (!$resultv)
            {
                echo "<br>pas bon  ".mysqli_error($connect);
                exit;
            } 


            echo "<table border='1'> <tr> <th>ID</th> <th>Nom</th> <th>Prénom</th> <th>Date d'anniversaire</th> <th>Date d'inscription</th> </tr>";

            while ($row = mysqli_fetch_row($resultv)) 
            { 
                $ideleve = $row[0];
                echo "<tr> <td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td> <td>$row[3]</td> <td>$row[4]</td> </tr>";
            }
            echo "</table>";

            mysqli_close($connect);
        ?>
    </body>
</html>