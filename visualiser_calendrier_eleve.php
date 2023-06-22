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
    <h1 class="style-titre1">THE AUTO ECOLE</h1>
    

    <div class="box">
    <h2 class="style-titre3-type1">Visualisation Eleves </h2>
        <?php

            $ideleve = $_POST["menuChoixEleve"];

            include("connexion.php");

            // Recup infos seances eleves
            $query = "SELECT seances.DateSeance, themes.nom AS theme_nom
            FROM inscription
            INNER JOIN seances ON inscription.idseance = seances.idseance
            INNER JOIN themes ON seances.idtheme = themes.idtheme
            WHERE inscription.ideleve = $ideleve
            AND seances.DateSeance >= CURDATE()";

            $result = mysqli_query($connect, $query);

            if ($result) {

                if (mysqli_num_rows($result) > 0) {
                echo "<table class='style-table'>";
                echo "<tr class='message-tab'><th>Date</th><th>Thème</th></tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    $date = $row['DateSeance'];
                    $theme_nom = $row['theme_nom'];

                    echo "<tr class='message-tab'><td>$date</td><td>$theme_nom</td></tr>";
                }

                echo "</table>";
                } else {
                    echo "<label class='message'>L'élève n'est inscrit à aucune séance à venir.</label><br><br>";
                    echo "<br><a href='visualisation_seance.php' target='contenu'><button class='form-button'>Revenir en arrière</button></a>";
                }
            } else {
            echo "<label class='message>Erreur</label>";
            echo "<br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
            echo "<br><a href='visualisation_seance.php' target='contenu'><button class='form-button'>Revenir en arrière</button></a>";
            }

            // Fermer la connexion à la base de données
            mysqli_close($connect);
            echo "<br><a href='accueil.html' target='contenu'><button class='form-button'>Revenir au menu</button></a>";
        ?>
    
    </div>
    <footer>
        <p class="style-text-footer">© 2023 The Auto Ecole. Tous droits réservés.</p>
    </footer>
</body>
</html>