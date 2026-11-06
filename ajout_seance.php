<html>
	<head>
		<meta charset ="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>Ajouter une séance</title>
	</head>
	<body>
		<h1>Ajouter une séance</h1>
        <p>
        <?php
            $dbhost = '';
            $dbuser = '';
            $dbpass = '';
            $dbname = '';
            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
            mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

            $query= "SELECT * FROM themes where supprime=0";
            //echo "<br> La requete est $query";
            $result = mysqli_query($connect,$query);
            // ATTENTION il manque les affichages et tests de debugage !!!!
            if (!$result)
            {
                echo "<br>pas bon  ".mysqli_error($connect);
                exit;
            }

            echo "<FORM METHOD='POST' ACTION='ajouter_seance.php' >";
            //echo "<TABLE BORDER='1'>";
            echo "<select name='idtheme' size='5' style='width: 60%;'>";
            while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
            {
                //echo "<TR>";
                //echo "<TD>".$row[0]."</TD><TD>".$row[1]."</TD><TD>".$row[1]."</TD>";
                //echo "</TR>";
                echo "<OPTION VALUE='$row[0]'>$row[1]</OPTION>";
            }
            //echo "</TABLE>";
            
            echo "</select>";
            echo "<BR>";

            echo "<label for='DateSeance'>Date de la séance :</label>";
            echo "<input type='date' name='DateSeance' id='DateSeance' required>";
            echo "<br><br>";

            echo "<label for='EffMax'>Effectif maximum :</label>";
            echo "<input type='number' name='EffMax' id='EffMax' required min='1' max='100'>";
            echo "<br><br>";

            echo "<INPUT type='submit' value='Enregistrer séance'>";
            echo "</FORM>";

            mysqli_close($connect);
        ?>
        <p>
    </body>
</html>
