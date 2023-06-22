<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Désinscrire un élève d'une séance</title>
    <link rel="stylesheet" href="mes_styles.css">
</head>
<body>
    <h1 class="style-titre2">RECAPITULATIF</h1>
    <?php
        $seance = $_POST["menuChoixSeance"];
        $eleve = $_POST["menuChoixEleve"];

        include("connexion.php");

        $seanceCheckQuery = "SELECT * FROM inscription WHERE idseance='$seance' AND ideleve='$eleve'";
        $seanceCheckResult = mysqli_query($connect, $seanceCheckQuery);

        $eleveQuery = "SELECT * FROM eleves WHERE ideleve='$eleve'";
        $eleveResult = mysqli_query($connect, $eleveQuery);

        $eleveassoc = mysqli_fetch_assoc($eleveResult);
        $nom = $eleveassoc['nom'];
        $prenom = $eleveassoc['prenom'];

        if (mysqli_num_rows($seanceCheckResult) > 0) {
            $deleteQuery = "DELETE FROM inscription WHERE idseance='$seance' AND ideleve='$eleve'";
            $deleteResult = mysqli_query($connect, $deleteQuery);

            if (!$deleteResult) {
                echo "<p>La requête $deleteQuery a échoué : " . mysqli_error($connect) . "</p>";
            } else {

                //recherche des infos seances
                $seanceInfoQuery = "SELECT * FROM seances WHERE idseance='$seance'";
                $seanceInfoResult = mysqli_query($connect, $seanceInfoQuery);
                $seanceInfoAssoc = mysqli_fetch_assoc($seanceInfoResult);
                $theme = $seanceInfoAssoc['Idtheme'];
                $date = $seanceInfoAssoc['DateSeance'];

                echo"<div class='box'>";
                echo "<label class='form-label'>Mise à jour réussie. Elève désinscrit à la séance.</label><br><br><br>";
                echo"<label class='message'>Eleve: $prenom $nom </label><br><br><br><br>";
                echo "<label class='message'>Séance : $seance</label>";
                echo "<label class='message'>Date : $date</label><br><br><br>";
                echo "<a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
                echo "<a href='desinscription_eleve.php' target='contenu'><button class='form-button'>Désinscrire un élève</button></a>";
                echo"</div>";
            }
        } else {
            echo"<div class='box'>";
            echo"<h2 class='style-titre3-type1'>Erreur</h2>";
            $nomImage = 'elon.png';
            echo '<img src="' . $nomImage . '" alt="elon" style="width: 386px; height: 284px;">';
            echo "<label class='message-box'>L'élève n'est pas inscrit sur cette séance.</label><br>";
            echo "<label class='message-box'>Veuillez désormais choisir une des options proposées.</label><br>";
            echo "<br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
           
            echo "<a href='desinscription_eleve.php' target='contenu'><button class='form-button'>Désinscrire un élève</button></a>";
            echo "<a href='consultation_eleve.php' target='contenu'><button class='form-button'>Consulter un élève</button></a>";
            echo"</div>";
        }

        mysqli_close($connect);
    ?>
</body>
</html>
