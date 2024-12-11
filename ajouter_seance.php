<html>
    <head>
	    <meta charset ="utf-8">
	    <link rel="stylesheet" href="style.css" type="text/css">
	    <title>Ajouter une séance</title>
    </head>
    <body>
	    <h1>Ajouter une séance</h1>
        <?php
            $dbhost = 'tuxa.sme.utc';
            $dbuser = 'nf92a029';
            $dbpass = 'fhO30ICrrpvU';
            $dbname = 'nf92a029';
            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
            mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
            
            $idtheme=$_POST['idtheme'];
            //echo "<br><p> La valeur de idtheme est $idtheme";
            $DateSeance=$_POST['DateSeance'];
            echo "<br><p> La  date de la séance est le $DateSeance";
            $EffMax=$_POST['EffMax'];
            echo "<br><p> L'effectif maximum est $EffMax élèves";

            $queryv= "SELECT * FROM seances where DateSeance= '$DateSeance'  AND Idtheme=$idtheme";
            //echo "<br> La requete est $queryv";
            $resultv= mysqli_query($connect,$queryv);
            // ATTENTION il manque les affichages et tests de debugage !!!!

            if (!$resultv)
            {
                echo "<br><p>pas bon  ".mysqli_error($connect);
                exit;
            } 

            $n=mysqli_num_rows($resultv);

            if($n!=0)
            {
                echo "<br><p><strong> Il existe deja une seance sur ce theme le $DateSeance,</strong> vous ne pouvez <strong>pas</strong> en créer une deuxieme. <br>";
                exit;
            }

        
            $query= "INSERT INTO seances VALUES(NULL,'$DateSeance',$EffMax,$idtheme)";
            //echo "<br> La requete est $query";
            $result = mysqli_query($connect,$query);
            // ATTENTION il manque les affichages et tests de debugage !!!!

            if (!$result)
            {
                echo "<br><p>pas bon  ".mysqli_error($connect);
            } 
            
            mysqli_close($connect);
        ?>
    </body>
</html>