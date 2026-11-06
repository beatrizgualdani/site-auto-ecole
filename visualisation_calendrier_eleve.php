<html>
	<head>
		<meta charset ="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>Consulter calendrier</title>
	</head>
	<body>
		<h1>Consulter le calendrier d'un élève</h1>
        <p>
        <?php	
            $dbhost = '';
            $dbuser = '';
            $dbpass = '';
            $dbname = '';

            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
            
            //la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
            mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
            
            $query = "SELECT ideleve, nom, prenom FROM eleves ORDER BY nom";
            echo "<BR>";
            //echo "<br> La requete est $query";
            $result = mysqli_query($connect,$query);

            if (!$result)
            {
                echo "<br><p>pas bon  ".mysqli_error($connect);
                exit;
            }

            echo "<FORM METHOD='POST' ACTION='visualiser_calendrier_eleve.php' >";
            // echo "<TABLE BORDER='1'>";
            echo "<p align='center'>Vous voulez consulter le calendrier d'un élève, veuillez le choisir:";
            echo "<br><br><label>Elèves:<label>";
            echo "<select name='ideleve' size='10' style='width: 60%;'>";
            while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
            {
                //echo "<TR>";
                //echo "<TD>".$row[0]."</TD><TD>".$row[1]."</TD><TD>".$row[1]."</TD>";
                //echo "</TR>";
                echo "<OPTION VALUE='$row[0]'>$row[1] $row[2]</OPTION>";
            }
            //echo "</TABLE>";
            echo "</select>";
            echo "<BR>";
            
            echo "<INPUT type='submit' value='VALIDER'>";
            echo "<BR>";
            echo "</FORM>";
            mysqli_close($connect);

        ?>
    </body>
</html>
