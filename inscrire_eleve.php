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
            $dbhost = '';
            $dbuser = '';
            $dbpass = '';
            $dbname = '';
            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
            mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
            
            $idseance=$_POST['idseance'];
            $ideleve=$_POST['ideleve'];
            echo "<br><p> Vous voulez inscrire l'élève $ideleve a la séance $idseance";
            //echo "<br> La valeur de ideleve est ";

            $queryv= "SELECT * FROM inscription where idseance='$idseance' AND ideleve='$ideleve'";
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
                echo "<br><p><strong> Cet élève est déjà inscrit à cette séance. </strong> Tentez une autre séance. <br>";
                exit;
            }

            $query = "SELECT EffMax, DateSeance, nom FROM seances INNER JOIN themes ON seances.Idtheme = themes.idtheme WHERE idseance = '$idseance'";
            $result = mysqli_query($connect, $query);
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            $query = "select * from inscription where idseance = '$idseance'";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result) == $row[0])
            {
                echo "<p>La séance du $row[1] sur le thème '$row[2]' a atteint son effectif maximal de $row[0] personnes.</p>";
                exit;
            }

            $query= "INSERT INTO inscription VALUES($idseance,$ideleve,'-1')";
            //echo "<br> La requete est $query";
            $result = mysqli_query($connect,$query);
            // ATTENTION il manque les affichages et tests de debugage !!!!
            if (!$result)
            {
                echo "<br><p>pas bon  ".mysqli_error($connect);
            } 
            else
            {
                echo "<br><p> Cet élève a bien été(e) inscrit(e) à cette séance!<br>";
            }
            mysqli_close($connect);

        ?>
    </body>
</html>
