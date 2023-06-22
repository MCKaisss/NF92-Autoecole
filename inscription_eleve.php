<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrire un élève à une séance</title>
    <link rel="stylesheet" href="mes_styles.css">
</head>
<body>
    <h1 class="style-titre1">THE AUTO ECOLE</h1>
    <div class="box">
        
        <h2 class="style-titre3-type1">Inscrire un élève</h2>

        <?php
            include("connexion.php");
            $today = date("Y-m-d");

            $result = mysqli_query($connect, "SELECT seances.idseance, seances.DateSeance, seances.Idtheme, seances.EffMax, COUNT(inscription.idseance) AS InscriptionCount
                                            FROM seances
                                            LEFT JOIN inscription ON seances.idseance = inscription.idseance
                                            WHERE seances.DateSeance >= '$today'
                                            GROUP BY seances.idseance
                                            HAVING InscriptionCount < seances.EffMax");

            echo "<form method='POST' action='inscrire_eleve.php' class='form-container'>";
            echo "<div class='form-group'>";
            echo "<label for='menuChoixSeance' class='form-label'>Séance:</label>";
            echo "<select name='menuChoixSeance' id='menuChoixSeance' class='form-input form-input-type1' required>";

            while ($seance = mysqli_fetch_assoc($result)) {
                $idseance = $seance['idseance'];
                $dateSeance = $seance['DateSeance'];
                $idtheme = $seance['Idtheme'];
                $effMax = $seance['EffMax'];
                $inscriptionCount = $seance['InscriptionCount'];

                // Get the theme name from the themes table
                $result2 = mysqli_query($connect, "SELECT nom FROM themes WHERE idtheme = $idtheme");
                $theme = mysqli_fetch_assoc($result2);
                $nomTheme = $theme['nom'];

                // Check if there are available seats
                $placeDispo = $effMax - $inscriptionCount;
                if ($placeDispo > 0) {
                    echo "<option value='$idseance' idtheme='$idtheme' date='$dateSeance'>Séance $idseance - Thème: $nomTheme - $dateSeance (Places libres: $placeDispo)</option>";
                }
            }

            echo "</select>";
            echo "</div><br><br>";

            // Sélectionner un eleve depuis la BDD seances
            $result3 = mysqli_query($connect, "SELECT * FROM eleves");

            echo "<div class='form-group'>";
            echo "<label for='menuChoixEleve' class='form-label'>Elève:</label>";
            echo "<select name='menuChoixEleve' id='menuChoixEleve' class='form-input form-input-type1' required>";
            while ($eleve = mysqli_fetch_assoc($result3)) {
                $ideleve = $eleve['ideleve'];
                $nom = $eleve['nom'];
                $prenom = $eleve['prenom'];
                echo "<option value='$ideleve'>$prenom $nom (ID: $ideleve)</option>";
            }
            echo "</select>";
            echo "</div><br><br>";

            echo "<input type='submit' value='Enregistrer' class='form-button'>";
            echo "</form>";

            mysqli_close($connect);
            ?>

    </div>
    <footer>
        <p class="style-text-footer">© 2023 The Auto Ecole. Tous droits réservés.</p>
    </footer>
</body>
</html>
