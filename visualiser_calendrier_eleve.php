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

            $ideleve = $_POST["ideleve"];
            //echo"<br> La valeur de ideleve est $ideleve";

            $query = "SELECT * FROM eleves where ideleve = $ideleve";
            //echo "<br> La requete est $query";
            $result = mysqli_query($connect,$query);
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            
            echo "<p>Calendrier de l'élève : ID = $row[0] / $row[1] $row[2]<br>";

            $query = "SELECT seances.DateSeance, themes.nom FROM inscription INNER JOIN seances ON seances.idseance = inscription.idseance 
            INNER JOIN themes ON themes.idtheme = seances.Idtheme WHERE inscription.ideleve = '$ideleve' AND seances.DateSeance > CURDATE() ORDER BY seances.DateSeance";
            //echo "<br> La requete est $query";
            $result = mysqli_query($connect,$query);
            
            echo "<table BORDER = 1 ALIGN = 'center'>";
            echo "<tr><th>Date de la séance</th><th>Thème de la séance</th></tr>";
            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) 
            {
                echo "<tr>";
                echo "<td>$row[0]</td>";
                echo "<td>$row[1]</td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_close($connect);
        ?>
    </body>
</html>