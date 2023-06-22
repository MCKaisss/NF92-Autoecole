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
    <h1 class="style-titre2">RECAPITULATIF</h1>
    <?php
        $seance = $_POST["menuChoixSeance"];
        $eleve = $_POST["menuChoixEleve"];

        include("connexion.php");

        $seanceQuery = "SELECT * FROM inscription WHERE idseance='$seance' AND ideleve='$eleve'";
        $seanceResult = mysqli_query($connect, $seanceQuery);


        if (mysqli_num_rows($seanceResult) > 0) {
            echo"<div class='box'>";
            echo"<h2 class='style-titre3-type1'>Erreur</h2>";
            echo "<label class='form-label'>L'élève est déjà inscrit sur cette séance.</label><br>";
            echo "<br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
            echo "<a href='inscription_eleve.php' target='contenu'><button class='form-button'>Retour en arrière</button></a>";
            echo"</div>";
        } else {
            $query = "INSERT INTO inscription VALUES ('$seance', '$eleve', -1)";
            $result = mysqli_query($connect, $query);
    
            if (!$result) {
                echo "<p>La requête $query a échoué:" . mysqli_error($connect) . "</p>";
            } else {
                $eleveQuery = "SELECT* FROM eleves WHERE ideleve='$eleve'";
                $eleveResult = mysqli_query($connect, $eleveQuery);

                $eleveassoc = mysqli_fetch_assoc($eleveResult);
                $nom = $eleveassoc['nom'];
                $prenom = $eleveassoc['prenom'];

                //recherche des infos seances
                $seanceInfoQuery = "SELECT * FROM seances WHERE idseance='$seance'";
                $seanceInfoResult = mysqli_query($connect, $seanceInfoQuery);
                $seanceInfoAssoc = mysqli_fetch_assoc($seanceInfoResult);
                $theme = $seanceInfoAssoc['Idtheme'];
                $date = $seanceInfoAssoc['DateSeance'];

                //recherche des infos themes
                $themeInfoQuery = "SELECT * FROM themes WHERE idtheme='$theme'";
                $themeInfoResult = mysqli_query($connect, $themeInfoQuery);
                $themeInfoAssoc = mysqli_fetch_assoc($themeInfoResult);
                $tnom = $themeInfoAssoc['nom'];
                
                
                echo"<div class='box'>";
                echo "<label class='form-label'>Mise à jour réussie. Elève Inscrit à la séance.</label><br><br><br>";
                echo"<label class='message'>Eleve: $prenom $nom </label><br><br><br><br>";
                echo "<label class='message'>Séance : $seance</label>";
                echo "<label class='message'>Date : $date</label><br><br><br>";
                echo "<label class='message'>Theme : $tnom</label><br><br><br>";
                echo "<a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
                echo "<a href='inscription_eleve.php' target='contenu'><button class='form-button'>Inscrire un élève</button></a>";
                echo"</div>";
            }
        }
        mysqli_close($connect);    
            
       

       
    ?>
    

</body>
</html>