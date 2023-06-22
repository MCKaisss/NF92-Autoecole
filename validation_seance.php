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
        <h2 class="style-titre3-type1">Valider une séance</h2>
        <?php
            include("connexion.php");
            
            // Sélectionner la séance depuis la BDD seances
            $result1 = mysqli_query($connect, "SELECT * FROM seances WHERE dateSeance < CURDATE()");

            echo "<form method='POST' action='valider_seance.php' class='form-container'>";
            
            echo "<div class='form-group'>";
            echo "<label for='menuChoixSeance' class='form-label'>Séance:</label>";
            echo "<select class='form-input form-input-type1' name='menuChoixSeance' required>";
            while ($seance = mysqli_fetch_assoc($result1)){
                $idseance = $seance['idseance'];
                $dateSeance = $seance['DateSeance'];
                $idtheme = $seance['Idtheme'];

                // Récupérer le nom du thème à partir de la BDD theme
                $result2 = mysqli_query($connect, "SELECT nom FROM themes WHERE idtheme = $idtheme");
                $theme = mysqli_fetch_assoc($result2);
                $nomTheme = $theme['nom'];
                
                echo "<option value='$idseance' idtheme='$idtheme' date='$dateSeance'>Séance $idseance - Thème: $nomTheme - $dateSeance</option>";
            }
            echo "</select><br><br>";
            echo "</div>";
            echo "<input type='submit' value='Valider' class='form-button'>";
            
            echo "</form>";
            
        
        ?>
    </div>
    <footer>
        <p class="style-text-footer">© 2023 The Auto Ecole. Tous droits réservés.</p>
    </footer>
</body>
</html>
