<html>
	<head>
		<meta charset ="utf-8">
		<link rel="stylesheet" href="style.css" type="text/css">
		<title>Inscrire un élève</title>
	</head>
	<body>
		<h1>Inscrire un élève</h1>
        <p>
        <?php
            $dbhost = 'tuxa.sme.utc';
            $dbuser = 'nf92a029';
            $dbpass = 'fhO30ICrrpvU';
            $dbname = 'nf92a029';
            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
            mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
        
            $query= "SELECT * FROM eleves";
            //echo "<br> La requete est $query";
            $result = mysqli_query($connect,$query);
            // ATTENTION il manque les affichages et tests de debugage !!!!
            if (!$result)
            {
                echo "<br><p>pas bon  ".mysqli_error($connect);
                exit;
            }

            echo "<FORM METHOD='POST' ACTION='inscrire_eleve.php' >";
            // echo "<TABLE BORDER='1'>";
            echo "<BR>";
            echo "<label>Choisir l'élève :<label>";
            echo "<select name='ideleve' size='5' style='width: 60%;'>";
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
            
            //seances

            $query= "SELECT idseance, DateSeance, nom FROM seances AS s INNER JOIN themes as t ON s.Idtheme = t.idtheme WHERE DateSeance>=CURDATE() ORDER BY DateSeance, nom";
            echo "<BR>";
            //echo "<br> La requete est $query";
            
            $result = mysqli_query($connect,$query);
            if (!$result)
            {
                echo "<br><p>pas bon  ".mysqli_error($connect);
                exit;
            }

            // echo "<FORM METHOD='POST' ACTION='inscrire_eleve.php' >";
            // echo "<TABLE BORDER='1'>";
            echo "<label>Choisir la séance:<label>";
            echo "<select name='idseance' size='5' style='width: 60%;'>";

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
            echo "</FORM>";
            mysqli_close($connect);

        ?>
    </body>
</html>