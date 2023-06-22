<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mes_styles.css">
</head>
<body>
    <h1 class="style-titre2">Recapitulatif</h1>
    <?php
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $dateNaiss = $_POST["dateNaiss"];
        date_default_timezone_set("Europe/Paris");
        $date = date("Y\-m\-d");


        $dbhost ='tuxa.sme.utc';
        $dbuser = 'nf92p044';
        $dbpass = '9HjRD55HJnni';
        $dbname = 'nf92p044';

        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        // Test de Connexion
        if (!$connect) {
            die("Erreur de connection à MySql");
        }

        mysqli_set_charset($connect, "utf8");

        $query  = "INSERT INTO eleves VALUES(NULL,'$nom', '$prenom', '$dateNaiss', '$date')";
        $result = mysqli_query($connect, $query);

        if (!$result) {
            echo "<label class='message'>La requête $query a échoué: " , mysqli_error($connect) ."</label><br>";
            echo "<br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
        } else {
            echo"<div class='box'>";
            echo "<label class='form-label'>Mise à jour réussie !</label><br><br><br>";
            echo "<label class='message'>Nom : $nom</label><br><br><br>";
            echo "<label class='message'>Prénom : $prenom</label><br><br><br>";
            echo "<label class='message'>Date de naissance : $dateNaiss</label>";
            echo "<br><br><br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
            echo"</div>";
        
        }

        
        //End of double check
        

        mysqli_close($connect);
    

       
    ?>
    

</body>
</html>