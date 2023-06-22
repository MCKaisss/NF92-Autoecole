<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une séance</title>
    <link rel="stylesheet" href="mes_styles.css">
</head>
<body>
    <h1 class="style-titre1">THE AUTO ECOLE</h1>
    <div class="box">
        <h2 class="style-titre3-type1">Ajout Séance</h2>
        <?php
            include("connexion.php");
            $result = mysqli_query($connect, "SELECT * FROM themes WHERE supprime = 0");
            
            echo "<form method='POST' action='ajouter_seance.php' class='form-container'>";
            
            echo "<div class='form-group'>";
            echo "<label class='form-label' for='menuChoixTheme'>Thème:</label>";
            echo "<select class='form-input form-input-type1' name='menuChoixTheme' id='menuChoixTheme'>";
            while ($theme = mysqli_fetch_row($result)){
                echo "<option value='$theme[0]'>$theme[1]</option>";
            }
            echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label class='form-label' for='DateSeance'>Date de la séance:</label>";
            echo "<input class='form-input form-input-type1' type='date' name='DateSeance' id='DateSeance' required>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label class='form-label' for='EffMax'>Effectif maximum:</label>";
            echo "<input class='form-input form-input-type1' type='number' name='EffMax' id='EffMax' placeholder='Effectif' required>";
            echo "</div>";

            echo "<input class='form-button' type='submit' value='Enregistrer'>";

            echo "</form>";
            mysqli_close($connect);
        ?>
    </div>
    <footer>
        <p class="style-text-footer">© 2023 The Auto Ecole. Tous droits réservés.</p>
    </footer>
</body>
</html>
